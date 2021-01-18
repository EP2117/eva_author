<?php

	function insertProduct(){

		$product_code                   = trim($_POST['product_code']);
		$product_name                   = trim($_POST['product_name']);
		$product_brand_id             	= trim($_POST['product_brand_id']);
		$product_product_category_id    = trim($_POST['product_product_category_id']);
		$product_type         			= trim($_POST['product_type']);
		$product_product_uom_id         = trim($_POST['product_product_uom_id']);
		$product_purchase_uom_id        = trim($_POST['product_purchase_uom_id']);
		$product_product_colour_id      = trim($_POST['product_product_colour_id']);
		$product_feet_qty 				= trim($_POST['product_feet_qty']);
		$product_meter_qty             	= trim($_POST['product_meter_qty']);
		$product_mm_qty					= trim($_POST['product_mm_qty']);
		$product_inches_qty             = trim($_POST['product_inches_qty']);
		$product_thick_ness             = trim($_POST['product_thick_ness']);
		$product_production_type        = trim($_POST['product_production_type']);

		$product_active_status        	= "active";

		

		//Multi Contact

		$product_detail_raw_product_id    = $_POST['product_detail_raw_product_id'];

		

		$request_fields 				= ((!empty($product_name)) && (!empty($product_brand_id)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "product/index.php?page=add&msg=5");

		$product_uniq_id				= generateUniqId();

		$ip								= getRealIpAddr();

		

		$insert_product 				= sprintf("INSERT INTO products  (product_uniq_id, product_code,product_name, 

																		   product_brand_id, product_product_category_id, product_type,

																		   product_product_uom_id,product_product_colour_id,product_feet_qty,

																		   product_meter_qty,product_mm_qty,product_inches_qty,

																		   product_active_status,product_added_by,product_added_on,

																		   product_added_ip,product_company_id,product_thick_ness,
																		   product_production_type,product_purchase_uom_id) 

																VALUES 	 ('%s', '%s', '%s', 

																		  '%d', '%d', '%d', 

																		  '%d', '%d', '%f',

																		  '%f', '%f', '%f',

																		  '%s', '%d',  UNIX_TIMESTAMP(NOW()),

																		  '%s', '%d', '%f',
																		  '%d', '%d')", 

																		   $product_uniq_id, $product_code,$product_name, 

																		   $product_brand_id, $product_product_category_id, $product_type,

																		   $product_product_uom_id,$product_product_colour_id,$product_feet_qty,

																		   $product_meter_qty,$product_mm_qty,$product_inches_qty,

																		   $product_active_status,$_SESSION[SESS.'_session_user_id'],

																		   $ip, $_SESSION[SESS.'_session_company_id'],$product_thick_ness,
																		   $product_production_type,$product_purchase_uom_id); 

		mysql_query($insert_product);

		$product_id 					= mysql_insert_id(); 

		for($i=0; $i<count($product_detail_raw_product_id); $i++) {

		

			if((!empty($product_detail_raw_product_id[$i]))) {

				 $insert_product_detail = "INSERT INTO product_details (product_detail_product_id,product_detail_raw_product_id,

																		product_detail_added_by,product_detail_added_on,product_detail_added_ip) 

																 VALUES ('".$product_id."','".$product_detail_raw_product_id[$i]."',

																		'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 

				 mysql_query($insert_product_detail); 

		   }

		} 

		pageRedirection("product/index.php?page=add&msg=1");

	}

	function listProduct(){

		$select_branch		=	"SELECT 

									product_id,

									product_name,

									product_code,

									product_type,

									product_uniq_id,

									brand_name,

									product_category_name

								 FROM 

									products

								 LEFT JOIN

								 	brands

								 ON

								 	brand_id			= product_brand_id 

								 LEFT JOIN

								 	product_categories

								 ON

								 	product_category_id	= product_product_category_id 

								 WHERE 

									product_deleted_status 	= 	0 AND 

									product_active_status 	=	'active'

								 ORDER BY 

									product_name ASC";

		$result_branch 		= mysql_query($select_branch);

		// Filling up the array

		$product_data 		= array();

		while ($record_branch = mysql_fetch_array($result_branch))

		{

		 $product_data[] 	= $record_branch;

		}

		return $product_data;

	}

	function editProduct(){

		$product_id 			= getId('products', 'product_id', 'product_uniq_id', dataValidation($_GET['id'])); 

		$select_branch		=	"SELECT 

									product_id,

									product_uniq_id,

									product_name,

									product_code,

									product_brand_id,

									product_product_category_id,

									product_type,

									product_product_uom_id,

									product_product_colour_id,

									product_feet_qty,

									product_meter_qty,

									product_mm_qty,

									product_inches_qty,

									product_active_status,

									product_thick_ness,
									product_production_type,
									product_purchase_uom_id 

								 FROM 

									products 

								 WHERE 

									product_deleted_status 	=  0 			AND 

									product_active_status 	= 'active'		AND

									product_id				= '".$product_id."'

								 ORDER BY 

									product_name ASC";

		$result_branch 		= mysql_query($select_branch);

		$record_branch 		= mysql_fetch_array($result_branch);

		return $record_branch;

	}

    function editProductDetail(){

		$product_id 					= getId('products', 'product_id', 'product_uniq_id', dataValidation($_GET['id'])); 

		$select_product_detail 			= "SELECT 

												product_detail_id,

												product_detail_raw_product_id,

												product_detail_product_id,

												product_thick_ness,

												product_uom_name 

											FROM 

												product_details

											LEFT JOIN

												products

											ON

												product_id						= product_detail_raw_product_id

											LEFT JOIN

												product_uoms

											ON

												product_uom_id					= product_product_uom_id 

											WHERE 

												product_detail_product_id 		= '".$product_id."'	 AND 

												product_detail_deleted_status 	= 0"; 

		$result_product_detail 			= mysql_query($select_product_detail);

		

		// Filling up the array

		$data_product_detail  			= array();

		

		while ($record_product_detail 	= mysql_fetch_array($result_product_detail))

		{

		 $data_product_detail[] 		= $record_product_detail;

		}

		return $data_product_detail;

   }

	function updateProduct(){

		$product_id                   	= trim($_POST['product_id']);

		$product_uniq_id                = trim($_POST['product_uniq_id']);

		$product_code                   = trim($_POST['product_code']);

		$product_name                   = trim($_POST['product_name']);

		$product_brand_id             	= trim($_POST['product_brand_id']);

		$product_product_category_id    = trim($_POST['product_product_category_id']);

		$product_type         			= trim($_POST['product_type']);

		$product_product_uom_id         = trim($_POST['product_product_uom_id']);
		$product_purchase_uom_id         = trim($_POST['product_purchase_uom_id']);

		$product_product_colour_id      = trim($_POST['product_product_colour_id']);

		$product_feet_qty 				= trim($_POST['product_feet_qty']);

		$product_meter_qty             	= trim($_POST['product_meter_qty']);

		$product_mm_qty					= trim($_POST['product_mm_qty']);

		$product_inches_qty             = trim($_POST['product_inches_qty']);

		$product_thick_ness             = trim($_POST['product_thick_ness']);

		$product_active_status        	= trim($_POST['product_active_status']);
		$product_production_type         = trim($_POST['product_production_type']);
		//Multi Contact

		$product_detail_id      		= $_POST['product_detail_id'];

		$product_detail_raw_product_id  = $_POST['product_detail_raw_product_id'];

		$request_fields 				= ((!empty($product_name)) && (!empty($product_brand_id)));

		$product_active_status			= "active";

		checkRequestFields($request_fields, PROJECT_PATH, "product/index.php?page=edit&id=".$product_uniq_id."&msg=5");

		$update_product 				= sprintf("	UPDATE 

															products 

														SET 

															product_name 					= '%s',
															product_code 					= '%s',
															product_brand_id 				= '%d',
															product_product_category_id 	= '%d',
															product_type 					= '%d',
															product_product_uom_id 			= '%d',
															product_purchase_uom_id 		= '%d',
															product_product_colour_id 		= '%d',
															product_feet_qty 				= '%f',
															product_meter_qty 				= '%f',
															product_mm_qty 					= '%f',
															product_inches_qty 				= '%f',
															product_thick_ness 				= '%f',
															product_production_type			= '%d',
															product_active_status 			= '%s',
															product_modified_by 			= '%d',
															product_modified_on 			= UNIX_TIMESTAMP(NOW()),
															product_modified_ip				= '%s'
														WHERE               
															product_id             			= '%d'", 
															$product_name,
															$product_code,
															$product_brand_id,
															$product_product_category_id,
															$product_type,
															$product_product_uom_id,
															$product_purchase_uom_id,
															$product_product_colour_id,
															$product_feet_qty,
															$product_meter_qty,
															$product_mm_qty,
															$product_inches_qty,
															$product_thick_ness,
															$product_production_type,
															$product_active_status,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$product_id); 

		mysql_query($update_product);
		for($i=0; $i<count($product_detail_raw_product_id); $i++) {	

			if(!empty($product_detail_id[$i])) {

				$update_product_detail		=	"UPDATE 

													product_details 

												 SET 

													product_detail_raw_product_id        = '".$product_detail_raw_product_id[$i]."', 

													product_detail_modified_by      = '".$_SESSION[SESS.'_session_user_id']."', 

													product_detail_modified_on      = UNIX_TIMESTAMP(NOW()), 

													product_detail_modified_ip      = '".$ip."' 

								  				WHERE 

													product_detail_id 				= '".$product_detail_id[$i]."'";

				mysql_query($update_product_detail);

			}else {	  

			if((!empty($product_detail_raw_product_id[$i]))) {

				 $insert_product_detail = "INSERT INTO product_details (product_detail_product_id,product_detail_raw_product_id,

																		product_detail_added_by,product_detail_added_on,product_detail_added_ip) 

																 VALUES ('".$product_id."','".$product_detail_raw_product_id[$i]."',

																		'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 

				 mysql_query($insert_product_detail); 

			}

		   }

		}				  

		pageRedirection("product/?page=edit&id=$product_uniq_id&msg=2");			

	}

    function deleteProductMultiContact()

   {

		if((isset($_REQUEST['product_multi_contact_id'])) && (isset($_REQUEST['product_uniq_id'])))

		{

			$product_multi_contact_id 	= $_GET['product_multi_contact_id'];

			$product_uniq_id = $_GET['product_uniq_id'];

			mysql_query("UPDATE product_multi_contacts SET product_multi_contact_deleted_status = 1 

						WHERE product_multi_contact_id = ".$product_multi_contact_id." ");

			header("Location:index.php?page=edit&id=$product_uniq_id&msg=6");

		}

		

   } 		

	

?>