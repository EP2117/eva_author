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

<tr><td colspan="4" style="text-align:center;  border-bottom:1px solid #000000;">Quotation Report - Date</td></tr>

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



<table class="table table-striped table-bordered content-table" width="100%" border="1" >

							  <thead>

								<tr>


								  <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">S No.</th>

								  <th class="report-col-line report-bottm-line" style="width:11%;font-size:12px;text-align:center">Quotation No</th>

								  <th class="report-col-line report-bottm-line" style="width:20%;font-size:12px;text-align:center">Date</th>

								  <th class="report-col-line report-bottm-line" style="width:24%;font-size:12px;text-align:center">Customer</th>
								  
								  <th class="report-col-line report-bottm-line" style="width:14%;font-size:12px;text-align:center">Net Amount</th>

								  

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

										if($customer_id!=$get_movement['quotation_entry_date']){

											if($se_no!='1'){

										?>

										<tr>
												<td>&nbsp;</td>											
												<td align="right" colspan="3"><strong>Sub Total</strong></td>
											
												<td align="right"><strong><?=number_format($qty_sub,2,'.','')?></strong></td> 
												
											</tr>

											<?php

												$qty_sub 	=0;
												$rate_sub 	=0;
												$amt_sub 	=0;
												$free_qty_sub =0;

											}

											?>

										<tr>

											<td colspan="5" style="text-align:center"><strong><?=dateGeneralFormat($get_movement['quotation_entry_date']);?></strong></td>

										</tr>

										<?php

											$customer_id = $get_movement['quotation_entry_date'];

										}

								  ?>

								  	<tr>

									
										<td ><b>&nbsp;<?=$se_no++?></b></td>
										<td >&nbsp;<?=$get_movement['quotation_entry_no']?></td>
										<td ><?= dateGeneralFormatN($get_movement['quotation_entry_date']) ?></td> 
										<td >&nbsp;<?=ucfirst($get_movement['customer_name']).' - '.$get_movement['customer_code']?></td>
										<td align="right"><?=number_format($get_movement['quotation_entry_net_amount'],2,'.','')?> </td>
									
									</tr>

									

						<?php

									$qty_sub   		= $qty_sub+$get_movement['quotation_entry_net_amount'];
									
									
									$qty_grn   		= $qty_grn+$get_movement['quotation_entry_net_amount'];
									
									
									
						 } ?>

									<tr>
										<td>&nbsp;</td>											
										<td align="right" colspan="3"><strong>Sub Total</strong></td>
										
										<td align="right"><strong><?=number_format($qty_sub,2,'.','')?></strong></td>
										
									</tr>
									<tr>
										<td>&nbsp;</td>											
										<td align="right" colspan="3"><strong>GRAND Total</strong></td>
										
										<td align="right"><strong><?=number_format($qty_grn,2,'.','')?></strong></td>
										
									</tr>
						      </tbody>

							</table>

							 <?php

							    ?>

					



</div>



</div>











</body>

</html>

