<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'ac-setup-model.php';		
		$branch_list		= getBranchList();
		if(isset($_POST['ac_setup_insertupdate'])){
			insertUpdateACSetup();
		}
		if(!isset($_REQUEST['page'])) {
			$ACSetupResult = listACSetup();
		}
		if(isset($_REQUEST['id'])) {
			$ac_edit   = editACSetup($_REQUEST['id']);	
		}	
		if(isset($_REQUEST['expense_delete'])){
			detetesetup();
		}		
	require_once 'ac-setup-view.php';
?>