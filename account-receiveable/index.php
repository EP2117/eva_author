<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'ac-receivable-model.php';		
		$branch_list		= getBranchList();
		$arr_pay_mode    	= array("1"=>"Cash", "2"=>" Bank");	
		$arr_paytype    	= array("1"=>"Other");	

		if(isset($_POST['acreceivable_insertupdate'])){
			insertUpdateReceivable();
		}
		if(!isset($_REQUEST['page'])) {
			$listResult = listReceivable();
		}
		if(isset($_REQUEST['id'])) {
			$editResult   = editReceivable($_REQUEST['id']);	
		}		
		if(isset($_REQUEST['expense_delete'])){
			deteteReceivable();
		}	
	require_once 'ac-receivable-view.php';
?>