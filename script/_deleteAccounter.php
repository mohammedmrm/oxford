<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require("_access.php");
access([1]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
require("dbconnection.php");
         $sql = "select * from staff where id = ? and role_id=2";
         $result = getData($con,$sql,[$id]);
         if($result[0]["img"] != "_"){
            unlink("../img/staff/".$result[0]["img"]);
         }
         if($result[0]["documents"] != "_"){
            unlink("../img/staff/".$result[0]["documents"]);
         }
         $sql = "delete from staff where id = ? and role_id=2";
         $result = setData($con,$sql,[$id]);
         if($result > 0){
            $success = 1;
         }else{
            $msg = "فشل الحذف";
         }
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>