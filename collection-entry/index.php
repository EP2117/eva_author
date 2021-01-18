<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'collection-entry-model.php';

		$branch_list		= getBranchList();
		$bank_arr			= bank();
		$customer_list		= getCustomerList();
		$currency_list		= getCurrencyList();

		if(isset($_POST['collection_entry_insert'])){

			insertPayment();

		}

		if(!isset($_REQUEST['page'])) {

			$so_return_list	= listSalesreturn();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$collection_entry_edit			= editQuotation();

			$collection_entry_prd_edit		= editPaymentDetail();

		}

		if(isset($_POST['collection_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['collection_entry_delete'])){

			deleteSuspensentry();

		}

	require_once 'collection-entry-view.php';

?>