<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'ac-head-model.php';		
		$branch_list		= getBranchList();
		if(isset($_POST['ac_head_insertupdate'])){
			acheadinsertupdate();
		}
		if(!isset($_REQUEST['page'])) {
			$listResult = listresult();
		}
		if(isset($_REQUEST['id'])) {
			$resultedit   = editResult($_REQUEST['id']);	
		}	
		if(isset($_REQUEST['head_delete'])) {
			deleteResult($_REQUEST['id']);	
		}		
	require_once 'ac-head-view.php';
?>