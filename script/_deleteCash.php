<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1]);
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
       $sql = "select * from cash where id = ?";
       $res = getData($con,$sql,[$id]);
       if($res[0]['confirm'] != '1'){
         $success = 0;
         $msg = "لايمكن حذف النثرية، تم صرفها ";
       }else{
         $sql = "delete from cash where id = ?";
         $result = setData($con,$sql,[$id]);
         if($result > 0){
            $success = 1;
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