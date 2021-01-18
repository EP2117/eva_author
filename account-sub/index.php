<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'ac-subhead-model.php';		
		$courrencyList	= listCurrency();
		$arr_acc_head	=listaccHead();
		$acc_type = array('1'=>'Cash',"2"=>"Bank","3"=>"Customer","4"=>"Supplier","5"=>"Other");
		if(isset($_POST['ac_subhead_insertupdate'])){
			acaSubheadinsertupdate();
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
	require_once 'ac-subhead-view.php';
?>