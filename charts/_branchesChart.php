<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("../script/_access.php");
access([1,2,5,3,4]);
require_once("../script/dbconnection.php");

if($_SESSION['user_details']['role_id'] == 1 || $_SESSION['user_details']['role_id'] == 3){
  $sql = 'select count(*) as stu,max(branches.name) as branch_name,
          max(DATE_FORMAT(students.date,"%Y-%m")) as date,
          max(branches.id) as branch_id
          from students
          left join branches on branches.id = students.branch_id
          group by MONTH(students.date) order by date';

}else{
  $sql = 'select count(*) as stu,max(branches.name) as branch_name,
          max(DATE_FORMAT(students.date,"%Y-%m")) as date,
          max(branches.id) as branch_id
          from students
          left join branches on branches.id = students.branch_id
          where students.branch_id = "'.$_SESSION['user_details']['branch_id'].'"
          group by MONTH(students.date) order by date';

}
$data =  getData($con,$sql);
echo json_encode([$sql,'data'=>$data]);
?>