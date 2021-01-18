<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice Entry</title>
<?php 
	include "../includes/common/header.php";
	if(isset($_GET['msg'])) {
		if($_GET['msg']==1) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Report added successfully</div>';
		} else if($_GET['msg']==2) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Report updated successfully</div>';
		} else if($_GET['msg']==3) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Report deleted successfully</div>';
		} else if($_GET['msg']==4) {
			$msg = 'Product Code already added';
		}else if($_GET['msg']==5) {
			$msg = 'Please fill all required fields';
		}else if($_GET['msg']==6) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Report Product Detail deleted successfully</div>';
		}else if($_GET['msg']==7) {
			$msg = '<div style="color:#66FF00;text-align:center;font-size:16px;">Stock Report   deleted successfully</div>';
		} 
	}

?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/invoice-entry/invoice-entry-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/report-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Stock Report</h1>
                        <h1 class="page-subhead-line">
							<?php
								if(isset($_GET['msg'])) {
									echo $msg;
								}
							?>
						</h1>
                    </div>
                </div>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Stock Report
                        </div>
                        <div class="panel-body">
							<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
								<div class="col-lg-6">
									<div class="form-group">
										<label>Branch</label>
										<select name="search_branch_id" id="search_branch_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php
												foreach($branch_list	as	$get_branch){
											?>
													<option value="<?=$get_branch['branch_id']?>" <?php if(searchValue('search_branch_id')==$get_branch['branch_id']) { ?> selected="selected" <?php } ?>><?=$get_branch['branch_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>From Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_from_date" id="search_from_date"  value="<?=searchValue('search_from_date')?>">
										</div>
									</div>
									<div class="form-group">
										<label>Warehouse </label>
										<select name="search_godown_id" id="search_godown_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php
												foreach($godown_list	as	$get_godown){
											?>
													<option value="<?=$get_godown['godown_id']?>" <?php if(searchValue('search_godown_id')==$get_godown['godown_id']) { ?> selected="selected" <?php } ?>><?=$get_godown['godown_name']?></option>
											<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Product Name</label>
										<input type="text" name="search_product_name" id="search_product_name"  class="form-control"  value="<?=searchValue('search_product_name')?>"/>
									</div>
									<div class="form-group">
										<label>To Date</label>
										 <div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" name="search_to_date" id="search_to_date" value="<?=searchValue('search_to_date')?>"/>
										</div>
									</div>
									
								</div>
								<div class="col-lg-12">
									<button name="search_report" type="submit" class="btn btn-primary">Submit Button</button>
									<button type="reset" class="btn btn-danger">Reset Button</button>
								</div>
							</form>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            	</div>
				<?php if(isset($invoice_list)){ ?>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Invoice Report Detail
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
								<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
											<th>Product Code</th>
                                            <th>Name</th>
                                            <th>Opening Qty</th>
                                            <th>In Qty</th>
                                            <th>Out Qty</th>
                                            <th>Closing Qty</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($invoice_list	as $get_value){
										$open_qty		= stock_opening(searchValue('search_from_date'),$get_value['product_id'],$get_value['stock_ledger_prd_type']);
										$sal_qty 		= ($get_value['sal_qty']);
										$closng			= ($open_qty+$get_value['pur_qty'])- $sal_qty;
									?>
										 <tr  class="odd gradeX">
										  <td><?php echo $s_no++;?></td>
										  <td><?php echo $get_value['product_code'];?></td>
										  <td><?php echo $get_value['product_name'];?></td>
										  <td><?php echo number_format($open_qty,'2','.','');?></td>
										  <td><?php echo number_format($get_value['pur_qty'],'2','.','');?></td>
										  <td><?php echo number_format($sal_qty,'2','.','');?></td>
										  <td style="text-align:right"><?php echo number_format($closng,2,'.','');?></td>
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
                <!-- /. ROW  -->
				<?php } ?>
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
	
	<script src="assets/js/bootstrap-switch.js"></script>
	     <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
	
	<script src="../plugins/select2/select2.full.min.js"></script>
	<!-- iCheck 1.0.1 -->
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
			//$('.datatable').DataTable()
	//Date picker
   /* $('#invoice_entry_date').datepicker({
      autoclose: true
    });*/
	$('#search_from_date').datepicker({
    	format: 'dd/mm/yyyy'
	})
	$('#search_to_date').datepicker({
    	format: 'dd/mm/yyyy'
	})
			
		</script>

</body>
</html>
