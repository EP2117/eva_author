<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'coin-entry-model.php';		
		$branch_list		= getBranchList();
		if(isset($_POST['request_insrtUpdate'])){
			requestReciptInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$reqRecList =listreqRec();
		}
		if(isset($_REQUEST['id'])) {
			$editRequst  = editRequest($_REQUEST['id']);	
			$editRequstProd  = editRequestproduct($_REQUEST['id']);			
		}		
	require_once 'coin-entry-view.php';
?>