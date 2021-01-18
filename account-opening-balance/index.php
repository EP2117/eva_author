<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'openingbalance-model.php';		
		$branch_list		= getBranchList();
		if(isset($_POST['account_list'])){
			$resultArray = accountDetailsList();
		}
		//print_r($_POST['opening_balinsertUpdate']);exit;
		if(isset($_POST['opening_balinsertUpdate'])){
			 accountInsertUpdate();
		}
	
	require_once 'openingbalance-view.php';
?>