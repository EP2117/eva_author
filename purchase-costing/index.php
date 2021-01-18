<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'purchase-costing-model.php';

		if(isset($_POST['pur_costing_insert'])){

			addCountry();

		}

		if(!isset($_REQUEST['page'])) {

			$pur_costing_list	= listCountry();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$pur_costing_edit	= editCountry();

		}

		if(isset($_POST['pur_costing_update'])){

			updateCountry();

		}
		
		
		if(isset($_REQUEST['delete_pur_costing'])){

			deleteCountry();

		}

	require_once 'purchase-costing-view.php';

?>