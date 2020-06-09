<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,4]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
require_once("dbconnection.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;

$v->validate([
    'id'    => [$id,'required|int']
    ]);

if($v->passes()){
       $sql = "select * from students_penalty inner join students on students.id = students_penalty.student_id where students_penalty.id = '".$id."'";
       $student = getData($con,$sql);
       if(count($student) <= 0){
         $success = 0;
         $msg = "هناك خطأ بالمعلومات";
       }else if($student[0]['confirm'] == 2 || ($student[0]['confirm'] == 1 && $_SESSION['user_details']['role_id'] == 4)){
         $msg = "تم تاكيد الغرامة مسبقاً";
       }else{
         $sql = "update students_penalty set confirm=? where id = ?";
         if($_SESSION['user_details']['role_id'] == 2){
          $update = setData($con,$sql,['2',$id]);
          $c=2;
         }else{
          $update = setData($con,$sql,['1',$id]);
          $c=1;
         }
         if($update > 0 && $c==2){
            $success = 1;
            $msg = "تم تاكيد المبلغ";
            $sql = "select * from balance order by id DESC limit 1";
            $balance = getData($con,$sql);
            if(count($balance) == 1){
              $sql = "insert into balance (branch_id,balance,money,reason,note,status)
              values(?,?,?,?,?,?)";
              $result = setData($con,$sql,[$student[0]['branch_id'],
              $balance[0]['balance'] + $student[0]['amount'],
              $student[0]['amount'],'غرامة الطالب - '.$student[0]['student_number'],
              'تسديد الغرامة دراسي','1']);
            }else if(count($balance) == 0){
              $sql = "insert into balance (branch_id,balance,money,reason,note,status)
              values(?,?,?,?,?,?)";
              $result = setData($con,$sql,[$student[0]['branch_id'],
              $student[0]['amount'],
              $student[0]['amount'],'غرامة الطالب - '.$student[0]['student_number'],
              'تسديد الغرامة دراسي','1']);
            }
         }else{
            $msg = "فشلأالتاكيد";
         }

       }
}else{
  $msg = "فشل التأكيد";
  $success = 0;
}
echo json_encode([$balance,'success'=>$success, 'msg'=>$msg]);
?>