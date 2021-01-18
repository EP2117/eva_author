<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'production-delivery-model.php';

		$branch_list		= getBranchList();

		$customer_list		= getCustomerList();

		$godown_list		= getGodownList('3');

		$department_list	= getDepartmentList();

		

		if(isset($_POST['pdo_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$pdo_entry_edit			= editQuotation();

			$sales_detail_edit		= editSalesdetail();

			$pdo_entry_prd_edit		= editQuotationProductDetail();

		}

		if(isset($_POST['pdo_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['pdo_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'production-delivery-view.php';

?>