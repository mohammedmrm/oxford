<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2]);
require_once("dbconnection.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];

$branch= trim($_REQUEST['branch']);
$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);
if(empty($end)) {
  $end = date('Y-m-d',strtotime(' + 1 day'));
}
if(empty($start)) {
  $start = date('Y-m-d',strtotime(' - 30 day'));
}

if(!validateDate($start)){
  $start_err = "تاريخ البداية غير صحيح";
}else{
  $start_err = "";
}

if(!validateDate($end)){
  $end_err = "تاريخ نهاية الفترة غير صحيح";
}else{
 $end_err="";
}
if($end_err == "" &&  $start_err == ""){
  $ts1 = strtotime($start);
  $ts2 = strtotime($end);
  $date_diff = $ts2 - $ts1;
  if($date_diff > 60){
    $date_err = 'اقصى فترة يجب ان تكون اقل من 60 يوماً';
  }else if($date_diff < 0){
    $date_err = 'فترة غير صحيحة';
  }else{
    $date_err = "";
  }
}
$v->addRuleMessages([
    'required' => '????? ?????',
    'int'      => '??? ??????? ????? ???',
    'regex'      => '??? ??????? ????? ???',
    'min'      => '???? ????',
    'max'      => '????? ? {value} ??? ??? ???? ',
    'email'      => '?????? ?????????? ??? ????',
]);

$v->validate([
    'branch'    => [$branch,'int'],
]);


if($v->passes() && $start_err == "" && $end_err == "")  {
  if($branch == 0 || empty($branch)){
  $sql= "select balance.*,DATE_FORMAT(balance.date,'%Y-%m-%d') as date, branches.name as branch_name from balance
         inner join branches on branches.id = balance.branch_id
         where balance.date between '".$start."' and '".$end."' order by DATE_FORMAT(balance.date,'%Y-%m-%d') DESC,balance.id DESC";
  }else{
  $sql= "select balance.*,DATE_FORMAT(balance.date,'%Y-%m-%d') as date , branches.name as branch_name from balance
         inner join branches on branches.id = balance.branch_id
         where balance.branch_id = '".$branch."' and balance.date between '".$start."' and '".$end."' order by balance.date DESC,balance.id DESC";

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
           'date'=>$date_err,
           ];
}

echo json_encode(["data"=>$res,'success'=>$success, 'error'=>$error]);
?>