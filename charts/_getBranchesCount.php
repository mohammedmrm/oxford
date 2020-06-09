<?php
session_start();
header('Content-Type: application/json');
require_once("../script/_access.php");
access([1,2,3,4]);
require_once("../script/dbconnection.php");
try{
if($_SESSION['user_details']['role_id'] == 1 || $_SESSION['user_details']['role_id'] == 2 || $_SESSION['user_details']['role_id'] == 3){
$query = "select        max(branches.name) as branch_name,
                        count(distinct  students.id) as count,
                        SUM(IF (confirm = '0',amount,0)) as  notrecived,
                        SUM(IF (confirm = '1',amount,0)) as  notconfirmed,
                        SUM(IF (confirm = '2',amount,0)) as  confirmed
              from payment
              right join students on students.id = payment.student_id
              left join branches on branches.id = students.branch_id
              group by students.branch_id";
}else{
$query = "select        max(branches.name) as branch_name,
                        count(distinct  students.id) as count,
                        SUM(IF (confirm = '0',amount,0)) as  notrecived,
                        SUM(IF (confirm = '1',amount,0)) as  notconfirmed,
                        SUM(IF (confirm = '2',amount,0)) as  confirmed
              from payment
              right join students on students.id = payment.student_id
              left join branches on branches.id = students.branch_id
              where students.branch_id = '".$_SESSION['user_details']['branch_id']."'
              group by students.branch_id";
}
   $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array("success"=>$success,"data"=>$data));
?>