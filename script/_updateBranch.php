<?php
session_start();
error_reporting(0);
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
$id    = $_REQUEST['e_branch_id'];
$name    = $_REQUEST['e_branch_name'];
$email   = $_REQUEST['e_branch_email'];
$phone   = $_REQUEST['e_branch_phone'];
$note    = $_REQUEST['e_branch_note'];
$serial = $_REQUEST['e_branch_serial'];


$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM branches WHERE name ='".$value."'");
    return ! (bool) count($exists);
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
    'branch_id'    => [$id,    'required|int'],
    'branch_name'  => [$name,  'required|min(2)|max(20)'],
    'branch_email' => [$email, 'email'],
    'branch_phone' => [$phone, "required|isPhoneNumber"],
    'branch_serial'=> [$serial,"required|min(3)|max(4)"],
    'branch_note'  => [$note,  'max(200)']
]);

if($v->passes()) {
  $sql = 'update branches set name = ?, email=?,phone=?,note=?,serial=? where id=?';
  $result = setData($con,$sql,[$name,$email,$phone,$note,$serial,$id]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'id'=> implode($v->errors()->get('branch_id')),
           'name'=> implode($v->errors()->get('branch_name')),
           'email'=>implode($v->errors()->get('branch_email')),
           'phone'=>implode($v->errors()->get('branch_phone')),
           'note'=>implode($v->errors()->get('branch_note')),
           'serial'=>implode($v->errors()->get('branch_serial'))
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>