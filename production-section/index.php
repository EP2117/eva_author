<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'production-section-model.php';
		if(isset($_POST['production_section_insert'])){
			insertProductcategory();
		}
		if(!isset($_REQUEST['page'])) {
			$production_section_list	= listProductcategory();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$production_section_edit	= editProductcategory();
		}
		if(isset($_POST['production_section_update'])){
			updateProductcategory();
		}
	require_once 'production-section-view.php';
?>