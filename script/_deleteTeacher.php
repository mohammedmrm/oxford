<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,3,4]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
require_once("dbconnection.php");
         $sql = "select * from staff where id = ? and role_id=5";
         $result = getData($con,$sql,[$id]);
         if($result[0]["img"] != "_"){
            unlink("../img/staff/".$result[0]["img"]);
         }
         if($result[0]["documents"] != "_"){
            unlink("../img/staff/".$result[0]["documents"]);
         }
         $sql = "delete from staff where id = ? and role_id=5";
         $result = setData($con,$sql,[$id]);
         if($result > 0){
            $success = 1;
         }else{
            $msg = "فشل الحذف";
         }
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>