<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'product-colour-model.php';
		if(isset($_POST['product_colour_insert'])){
			insertProductuom();
		}
		if(!isset($_REQUEST['page'])) {
			$product_colour_list	= listProductuom();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$product_colour_edit	= editProductuom();
		}
		if(isset($_POST['product_colour_update'])){
			updateProductuom();
		}
	require_once 'product-colour-view.php';
?>