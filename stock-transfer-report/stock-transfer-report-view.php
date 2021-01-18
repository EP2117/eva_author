<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stock Transfer Entry Report</title>
<?php 
	include "../includes/common/header.php";

?>
<script type="text/javascript" src="<?php echo PROJECT_PATH.'/stock-transfer-report/stock-transfer-report-javascript.js'; ?>"></script>
</head>
<body>
    <div id="wrapper">
		<?php include "../includes/common/inventory-left-menu.php"; ?> 
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Stock Transfer Report</h1>
                        <h1 class="page-subhead-line">

						</h1>
                    </div>
                </div>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Stock Transfer Report
                        </div>
                        <div class="panel-body">
							<form action="index.php" method="post" id="stock_transfer_list_form" name="stock_transfer_list_form" >
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
										<label>From Warehouse</label>
										<select name="stock_transfer_from_godown_id" id="stock_transfer_from_godown_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php
												foreach($godown_list	as	$get_godown){
											?>
													<option value="<?=$get_godown['godown_id']?>" <?php if(searchValue('stock_transfer_from_godown_id')==$get_godown['godown_id']) { ?> selected="selected" <?php } ?>><?=$get_godown['godown_name']?></option>
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
										  <input type="text" class="form-control pull-right" name="search_date" id="search_date" value="<?=searchValue('search_to_date')?>"/>
										</div>
									</div>								
									<div class="form-group">
										<label>From Warehouse</label>
										<select name="stock_transfer_to_godown_id" id="stock_transfer_to_godown_id" class="form-control select2" style="width:100%">
											  <option value=""> - Select - </option>
											<?php
												foreach($godown_list	as	$get_godown){
											?>
													<option value="<?=$get_godown['godown_id']?>" <?php if(searchValue('stock_transfer_to_godown_id')==$get_godown['godown_id']) { ?> selected="selected" <?php } ?>><?=$get_godown['godown_name']?></option>
											<?php
												}
											?>
										</select>
									</div>									
								</div>
								<div class="col-lg-12">
									<button name="search_report" type="submit" class="btn btn-primary">Search</button>
									<button type="reset" class="btn btn-danger">Reset</button>
								</div>
							</form>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            	</div>
				<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Reserve Report Detail
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
								<form action="index.php" method="post" id="invoice_list_form" name="invoice_list_form" >
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
<!--											<th>StockTrans#</th> -->
                                            <th>Date</th>
                                            <th>Prod Code</th>											
                                            <th>Prod Name</th>	
<!--                                            <th>Customer Code</th>											
                                            <th>Customer Name</th>	 -->
                                            <th>Uom </th>
                                            <th>Qty </th>
                                           	<th>From Warehouse</th>
                                           	<th>To Warehouse</th>                                        
										</tr>
                                    </thead>
                                    <tbody>
									<?php
										$s_no	= 1;
										foreach($reserve_list	as $get_value){
									?>
										 <tr  class="odd gradeX">
										  <td><?php echo $s_no++;?></td>
<!--										  <td><?php echo $get_value['stock_transfer_no'];?></td> -->
										  <td><?php echo dateGeneralFormat($get_value['stock_transfer_date']);?></td>
										  <td><?php echo $get_value['product_code'];?></td>
										  <td><?php echo $get_value['product_name'];?></td>	
<!--									  <td><?php echo $get_value['customer_code'].'-'.$get_value['customer_name'];?></td> -->
										  <td><?php echo $get_value['UOM1'];?></td>
										  <td><?php echo $get_value['stock_transfer_product_detail_qty'];?></td>	
										  <td><?php echo $get_value['fromWarehouse'];?></td>
										  <td><?php echo $get_value['toWarehouse'];?></td>
										  
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

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
	
	
    <!-- /. WRAPPER  -->
    <div id="footer-sec">
        <?=PROJECT_FOOTER?>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->

	<script>
		$('#dataTables_stock_transfer').DataTable( {
			responsive: true
		} );
	
		$('#search_date').datepicker({	
			dateFormat:'dd-mm-yy',
			changeMonth: true,
			changeYear: true,	
		});		

	
		</script>		

</body>
</html>
