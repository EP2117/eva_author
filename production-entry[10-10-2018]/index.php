<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'production-entry-model.php';

		$branch_list		= getBranchList();

		$prd_sec_list		= getProductionSectionList();

		$godown_list		= getGodownList("3");

		$employee_list		= getEmployeeList();

		$vendor_list		= getVendorList();

		

		if(isset($_POST['production_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$production_entry_edit			= editQuotation();

			$sales_detail_edit		= editSalesdetail();

			$production_entry_prd_edit		= editQuotationProductDetail();

			$production_entry_raw_prd_edit	= editQuotationRawProductDetail();

			$production_entry_dam_prd_edit	= editQuotationDamProductDetail();

			$production_entry_work_edit	= editWorkDetail();

		}

		if(isset($_POST['production_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['production_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'production-entry-view.php';

?>