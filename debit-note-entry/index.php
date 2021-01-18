<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	loginAuthentication();
	
	require_once 'debit-note-entry-model.php';		
		
		$branch_list		= getBranchList();
		$godown_list		= getGodownList();
		$purdetailslist	= purchaseOrderdetails();
		$supplier_list		= get_supplier();
		//print_r($_POST);exit;
		if(isset($_POST['dn_entry_id'])){
			reciptInsertUpdate();
		}

		if(!isset($_REQUEST['page'])) {
			$reqRecList =listreqRec();
		}

		if(isset($_REQUEST['id'])) { 
			$editResult  = editdebitdetails($_REQUEST['id']);
			$editdebitproduct  = editdebitproduct($_REQUEST['id']);
			$editdebitproductChild  = editdebitproductChild($_REQUEST['id']);	
			//print_r($editdebitproductChild);exit();

		}

		if(isset($_REQUEST['grn_delete'])){
			delete_grn();		
		}	

		if(isset($_REQUEST['product_detail_delete'])){
			deleteProductdetail();
		}

	require_once 'debit-note-entry-view.php';
?>