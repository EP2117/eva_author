<!DOCTYPE html>
<html>
<head>
    <title>PRODUCTION RETURN</title>
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
   	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >BRNCH :&nbsp;&nbsp;<?=$width_cutting_edit['branch_name']?></td>
	  <td width="50%" colspan="2" class=" report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >WHAREHOUSE : &nbsp;<?=$width_cutting_edit['production_section_name']?></td> 
	</tr>
	<tr>	 
	 <td  colspan="4" class="report-border-left report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >DATE :&nbsp;&nbsp; <?=dateGeneralFormatN($width_cutting_edit['prn_entry_date'])?></td>
	 <!--<td colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' ></td>-->
	</tr>
	
 </table>
 <br>
 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="21" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >ENTRY DETAILS </td>
	  </tr>                       <thead>

                                        <tr >

                                            <td colspan="11" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>Produc Entry No</td>

                                            <td colspan="10" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>Date</td>
										


                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

										<tr >

										<td colspan="11" class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'><?=$sales_detail_edit['production_entry_no']?></td>

										<td colspan="10" class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;'><?=dateGeneralFormatN($sales_detail_edit['production_entry_date'])?>									
</td>

										

										</tr >

									</tbody>

								</table>

 <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="21" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
	  </tr>    
                                    
                                  <!--  <thead style="display:none" class="rls">-->
								  <?php if($width_cutting_edit['prn_entry_type_id']==1){?>

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
											<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Length &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </th>
										

                                        </tr>

										<tr>
											<th  class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;INCHES&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;INCHES&nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp; FEET &nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp; FT.IN &nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp; FEET &nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FT.IN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>

                                    <!--</thead>
									
									<thead style="display:none" class="rws">-->
									<?php }elseif($width_cutting_edit['prn_entry_type_id']==2){?>

                                         <tr>
                                           
                                            <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> BRAND</td>

                                            <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME</td>
											
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> COLOR</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> THICK</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> WIDTH</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SALES WIDTH</td>
											
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> SALES WEIGHT</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TOTAL LENGTH</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>&nbsp;&nbsp;&nbsp;&nbsp; SW &nbsp;&nbsp;&nbsp;&nbsp;</td>
										
											
                                        </tr>
										<tr>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> INCHES</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> MM </td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> TON </td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> KG </td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>FEET </td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> METER</td>
										</tr>

                                   <!-- </thead>
									<thead style="display:none" class="as">-->
									<?php }elseif($width_cutting_edit['prn_entry_type_id']==4){?>

                                         <tr>

                                            <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> PRD CODE </td>
											
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> BRAND</td>

                                            <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> NAME</td>

                                            <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> UOM</td>
											
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'> Qty</td>
											
										</tr>

                                    </thead>
									
									<?php }?>	

                                    
									<tbody id="product_detail_display" >

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($prn_entry_prd_edit);
										
										foreach($prn_entry_prd_edit as $get_product_detail){
											/*if($get_product_detail['prn_entry_product_detail_product_type']==1){*/
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['product_uom_name'];
												$product_colour_name	= $get_product_detail['product_colour_name'];
											/*}
											else{
												$product_code		= $get_product_detail['product_con_entry_child_product_detail_code'];
												$product_name		= $get_product_detail['product_con_entry_child_product_detail_name'];
												$product_uom_name	= $get_product_detail['c_uom_name'];
												$product_colour_name	= $get_product_detail['c_colour_name'];
											}*/
										
										
											if($width_cutting_edit['prn_entry_type_id']==1){ 
											?>
					
										<tr class="rls" style="display:none">

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>

											<?=$product_code?>
										</td>
											
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>

											<?=$get_product_detail['brand_name']?>
											
											</td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>

											<?=$product_name?>

											</td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>
											<?=$product_colour_name?>
											</td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>
											<?=$arr_thick[$get_product_detail['prn_entry_product_detail_product_thick']]?>
											</td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_width_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_width_mm']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_s_width_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_s_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_sl_feet']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_sl_feet_in']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_sl_feet_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_sl_feet_met']?></td>
											
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_ext_feet']?></td>
											
											 <td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_ext_feet_in']?></td>
											 <td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_ext_feet_mm']?></td>
											 <td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_ext_feet_met']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_qty']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_tot_length']?></td>
											
											

										</tr>
										
										<?php }elseif($width_cutting_edit['prn_entry_type_id']==2){ ?>
										
										<tr class="rws" style="display:none">

											
											
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>
											<?=$get_product_detail['brand_name']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>

											<?=$product_name?>
											</td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>
											<?=$product_colour_name?>

											</td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$arr_thick[$get_product_detail['prn_entry_product_detail_product_thick']]?></td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_width_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_s_width_inches']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_s_width_mm']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_s_weight_inches']?></td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_s_weight_mm']?></td>

											<td style="width:10%"><?=$get_product_detail['prn_entry_product_detail_tot_feet']?></td> 
											<td >"<?=$get_product_detail['prn_entry_product_detail_tot_meter']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_sw_check']?></td>


										</tr>
										
										<?php }elseif($width_cutting_edit['prn_entry_type_id']==4){ ?>
										
										<tr class="as" style="display:none">

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>

											<?=$product_code?>
											</td>
											
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>

											<?=$get_product_detail['brand_name']?>

											</td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>

											<?=$product_name?></td>

											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'>
											<?=$product_uom_name?>
											</td>

											<td style="width:40%"><?=$get_product_detail['prn_entry_product_detail_qty']?></td>
											<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_product_detail['prn_entry_product_detail_sw_check']?></td>
										
										</tr>
										
										<?php }

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>
								</table>
							
              <table style="width:100%;font-size:11px; padding-bottom:20px;" cellspacing="0"  class="report-outer-table">
	 
	  <tr>
		  <td colspan="21" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >RAW DETAILS </td>
	  </tr>
                                    <thead >
									<tr>
									<td colspan="4" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:10%'> </td>
									<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:13%'> WIDTH</td>
									<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:13%'> SALES LENGTH</td>
									<td colspan="2" class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:13%'> Weight</td>
									
									</tr>

                                          <tr>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:13%'> BRAND</td>
                                            <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:13%'> NAME</td>
                                            <td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:13%'> Color</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; width:13%'> THICK</td>
									
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px; '> INCHES</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>MM</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>FEET</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>MM</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>TONE</td>
											<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;'>KG</td>
										</tr>

                                    </thead>
									
									

                                    <tbody id="raw_product_detail_display">
									
									<?php 
									$s_no=1;
									foreach($prn_entry_raw_prd_edit as $get_value){?>
									<tr>
									<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_value['brand_name'];?></td>
									<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_value['product_name'];?></td>
			
									<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_value['product_colour_name'];?> </td>
									
									<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$arr_thick[$get_value['prn_entry_raw_product_detail_product_thick']];?></td>
									
									
									
									<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_value['prn_entry_raw_product_detail_width_inches'];?></td>
									 <td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_value['prn_entry_raw_product_detail_width_mm'];?></td>
									
									
									<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_value['prn_entry_raw_product_detail_sl_feet'];?></td> 
									<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_value['prn_entry_raw_product_detail_sl_feet_mm'];?></td>
									
									
									<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_value['prn_entry_raw_product_detail_ton'];?></td>
									<td class="report-border-right report-border-bottom" style='text-align:right;font-size:11px;'><?=$get_value['prn_entry_raw_product_detail_kg'];?></td>
								
							</tr>
									<?php }?>

									</tbody>

								</table>


	 
	 

<br/>	



	<tr>
		<td colspan="4" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:11px;'> REMARK :  </td>
	</tr>

	
</table>
   

</body>


</html>
