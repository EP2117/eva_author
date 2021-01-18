<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'customer-type-model.php';

		if(isset($_POST['customer_type_insert'])){

			insertCustomertype();

		}

		if(!isset($_REQUEST['page'])) {

			$customer_type_list	= listCustomertype();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$customer_type_edit	= editCustomertype();

		}

		if(isset($_POST['customer_type_update'])){

			updateCustomertype();

		}
		
		if(isset($_POST['customer_type_delete'])){//echo 'sdaf';exit;
		customer_delete();
		}

	require_once 'customer-type-view.php';

?>