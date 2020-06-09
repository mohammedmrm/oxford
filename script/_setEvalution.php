<?php
session_start();
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,4,5]);
$date = $_REQUEST['date'];
$lecture = $_REQUEST['lecture'];
$s_id = $_REQUEST['s_id'];
$attendance = $_REQUEST['attendance'.$s_id];
$homework = $_REQUEST['homework'.$s_id];
$grade = $_REQUEST['grade'.$s_id];
$note = $_REQUEST['note'.$s_id];
require_once("dbconnection.php");
try{
  $sql = "select * from students_evalution where student_id=? and lecture_date=? and lecture=?";
  $result = getData($con,$sql,[$s_id,$date,$lecture]);
  if(count($result) > 0){
    $query = "update students_evalution set
               lecture=?,
               attendance=?,
               homework=?,
               grade=?,
               note=?
               where student_id=? and lecture_date=? and lecture=?
              ";
    $data = setData($con,$query,[$lecture,$attendance,$homework,$grade,$note,$s_id,$date,$lecture]);
    $success="1";
    $msg = 'تم التحديث';
  }else{
    $query = "insert into students_evalution (lecture,lecture_date,attendance,homework,grade,note,student_id) values(?,?,?,?,?,?,?)";
    $data = setData($con,$query,[$lecture,$date,$attendance,$homework,$grade,$note,$s_id]);
    $success="1";
    $msg = 'تم اضافة التقيم';
  }
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode([$_POST,"success"=>$success,"data"=>$data]);
?>