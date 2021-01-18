<?php
	function product_insert(){
		$product_condition_name                   	= trim($_POST['product_condition_name']);
		$ip									= getRealIpAddr();
		$request_fields 				= ((!empty($product_condition_name)));
		
		checkRequestFields($request_fields, PROJECT_PATH, "product-condition/index.php?page=add&msg=5");
		
		
		$product_condition_name = $_POST['product_condition_name'];
			
		 if(!empty($product_condition_name)){
		  $insert_tax=sprintf("INSERT INTO product_condition (product_condition_name,product_added_on,product_added_by,
		  	product_added_ip) values('%s',UNIX_TIMESTAMP(NOW()),'%d','%s') ",$product_condition_name,$_SESSION[SESS.'_session_user_id'],$ip);
		mysql_query($insert_tax);
		
		}
		pageRedirection("product-condition/index.php?page=add");
	}
	function product_list(){
		$select_product		=	"SELECT 
									*
										 FROM 
											product_condition 
										 WHERE 
											product_condition_deleted_status 	= 	0 
										 ORDER BY 
											product_condition_name ASC";
		$result_product 		= mysql_query($select_product);
		// Filling up the array
		$product_data 		= array();
		while ($record_product = mysql_fetch_array($result_product))
		{
		 $product_data[] 	= $record_product;
		}
		return $product_data;
	}
	function editproduct(){
		$prodcut_id 			= $_GET['id']; 
		
		$select_tax			=	"SELECT 
									*
								 FROM 
									 product_condition 
								 WHERE 
									product_condition_deleted_status 	=  0 			AND 
									product_condition_id				= '".$prodcut_id."'
								 ORDER BY 
									product_condition_name ASC";
		$result_tax 		= mysql_query($select_tax);
		$record_tax 		= mysql_fetch_array($result_tax);
		return $record_tax;
	}
	function product_update(){
		$product_condition_id                   = $_GET['id'];
		$product_condition_name                	= trim($_POST['product_condition_name']);
				$ip									= getRealIpAddr();
		$request_fields 				= (!empty($product_condition_name));
		//checkRequestFields($request_fields, PROJECT_PATH, "product-condition/index.php?page=edit&id=".$tax_uniq_id);
		if(!empty($request_fields)){
		$update_product					= sprintf("	UPDATE 
														product_condition
 
													SET 
															product_condition_name  				= '%s',
															product_modified_by						= '%d',
															product_modified_no						= UNIX_TIMESTAMP(NOW()),
															product_modified_ip						= '%s'
		  
														
													WHERE               
														product_condition_id             		= '%d'
																	 ", 
														$product_condition_name,
														$_SESSION[SESS.'_session_user_id'],
														$ip,
														$product_condition_id);
		mysql_query($update_product);
		
		}
		pageRedirection("product-condition/index.php?page=edit&id=$product_condition_id");			
		
	}
?>