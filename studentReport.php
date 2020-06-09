<?php

session_start();
//error_reporting(0);
require_once("script/_access.php");
access([1,2,4,3,5]);
require_once("script/dbconnection.php");
$id = $_REQUEST['id'];
try{
  $query = "select students.*,sum(if(payment.confirm <> 2,payment.amount,0)) as remain, branches.name as branch_name,
             DATE_FORMAT(students.date,'%Y/%m/%d') as date,
             levels.name as level_name,
             staff.name as staff_name,
             students.name as student_name
            from students
            left join branches on branches.id = students.branch_id
            left join levels on levels.id = students.level_id
            left join staff on staff.id = students.manager_id
            left join payment on payment.student_id = students.id
            where students.id = ? group by students.id
            ";
            $data = getData($con,$query,[$id]);

  $success="1";
  $student = $data[0];
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}


?>

<link href="bootstrap-4.3.1-dist1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<style>
@media print {
  body * :not(#section-to-print *){
    visibility: hidden;
    display: none;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;

  }
  #section-to-print {
   margin: 0px !important;
  }
  .print{
    display: none;
  }

}
/* arabic */
@font-face {
  font-family: 'Cairo';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: local('Cairo'), local('Cairo-Regular'), url(Cairofont.woff2) format('woff2');
  unicode-range: U+0600-06FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE80-FEFC;
}
/* latin-ext */
@font-face {
  font-family: 'Cairo';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: local('Cairo'), local('Cairo-Regular'), url(Cairofont.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}

body * :not(.signture) {
  font-family: 'Cairo', sans-serif !important;
}
body {
  font-size: 15px;
  line-height: 1;
  direction: rtl;
}


 h3 {
   margin-bottom: 5px;
 }


.logo{
  background-image: url(img/logos/logo.png);
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
  height: 100px;
}


.print {
  position: absolute;
  left: 10;
  width:200px;
  margin: 0;
  padding:10px;
}
.print button{
  background-color: #33CC00;
  border-radius: 10px;
  outline: none;
  width:100%;
  color:#FFFFFF;
  font-size:20px;
}
.container {
  width:850px;
  background-color: #FFFFFF;
  margin: auto;
  margin-right: 10px;
  position: absolute;
  background-image: url(img/logos/bg-logo.png);
  background-position: center;
  background-repeat: no-repeat;
  background-size: 70%;
  border: 1px #888888 solid;
  border-radius: 10px;
}

</style>
<div class="print">
 <button type="button" class="btn" onclick="print()">طباعة</button>
</div>
<div class="container" id="section-to-print">
     <div class='row' dir="ltr">
        <div class='col-sm-4 text-center'>
         <h4 style="color:#CC0033"><b>Oxford EST.</b></h4>
         <h5 style="color:#555555">for language learning & Development</h5>
        </div>
        <div class='col-sm-4 logo text-center'></div>

        <div class='col-sm-4 text-center'>
         <h4 style="color:#CC0033"><b>مؤسسة  اكسفورد</b></h4>
         <h5 style="color:#555555" >الـــــــــــــــــــــدولية<br /> للغات والتطوير</h5>
        </div>

     </div>
     <div class='row' dir="ltr"><hr /></div>
     <div class='row' dir="ltr">
        <div class='col-sm-10'>
          <h5><span>NO:</span><span class="text-info" id="student_number"><?php echo " ".$student['student_number']?></span></h5>

          <h5><span>Branch:</span><span class="text-info"><?php echo " ".$student['branch_name']?></span></h5>

          <h5><span>Date:</span><span class="text-info"><?php echo " ".$student['date']?></span></h5>
        </div>
        <div class='col-sm-2 text-center'>
          <img src="img/student/<?php echo $student['img']?>" class="img-thumbnail "/>
        </div>
     </div>
     <div class='row' dir="ltr">
     <hr />
     </div>
     <div class='row' dir="ltr">
           <div class='col-sm-12 ' dir="ltr">
              <label><h6>Name of The Applicant (اسم مقدم الطلب):</h6></label>
              <label class="cell"><b><?php echo $student['name']?></b></label>
            </div>
            <div class='col-sm-12' dir="ltr">
              <label><h6>Date Of Birth (تاريخ الولادة) (Y-m-d):</h6></label>
              <label class="cell"><b><?php echo $student['birthday']?></b></label>
             </div>
            <div class='col-sm-12' dir="ltr">
              <label><h6>Gender (الجنس):</h6></label>
              <label class="cell"><b><?php if($student['gender'] == 1){echo "✓ Male";}else {echo "✓ Female";}?></b></label><br />
            </div>
      </div>
        <hr />
      <div class='row' dir="rtl">
          <div class='col-md-6'>
            <span class="text-break text-danger h4 text-left">الغرامات</span>
            <table class="table table-bordered">
             <tr>
              <th>المبلغ</th>
              <th>التاريخ</th>
              <th>السبب</th>
             </tr>
            <thead>
            <tr>

            </tr>
            </thead>
            <tbody>
            <?php
             $sql = "select *,date_format(date,'%Y-%m-%d') as date from students_penalty where student_id=?";
             $data = getData($con,$sql,[$id]);

             foreach ($data as $v){
               echo '<tr>';
               echo '<td>'.$v['amount'].'</td>';
               echo '<td>'.$v['date'].'</td>';
               echo '<td>'.$v['note'].'</td>';
               echo '</tr>';
              }
            ?>
            </tbody>
            </table>
          </div>
          <div class='col-md-6 border-right border-success'>
            <span class="text-break text-danger h4 text-left">حالات الطالب</span>
            <table class="table table-bordered">
             <tr>
              <th>الحالة</th>
              <th>تاريخها</th>
             </tr>
            <thead>
            <tr>

            </tr>
            </thead>
            <tbody>
            <?php
             $sql = "select *,date_format(students_status_tracking.date,'%Y-%m-%d') as date from students_status_tracking
              left join students_status on  students_status.id = students_status_tracking.students_status_id
              where student_id=?";
             $data = getData($con,$sql,[$id]);

             foreach ($data as $v){
               echo '<tr>';
               echo '<td>'.$v['name'].'</td>';
               echo '<td>'.$v['date'].'</td>';
               echo '</tr>';
              }
            ?>
            </tbody>
            </table>
          </div>
      </div>
      <div class='row' dir="rtl">
          <div class='col-md-12'>
            <span class="text-break text-danger h4 text-right">التقيمات</span>
            <table class="table table-bordered">
             <tr>
              <th>اسم المحاضرة</th>
              <th>تاريخها</th>
              <th>الحضور</th>
              <th>الواجب البيتي</th>
              <th>الدرجه من 10</th>
              <th>ملاحظات</th>
             </tr>
            <thead>
            <tr>

            </tr>
            </thead>
            <tbody>
            <?php
             $sql = "select *,timetable.name as lecture_name,students_leave.id as l_id,
                     date_format(students_evalution.lecture_date,'%Y-%m-%d')  as lecture_date
                     from students_evalution
                     left join timetable on timetable.id = students_evalution.lecture
                     left join students_leave on students_evalution.student_id = students_leave.student_id and
                     students_evalution.lecture_date between date_format(students_leave.start,'%Y-%m-%d') and date_format(students_leave.end,'%Y-%m-%d')
              where students_evalution.student_id=?";
             $data = getData($con,$sql,[$id]);

             foreach ($data as $v){
               if(!($v['l_id'] > 0)){
                   if($v['homework'] == 1){
                     $v['homework'] = 'منجز';
                   }else if($v['homework'] == 2) {
                     $v['homework'] = 'نصف منجز';
                   }else{
                     $v['homework'] = 'غير منجز';
                   }
                   if($v['attendance'] == 1){
                     $v['attendance'] = 'حاضر';
                   }else if($v['attendance'] == 2) {
                     $v['attendance'] = 'متاخر';
                   }else{
                     $v['attendance'] = 'غائب';
                   }
               }else{
                  $v['attendance'] = 'مجاز';
                  $v['homework'] = '/';
                  $v['grade'] = '/';
               }
               echo '<tr>';
               echo '<td>'.$v['lecture_name'].'</td>';
               echo '<td>'.$v['lecture_date'].'</td>';
               echo '<td>'.$v['attendance'].'</td>';
               echo '<td>'.$v['homework'].'</td>';
               echo '<td>'.$v['grade'].'</td>';
               echo '<td>'.$v['note'].'</td>';
               echo '</tr>';
              }
            ?>
            </tbody>
            </table>
          </div>
      </div>
</div>
<script>

</script>