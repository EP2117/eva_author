<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'leave-model.php';		
		$branch_list		= getBranchList();
	
			$leaveResult = listLeave();
	
		
	require_once 'leave-view.php';
?>