<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'gatepass-entry-model.php';

		$branch_list		= getBranchList();
		$customer_list		= getCustomerList();
		$salesman_list		= getSalesmanList();
		$gatepass_entry_no	= GetAutoNo();
		$godown_list		= getGodownList();
		if(isset($_POST['gatepass_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$gatepass_entry_edit		= editQuotation();

			$gatepass_entry_prd_edit	= editQuotationProductDetail();

		}

		if(isset($_POST['gatepass_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}
		
		

		if(isset($_REQUEST['gatepass_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'gatepass-entry-view.php';

?>