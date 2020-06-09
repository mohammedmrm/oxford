<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,4]);
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
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
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
  if($branch == 0 || empty($branch)){
  $sql= "select cash.*,DATE_FORMAT(cash.date,'%Y-%m-%d') as date, branches.name as branch_name from cash
         inner join branches on branches.id = cash.branch_id
         where cash.date between '".$start."' and '".$end."'";
  }else{
  $sql= "select cash.*,DATE_FORMAT(cash.date,'%Y-%m-%d') as date , branches.name as branch_name from cash
         inner join branches on branches.id = cash.branch_id
         where cash.branch_id = '".$branch."' and cash.date between '".$start."' and '".$end."'";

  }
  $res = getData($con,$sql);
  if(count($res) > 0){
    $success = 1;
  }

}else{
  $error = [
           'branch'=> implode($v->errors()->get('branch')),
           'end'=> $end_err,
           'start'=>$start_err,
           ];
}

echo json_encode(["data"=>$res,'success'=>$success, 'error'=>$error,'role'=>$_SESSION['user_details']['role_id'],'branch'=>$branch]);
?>