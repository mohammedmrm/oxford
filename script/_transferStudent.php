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
$student   = $_REQUEST['student'];
$branch   = $_REQUEST['branch'];



$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'branch'    => [$branch,    'required|int'],
]);

if($v->passes()) {

  $sql =     'update students set branch_id=?,group_id=? where id=?';
  $result = setData($con,$sql,[$branch,0,$student]);
  if($result > 0){
    $success = 1;
    $status_track = 'insert into students_status_tracking (student_id,students_status_id) values(?,?)';
    $track = setData($con,$status_track,[$student_id[0]['id'],'5']);
  }

}else{
  $error = [
           'branch'=> implode($v->errors()->get('branch')),
           ];
}
echo json_encode([$_POST,'success'=>$success, 'error'=>$error]);
?>