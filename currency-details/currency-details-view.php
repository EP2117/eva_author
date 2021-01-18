<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>BRAND</title>

<?php 

	include "../includes/common/header.php";

	if(isset($_GET['msg'])) {

		if($_GET['msg']==1) {

			$msg = 'Currency added successfully';

		} else if($_GET['msg']==5) {

			$msg = 'Currency updated successfully';

		} else if($_GET['msg']==3) {

			$msg = 'Currency deleted successfully';

		} else if($_GET['msg']==4) {

			$msg = 'Currency Code already added';

		}else if($_GET['msg']==2) {

			$msg = 'Please fill all required fields';

		} 

	}



?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>



<script type="text/javascript" src="<?php echo PROJECT_PATH.'/currency/currency-javascript.js'; ?>"></script>

</head>

<body>

    <div id="wrapper">

		<?php include "../includes/common/left-menu.php"; ?> 

        <div id="page-wrapper">

            <div id="page-inner">

                <div class="row">

                    <div class="col-md-12">

                        <h1 class="page-head-line">Currency</h1>

                        <h1 class="page-subhead-line">

						

						</h1>

                    </div>

                </div>

				

				<div class="row">

                <div class="col-md-12">

                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                           Currency List

                        </div>
						<br/>
						<br/>
						 <div class="panel-body"> 
						 <form action="index.php" method="post" name="open_balance_form" id="open_balance_form" onSubmit="return v.exec();">
						 <table width="100%" style="text-align:center" border="0" cellpadding="" >
						 	<tr ><?php $currency_detail_date = (isset($_REQUEST['paymentdate']) && !empty($_REQUEST['paymentdate']))?$_REQUEST['paymentdate']:date('d/m/Y'); ?>
							<td style="width:25%">&nbsp;</td>
								<td style="width:25%">Date</td>
								<td style="width:25%"><input type="text" name="paymentdate" id="paymentdate" class="form-control paymentdate" value="<?php echo dateGeneralFormat($currency_detail_date);?>"></td>
								<td style="width:25%">&nbsp;</td>

							</tr>
							<br/>
							<tr >
							<td style="width:25%">&nbsp;</td>
								<td style="width:50%" colspan="2"><input type="submit" name="search" id="search" class="btn btn-success" value="GO"></td>
								<td style="width:25%"></td>
								<td style="width:25%">&nbsp;</td>

							</tr>
						 </table>
						 </form>
						 </div>
						 
						 <br/>
						 <br/>
                        <div class="panel-body">

                            <div class="table-responsive">
		<form id="product_uom_list_form" name="product_uom_list_form" method="post" action="index.php">
                                <table width="100%" id="mytable" class="table table-striped table-bordered table-hover">
          <thead>
            <?php if(isset($_GET['msg'])) { ?>
            <tr>
              <td colspan="5" align="center" class="msg"><?php  echo $msg; ?></td>
            </tr>
            <?php }
			if(isset($_REQUEST['search'])) {
			 ?>
            <tr>
              <th width="50%">Foreign Currency</th>
              <th width="50%">Local Currency</th>
            </tr>
          </thead>
          <tbody>
            <?php 	
				
      $s_no = 1; 
		   $frmstr	= date('Y-m-d');
		   $status	= (strtotime($frmstr)>strtotime(dateDatabaseFormat($currency_detail_date)))?'1':'0';

	  if($list_balance) {
	  
			$edit_status = 'readonly="readonly"';
			/*if( userAccessModule('0,205') || userAccessModule('0,206') )  {
				$edit_status = '';	
			}*/		  
 			?>
            <tr >
              <td colspan="4" align="right">
			  <input name="update_stock" id="update_stock" type="submit" class="button"  value="Update" />
			  <input name="currency_date" id="currency_date" type="hidden" class="button"  value="<?php echo dateDatabaseFormat($currency_detail_date); ?>" />
			  </td>
            </tr>	
			<?php } ?>  
	  <?php
	  foreach($list_balance as $get_value){
	 
		  
		   $currency_detail_amount = ($get_value['currency_detail_amount']!=0 && $get_value['currency_detail_amount']!='')?$get_value['currency_detail_amount']:'';
	   ?>

            <tr class="<?php echo $style; ?>">
              <td><?php echo $get_value['currency_name']; ?>
			  <input type="hidden" name="currency_id[]" id="currency_id"  value="<?php echo $get_value['currency_id']; ?>" />
			  <input type="hidden" name="currency_detail_id[]" id="currency_detail_id"  value="<?php echo $get_value['currency_detail_id']; ?>" />
			  </td>
              <td><input type="text" name="currency_amt[]" required id="currency_amt<?php echo $get_value['currency_id']; ?>" class="form-control" value="<?php echo $currency_detail_amount; ?>"   tabindex="1" style="width:100px;text-align:right" onKeyUp="updateStatus(<?php echo $get_value['currency_id']; ?>)" /></td>

            </tr>
            <?php } ?>
			<?php   } ?>
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

        &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>

    </div>

    <!-- /. FOOTER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

    <!-- JQUERY SCRIPTS -->

    
	<script>

		$(document).ready(function () {

			$('#dataTables-example').DataTable( {

				responsive: true

			} );

			/*$('#dataTables-example').dataTable();*/

		});

		$(document).ready(function() {

			$('#currency_form').bootstrapValidator({

				container: '#messages',

				feedbackIcons: {

					valid: 'glyphicon glyphicon-ok',

					invalid: 'glyphicon glyphicon-remove',

					validating: 'glyphicon glyphicon-refresh'

				},

				fields: {

					currency_name: {

						validators: {

							notEmpty: {

								message: 'The full name is required and cannot be empty'

							}

						}

					}

				}

			});

		});


	 $(function() {
		var from	= $('#pic_from').val();
		
		var from	= $('#pic_from').val();
		var to	= $('#pic_to').val();
		$( "#paymentdate" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:''});
		
			$( ".paymentdate" ).datepicker({dateFormat:'dd/mm/yy',minDate:from,maxDate:'', onClose: function( selectedDate ) { $( "#paymentdate" ).datepicker( "option", "minDate", selectedDate )}});
	$( "#production_planning_to_date" ).datepicker({dateFormat:'dd/mm/yy',minDate:from, maxDate:'', onClose: function( selectedDate ) { $( "#production_planning_from_date" ).datepicker( "option", "maxDate", selectedDate )}});
		
		
	  });
</script>
<input type="hidden" value="<?php echo $_SESSION[SESS.'_financial_year_form_date']; ?>" id="pic_from">


</body>

</html>

