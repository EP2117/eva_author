<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'profit-loss-model.php';		
		$branch_list		= getBranchList();
		$godown_list		= getGodownList();
		$brand_list			= getBrandList();
		$prod_category   	= getProductcategory();

		$writeof_type_arry=array("1"=>"Missing Product",'2'=>"Demage Product",'3'=>"Script Product",'4'=>"Other");
		if(isset($_REQUEST['stockAvailable'])){
			//list($list_ledger_entry,$income_ledger_entry ) =DetailledgerReport();
			list($sale_entry,$sale_return_entry,$purchase_entry,$purchase_return_entry,$transaction_entry,$income_expense_entry) = getProfitLoss();
		}
			
	require_once 'profit-loss-view.php';
?>