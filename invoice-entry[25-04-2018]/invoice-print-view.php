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

   <table style="width:100%;font-size:12px;" cellspacing="0"  class="report-outer-table">

   <tr>
	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' ><!--<img src="" alt='' title='' width='70' align="center" /><br/>-->EVE STEEL <br/><span style="font-size:14px;"> </span></td>
	</tr>
	<tr>
 	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > INVOICE </td>
	</tr>
   <tr>
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >INVOICE NO : &nbsp;<?=$invoice_entry_edit['invoice_entry_no']?></td>
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_date'])?></td>
	</tr>
	<tr>
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?=$invoice_entry_edit['customer_name']?></td>
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' ></td>
	</tr>
	
 </table>
 <br>
 <table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
 
  <tr>
	  <td colspan="7" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
  </tr>
	<thead>
		<?php if($invoice_entry_edit['invoice_entry_type_id']==1){ ?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > BRAND </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > THICK </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > QTY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > RATE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > AMOUNT </td>
			</tr>
		<?php }elseif($invoice_entry_edit['invoice_entry_type_id']==2){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > BRAND </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > THICK </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > TON </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > RATE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > AMOUNT </td>
			</tr>
		<?php }else{?>	
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > UOM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > QTY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > RATE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' > AMOUNT </td>
			</tr>
		<?php } ?>
	</thead>
	<tbody>
<?php
	foreach($invoice_entry_prd_edit as $getDetail){

 if($invoice_entry_edit['invoice_entry_type_id']==1){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['brand_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['p_colour_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_product_thick']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_qty']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_rate']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_total']?> </td>
			</tr>

	
<?php }elseif($invoice_entry_edit['invoice_entry_type_id']==2){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['brand_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['p_colour_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_product_thick']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_s_weight_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_rate']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_total']?> </td>
			</tr>
<?php }else{?>	
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['product_uom_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_qty']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_rate']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['invoice_entry_product_detail_total']?> </td>
			</tr>
<?php } } ?>
</tbody>
 </table>

<br/>	
<table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > GROSS AMOUNT </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_gross_amount']?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > Transportation Charges </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_transport_amount']?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > Tax : &nbsp;&nbsp;&nbsp;&nbsp; <?=$invoice_entry_edit['invoice_entry_tax_per']?> % </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_tax_amount']?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > ADVANCE </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_advance_amount']?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > NET TOTAL </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_net_amount']?> &nbsp;&nbsp;</td>
	</tr>
</table>
   
		

</body>


</html>
