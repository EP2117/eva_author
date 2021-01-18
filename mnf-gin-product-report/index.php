<?php 
	
	
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	
	require_once 'mnf-gin-product-report-model.php'; 
	
	$branch_list		= getBranchList();
	$supplier_list		= getSupplierList();
	$salesMan_list		= getSalesmanList();
	$color_arr			= listColor();
	$brand_arr			= listBrand();
	$prduct_list		= listProduct();
	$state_list			= listState();
	$invoice_list		= quotationtypeone();
	
	require_once 'mnf-gin-product-report-view.php';



?>