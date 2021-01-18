<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'opening-stock-model.php';
		$godown_list		= getGodownList();
		$branch_list		= getBranchList();
		$brand_list			= getBrandList();
		$product_cat_list	= getProductcategory();
		$product_sta_list	= getProductstatus();
		$customer_list		= getCustomerList();
		$salesmode_list		= getSalesmodeList();
		if(isset($_POST['opening_stock_insert'])){
			insertOpeningStock();
		}
		if(!isset($_REQUEST['page'])) {
			$opening_stock_list		= listOpeningStock();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$opening_stock_edit		= editOpeningStock();
			$opening_stock_prd_edit	= editOpeningStockProductDetail();
		}
		if(isset($_POST['opening_stock_update'])){
			updateOpeningStock();
		}
		if(isset($_REQUEST['opening_stock_delete'])){
			deleteOpeningStock();
		}		
		
		
	require_once 'opening-stock-view.php';
?>