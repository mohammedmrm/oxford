<?php
session_start();
header('Content-Type: application/json');
require_once("_access.php");
access([4]);
require_once("dbconnection.php");
try{
  $query = "select timetable.*, staff.name as teacher_name, groups.name as group_name from timetable
  inner join staff on staff.id = timetable.teacher_id
  inner join groups on groups.id=timetable.group_id
  inner join branches on branches.id=timetable.branch_id
    where timetable.branch_id =?";
  $data = getData($con,$query,[$_SESSION['user_details']['branch_id']]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array($query,"success"=>$success,"data"=>$data)));
?>