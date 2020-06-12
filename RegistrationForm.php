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

.col-2 {
  width:50%;
  min-height: 3px;
  float: left;
  position: relative;
  text-align: left;
}
.col-2 span {
  color: #CC0000;
  font-size:16px;
  margin: 4px;
  margin-bottom: 20px;
}
.col-3 {
  width:33.333333333%;
  min-height: 3px;
  float: left;
  position: relative;
}
.col-3 * {
  padding-left: 10px;
  padding-right: 10px;
  text-align: center;
}
 h3 {
   margin-bottom: 5px;
 }

.col {
  width:100%;
  min-height: 3px;
  float: left;
  position: relative;
  border-bottom: 2px #CC0033 double;
}
.col-1 {
  width:100%;
  min-height: 3px;
  float: left;
  position: relative;
  line-height: 1.5;
}
.col-1 span {
  color: #CC0000;
  font-weight: bold;
  padding-right: 10px;
  padding-top: 15px;
  padding-left: 10px;
  position: relative;
}
.col-1 label,.col-1 pre {
  color: #000;
  font-weight:bold;
  padding-right: 15px;
  padding-left: 15px;
  padding-top: 10px;
  display: inline-block;
  width: 360px;
  min-width: 100px;
  position: relative;
}
ul {
  list-style: disc;
}

ul li {
  line-height: 1.5;
  padding-right: 15px;
  padding-left: 15px;
  margin-bottom:3px;
}

.logo{
  background-image: url(img/logos/logo.png);
  background-position: center;
  background-repeat: no-repeat;
  background-size: contain;
  height: 100px;
}

.container {
  width:800px;
  background-color: #FFFFFF;
  margin: auto;
  position: absolute;
  padding:10px;
  background-image: url(img/logos/bg-logo.png);
  background-position: center;
  background-repeat: no-repeat;
  background-size: 70%;
  border: 1px #888888 solid;
  border-radius: 10px;
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


</style>
<div class="print">
 <button type="button" onclick="print()">طباعة</button>
</div>
<div class="container" id="section-to-print">
     <div class='col'>
        <div class='col-3'>
         <h2 style="color:#CC0033"><b>.Oxford EST</b></h2>
         <h3 style="color:#555555">for language learning & Development</h3>
        </div>
        <div class='col-3 logo'></div>

        <div class='col-3'>
         <h2 style="color:#CC0033"><b>مؤسسة  اكسفورد</b></h2>
         <h3 style="color:#555555" >الـــــــــــــــــــــدولية<br /> للغات والتطوير</h3>
        </div>
     </div>
     <div class='col-1' dir="ltr">
        <div class='col-3'>
          <span>NO:</span><u><span id="student_number"><?php echo $student['student_number']?></span></u>
        </div>
        <div class='col-3'>
          <span>Branch:</span><u><span><?php echo $student['branch_name']?></span></u>
        </div>
        <div class='col-3'>
          <span>Date:</span><u><span><?php echo $student['date']?></span></u>
        </div>
        <label>Name of The Applicant (اسم مقدم الطلب)</label>
        <label class="cell"><?php echo $student['name']?></label><br />

        <label>Date Of Birth (تاريخ الولادة) (Y-m-d):</label>
        <label class="cell"><?php echo $student['birthday']?></label><br />

        <label>Gender (الجنس)</label>
        <label class="cell"><?php if($student['gender'] == 1){echo "✓ ذكر";}else {echo "✓ انثى";}?></label><br />

        <label>Grade (التحصيل الدراسي):</label>
        <label class="cell"><?php echo $student['cer'];?></label><br />

        <label>Spoken Languges (اللغات التي تتكلمها):</label>
        <label class="cell"><?php echo $student['lngs'];?></label><br />
        <hr />
        <span>Parent's Information معلومات الابوين</span>
        <table class="table" align="left" width="100%" border="1" >
          <tr>
            <td>Name الاسم</td>
            <td><?php echo $student['name']?></td>
          </tr>
          <tr>
            <td>Email & phone No. رقم الجوال والبريد الالكتروني</td>
            <td><?php echo $student['phone']?></td>
          </tr>
          <tr>
            <td>Address العنوان</td>
            <td><?php echo $student['address'];?></td>
          </tr>
        </table> <br />
        <hr />
        <label>Payment Details: </label><span><?php if($student['payment_type'] == 1){echo "✓ Cash نقداً";}else {echo "✓ Instalment اقساط";}?></span>
        <br />
        <label>Student Category Course (مستوى الطالب في الدورة):</label>
        <label class="cell"><?php echo "✓ ".$student['level_name'];?></label><br />

        <label>Registration amount payment (مبلغ التسجيل):</label>
        <label class="cell"><?php echo "$".$student['reg_fee'];?></label><br />

        <label>Course amount payment (مبلغ الدورة):</label>
        <label class="cell"><?php echo "$".$student['total_price'];?></label><br />

        <label>Extra amount payment (الاجور الاضافية):</label>
        <label class="cell"><?php echo "$".$student['extra_fee'];?></label><br />

        <label>Total Amount (المبلغ الاجمالي):</label>
        <label class="cell"><?php echo "$".($student['total_price'] + $student['reg_fee'] + $student['extra_fee']);?></label><br />


        <label>Remaining Amount (المبالغ المتبقية):</label>
        <label class="cell"><?php echo "$".$student['remain'];?></label><br />

        <label>Guarantor Name & Phone (اسم الكفيل / رقم الجوال):</label>
        <label class="cell"><?php echo $student['gran_name']."/ ".$student['gran_phone'];?></label><br />

        <label>Maturity Date (تاريخ الاستحقاق):</label>
        <label class="cell"><?php echo $student['start_date'];?></label><br />
        <hr />
        <span>Terms and Registration Conditions التسجيل والشروط الاحكام:</span><br />
        <p>
            1. I/we certify that the above information provided by me/us is correct.
            <br />
            2. I undertake to submit all the documents in original for verification. And not to refund the amounts paid in the
            case of my withdrawal and my signature For any distraction.
            <br />
            <p style="text-align: right; direction: rtl">
              1. أنا / نحن نشهد أن المعلومات المقدمة المذكورة اعلاه  صحيحة.
              <br />
              2.أتعهد بتقديم جميع المستندات الاصلية للتحقق منها . وان لا استرجع المبالغ المدفوعة في حالة انسحابي وتوقيعي لأي ضرف كان
            </p>
        </p>
     </div>
     <div class="col-2">
        <span>Oxford</span><br /><br />
        <label class="" ><?php echo $student['date'];?></label><br /><br />
        <label class="signture" style="font-family: 'Blackadder ITC'">Ahmed Al-ramahee</label>
     </div>
     <div class="col-2">
        <span>Applicant</span><br /><br />
        <label><?php echo $student['date'];?></label><br /><br />
        <label class="signture" style="font-family: 'Blackadder ITC'"><?php echo $student['student_name'];?></label>
     </div>

      <div class="col-1"><hr /></div>
</div>
<script>

</script>