<?php

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	loginAuthentication();
//echo 'prakash';exit;	
	require_once 'thick-model.php';

		if(isset($_POST['thick_insert'])){

			addthick();

		}

		if(!isset($_REQUEST['page'])) {

			$thick_list	= listthick();

		} 

		if(isset($_REQUEST['page']) && (($_REQUEST['page']=='edit') )) {

			$thick_edit	= editthick();

		}

		if(isset($_POST['thick_update'])){

			updatethick();

		}
		
		
		if(isset($_REQUEST['delete_thick'])){

			deleteCountry();

		}

	require_once 'thick-view.php';

?>