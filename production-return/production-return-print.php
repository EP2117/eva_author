<?php
require_once('../includes/config/config.php');
require_once('../includes/config/utility-class.php');
require_once("../mpdf60/mpdf.php");
loginAuthentication();
$mpdf=new mPDF('','A4', 0, '', 10, 10, 10, 10, 9, 25, 'P');

$mpdf->SetDisplayMode('fullpage');


ob_start();
include "production-return-print-model.php"; 

$width_cutting_edit		= editQuotation();
$sales_detail_edit			= editSalesdetail();
$prn_entry_prd_edit	= editQuotationProductDetail();
$prn_entry_raw_prd_edit	= editQuotationrawProductDetail();
//$product_con_entry_child_prd_edit	= editQuotationDamProductDetail();
//$work_deatil				= editWorkDetail();

include "production-return-print-view.php"; 

$template = ob_get_contents();
ob_end_clean();
//echo $template; exit;
$mpdf->autoLangToFont = false;
$mpdf->WriteHTML($template);
$mpdf->Output();
	?>	
	

