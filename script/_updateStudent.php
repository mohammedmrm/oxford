<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,4]);
require_once("dbconnection.php");
require_once("_vaildFile.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$student  = $_REQUEST['editstudentid'];
$name    = $_REQUEST['e_name'];
$birthday   = $_REQUEST['e_birthday'];
$gender   = $_REQUEST['e_gender'];
$phone   = $_REQUEST['e_phone'];
$group  = $_REQUEST['e_group'];
$extra  = $_REQUEST['e_extra'];


$img = $_FILES['e_img'];
$passport = $_FILES['e_passport'];
$id1 = $_FILES['e_id1'];
$id1 = $_FILES['e_id1'];
$id1 = $_FILES['e_id1'];

$img_err = image($img);
$passport_err = image($passport);
$id1_err = image($id1);
$id2_err = image($id2);
$id3_err = image($id3);

$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);
$birthday_err = "";
if(!validateDate($birthday)){
  $birthday_err = "التاريخ غير صحيح";
}
$v->validate([
    'name'    => [$name,    'required|min(4)|max(50)'],
    'phone'   => [$phone,   "required|isPhoneNumber"],
    'gender'  => [$gender,  'required|int'],
    'group'   => [$group,   'required|int'],
    'student' => [$student, 'required|int']
]);

if($v->passes() && $img_err == "" && $passport_err == ""  && $id1_err == "" && $id2_err == "" && $id3_err == "") {
    $sql = "select * from students where id = ?";
    $images = getData($con,$sql,[$student]);

  if($img['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/img/", 0700);
    $destination = "../img/student/img/".$id.".jpg";
    $imgPath = "img/".$id.".jpg";
    move_uploaded_file($img["tmp_name"], $destination);
    unlink("../img/student/".$images[0]["img"]);
    $sql = "update students set img =? where id=?";
    $result = setData($con,$sql,[$imgPath,$student]);
    if($result > 0){
      $success = 1;
    }
  }
  if($passport['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/passport/", 0700);
    $destination = "../img/student/passport/".$id.".jpg";
    $passportPath = "passport/".$id.".jpg";
    move_uploaded_file($passport["tmp_name"], $destination);
    unlink("../img/student/".$images[0]["id1"]);
    $sql = "update students set passport =? where id=?";
    $result = setData($con,$sql,[$passportPath,$student]);
    if($result > 0){
      $success = 1;
    }
  }


  if($id1['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/id1/", 0700);
    $destination = "../img/student/id1/".$id.".jpg";
    $id1Path = "id1/".$id.".jpg";
    move_uploaded_file($id1["tmp_name"], $destination);
    unlink("../img/student/".$images[0]["id1"]);
    $sql = "update students set id1 =? where id=?";
    $result = setData($con,$sql,[$id1Path,$student]);
      if($result > 0){
      $success = 1;
    }
  }

  if($id2['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/id2/", 0700);
    $destination = "../img/student/id2/".$id.".jpg";
    $id2Path = "id2/".$id2.".jpg";
    move_uploaded_file($id2["tmp_name"], $destination);
    unlink("../img/student/".$images[0]["id2"]);
    $sql = "update students set id2 =? where id=?";
    $result = setData($con,$sql,[$id2Path,$student]);
    if($result > 0){
      $success = 1;
    }
  }
  if($id3['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/id3/", 0700);
    $destination = "../img/student/id3/".$id.".jpg";
    $id3Path = "id3/".$id3.".jpg";
    move_uploaded_file($id3["tmp_name"], $destination);
    unlink("../img/student/".$images[0]["id2"]);
    $sql = "update students set id3 =? where id=?";
    $result = setData($con,$sql,[$id3Path,$student]);
    if($result > 0){
      $success = 1;
    }
  }
  $sql =     'update students set name=?,phone=?,birthday=?,group_id=?, gender=? where id=?';
  $result = setData($con,$sql,[$name,$phone,$birthday,$group,$gender,$student]);
  if($result > 0){
    $success = 1;
  }

}else{
  $error = [
           'name'=> implode($v->errors()->get('name')),
           'birthday'=>$birthday_err,
           'phone'=>implode($v->errors()->get('phone')),
           'gender'=>implode($v->errors()->get('gender')),
           'group'=>implode($v->errors()->get('group')),
           'extra'=>implode($v->errors()->get('extra')),
           'student'=>implode($v->errors()->get('student')),
           'img'=>$img_err,
           'passport'=>$passport_err,
           'id1'=>$id1_err,
           'id2'=>$id2_err,
           'id3'=>$id3_err,
           ];
}
echo json_encode([$_FILES,'success'=>$success, 'error'=>$error]);
?>