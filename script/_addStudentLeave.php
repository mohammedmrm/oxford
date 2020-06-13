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
$id  = $_REQUEST['id'];
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
$note = $_REQUEST['note'];
$now = date('Y-m-d');
$start_err = "";
$end_err = "";
if(!validateDate($start)){
  $start_err = "تاريخ البداية غير صالح";
}else if($start < $now){
  $start_err = "تاريخ  البداية يجب ان يكون بعد تاريخ اليوم";
}else{
  $start_err = "";
}

if(!validateDate($end)){
  $end_err = "تاريخ النهاية غير صالح";
}else if($end < $now){
   $end_err = "تاريخ  النهاية يجب ان يكون بعد تاريخ اليوم";
}else{
  $end_err="";
}
if($end_err == "" &&  $start_err == ""){

      $ts1 = strtotime($start);
      $ts2 = strtotime($end);
      $date_diff = $ts2 - $ts1;
      $date_diff = round($date_diff / (60 * 60 * 24))+1;
      if($date_diff < 3){
      $penalty =  $date_diff * 8;
      }else {
       $penalty = 20;
      }
      if($date_diff >= 7){
        $start_err = 'اقصى فترة يجب ان تكون اقل من 7 يوماً';
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
    'note' => [$note,'max(250)'],
]);

$msg = "";
if($v->passes() && $end_err == "" && $start_err == "") {
   $sql = 'select Date_format(start_date,"%Y-%m-%m") as date from students where id=?';
   $res =getData($con,$sql,[$id]);
   $interval = strtotime($start) - strtotime($res[0]['date']);
   $interval = round($interval / (60 * 60 * 24)) - 1;
   if($interval > 0){
        $sql = "select * from students_leave where
                (start between '".$start."' and '".$end."' or
                end between '".$start."' and '".$end."' or
                '".$start."' between  start and end or
                '".$end."' between  start and end) and student_id = '".$id."'
                ";
                $count = count(getData($con,$sql));
        if($count == 0){
        $sql = 'insert into students_leave (student_id,start,end,note) values
                                   (?,?,?,?)';
        $result = setData($con,$sql,[$id,$start,$end,$note]);
          if($result > 0){
            $success = 1;
            $sql = 'insert into students_penalty (student_id,amount,type,note) values(?,?,?,?)';
            $result2=setDataWithLastID($con,$sql,[$id,$penalty,2,'غرامة بسب اجازة لمدة '.$date_diff.' يوم']);
            $sql = "update students_leave set penalty_id=? where student_id=? and start= ?  order by id DESC limit 1";
            setData($con,$sql,[$result2,$id,$start]);
            $msg = "تم اضافة الاجازة";
          }
        }else{
          $msg = "لايمكن اضافة الاجازة لانها تتداخل مع تاريخ اجازة اخرى";
        }
  }else{
     $start_err = 'يجب ان تكون بداية الاجازة بعد تاريخ المباشرة';
  }
}else{
  $msg = "هناك بعض الاخطاء";
}
  $error = [
           'id'=> implode($v->errors()->get('id')),
           'start'=>$start_err,
           'end'=>$end_err,
           'note'=>implode($v->errors()->get('note')),
           ];

echo json_encode(['msg'=>$msg,'success'=>$success, 'error'=>$error]);
?>