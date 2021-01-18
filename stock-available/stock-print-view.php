<!DOCTYPE html>
<html>
<head>
    <title>Advance</title>
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
   
</head>

<body style="" >

   <table style="width:100%;font-size:12px;" cellspacing="0"  class="report-outer-table">

   <tr>
	 <td width="100%" colspan="4" style='text-align:center;font-weight:bold;font-size:16px;padding:10px; border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;border-top:1px solid black' ><!--<img src="" alt='' title='' width='70' align="center" /><br/>-->EVE STEEL <br/><span style="font-size:14px;"> </span></td>
	</tr>
	<tr>
 	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px; border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black' > STOCK AVAILABLE REPORT </td>
	</tr>
 
	
 </table>
 <br>


							<?php 
								
								
								
								if($product_status==2){
							?>
								<table id="stock_table"  class="table table-striped table-bordered table-hover"  style="width:100%" border="1">
									<thead>
										<tr>
											<th rowspan="2" style="width:5%">S.No</th>	
											<th rowspan="2"  style="width:10%">Product code</th>	
											<th rowspan="2"  style="width:10%">Brand</th>	
											<th rowspan="2"  style="width:10%">Product name</th>										
											<th rowspan="2" style="width:10%">Color</th>
											<th rowspan="2" style="width:5%">Thick</th>
											<th colspan="2" style="width:10%" >Width</th>
											<th colspan="2" style="width:10%"  >Pur length</th>
											<th colspan="2"  style="width:10%" >Pur Weight</th>
											<th colspan="2"  style="width:10%" >Sale length</th>
											<th colspan="2" style="width:10%" >Sale Weight</th>
											<th colspan="2" style="width:10%" >Clo length</th>
											<th colspan="2" style="width:10%" >Clo Weight</th>
										</tr>
										<tr>
											<th   style="width:5%">INCHES</th>
											<th   style="width:5%">MM</th>
											<th   style="width:5%">FEET</th>
											<th   style="width:5%">METER</th>
											<th   style="width:5%">TONE</th>
											<th  style="width:5%">KG</th>
											<th  style="width:5%">FEET</th>
											<th  style="width:5%">METER</th>
											<th  style="width:5%">TONE</th>
											<th  style="width:5%">KG</th>
											<th  style="width:5%">FEET</th>
											<th  style="width:5%">METER</th>
											<th  style="width:5%">TONE</th>
											<th style="width:5%" >KG</th>
										</tr>
									</thead>
									<tbody>
									<?php $amt=0;
									    $ton=0;		
										//if(!empty($stockList)){
										$s_no	= 1;	
														//print_r($stockList);exit;		
										foreach($stockList as $result){
											//$open_qty		= stock_opening(searchValue('from_date'),$result['product_id'],$result['stock_ledger_prd_type']);
											//$closing_feet	= 	$open_qty+$result['closing_bal']; 
										$product_code			= $result['product_code'];
												//$product_code			= $result['product_code'];
												$product_name			= $result['product_name'];
												$product_uom_name		= $result['product_uom_name'];
												$product_width_inches	= $result['product_con_entry_child_product_detail_width_inches'];
												$product_width_mm		= $result['product_con_entry_child_product_detail_width_mm'];
												//$product_thick_ness		= $result['product_con_entry_child_product_detail_thick_ness'];
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
											<td><?php echo number_format($result['pur_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_length_feet']*0.3048,2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['pur_weight_kg'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_length_feet']*0.3048,2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['sal_weight_kg'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_length_feet'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_length_feet']*0.3048,2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_weight_tone'],2,'.',''); ?></td>
											<td><?php echo number_format($result['closing_weight_kg'],2,'.',''); ?></td>
										
										</tr>
                                       
																   
									 <?php
									$amt=$amt+($result['closing_length_feet']); 
									$ton=$ton+($result['closing_weight_tone']);	}
										//}
									  ?>
									</tbody>
                                     <tfoot>
                                        <?php 
									  ?>
										<tr >
											
                                            <td colspan="15">&nbsp;</td>								
											<td ><b>Total</b></td>
											<td ><b><?php echo number_format($amt,2,'.','');?></b></td><td ></td>
											<td ><b><?php echo number_format($ton,2,'.','');?></b></td><td ></td>
										</tr>
                                        </tfoot>
                                   													
								</table>
							<?php }elseif($product_status==3){
							?>
							<table  class="table table-striped table-bordered table-hover" id="stock_table" style="width:195%">
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
											<td><?php echo number_format($result['stock_ledger_length_feet']*0.3048,2,'.',''); ?></td>
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
							<table id="dataTables-example"  class="table table-striped table-bordered table-hover" style="width:100%">
									<thead>
										<tr>
											<th  style="width:5%">S.No</th>	
											<th  style="width:10%">Product code</th>	
											<th   style="width:10%">Brand</th>	
											<th  style="width:10%">Product name</th>										
											<th >Pur Qty</th>
											<th  >Sale Qty</th>
											<th  >Closing Qty</th>
										</tr>
										
									</thead>
									<tbody>
									<?php
										if(!empty($stockList)){
										$s_no	= 1;									
										foreach($stockList as $result){
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
							
							}elseif($product_status==3){
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
