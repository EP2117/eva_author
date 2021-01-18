<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'sales-warehouse-model.php';
		$data_list	= listData();
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
			$data_edit		= editData($_REQUEST['id']);
		}
		if(isset($_POST['save_data'])){
			if(isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
				updateData();
			}
			else {
				insertData();
			}
		}
		if(isset($_POST['delete_data'])){//echo 'sdaf';exit;
			deleteData();
		}
		/* if(!isset($_REQUEST['page'])) {
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
		} */
	require_once 'sales-warehouse-view.php';
?>