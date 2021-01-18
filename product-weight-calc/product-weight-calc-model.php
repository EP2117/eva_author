<?php
	function productDetails(){
			 $query  = "SELECT product_id,product_name FROM  products
		 			WHERE product_deleted_status = 0
					ORDER BY product_id DESC";
					//echo $query; exit;
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	function insertProductcategory(){
		$pwc_product_id      = trim($_POST['pwc_product_id']);
		$pwc_thick_ness      = trim($_POST['pwc_thick_ness']);
		$pwc_type            = trim($_POST['pwc_type']);
		$pwc_weight          = trim($_POST['pwc_weight']);
		$request_fields 					= ((!empty($pwc_product_id)));
		checkRequestFields($request_fields, PROJECT_PATH, "product-weight-calc/index.phpindex.php?page=add");
		$pwc_uniq_id					= generateUniqId();
		$ip									= getRealIpAddr();
		$insert_product_weight_cal 			= sprintf("INSERT INTO product_weight_cals  (pwc_uniq_id, pwc_product_id, 
																						 pwc_thick_ness,pwc_type,
																						 pwc_weight, 
																						 pwc_added_by,pwc_added_on,  
																						 pwc_added_ip, pwc_company_id) 
																				VALUES ('%s', '%d',
 																						'%d', '%d',
																						'%f', 
																						'%d', UNIX_TIMESTAMP(NOW()), 
																						'%s', '%d')", 
																						$pwc_uniq_id,$pwc_product_id, 
																						$pwc_thick_ness,$pwc_type,
																						$pwc_weight, 
																						$_SESSION[SESS.'_session_user_id'],
																						$ip,$_SESSION[SESS.'_session_company_id']); 
		mysql_query($insert_product_weight_cal);
		pageRedirection("product-weight-calc/index.php?page=add");

	}

	function listProductcategory(){

		$select_product_weight_cal		=	"SELECT 
												pwc_id,
												pwc_uniq_id, pwc_product_id, 
												pwc_thick_ness,pwc_type,
												pwc_weight,product_name 
											 FROM 
												product_weight_cals 
											 LEFT JOIN
											 	products
											 ON
											 	pwc_product_id   	= product_id
											 WHERE 
												pwc_deleted_status 	= 	0 
											 ORDER BY 
												product_name ASC";
		$result_product_weight_cal 		= mysql_query($select_product_weight_cal);
		// Filling up the array
		$pwc_data 			= array();
		while ($record_product_weight_cal = mysql_fetch_array($result_product_weight_cal))
		{
		 $pwc_data[] 	= $record_product_weight_cal;
		}
		return $pwc_data;
	}

	function editProductcategory(){

		$pwc_id 			= getId('product_weight_cals', 'pwc_id', 'pwc_uniq_id', dataValidation($_GET['id'])); 

		

		$select_product_weight_cal		=	"SELECT 
												pwc_id,
												pwc_uniq_id, pwc_product_id, 
												pwc_thick_ness,pwc_type,
												pwc_weight 
											 FROM 
												product_weight_cals 
											 WHERE 

												pwc_deleted_status 	=  0 			AND 
												pwc_id				= '".$pwc_id."'

											 ORDER BY 

												pwc_thick_ness ASC";

		$result_product_weight_cal 		= mysql_query($select_product_weight_cal);

		$record_product_weight_cal 		= mysql_fetch_array($result_product_weight_cal);

		return $record_product_weight_cal;

	}

	function updateProductcategory(){

		$pwc_id              = trim($_POST['pwc_id']);
		$pwc_uniq_id         = trim($_POST['pwc_uniq_id']);
		$pwc_product_id      = trim($_POST['pwc_product_id']);
		$pwc_thick_ness      = trim($_POST['pwc_thick_ness']);
		$pwc_type            = trim($_POST['pwc_type']);
		$pwc_weight          = trim($_POST['pwc_weight']);
		$request_fields 						= ((!empty($pwc_name)));
		checkRequestFields($request_fields, PROJECT_PATH, "product-weight-calc/index.phpindex.php?page=edit&id=".$pwc_uniq_id);
		$update_product_weight_cal 				= sprintf("	UPDATE 
																product_weight_cals 
															SET 
																pwc_product_id 		= '%d',
																pwc_thick_ness 		= '%d',
																pwc_type 			= '%d',
																pwc_weight 			= '%f',
																pwc_modified_by 		= '%d',
																pwc_modified_on 		= UNIX_TIMESTAMP(NOW()),
																pwc_modified_ip		= '%s'
															WHERE               
																pwc_id             	= '%d' ", 

																$pwc_name, 

																$_SESSION[SESS.'_session_user_id'], 

																$ip, 

																$pwc_id);

		mysql_query($update_product_weight_cal);

		pageRedirection("product-weight-calc/index.php?page=edit&id=$pwc_uniq_id");			

		

	}

?>