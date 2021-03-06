<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>INVOICE</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Invoice Entry deleted successfully</div>';
		}  
	}
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/invoice-entry/invoice-entry-javascript.js'; ?>"></script>
<script>
    function GetTax(taxVal){
    
    if(taxVal==1){
        $('#tax_details').show();
    }else{
        $('#tax_details').hide();
    }
}
</script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/sales-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Invoice Entry</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) {
									echo $msg;
								}
							?>
						</h1>
                    </div>
                </div>
				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>
				<?php 
				if(isset($_GET['print_status']) && $_GET['print_status']==1)
				{
				 ?>
				 <script>
				 window.open("invoice-print.php?id=<?=$_GET['inv_id']?>","_blank");
				 </script>
				<?php }?>
                
                <script>
                $(function(){
                    GetTax(2);
                });
                </script>
                
				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Invoice Entry Details
								</div>
								<div class="panel-body">
								<div class="col-lg-12">
										<div class="form-group">
											
											<input type="hidden" class="form-control" name="invoice_entry_no" id="invoice_entry_no" value="" style="width:460px;" readonly required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select name="invoice_entry_branch_id" id="invoice_entry_branch_id" class="form-control select2" style="width:100%" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($branch_list	as	$get_branch){
												?>
														<option value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Customer</label>
											<select name="invoice_entry_customer_id" id="invoice_entry_customer_id" class="form-control select2" style="width:100%" required>
												  <option value=""> - Select - </option>
												<?php
													foreach($customer_list	as	$get_customer){
												?>
														<option value="<?=$get_customer['customer_id']?>"><?=$get_customer['customer_code']."-".$get_customer['customer_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Credit Days</label>
											<input type="text" class="form-control" name="invoice_entry_credit_days" id="invoice_entry_credit_days" onBlur="getDueDate();" >
										</div>
										<!--<div class="form-group">
											<label>Warehouse</label>
											<select name="invoice_entry_godown_id" id="invoice_entry_godown_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($godown_list	as	$get_godown){
												?>
														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>
												<?php
													}
												?>
											</select>
										</div>-->
										
										<div class="form-group">
											<label>Type</label>
											<select name="invoice_entry_type" id="invoice_entry_type" class="form-control" style="width:100%">
												  <option value=""> - Select - </option>
												  <option value="1"> Quotation </option>
												  <option value="2"> Advance</option>
											</select>
										</div>
										
									</div>
									<div class="col-lg-6">
										
										<div class="form-group">
											<label class="control-label">Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control" name="invoice_entry_date" id="invoice_entry_date" value="<?=date('d/m/Y')?>"  required>
											</div>
										</div>
										<div class="form-group">
											<label>Validity Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control" name="invoice_entry_validity_date" id="invoice_entry_validity_date" >
											</div>
										</div>
										
										<div class="form-group">
											<label>Due Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control" name="invoice_entry_due_date" id="invoice_entry_due_date" >
											</div>
										</div>
										<div class="form-group">
											<label>Salesman</label>
											<select name="invoice_entry_salesman_id" id="invoice_entry_salesman_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($salesman_list	as	$get_salesman){
												?>
														<option value="<?=$get_salesman['salesman_id']?>"><?=$get_salesman['salesman_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Production Type</label>
											<select name="invoice_entry_prd_type" id="invoice_entry_prd_type" class="form-control" style="width:100%">
												  <option value="1"> With Production </option>
												  <option value="2"> Without Production</option>
											</select>
										</div>
									</div>
								<div class="col-lg-12">
									    <div class="form-group">
											<label>Remarks</label>
											<textarea name="invoice_entry_remark" id="invoice_entry_remark" class="form-control" style="width:100%">
											</textarea>
										</div>
								</div>
								<div class="col-lg-6">
									    <div class="form-group">
												<label> Tax</label>
												<br>
												<input class="flat-red" type="radio"  name="invoice_entry_tax_status" id="invoice_entry_tax_status" value="1" onClick="GetTax(this.value);" /> Yes &nbsp;&nbsp;
												<input class="flat-red" type="radio"  name="invoice_entry_tax_status" id="invoice_entry_tax_status" value="2" onClick="GetTax(this.value);" checked /> No
												
										</div>
								</div>
							
						</div>
						</div>
						
					</div>
        		</div>
				<div class="row">
					<div class="col-md-12">
						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  ENTRY DETAILS
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetSodetail();" data-toggle="modal" data-target="#soModal" data-id="1" class="glyphicon glyphicon-plus"></button>
                            </button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >
                                    <thead>
                                        <tr i>
                                            <th style=" width:30%;">Quotation No</th>
                                            <th  style=" width:25%;">Quotation Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="so_detail_display">
									</tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  Product Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
                            </button>
								</div>
								<div class="table-responsive">
								<div  style="width:100%; overflow:scroll">
                                <table class="table table-striped table-bordered table-hover" id="product_detail_rls"  style="width:100%;display:none">
									
                                    <thead  >
                                         <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="4"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Length &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										<tr>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FEET &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FT.IN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rls_display">
									</tbody>
								</table>
								</div>
								<div  style="width:100%; overflow:scroll">
								<table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:none">
									
									<thead>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										<tr>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KG &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rws_display">
									</tbody>
								</table>
								</div>
								<table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%; display:none" >
									
									<thead >
                                         <tr>
                                            <th style="vertical-align:middle;">NAME</th>
                                            <th style="vertical-align:middle;">UOM</th>
											<th style="vertical-align:middle;">QTY</th>
											<th style="vertical-align:middle;">Rate</th>
											<th style="vertical-align:middle;">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_detail_as_display">
									
									</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" style=" width:100%" >
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Gross</td>
										<td style="width:20%"><input type="text" class="form-control" name="invoice_entry_gross_amount" id="invoice_entry_gross_amount" ></td>
									</tr>
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Transportation Charges</td>
										<td><input type="text" class="form-control" name="invoice_entry_transport_amount" id="invoice_entry_transport_amount" onBlur="totalAmount()" ></td>
									</tr>
									<tr id="tax_details">
										<td style="width:50%">&nbsp;</td>
										<td>Tax</td>
										<td style="width:20%"><input type="text" class="form-control" name="invoice_entry_tax_per" id="invoice_entry_tax_per" onBlur="totalAmount()" value="5" ></td>
										<td><input type="text" class="form-control" name="invoice_entry_tax_amount" id="invoice_entry_tax_amount" value="0" ></td>
									</tr>
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Total</td>
										<td><input type="text" class="form-control" name="invoice_entry_total_amount" id="invoice_entry_total_amount"  ></td>
									</tr>
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Advance</td>
										<td><input type="text" class="form-control" name="invoice_entry_advance_amount" id="invoice_entry_advance_amount" onBlur="totalAmount()" ></td>
									</tr>
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Balance</td>
										<td><input type="text" class="form-control" name="invoice_entry_net_amount" id="invoice_entry_net_amount"  ></td>
									</tr>
								</table>
								</div>
								
								<div class="col-lg-6">
									<button name="invoice_entry_insert" type="submit" class="btn btn-success">Save </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				</form>
				
				<?php }else if((isset($_GET['page']))  && (isset($_GET['id'])) && ($_GET['page']=='edit')) {
				?>
                    <script>
                $(function(){
                    GetTax(<?=$invoice_entry_edit['invoice_entry_tax_status']?>);
                });
                </script>
				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Invoice Entry Details
								</div>
								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Invoice No.</label>
											<input type="text" class="form-control" name="invoice_entry_no" id="invoice_entry_no" style="width:460px;" value="<?=$invoice_entry_edit['invoice_entry_no']?>" readonly >
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Branch</label>
											<select name="invoice_entry_branch_id" id="invoice_entry_branch_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($branch_list	as	$get_branch){
														$selected	= ($get_branch['branch_id']==$invoice_entry_edit['invoice_entry_branch_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Customer</label>
											<select name="invoice_entry_customer_id" id="invoice_entry_customer_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($customer_list	as	$get_prd_sec){
														$selected	= ($get_prd_sec['customer_id']==$invoice_entry_edit['invoice_entry_customer_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_prd_sec['customer_id']?>" <?=$selected?>><?=$get_prd_sec['customer_code']."-".$get_prd_sec['customer_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Credit Days</label>
											<input type="text" class="form-control" name="invoice_entry_credit_days" id="invoice_entry_credit_days" onBlur="getDueDate();"  value="<?=$invoice_entry_edit['invoice_entry_credit_days']?>"/>
										</div>
										<!--<div class="form-group">
											<label>Warehouse</label>
											<select name="invoice_entry_godown_id" id="invoice_entry_godown_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($godown_list	as	$get_godown){
														$selected	= ($get_godown['godown_id']==$invoice_entry_edit['invoice_entry_godown_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>
												<?php
													}
												?>
											</select>
										</div>-->
										<div class="form-group">
											<label>Remarks</label>
											<textarea name="invoice_entry_remark" id="invoice_entry_remark" class="form-control" style="width:100%"><?= $invoice_entry_edit['invoice_entry_remark'] ?></textarea>
										</div>
										<div class="form-group">
												<label> Tax</label>
												<br>
												<input class="flat-red" type="radio"  name="invoice_entry_tax_status" id="invoice_entry_tax_status" value="1" onClick="GetTax(this.value);" <?=($invoice_entry_edit['invoice_entry_tax_status']==1)?'checked':''?> /> Yes &nbsp;&nbsp;
												<input class="flat-red" type="radio"  name="invoice_entry_tax_status" id="invoice_entry_tax_status" value="2" onClick="GetTax(this.value);" <?=($invoice_entry_edit['invoice_entry_tax_status']==2)?'checked':''?> /> No
												
										</div>
										
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control" name="invoice_entry_date" id="invoice_entry_date" value="<?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_date'])?>">
											</div>
										</div>
										<div class="form-group">
											<label>Validity Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control" name="invoice_entry_validity_date" id="invoice_entry_validity_date" value="<?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_validity_date'])?>" />
											</div>
										</div>
										<div class="form-group">
											<label>Due Date</label>
											 <div class="input-group date">
											  <div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											  </div>
											  <input type="text" class="form-control" name="invoice_entry_due_date" id="invoice_entry_due_date" value="<?=dateGeneralFormatN($invoice_entry_edit['invoice_entry_due_date'])?>" >
											</div>
										</div>
										<div class="form-group">
											<label>Salesman</label>
											<select name="invoice_entry_salesman_id" id="invoice_entry_salesman_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($salesman_list	as	$get_salesman){
														$selected	= ($get_salesman['salesman_id']==$invoice_entry_edit['invoice_entry_salesman_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_salesman['salesman_id']?>" <?=$selected?>><?=$get_salesman['salesman_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Production Type</label>
											<?php $invoice_entry_prd_type = ($invoice_entry_edit['invoice_entry_prd_type']=='1')?'With Production':'Without Production'; ?>
											<input type="text" class="form-control" name="invoice_entry_prd_type" id="invoice_entry_prd_type" value="<?=$invoice_entry_prd_type?>" >
											<input type="hidden" class="form-control" name="invoice_entry_type" id="invoice_entry_type" value="<?=$invoice_entry_edit['invoice_entry_type']?>" >
											<input type="hidden" class="form-control" name="invoice_entry_type_id" id="invoice_entry_type_id" value="<?=$invoice_entry_edit['invoice_entry_type_id']?>" >
										</div>
										
									</div>
									
									
								
								</div>
						</div>
						
					</div>
        		</div>
				
				<div class="row">
					<div class="col-md-12">
						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  ENTRY DETAILS
							</div>
							<div class="panel-body">
								
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >
									<?php if($invoice_entry_edit['invoice_entry_type']==1) {  ?>
                                    <thead> 
                                        <tr>
                                            <th style=" width:30%;">Quotation No</th>
                                            <th  style=" width:25%;">Quotation Date</th>
                                        </tr>
										
                                    </thead>
                                    <tbody id="so_detail_display">
										<tr>
                                            <td style=" width:30%;"><?=$invoice_entry_edit['quotation_entry_no']?></th>
                                            <th  style=" width:25%;"><?=dateGeneralFormatN($invoice_entry_edit['quotation_entry_date'])?>
											<input type="hidden"  name="invoice_entry_quotation_entry_id" id="invoice_entry_quotation_entry_id" value='<?=$invoice_entry_edit['invoice_entry_quotation_entry_id']?>'  class='dc_id'  />
											</th>
                                        </tr>
									</tbody>
 									<?php }else{ ?>
									<thead> 
                                        <tr>
                                            <th style=" width:30%;">Advance No</th>
                                            <th  style=" width:25%;">Advance Date</th>
                                        </tr>
										
                                    </thead>
                                    <tbody id="so_detail_display">
										<tr>
                                            <td style=" width:30%;"><?=$invoice_entry_edit['advance_entry_no']?></th>
                                            <th  style=" width:25%;"><?=dateGeneralFormatN($invoice_entry_edit['advance_entry_date'])?>
											<input type="hidden"  name="invoice_entry_quotation_entry_id" id="invoice_entry_quotation_entry_id" value='<?=$invoice_entry_edit['invoice_entry_quotation_entry_id']?>'  class='dc_id'  />
											</th>
                                        </tr>
									</tbody>
									<?php } ?>
								</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  Product Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetDetail();" data-toggle="modal" data-target="#myModal" data-id="1" class="glyphicon glyphicon-plus"></button>
                            </button>
								</div>
								<div class="table-responsive">
								<div  style="width:100%; overflow:scroll">
								<table class="table table-striped table-bordered table-hover" id="product_detail_rls"  style="width:100%;display:<?=($invoice_entry_prd_edit[0]['invoice_entry_product_detail_entry_type']==1)?"":'none'?>"><!--display:none-->
									
                                    <thead  >
                                         <tr>
											<th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
                                            <th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="4"> SALES LENGTH</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Length &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										<tr>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FEET &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FT.IN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
                                    </thead>
                                    <tbody id="product_detail_rls_display">
									<?php 
										$row_cnt	= 1;
										$arr_cnt	= count($invoice_entry_prd_edit);
										
										foreach($invoice_entry_prd_edit as $get_product_detail){
											
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
												$product_brand_name	= $get_product_detail['brand_name'];
											if($get_product_detail['invoice_entry_product_detail_entry_type']==1){ 
											?>
								<tr>
									<td><input type="hidden"  name="invoice_entry_product_detail_mother_child_type[]" id="invoice_entry_product_detail_mother_child_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_mother_child_type']?>" /><?=$product_brand_name?></td><td><?=$product_name?>
									<input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_id']?>" />
									<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_id']?>" />
									<input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_type']?>" />
									<input type="hidden"  name="invoice_entry_product_detail_quotation_detail_id[]" id="invoice_entry_product_detail_quotation_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_quotation_detail_id']?>" />
									<input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_entry_type']?>" />
                                    <input type="hidden"  name="invoice_entry_product_detail_brand_id[]" id="invoice_entry_product_detail_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['product_brand_id']?>" />
                                    </td>
								
								<td><?=$product_colour_name?><input type="hidden" id="invoice_entry_product_detail_color_id<?=$row_cnt?>" name="invoice_entry_product_detail_color_id[]" value="<?=$get_product_detail['invoice_entry_product_detail_color_id']?>"></td>
								
								<td><?=$arr_thick[$get_product_detail['invoice_entry_product_detail_product_thick']];?><input type="hidden" id="invoice_entry_product_detail_product_thick<?=$row_cnt?>" name="invoice_entry_product_detail_product_thick[]" value="<?=$get_product_detail['invoice_entry_product_detail_product_thick']?>"></td>
								
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches<?=$row_cnt?>"   onBlur="GetTotalLength(<?=$row_cnt?>),GetWcalc(2,<?=$row_cnt?>)" value="<?=sprintf('%0.3f', $get_product_detail['invoice_entry_product_detail_width_inches']);?>"  /></td> 
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm<?=$row_cnt?>"  onkeyup="GetLcalc(3,<?=$row_cnt?>)" onBlur="GetTotalLength(<?=$row_cnt?>),GetWcalc(3,<?=$row_cnt?>)" value="<?=round($get_product_detail['invoice_entry_product_detail_width_mm'])?>"  /></td>
								
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches<?=$row_cnt?>"  onBlur="GetTotalLength(<?=$row_cnt?>),GetLcalS(2,<?=$row_cnt?>)" value="<?=sprintf('%0.3f', $get_product_detail['invoice_entry_product_detail_s_width_inches']);?>" /></td> 
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm<?=$row_cnt?>" onBlur="GetTotalLength(<?=$row_cnt?>),GetLcalS(3,<?=$row_cnt?>);" value="<?=round($get_product_detail['invoice_entry_product_detail_s_width_mm'])?>" /></td>
								
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet<?=$row_cnt?>" onBlur="GetLcalFeet(1,<?=$row_cnt?>),GetTotalLength(<?=$row_cnt?>);"  value="<?=round($get_product_detail['invoice_entry_product_detail_sl_feet'])?>"  /></td> 
								<td><input class="form-control" type="text" name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in<?=$row_cnt?>" onBlur="GetLcalFeet(1,<?=$row_cnt?>);GetTotalLength(<?=$row_cnt?>);" value="<?=sprintf('%0.3f', $get_product_detail['invoice_entry_product_detail_sl_feet_in']);?>"  /></td>
								<td><input class="form-control" type="text" name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm<?=$row_cnt?>" onBlur="GetLcalFeet(3,<?=$row_cnt?>);GetTotalLength(<?=$row_cnt?>);" value="<?=round($get_product_detail['invoice_entry_product_detail_sl_feet_mm'])?>"  /></td>
								<td><input class="form-control" type="text" name="invoice_entry_product_detail_sl_feet_met[]" id="invoice_entry_product_detail_sl_feet_met<?=$row_cnt?>" onBlur="GetLcalFeet(3,<?=$row_cnt?>);GetTotalLength(<?=$row_cnt?>);" value="<?=sprintf('%0.3f', $get_product_detail['invoice_entry_product_detail_sl_feet_met']);?>"  />
								<input type="hidden" name="invoice_entry_product_detail_s_weight_inches[]" id="invoice_entry_product_detail_s_weight_inches<?=$row_cnt?>"    value="<?=$get_product_detail['invoice_entry_product_detail_s_weight_inches']?>"   />
								<input type="hidden"  name="invoice_entry_product_detail_s_weight_mm[]" id="invoice_entry_product_detail_s_weight_mm<?=$row_cnt?>"  value="<?=$get_product_detail['invoice_entry_product_detail_s_weight_mm']?>"   /></td>
								
								
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty<?=$row_cnt?>"  value="<?=round($get_product_detail['invoice_entry_product_detail_qty'])?>"  onBlur="GetTotalLength(<?=$row_cnt?>),discountPerFind(<?=$row_cnt?>);"  /></td> 
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_tot_length[]" id="invoice_entry_product_detail_tot_length<?=$row_cnt?>" readonly value="<?=round($get_product_detail['invoice_entry_product_detail_tot_length'])?>"   />
								<input  type="hidden"  name="invoice_entry_product_detail_inv_tot_length[]" id="invoice_entry_product_detail_inv_tot_length<?=$row_cnt?>" readonly value="<?=round($get_product_detail['invoice_entry_product_detail_inv_tot_length'])?>"   /> </td> 
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate<?=$row_cnt?>"  value="<?=round($get_product_detail['invoice_entry_product_detail_rate'])?>"  onBlur="discountPerFind(<?=$row_cnt?>)" /></td>
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total<?=$row_cnt?>"  value="<?=round($get_product_detail['invoice_entry_product_detail_total'])?>" readonly    /></td>
								<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['invoice_entry_product_detail_id']?>&invoice_entry_uniq_id=<?php echo $invoice_entry_edit['invoice_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
							</tr>
											
											<?php $row_cnt++; } }?>
									</tbody>
								</table>
								</div>
								<div  style="width:100%; overflow:scroll">
                                <table class="table table-striped table-bordered table-hover" id="product_detail_rws"  style="width:100%;display:<?=($invoice_entry_prd_edit[0]['invoice_entry_product_detail_entry_type']==2)?"":'none'?>"><!--display:none-->
									
									<thead>
                                         <tr>
                                            <th rowspan="2" style="vertical-align:middle;"> BRAND</th>
                                            <th rowspan="2" style="vertical-align:middle;"> NAME</th>
											<th rowspan="2" style="vertical-align:middle;"> COLOR</th>
											<th rowspan="2" style="vertical-align:middle;"> THICK</th>
											<th colspan="2"> WIDTH</th>
											<th colspan="2"> SALES WIDTH</th>
											<th colspan="3"> SALES WEIGHT</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th rowspan="2" style="vertical-align:middle;" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										<tr>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCHES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; KG &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Met &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										</tr>
                                    </thead>
                                    <tbody >
									
									<?php 
										//$row_cnt	= 0;
										$arr_cnt	= count($invoice_entry_prd_edit);
										
										foreach($invoice_entry_prd_edit as $get_product_detail){
											
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
												$product_brand_name		= $get_product_detail['brand_name'];
												$product_thick_ness		=$get_product_detail['invoice_entry_product_detail_product_thick'];
											
											if($get_product_detail['invoice_entry_product_detail_entry_type']==2){ 
												
											?>
								<tr>
								<td><input type="hidden"  name="invoice_entry_product_detail_mother_child_type[]" id="invoice_entry_product_detail_mother_child_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_mother_child_type']?>" /><?=$product_brand_name?></td><td><?=$product_name?>
								<input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_id']?>" />
								<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_id']?>" />
									<input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_type']?>"  />
									<input type="hidden"  name="invoice_entry_product_detail_quotation_detail_id[]" id="invoice_entry_product_detail_quotation_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_quotation_detail_id']?>" />
									<input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_entry_type']?>" />
                                     <input type="hidden"  name="invoice_entry_product_detail_brand_id[]" id="invoice_entry_product_detail_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['product_brand_id']?>" />
                                    </td>
								
								<td><?=$product_colour_name?><input type="hidden" id="invoice_entry_product_detail_color_id<?=$row_cnt?>" name="invoice_entry_product_detail_color_id[]" value="<?=$get_product_detail['invoice_entry_product_detail_color_id']?>"></td>
								
								<td><?=$arr_thick[$product_thick_ness];?><input type="hidden" id="invoice_entry_product_detail_product_thick<?=$row_cnt?>" name="invoice_entry_product_detail_product_thick[]" value="<?=$get_product_detail['invoice_entry_product_detail_product_thick']?>"></td>
								
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches<?=$row_cnt?>"   onBlur="GetWcalc(2,<?=$row_cnt?>)" value="<?=sprintf('%0.3f',$get_product_detail['invoice_entry_product_detail_width_inches']);?>"  /></td> 
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm<?=$row_cnt?>"     onBlur="GetWcalc(3,<?=$row_cnt?>)" value="<?=round($get_product_detail['invoice_entry_product_detail_width_mm']);?>"  /></td>
								
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches<?=$row_cnt?>"    onBlur="GetTotalLength(<?=$row_cnt?>),GetLcalS(2,<?=$row_cnt?>)" value="<?=sprintf('%0.3f',$get_product_detail['invoice_entry_product_detail_s_width_inches']);?>" /></td> 
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm<?=$row_cnt?>" onBlur="GetTotalLength(<?=$row_cnt?>),GetLcalS(3,<?=$row_cnt?>)" value="<?=round($get_product_detail['invoice_entry_product_detail_s_width_mm']);?>" /></td>
								
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_inches[]" id="invoice_entry_product_detail_s_weight_inches<?=$row_cnt?>"  onblur="GetLcalc(3,<?=$row_cnt?>),RawdiscountPerFind(<?=$row_cnt?>)"   value="<?=sprintf('%0.3f',$get_product_detail['invoice_entry_product_detail_s_weight_inches']);?>"   /></td> 
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_mm[]" id="invoice_entry_product_detail_s_weight_mm<?=$row_cnt?>"  onblur="GetLcalc(4,<?=$row_cnt?>)"  value="<?=round($get_product_detail['invoice_entry_product_detail_s_weight_mm']);?>"   />
								<input type="hidden"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty<?=$row_cnt?>"  value="<?=round($get_product_detail['invoice_entry_product_detail_qty'])?>" /></td>
                                <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_met[]" id="invoice_entry_product_detail_s_weight_met<?=$row_cnt?>"  onblur="GetLcalc(4,'+row_cnt+')"  value="<?=sprintf('%0.3f',$get_product_detail['invoice_entry_product_detail_s_weight_met']);?>"  /></td>
								
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate<?=$row_cnt?>"  value="<?=round($get_product_detail['invoice_entry_product_detail_rate'])?>"   onBlur="RawdiscountPerFind(<?=$row_cnt?>)"    /></td>
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total<?=$row_cnt?>" value="<?=round($get_product_detail['invoice_entry_product_detail_total'])?>" />
                                <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm<?=$row_cnt?>" value="<?=round($get_product_detail['invoice_entry_product_detail_sl_feet_mm']);?>"  />
                                <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_met[]" id="invoice_entry_product_detail_sl_feet_met<?=$row_cnt?>"  value="<?=sprintf('%0.3f',$get_product_detail['invoice_entry_product_detail_sl_feet_met']);?>" /> 
                                <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet<?=$row_cnt?>" value="<?=round($get_product_detail['invoice_entry_product_detail_sl_feet']);?>"  />
                                <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in<?=$row_cnt?>" value="<?=sprintf('%0.3f',$get_product_detail['invoice_entry_product_detail_sl_feet_in']);?>" />
                                </td>		
								<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['invoice_entry_product_detail_id']?>&invoice_entry_uniq_id=<?php echo $invoice_entry_edit['invoice_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
							</tr>
											
											<?php $row_cnt++; } }?>
									</tbody>
								</table>
								</div>
								
								<table class="table table-striped table-bordered table-hover" id="product_detail_as"  style="width:100%;display:<?=($invoice_entry_prd_edit[0]['invoice_entry_product_detail_entry_type']==4)?"":'none'?>" ><!-- display:none-->
									
									<thead >
                                         <tr>
                                            <th style="vertical-align:middle;">NAME</th>
                                            <th style="vertical-align:middle;">UOM</th>
											<th style="vertical-align:middle;">QTY</th>
											<th style="vertical-align:middle;">Rate</th>
											<th style="vertical-align:middle;">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_detail_as_display">
									<?php 
										//$row_cnt	= 0;
										$arr_cnt	= count($invoice_entry_prd_edit);
										
										foreach($invoice_entry_prd_edit as $get_product_detail){
											
												$product_code			= $get_product_detail['product_code'];
												$product_name			= $get_product_detail['product_name'];
												$product_uom_name		= $get_product_detail['p_uom_name'];
												$product_colour_name	= $get_product_detail['p_colour_name'];
												$product_brand_name		= $get_product_detail['brand_name'];
												$product_thick_ness		=$get_product_detail['invoice_entry_product_detail_product_thick'];
											if($get_product_detail['invoice_entry_product_detail_entry_type']==4){ 
											?>
								<tr>
								
								<td><input type="hidden"  name="invoice_entry_product_detail_mother_child_type[]" id="invoice_entry_product_detail_mother_child_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_mother_child_type']?>" /><?=$product_name?>
								<input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_id']?>" />
								<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_id']?>" />
								<input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_product_type']?>" />
								<input type="hidden"  name="invoice_entry_product_detail_quotation_detail_id[]" id="invoice_entry_product_detail_quotation_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_quotation_detail_id']?>" />
								<input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_product_detail_entry_type']?>" />
                                 <input type="hidden"  name="invoice_entry_product_detail_brand_id[]" id="invoice_entry_product_detail_brand_id<?=$row_cnt?>" value="<?=$get_product_detail['product_brand_id']?>" /></td>
								
								<td><?=$product_uom_name?></td>
								
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty<?=$row_cnt?>" value="<?=round($get_product_detail['invoice_entry_product_detail_qty'])?>"   onBlur="AccdiscountPerFind(<?=$row_cnt?>)"  /></td> 
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate<?=$row_cnt?>"  value="<?=round($get_product_detail['invoice_entry_product_detail_rate'])?>"  onBlur="AccdiscountPerFind(<?=$row_cnt?>)"  /></td>
								<td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total<?=$row_cnt?>"  value="<?=round($get_product_detail['invoice_entry_product_detail_total'])?>"  /></td>
										
								<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['invoice_entry_product_detail_id']?>&invoice_entry_uniq_id=<?php echo $invoice_entry_edit['invoice_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>
							</tr>
											
											<?php $row_cnt++; } }?>
									</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" style=" width:100%" >
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Gross</td>
										<td style="width:20%"><input type="text" class="form-control" name="invoice_entry_gross_amount" id="invoice_entry_gross_amount" value="<?=round($invoice_entry_edit['invoice_entry_gross_amount'])?>" ></td>
									</tr>
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Transportation Charges</td>
										<td><input type="text" class="form-control" name="invoice_entry_transport_amount" id="invoice_entry_transport_amount" onBlur="totalAmount()"  value="<?=round($invoice_entry_edit['invoice_entry_transport_amount'])?>"/></td>
									</tr>
									<tr id="tax_details">
										<td style="width:50%">&nbsp;</td>
										<td>Tax</td>
										<td style="width:20%"><input type="text" class="form-control" name="invoice_entry_tax_per" id="invoice_entry_tax_per" onBlur="totalAmount()"  value="<?=round($invoice_entry_edit['invoice_entry_tax_per'])?>"/></td>
										<td><input type="text" class="form-control" name="invoice_entry_tax_amount" id="invoice_entry_tax_amount" value="<?=round($invoice_entry_edit['invoice_entry_tax_amount'])?>" /></td>
									</tr>
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Total</td>
										<td><input type="text" class="form-control" name="invoice_entry_total_amount" id="invoice_entry_total_amount" value="<?=round($invoice_entry_edit['invoice_entry_total_amount'])?>"  ></td>
									</tr>
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Advance</td>
										<td><input type="text" class="form-control" name="invoice_entry_advance_amount" id="invoice_entry_advance_amount" onBlur="totalAmount()"  value="<?=round($invoice_entry_edit['invoice_entry_advance_amount'])?>"/></td>
									</tr>
									<tr>
										<td style="width:50%">&nbsp;</td>
										<td colspan="2">Balance</td>
										<td><input type="text" class="form-control" name="invoice_entry_net_amount" id="invoice_entry_net_amount"   value="<?=round($invoice_entry_edit['invoice_entry_net_amount'])?>"/></td>
									</tr>
								</table>
								</div>
								<div class="col-lg-6">
										<input type="hidden"  name="invoice_entry_id" id="invoice_entry_id" value="<?=$invoice_entry_edit['invoice_entry_id']?>" />	
										<input type="hidden"  name="invoice_entry_uniq_id" id="invoice_entry_uniq_id" value="<?=$invoice_entry_edit['invoice_entry_uniq_id']?>" />	
									<button name="invoice_entry_update" type="submit" class="btn btn-success">Save </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				</form>
			<script type="text/javascript">
			//getTableHeader('<?=$invoice_entry_edit['invoice_entry_type_id']?>');
			</script>
				<?php
				} else{?>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Invoice Entry List
                        </div>
						<form action="index.php" method="post" id="so_list_form" name="so_list_form" >
                                <div class="col-lg-6">
										<div class="form-group">
											<label class="control-label">Branch</label>
											<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%" >
												  <option value=""> - Select - </option>
												<?php
													foreach($branch_list	as	$get_branch){
												$selected	= ($get_branch['branch_id']==searchValue('search_branch_id'))?'selected="selected"':'';
												?>
														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
									 <div class="col-lg-6">
									<div class="form-group">
											<label class="control-label">Customer</label>
											<select name="invoice_entry_customer_id" id="invoice_entry_customer_id" class="form-control select2" style="width:100%" >
												  <option value=""> - Select - </option>
												<?php
													foreach($customer_list	as	$get_customer){
												?>
														<option value="<?=$get_customer['customer_id']?>"<?php if(searchValue('invoice_entry_customer_id')==$get_customer['customer_id']) {?> selected="selected" <?php }?>><?=$get_customer['customer_code']."-".$get_customer['customer_name']?></option>
												<?php
													}
												?>
											</select>
										</div>
										</div>
										<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">From Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_from_date" id="search_from_date" autocomplete="off"  value="<?=searchValue('search_from_date')?>"  >
										</div>
									</div>
									</div>
									<div class="col-lg-6">
									<div class="form-group">
										<label class="control-label">To Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_to_date" id="search_to_date" autocomplete="off"  value="<?=searchValue('search_to_date')?>"  />
										</div>
									</div>
									</div>
								<div class="col-lg-12">
									<button name="search" type="submit" class="btn btn-success">Search </button>
									<button type="reset" class="btn btn-danger">Reset </button>
								</div>
								</form>	
                        <div class="panel-body">
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">
							<?php if(isset($_REQUEST['search'])){?>
								<form action="index.php" method="post" id="invoice_entry_list_form" name="_list_form" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>INV.No.</th>
                                            <th>Date</th>
                                            <th>Customer</th>
                                            <th>Validity Date</th>
											
											<th>Print</th>
                                            <th>Action</th>
											<th>
												<input name="checkall" onClick="checkedAll();" type="checkbox"  />
												<button name="invoice_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>
											</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										$inv_no = 1;
										foreach($quotation_list	as $get_quotation){
										$edit_status1 =editStatus('collection_entry_details','collection_entry_detail_invoice_entry_id',$get_quotation['invoice_entry_id'],'collection_entry_detail_deleted_status');
										$edit_status2 =editStatus('production_order_product_details','production_order_product_detail_invoice_detail_id',$get_quotation['invoice_entry_id'],'production_order_product_detail_deleted_status');
										
										//$edit_status = $edit_status1+$edit_status2;
										$delete_status = deleteStatus();
										if($delete_status ==1){
										  $delete_status1 = $edit_status1;
										   $delete_status2 = $edit_status2;
										}
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=$get_quotation['invoice_entry_no']?></td>
                                            <td><?=dateGeneralFormatN($get_quotation['invoice_entry_date'])?></td>
											<td><?=$get_quotation['customer_name']?></td>
                                            <td><?=dateGeneralFormatN($get_quotation['invoice_entry_validity_date'])?></td>
											<td><a href="invoice-print.php?id=<?php echo $get_quotation['invoice_entry_uniq_id']?>" title="INVOICE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
                                            <td class="center">
											<?php if($edit_status1 == 1 && $edit_status2==1){ ?>
												<a href="index.php?page=edit&id=<?php echo $get_quotation['invoice_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 
												style="color:blue"></a>&nbsp;&nbsp;
												<?php }?>
      										</td>
											
											<td>
											<?php if($delete_status1 == 1 && $delete_status2==1){ ?>
												<input name="deleteCheck[]" value="<?php echo $get_quotation['invoice_entry_uniq_id']; ?>" type="checkbox" />
												<?php }?>
											</td>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
								</form>
								
								<?php } ?>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            	</div>
				<?php } ?>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	<div class="panel-body">
                            
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">
                                <div class="modal-dialog" style="width: 800px;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                        </div>
                                        <div class="modal-body">
											<div class="table-responsive">
												<div id="dynamic-content">
												</div>
											</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onClick="AddproductDetail()"  data-dismiss="modal">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
	<div class="panel-body">
		
		<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">
			<div class="modal-dialog" style="width: 800px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Invoice Entry Detail</h4>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<div id="so_detail_content">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" onClick="AddSodetail()"  data-dismiss="modal">Save changes</button>
					</div>
				</div>
			</div>
		</div>
	</div>					
    <!-- /. WRAPPER  -->
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
    <div id="footer-sec">
        <?=PROJECT_FOOTER?>
    </div>
    <!-- /. FOOTER  -->
			<script>
			$(document).ready(function () {
				$('#dataTables-example').DataTable( {
					responsive: true
				} );
			});
			$(function() {
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#production_planning_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
			$( "#search_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#search_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#search_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#search_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
		//Initialize Select2 Elements
			$(".select2").select2();
			$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#invoice_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
				$( "#invoice_entry_validity_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'',changeMonth:true,changeYear:true,});
			});
			
			$( "#customer_form" ).validate({
			  highlight: function (element, errorClass) {
				$(element).closest('.form-group').addClass('has-error');
			  },
			  unhighlight: function (element, errorClass) {
					$(element).closest('.form-group').removeClass('has-error');
			  },
			  errorPlacement: function(error, element){}
		});	
		</script>
</body>
</html>
