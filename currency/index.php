<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'currency-model.php';
		if(isset($_POST['currency_insert'])){
			insertCurrency();
		}
		if(!isset($_REQUEST['page'])) {
			$currency_list	= listCurrency();
		}
		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {
			$currency_edit	= editCurrency();
		}
		if(isset($_POST['currency_update'])){
			updateCurrency();
		}
	require_once 'currency-view.php';
?>