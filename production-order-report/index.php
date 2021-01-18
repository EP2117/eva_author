<?php 
	
	
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	
	require_once 'po-product-report-model.php'; 
	
	$branch_list		= getBranchList();
	$customer_list		= getCustomerList();
	
	
	$prduct_list		= listProduct();
	$state_list			= listState();
	
	$invoice_list		= quotationtypeone();
	
	require_once 'po-product-report-view.php';



?>