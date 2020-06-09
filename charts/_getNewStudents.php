<?php
session_start();
header('Content-Type: application/json');
require_once("../script/_access.php");
access([1,2,3,4]);
require_once("../script/dbconnection.php");
try{
  if($_SESSION['user_details']['role_id'] == 1 || $_SESSION['user_details']['role_id'] == 3){
    $query = "select * from students order by date DESC limit 5";
  }else{
    $query = "select * from students where students.branch_id = '".$_SESSION['user_details']['branch_id']."' order by date DESC limit 5";
  }
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>