<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'product-model.php';
		$brand_list				= getBrandList();
		$product_category_list	= getProductcategory();
		$product_uom_list		= getProductuomList();
		$branch_list			= getBranchList();
		$product_colour_list	= getColourList();
		$raw_product_list		= getProduct();
		if(isset($_POST['product_insert'])){
			insertproduct();
		}
		if(!isset($_REQUEST['page'])) {
			$product_list	= listproduct();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$product_edit			= editproduct();
			$product_detail_edit	= editProductDetail();
		}
		if(isset($_POST['product_update'])){
			updateproduct();
		}
		if(isset($_REQUEST['multi_contact_delete'])){
			deleteproductMultiContact();
		}
	require_once 'product-view.php';
?>