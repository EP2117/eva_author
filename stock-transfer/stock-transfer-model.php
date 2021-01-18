<?php
	function insertQuotation(){

		$stock_transfer_branch_id                   		= trim($_POST['stock_transfer_branch_id']);
		$stock_transfer_date                 				= NdateDatabaseFormat($_POST['stock_transfer_date']);
		$stock_transfer_type            					= trim($_POST['stock_transfer_type']);
		$stock_transfer_from_godown_id          			= trim($_POST['stock_transfer_from_godown_id']);
		$stock_transfer_to_godown_id      					= trim($_POST['stock_transfer_to_godown_id']);
		$stock_transfer_type     							= trim($_POST['stock_transfer_type']);
		$stock_transfer_type_id     						= trim($_POST['stock_transfer_type_id']);
		$stock_transfer_production_order_id     		= isset($_POST['stock_transfer_production_order_id'])?$_POST['stock_transfer_production_order_id']:'';

		//Product Detail
		$stock_transfer_product_detail_product_type     = $_POST['stock_transfer_product_detail_product_type'];
		$stock_transfer_product_detail_po_detail_id     = isset($_POST['stock_transfer_product_detail_po_detail_id'])?$_POST['stock_transfer_product_detail_po_detail_id']:'';
		$stock_transfer_product_detail_product_id     	= $_POST['stock_transfer_product_detail_product_id'];
		$stock_transfer_product_detail_product_color_id = $_POST['stock_transfer_product_detail_product_color_id'];
		$stock_transfer_product_detail_product_thick  	= isset($_POST['stock_transfer_product_detail_product_thick'])?$_POST['stock_transfer_product_detail_product_thick']:'';
		$stock_transfer_product_detail_width_inches  	= isset($_POST['stock_transfer_product_detail_width_inches'])?$_POST['stock_transfer_product_detail_width_inches']:'';
		$stock_transfer_product_detail_width_mm 		= isset($_POST['stock_transfer_product_detail_width_mm'])?$_POST['stock_transfer_product_detail_width_mm']:'';
		$stock_transfer_product_detail_length_feet 		= isset($_POST['stock_transfer_product_detail_length_feet'])?$_POST['stock_transfer_product_detail_length_feet']:'';
		$stock_transfer_product_detail_length_meter 	= isset($_POST['stock_transfer_product_detail_length_meter'])?$_POST['stock_transfer_product_detail_length_meter']:'';
		$stock_transfer_product_detail_qty 			  	= $_POST['stock_transfer_product_detail_qty'];
		$stock_transfer_product_detail_tot_length 		= isset($_POST['stock_transfer_product_detail_tot_length'])?$_POST['stock_transfer_product_detail_tot_length']:'';
		$stock_transfer_product_detail_weight_tone 		= isset($_POST['stock_transfer_product_detail_weight_tone'])?$_POST['stock_transfer_product_detail_weight_tone']:'';
		$stock_transfer_product_detail_weight_kg 		= isset($_POST['stock_transfer_product_detail_weight_kg'])?$_POST['stock_transfer_product_detail_weight_kg']:'';
		$stock_transfer_product_detail_osf_uom_ton 		= isset($_POST['stock_transfer_product_detail_osf_uom_ton'])?$_POST['stock_transfer_product_detail_osf_uom_ton']:'';
		$stock_transfer_product_detail_mother_chile_type = isset($_POST['stock_transfer_product_detail_mother_chile_type'])?$_POST['stock_transfer_product_detail_mother_chile_type']:'';
		
		$request_fields 								= ((!empty($stock_transfer_branch_id)) && (!empty($stock_transfer_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "stock-transfer/index.php?page=add&msg=5");
		$stock_transfer_uniq_id							= generateUniqId();
		$ip												= getRealIpAddr();

		

		$select_stock_transfer_no						= "SELECT 

																	MAX(stock_transfer_no) AS maxval 

															   FROM 

																	stock_transfer 

															   WHERE 

																	stock_transfer_deleted_status 	= 0 												AND
																	stock_transfer_branch_id 		= '".$stock_transfer_branch_id."'						AND
																	stock_transfer_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND
																	stock_transfer_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_stock_transfer_no 						= mysql_query($select_stock_transfer_no);

		$record_stock_transfer_no 						= mysql_fetch_array($result_stock_transfer_no);	

		$maxval 											= $record_stock_transfer_no['maxval']; 

		if($maxval > 0) {

			$stock_transfer_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$stock_transfer_no 							= substr(('00000'.++$maxval),-5);

		}

		

		

		$insert_stock_transfer 					= sprintf("INSERT INTO stock_transfer  (stock_transfer_uniq_id, stock_transfer_date,

																					  		  stock_transfer_type,stock_transfer_from_godown_id,

																					   		  stock_transfer_to_godown_id,

																					   		  stock_transfer_production_order_id, stock_transfer_no,

																					  		  stock_transfer_branch_id,stock_transfer_added_by,

																					   		  stock_transfer_added_on,stock_transfer_added_ip,

																			   		   		  stock_transfer_company_id,stock_transfer_financial_year,
																							  stock_transfer_type_id) 

																			VALUES 	 		 ('%s', '%s', 

																							  '%d', '%d', 

																							  '%d', 

																							  '%d', '%s',

																							  '%d', '%d', 

																							   UNIX_TIMESTAMP(NOW()),

																							  '%s', '%d', '%d', '%d' )", 

																		  	   		   		 $stock_transfer_uniq_id, $stock_transfer_date,

																					   		 $stock_transfer_type,$stock_transfer_from_godown_id,

																					   		 $stock_transfer_to_godown_id,

																					   		 $stock_transfer_production_order_id,$stock_transfer_no,

																					   		 $stock_transfer_branch_id,$_SESSION[SESS.'_session_user_id'],

																			   		     	$ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							$stock_transfer_type_id);  

		mysql_query($insert_stock_transfer);


		$stock_transfer_id 						= mysql_insert_id(); 

		

		

		for($i = 0; $i < count($stock_transfer_product_detail_product_id); $i++) { 
		// echo $stock_transfer_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($stock_transfer_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$stock_transfer_product_detail_uniq_id 	= generateUniqId();
				$insert_stock_transfer_product_detail 		= sprintf("INSERT INTO stock_transfer_product_details 
																				(stock_transfer_product_detail_uniq_id,stock_transfer_product_detail_stock_transfer_id,
																				 stock_transfer_product_detail_po_detail_id,stock_transfer_product_detail_po_entry_id,
																				 stock_transfer_product_detail_product_id,stock_transfer_product_detail_product_color_id,
																				 stock_transfer_product_detail_product_type, stock_transfer_product_detail_product_thick,
																				 stock_transfer_product_detail_width_inches,stock_transfer_product_detail_width_mm,
																				 stock_transfer_product_detail_length_feet,stock_transfer_product_detail_length_meter,
																				 stock_transfer_product_detail_weight_tone,stock_transfer_product_detail_weight_kg,
																				 stock_transfer_product_detail_qty,stock_transfer_product_detail_tot_length,
																				 stock_transfer_product_detail_added_by, stock_transfer_product_detail_added_on,
																				 stock_transfer_product_detail_added_ip,
																				 stock_transfer_product_detail_mother_chile_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d' )", 
																		 $stock_transfer_product_detail_uniq_id,$stock_transfer_id,
																		 $stock_transfer_product_detail_po_detail_id[$i],$stock_transfer_production_order_id,
																		 $stock_transfer_product_detail_product_id[$i],$stock_transfer_product_detail_product_color_id[$i],
																		 $stock_transfer_product_detail_product_type[$i], $stock_transfer_product_detail_product_thick[$i],
																		 $stock_transfer_product_detail_width_inches[$i],$stock_transfer_product_detail_width_mm[$i],
																		 $stock_transfer_product_detail_length_feet[$i],$stock_transfer_product_detail_length_meter[$i],
																		 $stock_transfer_product_detail_weight_tone[$i],$stock_transfer_product_detail_weight_kg[$i],
																		 $stock_transfer_product_detail_qty[$i],$stock_transfer_product_detail_tot_length[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $stock_transfer_product_detail_mother_chile_type[$i]);
																		 //echo $insert_stock_transfer_product_detail; exit;
				mysql_query($insert_stock_transfer_product_detail);
				
					$detail_id			= mysql_insert_id();
					$produt_id											=	$stock_transfer_product_detail_product_id[$i];
					$product_colour_id									=	$stock_transfer_product_detail_product_color_id[$i];
					$product_thick										=	$stock_transfer_product_detail_product_thick[$i];
					$width_inches										= 	$stock_transfer_product_detail_width_inches[$i];
					$width_mm											= 	$stock_transfer_product_detail_width_mm[$i];
					$length_feet										= 	$stock_transfer_product_detail_length_feet[$i];
					$length_meter										= 	$stock_transfer_product_detail_length_meter[$i];
					$child_type 										=   $stock_transfer_product_detail_mother_chile_type[$i];
					
					if($stock_transfer_type_id==1){ //echo 88454;exit;
						$rec_product									= 	Child_prod_detail($produt_id);
						$brand_id										= 	$rec_product['product_con_entry_child_product_detail_product_brand_id'];
						if(!empty($stock_transfer_product_detail_osf_uom_ton[$i])){
							$total_ton										=  	$stock_transfer_product_detail_osf_uom_ton[$i]; 
						}else{
							$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,''); 
						}
						$ton_qty										= 	$total_ton*$length_feet;
						$kg_qty											= 	$ton_qty*1000;
					}else{
						$ton_qty										= 	$stock_transfer_product_detail_weight_tone[$i];
						$kg_qty											= 	$stock_transfer_product_detail_weight_kg[$i];
						$rec_product									= 	Child_prod_detail($produt_id);
						$brand_id										= 	$rec_product['product_con_entry_child_product_detail_product_brand_id'];
						$product_type									= 	($rec_product['stock_transfer_type_id']==1)?3:2;
						if(!empty($stock_transfer_product_detail_osf_uom_ton[$i])){
							$total_ton									=  	$stock_transfer_product_detail_osf_uom_ton[$i]; 
						}else{
							$total_ton									=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
						}
						$length_feet									= 	($stock_transfer_product_detail_length_feet[$i]/$total_ton);
						
						$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
						$length_meter									= 	$product_cal['3'];
					}
					//echo $length_feet; exit;
					$product_detail_qty									= 	(-1*$stock_transfer_product_detail_qty[$i]);
					$stock_ledger_entry_type							= 	"stock-transfer";
					$product_con_entry_godown_id						= 	"1";
					$prd_type											= ($stock_transfer_type==1)?'3':'2';
					if($stock_transfer_type_id==4){ 
						$width_inches										=   "1";
						$width_mm											=   "1";
						$product_colour_id									= 	"1";
						$product_thick										= 	"1";
						$length_feet										= 	"1";
						$length_meter										= 	"1";
						$ton_qty											= 	"1";
						$kg_qty												= 	"1";
						$prd_type											= 	"1";
					} //echo $prd_type;exit;
					stockLedger($child_type,'out',$stock_transfer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $stock_transfer_branch_id,  $stock_transfer_from_godown_id, $stock_transfer_date, $stock_transfer_no,$stock_ledger_entry_type, $prd_type,$width_inches,$width_mm,$product_colour_id,$product_thick);
					$product_detail_qty									= 	$stock_transfer_product_detail_qty[$i];
					stockLedger($child_type,'in',$stock_transfer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $stock_transfer_branch_id,  $stock_transfer_to_godown_id, $stock_transfer_date, $stock_transfer_no,$stock_ledger_entry_type, $prd_type,$width_inches,$width_mm,$product_colour_id,$product_thick);
					
			}
		}
		
		pageRedirection("stock-transfer/index.php?page=add&msg=1");
		
	}

	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND stock_transfer_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND stock_transfer_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		
		$select_stock_transfer		=	"SELECT 

												stock_transfer_id,

												stock_transfer_uniq_id,

												stock_transfer_no,

												stock_transfer_date,

												stock_transfer_from_godown_id,
												stock_transfer_type_id

											 FROM 

												stock_transfer


											 WHERE 

												stock_transfer_deleted_status 	= 	0	 $where								

											 ORDER BY 

												stock_transfer_no ASC";

		$result_stock_transfer		= mysql_query($select_stock_transfer);

		// Filling up the array

		$stock_transfer_data 		= array();

		while ($record_stock_transfer = mysql_fetch_array($result_stock_transfer)){
		 $stock_transfer_data[] 	= $record_stock_transfer;

		}

		return $stock_transfer_data;

	}

	function editQuotation(){

		$stock_transfer_id 			= getId('stock_transfer', 'stock_transfer_id', 'stock_transfer_uniq_id', dataValidation($_GET['id'])); 

		$select_stock_transfer		=	"SELECT 

												stock_transfer_uniq_id,  stock_transfer_date,

												stock_transfer_type,stock_transfer_from_godown_id,

												stock_transfer_to_godown_id,stock_transfer_type,

												stock_transfer_production_order_id, stock_transfer_no,

												stock_transfer_branch_id,stock_transfer_id,
												stock_transfer_type_id

											 FROM 

												stock_transfer 

											 WHERE 

												stock_transfer_deleted_status 	=  0 			AND 

												stock_transfer_id				= '".$stock_transfer_id."'

											 ORDER BY 

												stock_transfer_no ASC";

		$result_stock_transfer 		= mysql_query($select_stock_transfer);

		$record_stock_transfer 		= mysql_fetch_array($result_stock_transfer);

		return $record_stock_transfer;

	}

	function editSalesdetail(){

		$stock_transfer_id 			= getId('stock_transfer', 'stock_transfer_id', 'stock_transfer_uniq_id', dataValidation($_GET['id'])); 

		$production_order_id 	= getId('stock_transfer', 'stock_transfer_production_order_id', 'stock_transfer_uniq_id', dataValidation($_GET['id'])); 

			$select_stock_transfer		=	"SELECT 

													production_order_no,

													production_order_date,

													production_order_type

												 FROM 

													production_order 

												 WHERE 

													production_order_deleted_status 	=  0 						AND 

													production_order_id					= '".$production_order_id."'

												 ORDER BY 

													production_order_no ASC";

		

		$result_stock_transfer 		= mysql_query($select_stock_transfer);

		$record_stock_transfer 		= mysql_fetch_array($result_stock_transfer);

		return $record_stock_transfer;

	}

	function editQuotationProductDetail()

	{

		$stock_transfer_id 	= getId('stock_transfer', 'stock_transfer_id', 'stock_transfer_uniq_id', dataValidation($_GET['id'])); 

		 $select_stock_transfer_product_detail 	= "	SELECT 
														stock_transfer_product_detail_id,
														stock_transfer_product_detail_product_id,
														stock_transfer_product_detail_width_inches,stock_transfer_product_detail_width_mm,
														
														stock_transfer_product_detail_length_feet,stock_transfer_product_detail_length_meter,
														
														
														stock_transfer_product_detail_po_detail_id,stock_transfer_product_detail_qty,
														stock_transfer_product_detail_product_thick,
														stock_transfer_product_detail_product_color_id,
														product_name,
														product_code,
														product_con_entry_child_product_detail_code,
														product_con_entry_child_product_detail_name,
														p_uom.product_uom_name as p_uom_name,
														child_uom.product_uom_name as c_uom_name,
														p_clr.product_colour_name as p_colour_name,
														c_clr.product_colour_name as c_colour_name,
														brand_name,stock_transfer_product_detail_product_type,
														stock_transfer_product_detail_tot_length ,
														stock_transfer_product_detail_weight_tone,product_brand_id,
														stock_transfer_product_detail_weight_kg,
														stock_transfer_product_detail_mother_chile_type
													FROM 
														stock_transfer_product_details 
													LEFT JOIN 
														products 
													ON 
														product_id 		= stock_transfer_product_detail_product_id
													LEFT JOIN 
														brands 
													ON 
														brand_id 												= product_brand_id
													LEFT JOIN 
														product_con_entry_child_product_details 
													ON 
														product_con_entry_child_product_detail_id				= stock_transfer_product_detail_product_id	
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
														p_clr.product_colour_id 								= product_product_colour_id
													LEFT JOIN 
														product_colours as c_clr 
													ON 
														c_clr.product_colour_id 								= product_con_entry_child_product_detail_color_id
														
													WHERE 
														stock_transfer_product_detail_deleted_status		 	= 0 							AND 
														stock_transfer_product_detail_stock_transfer_id 		= '".$stock_transfer_id."'";
		$result_stock_transfer_product_detail 	= mysql_query($select_stock_transfer_product_detail);
		$count_stock_transfer 					= mysql_num_rows($result_stock_transfer_product_detail);
		$arr_stock_transfer_product_detail 		= array();
		while($record_stock_transfer_product_detail = mysql_fetch_array($result_stock_transfer_product_detail)) {
			$arr_stock_transfer_product_detail[] = $record_stock_transfer_product_detail;
		}
		return $arr_stock_transfer_product_detail;

	}

	
	function updateQuotation(){

		$stock_transfer_id                   						= trim($_POST['stock_transfer_id']);
		
			$stock_transfer_no                   						= trim($_POST['stock_transfer_no']);
			
		$stock_transfer_uniq_id                						= trim($_POST['stock_transfer_uniq_id']);

		$stock_transfer_branch_id                   			= trim($_POST['stock_transfer_branch_id']);

		$stock_transfer_date                 				= NdateDatabaseFormat($_POST['stock_transfer_date']);

		$stock_transfer_type            	= trim($_POST['stock_transfer_type']);

		$stock_transfer_from_godown_id          				= trim($_POST['stock_transfer_from_godown_id']);

		$stock_transfer_to_godown_id      					= trim($_POST['stock_transfer_to_godown_id']);

		$stock_transfer_type_id            	= trim($_POST['stock_transfer_type_id']); 
		
		$stock_transfer_production_order_id     				= trim($_POST['stock_transfer_production_order_id']);

		

		//Product Detail
		$stock_transfer_product_detail_id     			= $_POST['stock_transfer_product_detail_id'];
		$stock_transfer_product_detail_product_type     = $_POST['stock_transfer_product_detail_product_type'];
		$stock_transfer_product_detail_po_detail_id     = isset($_POST['stock_transfer_product_detail_po_detail_id'])?$_POST['stock_transfer_product_detail_po_detail_id']:'';
		$stock_transfer_product_detail_product_id     	= $_POST['stock_transfer_product_detail_product_id'];
		$stock_transfer_product_detail_product_color_id = $_POST['stock_transfer_product_detail_product_color_id'];
		$stock_transfer_product_detail_product_thick  	= isset($_POST['stock_transfer_product_detail_product_thick'])?$_POST['stock_transfer_product_detail_product_thick']:'';
		$stock_transfer_product_detail_width_inches  	= isset($_POST['stock_transfer_product_detail_width_inches'])?$_POST['stock_transfer_product_detail_width_inches']:'';
		$stock_transfer_product_detail_width_mm 		= isset($_POST['stock_transfer_product_detail_width_mm'])?$_POST['stock_transfer_product_detail_width_mm']:'';
		$stock_transfer_product_detail_length_feet 		= isset($_POST['stock_transfer_product_detail_length_feet'])?$_POST['stock_transfer_product_detail_length_feet']:'';
		$stock_transfer_product_detail_length_meter 	= isset($_POST['stock_transfer_product_detail_length_meter'])?$_POST['stock_transfer_product_detail_length_meter']:'';
		$stock_transfer_product_detail_qty 			  	= $_POST['stock_transfer_product_detail_qty'];
		$stock_transfer_product_detail_tot_length 		= isset($_POST['stock_transfer_product_detail_tot_length'])?$_POST['stock_transfer_product_detail_tot_length']:'';
		$stock_transfer_product_detail_weight_tone 		= isset($_POST['stock_transfer_product_detail_weight_tone'])?$_POST['stock_transfer_product_detail_weight_tone']:'';
		$stock_transfer_product_detail_weight_kg 		= isset($_POST['stock_transfer_product_detail_weight_kg'])?$_POST['stock_transfer_product_detail_weight_kg']:'';
		$stock_transfer_product_detail_mother_chile_type 	= isset($_POST['stock_transfer_product_detail_mother_chile_type'])?$_POST['stock_transfer_product_detail_mother_chile_type']:'';
//echo "<pre>";
//print_r($stock_transfer_product_detail_mother_chile_type);exit;
		
	

		$request_fields 						= ((!empty($stock_transfer_branch_id)) && (!empty($stock_transfer_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "stock-transfer/index.php?page=edit&id=$stock_transfer_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 
															stock_transfer 
														SET 
															stock_transfer_branch_id 					= '%d',
															stock_transfer_date 						= '%s',
															stock_transfer_type 		= '%d',
															stock_transfer_from_godown_id 				= '%d',
															stock_transfer_to_godown_id 				= '%d',
															stock_transfer_type 						= '%s',
															stock_transfer_type_id 						= '%s',
															stock_transfer_modified_by 				= '%d',
															stock_transfer_modified_on 				= UNIX_TIMESTAMP(NOW()),
															stock_transfer_modified_ip				= '%s'
														WHERE               
															stock_transfer_id         				= '%d'", 
															$stock_transfer_branch_id,
															$stock_transfer_date,
															$stock_transfer_type,
															$stock_transfer_from_godown_id,
															$stock_transfer_to_godown_id,
															$stock_transfer_type,
															$stock_transfer_type_id,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$stock_transfer_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);
		for($i = 0; $i < count($stock_transfer_product_detail_product_id); $i++) { 
		// echo $stock_transfer_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($stock_transfer_product_detail_product_id[$i])) );
			if($detail_request_fields) {
			
				if(isset($stock_transfer_product_detail_id[$i]) && (!empty($stock_transfer_product_detail_id[$i]))) {//echo $stock_transfer_product_detail_product_id[$i];

					 $update_stock_transfer_product_detail = sprintf("UPDATE 
																			stock_transfer_product_details 
																		SET  
																			stock_transfer_product_detail_width_inches  		= '%f',
																			stock_transfer_product_detail_width_mm  			= '%f',
																			
																			stock_transfer_product_detail_length_feet  			= '%f',
																			stock_transfer_product_detail_length_meter  		= '%f',
																			
																			stock_transfer_product_detail_weight_tone		  	= '%f',
																			stock_transfer_product_detail_weight_kg				= '%f',
																			stock_transfer_product_detail_tot_length  			= '%f',
																			stock_transfer_product_detail_qty  					= '%f',
																			stock_transfer_product_detail_mother_chile_type		= '%d',
																			stock_transfer_product_detail_product_id    		= '%d',
																			stock_transfer_product_detail_product_color_id		= '%d',
																			stock_transfer_product_detail_modified_by 			= '%d',
																			stock_transfer_product_detail_modified_on 			= UNIX_TIMESTAMP(NOW()),
																			stock_transfer_product_detail_modified_ip 			= '%s'
																		WHERE 
																			stock_transfer_product_detail_stock_transfer_id 			= '%d' AND 
																			stock_transfer_product_detail_id 					= '%d'",
																			$stock_transfer_product_detail_width_inches[$i],
																			$stock_transfer_product_detail_width_mm[$i],
																			
																			$stock_transfer_product_detail_length_feet[$i],
																			$stock_transfer_product_detail_length_meter[$i],
																			
																			$stock_transfer_product_detail_weight_tone[$i],
																			$stock_transfer_product_detail_weight_kg[$i],
																			$stock_transfer_product_detail_tot_length[$i],
																			$stock_transfer_product_detail_qty[$i],
																			$stock_transfer_product_detail_mother_chile_type[$i],
																			$stock_transfer_product_detail_product_id[$i],
																			$stock_transfer_product_detail_product_color_id[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$stock_transfer_id, 
																			$stock_transfer_product_detail_id[$i]);	
			//echo $update_stock_transfer_product_detail; exit;
					mysql_query($update_stock_transfer_product_detail);
 $detail_id  = $stock_transfer_product_detail_id[$i];
				} else {
				$stock_transfer_product_detail_uniq_id 	= generateUniqId();
				$insert_stock_transfer_product_detail 		= sprintf("INSERT INTO stock_transfer_product_details 
																				(stock_transfer_product_detail_uniq_id,stock_transfer_product_detail_stock_transfer_id,
																				 stock_transfer_product_detail_po_detail_id,stock_transfer_product_detail_po_entry_id,
																				 stock_transfer_product_detail_product_id,stock_transfer_product_detail_product_color_id,
																				 stock_transfer_product_detail_product_type, stock_transfer_product_detail_product_thick,
																				 stock_transfer_product_detail_width_inches,stock_transfer_product_detail_width_mm,
																				 stock_transfer_product_detail_length_feet,stock_transfer_product_detail_length_meter,
																				 stock_transfer_product_detail_weight_tone,stock_transfer_product_detail_weight_kg,
																				 stock_transfer_product_detail_qty,stock_transfer_product_detail_tot_length,
																				 stock_transfer_product_detail_added_by, stock_transfer_product_detail_added_on,
																				 stock_transfer_product_detail_added_ip,
																				 stock_transfer_product_detail_mother_chile_type) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s','%d' )", 
																		 $stock_transfer_product_detail_uniq_id,$stock_transfer_id,
																		 $stock_transfer_product_detail_po_detail_id[$i],$stock_transfer_production_order_id,
																		 $stock_transfer_product_detail_product_id[$i],$stock_transfer_product_detail_product_color_id[$i],
																		 $stock_transfer_product_detail_product_type[$i], $stock_transfer_product_detail_product_thick[$i],
																		 $stock_transfer_product_detail_width_inches[$i],$stock_transfer_product_detail_width_mm[$i],
																		 $stock_transfer_product_detail_length_feet[$i],$stock_transfer_product_detail_length_meter[$i],
																		 $stock_transfer_product_detail_weight_tone[$i],$stock_transfer_product_detail_weight_kg[$i],
																		 $stock_transfer_product_detail_qty[$i],$stock_transfer_product_detail_tot_length[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $stock_transfer_product_detail_mother_chile_type[$i]);
																		 //echo $insert_stock_transfer_product_detail; exit;
				mysql_query($insert_stock_transfer_product_detail);
				
				
				 $detail_id  = mysql_insert_id();
				 
		
			}
			    
			       $produt_id											=	$stock_transfer_product_detail_product_id[$i];
					$product_colour_id									=	$stock_transfer_product_detail_product_color_id[$i];
					$product_thick										=	$stock_transfer_product_detail_product_thick[$i];
					$width_inches										= 	$stock_transfer_product_detail_width_inches[$i];
					$width_mm											= 	$stock_transfer_product_detail_width_mm[$i];
					$length_feet										= 	$stock_transfer_product_detail_length_feet[$i];
					$length_meter										= 	$stock_transfer_product_detail_length_meter[$i];
					$child_type 										=   $stock_transfer_product_detail_mother_chile_type[$i];
					
					if($stock_transfer_type_id==1){ //echo 88454;exit;
						$rec_product									= 	Child_prod_detail($produt_id);
						$brand_id										= 	$rec_product['product_con_entry_child_product_detail_product_brand_id'];
						if(!empty($stock_transfer_product_detail_osf_uom_ton[$i])){
							$total_ton										=  	$stock_transfer_product_detail_osf_uom_ton[$i]; 
						}else{
							$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,''); 
						}
						$ton_qty										= 	$total_ton*$length_feet;
						$kg_qty											= 	$ton_qty*1000;
					}
					else{
						$ton_qty										= 	$stock_transfer_product_detail_weight_tone[$i];
						$kg_qty											= 	$stock_transfer_product_detail_weight_kg[$i];
						$rec_product									= 	Child_prod_detail($produt_id);
						$brand_id										= 	$rec_product['product_con_entry_child_product_detail_product_brand_id'];
						$product_type									= 	($rec_product['stock_transfer_type_id']==1)?3:2;
						if(!empty($stock_transfer_product_detail_osf_uom_ton[$i])){
							$total_ton										=  	$stock_transfer_product_detail_osf_uom_ton[$i]; 
						}else{
							$total_ton										=  	GetTotallenWei($brand_id,$product_thick,$width_inches,'');
						}
						$length_feet									= 	($prn_entry_product_detail_sl_feet[$i]/$total_ton);
						
						$product_cal									=   explode("@",GetPdCalc('1',$length_feet));
						$length_meter									= 	$product_cal['3'];
					}
					
					$product_detail_qty									= 	(-1*$stock_transfer_product_detail_qty[$i]);
					$stock_ledger_entry_type							= 	"stock-transfer";
					$product_con_entry_godown_id						= 	"1";
					$prd_type											= ($stock_transfer_type==1)?'3':'2';
					if($stock_transfer_type_id==4){ 
						$width_inches										=   "1";
						$width_mm											=   "1";
						$product_colour_id									= 	"1";
						$product_thick										= 	"1";
						$length_feet										= 	"1";
						$length_meter										= 	"1";
						$ton_qty											= 	"1";
						$kg_qty												= 	"1";
						$prd_type											= 	"1";
					} //echo $prd_type;exit;
					stockLedger($child_type,'out',$stock_transfer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $stock_transfer_branch_id,  $stock_transfer_from_godown_id, $stock_transfer_date, $stock_transfer_no,$stock_ledger_entry_type, $prd_type,$width_inches,$width_mm,$product_colour_id,$product_thick);
					$product_detail_qty									= 	$stock_transfer_product_detail_qty[$i];
					stockLedger($child_type,'in',$stock_transfer_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $stock_transfer_branch_id,  $stock_transfer_to_godown_id, $stock_transfer_date, $stock_transfer_no,$stock_ledger_entry_type, $prd_type,$width_inches,$width_mm,$product_colour_id,$product_thick);
			}
		}
		
		         
		

		// purchase order pproduct details

		
		pageRedirection("stock-transfer/index.php?page=edit&id=$stock_transfer_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['stock_transfer_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$stock_transfer_uniq_id = $_GET['stock_transfer_uniq_id'];

			mysql_query("UPDATE stock_transfer_product_details SET stock_transfer_product_detail_deleted_status = 1 

						WHERE stock_transfer_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$stock_transfer_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('stock_transfer', 'stock_transfer_deleted_by', 'stock_transfer_deleted_on' , 'stock_transfer_deleted_ip','stock_transfer_deleted_status', 'stock_transfer_id', 'stock_transfer_uniq_id', '1');

		

		deleteMultiRecords('stock_transfer_product_details', 'stock_transfer_product_detail_deleted_by', 'stock_transfer_product_detail_deleted_on', 'stock_transfer_product_detail_deleted_ip', 'stock_transfer_product_detail_deleted_status', 'stock_transfer_product_detail_stock_transfer_id', 'stock_transfer','stock_transfer_id','stock_transfer_uniq_id', '1');  


				$checked      = $_POST['deleteCheck'];
				$count 		  = count($checked);
				for($i=0; $i < $count; $i++) 
				{ 
					$deleteCheck 					= $checked[$i];
					$select="SELECT * FROM stock_transfer WHERE stock_transfer_uniq_id='".$deleteCheck."'";
					$query=mysql_query($select);
					$result=mysql_fetch_array($query);
					  $update_cs_detail 	= "UPDATE  stock_ledger
														SET 
															stock_ledger_status    					= '1',
															stock_ledger_deleted_by    	   			= '".$_SESSION[SESS.'_session_user_id']."',
															stock_ledger_deleted_on 				= UNIX_TIMESTAMP(NOW()),
															stock_ledger_deleted_ip    				= '".$ip."'
													WHERE               
															stock_ledger_entry_type             	= 'stock-transfer' 											AND
															stock_ledger_entry_id					= '".$result['stock_transfer_id']."'						";
								mysql_query($update_cs_detail);
				}

		pageRedirection("stock-transfer/index.php?msg=7");				

	}

?>