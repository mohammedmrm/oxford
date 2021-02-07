<?php
ini_set('max_execution_time', 20000);
ob_start();
session_start();
error_reporting(0);
session_start();
require_once("script/_access.php");
access([1,2,4,3,5]);
require_once("script/dbconnection.php");
$id = $_REQUEST['id'];
try{
  $query = "select students.*,sum(if(payment.confirm = 0,payment.amount,0)) as remain, branches.name as branch_name,
             DATE_FORMAT(students.date,'%Y/%m/%d') as date,
             levels.name as level_name,if(students.gender = 1,'ذكر','انثى') as gen,
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
  $data = $data[0];
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}

require_once("tcpdf/tcpdf.php");
class MYPDF extends TCPDF {
    public function Header() {

    }
    public function Footer() {
        // Set font
        $this->SetFont('aealarabiya', 'B', 8);
        // Title
        $footer= '<hr>Help Desk - 07812265040';
        $this->writeHTML($footer);
        $this->writeHTML('');
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('07822816693');
$pdf->SetTitle('Registration Form');
$pdf->SetSubject($data['name']);
// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'ar';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
// set font
$pdf->SetFont('aealarabiya', '', 12);

// set default header data
//$pdf->SetHeaderData("../../../".$config['Company_logo'],35, "التقرير الشامل", "اسم");
// set header and footer fonts
$pdf->setHeaderFont(Array('aealarabiya', '', 12));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// set margins
$pdf->SetMargins(10,5,10);
$pdf->SetHeaderMargin(1);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// ---------------------------------------------------------


// add a page
$pdf->AddPage($pageDir, 'A4');

// Persian and English content
$header=    '
             <table>
             <tr>
                    <td style="text-align: center;font-size:20px;">
                      <span style="color:#A52A2A;">Oxford EST.</span><br />
                       for language learning & Development
                    </td>
                    <td style="text-align: center;">
                        <img src="img/logos/logoW.jpg" height="100px"/>
                    </td>
                    <td style="text-align: center;font-size:20px;">
                      <span style="color:#A52A2A;">مؤسسة اكسفورد </span><br /><br />
                      الـــــــــــــــــــــدولية
                      للغات والتطوير
                    </td>
             </tr>
            </table>
            <HR />
            ';
 $iqd = $data['total_price'] * 1250;
$htmlpersian = '
             <table>
             <tr>
                    <td>
                        <span style="color:#CC0033;border-bottom: 1px solid #555555;">عقد تسجيل الطالب</span>
                        <div >
                         <span>هذا الاتفاق بين</span><br />
                         <span>الطرف الاول : </span><label>مؤسسة اكسفورد التعليميه</label><br />
                         <span>الطرف الثاني :</span><label>'.$data['name'].'</label><br />
                         <span>رقم الطالب :</span><label>'.$data['student_number'].'</label><br /><br />
                         <label>ينص العقد على ان الطرف الاول سوف يقوم بتعليم الطرف الثاني اللغة <u><b>الانكَلزية</b></u> وفقا للشروط و الاحكام التاليه:</label>
                         <br /><br />
                         <span style="color:#CC0033;">ساعات الدورة</span><br />
                         <label>ايام الدورة التدريبية هي ثلاث او اربع ايام في الأسبوع بواقع 6 او 8  ساعات اسبوعيا .</label>
                         <br />
                         <span style="color:#CC0033;">الفترة</span><br />
                         <label>تكون المدة المطلوبة لتمكن الطالب من التحدث اللغة  </label>
                         <br />
                         <span style="color:#CC0033;">مكان الدورة </span><br />
                         <label>يكون موقع اعطاء دروس الدورة في موقع المؤسسة و حسب الرقعة الجغرافية للطالب .</label>
                         <br />
                         <span style="color:#CC0033;">اجور الدورة</span><br />
                         <p>
                          تحدد اجور الدورة الدراسية حسب الصنف الذي تم تصنيفه
                          للطالب بعد اجتيازه امتحان تحديد المستوى عند التسجيل ,
                          ليتم تحديد المستوى المناسب لقدرات الطالب <br />
                          <br />
                          تكون بثلاث مستويات.<br />
                          <br />

                          مبلغ الدورة '.$data['total_price'].' دولار امريكي اي ما يقارب '.$iqd.' دينار
                          عراقي مع اجور استمارة التسجيل 20$ اي ما يقارب
                          25000 دينار عراقي كحد ادنى و حسب قيمة الصرف
                          آنذاك .
                          اضافة الى 10$ اي ما يقارب 12500 دينار عراقي عند
                          الانتقال من المستوى الاول الى المستوى الثاني .
                         </p>
                         <br />


                        </div>

                    </td>
                    <td >
<div>
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

                    </td>

             </tr>
            </table>
' ;

$htmlpersian .=
'
             <table>
             <tr>
                    <td style="text-align: center;">
       <span style="color:#CC0033;">الطرف الثاني </span>
       <br /><label>اسم الطالب : '.$data['student_name'].'</label>
       <br /><label>التاريخ : '.$data['date'].'</label>
       <br /><label>التوقيع: </label><label class="signture" style="font-family: \'Blackadder ITC\'"></label>

                    </td>
                    <td style="text-align: center;">
       <span style="color:#CC0033;">الطرف الاول </span>
       <br /><label>مؤسسة اكسفورد التعليميه المتمثلة
بالدكتور احمد الرماحي او من ينوب عنه</label>
       <br /><label>التاريخ : '.$data['date'].'</label>
       <br /><label>التوقيع: </label><label class="signture" style="font-family: \'Blackadder ITC\'"></label>

                    </td>

             </tr>
            </table>
';
$pdf->setRTL(Ture);
$pdf->SetFontSize(12);
$pdf->WriteHTML($style.$header.$htmlpersian, true, false, true, false, 'J');

// embed image
$pdf->Image('img/logos/bg-logo.png', 40, 100, 100, 100, '', '', '', false, 200, '', false, false, 0);
// set LTR direction for english translation
$pdf->setRTL(false);

$pdf->SetFontSize(10);
// print newline
$pdf->Ln();
//Close and output PDF document
ob_end_clean();

$pdf->Output('RegistrationForm '.date('Y-m-d h:i:s').'.pdf', 'I');

?>

