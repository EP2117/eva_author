<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'damage-entry-model.php';
		$branch_list		= getBranchList();
		$prd_sec_list		= getProductionSectionList();
		$godown_list		= getGodownList();
		$godown_Wlist		= getGodownList();
		$department_list	= getDepartmentList();
		if(isset($_POST['damage_entry_insert'])){
			insertQuotation();
		}
		if(!isset($_REQUEST['page'])) {
			$quotation_list	= listQuotation();
		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$damage_entry_edit			= editQuotation();
			$sales_detail_edit		= editSalesdetail();

			$damage_entry_prd_edit		= editQuotationProductDetail();

			

		}

		if(isset($_POST['damage_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['damage_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'damage-entry-view.php';

?>