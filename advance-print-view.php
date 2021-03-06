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

   <table style="width:100%;font-size:12px;padding-top:100px;" cellspacing="0"  ><!--class="report-outer-table"-->

   <tr>
	 
	<tr>
 	 <td width="100%" colspan="4" class="report-border-bottom report-border-left report-border-right report-border-top " style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > ADVANCE ENTRY </td>
	</tr>
   <tr>
	  <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >ADVANCE NO : &nbsp;<?=$invoice_entry_edit['branch_prefix'].$invoice_entry_edit['advance_entry_no']?></td>
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($invoice_entry_edit['advance_entry_date'])?></td>
	</tr>
	<tr>
	  <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?=ucfirst($invoice_entry_edit['customer_name'])?></td>
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >PHONE NO :&nbsp;&nbsp;<?=$invoice_entry_edit['customer_mobile_no']?></td>
	</tr>
	<tr>
	  <td width="18%" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' valign="top">ADDRESS </td>
	  <td width="32%" class="report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;'  >:&nbsp;&nbsp;<?=ucfirst($invoice_entry_edit['customer_billing_address'])?></td>
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' ></td>
	</tr>
	
 </table>
 <br>

	
	
<?php
	if($invoice_entry_prd_edit){?>
	<table style="width:100%" class="report-outer-table" >
		<tr>
			  <td colspan="13" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
		</tr>
			<tr>
				<td rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > SNO </td>
				<td rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > NAME </td>
				<td rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > COLOR </td>
				<td rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > THICK </td>
				<td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > LENGTH </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > WEIGHT </td>
				<td rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > &nbsp; &nbsp;QTY&nbsp; &nbsp; </td>
				<td rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' >Total Length</td>
				<td rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > PRICE </td>
				<td rowspan="2" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > &nbsp; &nbsp;AMOUNT &nbsp; &nbsp; </td>
			</tr>
			<tr>
				<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > FEET </td>
				<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > FT.IN </td>
				<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > MILI </td>
				<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > METER </td>
				<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > TON </td>
			</tr>			 
			
		<?php  
		$sno=1;			
		foreach($invoice_entry_prd_edit as $getDetail){
	
		//if($getDetail['advance_entry_product_detail_entry_type']==1){
			?>
				<tr>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=$sno++?> </td>
					<td class="report-border-right report-border-bottom " style='text-align:center;font-size:11px;' > 
						<?=$getDetail['product_name']?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=$getDetail['p_colour_name']?></td>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=$arr_thick[$getDetail['advance_entry_product_detail_product_thick']]?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=number_format($getDetail['advance_entry_product_detail_sl_feet'],2,'.','')?> </td>
						<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=number_format($getDetail['advance_entry_product_detail_sl_feet_in'],2,'.','')?> </td>
						<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=number_format($getDetail['advance_entry_product_detail_sl_feet_mm'],2,'.','')?> </td>
						<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=number_format($getDetail['advance_entry_product_detail_sl_feet_met'],2,'.','')?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=number_format($getDetail['advance_entry_product_detail_s_weight_inches'],2,'.','')?> </td>	
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=number_format($getDetail['advance_entry_product_detail_qty'],3,'.','')?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=number_format($getDetail['advance_entry_product_detail_tot_length'],2,'.','')?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=number_format($getDetail['advance_entry_product_detail_rate'],2,'.','')?> </td>
					<td class="report-border-bottom" style='text-align:center;font-size:11px;' > 
						<?=number_format($getDetail['advance_entry_product_detail_total'],2,'.','')?> </td>
				</tr>
	
		
	<?php // } 
		} 
		?>	

		</table>
		<?php
	}
	
 ?>
</tbody>
 </table>

<br/>	
<table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > GROSS AMOUNT </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['advance_entry_gross_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right " style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > Transportation Charges </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['advance_entry_transport_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right " style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<!--<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > Tax : &nbsp;&nbsp;&nbsp;&nbsp; <?=number_format($invoice_entry_edit['advance_entry_tax_per'],0,'.','')?> % </td>-->

		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['advance_entry_tax_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right " style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > ADVANCE </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['advance_entry_advance_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right " style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > NET TOTAL </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['advance_entry_net_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
</table>
   
		
<table width="100%" style="padding-top:80px;" align="left">
	<tr>
		<td>Cashier :</td>
		<td>Sales Person :</td>
		<td>Customer :</td>
	</tr>
</table>
</body>


</html>
