<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>COSTING ENTRY</title>
<?php 
	include "../includes/common/header.php";
	//require_once "../includes/utility-class.php";
	if(isset($_GET['msg'])) {
		
		if($_GET['msg']==1) {
		
			$msg = 'Added successfully';
			
		}elseif($_GET['msg']==2) {
		
			$msg = 'Updated successfully';

		} 
	}		
?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/eva-costing-entry/costing-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">COSTING ENTRY</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) { echo $msg; }
							?>
						</h1>
                    </div>
                </div>				
				<?php 
					if((isset($_GET['page'])) && ($_GET['page']=='add' || $_GET['page']=='edit')){ 	
						
					?>	
					<form name="costing-forms" id="costing-forms" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php  echo $id = empty($editCost['costingId'])?"":$editCost['costingId']; ?>" >

						<div class="row">
						
							<div id="request" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										COSTING ENTRY						 
									</div>
									
									<div class="panel-body">
										
										<div class="col-lg-6">										
											<div class="form-group">
												<label class="control-label">Branch</label>
												<select name="branchid" id="branchid" class="form-control select2" style="width:100%" required>
													 <option value=""> - Select - </option>
													<?php
														foreach($branch_list as	$get_branch){
															if($editCost['cs_branchid'] == $get_branch['branch_id']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_branch['branch_id']?>"><?=$get_branch['branch_name']?></option>
													<?php
														}
														?>
												</select>
													
											</div>	
											<div class="form-group">
												<label  class="control-label">Port location</label>
												<input type="text" class="form-control" name="port_location" id="port_location"  onkeypress="return o_obj.Alpha_Numeric(this,event);" value="<?php echo empty($editCost['cs_port_location'])?"":$editCost['cs_port_location']; ?>" required>
											</div>		
											<div class="form-group">
												<label  class="control-label">Port name</label>
													<input type="text" class="form-control" name="port_name" id="port_name"  onkeypress="return o_obj.Alpha_Numeric(this,event);"  value="<?php echo empty($editCost['cs_port_name'])?"":$editCost['cs_port_name']; ?>" required>
											</div>											
										</div>																				
										<div class="col-lg-6">
											<div class="form-group">
												<label  class="control-label">Date</label>
												<div class="input-group date">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
												  <input type="text" class="form-control"  name="costingdate" id="costingdate" readonly="" value="<?php echo empty($editCost['cs_costingdate'])?date('d/m/Y'):$editCost['cs_costingdate']; ?>"  required> 	
												</div>
											</div>	
											
											<div class="form-group">
												<label class="control-label">Invoice no</label>
												
												<select name="invoiceId" id="invoiceId" class="form-control select2" style="width:100%"  required><!--onChange="return requestIdFn(this.value);"-->
													 <option value=""> - Select - </option>
													 <?php
														foreach($invoice_list as $get_invoice){
															if($editCost['cs_invoiceId'] == $get_invoice['invoiceId']){ $select ='selected="selected"'; }else{ $select="";}
														?>
															<option <?php echo $select;?>  value="<?=$get_invoice['invoiceId']?>"><?=$get_invoice['invoiceNo']."-".$get_invoice['supplier_name']."-".dateGeneralFormatN($get_invoice['pI_invoice_date'])?></option>
													<?php
														}
														?>
													 
												</select>
											</div>				
										
										
									</div>
									
									</div>		
								</div>						
								<div class="panel panel-info">
								
									<div class="panel-heading">	
										Costing Details								 
									</div>
									
									<div class="panel-body">
										<table id="request_table" class="table table-striped table-bordered table-hover" border="0">
											<thead>
											<?php $count_val = !empty($editCostdetls) ? count($editCostdetls) :''; ?>
												
												<tr style="">
													<th>No</th>
													<th style="width:25%;">Name</th>
													<th style="width:15%;">Currency</th>
													<th>Rate</th>
													<th>Frg:Rate</th>
													<th>Amount By Cur</th>
													<th>Amount By MMK</th>
													<th>Remarks</th>
												</tr>
											</thead>
											<tbody>
											<?php 
												/*$costing_array = array("1"=>"IMPORT DUTY","2"=>"ADVANCE COMMERCIAL TAX 5%","3"=>"ADVANCE INCOME TAX 2%","4"=>"SECURITY FEE","5"=>"BANK CHARGES","6"=>"MACCS SERVICE FEE","7"=>"TRANSPORT CHARGES","8"=>"PORT CHARGES","9"=>"LABOUR CHARGES","10"=>"FREIGHT CHARGES","11"=>"OTHER CHARGES" );*/
												$k=0;
											
												$l=1;
												if(0<$count_val){
												
												$count_id =count($editCostdetls);
												   for($i=1;$i<=count($editCostdetls)+3;$i++){ 
													$j=$i-1;
												?>
												 <tr>
													<td><?php echo $l; ?></td>
													<td>
														<input type="hidden" name="cid[]" value="<?php echo empty($editCostdetls[$j]['costId'])?"":$editCostdetls[$j]['costId']; ?>">
														<select name="costingname[]" id="costingname_<?php echo $j; ?>" class="form-control select2" style="width:100%" onchange='return currency_val(this.value,<?php echo $k; ?>,this);'>
															 <option value=""> - Select - </option>
															 <?php
															foreach($costing_list as $get_costing){
																if($editCostdetls[$j]['c_costingname'] == $get_costing['pur_costing_id']){ $select ='selected="selected"'; }else{ $select="";}
															?>
																<option <?php echo $select;?> value="<?=$get_costing['pur_costing_id']?>"><?=$get_costing['pur_costing_name']?></option>
															<?php
																}
															?>
														 </select>
														</td>
													<td>
														<select name="currencyid[]" id="currencyid_<?php echo $k; ?>" class="form-control select2" style="width:100%" onchange='return currency_val(this.value,<?php echo $k; ?>,this);'>
															 <option value=""> - Select - </option>
															 <?php
															foreach($currency_list as $get_currency){
																if($editCostdetls[$j]['c_currencyId'] == $get_currency['currency_id']){ $select ='selected="selected"'; }else{ $select="";}
															?>
																<option <?php echo $select;?> value="<?=$get_currency['currency_id']?>"><?=$get_currency['currency_name']?></option>
															<?php
																}
															?>
														 </select>
													</td>
													<td><input type="text" class="form-control t_rate" style="text-align:right;" name="rate[]" id="rate_<?php echo $k; ?>"  onkeypress="return o_obj.Numeric(this,event);"  value="<?php echo empty($editCostdetls[$j]['c_rate'])?"":$editCostdetls[$j]['c_rate']; ?>"  onBlur="return calulateAmnt(<?php echo $k; ?>)"></td>
													<td><input type="text" class="form-control t_frgnrate" style="text-align:right;" name="frgnrate[]" id="frgnrate_<?php echo $k; ?>"  onkeypress="return o_obj.Numeric(this,event);" value="<?php echo empty($editCostdetls[$j]['c_frgnrate'])?"":$editCostdetls[$j]['c_frgnrate']; ?>"  onBlur="return calulateAmnt(<?php echo $k; ?>)"></td>
													<td><input type="text" class="form-control t_amount_cur" style="text-align:right;" name="amount_cur[]" id="amount_cur_<?php echo $k; ?>"  onkeypress="return o_obj.Numeric(this,event);get_rate(<?php echo $k; ?>);" value="<?php echo empty($editCostdetls[$j]['c_amount_cur'])?"":$editCostdetls[$j]['c_amount_cur']; ?>" onChange="calulateAmnt_cur()" readonly="" ></td>
													<td><input type="text" class="form-control t_amount" style="text-align:right;" name="amount[]" id="amount_<?php echo $k; ?>"  onkeypress="return o_obj.Numeric(this,event);" value="<?php echo empty($editCostdetls[$j]['c_amount'])?"":$editCostdetls[$j]['c_amount']; ?>" onChange="calulateAmnt()" readonly=""></td>
													<td><input type="text" class="form-control" name="remark[]" id="remark_<?php echo $k; ?>"  onkeypress="return o_obj.Numeric(this,event);" value="<?php echo empty($editCostdetls[$j]['c_remarks'])?"":$editCostdetls[$j]['c_remarks']; ?>" onBlur="add_row(<?php echo $k; ?>);"><input type="hidden" id="payment_apnd" name="payment_count[]" value="<?php  echo $k; ?>" onBlur="add_row(<?php echo $k; ?>);"></td>
													
												</tr>
											 <?php
											 $k++;
											  $l++;
											 
											 	}
											  }else{?>
											  	
												<?php for($i=1;$i<=4;$i++){?>
												
										  		<tr>
													<td><?php echo ($i); ?></td>
													<td>
														<input type="hidden" name="cid[]" value="">
														<select name="costingname[]" id="costingname_<?php echo $k; ?>" class="form-control select2" style="width:100%" onchange='return currency_val(this.value,<?php echo $k; ?>,this);'>
															 <option value=""> - Select - </option>
															 <?php
															foreach($costing_list as $get_costing){
															?>
																<option value="<?=$get_costing['pur_costing_id']?>"><?=$get_costing['pur_costing_name']?></option>
															<?php
																}
															?>
														 </select></td>
													<td>
														<select name="currencyid[]" id="currencyid_<?php echo $i; ?>" class="form-control select2" style="width:100%" onchange='return currency_val(this.value,<?php echo $i; ?>,this);'>
															 <option value=""> - Select - </option>
															 <?php
															foreach($currency_list as $get_currency){
																
															?>
																<option  value="<?=$get_currency['currency_id']?>"><?=$get_currency['currency_name']?></option>
															<?php
																}
															?>
														 </select>
													</td>
													<td><input type="text" class="form-control t_rate" style="text-align:right;"  name="rate[]" id="rate_<?php echo $i; ?>"  onkeypress="return o_obj.Numeric(this,event);"  value="" onBlur="return calulateAmnt(<?php echo $i; ?>)">
														<input type="hidden"  style="text-align:right;" name="cur_rate[]" id="cur_rate_<?php echo $i; ?>" style="text-align:right;"   >
													</td>
													<td><input type="text" class="form-control t_frgnrate" style="text-align:right;" name="frgnrate[]" id="frgnrate_<?php echo $i; ?>"  onkeypress="return o_obj.Numeric(this,event);" value=""  onBlur="return calulateAmnt(<?php echo $i; ?>)" onBlur="return calulateAmnt(<?php echo $i; ?>)" ></td>
													<td><input type="text" class="form-control t_amount_cur" style="text-align:right;" name="amount_cur[]" id="amount_cur_<?php echo $i; ?>"  onkeypress="return o_obj.Numeric(this,event);" value=""  readonly="" ></td><!--return o_obj.Numeric(this,event);-->
													<td><input type="text" class="form-control t_amount" style="text-align:right;" name="amount[]" id="amount_<?php echo $i; ?>"  onkeypress="return o_obj.Numeric(this,event);" value="" onChange="calulateAmnt()" readonly=""></td>
													<td><input type="text" class="form-control" name="remark[]" id="remark_<?php echo $i; ?>"  onkeypress="return o_obj.Numeric(this,event);" value="" onBlur="add_row(<?php echo $i; ?>);"><input type="hidden" id="payment_apnd" name="payment_count[]" value="0"></td>
												</tr>
												
												
												<?php } ?>
												<?php }?>
												</tbody>
												<tfoot>
												<tr>
													<th colspan="5" style="text-align:right; vertical-align:middle;">Total</th>
													
													
													
													
													
													<td>
													
													<input type="text" class="form-control"  style="text-align:right;"name="total_frgnrate" id="total_frgnrate"  value="<?php echo empty($editCost['cs_total_frgnrate'])?"":$editCost['cs_total_frgnrate']; ?>" >
													
													</td>
													<td >
													<input type="text" class="form-control" style="text-align:right;" name="total_rate" id="total_rate"  value="<?php echo empty($editCost['cs_total_rate'])?"":$editCost['cs_total_rate']; ?>" >
													</td>
													
												</tr>
												
												
												
											</tfoot>											
										</table>					
									</div>
									
								</div>
								
							</div>
							
						
							<div class="col-lg-6">
							<?php  $btnVal = (!$id)?  'Save' : 'Save' ; ?>
									<button name="costing_insrtUpdate" type="submit" class="btn btn-success" onClick="validation();"><?php echo $btnVal; ?> </button>
								<button type="reset" class="btn btn-danger">Reset </button>
								<input type="button" class="btn " onClick="location.href='index.php'" value="Back">
							</div>
							
						</div>
					</form>	
				<?php 
					}else{ 
					?>			
					<div class="panel panel-default">
							<div class="panel-heading">
								Costing list
							</div>
							<form action="index.php" method="post" id="so_list_form" name="so_list_form" >

                                <div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%" required>

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
							<div class="col-lg-12" style="text-align:right">
								<button type="button" onClick="location.href='index.php?page=add'" class="btn btn-primary" >Add</button>
							</div>
							&nbsp;
								<div class="table-responsive">
								<?php if(isset($_REQUEST['search'])){?>
									<form name="costing-forms" id="costing-forms" method="post" enctype="multipart/form-data">
									<table class="table table-striped table-bordered table-hover" id="dataTables-costing">
										<thead>
											<tr>
												<th>S.No</th>	
												<th>Cost id</th>										
												<th>Branch</th>
												<th>Port name</th>
												<th>Port location</th>
												<th>Date</th>
												<th>Print</th>
												<th>Action</th>
												<th>
												<input name="checkall" onClick="checkedall();" type="checkbox"  />
												<button name="costing_delete" type="submit" class="btn btn-danger">Delete</button>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$s_no	= 1;									
											foreach($costingList as $result){
											/* $edit_status = $edit_status = editStatus('costing_entry', 'cs_invoiceId','cs_branchid', 'cs_deleted_status');

			$delete_status = deleteStatus();

			if($delete_status == 1)	{

				$delete_status = $edit_status;			

			}*/	
										?>
											<tr class="odd gradeX">
												<td><?php echo $s_no++; ?></td>
												<td><?php echo $result['costingId']; ?></td>
												<td><?php echo $result['branch_name']; ?></td>
												<td><?php echo $result['cs_port_name']; ?></td>
												<td><?php echo $result['cs_port_location']; ?></td>
												 <td><?php echo $result['cs_costingdate']; ?></td>                                  
												<td><a href="costing-print.php?id=<?php echo $result['costingId']?>" title="ADVANCE PRINT" class="glyphicon glyphicon-print pull-left" target="_blank" style="color:blue"></a></td>
												<td class="center">
                                                <?php //if($edit_status ==0){
												echo $edit_status;
												?>
												<a href="index.php?page=edit&id=<?php echo $result['costingId']?>" title="" class="glyphicon glyphicon-pencil pull-left"								style="color:blue"></a>&nbsp;&nbsp;
                                                <?php //} ?>
												</td>
												<td>
                                                <?php //if($delete_status == 0){ ?>
												<input name="deleteCheck[]" value="<?php echo $result['costingId']; ?>" type="checkbox" />
												<?php //} ?>
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
				<?php } ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
    <div id="footer-sec">
        <?=PROJECT_FOOTER?>
    </div>
	


	
	
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
	<script>
		$(document).ready(function () {
			$('#dataTables-costing').DataTable( {
				responsive: true
			} );
			/*$('#dataTables-example').dataTable();*/
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
		$( "#costingdate" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
		
			$( "#production_planning_from_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_to_date" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#production_planning_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
	  });
		$( "#costing-forms" ).validate({
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

 
