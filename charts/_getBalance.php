<?php
session_start();
header('Content-Type: application/json');
require_once("../script/_access.php");
access([1,2,3,4,5,6]);
require_once("../script/dbconnection.php");
try{
  if($_SESSION['user_details']['role_id'] == 1 || $_SESSION['user_details']['role_id'] == 2){
    $query = "select sum(if(status=1,money,0)) - sum(if(status<>1,money,0)) as balance from balance";
  }else{
    $query = "select sum(if(status=1,money,0)) - sum(if(status<>1,money,0)) as balance from branch_balance where branch_id='".$_SESSION['user_details']['branch_id']."'";
  }
  $data = getData($con,$query);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array("success"=>$success,"data"=>$data));
?>