<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'costing-model.php';		
		$branch_list		= getBranchList();
		$invoice_list       = invoiceList();
		$currency_list		= getCurrencyList();
		$costing_list		= getPurCostingList();
		if(isset($_POST['costing_insrtUpdate'])){
			costingInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$costingList =listCosting();
		}
		if(isset($_REQUEST['id'])) {
			$editCost  = editCosting($_REQUEST['id']);	
			$editCostdetls  = editRequestproduct($_REQUEST['id']);			
		}
		
		if(isset($_REQUEST['costing_delete'])){
		
		costingdelete();
		}		
	require_once 'costing-view.php';
?>