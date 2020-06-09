<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,3]);
require_once("dbconnection.php");
require_once("_vaildFile.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$name    = $_REQUEST['name'];
$email   = $_REQUEST['email'];
$phone   = $_REQUEST['phone'];
$password   = $_REQUEST['password'];
$address  = $_REQUEST['address'];
$salary  = $_REQUEST['salary'];
$branch  = $_REQUEST['branch'];
$end  = $_REQUEST['end'];

$img = $_FILES['img'];
$documents = $_FILES['documents'];

$img_err = image($img);
$documents_err = image($documents);

$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM staff WHERE phone  ='".$value."'");
    return ! (bool) count($exists);
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'name'    => [$name,    'required|min(4)|max(50)'],
    'branch'  => [$branch,    'required|int'],
    'email'   => [$email,   'email'],
    'phone'   => [$phone,   "required|isPhoneNumber|unique"],
    'password'=> [$password,'required|min(6)|max(16)'],
    'salary'  => [$salary,  'required|min(1)|max(16)'],
    'address' => [$address,    'required|min(3)|max(200)']
]);
$date_err = "";
if(!validateDate($end)){
  $date_err = "التاريخ غير صحيح";
}
if($v->passes() && $img_err == "" && $documents_err == "" && $date_err == "") {
  if($img['size'] != 0){
    $id = uniqid();
    mkdir("../img/staff/img/", 0700);
    $destination = "../img/staff/img/".$id.".jpg";
    $imgPath = "img/".$id.".jpg";
    move_uploaded_file($img["tmp_name"], $destination);
  }else{
    $imgPath = "_";
  }
  if($documents['size'] != 0){
    $id = uniqid();
    mkdir("../img/staff/documents/", 0700);
    $destination = "../img/staff/documents/".$id.".jpg";
    $documentsPath = "documents/".$id.".jpg";
    move_uploaded_file($documents["tmp_name"], $destination);
  }else{
    $documentsPath ="_";
  }
  $password = hashPass($password);

  $sql = 'insert into staff (end_date,branch_id,name,phone,email,address,salary,img,documents,password,role_id) values
                             (?,?,?,?,?,?,?,?,?,?,?)';
  $result = setData($con,$sql,[$end,$branch,$name,$phone,$email,$address,$salary,$imgPath,
                               $documentsPath,$password,"4"]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'name'=> implode($v->errors()->get('name')),
           'branch'=> implode($v->errors()->get('branch')),
           'email'=>implode($v->errors()->get('email')),
           'phone'=>implode($v->errors()->get('phone')),
           'password'=>implode($v->errors()->get('password')),
           'salary'=>implode($v->errors()->get('salary')),
           'address'=>implode($v->errors()->get('address')),
           'end'=>$date_err,
           'img'=>$img_err,
           'documents'=>$documents_err
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>