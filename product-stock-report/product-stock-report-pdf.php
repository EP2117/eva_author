<?php

require_once '../includes/connection.php'; 
require_once '../includes/utility-class.php'; 
require_once '../includes/language.php';
require_once("../mpdf60/mpdf.php");

$list_company = getCompanyDetails();
//margin_left,right,top,bottom ,header,footer 
$template = $divPrint;
//$mpdf= $mpdf=new mPDF('','', 0, '', 10, 10, 34, 15, 9, 25, 'P');
$mpdf= $mpdf=new mPDF('my1','', 0, '', 10, 10, 34, 15, 9, 25, 'P');
if($_REQUEST['invoice_entry_from_date']==$_REQUEST['invoice_entry_to_date']){
	$date_display	= "(".$_REQUEST['invoice_entry_from_date'].") ";
}
else{
	$date_display	= "(".$_REQUEST['invoice_entry_from_date']." - ".$_REQUEST['invoice_entry_to_date'].") ";
}
/*$mpdf->SetHTMLHeader("<div style='border-bottom: 1px solid #000000;'><table width='100%' cellspacing='1' cellpadding='0'><tr><td style='text-align:left;font-size:150%;font-weight:bold;width:50%'><img src=".PROJECT_PATH.'/images/'.$_SESSION[SESS.'_session_company_logo']." alt='' title='' width='50' />".$list_company['company_name']."</td><td style='text-align:right;width:50%'>".nl2br($list_company['company_address'])."</td></tr><tr>
      <td colspan='2' class='report-background report-border-top' style='width:100%; text-align:center; font-size:16px;'><strong>". $lang['lang_invoice_report']." - ".$date_display."</strong></td></tr></table></div>"	);
$mpdf->SetDisplayMode('fullpage');

$stylesheet = '<style>'.file_get_contents('../css/report-style.css').'</style>';*/

/*$stylesheet = file_get_contents('../css/report-style.css');
$mpdf->WriteHTML($stylesheet,1);*/
include "invoice-entry-report-model.php"; 
	$list_invoice_entry = quotationReport();
include "invoice-entry-report-view-pdf.php";  
/*$template = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($stylesheet);
$mpdf->WriteHTML($template);
$mpdf->Output('invoice-entry-report.pdf', 'I');
unlink('invoice-entry-report.pdf');*/



	
	?>	
	

