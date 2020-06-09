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
$id    = $_REQUEST['e_Group_id'];
$name    = $_REQUEST['e_Group_name'];
$note    = $_REQUEST['e_Group_note'];



$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM groups WHERE name ='".$value."' and id <> '".$GLOBALS['id']."'");
    return ! (bool) count($exists);
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
    'group_id'    => [$id,    'required|int'],
    'group_name'  => [$name,  'required|max(100)|unique'],
    'group_note'  => [$note,  'max(250)']
]);

if($v->passes()) {
  $sql = 'update groups set name = ?, note=? where id=?';
  $result = setData($con,$sql,[$name,$note,$id]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'id'=> implode($v->errors()->get('group_id')),
           'name'=> implode($v->errors()->get('group_name')),
           'note'=>implode($v->errors()->get('group_note')),
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>