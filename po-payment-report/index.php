<?php 
	
	
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	
	require_once 'po-payment-report-model.php'; 
	
	$branch_list		= getBranchList();
	$supplier_list		= getSupplierList();
	
	$salesMan_list		= getSalesmanList();
	$color_arr			= listColor();
	$brand_arr			= listBrand();
	$prduct_list		= listProduct();
	$state_list			= listState();
	
	$invoice_list		= quotationtypeone();
	
	require_once 'po-payment-report-view.php';



?>