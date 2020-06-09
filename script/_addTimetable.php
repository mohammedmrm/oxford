<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,4,3]);
require_once("dbconnection.php");
require_once("_crpt.php");

use Violin\Violin;
require_once('../validator/autoload.php');
$v = new Violin;


$success = 0;
$error = [];
$lecture    = $_REQUEST['lecture'];
$group  = $_REQUEST['group'];
$teacher   = $_REQUEST['teacher'];
$day   = $_REQUEST['day'];
$start = $_REQUEST['start_time'];
$end= $_REQUEST['end_time'];
$branch = $_SESSION['user_details']["branch_id"];

$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'      => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
    'email'      => 'البريد الالكتروني غيز صحيح',
]);

$v->validate([
    'lecture' => [$lecture,  'required|min(3)|max(200)'],
    'group'   => [$group, 'required|int'],
    'teacher' => [$teacher, "required|int"],
    'day'     => [$day,  "required|int|max(1)"],
]);


$start_err = "";
if(!validateDate($start,'H:i')){
  $start_err = "الوقت غير صحيح";
}
$end_err = "";
if(!validateDate($end,'H:i')){
  $end_err = "الوقت غير صحيح";
}
$time_err = "";
if(empty($start) || empty($end)){
 $time_err = " يجب ادخال وقت البداية والنهاية";
}else{
    $vaildtime = "select * from timetable where (
    (branch_id ='".$branch."' and day = '".$day."') and
    (teacher_id='".$teacher."' or group_id='".$group."')
    ) and
    (
     start      between '".$start."' and '".$end."' or
     end        between '".$start."' and '".$end."' or
     '".$start."' between start and end or
     '".$end."'   between start and end
    )";
    $vaildtimeresult = getData($con,$vaildtime);
    if(count($vaildtimeresult) > 0 ){
      $time_err = "هناك خطاء في الفترة الزمنية بسبب حدوث تداخل مع محاضرات اخرى";
    }else{
      $time_err = "";
    }
}
if($v->passes() && $end_err == "" && $start_err=="" && $time_err == "")  {
  $sql = 'insert into timetable (name,branch_id,teacher_id,start,end,group_id,day) values
                             (?,?,?,?,?,?,?)';
  $result = setData($con,$sql,[$lecture,$branch,$teacher,$start,$end,$group,$day]);
  if($result > 0){
    $success = 1;
  }
}else{
  $error = [
           'lecture'=> implode($v->errors()->get('lecture')),
           'branch'=>implode($v->errors()->get('branch')),
           'teacher'=>implode($v->errors()->get('teacher')),
           'group'=>implode($v->errors()->get('group')),
           'day'=>implode($v->errors()->get('day')),
           'start'=>$start_err ,
           'end'=>$end_err ,
           'time'=>$time_err,
           ];
}
echo json_encode([$vaildtime,'success'=>$success, 'error'=>$error]);
?>