<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,4]);
require_once("dbconnection.php");
require_once("_crpt.php");

$success = 0;
$error = [];

$id= $_REQUEST['editMoneyid'];
$reason= $_REQUEST['e_reason'];
$money= $_REQUEST['e_price'];
$note= $_REQUEST['e_note'];
$msg ="خطأ";

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;

$v->addRuleMessage('isPrice', 'المبلغ غير صحيح');

$v->addRule('isPrice', function($value, $input, $args) {
  if(preg_match("/^(0|[1-9]\d*)(\.\d{2})?$/",$value) || empty($value)){
    $x=(bool) 1;
  }
  return   $x;
});
$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب 250 رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'id'  => [$id,'required|int'],
    'reason'  => [$reason,'max(250)'],
    'money'   => [$money, 'required|isPrice'],
    'note'    => [$note,'max(250)'],
]);


if($v->passes())  {
 $sql = "select * from branch_balance where branch_id=? order by date DESC limit 1";
 $balance = getData($con,$sql,[$_SESSION['user_details']['branch_id']]);
 if(count($balance) == 1){
  $bala = ($balance[0]['balance'] + $balance[0]['money']) - $money;
 }else{
  $bala = 0;
 }
 if($bala < $money){
   $msg = "لايوجد مبلغ كافي";
 }else{
   $sql = "update branch_balance set money=?,note=?,reason=? where id=?";
   $res = setData($con,$sql,[$money,$note,$reason,$id]);
   if(count($res) > 0){
     $success = 1;
     $msg = "تم الصرف";
     $sql = "update branch_balance set balance=? order by date DESC limit 1";
     $res = setData($con,$sql,[$bala]);
   }
 }
}else{
  $error = [
           'reason'=> implode($v->errors()->get('reason')),
           'price'=> implode($v->errors()->get('money')),
           'note'=> implode($v->errors()->get('note')),
           'msg'=>$msg
           ];
}

echo json_encode([$bala,'success'=>$success, 'error'=>$error]);?>