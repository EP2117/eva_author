<?php
	function insertProductcategory(){
		$product_category_name              = trim($_POST['product_category_name']);
		$product_category_active_status     = "active";
		$request_fields 					= ((!empty($product_category_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "product-category/index.phpindex.php?page=add");
		$product_category_uniq_id					= generateUniqId();
		$ip									= getRealIpAddr();
		
		$insert_product_category 			= sprintf("INSERT INTO product_categories  (product_category_uniq_id, product_category_name, 
																						product_category_added_by,product_category_added_on,  
																						product_category_added_ip, product_category_company_id) 
																				VALUES ('%s', '%s',
																						'%d', UNIX_TIMESTAMP(NOW()), 
																						'%s', '%d')", 
																						$product_category_uniq_id,$product_category_name, 
																						$_SESSION[SESS.'_session_user_id'],
																						$ip,$_SESSION[SESS.'_session_company_id']); 
		mysql_query($insert_product_category);
		pageRedirection("product-category/index.php?page=add");
	}
	function listProductcategory(){
		$select_product_category		=	"SELECT 
												product_category_id,
												product_category_name,
												product_category_uniq_id
											 FROM 
												product_categories 
											 WHERE 
												product_category_deleted_status 	= 	0 AND 
												product_category_active_status 	=	'active'
											 ORDER BY 
												product_category_name ASC";
		$result_product_category 		= mysql_query($select_product_category);
		// Filling up the array
		$product_category_data 			= array();
		while ($record_product_category = mysql_fetch_array($result_product_category))
		{
		 $product_category_data[] 	= $record_product_category;
		}
		return $product_category_data;
	}
	function editProductcategory(){
		$product_category_id 			= getId('product_categories', 'product_category_id', 'product_category_uniq_id', dataValidation($_GET['id'])); 
		
		$select_product_category		=	"SELECT 
												product_category_id,
												product_category_name,
												product_category_uniq_id
											 FROM 
												product_categories 
											 WHERE 
												product_category_deleted_status 	=  0 			AND 
												product_category_active_status 	= 'active'		AND
												product_category_id				= '".$product_category_id."'
											 ORDER BY 
												product_category_name ASC";
		$result_product_category 		= mysql_query($select_product_category);
		$record_product_category 		= mysql_fetch_array($result_product_category);
		return $record_product_category;
	}
	function updateProductcategory(){
		$product_category_id                   	= trim($_POST['product_category_id']);
		$product_category_uniq_id               = trim($_POST['product_category_uniq_id']);
		$product_category_name                  = trim($_POST['product_category_name']);
		$request_fields 						= ((!empty($product_category_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "product-category/index.phpindex.php?page=edit&id=".$product_category_uniq_id);
		$update_product_category 				= sprintf("	UPDATE 
																product_categories 
															SET 
																product_category_name 				= '%s',
																product_category_modified_by 		= '%d',
																product_category_modified_on 		= UNIX_TIMESTAMP(NOW()),
																product_category_modified_ip		= '%s'
															WHERE               
																product_category_id             	= '%d'
																			 ", 
																$product_category_name, 
																$_SESSION[SESS.'_session_user_id'], 
																$ip, 
																$product_category_id);
		mysql_query($update_product_category);
		pageRedirection("product-category/index.php?page=edit&id=$product_category_uniq_id");			
		
	}
?>