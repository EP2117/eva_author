<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'production-machine-model.php';
		$prd_sec_list		= getProductionSectionList();
		if(isset($_POST['production_machine_insert'])){
			insertProductcategory();
		}
		if(!isset($_REQUEST['page'])) {
			$production_machine_list	= listProductcategory();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$production_machine_edit	= editProductcategory();
		}
		if(isset($_POST['production_machine_update'])){
			updateProductcategory();
		}
	require_once 'production-machine-view.php';
?>