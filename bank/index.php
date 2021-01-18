<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'bank-model.php';
		$country_list		= getCountryList();
		if(isset($_POST['bank_insert'])){
			insertCustomer();
		}
		if(!isset($_REQUEST['page'])) {
			$bank_list	= listCustomer();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$bank_edit		= editCustomer();
			$state_list		= getStateList($bank_edit['bank_country_id']);
			$city_list		= getCityList($bank_edit['bank_state_id']);
			$bank_con_edit	= editCustomerMultiContact();
		}
		if(isset($_POST['bank_update'])){
			updateCustomer();
		}
		if(isset($_REQUEST['multi_contact_delete'])){
			deleteCustomerMultiContact();
		}
		
		if(isset($_POST['bank_delete'])){
			deleteBank();
		}	

		
	require_once 'bank-view.php';
?>