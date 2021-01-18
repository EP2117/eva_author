<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'vendor-model.php';
		$country_list		= getCountryList();
		$customer_type_list	= getCustomertypeList();
		$currency_list		= getCurrencyList();
		//$vendor_lists	= listvendor();
		if(isset($_POST['vendor_insert'])){
			insertvendor();
		}
		if(!isset($_REQUEST['page'])) {
			$vendor_lists	= listvendor();
			//print_r($vendor_lists);exit;
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$vendor_edit		= editvendor();
			$state_list			= getStateList($customer_edit['customer_country_id']);
			$city_list			= getCityList($customer_edit['customer_state_id']);
			$vendor_con_edit	= editvendorMultiContact();
		}
		if(isset($_POST['vendor_update'])){
			updatevendor();
		}
		if(isset($_REQUEST['multi_contact_delete'])){
			deleteCustomerMultiContact();
		}
	require_once 'vendor-view.php';
?>