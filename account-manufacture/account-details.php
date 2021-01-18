<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'head_account':headsub();
				break;
		}
		
	}
	function headsub(){
		$query = "SELECT account_sub_name,account_sub_id
				 FROM account_sub 
				 WHERE account_sub_head_id ='".$_REQUEST['id']."'";
		 $result = mysql_query($query);
		 $response =array();
			echo '<option value="">-- Select --</option>';
		 while($resultData = mysql_fetch_array($result)){		 
			echo '<option value='.$resultData['account_sub_id'].'>'.$resultData['account_sub_name'].'</option>';
		 }
		return $response;
	}
	?>