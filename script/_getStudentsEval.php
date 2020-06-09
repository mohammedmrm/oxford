<?php
session_start();
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,4,5]);
$date = $_REQUEST['date'];
$lecture = $_REQUEST['lecture'];
if(empty($date)){
  $date = date('Y-m-d');
}
$timestamp = strtotime($date);
$day = (date('w', $timestamp))+1;
require_once("dbconnection.php");
try{
  $query = "select *,students_evalution.note as e_note,
                   students.name as s_name,groups.name as g_name,
                   students.id as s_id, timetable.id as t_id
            from students
            inner join groups on groups.id = students.group_id
            inner join timetable on timetable.group_id = groups.id
            left join students_evalution on students_evalution.student_id= students.id and lecture_date = ?
            where timetable.id = ? and students.start_date <= ? and students_status_id=1";
  $data = getData($con,$query,[$date,$lecture,$date]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array($_POST,"success"=>$success,"data"=>$data)));
?>