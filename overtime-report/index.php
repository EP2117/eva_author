<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once'overtime-model.php';
		$branch_list		= getBranchList();
		
		
			$otList = listOvertime();
			
	require_once 'overtime-view.php';

?>