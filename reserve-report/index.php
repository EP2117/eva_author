<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'reverse-report-model.php';		
		$branch_list		= getBranchList();
		$godown_list		= getGodownList();
		$purdetailslist	= purchaseOrderdetails();
		if(isset($_POST['receipt_insrtUpdate'])){
			reciptInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$reqRecList =listreqRec();
		}
		if(isset($_REQUEST['id'])) {
			$editReceipt  = editReceiptdetails($_REQUEST['id']);	
			$editReceiptProd  = editReceiptproduct($_REQUEST['id']);			
		}		
	require_once 'reverse-report-view.php';
?>