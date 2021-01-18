<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'customer-model.php';

		$country_list		= getCountryList();

		$customer_type_list	= getCustomertypeList();

		$currency_list		= getCurrencyList();

		if(isset($_POST['customer_insert'])){

			insertCustomer();

		}

		if(!isset($_REQUEST['page'])) {

			$customer_list	= listCustomer();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$customer_edit		= editCustomer();

			$state_list			= getStateList($customer_edit['customer_country_id']);

			$city_list			= getCityList($customer_edit['customer_state_id']);

			$customer_con_edit	= editCustomerMultiContact();

		}

		if(isset($_POST['customer_update'])){

			updateCustomer();

		}

		if(isset($_REQUEST['multi_contact_delete'])){

			deleteCustomerMultiContact();

		}
		
		if(isset($_POST['customer_delete'])){//echo 'sdaf';exit;
		customer_delete();
		}

	require_once 'customer-view.php';

?>