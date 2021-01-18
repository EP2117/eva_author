<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'product-stock-report-model.php'; 
	
	$branch_list		= getBranchList();
	$godown_list		= getGodownList();
	$invoice_list		= quotationReport();
	require_once 'product-stock-report-view.php';



?>