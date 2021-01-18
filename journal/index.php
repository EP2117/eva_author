<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'journal-model.php';		
		$branch_list		= getBranchList();
		if(isset($_POST['journal_insertupdate'])){
			insertUpdateJournal();
		}
		if(!isset($_REQUEST['page'])) {
			$listResult = listJournal();
		}
		if(isset($_REQUEST['id'])) {
			$editResult   = editJournal($_REQUEST['id']);	
		}		
		if(isset($_REQUEST['expense_delete'])){
			deteteJournal();
		}	
	require_once 'journal-view.php';
?>