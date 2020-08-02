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
$student  = $_REQUEST['charge_student_id'];
$amount   = $_REQUEST['charge_amount'];
$reason   = $_REQUEST['charge_reason'];



$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
]);

$v->validate([
    'student'   => [$student,   'required|int'],
    'amount'    => [$amount,   'required|int'],
    'reason'    => [$reason,   'required|max(250)'],
]);

if($v->passes()) {

  $sql =    'insert into students_penalty (amount,note,student_id,type) values(?,?,?,?)' ;
  $result = setData($con,$sql,[$amount,$reason,$student,3]);
  if($result == 1){
    $success = 1;
  }
}else{
  $error = [
            'student'=> implode($v->errors()->get('student')),
            'amount'=>implode($v->errors()->get('amount')),
            'reason'=>implode($v->errors()->get('reason')),
           ];
}
echo json_encode([$_POST,'success'=>$success,'error'=>$error]);
?>