<?php

	function insertQuotation(){

		$damage_entry_branch_id                   		= trim($_POST['damage_entry_branch_id']);
		$damage_entry_date                 				= NdateDatabaseFormat($_POST['damage_entry_date']);
		$damage_entry_type_id            				= trim($_POST['damage_entry_type_id']);
		$damage_entry_godown_id          				= trim($_POST['damage_entry_godown_id']);
		$damage_entry_production_entry_id     			= isset($_POST['damage_entry_production_entry_id'])?$_POST['damage_entry_production_entry_id']:'';

		//Product Detail
		$damage_entry_product_detail_product_type     	= $_POST['damage_entry_product_detail_product_type'];
		$damage_entry_product_detail_po_detail_id     	= isset($_POST['damage_entry_product_detail_po_detail_id'])?$_POST['damage_entry_product_detail_po_detail_id']:'';
		$damage_entry_product_detail_product_id     	= $_POST['damage_entry_product_detail_product_id'];
		$damage_entry_product_detail_product_color_id 	= $_POST['damage_entry_product_detail_product_color_id'];
		$damage_entry_product_detail_product_thick  	= isset($_POST['damage_entry_product_detail_product_thick'])?$_POST['damage_entry_product_detail_product_thick']:'';
		$damage_entry_product_detail_width_inches  		= isset($_POST['damage_entry_product_detail_width_inches'])?$_POST['damage_entry_product_detail_width_inches']:'';
		$damage_entry_product_detail_width_mm 			= isset($_POST['damage_entry_product_detail_width_mm'])?$_POST['damage_entry_product_detail_width_mm']:'';
		$damage_entry_product_detail_length_feet 		= isset($_POST['damage_entry_product_detail_length_feet'])?$_POST['damage_entry_product_detail_length_feet']:'';
		$damage_entry_product_detail_length_mm 			= isset($_POST['damage_entry_product_detail_length_mm'])?$_POST['damage_entry_product_detail_length_mm']:'';
		$damage_entry_product_detail_weight_tone		= isset($_POST['damage_entry_product_detail_weight_tone'])?$_POST['damage_entry_product_detail_weight_tone']:'';
		$damage_entry_product_detail_weight_kg			= isset($_POST['damage_entry_product_detail_weight_kg'])?$_POST['damage_entry_product_detail_weight_kg']:'';
		$damage_entry_product_detail_qty 				= isset($_POST['damage_entry_product_detail_qty'])?$_POST['damage_entry_product_detail_qty']:'';
		
		$damage_entry_product_detail_mother_child_type	= isset($_POST['damage_entry_product_detail_mother_child_type'])?$_POST['damage_entry_product_detail_mother_child_type']:'';
		

		

		

		$request_fields 									= ((!empty($damage_entry_branch_id)) && (!empty($damage_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "damage-entry/index.php?page=add&msg=5");

		$damage_entry_uniq_id							= generateUniqId();

		$ip													= getRealIpAddr();

		

		$select_damage_entry_no						= "SELECT 
																	MAX(damage_entry_no) AS maxval 
															   FROM 
																	damage_entry 
															   WHERE 
																	damage_entry_deleted_status 	= 0 												AND
																	damage_entry_branch_id 		= '".$damage_entry_branch_id."'						AND

																	damage_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND

																	damage_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_damage_entry_no 						= mysql_query($select_damage_entry_no);

		$record_damage_entry_no 						= mysql_fetch_array($result_damage_entry_no);	

		$maxval 											= $record_damage_entry_no['maxval']; 

		if($maxval > 0) {

			$damage_entry_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$damage_entry_no 							= substr(('00000'.++$maxval),-5);

		}

		

		$insert_damage_entry 						= sprintf("INSERT INTO damage_entry  (damage_entry_uniq_id, damage_entry_date,
																						  damage_entry_type_id,damage_entry_godown_id,
																						  damage_entry_production_entry_id, damage_entry_no,
																						  damage_entry_branch_id,damage_entry_added_by,
																						  damage_entry_added_on,damage_entry_added_ip,
																						  damage_entry_company_id,damage_entry_financial_year) 
																			VALUES 	 		 ('%s', '%s', 
																							  '%d', '%d', 
																							  '%d', '%s',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d' )", 
																		  	   		   		 $damage_entry_uniq_id, $damage_entry_date,
																					   		 $damage_entry_type_id,$damage_entry_godown_id,
																					   		 $damage_entry_production_entry_id,$damage_entry_no,
																					   		 $damage_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	$ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year']);  

		mysql_query($insert_damage_entry);


		$damage_entry_id 						= mysql_insert_id(); 

		

		

		for($i = 0; $i < count($damage_entry_product_detail_product_id); $i++) { 
		// echo $damage_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($damage_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$damage_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_damage_entry_product_detail 		= sprintf("INSERT INTO damage_entry_product_details 
																				(damage_entry_product_detail_uniq_id,
																				 damage_entry_product_detail_damage_entry_id,
																				 damage_entry_product_detail_po_detail_id,
																				 damage_entry_product_detail_po_entry_id,
																				 damage_entry_product_detail_product_id,
																				 damage_entry_product_detail_product_color_id,
																				 damage_entry_product_detail_product_type,
																				 damage_entry_product_detail_product_thick,
																				 damage_entry_product_detail_width_inches,damage_entry_product_detail_width_mm,
																				 damage_entry_product_detail_length_feet,damage_entry_product_detail_length_mm,
																				 damage_entry_product_detail_weight_tone,damage_entry_product_detail_weight_kg,
																				 damage_entry_product_detail_qty,
																				 damage_entry_product_detail_added_by, damage_entry_product_detail_added_on,
																				 damage_entry_product_detail_added_ip,
																				 damage_entry_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f',  
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d' )", 
																		 $damage_entry_product_detail_uniq_id,$damage_entry_id,
																		 $damage_entry_product_detail_po_detail_id[$i],$damage_entry_production_entry_id,
																		 $damage_entry_product_detail_product_id[$i],
																		 $damage_entry_product_detail_product_color_id[$i],
																		 $damage_entry_product_detail_product_type[$i],
																		 $damage_entry_product_detail_product_thick[$i],
																		 $damage_entry_product_detail_width_inches[$i],
																		 $damage_entry_product_detail_width_mm[$i],
																		 $damage_entry_product_detail_length_feet[$i],
																		 $damage_entry_product_detail_length_mm[$i],
																		 $damage_entry_product_detail_weight_tone[$i],
																		 $damage_entry_product_detail_weight_kg[$i],
																		 $damage_entry_product_detail_qty[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $damage_entry_product_detail_mother_child_type[$i]);
																		 //echo $insert_damage_entry_product_detail; exit;
				mysql_query($insert_damage_entry_product_detail);
			}
		}
		pageRedirection("damage-entry/index.php?page=add&msg=1");
		
	}

	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND damage_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND damage_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		$select_damage_entry		=	"SELECT 

												damage_entry_id,

												damage_entry_uniq_id,

												damage_entry_no,

												damage_entry_date,

												damage_entry_godown_id,
												damage_entry_type_id

											 FROM 

												damage_entry


											 WHERE 

												damage_entry_deleted_status 	= 	0 $where									

											 ORDER BY 

												damage_entry_no ASC";

		$result_damage_entry		= mysql_query($select_damage_entry);

		// Filling up the array

		$damage_entry_data 		= array();

		while ($record_damage_entry = mysql_fetch_array($result_damage_entry))

		{

		 $damage_entry_data[] 	= $record_damage_entry;

		}

		return $damage_entry_data;

	}

	function editQuotation(){

		$damage_entry_id 			= getId('damage_entry', 'damage_entry_id', 'damage_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_damage_entry		=	"SELECT 

												damage_entry_uniq_id,  damage_entry_date,

												damage_entry_type,damage_entry_godown_id,

												damage_entry_type_id,

												damage_entry_production_entry_id, damage_entry_no,

												damage_entry_branch_id,damage_entry_id

											 FROM 

												damage_entry 

											 WHERE 

												damage_entry_deleted_status 	=  0 			AND 

												damage_entry_id				= '".$damage_entry_id."'

											 ORDER BY 

												damage_entry_no ASC";

		$result_damage_entry 		= mysql_query($select_damage_entry);

		$record_damage_entry 		= mysql_fetch_array($result_damage_entry);

		return $record_damage_entry;

	}

	function editSalesdetail(){

		$damage_entry_id 			= getId('damage_entry', 'damage_entry_id', 'damage_entry_uniq_id', dataValidation($_GET['id'])); 

		$production_entry_id 	= getId('damage_entry', 'damage_entry_production_entry_id', 'damage_entry_uniq_id', dataValidation($_GET['id'])); 

			 $select_damage_entry		=	"SELECT 

													production_entry_no,

													production_entry_date,

													production_entry_type

												 FROM 

													production_entry 

												 WHERE 

													production_entry_deleted_status 	=  0 						AND 

													production_entry_id					= '".$production_entry_id."'

												 ORDER BY 

													production_entry_no ASC";

		

		$result_damage_entry 		= mysql_query($select_damage_entry);

		$record_damage_entry 		= mysql_fetch_array($result_damage_entry);

		return $record_damage_entry;

	}

	function editQuotationProductDetail()

	{

		$damage_entry_id 	= getId('damage_entry', 'damage_entry_id', 'damage_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_damage_entry_product_detail 	= "	SELECT 
														damage_entry_product_detail_id,
														damage_entry_product_detail_product_id,
														damage_entry_product_detail_width_inches,damage_entry_product_detail_width_mm,
														
														damage_entry_product_detail_length_mm,
														
														damage_entry_product_detail_po_detail_id,damage_entry_product_detail_qty,
														damage_entry_product_detail_product_thick,
														product_name,
														product_code,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														product_con_entry_osf_uom_ton,
														p_uom.product_uom_name as p_uom_name,
														child_uom.product_uom_name as c_uom_name,
														p_clr.product_colour_name as p_colour_name,
														c_clr.product_colour_name as c_colour_name,
														damage_entry_product_detail_product_type,
														damage_entry_product_detail_length_feet,
														damage_entry_product_detail_weight_tone,
														damage_entry_product_detail_weight_kg,
														c_bnd.brand_name as  c_brand_name,
														p_bnd.brand_name as  p_brand_name
													FROM 
														damage_entry_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 												= damage_entry_product_detail_product_id
													LEFT JOIN 
														brands AS p_bnd 
													ON 
														p_bnd.brand_id 											= product_brand_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= damage_entry_product_detail_product_id
													LEFT JOIN 
															brands AS c_bnd
													 ON 
															c_bnd.brand_id 											= product_con_entry_child_product_detail_product_brand_id		
													LEFT JOIN 
														product_uoms as p_uom
													ON 
														p_uom.product_uom_id 									= product_product_uom_id
													LEFT JOIN 
														product_uoms as  child_uom
													ON 
														child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
													LEFT JOIN 
														product_colours as p_clr 
													ON 
														p_clr.product_colour_id 								= product_con_entry_child_product_detail_color_id
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= product_con_entry_child_product_detail_color_id
														
													WHERE 
														damage_entry_product_detail_deleted_status		 	= 0 							AND 
														damage_entry_product_detail_damage_entry_id 		= '".$damage_entry_id."'";
		$result_damage_entry_product_detail 	= mysql_query($select_damage_entry_product_detail);
		$count_damage_entry 					= mysql_num_rows($result_damage_entry_product_detail);
		$arr_damage_entry_product_detail 		= array();
		while($record_damage_entry_product_detail = mysql_fetch_array($result_damage_entry_product_detail)) {
			$arr_damage_entry_product_detail[] = $record_damage_entry_product_detail;
		}
		return $arr_damage_entry_product_detail;

	}

	



	function updateQuotation(){

		$damage_entry_id                   						= trim($_POST['damage_entry_id']);

		$damage_entry_uniq_id                						= trim($_POST['damage_entry_uniq_id']);

		$damage_entry_branch_id                   			= trim($_POST['damage_entry_branch_id']);

		$damage_entry_date                 				= NdateDatabaseFormat($_POST['damage_entry_date']);

		$damage_entry_type            	= trim($_POST['damage_entry_type']);

		$damage_entry_godown_id          				= trim($_POST['damage_entry_godown_id']);

		$damage_entry_to_godown_id      					= trim($_POST['damage_entry_to_godown_id']);

		$damage_entry_type     							= trim($_POST['damage_entry_type']);

		$damage_entry_production_entry_id     				= trim($_POST['damage_entry_production_entry_id']);

		

		//Product Detail
		$damage_entry_product_detail_id     			= $_POST['damage_entry_product_detail_id'];
		$damage_entry_product_detail_product_type     	= $_POST['damage_entry_product_detail_product_type'];
		$damage_entry_product_detail_po_detail_id     	= isset($_POST['damage_entry_product_detail_po_detail_id'])?$_POST['damage_entry_product_detail_po_detail_id']:'';
		$damage_entry_product_detail_product_id     	= $_POST['damage_entry_product_detail_product_id'];
		$damage_entry_product_detail_product_color_id 	= $_POST['damage_entry_product_detail_product_color_id'];
		$damage_entry_product_detail_product_thick  	= isset($_POST['damage_entry_product_detail_product_thick'])?$_POST['damage_entry_product_detail_product_thick']:'';
		$damage_entry_product_detail_width_inches  		= isset($_POST['damage_entry_product_detail_width_inches'])?$_POST['damage_entry_product_detail_width_inches']:'';
		$damage_entry_product_detail_width_mm 			= isset($_POST['damage_entry_product_detail_width_mm'])?$_POST['damage_entry_product_detail_width_mm']:'';
		$damage_entry_product_detail_length_feet 		= isset($_POST['damage_entry_product_detail_length_feet'])?$_POST['damage_entry_product_detail_length_feet']:'';
		$damage_entry_product_detail_length_mm 			= isset($_POST['damage_entry_product_detail_length_mm'])?$_POST['damage_entry_product_detail_length_mm']:'';
		$damage_entry_product_detail_weight_tone		= isset($_POST['damage_entry_product_detail_weight_tone'])?$_POST['damage_entry_product_detail_weight_tone']:'';
		$damage_entry_product_detail_weight_kg			= isset($_POST['damage_entry_product_detail_weight_kg'])?$_POST['damage_entry_product_detail_weight_kg']:'';
		$damage_entry_product_detail_qty 				= isset($_POST['damage_entry_product_detail_qty'])?$_POST['damage_entry_product_detail_qty']:'';

		$damage_entry_product_detail_mother_child_type 	= isset($_POST['damage_entry_product_detail_mother_child_type'])?$_POST['damage_entry_product_detail_mother_child_type']:'';

		

		$request_fields 						= ((!empty($damage_entry_branch_id)) && (!empty($damage_entry_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "damage-entry/index.php?page=edit&id=$damage_entry_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 

															damage_entry 

														SET 

															damage_entry_branch_id 					= '%d',

															damage_entry_date 						= '%s',

															damage_entry_type 		= '%d',

															damage_entry_godown_id 				= '%d',

															damage_entry_to_godown_id 				= '%d',

															damage_entry_type 						= '%s',

															damage_entry_modified_by 				= '%d',

															damage_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),

															damage_entry_modified_ip				= '%s'

														WHERE               

															damage_entry_id         				= '%d'", 

															$damage_entry_branch_id,

															$damage_entry_date,

															$damage_entry_type,

															$damage_entry_godown_id,

															$damage_entry_to_godown_id,

															$damage_entry_type,

															$_SESSION[SESS.'_session_user_id'], 

															$ip, 

															$damage_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);
		for($i = 0; $i < count($damage_entry_product_detail_product_id); $i++) { 
		// echo $damage_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($damage_entry_product_detail_product_id[$i])) );
			if($detail_request_fields) {
			
				if(isset($damage_entry_product_detail_id[$i]) && (!empty($damage_entry_product_detail_id[$i]))) {

					 $update_damage_entry_product_detail = sprintf("UPDATE 
																			damage_entry_product_details 
																		SET  
																			damage_entry_product_detail_width_inches  			= '%f',
																			damage_entry_product_detail_width_mm  				= '%f',
																			
																			damage_entry_product_detail_length_feet  			= '%f',
																			damage_entry_product_detail_length_mm  				= '%f',
																			damage_entry_product_detail_weight_tone  			= '%f',
																			damage_entry_product_detail_weight_kg  				= '%f',
																			damage_entry_product_detail_qty  					= '%f',
																			damage_entry_product_detail_mother_child_type		= '%d',
																			damage_entry_product_detail_modified_by 			= '%d',
																			damage_entry_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			damage_entry_product_detail_modified_ip 			= '%s'
																		WHERE 
																			damage_entry_product_detail_damage_entry_id 		= '%d' AND 
																			damage_entry_product_detail_id 						= '%d'",
																			$damage_entry_product_detail_width_inches[$i],
																			$damage_entry_product_detail_width_mm[$i],
																			
																			$damage_entry_product_detail_length_feet[$i],
																			$damage_entry_product_detail_length_mm[$i],
																			$damage_entry_product_detail_weight_tone[$i],
																			$damage_entry_product_detail_weight_kg[$i],
																			$damage_entry_product_detail_qty[$i],
																			$damage_entry_product_detail_mother_child_type[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$damage_entry_id, 
																			$damage_entry_product_detail_id[$i]);	
			//	echo $update_damage_entry_product_detail; exit;
					mysql_query($update_damage_entry_product_detail);

				} else {
				$damage_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_damage_entry_product_detail 		= sprintf("INSERT INTO damage_entry_product_details 
																				(damage_entry_product_detail_uniq_id,damage_entry_product_detail_damage_entry_id,
																				 damage_entry_product_detail_po_detail_id,damage_entry_product_detail_po_entry_id,
																				 damage_entry_product_detail_product_id,damage_entry_product_detail_product_color_id,
																				 damage_entry_product_detail_product_type, damage_entry_product_detail_product_thick,
																				 damage_entry_product_detail_width_inches,damage_entry_product_detail_width_mm,
																				 damage_entry_product_detail_length_feet,damage_entry_product_detail_length_mm,
																				 damage_entry_product_detail_weight_tone,damage_entry_product_detail_weight_kg,
																				 damage_entry_product_detail_qty,
																				 damage_entry_product_detail_added_by, damage_entry_product_detail_added_on,
																				 damage_entry_product_detail_added_ip,
																				 damage_entry_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f',  
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d' )", 
																		 $damage_entry_product_detail_uniq_id,$damage_entry_id,
																		 $damage_entry_product_detail_po_detail_id[$i],$damage_entry_production_entry_id,
																		 $damage_entry_product_detail_product_id[$i],$damage_entry_product_detail_product_color_id[$i],
																		 $damage_entry_product_detail_product_type[$i], $damage_entry_product_detail_product_thick[$i],
																		 $damage_entry_product_detail_width_inches[$i],$damage_entry_product_detail_width_mm[$i],
																		 $damage_entry_product_detail_length_feet[$i],$damage_entry_product_detail_length_mm[$i],
																		 $damage_entry_product_detail_ton[$i],$damage_entry_product_detail_kg[$i],
																		 $damage_entry_product_detail_qty[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $damage_entry_product_detail_mother_child_type[$i]);	
		
				mysql_query($insert_damage_entry_product_detail);
			}
			}
		}
		

		// purchase order pproduct details

		pageRedirection("damage-entry/index.php?page=edit&id=$damage_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['damage_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$damage_entry_uniq_id = $_GET['damage_entry_uniq_id'];

			mysql_query("UPDATE damage_entry_product_details SET damage_entry_product_detail_deleted_status = 1 

						WHERE damage_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$damage_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('damage_entry', 'damage_entry_deleted_by', 'damage_entry_deleted_on' , 'damage_entry_deleted_ip','damage_entry_deleted_status', 'damage_entry_id', 'damage_entry_uniq_id', '1');

		

		deleteMultiRecords('damage_entry_product_details', 'damage_entry_product_detail_deleted_by', 'damage_entry_product_detail_deleted_on', 'damage_entry_product_detail_deleted_ip', 'damage_entry_product_detail_deleted_status', 'damage_entry_product_detail_damage_entry_id', 'damage_entry','damage_entry_id','damage_entry_uniq_id', '1');  



		

		pageRedirection("damage-entry/index.php?msg=7");				

	}

?>