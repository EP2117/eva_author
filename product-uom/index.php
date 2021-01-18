<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'product-uom-model.php';
		if(isset($_POST['product_uom_insert'])){
			insertProductuom();
		}
		if(!isset($_REQUEST['page'])) {
			$product_uom_list	= listProductuom();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$product_uom_edit	= editProductuom();
		}
		if(isset($_POST['product_uom_update'])){
			updateProductuom();
		}
	require_once 'product-uom-view.php';
?>