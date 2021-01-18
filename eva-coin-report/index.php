<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'coin-report-model.php';		
		$branch_list		= getBranchList();
		//$godown_list		= getGodownList();
		//$department_list	= getDepartment();
		//$inventoryReqlist	= inventoryRequest();
		//if(isset($_REQUEST['search'])){ //echo 'sfd';exit;
		
		$search_list  =  searchdata();
		//}
		
		
	require_once 'coin-report-view.php';
?>