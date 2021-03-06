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
<table style="width:100%;font-size:12px;padding-top:80px;" cellspacing="0"  ><!--class="report-outer-table"-->

  <!-- <tr>
	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' >EVE STEEL <br/><span style="font-size:14px;"> </span></td>
	</tr>-->
	<tr>
 	 <td width="100%" colspan="4" class="report-border-left report-border-right report-border-top report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > WIDTH CUTTING </td>
	</tr>
    
     <tr>
   	 <td width="50%" colspan="4" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >INVOICE NO :&nbsp;&nbsp;<?=$width_cutting_edit['width_cutting_no']?></td></td> 
	</tr>
   <tr>
   	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >BRNCH :&nbsp;&nbsp;<?=$width_cutting_edit['branch_name']?></td>
	  <td width="50%" colspan="2" class=" report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >WHAREHOUSE : &nbsp;<?=$width_cutting_edit['godown_name']?></td> 
	</tr>
	<tr>	 
	 <td  colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >DATE :&nbsp;&nbsp; <?=dateGeneralFormatN($width_cutting_edit['width_cutting_date'])?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >PRODUCTION TYPE : <?=$arr_producton_type[$width_cutting_edit['width_cutting_type']]?></td>
	</tr>
	
 </table>
 <br>
 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="12" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
	  </tr>
                <thead>
				<tr>
				<td colspan="7" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>LENGTH</td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>WEIGHT</td>
				<td colspan="1" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
				</tr>

                 <tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> BRAND </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> PRD CODE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> UOM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK </td>
				
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TONE </td>
			
										</tr>

                                    </thead>

                                    <tbody id="product_detail_display">

										<?php 
										$k = 1;

										$row_cnt	= 0;

										$arr_cnt	= count($width_cutting_prd_edit);

										foreach($width_cutting_prd_edit as $get_product_detail){

										?>
										
										<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k++?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_product_detail['brand_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_product_detail['product_code']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_product_detail['product_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_product_detail['product_uom_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_product_detail['product_colour_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$arr_thick[$get_product_detail['product_thick_ness']]?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_product_detail['width_cutting_product_detail_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_product_detail['width_cutting_product_detail_width_mm']?> </td>	
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_product_detail['width_cutting_product_detail_length_feet']?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_product_detail['width_cutting_product_detail_length_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_product_detail['width_cutting_product_detail_qty']?> </td>
			</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>

								</table>
								<br>
 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="13" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >Width Cutting 
		  </td>
	  </tr>          <thead>
	 
                 <tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WIDTH </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>INCHES 1 </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES 2 </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES 3 </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES 4 </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
				
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> LENGTH </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
				</tr>
				                      
                                    </thead>
                                    <tbody id="width_detail_display">
									<?php 
										$k = 1;
										$row_cnt	= 1;
										$arr_cnt	= count($width_cutting_width_edit);
										foreach($width_cutting_width_edit as $get_product_detail){
										?>
										
										
										
											<tr>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> 
					<?=$k++?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> 
					<?=$get_product_detail['width_cutting_width_detail_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> 
					<?=$get_product_detail['width_cutting_width_detail_width_inches_one']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> 
					<?=$get_product_detail['width_cutting_width_detail_width_inches_two']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> 
					<?=$get_product_detail['width_cutting_width_detail_width_inches_three']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'> 
					<?=$get_product_detail['width_cutting_width_detail_width_inches_four']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:12px;'> 
					<?=$get_product_detail['width_cutting_width_detail_inches_qty']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:12px;'> 
					<?=$get_product_detail['width_cutting_width_detail_length']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:12px;'> 
					<?=$get_product_detail['width_cutting_width_detail_length_qty']?> </td>	
				
			</tr>

										


										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>	
									</tbody>
								</table>
								<br>
 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
			 <tr>
				<td colspan="13" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' > Child Product Details </td>
			</tr>        
				 <thead>
                <tr>
				<td colspan="7" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>LENGTH</td>
				<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>WEIGHT</td>
				<td colspan="1" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'></td>
				</tr>

                 <tr>
				 <tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> S.NO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> BRAND </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> PRD CODE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> UOM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK </td>
				
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TONE </td>
			</tr>
                                    </thead>
                                    <tbody id="child_product_detail_display">
										<?php
										$k = 1;
											foreach($product_con_entry_child_prd_edit as $get_chd_prd_detail){
											?>
											
						<tr>					
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$k++?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_chd_prd_detail['brand_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_chd_prd_detail['product_con_entry_child_product_detail_code']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_chd_prd_detail['product_con_entry_child_product_detail_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_chd_prd_detail['product_uom_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> 
					<?=$get_chd_prd_detail['product_colour_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$arr_thick[$get_chd_prd_detail['product_con_entry_child_product_detail_thick_ness']]?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_chd_prd_detail['product_con_entry_child_product_detail_width_inches']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_chd_prd_detail['product_con_entry_child_product_detail_width_mm']?> </td>	
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_chd_prd_detail['product_con_entry_child_product_detail_length_feet']?> </td>
					<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_chd_prd_detail['product_con_entry_child_product_detail_length_mm']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'> 
					<?=$get_chd_prd_detail['product_con_entry_child_product_detail_total']?> </td>
			</tr>
	<?php } ?>
									</tbody>
								</table>

	 
	 

<br/>	



	<tr>
		<td colspan="4" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;'> REMARK :  </td>
	</tr>

	
</table>
   

</body>


</html>
