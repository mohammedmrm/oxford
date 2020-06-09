<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,4]);
require_once("dbconnection.php");
require_once("_vaildFile.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$student = $_REQUEST['student_id'];
$success = 0;
$v->validate([
    'student'=> [$student,'required|int'],
]);
if($v->passes()){
  $sql = "select *, DATE_FORMAT(date,'%Y-%m-%d') as date from payment where student_id=?";
  $paysdetials = getData($con,$sql,[$student]);
  if(count($paysdetials) >= 1){
    $success = 1;
    $sql = 'select * from students where id=?';
    $ex = getData($con,$sql,[$student]);
    $extra = $ex[0]['extra_fee'];
  }
}

echo json_encode(['extra'=>$extra,"paysdetials"=>$paysdetials,'success'=>$success, 'error'=>$error]);
?>