<?php
require_once('../includes/config/config.php');
require_once('../includes/config/utility-class.php');
require_once("../mpdf60/mpdf.php");
loginAuthentication();
$mpdf=new mPDF('','A4', 0, '', 10, 10, 10, 10, 9, 25, 'P');

$mpdf->SetDisplayMode('fullpage');

$id =$_GET['id'];
ob_start();
include "direct-invoice-print-model.php"; 

 $invoice_entry_edit		= editInvoice($id);
$invoice_entry_prd_edit	= editInvoiceProductDetail($id);

include "direct-invoice-print-view.php"; 

$footer ='<table width="100%" style="margin-top:50px;"><tr>
			<td>Cashier :</td>
			<td>Sales Person :</td>
			<td>Customer :</td>
		</tr>
		</table>';

$template = ob_get_contents();
ob_end_clean();
//echo $template; exit;
$mpdf->autoLangToFont = false;
$mpdf->WriteHTML($template);
$mpdf->SetHTMLFooter($footer);
$mpdf->Output();
	?>	
	

