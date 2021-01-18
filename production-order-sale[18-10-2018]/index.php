<?php

	require('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'production-order-model.php';

		$branch_list			= getBranchList();

		$prd_sec_list			= getProductionSectionList();

		$customer_list			= getCustomerList();
		$production_order_no	= GetAutoNo();
		$department_list		= getDepartmentList();

		if(isset($_POST['production_order_insert'])){
			insertQuotation();
		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$production_order_edit		= editQuotation();

			$sales_detail_edit			= editSalesdetail();

			$production_order_prd_edit	= editQuotationProductDetail();

		}

		if(isset($_POST['production_order_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['production_order_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'production-order-view.php';

?>