<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	loginAuthentication();
	require_once 'writeof-model.php';		
		$branch_list		= getBranchList();
		$godown_list		= getGodownList();
		$writeof_type_arry=array("1"=>"Missing Product",'2'=>"Demage Product",'3'=>"Script Product",'4'=>"Other");

		$dmgmsg_scrp	= damgMsingScrpDetails();
	
		if(isset($_POST['writeof_insrtUpdate'])){
			writeoffInsertUpdate();
		}
		if(!isset($_REQUEST['page'])) {
			$writeofList =listwriteoff();
		}
		if(isset($_REQUEST['id'])) {
			$editwriteoff  = editWriteoff($_REQUEST['id']);	
			
			$editwriteoffProd  = editwriteofproduct($_REQUEST['id']);			
		}
		if(isset($_REQUEST['writeof_delete'])){
		writeofdelete();
		}	
		
		if(isset($_REQUEST['product_detail_delete'])){
		product_delete();
		}		
	require_once 'writeof-view.php';
?>