<?php
	require_once('includes/config/config.php');
	require_once('includes/config/utility-class.php');
	if(!isset($_SESSION[SESS.'_session_user_id'])) {
		
		require_once 'index-model.php'; 
		$arr_language 	= array("en"=>"English");
		if(isset($_POST['sign_in'])) {
			userAuthentication();
		} 
		
		
		$list_financial_year = getFinancialYear();
		
		require_once 'index-view.php'; 
	
	} else {
		
		header("Location:home/index.php");
		exit();
		
	}
?>