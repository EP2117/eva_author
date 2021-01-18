<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'advance-entry-model.php';

		$branch_list		= getBranchList();

		$customer_list		= getCustomerList();
		
		$arr_color			=getColourList();
		$brand_list			= getBrandList();
		if(isset($_POST['advance_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$advance_entry_edit		= editQuotation();
			$advance_entry_prd_edit	= editQuotationProductDetail();
		}

		if(isset($_POST['advance_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['advance_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'advance-entry-view.php';

?>