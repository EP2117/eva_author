<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	require_once("../mpdf60/mpdf.php"); 
	
	$list_company = getCompanyDetails();
	/*echo "<pre>"; 
	print_r($list_company);
	exit;*/
	if($_SESSION[SESS.'_session_company_id'] == 1) {
		$title_color = 'color:#FF0000';
	} else if($_SESSION[SESS.'_session_company_id'] == 2) {
		$title_color = 'color:#0000FF';
	}
	$mpdf=new mPDF('','A4', 0, '', 8, 8, 28, 17, 9, 8, 'P'); 
	$mpdf->SetDisplayMode('fullpage');
	ob_start();
	require_once 'po-product-report-model.php';
	$invoice_list		= quotationtypeone();
	
	include "po-product-report-view-pdf.php";  
	/*<img width='120px;' src='".PROJECT_PATH."img/".$list_company['company_logo']."' style='padding-left:5px;'/></td>*/
	
	$mpdf->SetHTMLHeader("<table cellspacing='0' style='width:98%;'   class='report-outer-table'><tr><td style='text-align:left;'><td style='text-align:center;'><span style='font-size:30px; font-weight:bold; font-family:Arial Black'>".ucfirst($list_company['company_name'])."</span><br/><span style='font-size:11px;'>".$list_company['company_address'].". <br/>".$list_company['company_contact']."</span></td><td width='25%'></td></tr></table>"); 
	$mpdf->SetHTMLFooter('Page No : {PAGENO} '	); 
	$mpdf->SetDisplayMode('fullpage');
	
	$template = ob_get_contents();
	ob_end_clean();
	//echo $template; exit;
	$mpdf->autoLangToFont = false;
	$mpdf->WriteHTML($template);
	$mpdf->Output();
?>	