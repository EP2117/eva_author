<?php
require_once('../includes/config/config.php');
require_once('../includes/config/utility-class.php');
require_once("../mpdf60/mpdf.php");
loginAuthentication();
$mpdf=new mPDF('','A4', 0, '', 10, 10, 10, 10, 9, 25, 'P');

$mpdf->SetDisplayMode('fullpage');


ob_start();
include "production-print-model.php"; 

$width_cutting_edit		= editQuotation();
$sales_detail			= editSalesdetail();
$production_entry_prd_edit	= editQuotationProductDetail();
$production_entry_raw_prd_edit	= editQuotationRawProductDetail();
$product_con_entry_child_prd_edit	= editQuotationDamProductDetail();
$work_deatil				= editWorkDetail();

include "production-print-view.php"; 

$template = ob_get_contents();
ob_end_clean();
//echo $template; exit;
$mpdf->autoLangToFont = false;
$mpdf->WriteHTML($template);
$mpdf->Output();
	?>	
	

