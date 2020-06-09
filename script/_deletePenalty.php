<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,3]);
$id= $_REQUEST['id'];
$success = 0;
$msg="";
require_once("dbconnection.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;

$v->validate([
    'id'    => [$id,'required|int']
    ]);

if($v->passes()){
       $sql = "select * from students_penalty where id = ?";
       $res = getData($con,$sql,[$id]);
       if($res[0]['confirm'] == 2){
         $success = 0;
         $msg = "لايمكن حذف غرامة تم استلامها ";
       }else{
           $sql = "delete from students_penalty where id = ?";
           $result = setData($con,$sql,[$id]);
           if($result > 0){
              $success = 1;
              $msg = 'تم حذف الغرامة';
           }else{
              $msg = "فشل الحذف";
           }
       }
}else{
  $msg = "فشل الحذف";
  $success = 0;
}
echo json_encode([$res,'success'=>$success, 'msg'=>$msg]);
?>