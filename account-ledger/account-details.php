<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	
	if($_REQUEST['action']=='account'){
	
	$id = $_REQUEST['term'];
	 $rs = mysql_query("SELECT account_sub_name,account_sub_id,account_sub_code
				 FROM account_sub 
				 WHERE account_sub_name LIKE '%".$id."%'  OR account_sub_code LIKE '%".$id."%' AND account_sub_deleted_status=0");
			//customer_area_id ='".$_REQUEST['area']."' AND
			
	
	$data = array();
	if ( $rs && mysql_num_rows($rs)){
		while( $row = mysql_fetch_object($rs))
		{
			
			$data[] = array(
				'value' =>$row->account_sub_name."-".$row->account_sub_code,
				'id' => $row->account_sub_id
			);
		}
	}
	echo json_encode($data);
	flush();

}    

	
	?>
	
   