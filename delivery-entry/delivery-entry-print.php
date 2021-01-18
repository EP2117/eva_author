<?php
require_once('../includes/config/config.php');
require_once('../includes/config/utility-class.php');
require_once("../mpdf60/mpdf.php");
loginAuthentication();
$mpdf=new mPDF('','A4', 0, '', 10, 10, 10, 10, 9, 25, 'P');

$mpdf->SetDisplayMode('fullpage');


ob_start();
include "delivery-entry-model.php"; 

$invoice_entry_edit		= editQuotation();
$invoice_entry_prd_edit	= editQuotationProductDetail();

include "delivery-entry-print-view.php"; 

$footer = '<table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
	<tr>
		<td class="report-border-right report-border-bottom" style="text-align:left;font-weight:bold;font-size:11px;width:25%">Vehicle Number : </td>
		<td class="report-border-right report-border-bottom" style="text-align:left;font-weight:bold;font-size:11px;width:25%" >'.$invoice_entry_edit["delivery_entry_vehicle_no"].'&nbsp;&nbsp;</td>
		<td class="report-border-right report-border-bottom" style="text-align:left;font-weight:bold;font-size:11px;width:25%" > Driver Name </td>
		<td class="report-border-right report-border-bottom" style="text-align:left;font-weight:bold;font-size:11px;width:25%" > '. $invoice_entry_edit["delivery_entry_driver_name"].'&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td class=" report-border-right report-border-bottom" style="text-align:left;font-weight:bold;font-size:11px;width:25%">Delivery  Person Name :  </td>
		<td class="report-border-right report-border-bottom" style="text-align:left;font-weight:bold;font-size:11px;width:25%" >'. $invoice_entry_edit["delivery_entry_person_name"] .'&nbsp;&nbsp;</td>
		<td class="report-border-right report-border-bottom" style="text-align:left;font-weight:bold;font-size:11px;width:25%" > Time</td>
		<td class="report-border-right report-border-bottom" style="text-align:left;font-weight:bold;font-size:11px;width:25%" > '. $invoice_entry_edit["delivery_entry_time"].' &nbsp;&nbsp;</td>
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
	

