<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'product-weight-calc-model.php';
		$product_list	= productDetails();
		if(isset($_POST['pwc_insert'])){
			insertProductcategory();
		}
		if(!isset($_REQUEST['page'])) {
			$pwc_list	= listProductcategory();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$pwc_edit	= editProductcategory();
		}
		if(isset($_POST['pwc_update'])){
			updateProductcategory();
		}
	require_once 'product-weight-calc-view.php';

?>