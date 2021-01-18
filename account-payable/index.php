<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'payable-model.php';		
		$branch_list		= getBranchList();
		if(isset($_POST['paybleInsertUpdate'])){
			insertUpdateAdvance();
		}
		if(!isset($_REQUEST['page'])) {
			$listResult = listAdvance();
		}
		if(isset($_REQUEST['id'])) {
			$editResult   = editAdvance($_REQUEST['id']);	
		}		
		if(isset($_REQUEST['expense_delete'])){
			deteteAdvance();
		}	
	require_once 'payable-view.php';
?>