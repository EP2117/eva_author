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
 	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > GRN  </td>
	</tr>
   <tr>
   	
      <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >GRN NO : <?=$invoice_entry_edit['grn_entry_no']?></td>
     
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:13px;' >GIN NO : &nbsp;<?=$invoice_entry_edit['gin_entry_no']?></td>
	 
	</tr>
	<tr>	 
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?=$invoice_entry['customer_name']?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($invoice_entry_edit['grn_entry_date'])?></td>
	</tr>
	
	
 </table>
 <br>
 
 <table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">

 <tr>
	  <td colspan="18" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >ENTRY DETAILS </td>
  </tr>

                                    <thead>

                                        <tr >

                                            <th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3">GIN No</th>

                                            <th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3">Date</th>

                                            <th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="4">Type</th>
											
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="4">PO No</th>
											
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="4">Customer</th>

                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

										<tr>

										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="3"><?=$invoice_entry['gin_entry_no']?></td>

										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="3"><?=dateGeneralFormatN($invoice_entry['gin_entry_date'])?>
										
										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="4"><?=$arr_producton_type[$invoice_entry['gin_entry_type']]?>
										
										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="4"><?=$invoice_entry['production_order_no']?>
										
										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="4"><?=$invoice_entry['customer_name']?></td>

										

										</tr>

									</tbody>

								</table>
 
 <br>
 <table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
 
  <tr>
	  <td colspan="18" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
  </tr>
	<thead>
		<?php if($invoice_entry_edit['grn_entry_type_id']==1){ ?>
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
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SL.FT.MET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> EX.FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> EX.FT.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> EX.FT.MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> EX.FT.MET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TOTAL LENGTH </td>
			</tr>
		<?php }elseif($invoice_entry_edit['grn_entry_type_id']==2){?>
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
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TOTAL LN FT </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TOTAL LN MTR </td>
			</tr>
		<?php }else{?>	
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="4"> S.NO </td>
                <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="4"> BRAND </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="4"> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3"> UOM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3"> QTY </td>
			</tr>
		<?php } ?>
	</thead>
	<tbody>
<?php
	$k=1;
	foreach($invoice_entry_prd_edit as $getDetail){

 if($invoice_entry_edit['grn_entry_type_id']==1){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['p_colour_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$arr_thick[$getDetail['grn_entry_product_detail_product_thick']]?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_s_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_s_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_sl_feet']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_sl_feet_in']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_sl_feet_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_sl_feet_met']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_ext_feet']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_ext_feet_in']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_ext_feet_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_ext_feet_met']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_qty']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_tot_length']?> </td>
			</tr>

	
<?php }elseif($invoice_entry_edit['grn_entry_type_id']==2){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['p_colour_name']?></td>
                    <td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$arr_thick[$getDetail['grn_entry_product_detail_product_thick']]?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_s_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_s_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_s_weight_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_s_weight_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_tot_feet']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_product_detail_tot_meter']?> </td>
			</tr>
<?php }else{?>	
			<tr>
                <td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="4"> 
					<?=$k?> </td>
                <td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'  colspan="4"> 
					<?=$getDetail['brand_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'  colspan="4"> 
					<?=$getDetail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' colspan="3"> 
					<?=$getDetail['p_uom_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' colspan="3"> 
					<?=$getDetail['grn_entry_product_detail_qty']?> </td>
			</tr>
<?php } $k++; } ?>
</tbody>
</table>

<br>

 <table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
 
  <tr>
	  <td colspan="10" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >RAW PRODUCT DETAILS </td>
  </tr>
	<thead>
		<tr>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR </td>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK </td>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WD.IN </td>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WD.MM </td>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Sl.FEET </td>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Sl.MTR </td>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WG.TON </td>
			<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WG.KG </td>
		</tr>
	</thead>
	<tbody>
<?php
	$j=1;
	foreach($invoice_entry_roaw_prd_edit as $getDetail){?>
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$j?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_con_entry_child_product_detail_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['product_colour_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$arr_thick[$getDetail['grn_entry_raw_product_detail_product_thick']]?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_raw_product_detail_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_raw_product_detail_width_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_raw_product_detail_sl_feet']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_raw_product_detail_sl_feet_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_raw_product_detail_ton']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$getDetail['grn_entry_raw_product_detail_kg']?> </td>
				
			</tr>
		<?php }?>
	</tbody>
</table>


<br/>	





	<tr>
		<td colspan="4" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;'> REMARK : <?=$invoice_entry_edit['invoice_entry_remark']?> </td>
	</tr>
 		

</body>


</html>
