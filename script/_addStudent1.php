<?php
session_start();
//error_reporting(0);
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
$name    = $_REQUEST['name'];
$birthday   = $_REQUEST['birthday'];
$phone   = $_REQUEST['phone'];
$gender  = $_REQUEST['gender'];
$group  = $_REQUEST['group'];
$student_number  = $_REQUEST['reg_number'];
$serial  = $_REQUEST['serial'];
$payment_type  = $_REQUEST['payment_type'];
$level  = $_REQUEST['level'];
$reg_fee  = $_REQUEST['reg_fee'];
$address  = $_REQUEST['address'];
$gran_name  = $_REQUEST['gran_name'];
$gran_phone  = $_REQUEST['gran_phone'];
$lngs  = $_REQUEST['lngs'];
$cer  = $_REQUEST['cer'];
$discount  = $_REQUEST['discount'];

$img = $_FILES['img'];
$passport = $_FILES['passport'];
$id1 = $_FILES['id1'];
$id2 = $_FILES['id2'];
$id3 = $_FILES['id3'];

$img_err = image($img);
$passport_err = image($passport);
$id1_err = image($id1);
$id2_err = image($id2);
$id3_err = image($id3);

$PayPrice = $_REQUEST['PayPrice'];
$PayDate = $_REQUEST['PayDate'];

$v->addRuleMessage('isPhoneNumber', ' رقم هاتف غير صحيح  ');

$v->addRule('isPhoneNumber', function($value, $input, $args) {
    return   (bool) preg_match("/^[0-9]{10,15}$/",$value);
});
$v->addRuleMessage('unique', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM students WHERE student_number  ='".$value."'");
    return ! (bool) count($exists);
});
$v->addRuleMessage('unique2', 'القيمة المدخلة مستخدمة بالفعل ');

$v->addRule('unique2', function($value, $input, $args) {

    $value  = trim($value);
    $exists = getData($GLOBALS['con'],"SELECT * FROM students WHERE serial  ='".$value."' and branch_id = '".$_SESSION['user_details']['branch_id']."'");
    return ! (bool) count($exists);
});
$v->addRuleMessages([
    'required' => ' الحقل مطلوب ',
    'int'      => ' فقط الارقام مسموع بها ',
    'regex'      => ' فقط الارقام مسموع بها ',
    'min'      => ' قصير جداً ',
    'max'      => ' البيانات المدخلة كبير جداً ',
    'email'      => ' البريد الالكتروني غيز صحيح ',
]);
$v->addRuleMessage('isPrice', ' المبلغ غير صحيح ');

$v->addRule('isPrice', function($value, $input, $args) {
  if(preg_match("/^(0|[1-9]\d*)(\.\d{2})?$/",$value)){
    $x=(bool) 1;
  }
  return   $x;
});
$v->validate([
    'name'    => [$name,    'required|min(4)|max(50)'],
    'gender'   => [$gender,   'required|int'],
    'group'   => [$group,   'required|int'],
    'phone'   => [$phone,   "required|isPhoneNumber"],
    'birthday'  => [$birthday,  'required'],
    'payment_type' => [$payment_type,    'required|int|min(1)|max(1)'],
    'student_number' => [$student_number,    'required|unique'],
    'serial' => [$serial,    'required'],
    'level' => [$level,    'required|int'],
    'address' => [$address,  'required|max(250)'],
    'gran_name' => [$gran_name,    'required|max(200)'],
    'gran_phone' => [$gran_phone,    'required|isPhoneNumber'],
    'lngs' => [$lngs,    'max(250)'],
    'cer' => [$cer,    'max(250)'],
    'reg_fee' => [$reg_fee,    'isPrice'],
    'discount' => [$discount,    'isPrice'],
]);
// ---- pays vaildation ---

if($level > 0){
$sql = "select * from levels where id = ?";
$levelprice = getData($con,$sql,[$level]);
}
$extra_fee =0;
if(count($PayPrice) == 2){
    $extra_fee = 50;
}else if(count($PayPrice) == 3){
    $extra_fee = 100;
}
if($payment_type == 2 && !empty($level)){
   if(empty($PayPrice)){
     $pays_err = "يجب اضافة الاقساط";
   }else{
     if(count($PayPrice) > 4){
      $pays_err = "يسمح بتقسيم المبلغ الى ثلاث اقساط فقط";
     }else if(count($PayPrice) != count($PayDate)){
      $pays_err = "خطأ بتطابق الاقساط مع التواريخ";
     }else if(($levelprice[0]['price']-$discount+$extra_fee) != array_sum($PayPrice)){
        $pays_err = "مجموع الاقساط لايساوي سعر المستوى المحدد ".($levelprice[0]['price']-$discount)." و اجور اقساط اضافية ".$extra_fee;
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
        }else if($date <= $now){
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
if(empty($discount)){
  $discount = 0;
}
if($config[0]['maxDiscount'] < $discount ){
  $disscont_err = "اقصى مبلغ مسموح به (".$config[0]['maxDiscount'].")";
}else{
 $disscont_err = implode($v->errors()->get('discount'));
}
if($v->passes() && ($disscont_err=="" || empty($disscont_err)) && ($img_err == "" || empty($img_err)) && ($passport_err == "" || empty($passport_err)) && ($pays_err == "" || empty($pays_err))) {
  try{
  if($img['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/img/", 0700);
    $destination = "../img/student/img/".$id.".jpg";
    $imgPath = "img/".$id.".jpg";
    move_uploaded_file($img["tmp_name"], $destination);
  }else{
    $imgPath = "_";
  }
  if($passport['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/passport/", 0700);
    $destination = "../img/student/passport/".$id.".jpg";
    $passportPath = "passport/".$id.".jpg";
    move_uploaded_file($passport["tmp_name"], $destination);
  }else{
    $passportPath ="_";
  }
  if($id1['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/id1/", 0700);
    $destination = "../img/student/id1/".$id.".jpg";
    $id1Path = "id1/".$id.".jpg";
    move_uploaded_file($id1["tmp_name"], $destination);
  }else{
    $id1Path ="_";
  }
    if($id2['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/id2/", 0700);
    $destination = "../img/student/id2/".$id.".jpg";
    $id2Path = "id2/".$id.".jpg";
    move_uploaded_file($id2["tmp_name"], $destination);
  }else{
    $id2Path ="_";
  }
    if($id3['size'] != 0){
    $id = uniqid();
    mkdir("../img/student/id3/", 0700);
    $destination = "../img/student/id3/".$id.".jpg";
    $id3Path = "id3/".$id.".jpg";
    move_uploaded_file($id3["tmp_name"], $destination);
  }else{
    $id3Path ="_";
  }

  $sql = 'insert into students (address,reg_fee,gran_name,gran_phone,discount,total_price,level_id,manager_id,branch_id,name,phone,gender,birthday,payment_type,
                             student_number,serial,img,passport,id1,id2,id3,extra_fee,group_id,lngs,cer) values
                             (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
  $result = setData($con,$sql,[$address,$reg_fee,$gran_name,$gran_phone,$discount,$levelprice[0]['price'],$level,$_SESSION['userid'],$_SESSION['user_details']['branch_id'],$name,$phone,$gender,$birthday,$payment_type,
                               $student_number,$serial,$imgPath,
                               $passportPath,$id1Path,$id2Path,$id3Path,$extra_fee,$group,$lngs,$cer]);
  if($result > 0){
    $success = 1;
    if($payment_type == 2){
       for($i=0; $i < count($PayPrice); $i++){
            $sql = "select * from students where student_number = ? and phone = ?";
            $student_id = getData($con,$sql,[$student_number,$phone]);
            $sql = "insert into payment (amount,date,student_id) values(?,?,?)";
            $result = setData($con,$sql,[$PayPrice[$i],$PayDate[$i],$student_id[0]['id']]);
       }
    }else{
            $sql = "select * from students where student_number = ? and phone = ?";
            $student_id = getData($con,$sql,[$student_number,$phone]);
            $sql = "insert into payment (amount,date,student_id) values(?,?,?)";
            $result = setData($con,$sql,[$levelprice[0]['price'],date('Y-m-d'),$student_id[0]['id']]);
    }
          $status_track = 'insert into students_status_tracking (student_id,students_status_id) values(?,?)';
          $track = setData($con,$status_track,[$student_id[0]['id'],'1']);
  }
  }catch(PDOEXCEPTION $e){
   $error = $e;
  }
}else{
  $error = [
           'name'=> implode($v->errors()->get('name')),
           'gender'=>implode($v->errors()->get('gender')),
           'group'=>implode($v->errors()->get('group')),
           'phone'=>implode($v->errors()->get('phone')),
           'birthday'=>implode($v->errors()->get('birthday')),
           'payment_type'=>implode($v->errors()->get('payment_type')),
           'student_number'=>implode($v->errors()->get('reg_number')),
           'serial'=>implode($v->errors()->get('serial')),
           'level'=>implode($v->errors()->get('level')),
           'address'=>implode($v->errors()->get('address')),
           'gran_name'=>implode($v->errors()->get('gran_name')),
           'gran_phone'=>implode($v->errors()->get('gran_phone')),
           'lngs'=>implode($v->errors()->get('lngs')),
           'cer'=>implode($v->errors()->get('cer')),
           'reg_fee'=>implode($v->errors()->get('reg_fee')),
           'discount'=>$disscont_err,
           'img'=>$img_err,
           'passport'=>$passport_err,
           'id1'=>$id1_err,
           'id2'=>$id2_err,
           'id3'=>$id3_err,
           'pays_err'=>$pays_err,
           ];
}
echo json_encode([$config[0]['maxDiscount'],'success'=>$success, 'error'=>$error]);
?>