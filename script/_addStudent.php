<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
//access([1,3,4]);
require_once("dbconnection.php");
require_once("_vaildFile.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$name    = $_REQUEST['name'];
$birthday   = $_REQUEST['birthday'];
$phone   = $_REQUEST['phone'];
$gender  = $_REQUEST['gender'];
$student_number  = $_REQUEST['reg_number'];
$serial  = $_REQUEST['serial'];
$payment_type  = $_REQUEST['payment_type'];

$img = $_FILES['img'];
$passport = $_FILES['passport'];
$id1 = $_FILES['id1'];
$id2 = $_FILES['id2'];
$id3 = $_FILES['id3'];

$img_err = image($img);
$passport_err = image($passport);
$id1_err = image($id1);
$id2_err = image($id2);
$id3_err = image($id3);

$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM students WHERE student_number  ='".$value."'");
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
    'gender'   => [$gender,   'required|int'],
    'phone'   => [$phone,   "required|isPhoneNumber"],
    'birthday'  => [$birthday,  'required'],
    'payment_type' => [$payment_type,    'required|int|min(1)|max(1)'],
    'student_number' => [$student_number,    'required|unique']
]);

if($v->passes() && $img_err == "" && $passport_err == "") {
  if($img['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/img/", 0700);
    $destination = "../img/student/img/".$id.".jpg";
    $imgPath = "img/".$id.".jpg";
    move_uploaded_file($img["tmp_name"], $destination);
  }else{
    $imgPath = "_";
  }
  if($passport['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/passport/", 0700);
    $destination = "../img/student/passport/".$id.".jpg";
    $passportPath = "passport/".$id.".jpg";
    move_uploaded_file($passport["tmp_name"], $destination);
  }else{
    $passportPath ="_";
  }
  if($id1['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/id1/", 0700);
    $destination = "../img/student/id1/".$id.".jpg";
    $id1Path = "id1/".$id.".jpg";
    move_uploaded_file($id1["tmp_name"], $destination);
  }else{
    $id1Path ="_";
  }
    if($id2['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/id2/", 0700);
    $destination = "../img/student/id2/".$id.".jpg";
    $id2Path = "id2/".$id.".jpg";
    move_uploaded_file($id2["tmp_name"], $destination);
  }else{
    $id2Path ="_";
  }
    if($id3['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/id3/", 0700);
    $destination = "../img/student/id3/".$id.".jpg";
    $id3Path = "id3/".$id.".jpg";
    move_uploaded_file($id3["tmp_name"], $destination);
  }else{
    $id3Path ="_";
  }

  $sql = 'insert into students (manager_id,branch_id,name,phone,gender,birthday,payment_type,
                             student_number,serial,img,passport,id1,id2,id3) values
                             (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
  $result = setData($con,$sql,[$_SESSION['userid'],$_SESSION['user_details']['branch_id'],$name,$phone,$gender,$birthday,$payment_type,
                               $student_number,$serial,$imgPath,
                               $passportPath,$id1Path,$id2Path,$id3Path]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'name'=> implode($v->errors()->get('name')),
           'gender'=>implode($v->errors()->get('gender')),
           'phone'=>implode($v->errors()->get('phone')),
           'birthday'=>implode($v->errors()->get('birthday')),
           'payment_type'=>implode($v->errors()->get('payment_type')),
           'student_number'=>implode($v->errors()->get('reg_number')),
           'img'=>$img_err,
           'passport'=>$passport_err,
           'id1'=>$id1_err,
           'id2'=>$id2_err,
           'id3'=>$id3_err,
           ];
}
echo json_encode([$_POST,'success'=>$success, 'error'=>$error]);
?>