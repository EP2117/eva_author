<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'stock-transfer-model.php';
		$branch_list		= getBranchList();
		$prd_sec_list		= getProductionSectionList();
		$godown_list		= getGodownList();
		$godown_Wlist		= getGodownList();
		$department_list	= getDepartmentList();
		if(isset($_POST['stock_transfer_insert'])){
			insertQuotation();
		}
		if(!isset($_REQUEST['page'])) {
			$quotation_list	= listQuotation();
		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$stock_transfer_edit			= editQuotation();
			$sales_detail_edit		= editSalesdetail();

			$stock_transfer_prd_edit		= editQuotationProductDetail();



		}

		if(isset($_POST['stock_transfer_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['stock_transfer_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'stock-transfer-view.php';

?>