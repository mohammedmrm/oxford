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

$htmlpersian =
'<table>
             <tr>
                   <td style="font-size:14px;color:#A52A2A;">
                     NO: '.$data['student_number'].'
                    </td>
                    <td style="text-align: center;font-size:14px;color:#A52A2A;">
                       Data: '.$data['date'].'
                    </td>
                    <td style="text-align: center;font-size:14px;color:#A52A2A;">
                      Branch: '.$data['branch_name'].'
                    </td>
             </tr>
</table>
<br />';
$htmlpersian .=
'
<table cellpadding="5">
             <tr>
                    <td style="text-align:left;">
                      Name of The Applicant (الطلب مقدم اسم)
                    </td>
                    <td style="text-align:left;font-size:14px;font-weight:bold;">
                      '.$data['name'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                      Date Of Birth (الولاده تاريخ) (Y-m-d):
                    </td>
                    <td style="text-align:left;font-size:14px;font-weight:bold;">
                      '.$data['birthday'].'
                    </td>
             </tr>
             <tr>

                    <td style="text-align:left;">
                      Gender (الجنس):
                    </td>
                    <td style="text-align:left;font-size:14px;font-weight:bold;">
                      '.$data['gen'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                      Grade (الدراسي تحصيل):
                    </td>
                    <td style="text-align:left;font-size:14px;font-weight:bold;">
                      '.$data['cer'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                      Spoken Languges (تتكلمها التي الغات):
                    </td>
                    <td style="text-align:left;font-size:14px;font-weight:bold;">
                      '.$data['lngs'].'
                    </td>
             </tr>
</table>
<hr>';
$htmlpersian .=
'<h3 style="font-size:14px;color:#A52A2A;">Parent\'s Information معلومات الابوين</h3>
<table cellpadding="5" border="1">
             <tr>
                    <td style="text-align:left;">
                     Name الاسم
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      '.$data['name'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Email & phone No. الاكتروني البريد و الجوال رقم
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      '.$data['phone'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Address العنوان
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      '.$data['address'].'
                    </td>
             </tr>

</table>
';
if($student['payment_type'] == 1){$pay = "Cash نقداً";}else {$pay =  "Instalment اقساط";}
$htmlpersian .=
'<hr /><table cellpadding="5">
             <tr>
                    <td style="text-align:left;">
                     Payment Details:
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      '.$pay.'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Student Category Course (الدوره في الطالب مستوى):
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      '.$data['level_name'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Registration amount payment (التسجيل مبلغ ):
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      $'.$data['reg_fee'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Course amount payment ( الدورة مبلغ ):
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      $'.$data['total_price'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Extra amount payment (الاضافية الاجور ):
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      $'.$data['extra_fee'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Discount (الخصم):
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      $'.$data['discount'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Total Amount (الاجمالي المبلغ ):
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      $'.($data['total_price'] + $data['reg_fee'] + $data['extra_fee'] - $data['discount']).'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Remaining Amount (المتبقية المبالغ ):
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      $'.$data['remain'].'
                    </td>
             </tr>
             <tr>
                    <td style="text-align:left;">
                     Guarantor Name & Phone (الكفيل اسم / الجوال رقم):
                    </td>
                    <td style="font-size:14px;color:#A52A2A;">
                      '.$data['gran_name']."/ ".$data['gran_phone'].'
                    </td>
             </tr>
</table>
';
$htmlpersian .= '<hr><h3 style="font-size:16px;color:#A52A2A;">Terms and Registration Conditions التسجيل والشروط الاحكام:</h3>';
$htmlpersian .=
'<p style="color:#696969;">
<ol>
  <li>I/we certify that the above information provided by me/us is correct.</li>
  <li>I undertake to submit all the documents in original for verification. And not to refund the amounts paid in the case of my withdrawal and my signature For any distraction.</li>
</ol>
<br />';
$html2 =
'
<ol dir="rtl" style="text-align:center;color:#696969;">
  <li>أنا / نحن نشهد أن المعلومات المقدمة المذكورة اعلاه صحيحة.</li>
  <li>أتعهد بتقديم جميع المستندات الاصلية للتحقق منها . وان لا استرجع المبالغ المدفوعة في حالة انسحابي وتوقيعي لأي ضرف كان</li>
</ol>
</p>';
$html3 =
   '
             <table>
             <tr>
                <td style="font-size:14px;color:#A52A2A;text-align:center">Oxford</td>
                <td style="font-size:14px;color:#A52A2A;text-align:center">Applicant</td>
             </tr>
             <tr>
                <td style="font-size:14px;text-align:center">'.date('Y-m-d').'</td>
                <td style="font-size:14px;text-align:center">'.$data['date'].'</td>
             </tr>
             <tr>
                <td style="font-size:14px;text-align:center;font-family: \'Blackadder ITC\'">Ahmed Al-ramahee</td>
                <td style="font-size:14px;text-align:center">'.$data['name'].'</td>
             </tr>
            </table>
            ';
$pdf->setRTL(false);
$pdf->SetFontSize(12);
$pdf->WriteHTML($style.$header.$htmlpersian, true, false, true, false, 'J');
$pdf->setRTL(ture);
$pdf->WriteHTML($html2, true, false, true, false, 'J');
$pdf->setRTL(false);
$pdf->WriteHTML($html3, true, false, true, false, 'J');

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

