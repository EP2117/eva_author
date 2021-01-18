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
<tr><td colspan="4" style="text-align:center;  border-bottom:1px solid #000000;">Daily Sales Report - Date</td></tr>
  <tr>
   	 <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >CUSTOMER NAME :&nbsp;&nbsp;<?=$quotation_list['customer_name']?></td>
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >Invoice No : &nbsp;<?=$quotation_list['delivery_entry_no']?></td>
	 
	</tr>
 
  <tr>
    <td width="50%" colspan="2" class="report-border-left report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;'>Date:</td>
    <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;'><?= dateGeneralFormatN($quotation_list['delivery_entry_date']) ?></td> 
   
  </tr>
  
</table>
     
   
<div id="invoice_body" style="">    
<table class="table table-striped table-bordered content-table" width="100%" border="1" >
							 <thead>
                                        <tr>
                                            <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">S.No</th>
											<th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">INV.No.</th>
                                            <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Date</th>
                                            <th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Customer Name</th>											<th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Type</th>
											<th class="report-col-line report-bottm-line" style="width:8%;font-size:12px;text-align:center">Amount</th>
																						
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
											$s_no	= 1;
										foreach($quotation_list	as $get_quotation){
										if($customer_id!=$get_quotation['product_category_name'])
										{
										?>
										<tr>

											<td colspan="6" style="text-align:center"><strong><?=$get_quotation['product_category_name']?></strong></td>

										</tr>

										<?php

											$customer_id = $get_quotation['product_category_name'];

										}
										?>
									    <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=$get_quotation['delivery_customer_no']?></td>
                                            <td><?=dateGeneralFormatN($get_quotation['delivery_customer_date'])?></td>
											<td><?=$get_quotation['customer_name']?></td>
											<td><?php if($get_quotation['invoice_entry_direct_type']==1){ echo 'Direct Invoice'; }else{ echo 'Invoice'; } ?></td>
											<td><?=$get_quotation['invoice_entry_product_detail_total']?></td>
											
                                        </tr>
										<?php  } ?>
									<tr>
										<td colspan="4">&nbsp;</td>
										<td><b>Total</b></td>
										<td style="text-align:left;"><b><?php echo number_format($amt,2,'.','');?></b></td>
									</tr>
									
                                    </tbody>
                                </table>
							 <?php
							    ?>
					
</div>
</div>
</body>
</html>
