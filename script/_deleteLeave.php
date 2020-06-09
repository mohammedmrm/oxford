<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,4]);
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
       $sql = "select * from staff_leave where id = ?";
       $res = getData($con,$sql,[$id]);
       if($res[0]['confirm'] == '1'){
         $success = 0;
         $msg = "لايمكن حذف اجازة تم تاكيدها";
       }else{
         $sql = "delete from staff_leave where id = ?";
         $result = setData($con,$sql,[$id]);
         if($result > 0){
            $success = 1;
            $msg = "تم حذف الاجازة";
         }else{
            $msg = "فشل الحذف";
         }

       }
}else{
  $msg = "فشل الحذف";
  $success = 0;
}
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>