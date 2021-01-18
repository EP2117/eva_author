<?php 
	
	
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	
	require_once 'inv-stock-transfer-reprot-model.php'; 
	
	$branch_list		= getBranchList();
	$customer_list		= getCustomerList();
	
	$salesMan_list		= getSalesmanList();
	$color_arr			= listColor();
	$brand_arr			= listBrand();
	$prduct_list		= listProduct();
	$state_list			= listState();
	$warehouse_list			= listwarehouse(); 
	
	$invoice_list		= quotationtypeone();
	
	require_once 'inv-stock-transfer-reprot-view.php';



?>