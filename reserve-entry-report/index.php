<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'reserve-entry-report-model.php'; 
	
/*	$branch_list		= getBranchList();
	$supplier_list		= getSupplierList();
	$product_list		= getProduct();*/
	
	$godown_list		= getGodownList();
	$branch_list		= getBranchList();
	$brand_list			= getBrandList();
	$product_cat_list	= getProductcategory();
	$product_sta_list	= getProductstatus();
	$customer_list		= getCustomerList();
	$salesmode_list		= getSalesmodeList();
	$product_list		= getProduct();
	$brand_list			= getBrandList();	
	
	
	$reserve_list		= reserveReport();
	require_once 'reserve-entry-report-view.php';



?>