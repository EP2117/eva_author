<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'branch-model.php';
		
		$country_list		= getCountryList();
		if(isset($_POST['branch_insert'])){
			insertBranch();
		}
		if(!isset($_REQUEST['page'])) {
			$branch_list	= listBranch();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$branch_edit	= editBranch();
			$state_list		= getStateList($branch_edit['branch_country_id']);
			$city_list		= getCityList($branch_edit['branch_state_id']);
		}
		if(isset($_POST['branch_update'])){
			updateBranch();
		}
	require_once 'branch-view.php';
?>