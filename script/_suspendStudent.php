<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,3,4]);
require_once("dbconnection.php");
require_once("_vaildFile.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$student   = $_REQUEST['student'];
$date   = $_REQUEST['date'];
$now = date('Y-m-d');


$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
]);

$v->validate([
    'student'    => [$student,   'required|int'],
]);
$date_err = "";
if(!validateDate($date)){
  $date_err = "التاريخ غير صحيح";
}
if($now > $date){
  $date_err = "التاريخ لايمكن ان يكون بالماضي";
}
if($v->passes() && $date_err == "") {
   $sql = 'select Date_format(start_date,"%Y-%m-%m") as date from students where id=?';
   $res =getData($con,$sql,[$student]);
   $interval = strtotime($date) - strtotime($res[0]['date']);
   $interval = round($interval / (60 * 60 * 24)) - 1;
   if($interval > 0){
    if($interval >= 30){
      $penalty = 100;
    }else if($interval > 22){
      $penalty = 80;
    }else if($interval > 15){
      $penalty = 60;
    }else if($interval > 7){
      $penalty = 40;
    }else if($interval > 2){
      $penalty = 20;
    }else if($interval == 2){
      $penalty = 16;
    }else if($interval == 1){
      $penalty = 8;
    }
    $sql    = 'update students set start_date=?,students_status_id=? where id=?';
    $result = setData($con,$sql,[$date,'2',$student]);
    if($result > 0){
     $success = 1;
     $sql = 'insert into students_penalty (student_id,amount,type,note) values(?,?,?,?)';
     $result2=setData($con,$sql,[$student,$penalty,1,'غرمة بسب التأجيل لمدة '.$interval.' يوم']);
     $status_track = 'insert into students_status_tracking (student_id,students_status_id) values(?,?)';
     $track = setData($con,$status_track,[$student,'5']);
    }else{
      $date_err = "ربما تاريخ المباشرة نفس التاريخ الحالي";
    }
  }else{
   $date_err = "يجب ان يكون التاريخ بعد تاريخ المباشرة الحالي";
  }


}
$error = [
         'date'=> $date_err,
         ];

echo json_encode([$_REQUEST,$interval,'success'=>$success, 'error'=>$error]);
?>