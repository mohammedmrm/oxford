<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([3]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
require_once("dbconnection.php");
         $sql = "select * from students where id = ?";
         $result = getData($con,$sql,[$id]);
         if($result[0]["img"] != "_"){
            unlink("../img/student/".$result[0]["img"]);
         }
         if($result[0]["passport"] != "_"){
            unlink("../img/student/".$result[0]["passport"]);
         }
         if($result[0]["id1"] != "_"){
            unlink("../img/student/".$result[0]["id1"]);
         }
         if($result[0]["id2"] != "_"){
            unlink("../img/student/".$result[0]["id2"]);
         }
         if($result[0]["id3"] != "_"){
            unlink("../img/student/".$result[0]["id3"]);
         }
         $sql = "delete from students where id = ?";
         $result = setData($con,$sql,[$id]);
         if($result > 0){
            $success = 1;
         }else{
            $msg = "فشل الحذف";
         }
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>