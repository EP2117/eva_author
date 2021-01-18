<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'expense-pay-model.php';		
		$branch_list		= getBranchList();
		if(isset($_POST['expense_insertupdate'])){
			insertUpdateExpense();
		}
		if(!isset($_REQUEST['page'])) {
			$listResult = listExpense();
		}
		if(isset($_REQUEST['id'])) {
			$editResult   = editExpense($_REQUEST['id']);	
		}		
		if(isset($_REQUEST['expense_delete'])){
			deteteExpense();
		}	
	require_once 'expense-pay-view.php';
?>