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
$student    = $_REQUEST['paysStudent_id'];
$payment_type    = $_REQUEST['Newpayment_type'];

$PayPrice = $_REQUEST['NewPayPrice'];
$PayDate = $_REQUEST['NewPayDate'];
$extra =   $_REQUEST['e_extra'];

$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
]);
$v->addRuleMessage('isPrice', 'المبلغ غير صحيح');

$v->addRule('isPrice', function($value, $input, $args) {
  if(preg_match("/^(0|[1-9]\d*)(\.\d{2})?$/",$value) || empty($value)){
    $x=(bool) 1;
  }
  return   $x;
});
$v->validate([
    'student'    => [$student,    'required|int'],
    'payment_type'=> [$payment_type,'required|int'],
    'extra'   => [$extra,   'isPrice'],

]);
if(empty($extra)){
  $extra = 0;
}
// ---- pays vaildation ---
if($student > 0){
$sql = "select * from students where id = ?";
$price = getData($con,$sql,[$student]);

$sql = "select sum(amount) as price from payment where student_id = ? and confirm=2";
$paidprice = getData($con,$sql,[$student]);
if($paidprice[0]['price'] == ""){
  $paidprice[0]['price'] =  0;
}
}
if($payment_type == 2){
   if(empty($PayPrice)){
     $pays_err = "يجب اضافة الاقساط";
   }else{
     if(count($PayPrice) > 4){
      $pays_err = "يسمح بتقسيم المبلغ الى ثلاث اقساط فقط";
     }else if(count($PayPrice) != count($PayDate)){
      $pays_err = "خطأ بتطابق الاقساط مع التواريخ";
     }else if((($price[0]['total_price'] - $paidprice[0]['price']) + $extra) != array_sum($PayPrice)){
        $pays_err = "مجموع الاقساط لايساوي المبلغ المتبقي المطلوب (".($price[0]['total_price'] - $paidprice[0]['price'] + $extra).")";
     }else{
       $now  = new DateTime();
       for($i=0; $i < count($PayPrice); $i++){
         $date = new DateTime($PayDate[$i]);
        if(!preg_match("/^\d+(\.\d{2})?$/",$PayPrice[$i])){
          $pays_err = "هناك خطأ بمبلغ القسط ".($i+1);
          break;
        }else if(!validateDate($PayDate[$i])){
          $pays_err = "هناك خطأ بتاريخ القسط ". ($i+1);
          break;
        }else if($date < $now){
          $pays_err = "هناك خطأ بتاريخ القسط *".($i+1);
          break;
        }else{
          $pays_err = "";
        }
       }
     }
   }
}else{
  $pays_err = "";
}
if(($price[0]['total_price'] - $paidprice[0]['price']) + $extra <= 0){
  $pays_err = "<h1>لايوجد اي مبالغ مستحقه!</h1>";
}
if($v->passes() && $pays_err == "") {
   $sql = "select payment_type from students where id=?";
   $oldpayment_type = getData($con,$sql,[$student]);
   if($oldpayment_type[0]['payment_type'] != $payment_type){
     $sql = "update students set payment_type=? where id=?";
     $update = setData($con,$sql,[$payment_type,$student]);
   }else{
     $update =1;
     $sql = "update students set extra_fee=? where id=?";
     $update = setData($con,$sql,[$extra,$student]);
   }
  if((bool) $update){
      $success = 1;
    $sql = "delete from payment where student_id=? and confirm <> 2";
    $result = setData($con,$sql,[$student]);
    if($payment_type == 2){
       for($i=0; $i < count($PayPrice); $i++){
            $sql = "insert into payment (amount,date,student_id) values(?,?,?)";
            $result = setData($con,$sql,[$PayPrice[$i],$PayDate[$i],$student]);

       }
    }else{

            $sql = "insert into payment (amount,date,student_id) values(?,?,?)";
            $result = setData($con,$sql,[($price[0]['total_price'] - $paidprice[0]['price'] + $extra),date('Y-m-d'),$student]);
    }
  }
}else{
    $error = [
             'student'=> implode($v->errors()->get('student')),
             'payment_type'=> implode($v->errors()->get('payment_type')),
             'pays_err'=>$pays_err,
             ];
}

echo json_encode([$update,'success'=>$success, 'error'=>$error]);
?>