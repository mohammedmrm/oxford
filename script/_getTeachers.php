<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require_once("_access.php");
access([1,3,4]);
require_once("dbconnection.php");
try{

  $query = "select * from staff
  where role_id = ?";
  $data = getData($con,$query,[5]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array("success"=>$success,"data"=>$data));
?>