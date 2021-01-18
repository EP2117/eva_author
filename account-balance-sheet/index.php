<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'balancesheet-model.php';		
		$branch_list		= getBranchList();
		$godown_list		= getGodownList();
		$brand_list			= getBrandList();
		$prod_category   	= getProductcategory();

		$writeof_type_arry=array("1"=>"Missing Product",'2'=>"Demage Product",'3'=>"Script Product",'4'=>"Other");
		if(isset($_REQUEST['stockAvailable'])){
			$reportList =listReport();
			list($list_ledger_entry)	= ledgerReport();
		}
			
	require_once 'balancesheet-view.php';
?>