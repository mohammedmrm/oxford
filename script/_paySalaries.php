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
$year    = date("Y");
$branch = $_REQUEST['id'];
$month  = $_REQUEST['month'];


$v->addRuleMessages([
    'required' => 'الحقل مطلوب',
    'int'      => 'فقط الارقام مسموع بها',
    'regex'    => 'فقط الارقام مسموع بها',
    'min'      => 'قصير جداً',
    'max'      => 'مسموح ب {value} رمز كحد اعلى ',
]);

$v->validate([
    'month'  => [$month, 'required|int|max(2)'],
    'branch' => [$branch,"required|int"],
]);


$sccuss = 0;
$paid =0;
$paysdetails =[];
if($v->passes())  {
    $now = date("Y-m-d H:i:s");
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $start_date = $year."-".$month."-01";
    $end_date = $year."-".$month."-".$days;
    $sql = 'select  ROUND(sum((staff.salary/'.$days.') * if(datediff("'.$end_date.'", staff.date) > '.$days.','.$days.',datediff("'.$end_date.'", staff.date))
                 - (if (a.leave_days > 0 ,a.leave_days,0) * (staff.salary/'.$days.'))
                 ),2) as salaries, count(*) as staffnumber,branches.id as b_id ,
  branches.name as branch_name,  if(max(salary_pays.confirm) IS NULL,0,max(salary_pays.confirm)) as status,
  max(salary_pays.id) as pay_id
  from staff
  inner join branches on branches.id = staff.branch_id
  left join salary_pays on salary_pays.branch_id = staff.branch_id  and  salary_pays.year = "'.$year.'"  and  salary_pays.month = "'.$month.'"

  left join
  ( select
                    if(
                     sum(
                          if(staff_leave.start_date <  "'.$end_date.'",
                            if(staff_leave.end_date > "'.$end_date.'",'.$days.',datediff(staff_leave.end_date,staff_leave.start_date)),
                            if(staff_leave.end_date < "'.$end_date.'",datediff(staff_leave.end_date,"'.$start_date.'"),datediff("'.$end_date.'",staff_leave.start_date))
                            )
                        ) is NULL,0,
                     sum(
                          if(staff_leave.start_date <  "'.$end_date.'",
                            if(staff_leave.end_date > "'.$end_date.'",'.$days.',datediff(staff_leave.end_date,staff_leave.start_date)+1),
                            if(staff_leave.end_date < "'.$end_date.'",datediff(staff_leave.end_date,"'.$start_date.'")+1,datediff("'.$end_date.'",staff_leave.start_date)+1)
                            )
                        )
                        ) as leave_days,max(staff_id) as s_id
   FROM    staff_leave
   where staff_leave.start_date >= "'.$start_date.'" and staff_leave.end_date <= "'.$end_date.'"  and with_salary <> 1
   group by staff_id
  ) a on a.s_id = staff.id

  where staff.branch_id = "'.$branch.'"
  group by staff.branch_id';
      $counts = getData($con,$sql);
        $sql = "select * from salary_pays where month = ? and year=? and branch_id=?";
        $check = getData($con,$sql,[$month,$year,$branch]);
        if(count($check) == 0){
          $sql = "insert into salary_pays (staff_number,branch_id,money,confirm,month,year) values(?,?,?,?,?,?)";
          $pay = setData($con,$sql,[$counts[0]['staffnumber'],$branch,$counts[0]['salaries'],'1',$month,$year]);
          if($pay){
            $success = 1;
            $msg = "تم اعطاء امر بالصرف";
          }else{
            $msg = "حصل خطأ";
          }
        }else{
            $msg = "تم الصرف مسبقاً";
        }

}else{
  $error = [
           'year'=> implode($v->errors()->get('year')),
           'month'=>implode($v->errors()->get('month')),
           'branch'=>implode($v->errors()->get('branch')),
           ];
           if(implode($v->errors()->get('month')) != ""){
            $msg = 'يجب اختيار الشهر';
           }

}

echo json_encode([$branch,"msg"=>$msg,'success'=>$success, 'error'=>$error]);
?>