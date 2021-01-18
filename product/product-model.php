<?php

function getProduct_deatl($brand_id=""){
/* $select_product		=	"SELECT 
								product_code,
								product_is_opp,
								product_name,
								product_uom_name,
								product_thick_ness,
								product_id,
								product_inches_qty,
								product_extra_length,
								product_purchase_uom_id,
								brand_name,
								product_brand_id,
								product_mm_qty,
								product_inches_qty,
								product_feet_qty 
							 FROM 
								products 
							LEFT JOIN 
								product_uoms 
							ON 
								product_uom_id 						= product_purchase_uom_id
							LEFT JOIN 
								brands 
							ON 
								brand_id 							= product_brand_id
							 WHERE 
								product_deleted_status 		= 0 					
								AND product_active_status 		= 'active'	
								AND product_type	=1 
								AND product_brand_id='".$brand_id."'				
							 ORDER BY 
								product_name ASC"; */
	$select_product		=	"SELECT 
								product_code,
								product_is_opp,
								product_name,
								product_uom_name,
								product_thick_ness,
								product_id,
								product_inches_qty,
								product_extra_length,
								product_purchase_uom_id,
								brand_name,
								product_brand_id,
								product_mm_qty,
								product_inches_qty,
								product_feet_qty 
							 FROM 
								products 
							LEFT JOIN 
								product_uoms 
							ON 
								product_uom_id 						= product_purchase_uom_id
							LEFT JOIN 
								brands 
							ON 
								brand_id 							= product_brand_id
							 WHERE 
								product_deleted_status 		= 0 					
								AND product_active_status 		= 'active'	
								AND product_type	=2
								AND product_is_opp=1				
							 ORDER BY 
								product_name ASC";
	//echo $select_product;exit;
	$result_product 		= mysql_query($select_product);
	$arra_data=array();
	while($get_product			=mysql_fetch_array($result_product)){
		$arra_data[]=$get_product;
	}
	
	$select_product1		=	"SELECT 
								product_con_entry_child_product_detail_name as product_name,
								product_con_entry_child_product_detail_code as product_code,
								product_con_entry_child_product_detail_id as product_id
							 FROM 
								product_con_entry_child_product_details 
							WHERE 
								product_con_entry_child_product_detail_deleted_status 		= 0 					
								AND product_con_entry_child_product_detail_product_brand_id='".$brand_id."'				
							 ORDER BY 
								product_con_entry_child_product_detail_id ASC";
	//echo $select_product;exit;
	$result_product1 		= mysql_query($select_product1);

	while($get_product1			=mysql_fetch_array($result_product1)){
		$arra_data[]=$get_product1;
	}
	
	return $arra_data;
}

	function insertProduct(){

		$product_code                   = trim($_POST['product_code']);
		$product_is_opp 				= isset($_POST['opp_product']) && $_POST['opp_product']  ? "1" : "0";
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

		$product_type_one				 = trim($_POST['product_type_one']);

		//Multi Contact

		$product_detail_raw_product_id    		= $_POST['product_detail_raw_product_id'];
		$product_detail_raw_product_require_line = $_POST['product_detail_raw_product_require_line'];
		
		$product_detail_raw_product_id1    		= $_POST['product_detail_raw_product_id1'];
		$product_detail_raw_product_require_line1 = $_POST['product_detail_raw_product_require_line1'];
		

		$request_fields 				= ((!empty($product_name)) && (!empty($product_brand_id)));

		//Added by AutorsMM
		if(isset($_POST['extra_length']) && $_POST['extra_length'] != "") {
			$extra_length = $_POST['extra_length'];
		} else {
			$extra_length = 0;
		}

		checkRequestFields($request_fields, PROJECT_PATH, "product/index.php?page=add&msg=5");

		$product_uniq_id				= generateUniqId();

		$ip								= getRealIpAddr();

		
		if(count($product_detail_raw_product_id1) > 0) {
			$with_opp = 1;
		} else {
			$with_opp = 0;
		}

		$insert_product 				= sprintf("INSERT INTO products  (product_uniq_id, product_code, product_is_opp, product_name, 

																		   product_brand_id, product_product_category_id, product_type,

																		   product_product_uom_id,product_product_colour_id,product_extra_length,product_feet_qty,

																		   product_meter_qty,product_mm_qty,product_inches_qty,

																		   product_active_status,product_added_by,product_added_on,

																		   product_added_ip,product_company_id,product_thick_ness,
																		   product_production_type,product_purchase_uom_id,product_type_one,product_with_opp) 

																VALUES 	 ('%s', '%s', '%d', '%s', 

																		  '%d', '%d', '%d', 

																		  '%d', '%d', '%f', '%f',

																		  '%f', '%f', '%f',

																		  '%s', '%d',  UNIX_TIMESTAMP(NOW()),

																		  '%s', '%d', '%f',
																		  '%d', '%d','%d','%d')", 

																		   $product_uniq_id, $product_code, $product_is_opp, $product_name, 

																		   $product_brand_id, $product_product_category_id, $product_type,

																		   $product_product_uom_id,$product_product_colour_id,$extra_length,$product_feet_qty,

																		   $product_meter_qty,$product_mm_qty,$product_inches_qty,

																		   $product_active_status,$_SESSION[SESS.'_session_user_id'],

																		   $ip, $_SESSION[SESS.'_session_company_id'],$product_thick_ness,
																		   $product_production_type,$product_purchase_uom_id,$product_type_one,$with_opp); 

		mysql_query($insert_product) or die(mysql_error());

		$product_id 					= mysql_insert_id(); 

		for($i=0; $i<count($product_detail_raw_product_id); $i++) {

				$pro_id=explode('~',$product_detail_raw_product_id[$i]);

			if((!empty($pro_id[0]))) {

				 $insert_product_detail = "INSERT INTO product_details (product_detail_product_id,
				 														product_detail_raw_product_id,product_detail_mother_child_type,
																		product_detail_added_by,product_detail_added_on,product_detail_added_ip,
																		product_detail_raw_product_require_line) 

																 VALUES ('".$product_id."','".$pro_id[0]."','".$pro_id[1]."',
																		'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."',
																		'".$product_detail_raw_product_require_line[$i]."')"; 

				 mysql_query($insert_product_detail); 

		   }

		} 
		
		for($i=0; $i<count($product_detail_raw_product_id1); $i++) {

		

			if((!empty($product_detail_raw_product_id1[$i]))) {

				 $insert_product_detail = "INSERT INTO product_details_one (product_detail_product_id1,product_detail_raw_product_id1,

																		product_detail_added_by,product_detail_added_on,product_detail_added_ip,
																		product_detail_raw_product_require_line1) 

																 VALUES ('".$product_id."','".$product_detail_raw_product_id1[$i]."',

																		'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."',
																		'".$product_detail_raw_product_require_line1[$i]."')"; 

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
									
									product_is_opp,

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
									
									product_is_opp,

									product_brand_id,
									
									product_extra_length,

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
									product_purchase_uom_id,
									product_type_one 

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

												product_thick_ness,brand_name,brand_id,

												product_uom_name ,product_detail_raw_product_require_line,
												product_code,product_name

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
											 LEFT JOIN

												brands
			
											 ON
			
												brand_id			= product_detail_raw_product_id	

											WHERE 

												product_detail_product_id 		= '".$product_id."'	 AND 

												product_detail_deleted_status 	= 0"; 
												
											//AND product_detail_mother_child_type =1
											//	echo $select_product_detail;exit;

		$result_product_detail 			= mysql_query($select_product_detail);

		

		// Filling up the array

		$data_product_detail  			= array();

		

		while ($record_product_detail 	= mysql_fetch_array($result_product_detail))

		{

		 $data_product_detail[] 		= $record_product_detail;

		}
		
				$select_product_detail1 			= "SELECT 

												product_detail_id,

												product_detail_raw_product_id,

												product_detail_product_id,

												brand_name,product_con_entry_child_product_detail_code as product_code,
												product_con_entry_child_product_detail_name as product_name ,

												product_uom_name ,product_detail_raw_product_require_line

											FROM 

												product_details

											LEFT JOIN

												product_con_entry_child_product_details

											ON

												product_con_entry_child_product_detail_id						= product_detail_raw_product_id

											LEFT JOIN

												product_uoms

											ON

												product_uom_id					= product_con_entry_child_product_detail_uom_id 
											 LEFT JOIN

												brands
			
											 ON
			
												brand_id			= product_con_entry_child_product_detail_product_brand_id 	

											WHERE 

												product_detail_product_id 		= '".$product_id."'	 AND 

												product_detail_deleted_status 	= 0 AND product_detail_mother_child_type =2"; 

		$result_product_detail1			= mysql_query($select_product_detail1);

		

		while ($record_product_detail1 	= mysql_fetch_array($result_product_detail1))

		{

		 $data_product_detail[] 		= $record_product_detail1;

		}

		return $data_product_detail;

   }
   
   function editProductDetails(){

		$product_id 					= getId('products', 'product_id', 'product_uniq_id', dataValidation($_GET['id'])); 

		$select_product_detail 			= "SELECT 

												product_details_id,

												product_detail_raw_product_id1,

												product_detail_product_id1,

												product_thick_ness,brand_name,

												product_uom_name ,product_detail_raw_product_require_line1

											FROM 

												product_details_one

											LEFT JOIN

												products

											ON

												product_id						= product_detail_raw_product_id1

											LEFT JOIN

												product_uoms

											ON

												product_uom_id					= product_product_uom_id 
											LEFT JOIN

												brands
			
											 ON
			
												brand_id			= product_brand_id 

											WHERE 

												product_detail_product_id1 		= '".$product_id."'	 AND 

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
		
		$product_is_opp 				= isset($_POST['opp_product']) && $_POST['opp_product']  ? "1" : "0";

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
		$product_type_one				= trim($_POST['product_type_one']);
		$product_detail_id      		= $_POST['product_detail_id'];

		$product_detail_raw_product_id  = $_POST['product_detail_raw_product_id'];
		$product_detail_raw_product_require_line  = $_POST['product_detail_raw_product_require_line'];
		
		$product_details_id      		= $_POST['product_details_id'];

		$product_detail_raw_product_id1  = $_POST['product_detail_raw_product_id1'];
		$product_detail_raw_product_require_line1  = $_POST['product_detail_raw_product_require_line1'];

		$request_fields 				= ((!empty($product_name)) && (!empty($product_brand_id)));

		$product_active_status			= "active";
		
		//Added by AutorsMM
		if(isset($_POST['extra_length']) && $_POST['extra_length'] != "") {
			$extra_length = $_POST['extra_length'];
		} else {
			$extra_length = 0;
		}

		checkRequestFields($request_fields, PROJECT_PATH, "product/index.php?page=edit&id=".$product_uniq_id."&msg=5");
		
		if(count($product_detail_raw_product_id1) > 0) {
			$with_opp = 1;
		} else {
			$with_opp = 0;
		}

		$update_product 				= sprintf("	UPDATE 

															products 

														SET 

															product_name 					= '%s',
															product_code 					= '%s',
															product_is_opp 					= '%d',
															product_brand_id 				= '%d',
															product_product_category_id 	= '%d',
															product_type 					= '%d',
															product_product_uom_id 			= '%d',
															product_purchase_uom_id 		= '%d',
															product_product_colour_id 		= '%d',
															product_extra_length            = '%f',
															product_feet_qty 				= '%f',
															product_meter_qty 				= '%f',
															product_mm_qty 					= '%f',
															product_inches_qty 				= '%f',
															product_thick_ness 				= '%f',
															product_production_type			= '%d',
															product_type_one				= '%d',
															product_active_status 			= '%s',
															product_modified_by 			= '%d',
															product_modified_on 			= UNIX_TIMESTAMP(NOW()),
															product_modified_ip				= '%s',
															product_with_opp 				='%d'
														WHERE               
															product_id             			= '%d'", 
															$product_name,
															$product_code,
															$product_is_opp,
															$product_brand_id,
															$product_product_category_id,
															$product_type,
															$product_product_uom_id,
															$product_purchase_uom_id,
															$product_product_colour_id,
															$extra_length,
															$product_feet_qty,
															$product_meter_qty,
															$product_mm_qty,
															$product_inches_qty,
															$product_thick_ness,
															$product_production_type,
															$product_type_one,
															$product_active_status,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, $with_opp,
															$product_id); 

		mysql_query($update_product);
		for($i=0; $i<count($product_detail_raw_product_id1); $i++) {	

			if(!empty($product_detail_id[$i])) {
				$update_product_detail		=	"UPDATE 

													product_details 

												 SET 

													product_detail_raw_product_id        = '".$product_detail_raw_product_id[$i]."',
													 
													product_detail_raw_product_require_line        = '".$product_detail_raw_product_require_line[$i]."',
													
													product_detail_modified_by      = '".$_SESSION[SESS.'_session_user_id']."', 

													product_detail_modified_on      = UNIX_TIMESTAMP(NOW()), 

													product_detail_modified_ip      = '".$ip."' 

								  				WHERE 

													product_detail_id 				= '".$product_detail_id[$i]."'";

				mysql_query($update_product_detail);

			}else {	  

			if((!empty($product_detail_raw_product_id[$i]))) {

				 $insert_product_detail = "INSERT INTO product_details (product_detail_product_id,product_detail_raw_product_id,product_detail_raw_product_require_line,

																		product_detail_added_by,product_detail_added_on,product_detail_added_ip) 

																 VALUES ('".$product_id."','".$product_detail_raw_product_id[$i]."',
																 '".$product_detail_raw_product_require_line[$i]."',

																		'".$_SESSION[SESS.'_session_user_id']."',UNIX_TIMESTAMP(NOW()),'".$ip."')"; 

				 mysql_query($insert_product_detail); 

			}

		   }

		}
		
		for($i=0; $i<count($product_detail_raw_product_id1); $i++) {	

			if(!empty($product_details_id[$i])) {

				$update_product_detail		=	"UPDATE 

													product_details_one 

												 SET 

													product_detail_raw_product_id1        = '".$product_detail_raw_product_id1[$i]."',
													 
													product_detail_raw_product_require_line1        = '".$product_detail_raw_product_require_line1[$i]."',
													
													product_detail_modified_by      = '".$_SESSION[SESS.'_session_user_id']."', 

													product_detail_modified_on      = UNIX_TIMESTAMP(NOW()), 

													product_detail_modified_ip      = '".$ip."' 

								  				WHERE 

													product_details_id 				= '".$product_details_id[$i]."'";

				mysql_query($update_product_detail);

			}else {	  

			if((!empty($product_detail_raw_product_id[$i]))) {

				 $insert_product_detail = "INSERT INTO product_details_one (product_detail_product_id1,product_detail_raw_product_id1,product_detail_raw_product_require_line1,

																		product_detail_added_by,product_detail_added_on,product_detail_added_ip) 

																 VALUES ('".$product_id."','".$product_detail_raw_product_id1[$i]."',
																 '".$product_detail_raw_product_require_line1[$i]."',

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