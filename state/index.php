<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'state-model.php';

		$countryList	= getCountryList();

		if(isset($_POST['state_insert'])){

			addState();

		}

		if(!isset($_REQUEST['page'])) {

			$state_list	= listState();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$state_edit	= editState();

		}

		if(isset($_POST['state_update'])){

			updateState();

		}
		
		if(isset($_REQUEST['delete_state'])){

			deletestate();

		}

	require_once 'state-view.php';

?>