<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'goods-issue-notes-model.php';

		$branch_list		= getBranchList();

		$prd_sec_list		= getProductionSectionList();

		$godown_list		= getGodownList();
		$godown_Wlist		= getGodownList();
		$department_list	= getDepartmentList();

		

		if(isset($_POST['gin_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$gin_entry_edit			= editQuotation();

			$sales_detail_edit		= editSalesdetail();

			$gin_entry_prd_edit		= editQuotationProductDetail();

			$gin_entry_raw_prd_edit	= editQuotationRawProductDetail();

		}

		if(isset($_POST['gin_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['gin_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'goods-issue-notes-view.php';

?>