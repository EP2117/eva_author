<!DOCTYPE html>
<html>
<head>
    <title>WIDTH CUTTING</title>
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
 	 <td width="100%" colspan="4" class="report-border-left report-border-right report-border-top report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > PRODUCTION ORDER </td>
	</tr>
      <tr>	 
	 <td  colspan="4" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >PRODUCTION ORDER NO :&nbsp;&nbsp; <?=$width_cutting_edit['production_order_no']?></td>
	 
	</tr>
   <tr>
   	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >BRNCH :&nbsp;&nbsp;<?=$width_cutting_edit['branch_name']?></td>
	  <td width="50%" colspan="2" class=" report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >PRODUCTION SECTION : &nbsp;<?=$width_cutting_edit['production_section_name']?></td> 
	</tr>
	<tr>	 
	 <td  colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >DATE :&nbsp;&nbsp; <?=dateGeneralFormatN($width_cutting_edit['production_order_date'])?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >PRODUCTION TYPE : <?=$arr_producton_type[$width_cutting_edit['production_order_type']]?></td>
	</tr>
    
  
	
 </table>
 <br>
 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="21" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
	  </tr>
                <thead>
				<tr>
				<td colspan="5" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>LENGTH</td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>SALES WIDTH</td>
				<td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>SALES LENGTH</td>
				<td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>EXTR LENGTH</td>
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
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.IN </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TOTAl </td>
			
										</tr>

                                    </thead>

                                    <tbody id="product_detail_display">

										<?php 
										$k = 1;

										$row_cnt	= 0;

										$arr_cnt	= count($width_cutting_prd_edit);

										foreach($width_cutting_prd_edit as $get_product_detail){
											$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_nam'];
												$product_thick_ness		= $get_product_detail['production_order_product_detail_product_thick'];
										
										if($get_product_detail['production_order_product_detail_entry_type']==1){
											
											

										?>
										
										<tr>
                                       	  <td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> 
											<?=$k++?> </td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['brand_name']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> <?=$product_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$product_colour_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> <?=$arr_thick[number_format($product_thick_ness)]?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_width_inches']?></td> 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_width_mm']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_s_width_inches']?></td> 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_s_width_mm']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_sl_feet']?></td> 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_sl_feet_in']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_sl_feet_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_sl_feet_met']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_ext_feet']?></td> 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_ext_feet_in']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_ext_feet_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_ext_feet_met']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_qty']?></td> 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_tot_length']?></td>
			
										</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } }?>									

									</tbody>

								</table>
								<br>
								
 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
			 <tr>
				<td colspan="21" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' > Child Product Details </td>
			</tr>        
				 <thead>
              <tr>
				<td colspan="5" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>LENGTH</td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>SALES WIDTH</td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>SALES LENGTH</td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>TOTAl LENGTH</td>
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
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TON </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> KG </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MET </td>
			
										</tr>

                                    </thead>
                                    <tbody id="child_product_detail_display">
										<?php
										$k = 1;
											foreach($width_cutting_prd_edit as $get_chd_prd_detail){
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_nam'];
												$product_thick_ness		= $get_product_detail['production_order_product_detail_product_thick'];
											if($get_product_detail['production_order_product_detail_entry_type']==2){
											?>
											
					                       <tr>
                                           <td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> 
											<?=$k++?> </td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' ><?=$get_product_detail['brand_name']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' ><?=$product_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$product_colour_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> <?=$arr_thick[number_format($product_thick_ness)]?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_width_inches']?></td> 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_s_width_inches']?></td> 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_s_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_s_weight_inches']?></td> 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_s_weight_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_tot_feet']?></td> 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['production_order_product_detail_tot_meter']?></td>
										</tr>
	<?php } }?>
									</tbody>
								</table>
								<br>
								 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="13" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >Width Cutting 
		  </td>
	  </tr>          <thead>
	 
                 <tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3"> S.NO </td>
				 <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="4">NAME</td>
                 <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3">UOM</td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3">QTY</td>
				</tr>
				                      
                                    </thead>
                                    <tbody id="width_detail_display">
									<?php 
										$k = 1;
										$row_cnt	= 1;
										$arr_cnt	= count($width_cutting_prd_edit);
										foreach($width_cutting_prd_edit as $get_product_detail){
										if($get_product_detail['production_order_product_detail_entry_type']==4){
										?>
								
											<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="3"> 
					<?=$k++?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="4"><?=$product_name?></td> 
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="3"><?=$product_uom_name?></td>
			    <td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="3"><?=$get_product_detail['production_order_product_detail_qty']?></td>
											
										</tr>

										


										<?php 

											$row_cnt	= $row_cnt+1;	

										 }} ?>	
									</tbody>
								</table>


	 
	 

<br/>	



	<tr>
		<td colspan="4" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;'> REMARK :  </td>
	</tr>

	
</table>
   

</body>


</html>
