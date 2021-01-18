<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
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
 	 <td width="100%" colspan="4" class="report-border-right report-border-left report-border-top report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' >  INVOICE </td>
	</tr>
   <tr>
   	 <td colspan="2" class="report-border-right  report-border-left  report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;width:50%;' >CUSTOMER NAME :&nbsp;&nbsp;<?=$invoice_entry_edit['customer_name']?></td>
	  <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;width:50%;' >QUOTATION NO : &nbsp;<?=$invoice_entry_edit['branch_prefix'].$invoice_entry_edit['quotation_entry_no']?></td>
	 
	</tr>
	<tr>	 
	 <td colspan="2" class="report-border-right  report-border-left report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;width:50%;' >ADDRESS:&nbsp;&nbsp;<?=$invoice_entry_edit['customer_billing_address']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;width:50%;' >INVOICE NO : <?=$invoice_entry_edit['branch_prefix'].$invoice_entry_edit['invoice_entry_no']?></td>
	</tr>
	<tr>	 
	 <td colspan="2" class=" report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;width:50%;'>PHONE NO:&nbsp;&nbsp;<?=$invoice_entry_edit['customer_mobile_no']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;width:50%;' >DATE : <?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_date'])?></td>
	</tr>
	
 </table>
 <br>
	 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="16" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
	  </tr>
		<?php 
		$arr_type	= explode(",",$invoice_entry_edit['invoice_entry_type_id']);
		
		//if(in_array("1",$arr_type)==1){ ?>
			<tr>
			<td class="report-border-right report-border-bottom" colspan="4"></td>
			<td class="report-border-right report-border-bottom" colspan="4" style='text-align:center;'>LENGTH</td>
			<td class="report-border-right report-border-bottom" style='text-align:center;'>WEIGHT</td>
			<td class="report-border-right report-border-bottom" colspan="4"></td>
		</tr>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK </td>
				
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.MET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TON </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TOTAL LENGTH </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> PRICE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> AMOUNT </td>

			</tr>
		<?php  $k = 1; foreach($invoice_entry_prd_edit as $getDetail){
				//if($getDetail['invoice_entry_product_detail_entry_type']==1){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k++?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['p_colour_name']?></td>
				<!--<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['invoice_entry_product_detail_product_thick']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['	invoice_entry_product_detail_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['invoice_entry_product_detail_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['invoice_entry_product_detail_s_width_inches']?> </td>-->
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_s_width_mm'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_sl_feet'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_sl_feet_in'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_sl_feet_mm'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_sl_feet_met'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_s_weight_inches'],3,'.','')?> </td>	
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_qty'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_tot_length'],2,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_rate'],2,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_total'],2,'.','')?> </td>
			</tr>

	
<?php // }
		
				//}
			 }
			 
		?>
		</table>
	 
	 

<br/>	
<table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'>Sales man :  <?=$invoice_entry_edit['salesman_name']?></td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > GROSS AMOUNT </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['invoice_entry_gross_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class=" report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'>Payment date : <?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_due_date'])?>  </td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > Transportation Charges </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['invoice_entry_transport_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'>Previous balance : </td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > Tax : &nbsp;&nbsp;&nbsp;&nbsp; <?=number_format($invoice_entry_edit['invoice_entry_tax_per'],0,'.','')?> % </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['invoice_entry_tax_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'>Delivery date : <?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_validity_date'])?></td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > ADVANCE </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=number_format($invoice_entry_edit['invoice_entry_advance_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%'>  </td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%'> NET </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%'> <?=number_format($invoice_entry_edit['invoice_entry_net_amount'],0,'.','')?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;'> REMARK : <?=$invoice_entry_edit['invoice_entry_remark']?> </td>
	</tr>
	<tr>
		<td colspan="4" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;'> 
			BANK DETAILS :			
			
		</td>
	</tr>
</table>
   
<table width="100%" style="padding-top:100px;" >
	<tr>
		<td>Cashier :</td>
		<td>Sales Person :</td>
		<td>Customer :</td>
	</tr>
</table>		

</body>


</html>
