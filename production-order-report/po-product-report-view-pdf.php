<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>

 <meta name="DCTERMS.language" content="my" />

 <meta http-equiv="Content-Style-Type" content="text/css" />

 <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>

    <title>Production</title>

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

<tr><td colspan="4" style="text-align:center;  border-bottom:1px solid #000000;">Invoice Report - Date</td></tr>

 <tr>

    <td style="font-size:14px; text-align:left;" width="10%">Date:</td>

    <td style="font-size:14px; text-align:left;" width="60%"><?php echo date('d/m/Y'); ?></td>

  </tr>

  <tr>

    <td style="font-size:14px; text-align:left;" width="10%">Branch:</td>

    <td style="font-size:14px; text-align:left;" width="60%"><?php echo $getBranch; ?></td>

    <td style="font-size:14px; text-align:left;" width="10%">Duration:</td>

    <td style="font-size:14px; text-align:left;" width="20%"><?php echo $from.' - '.$to;?></td>

  </tr>

  



</table>

     

   



<div id="invoice_body" style="">    



<table class="table table-striped table-bordered content-table" width="100%" border="1" >

							  <thead>

								<tr>


								  <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">S No.</th>
  <thead  >
										
                                         <tr >
										    <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">S.No</th>
											<th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Date</th>
                                            <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">PO No</th>
											<th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Customer Name</th>
											<th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Product Name</th>
                                            <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">PO QTY</th>
											<th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Production QTY</th>
											<th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Bal QTY</th>
										</tr>
                                    </thead>
                                    <tbody >
										<?php 
										$sno 		=1;
										$bal_kg     ='';
										$po_qty		='';
										$pe_qty		='';
										$bal_qty	='';
										foreach($invoice_list as $get_val){
										
										$bal_kg = $get_val['production_order_product_detail_qty']-$get_val['production_entry_product_detail_qty'];
										if($bal_kg>0){
										?>
										<tr>
											<td><?=$sno++?></td>
                                            <td><?=dateGeneralFormatN($get_val['production_order_date'])?></td>
                                            <td><?=$get_val['production_order_no']?></td>
                                            <td><?=$get_val['customer_name']?></td>
											<td><?=$get_val['product_name']?></td>
                                            <td><?=$get_val['production_order_product_detail_qty']?></td>
                                            <td><?=$get_val['production_entry_product_detail_qty']?></td>
                                            <td><?=$bal_kg?></td>
										</tr>
										<?php 
										
										  $po_qty		+=$get_val['production_order_product_detail_qty'];
									 	  $pe_qty		+=$get_val['production_entry_product_detail_qty'];
									 	  $bal_qty		+=$bal_kg;
										}?>
										<?php 
										 
										   } ?>
									<tr>
										<td colspan="4">&nbsp;</td>
										<td><b>Total</b></td>
										<td style="text-align:right"><b><?php echo $po_qty;?></b></td>
										<td style="text-align:right"><b><?php echo $pe_qty;?></b></td>
										<td style="text-align:right"><b><?php echo $bal_qty;?></b></td>
									</tr>
										
										
										
										
									</tbody>
							</table>

							 <?php

							    ?>

					



</div>



</div>











</body>

</html>

