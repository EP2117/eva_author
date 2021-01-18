<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'cash-model.php';		
		$branch_list		= getBranchList();
		$head_ac =accountHeadList();	

			
	require_once 'cash-view.php';
?>