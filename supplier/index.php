<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'supplier-model.php';

		$country_list		= getCountryList();

		$supplier_type_list	= getSuppliertypeList();

		$currency_list		= getCurrencyList();

		if(isset($_POST['supplier_insert'])){

			insertSupplier();

		}

		if(!isset($_REQUEST['page'])) {

			$supplier_list	= listSupplier();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$supplier_edit		= editSupplier();

			$state_list			= getStateList($supplier_edit['supplier_country_id']);

			$city_list			= getCityList($supplier_edit['supplier_state_id']);

			$supplier_con_edit	= editSupplierMultiContact();

		}

		if(isset($_POST['supplier_update'])){

			updateSupplier();

		}

		if(isset($_REQUEST['multi_contact_delete'])){

			deleteSupplierMultiContact();

		}
		if(isset($_POST['supplier_delete'])){//echo 'sdaf';exit;
		supplier_delete();
		}

	require_once 'supplier-view.php';

?>