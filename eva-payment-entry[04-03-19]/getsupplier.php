<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
		if($_REQUEST['action']=='supplier'){
			
			
			 $query = "SELECT supplier_id,supplier_name
						 FROM suppliers							  	
						 WHERE supplier_deleted_status=0 AND  supplier_location = '".$_REQUEST['id']."' ";
			$result = mysql_query($query);
			$response =array();
			while($resultData = mysql_fetch_array($result)){
				$response[]=$resultData;
			}
			
			echo json_encode($response);
		}
		
		
	
	   	 
			
		
	
	
	
?>

		