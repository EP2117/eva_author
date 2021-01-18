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
 	 <td width="100%" colspan="4" class="report-border-bottom report-border-top report-border-right report-border-left" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > Production Order </td>
	</tr>
   <tr>
   	 <td width="50%" colspan="2" class="report-border-right report-border-left report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?=$invoice_entry_edit['customer_name']?></td>
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >INVOICE NO : &nbsp;<?=$invoice_entry_edit['invoice_entry_no']?></td>
	 
	</tr>
	<tr>	 
	 <td width="50%" colspan="2" class="report-border-right report-border-left report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >ADDRESS:&nbsp;&nbsp;<?=$invoice_entry_edit['customer_billing_address']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >PRODUCTION ORDER NO : <?=$invoice_entry_edit['production_order_no']?></td>
	</tr>
	<tr>	 
	 <td colspan="2" class="report-border-right report-border-left report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;'>PHONE NO:&nbsp;&nbsp;<?=$invoice_entry_edit['customer_mobile_no']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($invoice_entry_edit['production_order_date'])?></td>
	</tr>
	<tr>	 
	 <td colspan="2" class="report-border-right report-border-left report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;'></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >DELIVERY DATE : <?=dateGeneralFormatN($invoice_entry_edit['production_order_validity_date'])?></td>
	</tr>
	
 </table>
 <br>
 <table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
 
  <tr>
	  <td colspan="8" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
  </tr>
	<thead>
		<?php // if($invoice_entry_edit['production_order_type_id']==1){ ?>
			<!--<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK </td>
				
			<!--	<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WD.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WD.MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SW.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SW.MM </td>-->
				
				<!--<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> METER </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TON </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
				<td class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TOTAL  </td>

			</tr>-->
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Sr</td>
				<td colspan="3" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Item</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Length</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>Sale<br />QTY</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>PO<br />QTY</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>Non-PO<br />QTY</td>
			</tr>
		<?php //}?>
	</thead>
	<tbody>
<?php
	$k=1;
	foreach($invoice_entry_prd_edit as $getDetail){
	    
	   // print_r($arr_thick);exit;

?>
			<!--<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_colour_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$arr_thick[number_format($getDetail['production_order_product_detail_product_thick'],0)]?> </td>
				<!--<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['	production_order_product_detail_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['production_order_product_detail_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['production_order_product_detail_s_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['production_order_product_detail_s_width_mm']?> </td>-->
				<!--<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=number_format($getDetail['production_order_product_detail_sl_feet'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=number_format($getDetail['production_order_product_detail_sl_feet_in'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['production_order_product_detail_sl_feet_mm'])?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['production_order_product_detail_sl_feet_met'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['production_order_product_detail_s_weight_inches'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=round($getDetail['production_order_product_detail_qty'])?> </td>
				<td class="	report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['production_order_product_detail_tot_length'],2,'.','')?> </td>	
			</tr>-->
			
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;border-right:0px;'>
					<?php
						if($getDetail['production_order_product_detail_product_type'] == 4) {
							echo $getDetail['product_name'];
						} else {
							if($getDetail['brand_name'] != 'other') {
								echo $getDetail['brand_name'].' '. $getDetail['product_name'];
							} else {
								echo $getDetail['product_name'];
							}
						}
					?>
				</td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;border-right:0px;border-left:0px;'> 
					<?=$getDetail['product_colour_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;border-left:0px'> 
					<?=$arr_thick[number_format($getDetail['production_order_product_detail_product_thick'],0)] ? $arr_thick[number_format($getDetail['production_order_product_detail_product_thick'],0)].'mm' : '';?> </td>
				<?php
					if($getDetail['production_order_product_detail_product_type'] == 1) {
				?>
					<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['production_order_product_detail_sale_length'];?> </td>
					<?php
						/* if($getDetail['invoice_entry_product_detail_sl_feet'] == "" || $getDetail['invoice_entry_product_detail_sl_feet'] <= 0) {
							$feet = $getDetail['invoice_entry_product_detail_sl_feet_in']/12;
						} else {
							$feet = $getDetail['invoice_entry_product_detail_sl_feet'];
						} */
						if($getDetail['production_order_product_detail_qty'] > 0) {
							$feet = $getDetail['production_order_product_detail_tot_length']/ $getDetail['production_order_product_detail_qty'];
							
						}else{
							if($getDetail['production_order_product_detail_sl_feet'] == "" || $getDetail['production_order_product_detail_sl_feet'] <= 0) {
								$feet = $getDetail['production_order_product_detail_sl_feet_in']/12;
							} else {
								$feet = $getDetail['production_order_product_detail_sl_feet'];
							}
						}
						
						$feet = $feet == 0 ? '' : $feet;
					?>
					<!--<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					
					<?=number_format($feet,2,'.','')?> 
					</td>-->
				<?php
					}
					else if($getDetail['production_order_product_detail_product_type'] == 2){
				?>
					<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>
						<?php
						  if($getDetail['production_order_product_detail_s_weight_inches'] == 0) {
							echo '';
						  } else {
							echo sprintf('%0.3f',$getDetail['production_order_product_detail_s_weight_inches']);
						  }
						?>
					</td>
					<!--<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
						<?php
						  if($getDetail['production_order_product_detail_s_weight_met'] == 0) {
							echo '';
						  } else {
							echo round($getDetail['production_order_product_detail_s_weight_met']);
						  }
						?>
					</td>-->
				<?php } else { 
						if($getDetail['production_order_product_detail_sale_by'] == 'feet') {
				?>					
					<td class="report-border-right report-border-bottom" ><?php echo round($getDetail['production_order_product_detail_sale_feet'])."'"; ?></td><!--<td class="report-border-right report-border-bottom" ></td>-->
				<?php 
					}
					else {
				?>
					<td class="report-border-right report-border-bottom" ></td><!--<td class="report-border-right report-border-bottom" ></td>-->
				<?php
					}
					
					} 
				?>
				
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'> 
					<?php
					  if($getDetail['production_order_product_detail_qty'] == 0 || $getDetail['production_order_product_detail_sale_by'] == 'feet') {
						echo '';
					  } else {
						//echo sprintf('%0.2f',$getDetail['invoice_entry_product_detail_qty']);
						echo round($getDetail['production_order_product_detail_qty']);
					  }
					?>
				</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'> 
					<?php
						if($getDetail['production_order_product_detail_sale_by'] == 'feet') {
							echo round($getDetail['production_order_product_detail_po_qty'])."'";
						} else {
							echo round($getDetail['production_order_product_detail_po_qty']);
						}
						//echo round($getDetail['production_order_product_detail_po_qty']);
					?>
				</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'> 
					<?php
						if($getDetail['production_order_product_detail_sale_by'] == 'feet') {
							echo round($getDetail['production_order_product_detail_non_po_qty'])."'";
						} else {
							echo round($getDetail['production_order_product_detail_non_po_qty']);
						}
						//echo round($getDetail['production_order_product_detail_non_po_qty']);
					?>
				</td>
			</tr>

	<?php  $k++; } ?>
</tbody>
 </table>

<br/>	
<!--<table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'>Sales man :  <?=$invoice_entry_edit['salesman_name']?></td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > GROSS AMOUNT </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_gross_amount']?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class=" report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'>Payment date :  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > Transportation Charges </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_transport_amount']?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'>Previous balance : </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > Tax : &nbsp;&nbsp;&nbsp;&nbsp; <?=$invoice_entry_edit['invoice_entry_tax_per']?> % </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_tax_amount']?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'>Delivery date : </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > ADVANCE </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_advance_amount']?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%'>  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%'> DISCOUNT </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%'> <?=$invoice_entry_edit['invoice_entry_net_amount']?> &nbsp;&nbsp;</td>
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
-->   
			
<table style="padding-top:80px;" align="left">
	<tr>
		<td style="font-family:zawgyi-one; font-size:12px;"> ထုတ္လုပ္သူ</td>
		<td style="width:200px;">........................................</td>
	</tr>
	<tr>
		<td style="font-family:zawgyi-one; font-size:12px;padding-top:20px;">စက္အမွတ္</td>
		<td style="width:200px;padding-top:20px;">........................................</td>
</table>	

</body>


</html>
