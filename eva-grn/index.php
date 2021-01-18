<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'eva-grn-model.php';		
		$branch_list		= getBranchList();
		$godown_list		= getGodownList();
		$purdetailslist	= purchaseOrderdetails();
		$supplier_list		= get_supplier();
		if(isset($_POST['receipt_insrtUpdate'])){
			reciptInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$reqRecList =listreqRec();
		}
		if(isset($_REQUEST['id'])) {
			$editReceipt  = editReceiptdetails($_REQUEST['id']);	
			$editReceiptProd  = editReceiptproduct($_REQUEST['id']);
			$editReceiptProdChild  = editReceiptproductChild($_REQUEST['id']);			
		}	
		if(isset($_REQUEST['grn_delete'])){
		delete_grn();
		
		}	
		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}
	require_once 'eva-grn-view.php';
?>