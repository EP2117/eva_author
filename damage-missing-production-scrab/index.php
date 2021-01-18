<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'dmg-miss-scrp-model.php';		
		$branch_list		= getBranchList();
		$brand_list         = getBrandList();
		$godown_list		= getGodownList();
		$color_list         = getColourList();

		$product_status_arry=array("1"=>"Raw",'2'=>"Semi",'3'=>"Finished",'4'=>"Accessories",'4'=>"Other");
		$poentry_type_arry=array("1"=>"Damage",'2'=>"Raw Materials",'3'=>"Manufacturing Scrp");
		$type_arry=array("1"=>"Mother",'2'=>"Child",'3'=>"Sub Child");
		
		$proorderlist	= production_orderdetails();
		
		if(isset($_POST['dms_insrtUpdate'])){
			dmsInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$dmsList =dmslist();
		}
		if(isset($_REQUEST['id'])) {
			$editdms  = editdmsdetails($_REQUEST['id']);	
			$editdmsProd  = editdmsproduct($_REQUEST['id'],$_REQUEST['ds_date']);			
		}	
		if(isset($_REQUEST['dms_delete'])){
			deteteDMS();
		}
		
		if(isset($_REQUEST['product_detail_delete'])){
			deleteProductdetail();
		}		
	require_once 'dmg-miss-scrp-view.php';
?>