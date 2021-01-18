<?php
	function insertBrand(){
		$brand_name                   	= trim($_POST['brand_name']);
		$brand_active_status           	= "active";
		$request_fields 				= ((!empty($brand_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "brand/index.php?page=add");
		$brand_uniq_id					= generateUniqId();
		$ip								= getRealIpAddr();
		
		$insert_brand 					= sprintf("INSERT INTO brands  (brand_uniq_id, brand_name, 
																		brand_added_by,brand_added_on,  
																		brand_added_ip, brand_company_id) 
																VALUES ('%s', '%s',
																		'%d', UNIX_TIMESTAMP(NOW()), 
																		'%s', '%d')", 
																		$brand_uniq_id,$brand_name, 
																		$_SESSION[SESS.'_session_user_id'],
																		$ip,$_SESSION[SESS.'_session_company_id']); 
		mysql_query($insert_brand);
		pageRedirection("brand/index.php?page=add");
	}
	function listBrand(){
		$select_brand		=	"SELECT 
									brand_id,
									brand_name,
									brand_uniq_id
								 FROM 
									brands 
								 WHERE 
									brand_deleted_status 	= 	0 AND 
									brand_active_status 	=	'active'
								 ORDER BY 
									brand_name ASC";
		$result_brand 		= mysql_query($select_brand);
		// Filling up the array
		$brand_data 		= array();
		while ($record_brand = mysql_fetch_array($result_brand))
		{
		 $brand_data[] 	= $record_brand;
		}
		return $brand_data;
	}
	function editBrand(){
		$brand_id 			= $_GET['id']; 
		
		$select_brand		=	"SELECT 
									brand_id,
									brand_name,
									brand_uniq_id
								 FROM 
									brands 
								 WHERE 
									brand_deleted_status 	=  0 			AND 
									brand_active_status 	= 'active'		AND
									brand_id				= '".$brand_id."'
								 ORDER BY 
									brand_name ASC";
							//echo $select_brand;exit;		
		$result_brand 		= mysql_query($select_brand);
		$record_brand 		= mysql_fetch_array($result_brand);
		return $record_brand;
	}
	function updateBrand(){
		$brand_id                   	= trim($_POST['brand_id']);
		$brand_uniq_id                	= trim($_POST['brand_uniq_id']);
		$brand_name                   	= trim($_POST['brand_name']);
		$request_fields 						= ((!empty($brand_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "brand/index.php?page=edit&id=".$brand_uniq_id);
		$update_brand 					= sprintf("	UPDATE 
														brands 
													SET 
														brand_name 				= '%s',
														brand_modified_by 		= '%d',
														brand_modified_on 		= UNIX_TIMESTAMP(NOW()),
														brand_modified_ip		= '%s'
													WHERE               
														brand_id             	= '%d'
																	 ", 
														$brand_name, 
														$_SESSION[SESS.'_session_user_id'], 
														$ip, 
														$brand_id);
		mysql_query($update_brand);
		pageRedirection("brand/?page=edit&id=$brand_uniq_id");			
		
	}
?>