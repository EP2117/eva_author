<?php
	function GetAutoNo($invoice_id){
		$select_invoice_no = "SELECT MAX(SUBSTRING_INDEX(production_order_no,'-',-1)) AS maxval FROM production_order 
								  WHERE production_order_deleted_status =0
								  AND production_order_invoice_entry_id = '".$invoice_id."'
								  AND production_order_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								  AND production_order_company_id = '".$_SESSION[SESS.'_session_company_id']."' ";
					
					             //echo $select_invoice_no;exit;
		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		$maxval = $record_invoice_no['maxval']; 

		/*if($maxval > 0) {

			$production_order_no = substr(('00000'.++$maxval),-5);

		} else {

			$production_order_no = substr(('00000'.++$maxval),-5);

		}*/
		$production_order_no = $maxval+1; //echo $production_order_no;exit;
		return $production_order_no;
	}
	function insertQuotation(){
	
	$select_branch	= "SELECT branch_prefix FROM branches WHERE  branch_id = '".$_POST['production_order_branch_id']."' ";
		//echo $select_branch;exit;
		$result_branch = mysql_query($select_branch);
		$res = mysql_fetch_array($result_branch); 
	//echo "<pre>";print_r($_POST);exit;
//$production_order_no =$res['branch_prefix'].GetAutoNo($_POST['production_order_branch_id']); //echo $invoice_entry_no;exit;

		$production_order_branch_id                   		= trim($_POST['production_order_branch_id']);
		$production_order_no                   			= trim($_POST['production_order_no']).'-'.GetAutoNo($_POST['production_order_invoice_entry_id']); //echo $production_order_no;exit;
		//$production_order_no   = empty($production_order_no1)?$res['branch_prefix'].GetAutoNo():$production_order_no1; echo $production_order_no;exit;
		$production_order_date                 				= NdateDatabaseFormat($_POST['production_order_date']);
		$production_order_production_section_id            	= trim($_POST['production_order_production_section_id']);
		$production_order_customer_id          				= trim($_POST['production_order_customer_id']);
		$production_order_department_id      				= trim($_POST['production_order_department_id']);
		$production_order_type     							= trim($_POST['production_order_type']);
		$production_order_invoice_entry_id     				= trim($_POST['production_order_invoice_entry_id']);
		$production_order_type_id     						= trim($_POST['production_order_type_id']);
		$production_order_contact_no     					= trim($_POST['production_order_contact_no']);
		//Product Detail	
$production_order_product_detail_product_type     	= isset($_POST['production_order_product_detail_product_type'])?$_POST['production_order_product_detail_product_type']:'';
$production_order_product_detail_product_id     	= isset($_POST['production_order_product_detail_product_id'])?$_POST['production_order_product_detail_product_id']:'';
$production_order_product_detail_invoice_detail_id  = isset($_POST['production_order_product_detail_invoice_detail_id'])?$_POST['production_order_product_detail_invoice_detail_id']:'';
$production_order_product_detail_width_inches  		= isset($_POST['production_order_product_detail_width_inches'])?$_POST['production_order_product_detail_width_inches']:'';
$production_order_product_detail_width_mm 		  	= isset($_POST['production_order_product_detail_width_mm'])?$_POST['production_order_product_detail_width_mm']:'';
$production_order_product_detail_s_width_inches 	= isset($_POST['production_order_product_detail_s_width_inches'])?$_POST['production_order_product_detail_s_width_inches']:'';
$production_order_product_detail_s_width_mm 		= isset($_POST['production_order_product_detail_s_width_mm'])?$_POST['production_order_product_detail_s_width_mm']:'';
$production_order_product_detail_sl_feet 		  	= isset($_POST['production_order_product_detail_sl_feet'])?$_POST['production_order_product_detail_sl_feet']:'';
$production_order_product_detail_sl_feet_in 		= isset($_POST['production_order_product_detail_sl_feet_in'])?$_POST['production_order_product_detail_sl_feet_in']:'';
$production_order_product_detail_sl_feet_mm 		= isset($_POST['production_order_product_detail_sl_feet_mm'])?$_POST['production_order_product_detail_sl_feet_mm']:'';
$production_order_product_detail_s_weight_inches   	= isset($_POST['production_order_product_detail_s_weight_inches'])?$_POST['production_order_product_detail_s_weight_inches']:'';
$production_order_product_detail_s_weight_mm   		= isset($_POST['production_order_product_detail_s_weight_mm'])?$_POST['production_order_product_detail_s_weight_mm']:'';
$production_order_product_detail_s_weight_met   		= isset($_POST['production_order_product_detail_s_weight_met'])?$_POST['production_order_product_detail_s_weight_met']:'';
$production_order_product_detail_qty 			 	= isset($_POST['production_order_product_detail_qty'])?$_POST['production_order_product_detail_qty']:'';
$production_order_product_detail_tot_length 		= isset($_POST['production_order_product_detail_tot_length'])?$_POST['production_order_product_detail_tot_length']:'';
$production_order_product_detail_product_thick		= isset($_POST['production_order_product_detail_product_thick'])?$_POST['production_order_product_detail_product_thick']:'';
$production_order_product_detail_product_colour_id	= isset($_POST['production_order_product_detail_product_colour_id'])?$_POST['production_order_product_detail_product_colour_id']:'';
$production_order_product_detail_inv_tot_length		= isset($_POST['production_order_product_detail_inv_tot_length'])?$_POST['production_order_product_detail_inv_tot_length']:'';
$production_order_product_detail_max_qty		= isset($_POST['production_order_product_detail_max_qty'])?$_POST['production_order_product_detail_max_qty']:'';
$production_order_product_detail_mother_child_type		= isset($_POST['production_order_product_detail_mother_child_type'])?$_POST['production_order_product_detail_mother_child_type']:'';



		$request_fields 									= ((!empty($production_order_branch_id)) && (!empty($production_order_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "production-order-sale/index.php?page=add&msg=5");

		$production_order_uniq_id							= generateUniqId();

		$ip													= getRealIpAddr();
		
		
		

		$insert_production_order 					= sprintf("INSERT INTO production_order  (production_order_uniq_id, production_order_date,

																					  		  production_order_production_section_id,production_order_customer_id,

																					   		  production_order_department_id,production_order_type,

																					   		  production_order_invoice_entry_id, production_order_no,

																					  		  production_order_branch_id,production_order_added_by,

																					   		  production_order_added_on,production_order_added_ip,

																			   		   		  production_order_company_id,production_order_financial_year,
																							  production_order_type_id) 

																			VALUES 	 		 ('%s', '%s', 

																							  '%d', '%d', 

																							  '%d', '%d',

																							  '%d', '%s',

																							  '%d', '%d', 

																							   UNIX_TIMESTAMP(NOW()),

																							  '%s', '%d', '%d' , '%s')", 

																		  	   		   		 $production_order_uniq_id, $production_order_date,

																					   		 $production_order_production_section_id,$production_order_customer_id,

																					   		 $production_order_department_id,$production_order_type,

																					   		 $production_order_invoice_entry_id,$production_order_no,

																					   		 $production_order_branch_id,$_SESSION[SESS.'_session_user_id'],

																			   		     	 $ip,$_SESSION[SESS.'_session_company_id'],$_SESSION[SESS.'_session_financial_year'],
																							 $production_order_type_id);  
					//echo $insert_production_order;exit; 
		mysql_query($insert_production_order);
		

		//echo $insert_production_order; exit;

		$production_order_id 						= mysql_insert_id(); 

		// purchase order pproduct details
//print_r($production_order_product_detail_product_id);exit;
		for($i = 0; $i < count($production_order_product_detail_product_id); $i++) { 
		 //echo $production_order_product_detail_product_id; exit;
			$detail_request_fields 							= 	((!empty($production_order_product_detail_product_id[$i])));
			if($detail_request_fields) {
				$production_order_product_detail_uniq_id 	= generateUniqId();
				 $insert_production_order_product_detail 		= sprintf("INSERT INTO production_order_product_details 
																				(production_order_product_detail_uniq_id,
																				production_order_product_detail_production_order_id,
																				 production_order_product_detail_product_id,
																				 production_order_product_detail_product_type, 
																				 production_order_product_detail_product_thick,
																				 production_order_product_detail_width_inches,
																				 production_order_product_detail_width_mm,
																				 production_order_product_detail_s_width_inches,
																				 production_order_product_detail_s_width_mm,
																				 production_order_product_detail_sl_feet,
																				 production_order_product_detail_sl_feet_in,
																				 production_order_product_detail_sl_feet_mm,
																				 production_order_product_detail_s_weight_inches,
																				 production_order_product_detail_s_weight_mm,
																				 production_order_product_detail_qty,
																				 production_order_product_detail_tot_length,
																				 production_order_product_detail_added_by, 
																				 production_order_product_detail_added_on,
																				 production_order_product_detail_added_ip,
																				 production_order_product_detail_invoice_detail_id,
																				 production_order_product_detail_invoice_entry_id,
																				 production_order_product_detail_product_color_id,
																				 production_order_product_detail_entry_type,
																				 production_order_product_detail_max_qty,
																				 production_order_product_detail_s_weight_met,
																				 production_order_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d',
																				'%d','%d','%d','%f','%f','%d' )", 
																		 $production_order_product_detail_uniq_id,$production_order_id,
																		 $production_order_product_detail_product_id[$i],
																		 $production_order_product_detail_product_type[$i],
																		 $production_order_product_detail_product_thick[$i],
																		 $production_order_product_detail_width_inches[$i],
																		 $production_order_product_detail_width_mm[$i],
																		 $production_order_product_detail_s_width_inches[$i],
																		 $production_order_product_detail_s_width_mm[$i],
																		 $production_order_product_detail_sl_feet[$i],
																		 $production_order_product_detail_sl_feet_in[$i],
																		 $production_order_product_detail_sl_feet_mm[$i],
																		 $production_order_product_detail_s_weight_inches[$i],
																		 $production_order_product_detail_s_weight_mm[$i],
																		 $production_order_product_detail_qty[$i],
																		 $production_order_product_detail_tot_length[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,
																		 $production_order_product_detail_invoice_detail_id[$i],
																		 $production_order_invoice_entry_id,
																		 $production_order_product_detail_product_colour_id[$i],
																		 $production_order_type_id,$production_order_product_detail_max_qty[$i],
																		 $production_order_product_detail_s_weight_met[$i],
																		 $production_order_product_detail_mother_child_type[$i]);
															//echo $insert_production_order_product_detail; exit;
				mysql_query($insert_production_order_product_detail);
				
				if($_SESSION[SESS.'_session_user_branch_type']==2){
					if($production_order_type_id=='4'){
								$length_feet									= 	"1";
								$length_meter									= 	"1";
								$ton_qty										= 	"1";
								$kg_qty											= 	"1";
								$product_detail_qty								= 	"1";
								$stock_ledger_entry_type						= 	"prodution-order-sale";
								$godown_id										= 	"2";
								$produt_id										=	$production_order_product_detail_product_id[$i];
								$produt_qty										=	(-1*$production_order_product_detail_qty[$i]);
								$child_type  									= $production_order_product_detail_mother_child_type[$i];
							stockLedger($child_type,'out',$production_order_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $production_order_branch_id,  $godown_id, $production_orderdate, $production_order_no,$stock_ledger_entry_type,'1');
					}
					else{
					$produt_id											=	$production_order_product_detail_product_id[$i];
					$product_colour_id									=	$production_order_product_detail_product_colour_id[$i];
					$product_thick										=	$production_order_product_detail_product_thick[$i];
					$width_inches										= 	$production_order_product_detail_width_inches[$i];
					$width_mm											= 	$production_order_product_detail_width_mm[$i];
					$ton_qty											= 	$production_order_product_detail_s_weight_inches[$i];
					$kg_qty												= 	$production_order_product_detail_s_weight_mm[$i];
					$tot_length											= 	$production_order_product_detail_inv_tot_length[$i];
					$entry_type											= 	"prodution-order-sale";
					$child_type 										= $production_order_product_detail_mother_child_type[$i];
					stockLedger($child_type,'out',$production_order_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$produt_qty, $production_order_branch_id,  $godown_id, $production_orderdate, $production_order_no,$stock_ledger_entry_type,'1');
					}
				}
				
			}
		}
		pageRedirection("production-order-sale/index.php?page=add&msg=1");

	}

	function listQuotation(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND production_order_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND production_order_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['customerid']))&& !empty($_REQUEST['customerid']))
		{
		$where.="AND production_order_customer_id ='".$_REQUEST['customerid']."'";
		}
		$select_production_order		=	"SELECT 

												production_order_id,

												production_order_uniq_id,

												production_order_no,

												production_order_date,

												production_order_customer_id,

												production_section_name,

												production_order_type,
												branch_prefix,
												customer_name

											 FROM 

												production_order

											 LEFT JOIN

												production_sections

											 ON

												production_section_id		=  production_order_production_section_id
											 LEFT JOIN
												branches
											 ON
												branch_id					=  production_order_branch_id
											LEFT JOIN
												customers
											 ON
												customer_id					=  production_order_customer_id	
											 WHERE 

												production_order_deleted_status 	= 	0									AND

												production_order_status				= '1'  $where

											 ORDER BY 

												production_order_no ASC";

		$result_production_order		= mysql_query($select_production_order);

		// Filling up the array

		$production_order_data 		= array();

		while ($record_production_order = mysql_fetch_array($result_production_order))

		{

		 $production_order_data[] 	= $record_production_order;

		}

		return $production_order_data;

	}

	function editQuotation(){

		$production_order_id 			= getId('production_order', 'production_order_id', 'production_order_uniq_id', dataValidation($_GET['id'])); 

		$select_production_order		=	"SELECT 

												production_order_uniq_id,  production_order_date,

												production_order_production_section_id,production_order_customer_id,

												production_order_department_id,production_order_type,

												production_order_invoice_entry_id, production_order_no,

												production_order_branch_id,production_order_id,

												customer_billing_address,branch_prefix,

												customer_contact_no,
												production_order_type_id,production_order_no ,customer_name,customer_billing_address,customer_mobile_no,invoice_entry_no

											 FROM 

												production_order 

											LEFT JOIN

												customers

											ON

												customer_id							= 	production_order_customer_id
											LEFT JOIN 
												invoice_entry 
											ON 
												production_order_invoice_entry_id 			= invoice_entry_id
											 LEFT JOIN
												branches
											 ON
												branch_id					=  production_order_branch_id	
											 WHERE 

												production_order_deleted_status 	=  0 			AND 

												production_order_id				= '".$production_order_id."'

											 ORDER BY 

												production_order_no ASC";

		$result_production_order 		= mysql_query($select_production_order);

		$record_production_order 		= mysql_fetch_array($result_production_order);

		return $record_production_order;

	}

	function editSalesdetail(){

		$production_order_id 			= getId('production_order', 'production_order_id', 'production_order_uniq_id', dataValidation($_GET['id'])); 

		$invoice_entry_id 					= getId('production_order', 'production_order_invoice_entry_id', 'production_order_uniq_id', dataValidation($_GET['id'])); 

			$select_production_order		=	"SELECT 

													invoice_entry_no,

													invoice_entry_date

												 FROM 

													invoice_entry 

												 WHERE 

													invoice_entry_deleted_status 	=  0 						AND 

													invoice_entry_id					= '".$invoice_entry_id."'

												 ORDER BY 

													invoice_entry_no ASC";

		

		$result_production_order 		= mysql_query($select_production_order);

		$record_production_order 		= mysql_fetch_array($result_production_order);

		return $record_production_order;

	}

	function editQuotationProductDetail()

	{

		$production_order_id 	= getId('production_order', 'production_order_id', 'production_order_uniq_id', dataValidation($_GET['id'])); 

		 $select_production_order_product_detail 	= "	SELECT 
															production_order_product_detail_id,
															production_order_product_detail_product_id,
															production_order_product_detail_width_inches,production_order_product_detail_width_mm,
															production_order_product_detail_s_width_inches,production_order_product_detail_s_width_mm,
															production_order_product_detail_sl_feet,production_order_product_detail_sl_feet_in,
															production_order_product_detail_sl_feet_mm,production_order_product_detail_s_weight_inches,
															production_order_product_detail_s_weight_mm,production_order_product_detail_tot_length,
															production_order_product_detail_qty,
															production_order_product_detail_sl_feet_met,
															product_name,production_order_product_detail_s_weight_met,
															product_code,production_order_product_detail_max_qty,
															production_order_product_detail_product_thick,
															product_con_entry_child_product_detail_code,
															product_con_entry_child_product_detail_name,
															p_uom.product_uom_name as p_uom_name,
															child_uom.product_uom_name as c_uom_name,
															product_colour_name,
															brand_name,
															production_order_product_detail_product_type,
															quotation_entry_product_detail_product_brand_id,
															production_order_product_detail_mother_child_type
															
															
														FROM 
															production_order_product_details 
														LEFT JOIN 
															invoice_entry_product_details 
														ON 
															invoice_entry_product_detail_id  		    = production_order_product_detail_invoice_detail_id
														LEFT JOIN 
															quotation_entry_product_details 
														ON 
															quotation_entry_product_detail_id 			= invoice_entry_product_detail_quotation_detail_id
														
														LEFT JOIN 
															products 
														ON 
															product_id 									= production_order_product_detail_product_id
														LEFT JOIN 
															brands 
														ON 
															brand_id 									= product_brand_id
														LEFT JOIN 
															product_con_entry_child_product_details 
														ON 
															product_con_entry_child_product_detail_id	= production_order_product_detail_product_id	
														LEFT JOIN 
															product_uoms as p_uom
														ON 
															p_uom.product_uom_id 						= product_product_uom_id
														LEFT JOIN 
															product_uoms as  child_uom
														ON 
															child_uom.product_uom_id 					= product_con_entry_child_product_detail_uom_id
														LEFT JOIN 
															product_colours  
														ON 
															product_colour_id 					= invoice_entry_product_detail_color_id
														
														WHERE 
															production_order_product_detail_deleted_status		 	= 0 							AND 
															production_order_product_detail_production_order_id 		= '".$production_order_id."'";
		$result_production_order_product_detail 	= mysql_query($select_production_order_product_detail);

		$arr_production_order_product_detail 		= array();
		while($record_production_order_product_detail = mysql_fetch_array($result_production_order_product_detail)) {
			$arr_production_order_product_detail[] = $record_production_order_product_detail;
		}
		return $arr_production_order_product_detail;

	}

	function updateQuotation(){

		$production_order_id                   				= trim($_POST['production_order_id']);

		$production_order_uniq_id                			= trim($_POST['production_order_uniq_id']);

		$production_order_branch_id                   		= trim($_POST['production_order_branch_id']);

		$production_order_date                 				= NdateDatabaseFormat($_POST['production_order_date']);

		$production_order_production_section_id            	= trim($_POST['production_order_production_section_id']);

		$production_order_customer_id          				= trim($_POST['production_order_customer_id']);

		$production_order_department_id      				= trim($_POST['production_order_department_id']);

		$production_order_type     							= trim($_POST['production_order_type']);
		$production_order_contact_no						= trim($_POST['production_order_contact_no']);
		

		$production_order_invoice_entry_id     					= trim($_POST['production_order_invoice_entry_id']);

		//Multi Contact
		$production_order_product_detail_type      			= $_POST['production_order_product_detail_type'];
		$production_order_product_detail_product_type      	= $_POST['production_order_product_detail_product_type'];
		$production_order_product_detail_id      			= $_POST['production_order_product_detail_id'];
		
		$production_order_product_detail_product_id     	= $_POST['production_order_product_detail_product_id'];
		$production_order_product_detail_invoice_detail_id   = $_POST['production_order_product_detail_invoice_detail_id'];
		$production_order_product_detail_width_inches  		= isset($_POST['production_order_product_detail_width_inches'])?$_POST['production_order_product_detail_width_inches']:'';
		$production_order_product_detail_width_mm 		  	= isset($_POST['production_order_product_detail_width_mm'])?$_POST['production_order_product_detail_width_mm']:'';
		$production_order_product_detail_s_width_inches 	= isset($_POST['production_order_product_detail_s_width_inches'])?$_POST['production_order_product_detail_s_width_inches']:'';
		$production_order_product_detail_s_width_mm 		= isset($_POST['production_order_product_detail_s_width_mm'])?$_POST['production_order_product_detail_s_width_mm']:'';
		$production_order_product_detail_sl_feet 		  	= isset($_POST['production_order_product_detail_sl_feet'])?$_POST['production_order_product_detail_sl_feet']:'';
		$production_order_product_detail_sl_feet_in 		= isset($_POST['production_order_product_detail_sl_feet_in'])?$_POST['production_order_product_detail_sl_feet_in']:'';
		$production_order_product_detail_sl_feet_mm 		= isset($_POST['production_order_product_detail_sl_feet_mm'])?$_POST['production_order_product_detail_sl_feet_mm']:'';
		$production_order_product_detail_s_weight_inches   	= isset($_POST['production_order_product_detail_s_weight_inches'])?$_POST['production_order_product_detail_s_weight_inches']:'';
		$production_order_product_detail_s_weight_mm   		= isset($_POST['production_order_product_detail_s_weight_mm'])?$_POST['production_order_product_detail_s_weight_mm']:'';
		$production_order_product_detail_qty 			 	= $_POST['production_order_product_detail_qty'];
		$production_order_product_detail_max_qty 			 	= $_POST['production_order_product_detail_max_qty'];
		$production_order_product_detail_tot_length 		= isset($_POST['production_order_product_detail_tot_length'])?$_POST['production_order_product_detail_tot_length']:'';
		$production_order_product_detail_s_weight_met 		= isset($_POST['production_order_product_detail_s_weight_met'])?$_POST['production_order_product_detail_s_weight_met']:'';
		$production_order_product_detail_rate 			  	= $_POST['production_order_product_detail_rate'];
		$production_order_product_detail_total 				= $_POST['production_order_product_detail_total'];
		$production_order_product_detail_product_thick		= $_POST['production_order_product_detail_product_thick'];
		$production_order_product_detail_mother_child_type		= $_POST['production_order_product_detail_mother_child_type'];

		$request_fields 						= ((!empty($production_order_branch_id)) && (!empty($production_order_date)));
		checkRequestFields($request_fields, PROJECT_PATH, "production-order-sale/index.php?page=edit&id=$production_order_uniq_id");
		$ip												= getRealIpAddr();
		$update_customer 					= sprintf("	UPDATE 
															production_order 
														SET 
															production_order_branch_id 					= '%d',
															production_order_date 						= '%s',
															production_order_production_section_id 		= '%d',
															production_order_customer_id 				= '%d',
															production_order_department_id 				= '%d',
															production_order_type 						= '%s',
															production_order_modified_by 				= '%d',
															production_order_modified_on 				= UNIX_TIMESTAMP(NOW()),
															production_order_modified_ip				= '%s'
														WHERE               
															production_order_id         				= '%d'", 
															$production_order_branch_id,
															$production_order_date,
															$production_order_production_section_id,
															$production_order_customer_id,
															$production_order_department_id,
															$production_order_type,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															 
															$production_order_id); 

		//echo $update_customer; exit;

		mysql_query($update_customer);

		for($i = 0; $i < count($production_order_product_detail_product_id); $i++) {

			$detail_request_fields = ((!empty($production_order_product_detail_product_id[$i])) &&

									 (!empty($production_order_product_detail_qty[$i])));

			if($detail_request_fields) {

				if(isset($production_order_product_detail_id[$i]) && (!empty($production_order_product_detail_id[$i]))) {

					$update_production_order_product_detail = sprintf("UPDATE 
																			production_order_product_details 
																		SET  
																			production_order_product_detail_width_inches  			= '%f',
																			production_order_product_detail_width_mm  				= '%f',
																			production_order_product_detail_s_width_inches  			= '%f',
																			production_order_product_detail_s_width_mm  				= '%f',
																			production_order_product_detail_sl_feet  					= '%f',
																			production_order_product_detail_sl_feet_in  				= '%f',
																			production_order_product_detail_sl_feet_mm  				= '%f',
																			production_order_product_detail_s_weight_inches  			= '%f',
																			production_order_product_detail_s_weight_mm  				= '%f',
																			production_order_product_detail_tot_length  				= '%f',
																			production_order_product_detail_qty  						= '%f',
																			production_order_product_detail_max_qty 					= '%f',
																			production_order_product_detail_s_weight_met 				= '%f',
																			production_order_product_detail_mother_child_type			= '%d',
																			production_order_product_detail_modified_by 				= '%d',
																			production_order_product_detail_modified_on 				= UNIX_TIMESTAMP(NOW()),
																			production_order_product_detail_modified_ip 				= '%s'
																		WHERE 
																			production_order_product_detail_production_order_id 	= '%d' AND 
																			production_order_product_detail_id 					= '%d'",
																			$production_order_product_detail_width_inches[$i],
																			$production_order_product_detail_width_mm[$i],
																			$production_order_product_detail_s_width_inches[$i],
																			$production_order_product_detail_s_width_mm[$i],
																			$production_order_product_detail_sl_feet[$i],
																			$production_order_product_detail_sl_feet_in[$i],
																			$production_order_product_detail_sl_feet_mm[$i],
																			$production_order_product_detail_s_weight_inches[$i],
																			$production_order_product_detail_s_weight_mm[$i],
																			$production_order_product_detail_tot_length[$i],
																			$production_order_product_detail_qty[$i],
																			$production_order_product_detail_max_qty[$i],
																			$production_order_product_detail_s_weight_met[$i],
																			$production_order_product_detail_mother_child_type[$i],
																			$_SESSION[SESS.'_session_user_id'], 
																			$ip, 
																			$production_order_id, 
																			$production_order_product_detail_id[$i]);	
			//	echo $update_production_order_product_detail; exit;
					mysql_query($update_production_order_product_detail);

					$production_order_detail_id			= 	$production_order_product_detail_id[$i];

				} else {

					$production_order_product_detail_uniq_id 	= generateUniqId();

					 $insert_production_order_product_detail 		= sprintf("INSERT INTO production_order_product_details 
																				(production_order_product_detail_uniq_id,production_order_product_detail_production_order_id,
																				 production_order_product_detail_product_id,
																				 production_order_product_detail_product_type, production_order_product_detail_product_thick,
																				 production_order_product_detail_width_inches,production_order_product_detail_width_mm,
																				 production_order_product_detail_s_width_inches,production_order_product_detail_s_width_mm,
																				 production_order_product_detail_sl_feet,production_order_product_detail_sl_feet_in,
																				 production_order_product_detail_sl_feet_mm,
																				 production_order_product_detail_s_weight_inches,production_order_product_detail_s_weight_mm,
																				 production_order_product_detail_qty,
																				 production_order_product_detail_tot_length,
																				 production_order_product_detail_added_by, 
																				 production_order_product_detail_added_on,
																				 production_order_product_detail_added_ip,
																				 production_order_product_detail_invoice_detail_id,
																				 production_order_product_detail_invoice_entry_id,
																				 production_order_product_detail_mother_child_type) 
																	VALUES     ('%s', '%d', 
																				'%d', 
																				'%d', '%f', 
																				'%f', '%f',
																				'%f', '%f', 
																				'%f', '%f', 
																				'%f', 
																				'%f', '%f',
																				'%f', '%f',
																				'%d', UNIX_TIMESTAMP(NOW()), '%s', '%d',
																				'%d')", 
																		 $production_order_product_detail_uniq_id,$production_order_id,
																		 $production_order_product_detail_product_id[$i],
																		 $production_order_product_detail_product_type[$i], $production_order_product_detail_product_thick[$i],
																		 $production_order_product_detail_width_inches[$i],$production_order_product_detail_width_mm[$i],
																		 $production_order_product_detail_s_width_inches[$i],$production_order_product_detail_s_width_mm[$i],
																		 $production_order_product_detail_sl_feet[$i],$production_order_product_detail_sl_feet_in[$i],
																		 $production_order_product_detail_sl_feet_mm[$i],
																		 $production_order_product_detail_s_weight_inches[$i],$production_order_product_detail_s_weight_mm[$i],
																		 $production_order_product_detail_qty[$i],$production_order_product_detail_tot_length[$i],
																		 $_SESSION[SESS.'_session_user_id'],$ip,$production_order_product_detail_invoice_detail_id[$i],
																		 $production_order_invoice_entry_id,
																		 $production_order_product_detail_mother_child_type[$i]);
																		// echo $insert_production_order_product_detail; exit;
				mysql_query($insert_production_order_product_detail);
				$production_order_detail_id		= mysql_insert_id();
				}
				
				
				/*$length_inches										= 	$production_order_product_detail_length_feet[$i];
				$width_inches										= 	$production_order_product_detail_width_inches[$i];
				$stock_ledger_prd_type								= 	$production_order_product_detail_type[$i];
				$stock_ledger_entry_type							=   "production-order-sale";
				$production_order_godown_id							= 	"2";
				stockLedger('out',$production_order_id,$production_order_detail_id,$production_order_product_detail_product_id[$i],$length_inches,$width_inches,($production_order_product_detail_qty[$i]*-1), $production_order_branch_id, $production_order_customer_id, $production_order_godown_id, $production_order_date, $production_order_no,$stock_ledger_entry_type,$stock_ledger_prd_type);*/

			}

		

		}

		pageRedirection("production-order-sale/index.php?page=edit&id=$production_order_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['production_order_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$production_order_uniq_id = $_GET['production_order_uniq_id'];

			mysql_query("UPDATE production_order_product_details SET production_order_product_detail_deleted_status = 1 

						WHERE production_order_product_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$production_order_uniq_id&msg=6");

		}

		

   } 		

	function deleteInventoryrequest(){

		deleteUniqRecords('production_order', 'production_order_deleted_by', 'production_order_deleted_on' , 'production_order_deleted_ip','production_order_deleted_status', 'production_order_id', 'production_order_uniq_id', '1');

		

		deleteMultiRecords('production_order_product_details', 'production_order_product_detail_deleted_by', 'production_order_product_detail_deleted_on', 'production_order_product_detail_deleted_ip', 'production_order_product_detail_deleted_status', 'production_order_product_detail_production_order_id', 'production_order','production_order_id','production_order_uniq_id', '1');  



		

		pageRedirection("production-order-sale/index.php?msg=7");				

	}

?>