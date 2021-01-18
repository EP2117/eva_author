<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'product-condition-model.php';
		if(isset($_POST['product_insert'])){
			product_insert();
		}
		if(!isset($_REQUEST['page'])) {
			$product_list	= product_list();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$editproduct	= editproduct();
		}
		if(isset($_POST['product_update'])){
	product_update();		}
	require_once 'product-condition-view.php';
?>