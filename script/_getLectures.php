<?php
session_start();
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,4,5]);
$date = $_REQUEST['date'];
if(empty($date)){
  $date = date('Y-m-d');
}
$timestamp = strtotime($date);
$day = (date('w', $timestamp))+1;
require_once("dbconnection.php");
try{
  $query = "select timetable.*,groups.name as g_name from timetable
  inner join groups on timetable.group_id = groups.id
  where teacher_id=? and day = ?";
  $data = getData($con,$query,[$_SESSION['userid'],$day]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array($day,"success"=>$success,"data"=>$data)));
?>