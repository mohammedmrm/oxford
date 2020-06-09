<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,4]);
require_once("dbconnection.php");


use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$branch= $_SESSION['user_details']['branch_id'];
$name  = $_REQUEST['Group_name'];
$note  = $_REQUEST['Group_note'];

$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {
    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM groups WHERE name ='".$value."' and branch_id = '".$_SESSION['user_details']['branch_id']."'");
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
    'name'   => [$name,  'required|unique'],
    'branch' => [$branch,'required|int'],
    'note'   => [$note,  "max(250)"],
]);

if($v->passes()) {
  $sql = 'insert into groups (name,branch_id,note) values
                             (?,?,?)';
  $result = setData($con,$sql,[$name,$branch,$note]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'name'=> implode($v->errors()->get('name')),
           'branch'=>implode($v->errors()->get('price')),
           'note'=>implode($v->errors()->get('note')),
           ];
}
echo json_encode(['success'=>$success, 'error'=>$error]);
?>