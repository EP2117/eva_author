<!DOCTYPE html>
<html>
<head>
    <title>PRODUCTION ENTRY</title>
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
 	 <td width="100%" colspan="4" class="report-border-left report-border-right report-border-top report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > PRODUCTION ENTRY</td>
	</tr>
   <tr>
   	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?php echo $sales_detail['customer_name'];?></td>
	  <td width="50%" colspan="2" class=" report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >QUOTATION NO : &nbsp;<?php echo $sales_detail['grn_entry_no'];?></td>
	 
	</tr>
	<tr>	 
	 <td colspan="2" class="report-border-left report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >INVOICE NO : <?=$sales_detail['production_order_no']?></td>
     
	 <td colspan="2" class="report-border-left report-border-bottom  report-border-right" style='text-align:left;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($width_cutting_edit['production_entry_date'])?></td>
	</tr>
	
	
 </table> <br>
   <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
			 <tr>
				<td colspan="22" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >  Invoice Details </td>
			</tr>        
                              
                                        <tr >

                                            <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="5">Inv No</th>

                                            <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="5">Inv Date</th>
											
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="6">PO No</th>
											
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;' colspan="6">Customer</th>

                                        </tr>


										<tr>

										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="5"><?=$sales_detail['grn_entry_no']?></td>

										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="5"><?=dateGeneralFormatN($sales_detail['grn_entry_date'])?>
										
										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="6"><?=$sales_detail['production_order_no']?></td>
										
										<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;' colspan="6"><?=$sales_detail['customer_name']?></td>


										

										</tr>

									</tbody>

								</table>
 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
			 <tr>
				<td colspan="22" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >  Product Details </td>
			</tr>  							<?php if($width_cutting_edit['production_entry_type_id']==1){ ?>
                                         <tr>
										 <td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> </td>
										 
										<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> WIDTH</td>
										<td colspan="4"  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> SALES WIDTH</td>
										<td colspan="4"  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> SALES LENGTH</td>
										<td colspan="4"  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> Extra LENGTH</td>
										
										 </tr>

                                            <tr>
											
									        <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> BRAND</td>

                                            <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME</td>

                                            <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR</td>
											
										    <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK</td>

											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.IN </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Met</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FT.IN </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Met </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> QTY </td>
										<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Total Length </td>

										</tr>

                                
												<?php }elseif($width_cutting_edit['production_entry_type_id']==2){ ?>
									<thead style="display:none" class="rws">

                                         <tr>
                                        

                                           <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> BRAND</td>

                                           <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  NAME</td>
											
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  COLOR</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  THICK </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  WIDTH</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  SALES WIDTH</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  SALES WEIGHT</td>
											
											
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  TOTAL LENGTH </td>
											
                                        </tr>

										<tr>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  INCHES </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  MM </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  TON </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  KG </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  TON </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> KG </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> FEET </td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  METER </td>
										</tr>
										

                                    </thead>
									<thead  class="ccs">
									<?php }elseif($width_cutting_edit['production_entry_type_id']==4){ ?>
                                         <tr>

                                            <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:20%'>  PRD CODE </td>
											
										<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:20%'>  BRAND</td>

                                           <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:20%'>  NAME</td>

                                        <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:20%'>  UOM</td>
											
										<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:20%'> QTY</td>
											
                                        </tr>
										<?php }?>
                                    </thead>

<tbody id="product_detail_display" >

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($production_entry_prd_edit);
										
										foreach($production_entry_prd_edit as $get_product_detail){
												$product_code			= '';
												$product_name			= '';
												$product_uom_name		= '';
												$product_colour_name	= '';
											if($get_product_detail['production_entry_product_detail_product_type']==1){
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
										
										
											if($width_cutting_edit['production_entry_type_id']==1){ 
											?>
					
										<tr class="rls" style="display:none">

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['brand_name']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$product_name?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$product_colour_name?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$arr_thick[$get_product_detail['production_entry_product_detail_product_thick']]?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_width_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_width_mm']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_s_width_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_s_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_sl_feet']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_sl_feet_in']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_sl_feet_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_sl_feet_met']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_ext_feet']?></td>
											 
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_ext_feet_in']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_ext_feet_mm']?></td> 
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_ext_feet_met']?></td> 
											
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_qty']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_tot_length']?></td>
											

										</tr>
										
										<?php }elseif($width_cutting_edit['production_entry_type_id']==2){ ?>
										
										<tr class="rws" style="display:none">

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['brand_name']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$product_name?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$product_colour_name?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$arr_thick[$get_product_detail['production_entry_product_detail_product_thick']]?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_width_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_width_mm']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_s_width_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_s_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_s_weight_inches']?></td>

											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_s_weight_mm']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_tot_feet']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_tot_meter']?></td>

										</tr>
										
										<?php }elseif($width_cutting_edit['production_entry_type_id']==4){ ?>
										
										<tr >

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$product_code?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['brand_name']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$product_name?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$product_uom_name?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_product_detail_qty']?></td>
											
										</tr>
										
										<?php }

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>
								</table>

                             <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
			 <tr>
				<td colspan="22" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' > Raw Product Details </td>
			</tr>  	        
                                     <thead >

                                          <tr>
										  <td colspan="5"  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> </td>
										  <td  colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> WIDTH</td>
											<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'>SALES LENGTH</td>
											<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> Weight</td>
										
											</tr>
											
											<tr>
											<td  cl class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  BRAND</td>
                                           <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>  CODE</td>
                                           <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME</td>
                                           <td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Color</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK</td>
										
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>MM</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>FEET</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>MM</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>TONE</td>
											<td  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>KG</td>
										</tr>

                                    </thead>
									

                                    <tbody id="raw_product_detail_display">

										
										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($production_entry_raw_prd_edit);
										
										foreach($production_entry_raw_prd_edit as $get_product_detail){
												$product_code		= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name		= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name	= $get_product_detail['product_uom_name'];
												$product_colour_name	= $get_product_detail['product_colour_name'];
										
										
								
											?>
					
										<tr >

											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>
											
											<?=$get_product_detail['brand_name']?>
											
											</td>
                                            <td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>
											<?=$product_code?>
											</td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>

											
											<?=$product_name?>
											

											</td>
											
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>
											<?=$product_colour_name?>
											</td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$arr_thick[$get_product_detail['production_entry_raw_product_detail_product_thick']]?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_raw_product_detail_width_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_raw_product_detail_width_mm']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_raw_product_detail_sl_feet']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_raw_product_detail_sl_feet_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_raw_product_detail_ton']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_raw_product_detail_kg']?></td>
											
										</tr>
										
										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>									



									</tbody>

								</table>

	 
	 

<br/>	

<table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
			 <tr>
				<td colspan="22" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >Work Details </td>
			</tr>  	                                            <thead>

                                        

										<tr>

											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'>Section</th>

											<th  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:20%'>Machine</th>

											<th  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:20%'>Employee</th>

											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10% '>From</th>

											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'>To</th>

											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'>Due</th>

											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:20%'>Remarks</th>

										</tr>

                                    </thead>

                                    <tbody id="work_asign_detail_display">

										<?php

										$row_cnt	= 1;

										$arr_cnt	= count($production_entry_work_edit);

										foreach($work_deatil as $get_work_detail){

										$prd_mac_list		= getProductionMachineList($get_work_detail['production_entry_work_detail_production_section_id']);

										?>

										<tr>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_work_detail['production_section_name']?></td>

											<td  class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_work_detail['production_machine_name']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_work_detail['employee_name']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=dateGeneralFormatN($get_work_detail['production_entry_work_detail_from_date'])?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=dateGeneralFormatN($get_work_detail['production_entry_work_detail_to_date'])?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_work_detail['production_entry_work_detail_due']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_work_detail['production_entry_work_detail_remarks']?></td>
<?php }?>
										</tr>

									</tbody>

								</table>

<br>

<table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
			 <tr>
				<td colspan="22" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >Damage Product Details </td>
			</tr> 
                                     <thead >

                                          <tr>
											<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-size:11px; width:10%'> BRAND</th>
                                            <th rowspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-size:11px; width:10%'> NAME</th>
                                            <th rowspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-size:11px; width:10%'> Color</th>
											<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-size:11px; width:10%'> THICK</th>
											<th colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-size:11px; width:10%'> WIDTH</th>
											<th colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-size:11px; width:20%'> SALES LENGTH</th>
											<th colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-size:11px; width:20%'> Weight</th>
                                        </tr>
										<tr>
											<th class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'> INCHES</th>
											<th class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>MM</th>
											<th class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>FEET</th>
											<th class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>MM</th>
											<th class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>TONE</th>
											<th class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'>KG</th>
										</tr>

                                    </thead>

                                    <tbody id="dam_product_detail_display">

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($product_con_entry_child_prd_edit);

										foreach($product_con_entry_child_prd_edit as $get_product_detail){

										?>

										<tr>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['brand_name']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['product_con_entry_child_product_detail_name']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['product_colour_name']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$arr_thick[$get_product_detail['product_con_entry_child_product_detail_thick_ness']]?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_dam_product_detail_width_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_dam_product_detail_width_mm']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_dam_product_detail_sl_feet']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_dam_product_detail_sl_feet_mm']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_dam_product_detail_ton']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:left;font-size:11px;'><?=$get_product_detail['production_entry_dam_product_detail_kg']?></td>


										</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>

									

									</tbody>

								</table>
<br>




	<tr>
		<td colspan="4" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;'> REMARK :  </td>
	</tr>

	
</table>
   

</body>


</html>
