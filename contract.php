<?php

session_start();
error_reporting(0);
require_once("script/_access.php");
access([1,2,4,3,5]);
require_once("script/dbconnection.php");
$id = $_REQUEST['id'];
try{
  $query = "select students.*, branches.name as branch_name,
             DATE_FORMAT(students.date,'%Y/%m/%d') as date,
             levels.name as level_name,
             staff.name as staff_name,
             students.name as student_name
            from students
            left join branches on branches.id = students.branch_id
            left join levels on levels.id = students.level_id
            left join staff on staff.id = students.manager_id
            where students.id = ?
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
  background-color:transparent;
  font-size: 15px;
  line-height: 1;
  direction: rtl;
}

.col-2 {
  width:50%;
  min-height: 3px;
  float: left;
  position: relative;
  text-align: right;
}
.col-3 {
  width:33.333333333%;
  min-height: 3px;
  float: left;
  position: relative;
  text-align: right;
}
.col-3 * {
  padding-left: 10px;
  padding-right: 10px;
  text-align: center;
}

.col {
  width:100%;
  min-height: 3px;
  float: left;
  position: relative;
  text-align: right;
  border-bottom: 2px #CC0033 double;
}
.col-1 {
  width:100%;
  min-height: 3px;
  float: left;
  position: relative;
  text-align: right;
  line-height: 1.5;
}
.col-1 span {
  color: #CC0000;
  font-weight: bold;
  padding-right: 15px;
  padding-left: 15px;
}
.col-1 label,.col-1 pre {
  color: #000;
  font-weight:;
  padding-right: 15px;
  padding-left: 15px;
  display: inline-block;
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
  height: 120px;
}

.container {
  width:800px;
  background-color: #FFFFFF;
  margin: auto;
  position: absolute;
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
         <h2 style="color:#CC0033"><b>Oxford EST.</b></h2>
         <h3 style="color:#555555">for language learning & Development</h3>
        </div>
        <div class='col-3 logo'></div>

        <div class='col-3'>
         <h2 style="color:#CC0033"><b>مؤسسة  اكسفورد</b></h2>
         <h3 style="color:#555555" >الـــــــــــــــــــــدولية<br /> للغات والتطوير</h3>
        </div>
    </div>
    <div class='col-2' dir="rtl">
      <span style="color:#CC0033;padding: 10px; border-bottom: 1px solid #555555;"><b>الالتزمات</b></span>
      <ul>
        <li> 	عدم استرجاع اي مبالغ مادية بعد توقيع هذا العقد حتى في حال عدم المباشرة .</li>

        <li>	يتعهد الطالب بالالتزام بكافة التعليمات الخاصة بالمؤسسة التي توضح له من قبل الطرف الاول و يتحمل الطرف الثاني كافة الرسوم و الغرامات الناجمة عن عدم الالتزام بتعليمات المؤسسة .</li>

        <li> في حال التأجيل يتضمن رسوم تأجيل توضح من قبل الطرف الاول حسب فترة التأجيل .</li>

        <li>	الالتزام بالنظافة داخل بناية المؤسسة .</li>

        <li>	لا يجوز التدخين مطلقا داخل بناية المؤسسة ( عدى غرفة التدخين ) و يحاسب المخالف بغرامة قدرها (10$) عند رصد كل حالة .</li>

        <li>	يحق لإدارة المؤسسة فصل الطالب فورا في حال تصرف تصرفات غير اخلاقية  مع عدم استرجاع اي مبالغ مادية . </li>

        <li>	يجب الالتزام بوقت المحاضرة و عدم التأخير عن الوقت المحدد للمحاضرة و في حال غياب الطالب يدفع رسم(10$) عند كل حالة غياب و في حال تكرار حالات الغياب لأكثر من ثلاث مرات دون إعلام ادارة المؤسسة يتم فصل الطالب دون استرجاع اي مبالغ</li>

        <li>	يجب التحضير المستمر و الالتزام بالمنهج المعد من قبل المؤسسة و في حال عدم الالتزام بهما يدفع الطالب رسوم قدرها ( 10$ ).</li>
        <li>	في حال تأجيل او عدم اجتياز الطالب للاختبارات المؤسسة يتم دفع رسوم قدرها (10$ ).</li>
        <li>	يلتزم الطرف الاول باسترجاع مبالغ الدورة المدفوعة الى الطرف الثاني في حال عدم الاستفادة القطعية من الدورة فقط في حال التزام الطالب بالشروط اعلاه </li>
        <li>عند اكتمال المدة الفعلية للدورة و حسب الشروط المتفق عليها اعلاه وكان الطالب في حاجة الى دروس اضافية يتم احتساب اجور اضافية و حسب الحالة آنذاك</li>
        <li>	يمنح الطالب شهادة صادرة من اكاديمية اكسفورد في حالة اجتيازه الامتحان النهائي و في خلافه لايتم المنح</li>
      </ul>
    </div>
    <div class='col-2'>
        <span style="color:#CC0033;padding: 10px;border-bottom: 1px solid #555555;"><b>عقد تسجيل الطالب</b></span>
      <div class="col-1"><br />
       <span>هذا الاتفاق بين</span><br />
       <span>الطرف الاول : </span><label>مؤسسة اكسفورد التعليميه</label><br />
       <span>الطرف الثاني :</span><label><?php echo $student['student_name'];?></label><br />
       <span>رقم الهوية :</span><label>N/A</label><br /><br />
       <label>ينص العقد على ان الطرف الاول سوف يقوم بتعليم الطرف الثاني اللغة <u><b>الانكَلزية</b></u> وفقا للشروط و الاحكام التاليه:</label>
       <br /><br />
       <span>ساعات الدورة</span><br /><label>اٌام الدورة التدرٌبٌة هً ثالث او اربع اٌام فً األسبوع بواقع 6 او 8 ساعات اسبوعٌا .</label>
       <br />
       <span>الفترة</span><label>تكون المدة المطلوبة لتمكن الطالب من التحدث اللغة
هً المدة الفعلٌة إلعطاء الدورة فً المؤسسة</label>
       <br />
       <span>مكان الدورة </span><br /><label>ٌكون موقع اعطاء دروس الدورة فً موقع المؤسسة و حسب الرقعة الجغرافٌة للطالب .</label>
       <br />
       <span>اجور الدورة</span><br />
       <pre>
تحدد اجور الدورة الدراسية حسب الصنف الذي تم تصنيفه
للطالب بعد اجتيازه امتحان تحديد المستوى عند التسجيل ,
ليتم تحديد المستوى المناسب لقدرات الطالب
تكون بثلاث مستويات.
مبلغ الدورة <?php echo $student['total_price'];?> دولار امريكي اي ما يقارب <?php echo  ($student['total_price'] * 1250); ?> دينار
عراقي مع اجور استمارة التسجيل 20$ اي ما يقارب
25000 دينار عراقي كحد ادنى و حسب قيمة الصرف
آنذاك .
اضافة الى 10$ اي ما يقارب 12500 دينار عراقي عند
الانتقال من المستوى الاول الى المستوى الثاني .
       </pre>
       <br />


      </div>
    </div>
    <div class="col-1">
      <div class="col-2">
       <span>الطرف الاول </span>
       <br /><label>مؤسسة اكسفورد التعليميه المتمثلة
بالدكتور احمد الرماحي او من ينوب عنه</label>
       <br /><label>التاريخ : <?php echo $student['date'];?></label>
       <br /><label>التوقيع: </label><label class="signture" style="font-family: 'Blackadder ITC'"><?php echo "Ahmed Al-ramahee";?></label>
      </div>
      <div class="col-2">
       <span>الطرف الثاني </span>
       <br /><label>اسم الطالب : <?php echo $student['student_name'];?></label>
       <br /><label>التاريخ : <?php echo $student['date'];?></label>
       <br /><label>التوقيع: </label><label class="signture" style="font-family: 'Blackadder ITC'"><?php echo "Student";?></label>
      </div>
      <div class="col-1"><hr /> </div>
    </div>
</div>
<script>

</script>