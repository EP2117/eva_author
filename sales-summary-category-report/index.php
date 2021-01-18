<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'sales-summary-category-report-model.php'; 
	
	$branch_list		= getBranchList();
	$category			= listcat();
	
	$invoice_list		= quotationReport();
	$salesMan_list		= getSalesmanList();
	require_once 'sales-summary-category-report-view.php';



?>