<!DOCTYPE html>
<html>
<head>
    <title>Advance</title>
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

<body style="" >

   <table style="width:100%;font-size:12px;" cellspacing="0"  class="report-outer-table">

   <tr>
	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' ><!--<img src="" alt='' title='' width='70' align="center" /><br/>-->EVE STEEL <br/><span style="font-size:14px;"> </span></td>
	</tr>
	<tr>
 	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > STOCK AVAILABLE REPORT </td>
	</tr>
 
	
 </table>
 <br>


							<?php 
								
								
								if($product_status==2){
							?>
								<table id="stock_table"  class="table table-striped table-bordered table-hover" style="width:195%">
									<thead>
										<tr>
											<th rowspan="2" style="width:5%">S.No</th>	
											<th rowspan="2"  style="width:10%">Product code</th>	
											<th rowspan="2"  style="width:10%">Brand</th>	
											<th rowspan="2"  style="width:10%">Product name</th>										
											<th rowspan="2" style="width:10%">Color</th>
											<th rowspan="2" style="width:10%">Thick</th>
											<th colspan="2" >Width</th>
											<th colspan="2"  >Pur length</th>
											<th colspan="2"  >Pur Weight</th>
											<th colspan="2"  >Sale length</th>
											<th colspan="2"  >Sale Weight</th>
											<th colspan="2"  >Clo length</th>
											<th colspan="2"  >Clo Weight</th>
										</tr>
										<tr>
											<th   style="width:10%">INCHES</th>
											<th   style="width:10%">MM</th>
											<th   style="width:10%">FEET</th>
											<th   style="width:10%">METER</th>
											<th   style="width:10%">TONE</th>
											<th  style="width:10%">KG</th>
											<th  style="width:10%">FEET</th>
											<th  style="width:10%">METER</th>
											<th  style="width:10%">TONE</th>
											<th  style="width:10%">KG</th>
											<th  style="width:10%">FEET</th>
											<th  style="width:10%">METER</th>
											<th  style="width:10%">TONE</th>
											<th style="width:10%" >KG</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!empty($stockList)){
										$s_no	= 1;									
										foreach($stockList as $result){
											//$open_qty		= stock_opening(searchValue('from_date'),$result['product_id'],$result['stock_ledger_prd_type']);
											//$closing_feet	= 	$open_qty+$result['closing_bal']; 
												$product_code			= $result['product_con_entry_child_product_detail_code'];
												$product_name			= $result['product_con_entry_child_product_detail_name'];
												$product_uom_name		= $result['product_uom_name'];
												$product_width_inches	= $result['product_con_entry_child_product_detail_width_inches'];
												$product_width_mm		= $result['product_con_entry_child_product_detail_width_mm'];
												//$product_thick_ness		= $result['product_con_entry_child_product_detail_thick_ness'];
												$product_thick_ness		= ($result['product_con_entry_child_product_detail_thick_ness']==0)?'':$arr_thick[$result['product_con_entry_child_product_detail_thick_ness']];
										?>
										<tr class="odd gradeX">
											<td><?php echo $s_no++; ?></td>
											<td><?php echo $product_code; ?></td>
											<td><?php echo $result['brand_name']; ?></td>
											<td><?php echo $product_name; ?></td>
											<td><?php echo $result['product_colour_name']; ?></td>
											<td><?php echo $product_thick_ness; ?></td>
											<td><?php echo $product_width_inches; ?></td>
											<td><?php echo $product_width_mm; ?></td>
											<td><?php echo number_format($result['pur_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_length_meter'],2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_weight_kg'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_length_meter'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_weight_kg'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_length_meter'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_weight_kg'],2,'.',''); ?></td>
										</tr>
																	   
									 <?php }
										}
									  ?>
									</tbody>												
								</table>
							<?php }elseif($product_status==3){
							?>
							<table id="stock_table"  class="table table-striped table-bordered table-hover" style="width:195%">
									<thead>
										<tr>
											<th rowspan="2" style="width:5%">S.No</th>	
											<th rowspan="2"  style="width:10%">Product code</th>	
											<th rowspan="2"  style="width:10%">Brand</th>	
											<th rowspan="2"  style="width:10%">Product name</th>										
											<th rowspan="2" style="width:10%">Color</th>
											<th rowspan="2" style="width:10%">Thick</th>
											<th colspan="2" >Width</th>
											<th colspan="2" >length</th>
											<th colspan="2" >Weight</th>
											<th rowspan="2" >Pur Qty</th>
											<th rowspan="2" >Sale Qty</th>
											<th rowspan="2" >Closing Qty</th>
										</tr>
										<tr>
											<th   style="width:10%">INCHES</th>
											<th   style="width:10%">MM</th>
											<th   style="width:10%">FEET</th>
											<th   style="width:10%">METER</th>
											<th   style="width:10%">TONE</th>
											<th  style="width:10%">KG</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!empty($stockList)){
										$s_no	= 1;									
										foreach($stockList as $result){
											//$open_qty		= stock_opening(searchValue('from_date'),$result['product_id'],$result['stock_ledger_prd_type']);
											//$closing_feet	= 	$open_qty+$result['closing_bal']; 
												$product_code			= $result['product_code'];
												$product_name			= $result['product_name'];
												$product_uom_name		= $result['product_uom_name'];
												$product_width_inches	= $result['stock_ledger_width_inches'];
												$product_width_mm		= $result['stock_ledger_width_mm'];
												$product_thick_ness		= ($result['stock_ledger_thick_ness']==0)?'':$arr_thick[$result['stock_ledger_thick_ness']];
										?>
										<tr class="odd gradeX">
											<td><?php echo $s_no++; ?></td>
											<td><?php echo $product_code; ?></td>
											<td><?php echo $result['brand_name']; ?></td>
											<td><?php echo $product_name; ?></td>
											<td><?php echo $result['product_colour_name']; ?></td>
											<td><?php echo $product_thick_ness; ?></td>
											<td><?php echo $product_width_inches; ?></td>
											<td><?php echo $product_width_mm; ?></td>
											<td><?php echo number_format($result['stock_ledger_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['stock_ledger_length_meter'],2,'.',''); ?></td>
											<td><?php echo number_format($result['stock_ledger_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['stock_ledger_weight_kg'],2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_qty'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_qty'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_qty'],2,'.',''); ?></td>
										</tr>
																	   
									 <?php }
										}
									  ?>
									</tbody>												
								</table>
							<?php
							
							} elseif($product_status==1){
							?>
							<table id="stock_table"  class="table table-striped table-bordered table-hover" style="width:100%;font-size:16px">
									<thead>
										<tr>
											<th  style="width:10%">S.No</th>	
											<th  style="width:20%">Product code</th>	
											<th   style="width:20%">Brand</th>	
											<th  style="width:20%">Product name</th>										
											<th style="width:10%">Pur Qty</th>
											<th  style="width:10%">Sale Qty</th>
											<th style="width:10%" >Closing Qty</th>
										</tr>
										
									</thead>
									<tbody>
									<?php
									//print_r($stockList);exit;
										if(!empty($stockList)){
										$s_no	= 1;									
										foreach($stockList as $result){
											//$open_qty		= stock_opening(searchValue('from_date'),$result['product_id'],$result['stock_ledger_prd_type']);
											//$closing_feet	= 	$open_qty+$result['closing_bal']; 
												$product_code			= $result['product_code'];
												$product_name			= $result['product_name'];
												$product_uom_name		= $result['product_uom_name'];
										?>
										<tr class="odd gradeX">
											<td><?php echo $s_no++; ?></td>
											<td><?php echo $product_code; ?></td>
											<td><?php echo $result['brand_name']; ?></td>
											<td><?php echo $product_name; ?></td>
											<td><?php echo number_format($result['pur_qty'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_qty'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_qty'],2,'.',''); ?></td>
										</tr>
																	   
									 <?php }
										}
									  ?>
									</tbody>												
								</table>
							<?php
							
							} ?>
								

</body>


</html>
