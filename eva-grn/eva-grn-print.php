<?php
require_once('../includes/config/config.php');
require_once('../includes/config/utility-class.php');
require_once("../mpdf60/mpdf.php");
loginAuthentication();
$mpdf=new mPDF('','A4', 0, '', 10, 10, 10, 10, 9, 25, 'P');

$mpdf->SetDisplayMode('fullpage');


ob_start();
include "eva-grn-model.php"; 

$invoice_entry_edit		= editReceiptdetails($_REQUEST['id']);

if($invoice_entry_edit['grn_typ']==1){
	$invoice_entry_prd_edit	= editReceiptproduct($invoice_entry_edit['grnId']);
}elseif($invoice_entry_edit['grn_typ']==2){
	$invoice_entry_prd_edit=editReceiptproductChild($invoice_entry_edit['grnId']);
}

include "eva-grn-print-view.php"; 

$template = ob_get_contents();
ob_end_clean();
//echo $template; exit;
$mpdf->autoLangToFont = false;
$mpdf->WriteHTML($template);
$mpdf->Output();
	?>	
	

