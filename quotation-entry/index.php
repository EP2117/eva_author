<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'quotation-entry-model.php';

		$branch_list		= getBranchList();

		$customer_list		= getCustomerList();
		//$quotation_entry_no	= GetAutoNo();
		$arr_color			= getColourList();
		$product_list		= getProduct();
		$brand_list			= getBrandList();
		if(isset($_POST['quotation_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$quotation_entry_edit		= editQuotation();
			$quotation_entry_prd_edit	= editQuotationProductDetail();
		}

		if(isset($_POST['quotation_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}

		if(isset($_REQUEST['quotation_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'quotation-entry-view.php';

?>