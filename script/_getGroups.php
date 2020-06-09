<?php
session_start();
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,4]);
require_once("dbconnection.php");
try{
  $query = "select * from groups where branch_id=?";
  $data = getData($con,$query,[$_SESSION['user_details']["branch_id"]]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>