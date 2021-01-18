<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once'overtime-model.php';
		$branch_list		= getBranchList();
		if(isset($_POST['ot_insert_update'])){
			insertUpdateOvertime();
		}
		if(!isset($_REQUEST['page'])) {
			$otList = listOvertime();
		}
		if(isset($_REQUEST['id'])) {
			$ot_edit = editOvertime($_REQUEST['id']);		
		}
		
		if(isset($_REQUEST['overtime_delete'])){
		overtimedelete();
		}		
	require_once 'overtime-view.php';

?>