<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([3]);
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
       $sql = "select * from staff_leave where id = '".$id."'";
       $cash = getData($con,$sql);
       if(count($cash) <= 0){
         $success = 0;
         $msg = "هناك خطأ بالمعلومات";
       }else if($cash[0]['confirm'] == 1){
         $msg = "تم تاكيد  مسبقاً";
       }else{
         $sql = "update staff_leave set confirm=? where id = ?";
         $update = setData($con,$sql,['1',$id]);
         if($update > 0){
            $success = 1;
            $msg = "تم تاكيد المبلغ";
         }else{
            $msg = "فشل";
         }

       }
}else{
  $msg = "فشل";
  $success = 0;
}
echo json_encode(['success'=>$success, 'msg'=>$msg]);
?>