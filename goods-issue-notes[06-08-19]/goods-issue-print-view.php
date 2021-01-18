<!DOCTYPE html>
<html>
<head>
    <title>GOODS ISSUE NOTES</title>
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
 	 <td width="100%" colspan="4" class="report-border-left report-border-right report-border-top report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > GOODS ISSUE NOTES </td>
	</tr>
   <tr>
   	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >BRNCH :&nbsp;&nbsp;<?=$invoice_entry_edit['branch_name']?></td>
	  <td width="50%" colspan="2" class=" report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >FROM WHAREHOUSE : &nbsp;<?=$invoice_entry_edit['godown_name']?></td> 
	</tr>
	<tr>	 
	 <td  colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >DATE :&nbsp;&nbsp; <?=dateGeneralFormatN($invoice_entry_edit['gin_entry_date'])?></td>
	 <td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >TO WHAREHOUSE : <?=$invoice_entry_edit['godown_name_to']?></td>
	</tr>
	
 </table>
 <br>
 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
 
  <tr>
				<td colspan="21" class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >Raw Product Details  </td>
			</tr> 
                                    
                                    <thead >
                                          <tr>
                                          
											<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> BRAND</th>
											<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> CODE</th>
                                            <th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> NAME</th>
                                            <th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> Color</th>
											<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> THICK</th>
											<th colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> WIDTH</th>
											<th colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> SALES LENGTH</th>
											<th colspan="2" class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> Weight</th>
											
                                        </tr>
										<tr>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; '> INCHES</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>MM</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>FEET</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>MM</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>TONE</th>
											<th class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>KG</th>
										</tr>
                                    </thead>
									
                                    <tbody id="raw_product_detail_display">
										
										<?php 
										$row_cnt	= 0;
										$arr_cnt	= count($gin_entry_raw_prd_edit);
										
										foreach($invoice_entry_roaw_prd_edit as $get_product_detail){
												$product_code		= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name		= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name	= $get_product_detail['product_uom_name'];
												$product_colour_name	= $get_product_detail['product_colour_name'];
										
										
										 
											?>
					
										<tr >
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'>
											<?=$get_product_detail['brand_name']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$product_code?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$product_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$product_colour_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$arr_thick[number_format($get_product_detail['gin_entry_raw_product_detail_product_thick'])]?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_raw_product_detail_width_inches']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_raw_product_detail_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_raw_product_detail_sl_feet']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_raw_product_detail_sl_feet_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_raw_product_detail_ton']?></td>
											<td class=" report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_raw_product_detail_kg']?></td>
										
										</tr>
										
										<?php
											$row_cnt	= $row_cnt+1;	
										 } ?>									
									</tbody>
								</table>
                              
                                
								<br>
                                
                                
                                
                                
      <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="21" class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >Product Details 
		  </td>
	  </tr>    
										<?php if($invoice_entry_edit['gin_entry_type_id']==1){ ?>
										<tr>
										
										<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>PRD CODE</th>
										
										<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> BRAND</th>
										
										<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME</th>
										
										<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR</th>
										
										<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK</th>
										
										<th colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WIDTH</th>
										<th colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SALES WIDTH</th>
										<th colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SALES LENGTH</th>
										<th colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Extra LENGTH</th>
										<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>QTY</th>
										<th rowspan="2" class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Total Length  </th>
										</tr>
										<tr>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>INCHES</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>MM </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>INCHES</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>MM </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>FEET</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>FT.IN </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Met </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.IN </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </th>
											<th class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Met </th>
										</tr>
                                    <?php }elseif($invoice_entry_edit['gin_entry_type_id']==2){ ?>
                                        <tr>
                                            <th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> BRAND</th>
                                            <th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME</th>
											
											<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR</th>
											<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK</th>
											<th colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WIDTH</th>
											<th colspan="2"  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SALES WIDTH</th>
											<th colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SALES WEIGHT</th>
											<th colspan="2"  class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>TOTAL LENGTH </th>
                                        </tr>
										<tr>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  INCHES </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  MM </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  INCHES </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  TON </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> KG </th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  FEET </th>
											<th class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  METER </th>
										</tr>
 										<?php }else{ ?>
										<tr>
										
										<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3"> PRD CODE </th>
										<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3"> BRAND </th>
										
										<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3">NAME</th>
										
										<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="2">UOM</th>
										
										<th class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="2">QTY</th>
										
										</tr>
										<?php }?>
									<tbody id="product_detail_display" >
										<?php 
										$row_cnt	= 0;
										$arr_cnt	= count($invoice_entry_prd_edit);
										
										foreach($invoice_entry_prd_edit as $get_product_detail){
											if($invoice_entry_edit['gin_entry_type_id']==1|| $invoice_entry_edit['gin_entry_type_id']==2){
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
											}
											else{
												$product_code		= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name		= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name	= $get_product_detail['c_uom_name'];
												$product_colour_name	= $get_product_detail['c_colour_name'];
											}
										
										
											if($invoice_entry_edit['gin_entry_type_id']==1){ 
											?>
					
										<tr class="rls" style="display:none">
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'>
											<?=$product_code?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['brand_name']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$product_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$product_colour_name ?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$arr_thick[number_format($get_product_detail['gin_entry_product_detail_product_thick'])]?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_width_inches']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_s_width_inches']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_s_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_sl_feet']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_sl_feet_in']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_sl_feet_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_sl_feet_met']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_ext_feet']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?= $get_product_detail['gin_entry_product_detail_ext_feet_in']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_ext_feet_mm']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_ext_feet_met']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_qty']?></td>
											<td class=" report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_tot_length']?></td>
										</tr>
										
										<?php }elseif($invoice_entry_edit['gin_entry_type_id']==2){ ?>
										
										<tr class="rws" style="display:none">
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['brand_name']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$product_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$product_colour_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$arr_thick[$get_product_detail['gin_entry_product_detail_product_thick']]?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_width_inches']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_s_width_inches']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_s_width_mm']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_s_weight_inches']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_s_weight_mm']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_tot_feet']?></td>
											
											<td class=" report-border-bottom" style='text-align:left;font-size:12px;'><?=$get_product_detail['gin_entry_product_detail_tot_meter']?></td>
											
										</tr>
										
										<?php }else{ ?>
										
										<tr >
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="3"><?=$product_code?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;'colspan="3"><?=$get_product_detail['brand_name']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="3"><?=$product_name?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="2"><?=$product_uom_name?></td>
											<td class=" report-border-bottom" style='text-align:left;font-size:12px;' colspan="2"><?=$get_product_detail['gin_entry_product_detail_qty']?></td>
											
										</tr>
										
										<?php }
											$row_cnt	= $row_cnt+1;	
										 } ?>									
									</tbody>
								</table>
                                
                                
                                
                                
                                
                                <br>
								
 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="13" class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >ENTRY DETAILS 
		  </td>
	  </tr>                                     <thead>
                                        <tr >
                                          
                                            <th  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3">Production No</th>
                                            <th   class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3">Date</th>
											<th   class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="3">Type</th>
											<th   class=" report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="4">Customer</th>
                                        </tr>
                                    </thead>
                                    <tbody id="so_detail_display" class="rls">
										<tr>
										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="3"><?=$sales_detail_edit['production_order_no']?></td>
										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="3"><?=dateGeneralFormatN($sales_detail_edit['production_order_date'])?></td>
										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:12px;' colspan="3"><?=$arr_producton_type[$sales_detail_edit['production_order_type']]?></td>
										<td class=" report-border-bottom" style='text-align:left;font-size:12px;' colspan="4"><?=$sales_detail_edit['customer_name']?></td>
										
										</tr>
									</tbody>
								</table>
								
	 

<br/>	



	<tr>
		<td colspan="4" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;'> REMARK :  </td>
	</tr>

	
</table>
   

</body>


</html>
