<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'goods-receipt-notes-model.php';

		$branch_list		= getBranchList();

		$prd_sec_list		= getProductionSectionList();

		$godown_list		= getGodownList("1");
		$godown_Wlist		= getGodownList("3");
		$department_list	= getDepartmentList();

		

		if(isset($_POST['grn_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$grn_entry_edit			= editQuotation();

			$sales_detail_edit		= editSalesdetail();

			$grn_entry_prd_edit		= editQuotationProductDetail();

			$grn_entry_raw_prd_edit	= editQuotationRawProductDetail();

		}

		if(isset($_POST['grn_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['grn_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'goods-receipt-notes-view.php';

?>