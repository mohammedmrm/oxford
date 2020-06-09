<?php
if(!isset($_SESSION)){
session_start();
}
function access($access_roles = []){
  if(!in_array($_SESSION['user_details']['role_id'],$access_roles) || !isset($_SESSION['userid'])){
    header("location: ../login.php");
    die("<h1>لاتمتلك صلاحيات الوصول لهذه الصفحة  (<a href='login.php'>سجل الدخول</a>)</h1>");
  }
}
require_once("dbconnection.php");
$sql = "select * from config";
$config = getData($con,$sql);
?>