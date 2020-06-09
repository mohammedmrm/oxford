<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require_once("_access.php");
access([1,2,3,4]);
require_once("dbconnection.php");

require_once("_crpt.php");
use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];


$id = $_REQUEST['id'];



$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'id'    => [$id,'required|max(20)'],
]);


if($v->passes())  {
  try{
    if($_SESSION['user_details']['role_id'] == 4){
    $query = "select *,students_leave.id as l_id, date_format(end,'%Y-%m-%d') as end_date, date_format(start,'%Y-%m-%d') as start_date,
    if(students_leave.note is NULL,'',students_leave.note) as note from students_leave
               left join students on students.id = students_leave.student_id
               where student_number = ? and branch_id=?  ";
    $data = getData($con,$query,[$id,$_SESSION['user_details']['branch_id']]);

    }else{
    $query = "select *,students_leave.id as l_id, date_format(end,'%Y-%m-%d') as end_date, date_format(start,'%Y-%m-%d') as start_date,
    if(students_leave.note is NULL,'',students_leave.note) as note from students_leave
               left join students on students.id = students_leave.student_id
               where student_number = ?";
    $data = getData($con,$query,[$id]);

    }
    $success="1";
  } catch(PDOException $ex) {
     $data=["error"=>$ex];
     $success="0";
  }
}
echo json_encode(array($id,"success"=>$success,"data"=>$data,'role'=>$_SESSION['user_details']['role_id']));
?>