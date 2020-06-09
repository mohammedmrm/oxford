<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,4]);
require_once("dbconnection.php");
$branch = $_REQUEST['branch'];
$student_number = $_REQUEST['student_number'];
$student_name = $_REQUEST['student_name'];
$level= $_REQUEST['level'];
$payment_type = $_REQUEST['payment_type'];
$status = $_REQUEST['f_student_status'];

$start = trim($_REQUEST['start']);
$end = trim($_REQUEST['end']);

$limit = trim($_REQUEST['limit']);
if(empty($limit)){
  $limit = 10;
}
$page = trim($_REQUEST['p']);

if(empty($end)) {
  $end = date('Y-m-d h:i:s', strtotime(' + 1 day'));
}
if(empty($start)) {
  $start = date('Y-m-d h:i:s', strtotime(' - 30 day'));
}
try{
  $count = "select count(*) as count from students ";
  $query = "select students.*, date_format(students.start_date,'%Y-%m-%d') as start_date,
            date_format(students.date,'%Y-%m-%d') as date,
            branches.name as branch_name,students_status_id,
            students_status.name as status
            from students
            left join branches on  branches.id = students.branch_id
            left join students_status on  students_status.id = students.students_status_id
            ";
  $where = "where";
  $filter = "";
  if($_SESSION['user_details']['role_id'] == 4){
     $filter .= " and branch_id =".$_SESSION['user_details']['branch_id'];
  }else{
    if($branch >= 1){
      $filter .= " and branch_id =".$branch;
    }
  }

  if(!empty($student_number)){
    $filter .= " and (student_number like '%".$student_number."%')";
  }
  if(!empty($student_name)){
    $filter .= " and students.name like '%".$student_name."%'";
  }
  if($status >= 1){
    $filter .= " and students_status_id =".$status;
  }
  if($payment_type >= 1){
    $filter .= " and payment_type =".$payment_type;
  }
  if($level >= 1){
    $filter .= " and level_id =".$level;
  }

  if(validateDate($start) && validateDate($end)){
      $filter .= " and students.date between '".$start."' AND '".$end."'";
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
  $query .= " limit ".($page * $limit).",".$limit;
  $data = getData($con,$query);
  $ps = getData($con,$count);
  $pages= ceil($ps[0]['count']/$limit);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}

print_r(json_encode(array('role'=>$_SESSION['user_details']['role_id'],"success"=>$success,"data"=>$data,'pages'=>$pages,'page'=>$page+1)));
?>