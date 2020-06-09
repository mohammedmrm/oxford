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

$branch= trim($_REQUEST['branch']);
if($_SESSION['user_details']['role_id'] == 4){
   $branch  = $_SESSION['user_details']['branch_id'];
}
$start = trim($_REQUEST['f_start']);
$end = trim($_REQUEST['f_end']);
if(empty($end)) {
  $end = date('Y-m-d',strtotime(' + 1 day'));
}
if(empty($start)) {
  $start = date('Y-m-d',strtotime(' - 30 day'));
}

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
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'branch'    => [$branch,'int'],
]);


if($v->passes() && $start_err == "" && $end_err == "")  {
  try{
    if($branch == 0 || empty($branch)){
     $query = "select staff_leave.*,branches.name as branch_name,
     staff.name as staff_name,
     datediff(staff_leave.end_date,staff_leave.start_date)+1 as days
     from staff_leave
     inner join staff on staff_leave.staff_id = staff.id
     inner join branches on staff.branch_id = branches.id
     where staff_leave.start_date between '".$start."' and '".$end."'
     ";

    }else{
     $query = "select staff_leave.*,branches.name as branch_name,
     staff.name as staff_name,
     datediff(staff_leave.end_date,staff_leave.start_date)+1 as days
     from staff_leave
     inner join staff on staff_leave.staff_id = staff.id
     inner join branches on staff.branch_id = branches.id
     where staff_leave.start_date between '".$start."' and '".$end."'
     and branch_id ='".$branch."'
     ";
    }
    $data = getData($con,$query);
    $success="1";
  } catch(PDOException $ex) {
     $data=["error"=>$ex];
     $success="0";
  }
}
echo json_encode(array("success"=>$success,"data"=>$data,'role'=>$_SESSION['user_details']['role_id']));
?>