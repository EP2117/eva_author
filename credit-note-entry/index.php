<?php

	require('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'credit-note-entry-model.php';

		$branch_list			= getBranchList();

		$prd_sec_list			= getProductionSectionList();

		$customer_list			= getCustomerList();

		$department_list		= getDepartmentList();
		//$credit_note_entry_no	= GetAutoNo();
		$godown_list		= getGodownList();
		if(isset($_POST['credit_note_entry_insert'])){
			insertQuotation();
		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$credit_note_entry_edit		= editQuotation();

			$sales_detail_edit			= editSalesdetail();

			$credit_note_entry_prd_edit	= editQuotationProductDetail();

		}

		if(isset($_POST['credit_note_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['credit_note_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'credit-note-entry-view.php';

?>