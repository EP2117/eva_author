<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'invoice-entry-report-model.php'; 
	
	$branch_list		= getBranchList();
	$customer_list		= getCustomerList();
	$invoice_list		= quotationReport();
	$salesMan_list		= getSalesmanList();
	require_once 'invoice-entry-report-view.php';



?>