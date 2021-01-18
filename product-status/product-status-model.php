<?php
	function insertProductcategory(){
		$product_status_name              	= trim($_POST['product_status_name']);
		$product_status_active_status     	= "active";
		$request_fields 					= ((!empty($product_status_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "product-status/index.phpindex.php?page=add");
		$product_status_uniq_id				= generateUniqId();
		$ip									= getRealIpAddr();
		
		$insert_product_status 				= sprintf("INSERT INTO product_status  (product_status_uniq_id, product_status_name, 
																					product_status_added_by,product_status_added_on,  
																					product_status_added_ip, product_status_company_id) 
																			VALUES ('%s', '%s',
																					'%d', UNIX_TIMESTAMP(NOW()), 
																					'%s', '%d')", 
																					$product_status_uniq_id,$product_status_name, 
																					$_SESSION[SESS.'_session_user_id'],
																					$ip,$_SESSION[SESS.'_session_company_id']); 
		mysql_query($insert_product_status);
		pageRedirection("product-status/index.php?page=add");
	}
	function listProductcategory(){
		$select_product_status		=	"SELECT 
											product_status_id,
											product_status_name,
											product_status_uniq_id
										 FROM 
											product_status 
										 WHERE 
											product_status_deleted_status 	= 	0 AND 
											product_status_active_status 	=	'active'
										 ORDER BY 
											product_status_name ASC";
		$result_product_status 		= mysql_query($select_product_status);
		// Filling up the array
		$product_status_data 			= array();
		while ($record_product_status = mysql_fetch_array($result_product_status))
		{
		 $product_status_data[] 	= $record_product_status;
		}
		return $product_status_data;
	}
	function editProductcategory(){
		$product_status_id 			= getId('product_status', 'product_status_id', 'product_status_uniq_id', dataValidation($_GET['id'])); 
		
		$select_product_status		=	"SELECT 
											product_status_id,
											product_status_name,
											product_status_uniq_id
										 FROM 
											product_status 
										 WHERE 
											product_status_deleted_status 	=  0 			AND 
											product_status_active_status 	= 'active'		AND
											product_status_id				= '".$product_status_id."'
										 ORDER BY 
											product_status_name ASC";
		$result_product_status 		= mysql_query($select_product_status);
		$record_product_status 		= mysql_fetch_array($result_product_status);
		return $record_product_status;
	}
	function updateProductcategory(){
		$product_status_id                   	= trim($_POST['product_status_id']);
		$product_status_uniq_id               = trim($_POST['product_status_uniq_id']);
		$product_status_name                  = trim($_POST['product_status_name']);
		$request_fields 						= ((!empty($product_status_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "product-status/index.phpindex.php?page=edit&id=".$product_status_uniq_id);
		$update_product_status 				= sprintf("	UPDATE 
																product_status 
															SET 
																product_status_name 				= '%s',
																product_status_modified_by 		= '%d',
																product_status_modified_on 		= UNIX_TIMESTAMP(NOW()),
																product_status_modified_ip		= '%s'
															WHERE               
																product_status_id             	= '%d'
																			 ", 
																$product_status_name, 
																$_SESSION[SESS.'_session_user_id'], 
																$ip, 
																$product_status_id);
		mysql_query($update_product_status);
		pageRedirection("product-status/index.php?page=edit&id=$product_status_uniq_id");			
		
	}
?>