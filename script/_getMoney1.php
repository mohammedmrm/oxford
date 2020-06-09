<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,4]);
require_once("dbconnection.php");
require_once("_crpt.php");

$success = 0;
$error = [];

$id= $_REQUEST['id'];
$sql= "select * from branch_balance where id=?";
  $res = getData($con,$sql,[$id]);
  if(count($res) > 0){
    $success = 1;
  }else{
  $error = "error";
  }

echo json_encode(["data"=>$res,'success'=>$success, 'error'=>$error]);
?>