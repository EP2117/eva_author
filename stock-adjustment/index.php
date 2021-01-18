<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'damage-entry-model.php';
		$branch_list		= getBranchList();
		$brand_list			= getBrandList();
		$prd_sec_list		= getProductionSectionList();
		$godown_list		= getGodownList();
		$godown_Wlist		= getGodownList();
		$department_list	= getDepartmentList();
		if(isset($_POST['stock_adjustment_insert'])){
			insertSuspens();
		}
		if(!isset($_REQUEST['page'])) {
			$so_return_list	= listSalesreturn();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$stock_adjustment_edit		= editQuotation();
			$stock_adjustment_prd_edit	= editQuotationProductDetail();
		}
		if(isset($_POST['stock_adjustment_update'])){
			updateQuotation();
		}
		if(isset($_REQUEST['product_detail_delete'])){
			deleteProductdetail();
		}
		if(isset($_REQUEST['stock_adjustment_delete'])){
			deleteSuspensentry();
		}

	require_once 'damage-entry-view.php';

?>