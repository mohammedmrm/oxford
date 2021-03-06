<?php
session_start();
error_reporting(0);
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
$student   = $_REQUEST['id'];



$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
]);

$v->validate([
    'student'    => [$student,   'required|int'],
]);

if($v->passes()) {

  $sql =    'update students set students_status_id=?,start_date=? where id=?';
  $result = setData($con,$sql,['1',date('Y-m-d'),$student]);
  if($result > 0){
    $success = 1;
    $status_track = 'insert into students_status_tracking (student_id,students_status_id) values(?,?)';
    $track = setData($con,$status_track,[$student,'1']);
  }

}else{

}
echo json_encode([$_POST,'success'=>$success]);
?>