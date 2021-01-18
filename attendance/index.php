<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'attendance-model.php';		
		$branch_list	= getBranchList();
		if(isset($_POST['atnc_addedit'])){
			insertUpdateAttendance();
		}
		if(!isset($_REQUEST['page'])) {
			$atnceResult = listAttendance();
		}
		if(isset($_REQUEST['id'])) {
			$Atnc_edit   = editAttendance($_REQUEST['id']);	
		}	
		if(isset($_REQUEST['emp_delete'])){
		attdelete();
		
		}	
	require_once 'attendance-view.php';
?>