<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();

	require_once 'city-model.php';

		$countryList	= getCountryList();

		if(isset($_POST['city_insert'])){

			addCity();

		}

		if(!isset($_REQUEST['page'])) {

			$city_list	= listCity();

		}

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$city_edit	= editCity();

			$state_list	= getStateList($city_edit['city_country_id']);

		}

		if(isset($_POST['city_update'])){

			updateCity();

		}
		
		if(isset($_REQUEST['delete_city'])){

			deleteCity();

		}

	require_once 'city-view.php';

?>