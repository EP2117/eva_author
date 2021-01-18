<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'stock-available-model.php';		
		$branch_list		= getBranchList();
		$godown_list		= getGodownList();
		$brand_list			= getBrandList();
		$prod_category   	= getProductcategory();
		$color_list         = getColourList();

		$prodStatus_arry    = array("1"=>"Raw",'2'=>"Semi",'3'=>"Finished",'4'=>"Accessories");
		$type_arry          = array("1"=>"Mother",'2'=>"Child",'3'=>"Sub Child");

		if(isset($_POST['stockAvailable'])){
			$stockList = stockDetailsList();
		}
	error_reporting(E_ERROR | E_PARSE);
	require_once 'stock-available-view.php';
?>