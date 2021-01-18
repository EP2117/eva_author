<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'delivery-entry-model.php';

		$branch_list		= getBranchList();

		$customer_list		= getCustomerList();

		$salesman_list		= getSalesmanList();
		//$delivery_entry_no		= GetAutoNo();
		$product_catageory  = getProductcategory();
		$godown_list		= getGodownList("2");

	
			$quotation_list	= listQuotation();

	
		
	require_once 'delivery-entry-view.php';

?>