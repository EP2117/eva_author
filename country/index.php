<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'country-model.php';

		if(isset($_POST['country_insert'])){

			addCountry();

		}

		if(!isset($_REQUEST['page'])) {

			$country_list	= listCountry();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$country_edit	= editCountry();

		}

		if(isset($_POST['country_update'])){

			updateCountry();

		}
		
		
		if(isset($_REQUEST['delete_country'])){

			deleteCountry();

		}

	require_once 'country-view.php';

?>