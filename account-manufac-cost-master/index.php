<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'manufacturecostentry-model.php';	
		$head_ac =accountHeadList();	
		if(isset($_POST['accountgroup'])){
			acgroupInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$resultList =listResult();
		}
		if(isset($_REQUEST['id'])) {
			$editValue = editGroupResult($_REQUEST['id']);	
			$editValueAc  = editValueAcdetails($_REQUEST['id']);
		}		
	require_once 'manufacturecostentry-view.php';
?>