<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'currency-details-model.php';

	$list_balance = listBalance();
	
	if(isset($_POST['update_stock'])) { 
		updateCurrency();
	}

	require_once 'currency-details-view.php';

?>