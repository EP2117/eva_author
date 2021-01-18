<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'manufactcostmasterentry-model.php';		
		$group_list		= getGgroupList();
		if(isset($_POST['account_list'])){
			$resultArray = accountDetailsList();
		}
		if(isset($_POST['opening_balinsertUpdate'])){
			 accountInsertUpdate();
		}
	
	require_once 'manufactcostmasterentry-view.php';
?>