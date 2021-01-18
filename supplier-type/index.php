<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'supplier-type-model.php';

		if(isset($_POST['supplier_type_insert'])){

			insertCustomertype();

		}

		if(!isset($_REQUEST['page'])) {

			$supplier_type_list	= listCustomertype();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$supplier_type_edit	= editCustomertype();

		}

		if(isset($_POST['supplier_type_update'])){

			updateCustomertype();

		}
		
		if(isset($_POST['supplier_type_delete'])){//echo 'sdaf';exit;
		asupplier_delete();
		}


	require_once 'supplier-type-view.php';

?>