<?php
session_start();
header('Content-Type: application/json');
require_once("../script/_access.php");
access([1,2,3,4]);
require_once("../script/dbconnection.php");
try{
  if($_SESSION['user_details']['role_id'] == 1 || $_SESSION['user_details']['role_id'] == 3){
    $query = "select count(*) as count from students";
  }else{
    $query = "select count(*) as count from students where branch_id ='".$_SESSION['user_details']['branch_id']."'";
  }
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array("success"=>$success,'count'=>$data[0]['count'],"data"=>$data));
?>