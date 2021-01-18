<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>

 <meta name="DCTERMS.language" content="my" />

 <meta http-equiv="Content-Style-Type" content="text/css" />

 <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>

    <title>Invoice Report - Date</title>

   <style>



/*

.report-middle-line {

	border-right:1px solid #A8A8A8;

}



.report-first-col-line {

border-left: none;

border-right: 0.5px solid #A8A8A8;

}

.report-col-line {

border-right: 0.5px solid #A8A8A8;

}

.report-last-col-line {

border-right: none;

}

.report-top-line {

	border-top:0.5px solid #A8A8A8;

}

.report-bottm-line {

	border-bottom:0.5px solid #A8A8A8;



}*/

.report-outer-table {

	border:1px solid #000000;

}

.content-table {

border:1px solid #000000; 

border-collapse: collapse;

}

   

   </style> 

   

   

</head>



<body style="font-family: sans-serif; font-size:11px;">

 <br>

 <?php

	if(!empty($_REQUEST['search_branch_id'])){

	 $getBranch = get_branch_name($_REQUEST['search_branch_id']);
	//$branch = ucfirst($getBranch['branch_name']);	

	}else{$getBranch = '--';}

	/*

	if(!empty($_REQUEST['search_movement_product_id'])){

	$getProduct = getId('goods','goods_name', 'goods_id', $_REQUEST['search_movement_product_id']);

	$product = ucfirst($getProduct);	

	}else{$product = '--';}*/

	if(!empty($_REQUEST['search_from_date'])){

	$from = dateGeneralFormat($_REQUEST['search_from_date']);	

	}else{$from = '';}

	if(!empty($_REQUEST['search_to_date'])){

	$to = dateGeneralFormat($_REQUEST['search_to_date']);	

	}else{$to = '';}

	

	if(!empty($_REQUEST['search_customer_id'])){

	$getcustomer =  $_REQUEST['search_customer_id'];

	$customer = ucfirst($getcustomer);

	}

	

	$select_customer="SELECT * FROM customers WHERE customer_id='".$getcustomer."' ";

$query=mysql_query($select_customer);

$date=array();

$list=mysql_fetch_array($query);

$customer_name=$list['customer_name'];

	?>

<div id="wrapper" style="width:98%;float:center">

   



<table width="100%" cellspacing="0"  style="font-weight:bold;" class= "report-outer-table content-table">

<tr><td colspan="4" style="text-align:center;  border-bottom:1px solid #000000;">Quotation Report - Product</td></tr>

 <tr>

    <td style="font-size:14px; text-align:left;" width="10%">Date:</td>

    <td style="font-size:14px; text-align:left;" width="60%"><?php echo date('d/m/Y'); ?></td>

    <td style="font-size:14px; text-align:left;" width="10%" rowspan="2">Duration:</td>

    <td style="font-size:14px; text-align:left;" width="20%" rowspan="2"><?php echo $from.' - '.$to;?></td>

  </tr>

  <tr>

    <td style="font-size:14px; text-align:left;" width="10%">Branch:</td>
 
    <td style="font-size:14px; text-align:left;" width="60%"><?php echo ucfirst($getBranch); ?></td>

  </tr>

</table>

<div id="invoice_body" style="">    

<table class="table table-striped table-bordered content-table" width="100%" border="1" style="font-size:14px;" >

							  <thead>

								<tr>
								 <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center" rowspan="2" >S No.</th>

								  <th class="report-col-line report-bottm-line" style="width:10%;font-size:12px;text-align:center" rowspan="2" >QUOT NO</th>

								  <th class="report-col-line report-bottm-line" style="width:10%;font-size:12px;text-align:center" rowspan="2" >DATE</th>

								  <th class="report-col-line report-bottm-line" style="width:20%;font-size:12px;text-align:center" rowspan="2" >CUSTOMER NAME</th>
								  
								  <!--<th class="report-col-line report-bottm-line" style="width:10%;font-size:12px;text-align:center" rowspan="2" >BRAND</th>-->
								  
								  <th class="report-col-line report-bottm-line" style="width:10%;font-size:12px;text-align:center" rowspan="2" >UOM</th>
								  
								  <th class="report-col-line report-bottm-line" colspan="2" style="width:11%;font-size:12px;text-align:center"> WIDTH</th>
								  
								  <th colspan="2" class="report-col-line report-bottm-line" style="width:11%;font-size:12px;text-align:center"> LENGTH</th>
								  
								  <th colspan="2" class="report-col-line report-bottm-line" style="width:11%;font-size:12px;text-align:center"> WEIGHT</th>
								  
								  <th rowspan="2" style="vertical-align:middle;width:11%;font-size:12px;text-align:center" class="report-col-line report-bottm-line" rowspan="2" > QTY </th>
								</tr>
								
								<tr>
									<th class="report-col-line report-bottm-line" style="width:12%;font-size:12px;text-align:center">INCHES</th>
									<th class="report-col-line report-bottm-line" style="width:12%;font-size:12px;text-align:center">MILI</th>
									<th class="report-col-line report-bottm-line" style="width:12%;font-size:12px;text-align:center">FEET</th>
									<th class="report-col-line report-bottm-line" style="width:12%;font-size:12px;text-align:center">METER</th>
									<th class="report-col-line report-bottm-line" style="width:12%;font-size:12px;text-align:center">TON</th>
									<th class="report-col-line report-bottm-line" style="width:12%;font-size:12px;text-align:center">KG</th>
									
								</tr>

							  </thead>

							  <tbody>

								  <?php

								  

								  	$se_no			= 1;

									$customer_id	= '';
								
									$qty_sub 	=0;
									$rate_sub 	=0;
									$amt_sub 	=0;
									
									$qty_grn	=0;
									$rate_grn 	=0;
									$amt_grn 	=0;
									
									
								  	foreach($list_movement_report as $get_movement){

										if($customer_id!=$get_movement['quotation_entry_product_detail_product_id']){

											if($se_no!='1'){

										?>

										<tr>
												<td>&nbsp;</td>											
												<td align="right"colspan="7">&nbsp;</td>
												<td align="right" colspan="3"><strong>Sub Total</strong></td>
												<td align="right"><strong><?=number_format($qty_sub,3,'.','')?></strong></td>
										</tr>

											<?php

												$qty_sub 	=0;
												

											}

											?>

										<tr>

											<td colspan="12" style="text-align:center"><strong><?=$get_movement['product_name'];?></strong></td>

										</tr>

										<?php

											$customer_id = $get_movement['quotation_entry_product_detail_product_id'];

										}

								  ?>

								  	<tr>

									
										<td ><b>&nbsp;<?=$se_no++?></b></td>
										<td >&nbsp;<?=$get_movement['quotation_entry_no']?></td>
										<td >&nbsp;<?=dateGeneralFormatN($get_movement['quotation_entry_date'])?></td>
										
										<td><?php echo $get_movement['customer_name'];?></td>
										<!--<td><?php echo $get_movement['brand_name'];?></td>-->
										<td><?php echo $get_movement['product_uom_name'];?></td>
										
										<td><?php echo $get_movement['quotation_entry_product_detail_s_width_inches'];?></td>
										<td><?php echo $get_movement['quotation_entry_product_detail_s_width_mm'];?></td>
										<td><?php echo $get_movement['quotation_entry_product_detail_sl_feet'];?></td>
										<td><?php echo $get_movement['quotation_entry_product_detail_sl_feet_met'];?></td>
										<td><?php echo $get_movement['quotation_entry_product_detail_s_weight_inches'];?></td>
										<td><?php echo $get_movement['quotation_entry_product_detail_s_weight_mm'];?></td>
										<td align="right"><?=number_format($get_movement['quotation_entry_product_detail_qty'],3,'.','')?> </td>-->
									</tr>

									

						<?php

									$qty_sub   		= $qty_sub+$get_movement['quotation_entry_product_detail_qty'];
									
									$qty_grn   		= $qty_grn+$get_movement['quotation_entry_product_detail_qty'];
									
									
									
						 } ?>

									<tr>
										<td>&nbsp;</td>											
										<td align="right" colspan="7">&nbsp;</td>
										<td align="right" colspan="3"><strong>Sub Total</strong></td>
										<td align="right"><strong><?=number_format($qty_sub,3,'.','')?></strong></td>
										
									</tr>
									<tr>
										<td>&nbsp;</td>	
										<td align="right" colspan="7">&nbsp;</td>										
										<td align="right" colspan="3"><strong>GRAND Total</strong></td>
										<td align="right"><strong><?=number_format($qty_grn,3,'.','')?></strong></td>
										
									</tr>
						      </tbody>

							</table>

							 <?php

							    ?>

					



</div>



</div>











</body>

</html>

