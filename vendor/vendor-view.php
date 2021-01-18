<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vendor</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = 'Vendor added successfully';
		} else if($_GET['msg']==5) {
			$msg = 'Vendor updated successfully';
		} else if($_GET['msg']==3) {
			$msg = 'Vendor deleted successfully';
		} else if($_GET['msg']==4) {
			$msg = 'Vendor Code already added';
		}else if($_GET['msg']==2) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = 'Deleted Contact Detail succesfull';
		} 
	}

?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/vendor/vendor-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/admin-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Vendor</h1>
                        <h1 class="page-subhead-line">
						
						</h1>
                    </div>
                </div>
				<?php if((isset($_GET['page'])) && ($_GET['page']=='add')) { ?>
				<form name="customer_form" method="post" data-toggle="validator">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
					   <div class="panel panel-info">
								<div class="panel-heading">
								  	Vendor Details
								</div>
								<div class="panel-body">
									
										<div class="col-lg-4">			
											<div class="form-group">
												<label>Vendor Code</label>
													<input class="form-control" type="text"  name="vendor_code" id="vendor_code"  />
												
												<p></p>
											</div>
										</div>
										<div class="col-lg-4">			
											<div class="form-group">
												<label>Vendor Name</label>
											<input class="form-control" type="text" name="vendor_name" id="vendor_name"  required />
											</div>
										</div>
										<div class="col-lg-4">	
											<div class="form-group">
												<label>Address</label>
												<textarea class="form-control" id="vendor_address" name="vendor_address"></textarea>
												
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Contact No</label>
												<input class="form-control" type="text"  name="vendor_contact_no" id="vendor_contact_no"  />
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Service For</label>
												<select class="form-control select2" name="vendor_service" id="vendor_service"/>
												  <option value="">--Select--</option>
												  <?php foreach($vendor_service as $service_value => $service_list){ ?>
												  <option value="<?=$service_value ?>"><?=ucwords($service_list);?></option>
												  <?php }?>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Spi In</label>
												<input class="form-control" type="text"  name="vendor_spi_in" id="vendor_spi_in"  />
											</div>
											<div class="form-group">
												<label>Payment Mode</label>
											    <select class="form-control select2" name="vendor_payment_mode" id="vendor_payment_mode"/>
												  
												  <option value="">--Select--</option>
												  <?php foreach($payment_mode AS $mode_value => $mode_list){?>
												  <option value="<?=$mode_value ?>"><?=ucwords($mode_list);?></option>
												  <?php }?>
												</select>
											</div>
											<div class="form-group">
												<label>Payment Days</label>
												<input class="form-control" type="text"  name="vendor_payment_day" id="vendor_payment_day"/ >
											</div>
											<div class="form-group">
												<label>Status</label>
												<div id="cityDiv">
												<select class="form-control select2" name="vendor_active_status" id="vendor_active_status">
												  
												   <?php foreach($status AS $status_value => $status_list){?>
												  <option value="<?=$status_value ?>"><?=ucwords($status_list);?></option>
												  <?php }?>
												</select>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
												<div class="form-group">
												<label>Contract NO</label>
												<div id="stateDiv">
												<input class="form-control" type="text"  name="vendor_contract_no" id="vendor_contract_no"/ >
											</div>
											<div class="form-group">
												<label>Contract Vaild From</label>
												<input class="form-control" type="text"  name="vendor_contract_vaild_from" id="vendor_contract_vaild_from"  min="0" />
											</div>
											<div class="form-group">
												<label>Contract Expire Date</label>
												<input class="form-control" type="text"  name="vendor_contract_expire_date" id="vendor_contract_expire_date" >
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
							  Contact Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button  type="button" onClick="addRow()"class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="multi-contact">
                                    <thead>
                                        <tr>
                                            <th>Contact Person</th>
                                            <th>Designation</th>
                                            <th>Contact No</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
										<tr  class="odd gradeX">
										
										<td width="33%">
										<input name="vendor_detail_contact_person[]" type="text" value=""  id="vendor_detail_contact_person[]" class="form-control"  /> 
										</td>
										<td width="33%">
										<input name="vendor_detail_designation[]" type="text" value="" class="form-control" id="vendor_detail_designation[]"  />
										</td>
										<td width="34%">
										<input name="vendor_detail_contact_no[]" type="number" value="" class="form-control" id="vendor_detail_contact_no[]"  />
										</td>
										
									  </tr>
									</tbody>
								</table>
								</div>
								<div class="col-lg-6">
									<button name="vendor_insert" type="submit" class="btn btn-primary">Save</button>
									<button type="reset" class="btn btn-danger">Reset Button</button>
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
								  	Customer Details
								</div>
								<div class="panel-body">
									
										<div class="col-lg-4">			
											<div class="form-group">
												<label>Name</label>
												<input class="form-control" type="text" name="vendor_name" id="vendor_name" value="<?=$vendor_edit['vendor_name']?>"  required />
												<p></p>
											</div>
										</div>
										<div class="col-lg-4">			
											<div class="form-group">
												<label>Code</label>
												<input class="form-control" type="text"  name="vendor_code" id="vendor_code"  value="<?=$vendor_edit['vendor_code']?>"   />
											</div>
										</div>
										<div class="col-lg-4">	
											<div class="form-group">
												<label>Address</label>
												<textarea class="form-control"  name="vendor_address" id="vendor_address" ><?=$vendor_edit['vendor_address']?></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Contact No</label>
													<input class="form-control" type="text"  name="vendor_contact_no" id="vendor_contact_no" value="<?=$vendor_edit['vendor_contact_no']?>" />
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Vendor Service</label>
												<select class="form-control select2" name="vendor_service" id="vendor_service"/>
												  <option value="">--Select--</option>
												  <?php foreach($vendor_service as $service_value => $service_list){ 
												  ?>
												  <option value="<?=$service_value ?>" <?php if($service_value == $vendor_edit['vendor_service']) { echo 'selected="selected"' ; } ?> ><?=ucwords($service_list);?></option>
												  <?php 
												  }?>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
											<label>Spi In</label>
												<input class="form-control" type="text"  name="vendor_spi_in" id="vendor_spi_in" value="<?=$vendor_edit['vendor_spi_in']?>"  />
											</div>
											<div class="form-group">
												<label>Payment Mode</label>
											    <select class="form-control select2" name="vendor_payment_mode" id="vendor_payment_mode"/>
												  
												  <option value="">--Select--</option>
												  <?php foreach($payment_mode AS $mode_value => $mode_list){?>
												  <option value="<?=$mode_value ?>" <?php if($mode_value ==$vendor_edit['vendor_payment_mode'] ){ echo 'selected="selected"';} ?>><?=ucwords($mode_list);?></option>
												  <?php }?>
												</select>
											</div>
											<div class="form-group">
												<label>Payment Days</label>
												<input class="form-control" type="text"  name="vendor_payment_day" id="vendor_payment_day" value="<?=$vendor_edit['vendor_payment_day']?>"   />
											</div>
										</div>
										<div class="col-lg-4">
												<div class="form-group">
												<label>Contract No</label>
												<div id="stateDiv">
													<input class="form-control" type="text"  name="vendor_contract_no" id="vendor_contract_no" value="<?=$vendor_edit['vendor_contract_no']?>"   / >
												</div>
											</div>
											<div class="form-group">
												<label>Contract Vaild From</label>
												<input class="form-control" type="text"  name="vendor_contract_vaild_from" id="vendor_contract_vaild_from" value="<?=dateGeneralFormat($vendor_edit['vendor_contract_vaild_from']);?>"   />
											</div>
											<div class="form-group">
												<label>Contract Expire Date</label>
												<input class="form-control" type="text"  name="vendor_contract_expire_date" id="vendor_contract_expire_date" value="<?=dateGeneralFormat($vendor_edit['vendor_contract_expire_date']);?>" / >
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Status</label>
												<div id="cityDiv">
												<select class="form-control select2" name="vendor_active_status" id="vendor_active_status">
												  
												   <?php foreach($status AS $status_value => $status_list){?>
												  <option value="<?=$status_value ?>"<?php if($status_value ==$vendor_edit['vendor_active_status'] ){ echo 'selected="selected"';} ?> ><?=ucwords($status_list);?></option>
												  <?php }?>
												</select>
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
							  Contact Details
							</div>
							<div class="panel-body">
								<div class="col-lg-6">
									<button  type="button" onClick="addRow()"class="glyphicon glyphicon-plus"></button>
								</div>
								<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="multi-contact">
                                    <thead>
                                        <tr>
                                            <th>Contact Person</th>
                                            <th>Designation</th>
                                            <th>Contact No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											foreach($vendor_con_edit as $get_vendor_con){
										?>
										<tr  class="odd gradeX">
										
										<td width="33%">
										<input name="vendor_detail_id[]" type="hidden" value="<?= $get_vendor_con['vendor_detail_id']; ?>"  id="vendor_detail_id[]" class="form-control"  /> 
										<input name="vendor_detail_contact_person[]" type="text" value="<?= $get_vendor_con['vendor_detail_contact_person']; ?>"   id="vendor_detail_contact_person[]" class="form-control"  /> 
										</td>
										<td width="33%">
										<input name="vendor_detail_designation[]" type="text" value="<?= $get_vendor_con['vendor_detail_designation']; ?>" class="form-control" id="vendor_detail_designation[]"  />
										</td>
										<td width="34%">
										<input name="vendor_detail_contact_no[]" type="number" value="<?= $get_vendor_con['vendor_detail_contact_no']; ?>" class="form-control" id="vendor_detail_contact_no[]"  />
										</td>
										
									  </tr>
										<?php
											}
										?>
										<tr  class="odd gradeX">
										<td width="33%">
										 
										<input name="vendor_detail_contact_person[]" type="text" value=""   id="vendor_detail_contact_person[]" class="form-control"  /> 
										</td>
										<td width="33%">
										<input name="vendor_detail_designation[]" type="text" value="" class="form-control" id="vendor_detail_designation[]"  />
										</td>
										<td width="34%">
										<input name="vendor_detail_contact_no[]" type="number" value="" class="form-control" id="vendor_detail_contact_no[]"  />
										</td>
									  </tr>
									</tbody>
								</table>
								</div>
								<div class="col-lg-6">
											<input type="hidden" name="vendor_id" id="vendor_id" value="<?=$vendor_edit['vendor_id']?>" />
											<input type="hidden" name="vendor_uniq_id" id="vendor_uniq_id" value="<?=$vendor_edit['vendor_uniq_id']?>" />
									<button name="vendor_update" type="submit" class="btn btn-primary">Save</button>
									<button type="reset" class="btn btn-danger">Reset Button</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				</form>
				<?php
				} else{ ?>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Data Table
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>Code</th>
                                            <th>Name</th>
                                            <th>Contact No</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($vendor_lists as $get_vendor){//print_r($get_vendor);exit;
									?>
                                        <tr class="odd gradeX">
                                            <td><?=$s_no++?></td>
                                            <td><?=$get_vendor['vendor_code']?></td>
                                            <td><?=ucfirst($get_vendor['vendor_name']);?></td>
                                            <td><?=$get_vendor['vendor_contact_no'];?></td>
											<td> <?= ucfirst($get_vendor['vendor_address']);?></td>
                                            <td class="center">
												<a href="index.php?page=edit&id=<?php echo $get_vendor['vendor_uniq_id']?>" title="" class="glyphicon glyphicon-pencil pull-left" 
												style="color:blue"></a>&nbsp;&nbsp;
      										</td>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
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
    <!-- /. WRAPPER  -->
    <div id="footer-sec">
        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
	     <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
	<script src="../plugins/select2/select2.full.min.js"></script>
	<script src="../plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap datepicker -->
	<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
			<script>
				$(document).ready(function () {
					$('#dataTables-example').DataTable( {
						responsive: true
					} );
					/*$('#dataTables-example').dataTable();*/
				});
				
		//Initialize Select2 Elements
		$(".select2").select2();
		$('#vendor_contract_vaild_from').datepicker({
			format: 'dd/mm/yyyy',
		})
		$('#vendor_contract_expire_date').datepicker({
			format: 'dd/mm/yyyy',
		})
		</script>

</body>
</html>
