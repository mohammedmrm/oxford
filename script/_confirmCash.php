<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2]);
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
       $sql = "select * from cash where id = '".$id."'";
       $cash = getData($con,$sql);
       if(count($cash) <= 0){
         $success = 0;
         $msg = "هناك خطأ بالمعلومات";
       }else if($cash[0]['confirm'] == 2){
         $msg = "تم تاكيد القسط مسبقاً";
       }else{
         $sql = "update cash set confirm=? where id = ?";
         $update = setData($con,$sql,['2',$id]);
         if($update > 0){
            $success = 1;
            $msg = "تم تاكيد المبلغ";
            $sql = "select * from balance order by id DESC limit 1";
            $balance = getData($con,$sql);
            if(count($balance) == 1){
              $sql = "insert into balance (branch_id,balance,money,reason,note,status)
              values(?,?,?,?,?,?)";
              $result = setData($con,$sql,[$cash[0]['branch_id'],
              $balance[0]['balance'] - $cash[0]['money'],
              $cash[0]['money'],'نثرية',
              '','0']);

            }else if(count($balance) == 0){
              $sql = "insert into balance (branch_id,balance,money,reason,note,status)
              values(?,?,?,?,?,?)";
              $result = setData($con,$sql,[$cash[0]['branch_id'],
              0 - $cash[0]['money'],
              $cash[0]['money'],'نثرية',
              '','0']);
            }

           $sql = "select * from branch_balance where branch_id=? order by date DESC limit 1";
           $balance = getData($con,$sql,[$_SESSION['user_details']['branch_id']]);
           if(count($balance) == 1){
            $bala = $balance[0]['balance'] + $cash[0]['money'];
           }else{
            $bala = $cash[0]['money'];
           }
           $sql = "insert into branch_balance (status,branch_id,money,note,balance) values (?,?,?,?,?)";
           $branch_balance = setData($con,$sql,["1",$_SESSION['user_details']['branch_id'],$cash[0]['money'],$cash[0]['note'],$bala]);

         }else{
            $msg = "فشل التاكيد";
         }

       }
}else{
  $msg = "فشل الحذف";
  $success = 0;
}
echo json_encode([$balance,'success'=>$success, 'msg'=>$msg]);
?>