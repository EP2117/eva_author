<?php
	function GetAutoNo($quotation_entry_branch_id ){
		$select_invoice_no = "SELECT MAX(SUBSTRING(quotation_entry_no,3,7)) AS maxval FROM quotation_entry 
								  WHERE quotation_entry_deleted_status =0
								  AND quotation_entry_branch_id = '".$quotation_entry_branch_id."'
								  AND quotation_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND quotation_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		$maxval 	=$record_invoice_no['maxval']; 

		if($maxval > 0) {

			$quotation_entry_no = substr(('00000'.++$maxval),-5);
//echo $quotation_entry_no;
		} else {

			$quotation_entry_no = substr(('00000'.++$maxval),-5);

		}
		return $quotation_entry_no;
	}
	function insertQuotation(){
	$select_branch	= "SELECT branch_prefix FROM branches WHERE  branch_id = '".$_POST['quotation_entry_branch_id']."' ";
	//echo $select_branch;
		$result_branch = mysql_query($select_branch);
		$res = mysql_fetch_array($result_branch); 
	
		$quotation_entry_no                   				= $res['branch_prefix'].GetAutoNo($_POST['quotation_entry_branch_id']); //echo $res['branch_prefix'];exit;
		//$quotation_entry_no							= empty($quotation_entry_no1)?$res['branch_prefix'].GetAutoNo($_POST['quotation_entry_no']):$quotation_entry_no1;
		$quotation_entry_branch_id                   		= trim($_POST['quotation_entry_branch_id']);
		$quotation_entry_type_id                   			= implode(",",$_POST['quotation_entry_type_id']);
		$quotation_entry_date                 				= NdateDatabaseFormat($_POST['quotation_entry_date']);
		$quotation_entry_customer_id            			= trim($_POST['quotation_entry_customer_id']);
		$quotation_entry_validity_date                 		= NdateDatabaseFormat($_POST['quotation_entry_validity_date']);
		$quotation_entry_gross_amount                 		= trim($_POST['quotation_entry_gross_amount']);
		$quotation_entry_transport_amount                 	= trim($_POST['quotation_entry_transport_amount']);
		$quotation_entry_tax_per                 			= trim($_POST['quotation_entry_tax_per']);
		$quotation_entry_tax_amount                 		= trim($_POST['quotation_entry_tax_amount']);
		$quotation_entry_advance_amount                		= trim($_POST['quotation_entry_advance_amount']);
		$quotation_entry_net_amount                 		= trim($_POST['quotation_entry_net_amount']);
		$quotation_entry_dis_per                 			= trim($_POST['quotation_entry_dis_per']);
		$quotation_entry_dis_amount                 		= trim($_POST['quotation_entry_dis_amount']);
		
		$request_fields 									= ((!empty($quotation_entry_branch_id)) && (!empty($quotation_entry_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "quotation-entry/index.php?page=add&msg=5");
		$quotation_entry_uniq_id							= generateUniqId();
		$ip													= getRealIpAddr();
		 $insert_quotation_entry 							= sprintf("INSERT INTO quotation_entry  (quotation_entry_uniq_id, quotation_entry_date,
																					  		  quotation_entry_customer_id,quotation_entry_validity_date,
																							  quotation_entry_gross_amount,quotation_entry_transport_amount,
																							  quotation_entry_tax_per,quotation_entry_tax_amount,
																							  quotation_entry_advance_amount,quotation_entry_net_amount,
																					   		  quotation_entry_no,quotation_entry_type_id,
																					  		  quotation_entry_branch_id,quotation_entry_added_by,
																					   		  quotation_entry_added_on,quotation_entry_added_ip,
																			   		   		  quotation_entry_company_id,quotation_entry_financial_year,
																							  quotation_entry_dis_amount,quotation_entry_dis_per) 
																			VALUES 	 		 ('%s', '%s',
																							  '%d', '%s', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%f', '%f', 
																							  '%s', '%s',
																							  '%d', '%d', 
																							   UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d','%f','%f')", 
																		  	   		   		 $quotation_entry_uniq_id, $quotation_entry_date,
																					   		 $quotation_entry_customer_id,$quotation_entry_validity_date,
																					   		 $quotation_entry_gross_amount,$quotation_entry_transport_amount,
																							 $quotation_entry_tax_per,$quotation_entry_tax_amount,
																					   		 $quotation_entry_advance_amount,$quotation_entry_net_amount,
																					   		 $quotation_entry_no,$quotation_entry_type_id,
																					   		 $quotation_entry_branch_id,$_SESSION[SESS.'_session_user_id'],
																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							 $quotation_entry_dis_amount,$quotation_entry_dis_per);  
		//echo $insert_quotation_entry; exit;
		mysql_query($insert_quotation_entry);
		$quotation_entry_id 								= mysql_insert_id(); 
		
		
		//Product Detail
$quotation_entry_product_detail_product_type      = $_POST['quotation_entry_product_detail_product_type'];
$quotation_entry_product_detail_product_id     	  = $_POST['quotation_entry_product_detail_product_id'];
$quotation_entry_product_detail_product_uom_id    = $_POST['quotation_entry_product_detail_product_uom_id'];
$quotation_entry_product_detail_product_brand_id  = isset($_POST['quotation_entry_product_detail_product_brand_id'])?$_POST['quotation_entry_product_detail_product_brand_id']:'';
$quotation_entry_product_detail_product_color_id  = isset($_POST['quotation_entry_product_detail_product_color_id'])?$_POST['quotation_entry_product_detail_product_color_id']:'';
$quotation_entry_product_detail_product_thick  	  = isset($_POST['quotation_entry_product_detail_product_thick'])?$_POST['quotation_entry_product_detail_product_thick']:'';
$quotation_entry_product_detail_width_inches  	  = isset($_POST['quotation_entry_product_detail_width_inches'])?$_POST['quotation_entry_product_detail_width_inches']:'';
$quotation_entry_product_detail_width_mm 		  = isset($_POST['quotation_entry_product_detail_width_mm'])?$_POST['quotation_entry_product_detail_width_mm']:'';
$quotation_entry_product_detail_s_width_inches 	  = isset($_POST['quotation_entry_product_detail_s_width_inches'])?$_POST['quotation_entry_product_detail_s_width_inches']:'';
$quotation_entry_product_detail_s_width_mm 		  = isset($_POST['quotation_entry_product_detail_s_width_mm'])?$_POST['quotation_entry_product_detail_s_width_mm']:'';
$quotation_entry_product_detail_sl_feet 		  = isset($_POST['quotation_entry_product_detail_sl_feet'])?$_POST['quotation_entry_product_detail_sl_feet']:'';
$quotation_entry_product_detail_sl_feet_in 		  = isset($_POST['quotation_entry_product_detail_sl_feet_in'])?$_POST['quotation_entry_product_detail_sl_feet_in']:'';
$quotation_entry_product_detail_sl_feet_mm 		  = isset($_POST['quotation_entry_product_detail_sl_feet_mm'])?$_POST['quotation_entry_product_detail_sl_feet_mm']:'';
$quotation_entry_product_detail_sl_feet_met 	  = isset($_POST['quotation_entry_product_detail_sl_feet_met'])?$_POST['quotation_entry_product_detail_sl_feet_met']:'';

$quotation_entry_product_detail_s_weight_inches   = isset($_POST['quotation_entry_product_detail_s_weight_inches'])?$_POST['quotation_entry_product_detail_s_weight_inches']:'';
$quotation_entry_product_detail_s_weight_mm   	  = isset($_POST['quotation_entry_product_detail_s_weight_mm'])?$_POST['quotation_entry_product_detail_s_weight_mm']:'';

$quotation_entry_product_detail_qty 			  = $_POST['quotation_entry_product_detail_qty'];
$quotation_entry_product_detail_tot_length 		  = isset($_POST['quotation_entry_product_detail_tot_length'])?$_POST['quotation_entry_product_detail_tot_length']:'';
$quotation_entry_product_detail_rate 			  = $_POST['quotation_entry_product_detail_rate'];
$quotation_entry_product_detail_total 			  = $_POST['quotation_entry_product_detail_total'];
$quotation_entry_product_detail_entry_type		  = $_POST['quotation_entry_product_detail_entry_type'];
$quotation_entry_product_detail_s_weight_met		=isset($_POST['quotation_entry_product_detail_s_weight_met'])?$_POST['quotation_entry_product_detail_s_weight_met']:'';
		// purchase order pproduct details
		for($i = 0; $i < count($quotation_entry_product_detail_product_id); $i++) { 
		// echo $quotation_entry_product_detail_qty[$i]; exit;
			$detail_request_fields 							= 	((!empty($quotation_entry_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$quotation_entry_product_detail_uniq_id 	= generateUniqId();
				$insert_quotation_entry_product_detail 		= sprintf("INSERT INTO quotation_entry_product_details 
																				(quotation_entry_product_detail_uniq_id,quotation_entry_product_detail_quotation_entry_id,
																				 quotation_entry_product_detail_product_id,quotation_entry_product_detail_product_uom_id,
																				 quotation_entry_product_detail_product_brand_id,quotation_entry_product_detail_product_color_id,
																				 quotation_entry_product_detail_product_type, quotation_entry_product_detail_product_thick,
																				 quotation_entry_product_detail_width_inches,quotation_entry_product_detail_width_mm,
																				 quotation_entry_product_detail_s_width_inches,quotation_entry_product_detail_s_width_mm,
																				 quotation_entry_product_detail_sl_feet,quotation_entry_product_detail_sl_feet_in,
																				 quotation_entry_product_detail_sl_feet_mm,quotation_entry_product_detail_sl_feet_met,
																				 quotation_entry_product_detail_s_weight_inches,quotation_entry_product_detail_s_weight_mm,
																				 quotation_entry_product_detail_qty,quotation_entry_product_detail_tot_length,
																				 quotation_entry_product_detail_rate,quotation_entry_product_detail_total,
																				 quotation_entry_product_detail_added_by, quotation_entry_product_detail_added_on,
																				 quotation_entry_product_detail_added_ip,
																				 quotation_entry_product_detail_entry_type,quotation_entry_product_detail_s_weight_met) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s',
																				'%d','%f')", 
																		 $quotation_entry_product_detail_uniq_id,$quotation_entry_id,
																		 $quotation_entry_product_detail_product_id[$i],$quotation_entry_product_detail_product_uom_id[$i],
																		 $quotation_entry_product_detail_product_brand_id[$i],$quotation_entry_product_detail_product_color_id[$i],
																		 $quotation_entry_product_detail_product_type[$i], $quotation_entry_product_detail_product_thick[$i],
																		 $quotation_entry_product_detail_width_inches[$i],$quotation_entry_product_detail_width_mm[$i],
																		 $quotation_entry_product_detail_s_width_inches[$i],$quotation_entry_product_detail_s_width_mm[$i],
																		 $quotation_entry_product_detail_sl_feet[$i],$quotation_entry_product_detail_sl_feet_in[$i],
																		 $quotation_entry_product_detail_sl_feet_mm[$i],$quotation_entry_product_detail_sl_feet_met[$i],
																		 $quotation_entry_product_detail_s_weight_inches[$i],$quotation_entry_product_detail_s_weight_mm[$i],
																		 $quotation_entry_product_detail_qty[$i],$quotation_entry_product_detail_tot_length[$i],
																		 $quotation_entry_product_detail_rate[$i],$quotation_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$quotation_entry_product_detail_entry_type[$i], 			
																		 $quotation_entry_product_detail_s_weight_met[$i]);
																		// echo $insert_quotation_entry_product_detail; exit;
				mysql_query($insert_quotation_entry_product_detail);
			}
		}
		pageRedirection("quotation-entry/index.php?page=add&msg=1&print_status=1&quotation_id=$quotation_entry_uniq_id");
		}

	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND quotation_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND quotation_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['customerid']))&& !empty($_REQUEST['customerid']))
		{
		$where.="AND quotation_entry_customer_id ='".$_REQUEST['customerid']."'";
		}
		$select_quotation_entry		=	"SELECT 

												quotation_entry_id,

												quotation_entry_uniq_id,

												quotation_entry_no,

												quotation_entry_date,

												customer_name,

												quotation_entry_validity_date,
												branch_prefix

											 FROM 

												quotation_entry

											 LEFT JOIN

												customers

											 ON

												customer_id		=  quotation_entry_customer_id
											 LEFT JOIN
												branches
											 ON
												branch_id		=  quotation_entry_branch_id
											 WHERE 

												quotation_entry_deleted_status 	= 	0  $where

											 ORDER BY 

												quotation_entry_no ASC";

		$result_quotation_entry		= mysql_query($select_quotation_entry);

		// Filling up the array

		$quotation_entry_data 		= array();

		while ($record_quotation_entry = mysql_fetch_array($result_quotation_entry))

		{

		 $quotation_entry_data[] 	= $record_quotation_entry;

		}

		return $quotation_entry_data;

	}

	function editQuotation(){

		$quotation_entry_id 			= getId('quotation_entry', 'quotation_entry_id', 'quotation_entry_uniq_id', dataValidation($_GET['id'])); 

		$select_quotation_entry		=	"SELECT 

												*

											 FROM 

												quotation_entry 
											LEFT JOIN
												customers
											ON
												customer_id						= quotation_entry_customer_id
											 LEFT JOIN
												branches
											 ON
												branch_id		=  quotation_entry_branch_id
											 WHERE 

												quotation_entry_deleted_status 	=  0 			AND 

												quotation_entry_id				= '".$quotation_entry_id."'

											 ORDER BY 

												quotation_entry_no ASC";

		$result_quotation_entry 		= mysql_query($select_quotation_entry);

		$record_quotation_entry 		= mysql_fetch_array($result_quotation_entry);

		return $record_quotation_entry;

	}

	function editQuotationProductDetail()

	{

		$quotation_entry_id 	= getId('quotation_entry', 'quotation_entry_id', 'quotation_entry_uniq_id', dataValidation($_GET['id'])); 

	  $select_quotation_entry_product_detail 		= "SELECT 
															A.*,
															product_name,
															p_uom.product_uom_name as p_uom_name,
															product_code,
															child_uom.product_uom_name as c_uom_name,
															product_thick_ness,
															quotation_entry_product_detail_product_type,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															product_con_entry_child_product_detail_width_inches,
															product_con_entry_child_product_detail_product_id,
															p_clr.product_colour_name as p_colour_name,
															c_clr.product_colour_name as c_colour_name,
															brand_name
														FROM 
															quotation_entry_product_details A
														LEFT JOIN 
															products 
														ON 
															product_id 												= quotation_entry_product_detail_product_id
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id				= quotation_entry_product_detail_product_id	
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 									= product_purchase_uom_id
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 								= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours as p_clr 
														ON 
															p_clr.product_colour_id 								= quotation_entry_product_detail_product_color_id
														LEFT JOIN 
															product_colours as c_clr 
														ON 
															c_clr.product_colour_id 								= product_con_entry_child_product_detail_color_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 												= quotation_entry_product_detail_product_brand_id
														WHERE 
															quotation_entry_product_detail_deleted_status		 	= 0 							AND 
															quotation_entry_product_detail_quotation_entry_id 		= '".$quotation_entry_id."'";

		$result_quotation_entry_product_detail 	= mysql_query($select_quotation_entry_product_detail);
		$count_quotation_entry 					= mysql_num_rows($result_quotation_entry_product_detail);
		$arr_quotation_entry_product_detail 	= array();
		while($record_quotation_entry_product_detail = mysql_fetch_array($result_quotation_entry_product_detail)) {
			$arr_quotation_entry_product_detail[] = $record_quotation_entry_product_detail;
		}
		return $arr_quotation_entry_product_detail;
	}

	function updateQuotation(){
		$quotation_entry_id                   				= trim($_POST['quotation_entry_id']);
		$quotation_entry_uniq_id                			= trim($_POST['quotation_entry_uniq_id']);
		$quotation_entry_no                   				= trim($_POST['quotation_entry_no']);
		$quotation_entry_branch_id                   		= trim($_POST['quotation_entry_branch_id']);
		$quotation_entry_type_id                   			= implode(",",$_POST['quotation_entry_type_id']);
		$quotation_entry_date                 				= NdateDatabaseFormat($_POST['quotation_entry_date']);
		$quotation_entry_customer_id            			= trim($_POST['quotation_entry_customer_id']);
		$quotation_entry_validity_date                 		= NdateDatabaseFormat($_POST['quotation_entry_validity_date']);
		$quotation_entry_gross_amount                 		= trim($_POST['quotation_entry_gross_amount']);
		$quotation_entry_transport_amount                 	= trim($_POST['quotation_entry_transport_amount']);
		$quotation_entry_tax_per                 			= trim($_POST['quotation_entry_tax_per']);
		$quotation_entry_tax_amount                 		= trim($_POST['quotation_entry_tax_amount']);
		$quotation_entry_advance_amount                		= trim($_POST['quotation_entry_advance_amount']);
		$quotation_entry_net_amount                 		= trim($_POST['quotation_entry_net_amount']);
		$quotation_entry_dis_amount                 		= trim($_POST['quotation_entry_dis_amount']);
		$quotation_entry_dis_per                 			= trim($_POST['quotation_entry_dis_per']);
		
		
		//$quotation_entry_so_entry_id     					= trim($_POST['quotation_entry_so_entry_id']);
		$request_fields 									= ((!empty($quotation_entry_branch_id)) && (!empty($quotation_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "quotation-entry/index.php?page=edit&id=$quotation_entry_uniq_id");

		$ip												= getRealIpAddr();

		$update_customer 					= sprintf("	UPDATE 
															quotation_entry 
														SET 
															quotation_entry_branch_id 					= '%d',
															quotation_entry_date 						= '%s',
															quotation_entry_customer_id 				= '%d',
															quotation_entry_validity_date 				= '%s',
															quotation_entry_gross_amount 				= '%f',
															quotation_entry_transport_amount 			= '%f',
															quotation_entry_tax_per 					= '%f',
															quotation_entry_tax_amount 					= '%f',
															quotation_entry_dis_per 					= '%f',
															quotation_entry_dis_amount 					= '%f',
															quotation_entry_advance_amount 				= '%f',
															quotation_entry_net_amount 					= '%f',
															quotation_entry_modified_by 				= '%d',
															quotation_entry_modified_on 				= UNIX_TIMESTAMP(NOW()),
															quotation_entry_modified_ip				= '%s'
														WHERE               
															quotation_entry_id         				= '%d'", 
															$quotation_entry_branch_id,
															$quotation_entry_date,
															$quotation_entry_customer_id,
															$quotation_entry_validity_date,
															$quotation_entry_gross_amount,
															$quotation_entry_transport_amount,
															$quotation_entry_tax_per,
															$quotation_entry_tax_amount,
															$quotation_entry_dis_per,
															$quotation_entry_dis_amount,
															$quotation_entry_advance_amount,
															$quotation_entry_net_amount,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$quotation_entry_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

$quotation_entry_product_detail_product_type      = $_POST['quotation_entry_product_detail_product_type'];
$quotation_entry_product_detail_product_id     	  = $_POST['quotation_entry_product_detail_product_id'];
$quotation_entry_product_detail_product_uom_id    = $_POST['quotation_entry_product_detail_product_uom_id'];
$quotation_entry_product_detail_product_brand_id  = isset($_POST['quotation_entry_product_detail_product_brand_id'])?$_POST['quotation_entry_product_detail_product_brand_id']:'';
$quotation_entry_product_detail_product_color_id  = isset($_POST['quotation_entry_product_detail_product_color_id'])?$_POST['quotation_entry_product_detail_product_color_id']:'';
$quotation_entry_product_detail_product_thick  	  = isset($_POST['quotation_entry_product_detail_product_thick'])?$_POST['quotation_entry_product_detail_product_thick']:'';
$quotation_entry_product_detail_width_inches  	  = isset($_POST['quotation_entry_product_detail_width_inches'])?$_POST['quotation_entry_product_detail_width_inches']:'';
$quotation_entry_product_detail_width_mm 		  = isset($_POST['quotation_entry_product_detail_width_mm'])?$_POST['quotation_entry_product_detail_width_mm']:'';
$quotation_entry_product_detail_s_width_inches 	  = isset($_POST['quotation_entry_product_detail_s_width_inches'])?$_POST['quotation_entry_product_detail_s_width_inches']:'';
$quotation_entry_product_detail_s_width_mm 		  = isset($_POST['quotation_entry_product_detail_s_width_mm'])?$_POST['quotation_entry_product_detail_s_width_mm']:'';
$quotation_entry_product_detail_sl_feet 		  = isset($_POST['quotation_entry_product_detail_sl_feet'])?$_POST['quotation_entry_product_detail_sl_feet']:'';
$quotation_entry_product_detail_sl_feet_in 		  = isset($_POST['quotation_entry_product_detail_sl_feet_in'])?$_POST['quotation_entry_product_detail_sl_feet_in']:'';
$quotation_entry_product_detail_sl_feet_mm 		  = isset($_POST['quotation_entry_product_detail_sl_feet_mm'])?$_POST['quotation_entry_product_detail_sl_feet_mm']:'';
$quotation_entry_product_detail_sl_feet_met 	  = isset($_POST['quotation_entry_product_detail_sl_feet_met'])?$_POST['quotation_entry_product_detail_sl_feet_met']:'';

$quotation_entry_product_detail_s_weight_inches   = isset($_POST['quotation_entry_product_detail_s_weight_inches'])?$_POST['quotation_entry_product_detail_s_weight_inches']:'';
$quotation_entry_product_detail_s_weight_mm   	  = isset($_POST['quotation_entry_product_detail_s_weight_mm'])?$_POST['quotation_entry_product_detail_s_weight_mm']:'';
$quotation_entry_product_detail_s_weight_met		=isset($_POST['quotation_entry_product_detail_s_weight_met'])?$_POST['quotation_entry_product_detail_s_weight_met']:'';

$quotation_entry_product_detail_qty 			  = $_POST['quotation_entry_product_detail_qty'];
$quotation_entry_product_detail_tot_length 		  = isset($_POST['quotation_entry_product_detail_tot_length'])?$_POST['quotation_entry_product_detail_tot_length']:'';
$quotation_entry_product_detail_rate 			  = $_POST['quotation_entry_product_detail_rate'];
$quotation_entry_product_detail_total 			  = $_POST['quotation_entry_product_detail_total'];
$quotation_entry_product_detail_entry_type		  = $_POST['quotation_entry_product_detail_entry_type'];
$quotation_entry_product_detail_id 			  	  = $_POST['quotation_entry_product_detail_id'];

		for($i = 0; $i < count($quotation_entry_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($quotation_entry_product_detail_product_id[$i])));

			if($detail_request_fields) { 

				if(isset($quotation_entry_product_detail_id[$i]) && (!empty($quotation_entry_product_detail_id[$i]))) {

					 $update_quotation_entry_product_detail = sprintf("UPDATE 
																			quotation_entry_product_details 
																		SET  
																			quotation_entry_product_detail_product_color_id			= '%d',
																			quotation_entry_product_detail_product_thick			= '%d',
																			quotation_entry_product_detail_width_inches  			= '%f',
																			quotation_entry_product_detail_width_mm  				= '%f',
																			quotation_entry_product_detail_s_width_inches  			= '%f',
																			quotation_entry_product_detail_s_width_mm  				= '%f',
																			quotation_entry_product_detail_sl_feet  				= '%f',
																			quotation_entry_product_detail_sl_feet_in  				= '%f',
																			quotation_entry_product_detail_sl_feet_mm  				= '%f',
																			quotation_entry_product_detail_s_weight_inches  		= '%f',
																			quotation_entry_product_detail_s_weight_mm  			= '%f',
																			quotation_entry_product_detail_s_weight_met				= '%f',
																			quotation_entry_product_detail_tot_length  				= '%f',
																			quotation_entry_product_detail_qty  					= '%f',
																			quotation_entry_product_detail_rate  					= '%f',
																			quotation_entry_product_detail_total  					= '%f',
																			quotation_entry_product_detail_modified_by 				= '%d',
																			quotation_entry_product_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),
																			quotation_entry_product_detail_modified_ip 				= '%s'
																		WHERE 
																			quotation_entry_product_detail_quotation_entry_id 	= '%d' AND 
																			quotation_entry_product_detail_id 					= '%d'",
																			$quotation_entry_product_detail_product_color_id[$i],
																			$quotation_entry_product_detail_product_thick[$i],
																			$quotation_entry_product_detail_width_inches[$i],
																			$quotation_entry_product_detail_width_mm[$i],
																			$quotation_entry_product_detail_s_width_inches[$i],
																			$quotation_entry_product_detail_s_width_mm[$i],
																			$quotation_entry_product_detail_sl_feet[$i],
																			$quotation_entry_product_detail_sl_feet_in[$i],
																			$quotation_entry_product_detail_sl_feet_mm[$i],
																			$quotation_entry_product_detail_s_weight_inches[$i],
																			$quotation_entry_product_detail_s_weight_mm[$i],
																			$quotation_entry_product_detail_s_weight_met[$i],
																			$quotation_entry_product_detail_tot_length[$i],
																			$quotation_entry_product_detail_qty[$i],
																			$quotation_entry_product_detail_rate[$i],
																			$quotation_entry_product_detail_total[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$quotation_entry_id, 
																			$quotation_entry_product_detail_id[$i]);	
			//	echo $update_quotation_entry_product_detail; exit;
					mysql_query($update_quotation_entry_product_detail);

					

				} else {

					$quotation_entry_product_detail_uniq_id 	= generateUniqId();

					 $insert_quotation_entry_product_detail 		= sprintf("INSERT INTO quotation_entry_product_details 
																				(quotation_entry_product_detail_uniq_id,quotation_entry_product_detail_quotation_entry_id,
																				 quotation_entry_product_detail_product_id,quotation_entry_product_detail_product_uom_id,
																				 quotation_entry_product_detail_product_brand_id,quotation_entry_product_detail_product_color_id,
																				 quotation_entry_product_detail_product_type, quotation_entry_product_detail_product_thick,
																				 quotation_entry_product_detail_width_inches,quotation_entry_product_detail_width_mm,
																				 quotation_entry_product_detail_s_width_inches,quotation_entry_product_detail_s_width_mm,
																				 quotation_entry_product_detail_sl_feet,quotation_entry_product_detail_sl_feet_in,
																				 quotation_entry_product_detail_sl_feet_mm,quotation_entry_product_detail_sl_feet_met,
																				 quotation_entry_product_detail_s_weight_inches,quotation_entry_product_detail_s_weight_mm,
																				 quotation_entry_product_detail_qty,quotation_entry_product_detail_tot_length,
																				 quotation_entry_product_detail_rate,quotation_entry_product_detail_total,
																				 quotation_entry_product_detail_added_by, quotation_entry_product_detail_added_on,
																				 quotation_entry_product_detail_added_ip, quotation_entry_product_detail_entry_type, 
																				 quotation_entry_product_detail_s_weight_met) 
																	VALUES     ('%s', '%d', 
																				'%d', '%d',
																				'%d', '%d',
																				'%d', '%d', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f',
																				'%f', '%f', 
																				'%d', UNIX_TIMESTAMP(NOW()), '%s',
																				'%d','%f')", 
																		 $quotation_entry_product_detail_uniq_id,$quotation_entry_id,
																		 $quotation_entry_product_detail_product_id[$i],$quotation_entry_product_detail_product_uom_id[$i],
																		 $quotation_entry_product_detail_product_brand_id[$i],$quotation_entry_product_detail_product_color_id[$i],
																		 $quotation_entry_product_detail_product_type[$i], $quotation_entry_product_detail_product_thick[$i],
																		 $quotation_entry_product_detail_width_inches[$i],$quotation_entry_product_detail_width_mm[$i],
																		 $quotation_entry_product_detail_s_width_inches[$i],$quotation_entry_product_detail_s_width_mm[$i],
																		 $quotation_entry_product_detail_sl_feet[$i],$quotation_entry_product_detail_sl_feet_in[$i],
																		 $quotation_entry_product_detail_sl_feet_mm[$i],$quotation_entry_product_detail_sl_feet_met[$i],
																		 $quotation_entry_product_detail_s_weight_inches[$i],$quotation_entry_product_detail_s_weight_mm[$i],
																		 $quotation_entry_product_detail_qty[$i],$quotation_entry_product_detail_tot_length[$i],
																		 $quotation_entry_product_detail_rate[$i],$quotation_entry_product_detail_total[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$quotation_entry_product_detail_entry_type[$i],
																		 $quotation_entry_product_detail_s_weight_met[$i]);
					//echo $insert_quotation_entry_product_detail; exit;
					mysql_query($insert_quotation_entry_product_detail);

				}

			}

		

		}

		pageRedirection("quotation-entry/index.php?page=edit&id=$quotation_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['quotation_entry_uniq_id'])))

		{

			$product_detail_id 		 = $_GET['product_detail_id'];

			$quotation_entry_uniq_id = $_GET['quotation_entry_uniq_id'];

			mysql_query("UPDATE quotation_entry_product_details SET quotation_entry_product_detail_deleted_status = 1 

						WHERE quotation_entry_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$quotation_entry_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('quotation_entry', 'quotation_entry_deleted_by', 'quotation_entry_deleted_on' , 'quotation_entry_deleted_ip','quotation_entry_deleted_status', 'quotation_entry_id', 'quotation_entry_uniq_id', '1');

		

		deleteMultiRecords('quotation_entry_product_details', 'quotation_entry_product_detail_deleted_by', 'quotation_entry_product_detail_deleted_on', 'quotation_entry_product_detail_deleted_ip', 'quotation_entry_product_detail_deleted_status', 'quotation_entry_product_detail_quotation_entry_id', 'quotation_entry','quotation_entry_id','quotation_entry_uniq_id', '1');  



		

		pageRedirection("quotation-entry/index.php?msg=7");				

	}

?>