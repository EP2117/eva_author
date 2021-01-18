<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'account-manufacture-model.php';		
		$branch_list		= getBranchList();
		$head_ac 			=accountHeadList();	
		$head_id			= (isset($_REQUEST['account_head']))?$_REQUEST['account_head']:'';
		$sub_head_ac 		=accounSubtHeadList($head_id);	
		if(isset($_REQUEST['stockAvailable'])){	
			$list_transaction	= listTransaction();
		}
	require_once 'account-manufacture-view.php';
?>