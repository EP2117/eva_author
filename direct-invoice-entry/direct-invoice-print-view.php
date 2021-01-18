<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style type="text/css" media="all">
@page{
margin-top: 50.8mm;
margin-footer: 12.7mm;
}

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

<body style="">

   <table style="width:100%;font-size:12px;" cellspacing="0"  ><!--class="report-outer-table"-->

  <!-- <tr>
	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' >EVE STEEL <br/><span style="font-size:14px;"> </span></td>
	</tr>-->
	<tr>
 	 <td width="100%" colspan="4" class="report-border-left report-border-right report-border-top report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > INVOICE </td>
	</tr>
   <tr>
   	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?=$invoice_entry_edit['customer_name']?></td>
	  <td width="50%" colspan="2" class=" report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >QUOTATION NO : &nbsp;<?php if($invoice_entry_edit['invoice_entry_quotation_entry_id']!='0'){echo $invoice_entry_edit['invoice_entry_quotation_entry_id'];}else{  }?></td>
	 
	</tr>
	<tr>	 
	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >ADDRESS:&nbsp;&nbsp;<?=$invoice_entry_edit['customer_billing_address']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >INVOICE NO : <?=$invoice_entry_edit['invoice_entry_no']?></td>
	</tr>
	<tr>	 
	 <td colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;'>PHONE NO:&nbsp;&nbsp;<?=$invoice_entry_edit['customer_mobile_no']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_date'])?></td>
	</tr>
	
 </table>
 <br>
	 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="10" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
	  </tr>
		<?php 
		$arr_type	= explode(",",$invoice_entry_edit['invoice_entry_type_id']);
		
		//if(in_array("1",$arr_type)==1){ ?>
			<!--<tr>
				<td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
				<td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>LENGTH</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>WEIGHT</td>
				<td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
			</tr>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK </td>
				
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> METER </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TON </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TOTAL LENGTH </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> PRICE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> AMOUNT </td>

			</tr>-->
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Sr</td>
				<td colspan="3" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Item</td>
				<td colspan = "2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Length</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY</td>
				<td class="report-border-right report-border-bottom" style='width:110px;text-align:center;font-weight:bold;font-size:11px;'> Total Length</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Price</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Amount</td>
			</tr>
		<?php  $k = 1; foreach($invoice_entry_prd_edit as $getDetail){
				//if($getDetail['invoice_entry_product_detail_entry_type']==1){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k++?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;border-right:0px;'>
					<?php
						if($getDetail['invoice_entry_product_detail_product_type'] == 4) {
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
					<?=$getDetail['p_colour_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;border-left:0px'> 
					<?=$arr_thick[$getDetail['invoice_entry_product_detail_product_thick']] ? $arr_thick[$getDetail['invoice_entry_product_detail_product_thick']].'mm' : ''; ?> </td>
					
				<?php
					if($getDetail['invoice_entry_product_detail_product_type'] == 1) {
				?>
					<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['invoice_entry_product_detail_sale_length'];?> </td>
					<?php
						/* if($getDetail['invoice_entry_product_detail_sl_feet'] == "" || $getDetail['invoice_entry_product_detail_sl_feet'] <= 0) {
							$feet = $getDetail['invoice_entry_product_detail_sl_feet_in']/12;
						} else {
							$feet = $getDetail['invoice_entry_product_detail_sl_feet'];
						} */
						if($getDetail['invoice_entry_product_detail_qty'] > 0) {
							$feet = $getDetail['invoice_entry_product_detail_tot_length']/ $getDetail['invoice_entry_product_detail_qty'];
							
						}else{
							if($getDetail['invoice_entry_product_detail_sl_feet'] == "" || $getDetail['invoice_entry_product_detail_sl_feet'] <= 0) {
								$feet = $getDetail['invoice_entry_product_detail_sl_feet_in']/12;
							} else {
								$feet = $getDetail['invoice_entry_product_detail_sl_feet'];
							}
						}
						
						$feet = $feet == 0 ? '' : $feet;
					?>
					<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					
					<?=number_format($feet,2,'.','')?> 
					</td>
				<?php
					}
					else if($getDetail['invoice_entry_product_detail_product_type'] == 2){
				?>
					<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>
						<?php
						  if($getDetail['invoice_entry_product_detail_s_weight_inches'] == 0) {
							echo '';
						  } else {
							echo sprintf('%0.3f',$getDetail['invoice_entry_product_detail_s_weight_inches']);
						  }
						?>
					</td>
					<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
						<?php
						  if($getDetail['invoice_entry_product_detail_s_weight_met'] == 0) {
							echo '';
						  } else {
							echo round($getDetail['invoice_entry_product_detail_s_weight_met']);
						  }
						?>
					</td>
				<?php } else { 
						if($getDetail['invoice_entry_product_detail_sale_by'] == 'feet') {
				?>					
					<td class="report-border-right report-border-bottom" ><?php echo round($getDetail['invoice_entry_product_detail_sale_feet'])."'"; ?></td><td class="report-border-right report-border-bottom" ></td>
				<?php 
					}
					else {
				?>
					<td class="report-border-right report-border-bottom" ></td><td class="report-border-right report-border-bottom" ></td>
				<?php
					}
					
					} 
				?>
				
				<!--<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_sl_feet_in'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_sl_feet_mm'])?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_sl_feet_met'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['invoice_entry_product_detail_s_weight_inches'],3,'.','')?> </td>-->
					
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'> 
					<?php
					  if($getDetail['invoice_entry_product_detail_qty'] == 0 || $getDetail['invoice_entry_product_detail_sale_by'] == 'feet') {
						echo '';
					  } else {
						//echo sprintf('%0.2f',$getDetail['invoice_entry_product_detail_qty']);
						echo round($getDetail['invoice_entry_product_detail_qty']);
					  }
					?>
				</td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?php
					if($getDetail['invoice_entry_product_detail_sale_by'] == 'feet') {
						if($getDetail['invoice_entry_product_detail_sale_feet'] == 0) {
						echo '';
					  } else {
						echo number_format($getDetail['invoice_entry_product_detail_sale_feet'],2,'.','');
					  }
					} else {
						   if($getDetail['invoice_entry_product_detail_tot_length'] == 0) {
							echo '';
						  } else {
							echo number_format($getDetail['invoice_entry_product_detail_tot_length'],2,'.','');
						  }
					}
					?>
				</td>
				<td class="report-border-right report-border-bottom" style='width:100px;text-align:right;font-size:11px;'> 
					<?php
					  if($getDetail['invoice_entry_product_detail_rate'] == 0) {
						echo '';
					  } else {
						echo number_format($getDetail['invoice_entry_product_detail_rate']);
					  }
					?>
				</td>
				<td class="report-border-right report-border-bottom" style='width:120px;text-align:right;font-size:11px;'> 
					<?php
					  if($getDetail['invoice_entry_product_detail_total'] == 0) {
						echo '';
					  } else {
						echo number_format($getDetail['invoice_entry_product_detail_total']);
					  }
					?>
				</td>
			</tr>	
		<?php 
				}
		
		?>
		</table>
	 
	 

<br/>	



<table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'></td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > GROSS AMOUNT </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > 
		<?php
		  if($invoice_entry_edit['invoice_entry_gross_amount'] == 0) {
			echo '';
		  } else {
			echo number_format($invoice_entry_edit['invoice_entry_gross_amount']);
		  }
		?>
		&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="2" class=" report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'>Payment date : <?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_due_date'])?></td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > Transportation Charges </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > 
			<?php
			  if($invoice_entry_edit['invoice_entry_transport_amount'] == 0) {
				echo '';
			  } else {
				echo number_format($invoice_entry_edit['invoice_entry_transport_amount']);
			  }
			?>
			&nbsp;&nbsp;
		</td>
	</tr>
<?php	if($invoice_entry_edit['invoice_entry_tax_status']==1){ ?>
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'></td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > Commercial Tax </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > 
			<?php
			  if($invoice_entry_edit['invoice_entry_tax_amount'] == 0) {
				echo '';
			  } else {
				echo number_format($invoice_entry_edit['invoice_entry_tax_amount']);
			  }
			?>
		&nbsp;&nbsp;
		</td>
	</tr>
<?php } ?>	
      <tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%'>  </td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%'> TOTAL </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%'>
		<?php
			$total = $invoice_entry_edit['invoice_entry_tax_amount'] + $invoice_entry_edit['invoice_entry_transport_amount'] + $invoice_entry_edit['invoice_entry_gross_amount'];
			echo $total == 0 ? '' : number_format($total);
		?>
		<?php //echo $invoice_entry_edit['invoice_entry_total_amount']==0 ? '' : number_format($invoice_entry_edit['invoice_entry_total_amount'])?> 
		&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right" style='text-align:left;font-weight:bold;font-size:11px;width:60%'><?php	if($invoice_entry_edit['invoice_entry_tax_status']!=1){ ?> <?php }else{ ?> Delivery date : <?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_validity_date'])?> <?php }?></td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%' > ADVANCE </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['invoice_entry_advance_amount']==0 ? '' : number_format(round($invoice_entry_edit['invoice_entry_advance_amount']))?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right " style='text-align:left;font-weight:bold;font-size:11px;width:60%'> <?php	if($invoice_entry_edit['invoice_entry_tax_status']!=1){ ?>Delivery date : <?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_validity_date'])?> <?php }?></td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%'> DISCOUNT </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%'> <?=$invoice_entry_edit['invoice_entry_dis_amount'] == 0 ? '' : number_format(round($invoice_entry_edit['invoice_entry_dis_amount']))?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:60%'>  </td>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%'> BALANCE </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%'>
		<?php
			$balance = $total - ($invoice_entry_edit['invoice_entry_advance_amount'] + $invoice_entry_edit['invoice_entry_dis_amount']);
			echo $balance == 0 ? '' : number_format($balance);
		?>
		<?php //echo $invoice_entry_edit['invoice_entry_net_amount']==0 ? : number_format($invoice_entry_edit['invoice_entry_net_amount'])?> 
		&nbsp;&nbsp;
		</td>
	</tr>
	<!--<tr>
		<td colspan="4" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;'> REMARK : <?=$invoice_entry_edit['invoice_entry_remark']?> </td>
	</tr>-->
	<tr>
		<td colspan="4"  class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;line-height:50px;vertical-align:text-top;'> 
			REMARK : <?=$invoice_entry_edit['invoice_entry_remark']?>		
			
		</td>
	</tr>
	
	
</table>
<div style="height:50px;">&nbsp;</div>
   
<!--<table width="100%" style="margin-top:50px;">
<tr>
		<td>Cashier :</td>
		<td>Sales Person :</td>
		<td>Customer :</td>
	</tr>
</table>-->		

</body>


</html>
