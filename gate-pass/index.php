<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'gatepass-model.php';		
		$branch_list		= getBranchList();
		$godown_list		= getGodownList();
		$production_delivery	= productiondelivery();
		if(isset($_POST['gatepass_insert'])){
			gatepassInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$gpList =listGatepass();
		}
		if(isset($_REQUEST['id'])) {
			$gpdetailEdit  = editgpdetails($_REQUEST['id']);	
			$gpproductsEdit  = editgpdetailsproduct($_REQUEST['id']);			
		}	
		if(isset($_REQUEST['gatepass_delete'])){
			deteteGatePass();
		}	
	require_once 'gatepass-view.php';
?>