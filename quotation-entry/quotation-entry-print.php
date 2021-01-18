<?php
require_once('../includes/config/config.php');
require_once('../includes/config/utility-class.php');
require_once("../mpdf60/mpdf.php");
loginAuthentication();
$mpdf=new mPDF('','A4', 0, '', 10, 10, 10, 10, 9, 25, 'P');

$mpdf->SetDisplayMode('fullpage');

$id =$_GET['id'];
ob_start();
include "quotation-print-model.php"; 

$invoice_entry_edit		= editQuotation($id);
$invoice_entry_prd_edit	= editQuotationProductDetail($id);

include "quotation-entry-print-view.php"; 

$template = ob_get_contents();
ob_end_clean();
//echo $template; exit;
$mpdf->autoLangToFont = false;
$mpdf->WriteHTML($template);
$mpdf->Output();
	?>	
	

