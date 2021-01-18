<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'production-delivery-model.php';

		$branch_list		= getBranchList();

		$customer_list		= getCustomerList();

		$godown_list		= getGodownList('3');
		$godown_Wlist		= getGodownList('1');
		$production_section_list	= getProductionSectionList();
		$department_list	= getDepartmentList();

		

		if(isset($_POST['prn_entry_insert'])){

			insertprn();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$prn_entry_edit			= editQuotation();

			$sales_detail_edit		= editSalesdetail();

			$prn_entry_prd_edit		= editQuotationProductDetail();
			$prn_entry_raw_prd_edit = editQuotationrawProductDetail();

		}

		if(isset($_POST['prn_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['prn_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'production-delivery-view.php';

?>