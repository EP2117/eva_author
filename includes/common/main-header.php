
	<script src="<?=PROJECT_PATH?>assets/js/autocomplete/jquery-1.10.2.js"></script>

    <!-- BOOTSTRAP STYLES-->

    <link href="<?=PROJECT_PATH?>assets/css/bootstrap.css" rel="stylesheet" />

    <!-- FONTAWESOME STYLES-->

    <link href="<?=PROJECT_PATH?>assets/css/font-awesome.css" rel="stylesheet" />

    <!--CUSTOM BASIC STYLES-->

    <link href="<?=PROJECT_PATH?>assets/css/basic.css" rel="stylesheet" />

    <!--CUSTOM MAIN STYLES-->

    <link href="<?=PROJECT_PATH?>assets/css/custom.css" rel="stylesheet" />

    <!-- GOOGLE FONTS-->

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

	<link href="assets/css/bootstrap-switch.css" rel="stylesheet" />

	 <!-- Select2 -->

  	<link rel="stylesheet" href="<?=PROJECT_PATH?>plugins/select2/select2.min.css">

	<link rel="stylesheet" href="<?=PROJECT_PATH?>plugins/datepicker3.css">


	<script src="<?=PROJECT_PATH?>assets/js/bootstrap.js"></script>
	<!-- METISMENU SCRIPTS -->
	<script src="<?=PROJECT_PATH?>assets/js/jquery.metisMenu.js"></script>
	<!-- CUSTOM SCRIPTS -->
	<script src="<?=PROJECT_PATH?>assets/js/custom.js"></script>
    <!-- GOOGLE FONTS-->

	<link href="<?=PROJECT_PATH?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="<?=PROJECT_PATH?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?=PROJECT_PATH?>assets/js/dataTables/dataTables.bootstrap.js"></script>

	<!-- daterange picker -->

   <link rel="stylesheet" href="<?=PROJECT_PATH?>plugins/daterangepicker/daterangepicker.css">

   <!-- bootstrap datepicker -->

   <link rel="stylesheet" href="<?=PROJECT_PATH?>plugins/datepicker/datepicker3.css">
   <script src="<?=PROJECT_PATH?>assets/js/jquery.ui.datepicker.js"></script>

  
    <!--timepicker -->
 	<link href="<?=PROJECT_PATH?>assets/css/jquery.timepicker.css" rel="stylesheet" />
   	<script src="<?=PROJECT_PATH?>assets/js/jquery.timepicker.js"></script>

    <!--validation -->
	<script src="<?=PROJECT_PATH?>assets/js/jquery-DOM.js"></script>
	<!--bootstrap validation -->
	<script src="<?=PROJECT_PATH?>assets/js/validate/jquery.validate.js"></script>
	   
   <!-- autocomplete -->
	<link rel="stylesheet" href="<?=PROJECT_PATH?>assets/css/autocomplete/jquery.ui.all.css">
	<script src="<?=PROJECT_PATH?>assets/js/autocomplete/jquery.ui.core.js"></script>
	<script src="<?=PROJECT_PATH?>assets/js/autocomplete/jquery.ui.widget.js"></script>
	<script src="<?=PROJECT_PATH?>assets/js/autocomplete/jquery.ui.position.js"></script>
	<script src="<?=PROJECT_PATH?>assets/js/autocomplete/jquery.ui.menu.js"></script>
	<script src="<?=PROJECT_PATH?>assets/js/autocomplete/jquery.ui.autocomplete.js"></script>
	<script src="<?=PROJECT_PATH?>plugins/select2/select2.full.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/fixedcolumns/3.2.3/js/dataTables.fixedColumns.min.js"></script>	
	<!-- dtaatable -->

	<!-- Added by AuthorsMM (for sidebar show hide event)-->
	<script type="text/javascript">
	$(document).ready(function () {	
		$('.sidebar-collapse').show();
		$(".sidebar-collapse").on('show.bs.collapse', function(e) {	
			$('.sidebar-collapse').show();
			if($(window).width() > 768) {				
				document.getElementById('page-wrapper').style.marginLeft = '260px';
			}
		});
		$(".sidebar-collapse").on('hide.bs.collapse', function(e) {
			chk_class = e.target.className;
			if(chk_class.includes("sidebar-collapse")) {
				$('.sidebar-collapse').hide();
				document.getElementById('page-wrapper').style.marginLeft = '0px';
			}
		});
		
		document.getElementById('page-wrapper').style.marginLeft = '260px';
	});
	</script>
	   
 <style>
 label.error {
    color: red;
    font-style: italic;
	font-size:12px;
}
</style>
	   