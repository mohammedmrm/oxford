<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,4]);
require_once("dbconnection.php");
$branch = $_REQUEST['branch'];
$level = $_REQUEST['level'];
$payment_type = $_REQUEST['payment_type'];
$money_status = $_REQUEST['money_status'];
$student_number= $_REQUEST['student_number'];
$name = $_REQUEST['name'];
if($_SESSION['user_details']['role_id'] != 1 && $_SESSION['user_details']['role_id'] != 2){
 $branch  = $_SESSION['user_details']['branch_id'];
}
$page = trim($_REQUEST['p']);
$limit = trim($_REQUEST['limit']);

try{
  $count = "select count(*) as count from payment
            left JOIN students on students.id = payment.student_id
            left JOIN branches on branches.id = students.branch_id
            ";
  $query = "SELECT students.*,payment.*, payment.id as pay_id,
            branches.name as branch_name, DATE_FORMAT(payment.date,'%Y-%m-%d') as date,
            payment.confirm as conf
            from payment
            left JOIN students on students.id = payment.student_id
            left JOIN branches on branches.id = students.branch_id
            ";
  $where = "where";
  $filter = "";
  if($branch >= 1){
   $filter .= " and students.branch_id =".$branch;
  }

  if(($money_status == 1 || $money_status == 2)){
    $filter .= " and payment.confirm='".$money_status."'";
  }else if($money_status == 3){
    $filter .= " and payment.confirm='0'";
  }
  if(($payment_type == 1 || $payment_type == 2 || $payment_type == 3)){
    $filter .= " and students.payment_type='".$payment_type."'";
  }
  if(!empty($name)){
    $filter .= " and (students.name like '%".$name."%' or
                      students.phone like '%".$name."%')";
  }
  if(!empty($student_number)){
    $filter .= " and student_number like '%".$student_number."%'";
  }
  if($level >= 1){
    $filter .= " and students.level_id =".$level;
  }
  if($filter != ""){
    $filter = preg_replace('/^ and/', '', $filter);
    $filter = $where." ".$filter;
    $count .= " ".$filter;
    $query .= " ".$filter;
  }
  if($page != 0){
    $page = $page -1;
  }
  $query .= " order by conf ASC,payment.date DESC "." limit ".($page * $limit).",".$limit;
  $data = getData($con,$query);
  $ps = getData($con,$count);
  $pages= ceil($ps[0]['count']/$limit);
  $success = 1;
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}

echo (json_encode(array("role"=>$_SESSION['user_details']['role_id'],"success"=>$success,"data"=>$data,'pages'=>$pages,'page'=>$page+1)));
?>