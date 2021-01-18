<?php
require_once('../includes/config/config.php');
require_once('../includes/config/utility-class.php');
require_once("../mpdf60/mpdf.php");
loginAuthentication();
$mpdf=new mPDF('','A4', 0, '', 10, 10, 10, 10, 9, 25, 'L');

$mpdf->SetDisplayMode('fullpage');

//print_r($_REQUEST);exit;
ob_start();
include "stock-available-model.php"; 
$product_status		= (isset($_REQUEST['product_status']))?$_REQUEST['product_status']:''; 
//$invoice_entry_edit		= editQuotation();
$stockList	= stockDetailsList();
include "stock-print-view.php"; 

$template = ob_get_contents();
ob_end_clean();
//echo $template; exit;
$mpdf->autoLangToFont = false;
$mpdf->WriteHTML($template);
$mpdf->Output();
	?>	
	

