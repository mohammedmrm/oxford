<?php
header('Content-type:application/json;charset=windows-1256');
error_reporting(0);
session_start();

require_once("_access.php");
access([1,4,3]);
require_once("dbconnection.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;

$error = "";

$serial = "REG-OXF-";

$sql = "select serial from branches where id = ?";
$res = getData($con,$sql,[$_SESSION['user_details']['branch_id']]);
if(count($res) == 1){
 $serial .=  $res[0]['serial']."-";
}else{
  $error = "فرع خطأ";
}

$year = date('y');

if($error == ""){
  $sql = "select * from students where
  branch_id=? and student_number like '".$serial."%".$year."' order by serial";
  $result = getData($con,$sql,[$_SESSION['user_details']['branch_id']]);
  $count = count($result);
  if($count == 0){
    $serial .="0001-".$year;
    $i = 1;
  }else{
    $i = 1;
    foreach($result as $k=>$val){
     if($val['serial'] != $i){
       if($i < 10){
       $serial .="000".$i."-".$year;
       }else if($i < 100){
        $serial .="00".$i."-".$year;
       }else if($i < 1000){
        $serial .="0".$i."-".$year;
       }else{
        $serial .= $i."-".$year;
       }
       break;
     }else if($count == $i) {
       $i +=1;
       if($i < 10){
       $serial .="000".$i."-".$year;
       }else if($i < 100){
        $serial .="00".$i."-".$year;
       }else if($i < 1000){
        $serial .="0".$i."-".$year;
       }else{
        $serial .= $i."-".$year;
       }
       break;
     }
    $i++;
    }
  }
}

echo json_encode(['error'=>$error,"serial"=>$i,'reg_number'=>$serial]);
?>