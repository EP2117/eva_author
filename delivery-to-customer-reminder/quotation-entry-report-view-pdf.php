<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>

 <meta name="DCTERMS.language" content="my" />

 <meta http-equiv="Content-Style-Type" content="text/css" />

 <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>

    <title>Invoice Console Report</title>

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

 <?php /*

	if(!empty($_REQUEST['search_branch_id'])){

	 $getBranch = get_branch_name($_REQUEST['search_branch_id']);
	//$branch = ucfirst($getBranch['branch_name']);	

	}else{$getBranch = '--';}

	/*

	if(!empty($_REQUEST['search_movement_product_id'])){

	$getProduct = getId('goods','goods_name', 'goods_id', $_REQUEST['search_movement_product_id']);

	$product = ucfirst($getProduct);	

	}else{$product = '--';}

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

*/	?>

<div id="wrapper" style="width:98%;float:center">

   



<table width="100%" cellspacing="0"  style="font-weight:bold;" class= "report-outer-table content-table">

<tr><td colspan="4" style="text-align:center;  border-bottom:1px solid #000000;">Quotation Report - Date</td></tr>

  <tr>
   	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?= $list_movement_report['customer_name']?></td>
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >Branch : &nbsp;<?=$list_movement_report['branch_name']?></td>
	 
	</tr>
 
  <tr>
    <td style="font-size:14px; text-align:left;" width="10%">Date:</td>
    <td style="font-size:14px; text-align:left;" width="60%"><?= dateGeneralFormatN($list_movement_report['invoice_entry_date']) ?></td> 
   
  </tr>
  
</table>

     

   



<div id="invoice_body" style="">    



<table class="table table-striped table-bordered content-table" width="100%" border="1" >

							  <thead>
								<tr>
								  <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">S No.</th>
								  <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Quotation No</th>
								  <th class="report-col-line report-bottm-line" style="width:10%;font-size:12px;text-align:center">Date</th>
								  <th class="report-col-line report-bottm-line" style="width:15%;font-size:12px;text-align:center">Customer</th>
								  <th class="report-col-line report-bottm-line" style="width:10%;font-size:12px;text-align:center">Type</th>
								  <th class="report-col-line report-bottm-line" style="width:10%;font-size:12px;text-align:center">Product</th>
								  <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Invoice Qty</th>
								  <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Delivery To Customer Qty</th>
								  <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Balance Qty</th>
								</tr>
							  </thead>
 
							  <tbody>

								  <?php

								  

								  	$se_no			= 1;

									$customer_id	= '';
								
									$sub_inv_qty 	=0;
									$sub_del_qty 	=0;
									$sub_bal_qty 	=0;
									
									$grd_inv_qty 	=0;
									$grd_del_qty 	=0;
									$grd_bal_qty 	=0;
									
									
								  	foreach($list_movement_report as $get_movement){
									
									$bal=$get_movement['invoice_entry_product_detail_qty']-$get_movement['delivery_detail_qty'];

										if($customer_id!=$get_movement['invoice_entry_date']){

											if($se_no!='1'){

										?>

										<tr>
												<td>&nbsp;</td>											
												<td align="right" colspan="5"><strong>Sub Total</strong></td>
												<td align="right"><strong><?=number_format($sub_inv_qty,3,'.','')?></strong></td> 
												<td align="right"><strong><?=number_format($sub_del_qty,3,'.','')?></strong></td> 
												<td align="right"><strong><?=number_format($sub_bal_qty,3,'.','')?></strong></td> 
												
											</tr>

											<?php
												$sub_inv_qty 	=0;
												$sub_del_qty 	=0;
												$sub_bal_qty 	=0;
											}

											?>

										<tr>

											<td colspan="9" style="text-align:center"><strong><?=dateGeneralFormat($get_movement['invoice_entry_date']);?></strong></td>

										</tr>

										<?php

											$customer_id = $get_movement['invoice_entry_date'];

										}

								  ?>

								  	<tr>

										<td ><b>&nbsp;<?=$se_no++?></b></td>
										<td>&nbsp;<?=$get_movement['invoice_entry_no']?></td>
										<td ><?= dateGeneralFormatN($get_movement['invoice_entry_date']) ?></td> 
										<td >&nbsp;<?=ucfirst($get_movement['customer_name']).' - '.$get_movement['customer_code']?></td>
										<td><?php if($get_movement['invoice_entry_direct_type']==1){ echo 'Direct Invoice'; }else{ echo 'Invoice'; } ?></td>
										<td><?=$get_movement['product_name']?></td>
										<td align="right"><?=number_format($get_movement['invoice_entry_product_detail_qty'],3);?></td>
										<td align="right"><?=number_format($get_movement['delivery_detail_qty'],3);?></td>
										<td align="right"><?=number_format($bal,3,'.','')?> </td>
									
									</tr>

									

						<?php

									$sub_inv_qty 	+=$get_movement['invoice_entry_product_detail_qty'];
									$sub_del_qty 	+=$get_movement['delivery_detail_qty'];
									$sub_bal_qty 	+=$bal;
									
									$grd_inv_qty 	+=$get_movement['invoice_entry_product_detail_qty'];
									$grd_del_qty 	+=$get_movement['delivery_detail_qty'];
									$grd_bal_qty 	+=$bal;
									
									
									
						 } ?>

									
										<tr>
											<td>&nbsp;</td>											
											<td align="right" colspan="5"><strong>Sub Total</strong></td>
											<td align="right"><strong><?=number_format($sub_inv_qty,3,'.','')?></strong></td> 
											<td align="right"><strong><?=number_format($sub_del_qty,3,'.','')?></strong></td> 
											<td align="right"><strong><?=number_format($sub_bal_qty,3,'.','')?></strong></td> 
										</tr>
									
									
										<tr>
											<td>&nbsp;</td>											
											<td align="right" colspan="5"><strong>Grand Total</strong></td>
											<td align="right"><strong><?=number_format($grd_inv_qty,3,'.','')?></strong></td> 
											<td align="right"><strong><?=number_format($grd_del_qty,3,'.','')?></strong></td> 
											<td align="right"><strong><?=number_format($grd_bal_qty,3,'.','')?></strong></td> 
										</tr>
						      </tbody>

							</table>

							 <?php

							    ?>

					



</div>



</div>











</body>

</html>

