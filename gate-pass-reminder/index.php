<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'delivery-customer-model.php';

		$branch_list		= getBranchList();

		$customer_list		= getCustomerList();

		$salesman_list		= getSalesmanList();
		//$delivery_customer_no		= GetAutoNo();
		$godown_list		= getGodownList();


			$quotation_list	= listQuotation();



	require_once 'delivery-customer-view.php';

?>