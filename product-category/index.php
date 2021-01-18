<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'product-category-model.php';
		if(isset($_POST['product_category_insert'])){
			insertProductcategory();
		}
		if(!isset($_REQUEST['page'])) {
			$product_category_list	= listProductcategory();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$product_category_edit	= editProductcategory();
		}
		if(isset($_POST['product_category_update'])){
			updateProductcategory();
		}
	require_once 'product-category-view.php';
?>