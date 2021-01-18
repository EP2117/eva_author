<!DOCTYPE html>
<html>
<head>
    <title>Advance</title>
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style type="text/css" media="all">
/* @page{
margin-left: 0px;
margin-right: 0px;
margin-top: 12.7mm;
margin-bottom: 12.7mm;
}*/

		   table{
				/*border-left:1px solid #000000;*/
			}
			tr{
/*				width:100%;
				display: table;*/
			}
			td{
				padding:5px;
			}
			tbody tr.head {
				/*width:100%;*/
				page-break-before: always;
				page-break-inside: avoid;
			}
			@media screen {
				tbody .head{
					display: none;
				}
			}  
		.report-table-border-top {
		border-top:1px solid #000000 !important;
		}
		.report-table-border-bottom {
		border-bottom:1px solid #000000 !important;
		}
		.report-border-top {
		border-top:1px solid #000000 !important;
		}
		.report-border-right {
		border-right:1px solid #000000 !important;
		}
		.report-border-bottom {
		border-bottom:1px solid #000000 !important;
		}
		.report-border-left {
		border-left:1px solid #000000 !important;
		}
		
		.report-padding-top-bottom {
		padding:5px 0px;
		}
		.report-padding-table-top-bottom {
		padding:4px 0px;
		}
		.repor-table-border 
		{
		border-left:1px solid #000000 !important;
		 
		}
		.repor-table-left-bottom
		{
		border-bottom:1px solid #000000 !important; 
		border-left:1px solid #000000 !important;
		}
		.report-outer-table {
		border:1px solid #000000 !important;
		}
		</style>  
   
</head>

<body >

   <table style="width:100%;font-size:12px;" cellspacing="0"  class="report-outer-table">

   <tr>
	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' ><!--<img src="" alt='' title='' width='70' align="center" /><br/>-->EVE STEEL <br/><span style="font-size:14px;"> </span></td>
	</tr>
	<tr>
 	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > PURCHASE ORDER ENTRY </td>
	</tr>
   <tr>
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >PURCHASE ORDER NO : &nbsp;<?=$invoice_entry_edit['purchase_no']?></td>
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($invoice_entry_edit['pR_purchase_date'])?></td>
	</tr>
	<tr>
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >SUPPLIER NAME :&nbsp;&nbsp;<?=ucfirst($invoice_entry_edit['supplier_name'])?></td>
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:13px;' >PHONE NO :&nbsp;&nbsp;<?=$invoice_entry_edit['supplier_mobile_no']?></td>
	</tr>
	<tr>
	  <td width="18%" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' valign="top">ADDRESS </td>
	  <td width="32%" class="report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;'  >:&nbsp;&nbsp;<?=ucfirst($invoice_entry_edit['supplier_billing_address'])?></td>
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' ></td>
	</tr>
	
 </table>
 <br>

		
	
<?php
												
											
	if($invoice_entry_prd_edit){?>
	
	
			<table style="width:100%" class="report-outer-table" id="product_detail_rls">
			<tr>
				  <td colspan="10" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
			</tr>
			 
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:5%;' > SNO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:18%;' > NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:8%;' > UOM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:8%;' > RATE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:8%;' > FRG.RATE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:8%;' > QTY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' > TON </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' > KG </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:15%;' > RATE BY CURRENCY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' >UNIT PRICE</td>
			</tr>
			
	<?php  
	$sno=1;			
	foreach($invoice_entry_prd_edit as $getDetail){

 ?>	
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$sno++?> </td>
				<td class="report-border-right report-border-bottom " style='text-align:center;font-size:11px;' > 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['product_uom_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['pRp_rate'],2,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['pRp_frignrate'],2,'.','')?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['pRp_qty'],3,'.','')?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['pRp_ton'],3,'.','')?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['pRp_kg'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['pRp_rate_by_currency'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['pRp_unitprice'],2,'.','')?> </td>
				
			</tr>

	
<?php   } ?>

			</table>
			<?php
}


 ?>
</tbody>
 </table>

<br/>	
<table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:15%' > TOTAL AMOUNT </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['pR_tot_amount'],2,'.','')?> &nbsp;&nbsp;</td><td style="text-align:right;font-weight:bold;font-size:11px;width:10%" class="report-border-bottom"><?=number_format($invoice_entry_edit['pR_totalAmnt'],2,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:15%' > ADVANCE </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['pR_advance_amount'],2,'.','')?> &nbsp;&nbsp;</td><td style="text-align:right;font-weight:bold;font-size:11px;width:10%" class="report-border-bottom"><?=number_format($invoice_entry_edit['pR_advanceAmnt'],2,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:15%' > NET TOTAL </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['pR_net_total_amount'],2,'.','')?> &nbsp;&nbsp;</td><td style="text-align:right;font-weight:bold;font-size:11px;width:10%" class="report-border-bottom"><?=number_format($invoice_entry_edit['pR_net_total_amnt'],2,'.','')?> &nbsp;&nbsp;</td>
	</tr>
</table>
   
		

</body>


</html>
