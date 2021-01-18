<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Con Entry</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product Con Entry added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product Con Entry updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product Con Entry deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product Con Entry Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Product Con Entry deleted successfully</div>';
		}  
	}
?>

<script type="text/javascript" src="<?php echo PROJECT_PATH.'/product-con-entry/product-con-entry-javascript.js'; ?>"></script>
<style>
  th { white-space: nowrap; }
    div.dataTables_wrapper {
        width:100%;
        margin: 0 auto;
    }
</style>

</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/purchase-left-menu.php"; ?> 
        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Product Con Entry</h1>

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

				<form name="customer_form" method="post" data-toggle="validator">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

					   <div class="panel panel-info">

								<div class="panel-heading">

								  	Product Con Entry Details

								</div>

								<div class="panel-body">
									<div class="col-lg-12">
										<div class="form-group">
											<label>P.C. No.</label>
											<input type="text" class="form-control" name="product_con_entry_no" id="product_con_entry_no" style="width:460px;" >
										</div>
									</div>
									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>

											<select name="product_con_entry_branch_id" id="product_con_entry_branch_id" class="form-control select2" style="width:100%">

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

											<label>Warehouse</label>

											<select name="product_con_entry_godown_id" id="product_con_entry_godown_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($godown_list	as	$get_godown){

												?>

														<option value="<?=$get_godown['godown_id']?>"><?=$get_godown['godown_name']?></option>

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
											  <input type="text" class="form-control" name="product_con_entry_date" id="product_con_entry_date" >
											</div>
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

							  Invoice Detail

							</div>

							<div class="panel-body">

								<div class="col-lg-6">

									<button type="button" onClick="GetSodetail();" data-toggle="modal" data-target="#soModal" data-id="1" class="glyphicon glyphicon-plus">
									</button>

								</div>

								<div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="so_detail"  style=" width:100%" >

                                    <thead>

                                        <tr i>

                                            <th style=" width:30%;">Inv No</th>

                                            <th  style=" width:25%;">Inv Date</th>

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
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:100%" >
                                    <thead>
										<tr style="">
											<th rowspan="2" style="width:20%;">Product Name</th>
											<th rowspan="2">Code</th>
											<th rowspan="2">Uom</th>
											<th rowspan="2">Color</th>
											<th colspan="2" style="text-align:center">Width</th>
											<th colspan="2" style="text-align:center">Length</th>
											<th rowspan="2">Total</th>	
											<th rowspan="2">Total qty</th>													
										</tr>
										<tr>
											<th>Inches</th>
											<th>Mm</th>
											<th>Ft</th>
											<th>Mm</th>
										</tr>
									</thead>
                                    <tbody id="product_detail_display">
									</tbody>
								</table>
								</div>
							</div>
						</div>
						
						<div class="panel panel-info">
							<div class="panel-heading">
							 Child Product Details
							</div>
							<div class="panel-body">
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="child_product_detail"  style=" width:150%" >
                                    <thead>
										<tr style="">
											<th rowspan="2" style="width:20%">Code</th>
											<th rowspan="2" style="width:20%;">Product Name</th>
											<th rowspan="2"  style="width:20%">Color</th>
											<th colspan="2" style="text-align:center">Width</th>
											<th colspan="2" style="text-align:center">Length</th>
											<th rowspan="2" style="width:20%;">UOM</th>	
											<th rowspan="2" style="width:20%;">Total</th>	
											<th colspan="2" style="text-align:center">Width</th>
											<th colspan="2" style="text-align:center">Length</th>
											<th rowspan="2" style="width:20%;">Tone</th>	

										</tr>
										<tr>
											<th style="width:15%;">Inches</th>
											<th style="width:15%;">Mm</th>
											<th style="width:15%;">Feet</th>
											<th style="width:15%;">Mm</th>
											<th style="width:15%;">Inches</th>
											<th style="width:15%;">Mm</th>
											<th style="width:15%;">Feet</th>
											<th style="width:15%;">MM&nbsp;&nbsp;</th>
										</tr>
									</thead>
										<tbody id="child_product_detail_display">
										</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" style=" width:100%" >
									<tr>
										<td style="width:60%"></td>
										<td  style="width:10%;"><input type="text" name="product_con_entry_child_length_feet_tot" id="product_con_entry_child_length_feet_tot" class="form-control" /></td>
										<td style="width:20%">&nbsp;</td>
										<td  style="width:15%;"><input type="hidden" name="product_con_entry_child_total" id="product_con_entry_child_total" class="form-control" /></td>
									</tr>
								</table>
								</div>
								<div class="col-lg-12">
									<button name="product_con_entry_insert" type="submit" class="btn btn-success">Submit </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn btn-primary"  onClick="location.href='index.php'">Back</button>
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

								  	Product Con Entry Details

								</div>

								<div class="panel-body">

									<div class="col-lg-6">

										<div class="form-group">

											<label>Branch</label>
											<select name="product_con_entry_branch_id" id="product_con_entry_branch_id" class="form-control select2" style="width:100%">
												  <option value=""> - Select - </option>
												<?php
													foreach($branch_list	as	$get_branch){
														$selected	= ($get_branch['branch_id']==$product_con_entry_edit['product_con_entry_branch_id'])?'selected="selected"':'';
												?>
														<option value="<?=$get_branch['branch_id']?>" <?=$selected?>><?=$get_branch['branch_name']?></option>
												<?php
													}
												?>
											</select>
										</div>

										

										

										<div class="form-group">

											<label>Warehouse</label>

											<select name="product_con_entry_godown_id" id="product_con_entry_godown_id" class="form-control select2" style="width:100%">

												  <option value=""> - Select - </option>

												<?php

													foreach($godown_list	as	$get_godown){

														$selected	= ($get_godown['godown_id']==$product_con_entry_edit['product_con_entry_godown_id'])?'selected="selected"':'';

												?>

														<option value="<?=$get_godown['godown_id']?>" <?=$selected?>><?=$get_godown['godown_name']?></option>

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

											  <input type="text" class="form-control" name="product_con_entry_date" id="product_con_entry_date" value="<?=dateGeneralFormatN($product_con_entry_edit['product_con_entry_date'])?>">

											</div>

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

                                    <thead>

                                        <tr>

                                            <th style=" width:30%;">Invoice No</th>

                                            <th  style=" width:25%;">Invoice Date</th>

                                        </tr>

										

                                    </thead>

                                    <tbody id="so_detail_display">

										<tr>

                                            <td style=" width:30%;"><?=$product_con_entry_edit['invoiceNo']?></th>

                                            <th  style=" width:25%;"><?=dateGeneralFormatN($product_con_entry_edit['pI_invoice_date'])?>

											<input type="hidden"  name="product_con_entry_invoice_entry_id" id="product_con_entry_invoice_entry_id" value='<?=$product_con_entry_edit['product_con_entry_invoice_entry_id']?>'  class='dc_id'  />

											</th>

                                        </tr>

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

                                <table class="table table-striped table-bordered table-hover" id="product_detail"  style=" width:100%" >

                                    <thead>

										 <tr>

											<th rowspan="2" style="vertical-align:middle;">PRD CODE </th>

											<th rowspan="2" style="vertical-align:middle;">NAME</th>

											<th rowspan="2" style="vertical-align:middle;">UOM</th>

											<th colspan="4">LENGTH</th>

											<th rowspan="2" style="vertical-align:middle;">QTY</th>

											<th rowspan="2" style="vertical-align:middle;">Remarks</th>

											<th rowspan="2" style="vertical-align:middle;">&nbsp;</th>

										</tr>

										<tr>

											<th >FEET</th>

											<th >INCHES</th>

											<th >MM</th>

											<th >METERS</th>

										</tr>

                                    </thead>

                                    <tbody id="product_detail_display">
										<?php 
										$row_cnt	= 0;
										$arr_cnt	= count($product_con_entry_prd_edit);
										foreach($product_con_entry_prd_edit as $get_product_detail){

										?>

										<tr>
											<td>
											<?=$get_product_detail['product_code']?>
											</td>
											<td>
											<?=$get_product_detail['product_name']?>
											<input type="hidden"  name="product_con_entry_product_detail_product_id" id="product_con_entry_product_detail_product_id" value="<?=$get_product_detail['product_con_entry_product_detail_product_id']?>" class="sd_id"  />

											<input type="hidden"  name="product_con_entry_product_detail_id" id="product_con_entry_product_detail_id" value="<?=$get_product_detail['product_con_entry_product_detail_id']?>" />
											</td>
											<td>
											<input class="form-control" type="text"  name="product_uom" id="product_uom<?=$row_cnt?>" value="<?=$get_product_detail['product_uom_name']?>"   />
											</td>
											<td>
											<input class="form-control" type="text"  name="product_con_entry_product_detail_width_inches" id="product_con_entry_product_detail_width_inches<?=$row_cnt?>" value="<?=$get_product_detail['product_con_entry_product_detail_width_inches']?>"   />
											</td>
											<td>
											<input class="form-control" type="text"  name="product_con_entry_product_detail_width_mm" id="product_con_entry_product_detail_width_mm<?=$row_cnt?>" value="<?=$get_product_detail['product_con_entry_product_detail_width_mm']?>"   />
											</td>
											<td>
											<input class="form-control" type="text"  name="product_con_entry_product_detail_length_feet" id="product_con_entry_product_detail_length_feet<?=$row_cnt?>" value="<?=$get_product_detail['product_con_entry_product_detail_length_feet']?>"   />
											</td>
											<td>
											<input class="form-control" type="text"  name="product_con_entry_product_detail_length_mm" id="product_con_entry_product_detail_length_mm<?=$row_cnt?>" value="<?=$get_product_detail['product_con_entry_product_detail_length_mm']?>"   />
											</td>
											<td>
											<input class="form-control" type="text"  name="product_con_entry_product_detail_qty" id="product_con_entry_product_detail_qty<?=$row_cnt?>"  value="<?=$get_product_detail['product_con_entry_product_detail_qty']?>" />

											</td>
											<td>
											<input class="form-control" type="text"  name="product_con_entry_product_detail_total_qty" id="product_con_entry_product_detail_total_qty<?=$row_cnt?>"  value="<?=$get_product_detail['product_con_entry_product_detail_total_qty']?>" />
											</td>
											
										</tr>

										<?php 

											$row_cnt	= $row_cnt+1;	

										 } ?>									

									</tbody>

								</table>

								

								</div>
								

							</div>

						</div>
						<div class="panel panel-info">
							<div class="panel-heading">
							 Child Product Details
							</div>
							<div class="panel-body">
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="child_product_detail"  style=" width:150%" >
                                    <thead>
										<?php /*?><tr style="">
											<th rowspan="2">Code</th>
											<th rowspan="2" style="width:20%;">Product Name</th>
											<th rowspan="2">Color</th>
											<th colspan="2" style="text-align:center">Width</th>
											<th colspan="2" style="text-align:center">Length</th>
											<th rowspan="2">UOM</th>	
											<th rowspan="2">Total</th>													
										</tr>
										<tr>
											<th>Inches</th>
											<th>Mm</th>
											<th>Ft</th>
											<th>Mm</th>
										</tr><?php */?>
										<tr style="">
											<th rowspan="2" style="width:20%">Code</th>
											<th rowspan="2" style="width:20%;">Product Name</th>
											<th rowspan="2"  style="width:20%">Color</th>
											<th colspan="2" style="text-align:center">Width</th>
											<th colspan="2" style="text-align:center">Length</th>
											<th rowspan="2" style="width:20%;">UOM</th>	
											<th rowspan="2" style="width:20%;">Total</th>	
											<th colspan="2" style="text-align:center">Width</th>
											<th colspan="2" style="text-align:center">Length</th>
											<th rowspan="2" style="width:20%;">Tone</th>	

										</tr>
										<tr>
											<th style="width:15%;">Inches</th>
											<th style="width:15%;">Mm</th>
											<th style="width:15%;">Feet</th>
											<th style="width:15%;">Mm</th>
											<th style="width:15%;">Inches</th>
											<th style="width:15%;">Mm</th>
											<th style="width:15%;">Feet</th>
											<th style="width:15%;">MM&nbsp;&nbsp;</th>
										</tr>
									</thead>
										<tbody id="child_product_detail_display">
											<?php
											foreach($product_con_entry_child_prd_edit as $get_chd_prd_detail){
											?>
											<tr>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_code[]" id="product_con_entry_child_product_detail_code_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_code']?>" class="form-control" readonly=""  />
													<input type="hidden" name="product_con_entry_child_product_detail_id[]" id="product_con_entry_child_product_detail_id_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_id']?>" class="form-control"  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_name[]" id="product_con_entry_child_product_detail_name_<?=$i?>" class="form-control" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_name']?>"  readonly=""  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_color[]" id="product_con_entry_child_product_detail_color_<?=$i?>" value="<?=$get_chd_prd_detail['product_colour_name']?>" class="form-control"  readonly=""   />
													<input type="hidden" name="product_con_entry_child_product_detail_color_id[]" id="product_con_entry_child_product_detail_color_id_<?=$i?>"  value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_color_id']?>"   />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_width_inches[]" id="product_con_entry_child_product_detail_width_inches_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_width_inches']?>" class="form-control"   readonly="" />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_width_mm[]" id="product_con_entry_child_product_detail_width_mm_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_width_mm']?>" class="form-control" readonly=""  />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_length_feet[]" id="product_con_entry_child_product_detail_length_feet_<?=$i?>" class="form-control"  value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_length_feet']?>" onBlur="ChildtotalAmount();" />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_length_mm[]" id="product_con_entry_child_product_detail_length_mm_<?=$i?>" class="form-control"  value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_length_mm']?>"/>
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_uom[]" id="product_con_entry_child_product_detail_uom_<?=$i?>" value="<?=$get_chd_prd_detail['product_uom_name']?>" class="form-control" readonly=""   />
													<input type="hidden" name="product_con_entry_child_product_detail_uom_id[]" id="product_con_entry_child_product_detail_uom_id_<?=$i?>" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_uom_id']?>" />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_total[]" id="product_con_entry_child_product_detail_total_<?=$i?> " class="form-control" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_total']?>" onBlur="ChildtotalAmount();"    />
												</td>
												<!-- Start others-->
												<td>
													<input type="text" name="product_con_entry_child_product_detail_con_width_inches[]" id="product_con_entry_child_product_detail_con_width_inches_<?=$i?> " class="form-control" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_con_width_inches']?>"   />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_con_width_mm[]" id="product_con_entry_child_product_detail_con_width_mm_<?=$i?> " class="form-control" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_con_width_mm']?>"     />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_con_length_feet[]" id="product_con_entry_child_product_detail_con_length_feet_<?=$i?> " class="form-control" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_con_length_feet']?>"     />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_con_length_mm[]" id="product_con_entry_child_product_detail_con_length_mm_<?=$i?> " class="form-control" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_con_length_mm']?>"     />
												</td>
												<td>
													<input type="text" name="product_con_entry_child_product_detail_con_tone[]" id="product_con_entry_child_product_detail_con_tone_<?=$i?> " class="form-control" value="<?=$get_chd_prd_detail['product_con_entry_child_product_detail_con_tone']?>" />
												</td>
												
												 
											</tr>
											<?php } ?>
										</tbody>
								</table>
								<table class="table table-striped table-bordered table-hover" style=" width:100%" >
									<tr>
										<td style="width:60%"></td>
										<td  style="width:10%;"><input type="text" name="product_con_entry_child_length_feet_tot" id="product_con_entry_child_length_feet_tot"  class="form-control" value="<?=$product_con_entry_edit['product_con_entry_child_length_feet_tot']?>" /></td>
										<td style="width:20%">&nbsp;</td>
										<td  style="width:15%;"><input type="hidden" name="product_con_entry_child_total" id="product_con_entry_child_total" class="form-control" /></td>
									</tr>
								</table>
								</div>
								<div class="col-lg-6">

										<input type="hidden"  name="product_con_entry_id" id="product_con_entry_id" value="<?=$product_con_entry_edit['product_con_entry_id']?>" />	
										<input type="hidden"  name="product_con_entry_uniq_id" id="product_con_entry_uniq_id" value="<?=$product_con_entry_edit['product_con_entry_uniq_id']?>" />	

									<button name="product_con_entry_update" type="submit" class="btn btn-success">Submit </button>
									<button type="reset" class="btn btn-danger">Reset </button>
									<button type="button" class="btn btn-primary"  onClick="location.href='index.php'">Back</button>
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

                           Product Con Entry List

                        </div>

                        <div class="panel-body">
							<div class="col-lg-12" style="text-align:right	">	
								<button name="so_entry_insert" type="button" class="btn btn-primary" onClick="location.href='index.php?page=add'" >Add</button>
							</div>
							<div class="col-lg-12">	
							&nbsp;
							</div>
                            <div class="table-responsive">

								<form action="index.php" method="post" id="product_con_entry_list_form" name="_list_form" >

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>
											<th>INV.No.</th>
                                            <th>Date</th>
                                            <th>Action</th>

											<th>

												<input name="checkall" onClick="checkedAll();" type="checkbox"  />

												<button name="product_con_entry_entry_delete" type="submit" class="btn btn-danger">Delete</button>

											</th>

                                        </tr>

                                    </thead>

                                    <tbody>

									<?php

										$s_no	= 1;

										foreach($quotation_list	as $get_quotation){

									?>

                                        <tr class="odd gradeX">

                                            <td><?=$s_no++?></td>
                                            <td><?=$get_quotation['product_con_entry_no']?></td>
                                            <td><?=dateGeneralFormatN($get_quotation['product_con_entry_date'])?></td>
                                            <td class="center">
												<a href="index.php?page=edit&id=<?php echo $get_quotation['product_con_entry_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 

												style="color:blue"></a>&nbsp;&nbsp;
      										</td>

											<td>

												<input name="deleteCheck[]" value="<?php echo $get_quotation['product_con_entry_uniq_id']; ?>" type="checkbox" />

											</td>

                                        </tr>

									<?php } ?>

                                    </tbody>

                                </table>

								</form>

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

						<h4 class="modal-title" id="myModalLabel">Product Con Entry Detail</h4>

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
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">
	<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_to_date']; ?>" id="pic_to">
    <!-- /. WRAPPER  -->

    <div id="footer-sec">

        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>

    </div>

    <!-- /. FOOTER  -->

		<script>
		var table = $('#child_product_detail').DataTable( {
				"bInfo" : false,
				scrollY:true,
				scrollX:true,
				scrollCollapse: true,
				paging: false,
				"bFilter": false,
				"searching": false
				
		});
		$(document).ready(function () {
			$('#dataTables-example').DataTable( {
				responsive: true
			} );
		});
		//Initialize Select2 Elements
		$(".select2").select2();
		//Date picker
		$(function() {
			var from	= $('#pic_from').val();
			var to	= $('#pic_to').val();
			$( "#product_con_entry_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:to,changeMonth:true,changeYear:true,});
		});
		</script>



</body>

</html>

