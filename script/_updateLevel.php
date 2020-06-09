<?php
session_start();
//error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2]);
require_once("dbconnection.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$id    = $_REQUEST['e_level_id'];
$name    = $_REQUEST['e_level_name'];
$note    = $_REQUEST['e_level_note'];
$price = $_REQUEST['e_level_price'];


$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM levels WHERE name ='".$value."'");
    return ! (bool) count($exists);
});
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
    'level_id'    => [$id,    'required|int'],
    'level_name'  => [$name,  'required|min(2)|max(20)'],
    'level_price' => [$price, 'required|isPrice'],
    'level_note'  => [$note,  'max(200)']
]);

if($v->passes()) {
  $sql = 'update levels set name = ?, price=?,note=? where id=?';
  $result = setData($con,$sql,[$name,$price,$note,$id]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'id'=> implode($v->errors()->get('level_id')),
           'name'=> implode($v->errors()->get('level_name')),
           'note'=>implode($v->errors()->get('level_note')),
           'price'=>implode($v->errors()->get('level_price'))
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>