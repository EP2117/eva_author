<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'delivery-customer-model.php';

		$branch_list		= getBranchList();

		$customer_list		= getCustomerList();

		$salesman_list		= getSalesmanList();
		$delivery_customer_no		= GetAutoNo();
		$godown_list		= getGodownList();

		if(isset($_POST['delivery_customer_insert'])){

			insertQuotation();

		}

		if(!isset($_REQUEST['page'])) {

			$quotation_list	= listQuotation();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$delivery_customer_edit		= editQuotation();

			$delivery_customer_prd_edit	= editQuotationProductDetail();

		}

		if(isset($_POST['delivery_customer_update'])){

			updateQuotation();

		}

		if(isset($_REQUEST['product_detail_delete'])){

			deleteProductdetail();

		}
		
		

		if(isset($_REQUEST['delivery_customer_entry_delete'])){

			deleteInventoryrequest();

		}

	require_once 'delivery-customer-view.php';

?>