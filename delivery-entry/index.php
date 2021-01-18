<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'delivery-entry-model.php';

		$branch_list		= getBranchList();

		$customer_list		= getCustomerList();

		$salesman_list		= getSalesmanList();
		//$delivery_entry_no		= GetAutoNo();
		$godown_list		= getGodownList("2");

		if(isset($_POST['delivery_entry_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$delivery_entry_edit		= editQuotation();

			$delivery_entry_prd_edit	= editQuotationProductDetail();

		}

		if(isset($_POST['delivery_entry_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}
		
		

		if(isset($_REQUEST['delivery_entry_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'delivery-entry-view.php';

?>