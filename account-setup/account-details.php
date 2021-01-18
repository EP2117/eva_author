<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if(isset($_REQUEST['action'])){
		
		switch($_REQUEST['action']){
			case 'accountList':accountList();
				break;
		}
		
	}
	
	function accountList(){
	
		$val   = $_REQUEST['val'];
	    $query = "SELECT account_sub_id,account_sub_name
				 FROM  account_sub 
				 WHERE account_sub_deleted_status=0 and account_sub_name LIKE '$val%'";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			}
		echo json_encode($response);
	}
	
	
?>

		