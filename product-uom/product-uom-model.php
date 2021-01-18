<?php
	function insertProductuom(){
		$product_uom_name              = trim($_POST['product_uom_name']);
		$product_uom_active_status     = "active";
		$request_fields 				= ((!empty($product_uom_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "product-uom/index.phpindex.php?page=add");
		$product_uom_uniq_id			= generateUniqId();
		$ip								= getRealIpAddr();
		
		$insert_product_uom 			= sprintf("INSERT INTO product_uoms (product_uom_uniq_id, product_uom_name, 
																					product_uom_added_by,product_uom_added_on,  
																					product_uom_added_ip, product_uom_company_id) 
																			VALUES ('%s', '%s',
																					'%d', UNIX_TIMESTAMP(NOW()), 
																					'%s', '%d')", 
																					$product_uom_uniq_id,$product_uom_name, 
																					$_SESSION[SESS.'_session_user_id'],
																					$ip,$_SESSION[SESS.'_session_company_id']); 
		mysql_query($insert_product_uom);
		pageRedirection("product-uom/index.php?page=add");
	}
	function listProductuom(){
		$select_product_uom		=	"SELECT 
										product_uom_id,
										product_uom_name,
										product_uom_uniq_id
									 FROM 
										product_uoms 
									 WHERE 
										product_uom_deleted_status 	= 	0 AND 
										product_uom_active_status 	=	'active'
									 ORDER BY 
										product_uom_name ASC";
		$result_product_uom 	= mysql_query($select_product_uom);
		// Filling up the array
		$product_uom_data 		= array();
		while ($record_product_uom = mysql_fetch_array($result_product_uom))
		{
		 $product_uom_data[] 		= $record_product_uom;
		}
		return $product_uom_data;
	}
	function editProductuom(){
		$product_uom_id 			= getId('product_uoms', 'product_uom_id', 'product_uom_uniq_id', dataValidation($_GET['id'])); 
		
		$select_product_uom			=	"SELECT 
											product_uom_id,
											product_uom_name,
											product_uom_uniq_id
										 FROM 
											product_uoms 
										 WHERE 
											product_uom_deleted_status 	=  0 			AND 
											product_uom_active_status 	= 'active'		AND
											product_uom_id				= '".$product_uom_id."'
										 ORDER BY 
											product_uom_name ASC";
		$result_product_uom 		= mysql_query($select_product_uom);
		$record_product_uom 		= mysql_fetch_array($result_product_uom);
		return $record_product_uom;
	}
	function updateProductuom(){
		$product_uom_id                   	= trim($_POST['product_uom_id']);
		$product_uom_uniq_id               	= trim($_POST['product_uom_uniq_id']);
		$product_uom_name                  	= trim($_POST['product_uom_name']);
		$request_fields 					= ((!empty($product_uom_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "product-uom/index.phpindex.php?page=edit&id=".$product_uom_uniq_id);
		$update_product_uom 				= sprintf("	UPDATE 
															product_uoms 
														SET 
															product_uom_name 				= '%s',
															product_uom_modified_by 		= '%d',
															product_uom_modified_on 		= UNIX_TIMESTAMP(NOW()),
															product_uom_modified_ip		= '%s'
														WHERE               
															product_uom_id             	= '%d'
																		 ", 
															$product_uom_name, 
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$product_uom_id);
		mysql_query($update_product_uom);
		pageRedirection("product-uom/index.php?page=edit&id=$product_uom_uniq_id");			
		
	}
?>