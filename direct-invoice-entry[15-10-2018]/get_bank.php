<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

  	$select_product 		= "	SELECT  
   									*
							 	FROM 
									 account_sub 
							 	WHERE 
									account_sub_deleted_status						=	0 	AND
									account_sub_type_id								= 	'2'";

  $result_product = mysql_query($select_product);

  while($result=mysql_fetch_array($result_product)){
  
  $arr_record[]=$result;
  
  }


		$select="<option value=''>--Select--</option>";
		
		foreach($arr_record as $value_get){
		
		$select .="<option value=".$value_get['account_sub_id'].">".$value_get['account_sub_name']."</option>";
		
		
		}

echo $select;

?>

		