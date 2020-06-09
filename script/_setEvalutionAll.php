<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require_once("_access.php");
access([1,2,3,4,5]);
$date = $_REQUEST['date'];
$lecture = $_REQUEST['lecture'];
$ids = $_REQUEST['ids'];
$msg = [];
require_once("dbconnection.php");
foreach($ids as $s_id){
  try{
    $attendance = $_REQUEST['attendance'.$s_id];
    $homework = $_REQUEST['homework'.$s_id];
    $grade = $_REQUEST['grade'.$s_id];
    $note = $_REQUEST['note'.$s_id];

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
      $msg[$s_id] = 'تم التحديث';
    }else{
      $query = "insert into students_evalution (lecture,lecture_date,attendance,homework,grade,note,student_id) values(?,?,?,?,?,?,?)";
      $data = setData($con,$query,[$lecture,$date,$attendance,$homework,$grade,$note,$s_id]);
      $success="1";
      $msg[$s_id] = 'تم اضافة التقيم';
    }

} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
   $msg[$s_id] = 'خطأ';
}
}
echo json_encode([$_POST,"success"=>$success,"data"=>$data,'msg'=>$msg]);
?>