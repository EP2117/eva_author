<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'ledger-model.php';		
		$branch_list		= getBranchList();
		$head_ac 			=accountHeadList();	
		$head_id			= (isset($_REQUEST['account_head']))?$_REQUEST['account_head']:'';
		$sub_head_ac 		=accounSubtHeadList($head_id);	
	require_once 'ledger-view.php';
?>