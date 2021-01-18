<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Collection Entry</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Collection Entry  added successfully</div>';

		} else if($_GET['msg']==2) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Collection Entry updated successfully</div>';

		} else if($_GET['msg']==3) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Collection Entry deleted successfully</div>';

		} else if($_GET['msg']==4) {

			$msg = 'Product Code already added';

		}else if($_GET['msg']==5) {

			$msg = 'Please fill all required fields';

		}else if($_GET['msg']==6) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Collection Entry Product Detail deleted successfully</div>';

		}else if($_GET['msg']==7) {

			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Collection Entry deleted successfully</div>';

		} 

	}



?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/collection-entry/collection-entry-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/sales-left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Collection Entry</h1>

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

				<form name="customer_form" id="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Collection Entry Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Branch</label>

											<select name="collection_entry_branch_id" id="collection_entry_branch_id" class="form-control select2" style="width:100%" required>

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

										

									</div>

									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control pull-right" name="collection_entry_date" id="collection_entry_date"  value="<?=date('d/m/Y')?>"  required>

											</div>

										</div>
									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Customer</label>

											<select name="collection_entry_customer_id" id="collection_entry_customer_id" class="form-control select2" style="width:100%" required>

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_customer){

												?>

														<option value="<?=$get_customer['customer_id']?>"><?=$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

										</div>

										

									</div>
									<?php /*?><div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Currency</label>

											<select name="collection_entry_currency_id" id="collection_entry_currency_id" class="form-control select2" style="width:100%" required>												  <option value=""> - Select - </option>
												<?php
													foreach($currency_list	as	$get_currency){
												?>
														<option value="<?=$get_currency['currency_id']?>"><?=$get_currency['currency_name']?></option>
												<?php
													}
												?>

											</select>

										</div>

										

									</div><?php */?>
								</div>
						</div>
					</div>
        		</div>
				<div class="row">
					<div class="col-md-12">
						<!-- Advanced Tables -->
						<div class="panel panel-info">
							<div class="panel-heading">
							  Collection Details 
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button type="button" onClick="GetSodetail();" data-toggle="modal" data-target="#soModal" data-id="1" class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >
                                    <thead>
                                        <tr>

                                            <th >Invoice No</th>

                                            <th >Inv Amt</th>
											
											<th >Paid Amt</th>

                                            <th >Collected  Amt</th>

                                            <th >Discount Amt</th>

                                            <th >Balance Amt </th>

                                            <th >Collection Mode</th>

											<th >Bank Name</th>

											<th >Remark</th>

                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

									

									</tbody>

								</table>

								<table class="table table-striped table-bordered table-hover"  style=" width:100%" >

									<tr>

										<td style="width:70%"></td>

										<td>Total</td>

										<td>

										<input type="text" class="form-control pull-right" name="collection_entry_total_amount" id="collection_entry_total_amount" value=""  readonly="" >

										</td>

									</tr>

								</table>

								</div>

								<div class="col-lg-6">

									<button name="collection_entry_insert" type="submit" class="btn btn-success">Save </button>
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

				<form name="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Collection Entry Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">
										<div class="form-group">
										
											<label>Collection No</label>

											  <input type="text" class="form-control" name="collection_entry_no" id="collection_entry_no" value="<?=$collection_entry_edit['collection_entry_no']?>" >

										</div>
										<div class="form-group">

											<label>Branch</label>

											<select name="collection_entry_branch_id" id="collection_entry_branch_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($branch_list	as	$get_branch){

														$selected	= ($get_branch['branch_id']==$collection_entry_edit['collection_entry_branch_id'])?'selected="selected"':'';

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

											<label>Date</label>

											 <div class="input-group date">

											  <div class="input-group-addon">

												<i class="fa fa-calendar"></i>

											  </div>

											  <input type="text" class="form-control pull-right" name="collection_entry_date" id="collection_entry_date" value="<?=dateGeneralFormatN($collection_entry_edit['collection_entry_date'])?>" >

											</div>

										</div>

									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label class="control-label">Customer</label>

											<select name="collection_entry_customer_id" id="collection_entry_customer_id" class="form-control select2" style="width:100%" required>

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_customer){
														$selected	= ($get_customer['customer_id']==$collection_entry_edit['collection_entry_customer_id'])?'selected="selected"':'';
												?>

														<option value="<?=$get_customer['customer_id']?>" <?=$selected?>><?=$get_customer['customer_name']?></option>

												<?php

													}

												?>

											</select>

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

							  Product Details

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetSodetail();" data-toggle="modal" data-target="#soModal" data-id="1" class="glyphicon glyphicon-plus"></button>

                            </button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >

                                    <thead>

                                        <tr>

                                            <th >Invoice No</th>

                                            <th >Inv Amount</th>

                                             <th >Paid  Amount</th>
											<th >Collected  Amount</th>

                                            <th >Discount Amount</th>

                                            <th >Balance Amount </th>

                                            <th >Payment Mode</th>

											<th >Bank Name</th>

											<th >Remark</th>

                                        </tr>

                                    </thead>

                                    <tbody id="so_detail_display">

										<?php 

										$row_cnt	= 0;

										$arr_cnt	= count($collection_entry_prd_edit);

										foreach($collection_entry_prd_edit as $get_product_detail){

										?>

										<tr>

											<td>

											<?=$get_product_detail['invoice_entry_no']?>

											</td>

											<td><input class="form-control" type="text"  name="collection_entry_detail_invoice_amount[]" id="collection_entry_detail_invoice_amount<?=$row_cnt?>" value="<?=$get_product_detail['collection_entry_detail_invoice_amount']?>"  />

											<input type="hidden"  name="collection_entry_detail_invoice_entry_id[]" id="collection_entry_detail_invoice_entry_id<?=$row_cnt?>" value="<?=$get_product_detail['collection_entry_detail_invoice_entry_id']?>"  class="dc_id"  />

											<input type="hidden"  name="collection_entry_detail_id[]" id="collection_entry_detail_id<?=$row_cnt?>" value="<?=$get_product_detail['collection_entry_detail_id']?>"  />
<input type="hidden"  name="collection_entry_detail_customer_id[]" id="collection_entry_detail_customer_id<?=$row_cnt?>" value="<?=$get_product_detail['invoice_entry_customer_id']?>"  />
											

											</td>

											<td><input class="form-control" type="text"  name="collection_entry_detail_paid_amount[]" id="collection_entry_detail_paid_amount<?=$row_cnt?>" value="<?=$get_product_detail['collection_entry_detail_paid_amount']?>"   onkeyup="get_coll_amt(<?=$row_cnt?>);get_colldis(<?=$row_cnt?>);" /></td>
											
											<td><input class="form-control" type="text"  name="collection_entry_detail_amount[]" id="collection_entry_detail_amount<?=$row_cnt?>" value="<?=$get_product_detail['collection_entry_detail_amount']?>"   onkeyup="get_coll_amt(<?=$row_cnt?>);get_colldis(<?=$row_cnt?>);" /></td>
											
											<td><input class="form-control" type="text"  name="collection_entry_detail_disc_amount[]" id="collection_entry_detail_disc_amount<?=$row_cnt?>" value="<?=$get_product_detail['collection_entry_detail_disc_amount']?>"  /></td>
											
											
											<td><input class="form-control" type="text"  name="collection_entry_detail_balance_amount[]" id="collection_entry_detail_balance_amount<?=$row_cnt?>" value="<?=number_format($get_product_detail['collection_entry_detail_balance_amount'],2,'.','')?>"   /></td>
											
											<td><select class='form-control' name='collection_entry_detail_payment_mode[]' id='collection_entry_detail_payment_mode<?=$row_cnt?>' onchange='placeBank(this.value,<?=$row_cnt?>);'>
											
												<option value='1' <?php if($get_product_detail['collection_entry_detail_payment_mode']==1){echo 'selected="selected"';}?>>Cash</option>
												<option value='2' <?php if($get_product_detail['collection_entry_detail_payment_mode']==2){echo 'selected="selected"';}?>>Bank</option>
												</select></td>
											
											<td><select class='form-control' name='collection_entry_detail_bank_id[]' id='collection_entry_detail_bank_id<?=$row_cnt?>'>
												<option value=''>--Select--</option>
												<?php foreach($bank_arr as $get_value){?>
												<option value='<?= $get_value['bank_id'];?>' <?php if($get_product_detail['collection_entry_detail_bank_id']==$get_value['bank_id']){echo 'selected="selected"';}?>><?= $get_value['bank_name'];?></option>
												<?php }?>
												</select></td>
											<td>
											<textarea class='form-control' name='collection_entry_detail_remarks[]' id='collection_entry_detail_remarks<?=$row_cnt?>' ><?=$get_product_detail['collection_entry_detail_remarks']?></textarea></td>
											</td>
											
																						

											<td><?php if($arr_cnt>1) { ?><a href="index.php?product_detail_id=<?=$get_product_detail['collection_entry_product_to_detail_id']?>&collection_entry_uniq_id=<?php echo $collection_entry_edit['collection_entry_uniq_id']?>&product_detail_delete=" title="" class="glyphicon glyphicon-trash " style="color:red"></a><?php } ?></td>

										</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>

								</table>

								<table class="table table-striped table-bordered table-hover"  style=" width:100%" >

									<tr>

										<td style="width:70%"></td>

										<td>Total</td>

										<td>

										<input type="text" class="form-control pull-right" name="collection_entry_total_amount" id="collection_entry_total_amount" value="<?=$collection_entry_edit['collection_entry_total_amount']?>"   readonly="" >

										</td>

									</tr>

								</table>

								<div class="col-lg-6">

										<input type="hidden"  name="collection_entry_id" id="collection_entry_id" value="<?=$collection_entry_edit['collection_entry_id']?>" />	

										<input type="hidden"  name="collection_entry_uniq_id" id="collection_entry_uniq_id" value="<?=$collection_entry_edit['collection_entry_uniq_id']?>" />	

									<button name="collection_entry_update" type="submit" class="btn btn-success">Save </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn "  onClick="location.href='index.php'">Back</button>
								</div>

								</div>

							</div>

						</div>

					</div>

				</div>

				

				</form>

				<?php

				} else{?>

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Collection Entry List

                        </div>

                        <div class="panel-body">
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

											<label class="control-label">Customer</label>

											<select name="customerid" id="customerid" class="form-control select2" style="width:100%"  >

												  <option value=""> - Select - </option>

												<?php

													foreach($customer_list	as	$get_customer){
													//$selected	= ($get_branch['customer_id']==searchValue('customerid'))?'selected="selected"':'';

												?>

							          <option value="<?=$get_customer['customer_id']?>" <?php if(searchValue('customerid')==$get_customer['customer_id']) {?> selected="selected" <?php }?>><?=$get_customer['customer_code']."-".$get_customer['customer_name']?></option>

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
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">
							<?php if(isset($_REQUEST['search'])){?>

								<form action="index.php" method="post" id="collection_entry_list_form" name="collection_entry_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

											<th>P.O.No.</th>

                                            <th>Date</th>

											<th>Customer</th>

                                            <th>Amount</th>											

                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="collection_entry_delete" type="submit" class="btn btn-danger">Delete</button>

											</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($so_return_list	as $get_so_return){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>

                                            <td><?=$get_so_return['collection_entry_no']?></td>

                                            <td><?=dateGeneralFormatN($get_so_return['collection_entry_date'])?></td>
											<td><?=$get_so_return['customer_name']?></td>
											<td><?=$get_so_return['collection_entry_total_amount']?></td>

                                            <td class="center">

												<a href="index.php?page=edit&id=<?php echo $get_so_return['collection_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;

      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_so_return['collection_entry_uniq_id']; ?>" type="checkbox" />

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

		

		<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  style="display: none;">

			<div class="modal-dialog" style="width: 800px;">

				<div class="modal-content">

					<div class="modal-header">

						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

						<h4 class="modal-title" id="myModalLabel">Invoice Detail</h4>

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
			//Date picker
			$(function() {
				var from	= $('#pic_from').val();
				var to	= $('#pic_to').val();
				$( "#collection_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
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

