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
$id    = $_REQUEST['editcashid'];
$branch    = $_REQUEST['e_branch'];
$price   = $_REQUEST['e_price'];
$note    = $_REQUEST['e_note'];

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
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'id'    => [$id,    'required|int'],
    'branch'=> [$branch,'required|int'],
    'price' => [$price,  'required|isPrice'],
    'note'  => [$note, 'max(250)'],
]);

if($v->passes()) {
  $sql = "select * from cash where id=?";
  $check = getData($con,$sql,[$id]);
  if($check[0]['confirm'] == 1){
    $sql = 'update cash set branch_id = ?, money=?,note=? where id=?';
    $result = setData($con,$sql,[$branch,$price,$note,$id]);
    if($result > 0){
      $success = 1;
    }else {
      $msg = "حدث خطأ";
    }
  }else {
    $msg ='لايمكن التعديل';
  }
}else{
  $msg ='خطأ';
  $error = [
           'id'=> implode($v->errors()->get('id')),
           'branch'=> implode($v->errors()->get('branch')),
           'price'=>implode($v->errors()->get('price')),
           'note'=>implode($v->errors()->get('note')),
           ];
}
echo json_encode([$_POST,'success'=>$success, 'error'=>$error,'msg'=>$msg]);
?>