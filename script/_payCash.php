<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1]);
require_once("dbconnection.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];

$branch= trim($_REQUEST['a_branch']);
$money = trim($_REQUEST['a_price']);
$note= trim($_REQUEST['a_note']);

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
    'branch'  => [$branch,'required|int'],
    'money'   => [$money, 'required|isPrice'],
    'note'    => [$branch,'max(250)'],
]);


if($v->passes())  {
 $sql = "insert into cash (branch_id,money,note,confirm) values (?,?,?,?)";
 $res = setData($con,$sql,[$branch,$money,$note,'1']);
 if(count($res) > 0){
   $success = 1;

 }
}else{
  $error = [
           'branch'=> implode($v->errors()->get('branch')),
           'price'=> implode($v->errors()->get('money')),
           'note'=> implode($v->errors()->get('note')),
           ];
}

echo json_encode(["data"=>$res,'success'=>$success, 'error'=>$error]);
?>