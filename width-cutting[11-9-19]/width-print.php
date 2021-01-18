<?php
require_once('../includes/config/config.php');
require_once('../includes/config/utility-class.php');
require_once("../mpdf60/mpdf.php");
loginAuthentication();
$mpdf=new mPDF('','A4', 0, '', 10, 10, 10, 10, 9, 25, 'P');

$mpdf->SetDisplayMode('fullpage');


ob_start();
include "width-print-model.php"; 

$width_cutting_edit		= editQuotation();
$width_cutting_prd_edit	= editQuotationProductDetail();
$width_cutting_width_edit	= editWidthDetail();
$product_con_entry_child_prd_edit	= editChildProductDetail();

include "width-print-view.php"; 

$template = ob_get_contents();
ob_end_clean();
//echo $template; exit;
$mpdf->autoLangToFont = false;
$mpdf->WriteHTML($template);
$mpdf->Output();
	?>	
	

