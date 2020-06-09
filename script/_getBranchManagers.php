<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
require_once("_access.php");
access([1,3]);
require_once("dbconnection.php");
try{
  $query = "select staff.*,branches.name as branch_name from staff
  inner join branches on branches.id = staff.branch_id
  where role_id = ?";
  $data = getData($con,$query,[4]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo json_encode(array("success"=>$success,"data"=>$data));
?>