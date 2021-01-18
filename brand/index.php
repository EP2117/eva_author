<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'brand-model.php';
		if(isset($_POST['brand_insert'])){
			insertBrand();
		}
		if(!isset($_REQUEST['page'])) {
			$brand_list	= listBrand();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$brand_edit	= editBrand();
		}
		if(isset($_POST['brand_update'])){
			updateBrand();
		}
	require_once 'brand-view.php';
?>