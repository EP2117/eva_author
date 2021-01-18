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
 	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > DELIVERY FOR SALE </td>
	</tr>
   <tr>
   	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?=$invoice_entry_edit['customer_name']?></td>
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:13px;' >INVOICE NO : &nbsp;<?=$invoice_entry_edit['invoice_entry_no']?></td>
	 
	</tr>
	<tr>	 
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >ADDRESS:&nbsp;&nbsp;<?=$invoice_entry_edit['delivery_entry_address']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:13px;' >DELIVERY NO : <?=$invoice_entry_edit['delivery_entry_no']?></td>
	</tr>
	<tr>	 
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;'>PHONE NO:&nbsp;&nbsp;<?=$invoice_entry_edit['customer_mobile_no']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($invoice_entry_edit['delivery_entry_date'])?></td>
	</tr>
	
 </table>
 <br>
 <table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
 
  <tr>
	  <td colspan="12" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
  </tr>
	<thead>
		<?php 
		$arr_type	= explode(",",$invoice_entry_edit['delivery_entry_type_id']);
			
		if(in_array("1",$arr_type)==1){ ?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WD.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WD.MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SW.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SW.MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Sl.FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Sl.FT.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SL.FT.MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TOTAL LENGTH </td>

			</tr>
		</thead>
		<tbody>
		<?php 
		$k=1;
			foreach($invoice_entry_prd_edit as $getDetail){

 			if($getDetail['delivery_entry_product_detail_entry_type']==1){ ?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['p_colour_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_product_thick']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_s_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_s_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_sl_feet']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_sl_feet_in']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_sl_feet_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_total']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_tot_length']?> </td>
			</tr>

	
<?php }
		
			}
		}
		?>
		</tbody>
		</table>
		<br>
 <table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
		<?php		
		 if(in_array("2",$arr_type)==1){?>
		 	<thead>
			<tr>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WD.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WD.MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SW.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SW.MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SWGHT.TON </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SWGHT.KG </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
			</tr>
			</thead>
		<tbody>	
		<?php 
			foreach($invoice_entry_prd_edit as $getDetail){

 				if($getDetail['delivery_entry_product_detail_entry_type']==2){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['p_colour_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_product_thick']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['	delivery_entry_product_detail_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_s_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_s_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_s_weight_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_s_weight_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['delivery_entry_product_detail_qty']?> </td>
			</tr>
<?php }
		
			}
		}
		?>
		</tbody>
		</table>
		<br>
		<?php		if(in_array("4",$arr_type)==1){?>	
		 <table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
		 	<thead>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> UOM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
			</tr>
			</thead>
			<tbody>
			<?php
			$k=1;
			foreach($invoice_entry_prd_edit as $getDetail){
				if($getDetail['delivery_entry_product_detail_entry_type']==4){?>	
					<tr>
						<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
							<?=$getDetail['product_name']?> </td>
						<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
							<?=$getDetail['product_uom_name']?> </td>
						<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
							<?=$getDetail['delivery_entry_product_detail_qty']?> </td>
						<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					</tr>
		<?php } $k++; } ?>
		</tbody>
	
	


 </table>
<?php } ?>
<br/>	
<table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
	<tr>
		<td class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%'>Vehicle Number :  <?=$invoice_entry_edit['delivery_entry_vehicle_no']?></td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:25%' > <?=$invoice_entry_edit['delivery_entry_vehicle_no']?> &nbsp;&nbsp;</td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > Driver Name </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:25%' > <?=$invoice_entry_edit['delivery_entry_driver_name']?> &nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td lass=" report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;width:25%'>Delivery  Person Name :  </td>
		<td class="report-border-left report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:15%' > <?=$invoice_entry_edit['delivery_entry_person_name']?> &nbsp;&nbsp;</td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:25%' > Time</td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:25%' > <?=$invoice_entry_edit['delivery_entry_time']?> &nbsp;&nbsp;</td>
	</tr>
	
	
</table>
   
		

</body>


</html>
