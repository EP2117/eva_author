<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'debit-note-model.php';		
		$branch_list    = getBranchList();
		$purdetailslist	= purchaseOrderdetails();

		$debit_type     = array("1"=>"Master","2"=>"Stock","3"=>"Account");
		if(isset($_POST['debit_nsrtUpdate'])){
			debitInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$debitList =listDebit();
		}
		if(isset($_REQUEST['id'])) {
			$editDebit  = debitEdit($_REQUEST['id']);	
			$editDebitProd  = debitEditProduct($_REQUEST['id']);
			$editReceiptProdChild  = editReceiptproductChild($_REQUEST['id']);			
		}	
		
		if(isset($_REQUEST['debit_delete'])){
		
		debitdelete();
		}	
	require_once 'debit-note-view.php';
?>