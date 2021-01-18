<?php 
	
	
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	
	require_once 'inv-deliver-custoer-reprot-model.php'; 
	
	$branch_list		= getBranchList();
	$customer_list		= getCustomerList();
	
	$salesMan_list		= getSalesmanList();
	$color_arr			= listColor();
	$brand_arr			= listBrand();
	$prduct_list		= listProduct();
	$state_list			= listState();
	
	$invoice_list		= quotationtypeone();
	
	require_once 'inv-deliver-custoer-reprot-view.php';



?>