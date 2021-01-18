<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'ledger-model.php';		
		$branch_list		= getBranchList();
		$head_ac =accountHeadList();	

		if(isset($_REQUEST['stockAvailable'])){
			$reportList =listReport();
		}
			
	require_once 'ledger-view.php';
?>