<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'advance-model.php';		
		$branch_list	= getBranchList();
		if(isset($_POST['advanceinsert_upadet'])){
			insertUpdateadvance();
		}
		if(!isset($_REQUEST['page'])) {
			$salaryDeductList = listadvance();
		}
		if(isset($_REQUEST['id'])) {
			$salarydeduct_edit = editAdvance($_REQUEST['id']);		
		}
		if(isset($_REQUEST['advance_delete'])) {
			advancedelete();		
		}		
	require_once 'advance-view.php';
?>