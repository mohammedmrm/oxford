<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,4]);
require_once("dbconnection.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$id  = $_REQUEST['staff'];
$salary_status  = $_REQUEST['salary_status'];

$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);

if(!validateDate($start)){
  $start_err = "تاريخ البداية غير صالح";
}else{
  $start_err = "";
}

if(!validateDate($end)){
  $end_err = "تاريخ النهاية غير صالح";
}else{
  $end_err="";
}
if($end_err == "" &&  $start_err == ""){
  $ts1 = strtotime($start);
  $ts2 = strtotime($end);
  $date_diff = $ts2 - $ts1;
  $date_diff = round($date_diff / (60 * 60 * 24));
  if($date_diff > 365){
    $start_err = 'اقصى فترة يجب ان تكون اقل من 365 يوماً';
  }else if($date_diff < 0){
    $start_err = 'فترة غير صحيحة';
  }else{
    $start_err = "";
  }
}


$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب 250 رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'id'   => [$id,  'required|int'],
    'salary_status' => [$salary_status,'required|int'],
]);
if($salary_status == 1){
  $salary_status = 0;
}
$msg = "";
if($v->passes() && $end_err == "" && $start_err == "") {
  $sql = "select * from staff_leave where
          (start_date between '".$start."' and '".$end."' or
          end_date between '".$start."' and '".$end."' or
          '".$start."' between  start_date and end_date or
          '".$end."' between  start_date and end_date) and staff_id = '".$id."'
          ";
          $count = count(getData($con,$sql));
  if($count == 0){
  $sql = 'insert into staff_leave (staff_id,start_date,end_date,with_salary) values
                             (?,?,?,?)';
  $result = setData($con,$sql,[$id,$start,$end,$salary_status]);
    if($result > 0){
      $success = 1;
      $msg = "تم اضافة الاجازة";
    }
  }else{
    $msg = "لايمكن اضافة الاجازة لانها تتداخل مع تاريخ اجازة اخرى";
  }
}else{
  $msg = "هناك بعض الاخطاء";
  $error = [
           'id'=> implode($v->errors()->get('id')),
           'start'=>$start_err,
           'end'=>$end_err,
           'salary_status'=>implode($v->errors()->get('salary_status')),
           ];
}
echo json_encode(['msg'=>$msg,'success'=>$success, 'error'=>$error]);
?>