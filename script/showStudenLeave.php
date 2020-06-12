<?php
ob_start();
session_start();
require_once("_access.php");
access([1,2,3,4,5,6]);
require_once("dbconnection.php");
$style= <<<EOF
<style>
  .title {
    background-color: #FFFACD;
  }
  .head-tr {
   background-color: #ddd;
   color:#111;
  }
  .col-50 {
      position: relative;
      display: inline-block;
      width:180px;
  }
  .client {
        position: relative;
      display: inline-block;
      width:180px;
  }
  .albarq {
    color :red;

  }
</style>
EOF;
require("../config.php");

$id = $_REQUEST['id'];


try{
  $query = "select *,date_format(students_leave.date,'%Y-%m-%d') as date from students_leave
            left join students on students.id = students_leave.student_id";

  $data = getData($con,$query,[$id]);
  $data = $data[0];
  $success="1";


} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}


require_once("../tcpdf/tcpdf.php");

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('07822816693');
$pdf->SetTitle('وصل');
$pdf->SetSubject('Receipt');
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
$logo = "../../../".$config['Company_logo'];
$pdf->SetHeaderData($logo,40,"");

// set header and footer fonts
$pdf->setHeaderFont(Array('aealarabiya', '', 12));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// set margins
$pdf->SetMargins(10, 40,10, 10);
$pdf->SetHeaderMargin(5);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// ---------------------------------------------------------


// add a page
$pdf->AddPage('P', 'A5');

// Persian and English content
$tbl = '
<table  cellpadding="10">

  <tr>
    <td>رقم الاجازة : '.$data['id'].'</td>
    <td>تاريخ : '.$data['date'].'</td>
  </tr>
  <tr>
    <td colspan="2">اسم الطالب: '.$data['name'].'</td>
  </tr>
</table>
<br /><br /><br />
<table  border="1" cellpadding="10">
    <tr>
    <td width="153" class="title">من تاريخ</td>
    <td align="center" width="300">'.$data['start'].'</td>
  </tr>
  <tr>
    <td width="153" class="title">الى تاريخ</td>
    <td align="center" width="300">'.$data['end'].'</td>
  </tr>
</table>
<br /><br />
<br /><br />
';
$comp = "
<span>المعهد مسجل قانونياً,</span>
<br /> <br />
<span>معهد اكسفور للغات والتطوير</span>
<span>078-780-0898 / 077-789-8898</span>
<br />
<span></span>
<br /><br />
<span>
مؤسسة اكسفورد التعليميه المتمثلة بالدكتور احمد الرماحي او من ينوب عنه <br />
التاريخ :".$data['date']."<br />
التوقيع: احمد الرماحي
</span>
";


$pdf->writeHTML($style.$tbl, true, false, false, false, '');
$htmlpersian = $hcontent;
//$pdf->cell('','','توقيع العميل','');
$pdf->Ln();
$pdf->SetFont('aealarabiya', '', 10);
//$pdf->writeHTML($style.$comp, true, false, false, false, '');
// set LTR direction for english translation
$pdf->setRTL(true);

$pdf->SetFontSize(10);
// print newline
$style = array(
    'position' => 'L',
    'align' => 'L',
    'stretch' => false,
    'fitwidth' => false,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => "",
    'text' => true,
    'label' => $id,
    'font' => 'helvetica',
    'fontsize' => 12,
    'stretchtext' => 1
);
// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->write1DBarcode($id, 'S25+', 0, '', 60, 20, 0.4, $style, 'N');
$pdf->SetTextColor(25,25,112);
$pdf->SetFont('aealarabiya', '', 12);

$pdf->writeHTML("<hr>".$comp, true, false, false, false, '');
$pdf->SetTextColor(55,55,55);
$pdf->setRTL(false);
$pdf->SetFont('aealarabiya', '', 9);
$del = "<br /><hr />Developed and Designed by <a href='https://www.facebook.com/smartProg'>Mohammed Ridha</a> Company for IT Solutions <br /> 07822816693 , mohammed.mrm4@gamil.com, www.facebook.com/smartProg";
$pdf->writeHTML($del, true, false, false, false, '');
//$pdf->write2DBarcode($id, 'QRCODE,M',0, 0, 30, 30, $style, 'N');
$style['position'] = '';
//$pdf->write2DBarcode($id, 'QRCODE,M',70, 130, 30, 30, $style, 'N');



//Close and output PDF document
ob_end_clean();
//print_r($hcontent);
$pdf->Output('Receipt'.date('Y-m-d h:i:s').'.pdf', 'I');
?>