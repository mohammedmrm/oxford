<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,4,5]);
require_once("dbconnection.php");
require_once("_vaildFile.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$userid    = $_SESSION['userid'];
$name    = $_REQUEST['e_name'];
$email   = $_REQUEST['e_email'];
$phone   = $_REQUEST['e_phone'];
$password   = $_REQUEST['e_password'];
$address  = $_REQUEST['e_address'];


$img = $_FILES['e_img'];

$img_err = image($img);

$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM staff WHERE phone  ='".$value."' and id <> '".$GLOBALS['userid']."'");
    return ! (bool) count($exists);
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'هناك عدد كبير من الحروف والرموز اكثر من المسموح',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'name'    => [$name,    'required|min(4)|max(50)'],
    'email'   => [$email,   'email'],
    'phone'   => [$phone,   "required|isPhoneNumber|unique"],
    'password'=> [$password,'min(6)|max(16)'],
    'address' => [$address, 'required|min(3)|max(200)']
]);

if($v->passes() && $img_err == "" ) {
  if($img['size'] != 0){
    $id = uniqid();
    mkdir("../img/staff/img/", 0700);
    $destination = "../img/staff/img/".$id.".jpg";
    $imgPath = "img/".$id.".jpg";
    move_uploaded_file($img["tmp_name"], $destination);
    $sql = "select * from staff where id = ? and role_id=3";
    $result = getData($con,$sql,[$userid]);
    unlink("../img/staff/".$result[0]["img"]);

    $sql = "update staff set img =? where id=?";
    $result = setData($con,$sql,[$imgPath,$userid]);
    if($result > 0){
      $success = 1;
    }
  }
  if(!empty($password)){
    $password = hashPass($password);
    $sql = "update staff set password =? where id=?";
    $result = setData($con,$sql,[$password,$userid]);
  }
  $sql =     'update staff set name=?,phone=?,email=?,address=? where id=?';
  $result = setData($con,$sql,[$name,$phone,$email,$address,$userid]);
  if($result > 0){
    $success = 1;
  }

}else{
  $error = [
           'name'=> implode($v->errors()->get('name')),
           'email'=>implode($v->errors()->get('email')),
           'phone'=>implode($v->errors()->get('phone')),
           'password'=>implode($v->errors()->get('password')),
           'address'=>implode($v->errors()->get('address')),
           'img'=>$img_err,
           ];
}
echo json_encode([$_POST,'success'=>$success, 'error'=>$error]);
?>