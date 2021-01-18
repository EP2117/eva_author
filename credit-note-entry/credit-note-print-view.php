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

<body style="">

   <table style="width:100%;font-size:12px;padding-top:180px;" cellspacing="0"  ><!--class="report-outer-table"-->

  <!-- <tr>
	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' >EVE STEEL <br/><span style="font-size:14px;"> </span></td>
	</tr>-->
	<tr>
 	 <td width="100%" colspan="4" class="report-border-left report-border-right report-border-top report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > INVOICE </td>
	</tr>
   <tr>
   	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?=$credit_note_edit['customer_name']?></td>
	  <td width="50%" colspan="2" class=" report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >TYPE : &nbsp;<?=$arr_credit_type[$credit_note_edit['credit_note_entry_type']]?></td>
	 
	</tr>
	<tr>	 
	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >ADDRESS:&nbsp;&nbsp;<?=$credit_note_edit['customer_billing_address']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >INVOICE NO : <?=$credit_note_edit['branch_prefix'].$credit_note_edit['credit_note_entry_no']?></td>
	</tr>
	<tr>	 
	 <td colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;'>PHONE NO:&nbsp;&nbsp;<?=$credit_note_edit['customer_mobile_no']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($credit_note_edit['credit_note_entry_date'])?></td>
	</tr>
	
 </table>
 <br>
  <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="17" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >INVOICE DETAILS </td>
	  </tr>
                                   <tr >

                            <td colspan="8" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>Inv No</td>

                            <td  colspan="9" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>Inv Date</td>

                                        </tr>

										<tr>
										
								<td colspan="8" class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'> 
								<?=$credit_note_sls_edit['invoice_entry_no']?> </td>
							<td colspan="9" class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'> 
								<?=dateGeneralFormatN($credit_note_sls_edit['invoice_entry_date'])?></td>
										</tr>

									
								</table>
 <br>
	 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="17" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
	  </tr>
		<?php 
		$arr_type	= explode(",",$credit_note_edit['credit_note_entry_id']);
		
		//if(in_array("1",$arr_type)==1){ ?>
			<tr>
				<td colspan="5" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>WIDTH</td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>SALES WIDTH</td>
				<td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>SALES LENGTH</td>
				<td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
			</tr>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> BRAND </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK </td>
				
				
				
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Met </td>
				
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Total Length </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Rate </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Amount </td>
				</tr>
		<?php  $k = 1; foreach($credit_note_prd_edit as $getDetail){
				//if($getDetail['invoice_entry_product_detail_entry_type']==1){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k++?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['brand_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['p_colour_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$arr_thick[$getDetail['credit_note_entry_product_detail_product_thick']]?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=number_format($getDetail['credit_note_entry_product_detail_width_inches'],2,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['credit_note_entry_product_detail_width_mm'])?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['credit_note_entry_product_detail_s_width_inches'],2,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['credit_note_entry_product_detail_s_width_mm'],3,'.','')?> </td>	
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['credit_note_entry_product_detail_sl_feet'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['credit_note_entry_product_detail_sl_feet_in'],3,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['credit_note_entry_product_detail_sl_feet_mm'])?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format( $getDetail['credit_note_entry_product_detail_sl_feet_met'],3,'.','')?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=round($getDetail['credit_note_entry_product_detail_qty'])?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['credit_note_entry_product_detail_tot_length'],2,'.','')?> </td>
				
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?= number_format($getDetail['credit_note_entry_product_detail_rate'],2,'.','')?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=number_format($getDetail['credit_note_entry_product_detail_total'])?> </td>
				
			</tr>

	
<?php /// }
		
				}
			// }
			 
		?>
		</table>
		<br/>	


</body>


</html>
