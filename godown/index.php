<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'godown-model.php';
		$country_list		= getCountryList();
		if(isset($_POST['godown_insert'])){
			insertCustomer();
		}
		if(!isset($_REQUEST['page'])) {
			$godown_list	= listCustomer();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$godown_edit		= editCustomer();
			$state_list			= getStateList($godown_edit['godown_country_id']);
			$city_list			= getCityList($godown_edit['godown_state_id']);
			$godown_con_edit	= editCustomerMultiContact();
		}
		if(isset($_POST['godown_update'])){
			updateCustomer();
		}
		if(isset($_REQUEST['multi_contact_delete'])){
			deleteCustomerMultiContact();
		}
	require_once 'godown-view.php';
?>