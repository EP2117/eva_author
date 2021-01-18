<?php 
	
	
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
		
	require_once 'inv-write-off-entry-reprot-model.php'; 
	
	$branch_list		= getBranchList();
	$customer_list		= getCustomerList();
	
	$salesMan_list		= getSalesmanList();
	$color_arr			= listColor();
	$brand_arr			= listBrand();
	$prduct_list		= listProduct();
	$state_list			= listState();
	$warehouse_list			= listwarehouse(); 
	
	$invoice_list		= quotationtypeone();
	$writeof_type_arry=array("1"=>"Missing Product",'2'=>"Demage Product",'3'=>"Script Product",'4'=>"Other");
	
	require_once 'inv-write-off-entry-reprot-view.php';



?>