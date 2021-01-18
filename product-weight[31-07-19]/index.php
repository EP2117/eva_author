<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'productweight-model.php';		
		
		$brand_list				= getBrandList();
		if(isset($_POST['prodweight'])){
			productweight();
		}
		if(!isset($_REQUEST['page'])) {
			$proweight = proweightList();
		}
		if(isset($_REQUEST['id'])) {
			$result_edit = editproweight($_REQUEST['id']);			
		}	
		
			
	require_once 'productweight-view.php';
?>