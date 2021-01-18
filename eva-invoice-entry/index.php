<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'invoiceentry-model.php';		
		$branch_list		= getBranchList();
		$purdetailslist		= purchaseOrderdetails();
		$supplier_list		= get_supplier();

		$colour_list	= getColourList();
		$uom_list		= getProductuomList();
		
		
		if(isset($_POST['invoice_insrtUpdate'])){
			invoiceInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$invoiceList =listinvoice();
		}
		if(isset($_REQUEST['id'])) {
			$editInvoice  		= editInvoicedetail($_REQUEST['id']);	
			$editInvoiceProd  	= editInvoiceProduct($_REQUEST['id']);
			$edit_child_prod  	= editChildProductDetail($_REQUEST['id']);			
		}
		if(isset($_REQUEST['invoice_delete'])){
			invoicedelete();
		}	
		if(isset($_REQUEST['product_detail_delete'])){
			deleteProductdetail();
		}	
	require_once 'invoiceentry-view.php';
?>