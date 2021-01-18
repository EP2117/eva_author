<?php
	function insertProductuom(){
		$product_colour_name              = trim($_POST['product_colour_name']);
		$product_colour_active_status     = "active";
		$request_fields 				= ((!empty($product_colour_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "product-colour/index.phpindex.php?page=add");
		$product_colour_uniq_id			= generateUniqId();
		$ip								= getRealIpAddr();
		
		$insert_product_colour 			= sprintf("INSERT INTO product_colours (product_colour_uniq_id, product_colour_name, 
																					product_colour_added_by,product_colour_added_on,  
																					product_colour_added_ip, product_colour_company_id) 
																			VALUES ('%s', '%s',
																					'%d', UNIX_TIMESTAMP(NOW()), 
																					'%s', '%d')", 
																					$product_colour_uniq_id,$product_colour_name, 
																					$_SESSION[SESS.'_session_user_id'],
																					$ip,$_SESSION[SESS.'_session_company_id']); 
		mysql_query($insert_product_colour);
		pageRedirection("product-colour/index.php?page=add");
	}
	function listProductuom(){
		$select_product_colour		=	"SELECT 
										product_colour_id,
										product_colour_name,
										product_colour_uniq_id
									 FROM 
										product_colours 
									 WHERE 
										product_colour_deleted_status 	= 	0 AND 
										product_colour_active_status 	=	'active'
									 ORDER BY 
										product_colour_name ASC";
		$result_product_colour 	= mysql_query($select_product_colour);
		// Filling up the array
		$product_colour_data 		= array();
		while ($record_product_colour = mysql_fetch_array($result_product_colour))
		{
		 $product_colour_data[] 		= $record_product_colour;
		}
		return $product_colour_data;
	}
	function editProductuom(){
		$product_colour_id 			= getId('product_colours', 'product_colour_id', 'product_colour_uniq_id', dataValidation($_GET['id'])); 
		
		$select_product_colour			=	"SELECT 
											product_colour_id,
											product_colour_name,
											product_colour_uniq_id
										 FROM 
											product_colours 
										 WHERE 
											product_colour_deleted_status 	=  0 			AND 
											product_colour_active_status 	= 'active'		AND
											product_colour_id				= '".$product_colour_id."'
										 ORDER BY 
											product_colour_name ASC";
		$result_product_colour 		= mysql_query($select_product_colour);
		$record_product_colour 		= mysql_fetch_array($result_product_colour);
		return $record_product_colour;
	}
	function updateProductuom(){
		$product_colour_id                   	= trim($_POST['product_colour_id']);
		$product_colour_uniq_id               	= trim($_POST['product_colour_uniq_id']);
		$product_colour_name                  	= trim($_POST['product_colour_name']);
		$request_fields 					= ((!empty($product_colour_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "product-colour/index.phpindex.php?page=edit&id=".$product_colour_uniq_id);
		$update_product_colour 				= sprintf("	UPDATE 
															product_colours 
														SET 
															product_colour_name 				= '%s',
															product_colour_modified_by 		= '%d',
															product_colour_modified_on 		= UNIX_TIMESTAMP(NOW()),
															product_colour_modified_ip		= '%s'
														WHERE               
															product_colour_id             	= '%d'
																		 ", 
															$product_colour_name, 
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$product_colour_id);
		mysql_query($update_product_colour);
		pageRedirection("product-colour/index.php?page=edit&id=$product_colour_uniq_id");			
		
	}
?>