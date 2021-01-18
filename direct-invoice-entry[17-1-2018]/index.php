<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'direct-invoice-entry-model.php';

		$branch_list		= getBranchList();

		$customer_list		= getCustomerList();
		$invoice_entry_no		= GetAutoNo();
		if(isset($_POST['invoice_entry_insert'])){

			insertInvoice();

		}

		if(!isset($_REQUEST['page'])) {

			$invoice_list	= listInvoice();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$invoice_entry_edit		= editInvoice();
			$invoice_entry_prd_edit	= editInvoiceProductDetail();
		}

		if(isset($_POST['invoice_entry_update'])){

			updateinvoice();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['quotation_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'direct-invoice-entry-view.php';

?>