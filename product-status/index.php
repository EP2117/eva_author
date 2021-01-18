<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'product-status-model.php';
		if(isset($_POST['product_status_insert'])){
			insertProductcategory();
		}
		if(!isset($_REQUEST['page'])) {
			$product_status_list	= listProductcategory();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$product_status_edit	= editProductcategory();
		}
		if(isset($_POST['product_status_update'])){
			updateProductcategory();
		}
	require_once 'product-status-view.php';
?>