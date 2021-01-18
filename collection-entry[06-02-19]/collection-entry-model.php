<?php

function bank(){

$select="SELECT * FROM banks WHERE bank_deleted_status=0"; 
$query=mysql_query($select);
while($result=mysql_fetch_array($query)){

$arr_bank[]=$result;
}
return $arr_bank;
}
	function insertPayment(){

		$collection_entry_branch_id                   	= trim($_POST['collection_entry_branch_id']);
		$collection_entry_customer_id                  	= trim($_POST['collection_entry_customer_id']);
		$collection_entry_date                 			= NdateDatabaseFormat($_POST['collection_entry_date']);
		$collection_entry_total_amount					= trim($_POST['collection_entry_total_amount']);
		$collection_entry_currency_id					= trim($_POST['collection_entry_currency_id']);
		//Product Detail
		$collection_entry_detail_invoice_entry_id     	= $_POST['collection_entry_detail_invoice_entry_id'];
		$collection_entry_detail_amount					= $_POST['collection_entry_detail_amount'];
		$collection_entry_detail_invoice_amount			= $_POST['collection_entry_detail_invoice_amount'];
		$collection_entry_detail_disc_amount			= $_POST['collection_entry_detail_disc_amount'];
		$collection_entry_detail_balance_amount			= $_POST['collection_entry_detail_balance_amount'];
		$collection_entry_detail_payment_mode     		= $_POST['collection_entry_detail_payment_mode'];
		$collection_entry_detail_bank_id     			= $_POST['collection_entry_detail_bank_id'];
		$collection_entry_detail_remarks     			= $_POST['collection_entry_detail_remarks'];
		$collection_entry_detail_paid_amount			= $_POST['collection_entry_detail_paid_amount'];
		$collection_entry_detail_customer_id 			= $_POST['collection_entry_detail_customer_id'];
		

		$request_fields 								= ((!empty($collection_entry_branch_id)) && (!empty($collection_entry_date)));

		checkRequestFields($request_fields, PROJECT_PATH, "collection-entry/index.php?page=add&msg=5");

		$collection_entry_uniq_id							= generateUniqId();

		$ip												= getRealIpAddr();

		

		$select_collection_entry_no						= "SELECT 

																MAX(collection_entry_no) AS maxval 

														   FROM 

																collection_entry 

														   WHERE 

																collection_entry_deleted_status 	= 0 												AND

																collection_entry_branch_id 		= '".$collection_entry_branch_id."'					AND

																collection_entry_financial_year 	= '".$_SESSION[SESS.'_session_financial_year']."'	AND

																collection_entry_company_id 		= '".$_SESSION[SESS.'_session_company_id']."'";



		$result_collection_entry_no 						= mysql_query($select_collection_entry_no);

		$record_collection_entry_no 						= mysql_fetch_array($result_collection_entry_no);	

		$maxval 										= $record_collection_entry_no['maxval']; 

		if($maxval > 0) {

			$collection_entry_no 							= substr(('00000'.++$maxval),-5);

		} else {

			$collection_entry_no 							= substr(('00000'.++$maxval),-5);

		}

		

		

	 $insert_collection_entry 							= sprintf("INSERT INTO collection_entry  (collection_entry_uniq_id, collection_entry_date,

																							   collection_entry_no,collection_entry_branch_id,
																							   collection_entry_currency_id,collection_entry_added_by,

																							   collection_entry_added_on,collection_entry_added_ip,

																							   collection_entry_company_id,collection_entry_financial_year,
																							   collection_entry_total_amount,collection_entry_customer_id) 

																					VALUES 	 ('%s', '%s', 
																							  '%s', '%d',
 																							  '%d',	'%d',
																							  UNIX_TIMESTAMP(NOW()),
																							  '%s', '%d', '%d','%f','%d')", 
																							   $collection_entry_uniq_id, $collection_entry_date,
																							   $collection_entry_no,$collection_entry_branch_id,
																							   $collection_entry_currency_id, $_SESSION[SESS.'_session_user_id'],
																							   $ip, $_SESSION[SESS.'_session_company_id'],
																							   $_SESSION[SESS.'_session_financial_year'],
																							   $collection_entry_total_amount,$collection_entry_customer_id);

		mysql_query($insert_collection_entry);

		//echo $insert_collection_entry; exit;

		$collection_entry_id 						= mysql_insert_id(); 

		//Product To details

		for($po_index = 0; $po_index < count($collection_entry_detail_invoice_entry_id); $po_index++) {

			$detail_request_fields 						= 	((!empty($collection_entry_detail_amount[$po_index])) && 

									 						(!empty($collection_entry_detail_invoice_entry_id[$po_index])));

			if($detail_request_fields) {

				$collection_entry_detail_uniq_id 		= generateUniqId();

				 $insert_collection_entry_detail 		= sprintf("INSERT INTO collection_entry_details (collection_entry_detail_uniq_id,  
																collection_entry_detail_amount,collection_entry_detail_disc_amount,
																collection_entry_detail_balance_amount,collection_entry_detail_payment_mode,
																collection_entry_detail_invoice_entry_id,collection_entry_detail_collection_entry_id,
																collection_entry_detail_added_by,
																collection_entry_detail_added_on, collection_entry_detail_added_ip,collection_entry_detail_bank_id,
																collection_entry_detail_invoice_amount,collection_entry_detail_remarks,
																collection_entry_detail_paid_amount) VALUES 
																('%s', '%f','%f','%f','%d', '%d', '%d', '%d',  UNIX_TIMESTAMP(NOW()), '%s','%d','%f','%s','%f')", 
																$collection_entry_detail_uniq_id, 
																$collection_entry_detail_amount[$po_index],$collection_entry_detail_disc_amount[$po_index],
																$collection_entry_detail_balance_amount[$po_index],$collection_entry_detail_payment_mode[$po_index],
																$collection_entry_detail_invoice_entry_id[$po_index],
																$collection_entry_id, $_SESSION[SESS.'_session_user_id'],$ip,
																$collection_entry_detail_bank_id[$po_index],
																$collection_entry_detail_invoice_amount[$po_index],
																$collection_entry_detail_remarks[$po_index],
																$collection_entry_detail_paid_amount[$po_index]);//exit;

				mysql_query($insert_collection_entry_detail);
				$entry_id		= mysql_insert_id();
				
				$entry_no 		= $collection_entry_no;
				$entry_date		= $collection_entry_date;
				$acc_amount		= $collection_entry_detail_amount[$po_index];
				$entry_remark	= $collection_entry_detail_remarks[$po_index];
				$branch_id		= $collection_entry_branch_id;
				$pay_mode		= $collection_entry_detail_payment_mode[$po_index]; 
				$acc_dr_id		= getMasterID($collection_entry_detail_customer_id[$po_index], 'customer');
				//$bank_id		= getMasterID($collection_entry_detail_bank_id[$po_index], 'bank');
				$bank_id		= $collection_entry_detail_bank_id[$po_index];
				$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
				$cash_id		= $setup_detail['acS_sales_ac2'];
				$acc_cr_id		= ($pay_mode==1)?$cash_id:$bank_id;
				$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
				$acc_amount_mmk	= $acc_amount/$currency_amt;
				//update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);	
				//update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);	
				$acc_amount_mmk	= $acc_amount/$currency_amt;
				$acc_amount_mmk	= ($acc_amount_mmk==$acc_amount)?0:$acc_amount_mmk;
				update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);	
				$dr_currency_amt	= getCurrencyAmt($acc_dr_id,$collection_entry_date);
				$acc_amount_mmk	= $acc_amount/$dr_currency_amt;
				$acc_amount_mmk	= ($acc_amount_mmk==$acc_amount)?0:$acc_amount_mmk;
				update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);			
						
			}

		

		}
		pageRedirection("collection-entry/index.php?page=add&msg=1");

	}

	function listSalesreturn(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND collection_entry_branch_id = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND collection_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['customerid']))&& !empty($_REQUEST['customerid']))
		{
		$where.="AND collection_entry_customer_id ='".$_REQUEST['customerid']."'";
		}
		$select_collection_entry		=	"SELECT 

												collection_entry_id,

												collection_entry_uniq_id,

												collection_entry_no,

												collection_entry_date,
												customer_name,
												collection_entry_total_amount

											 FROM 

												collection_entry
											 LEFT JOIN
												customers
											 ON
												customer_id		=  collection_entry_customer_id
											 WHERE 

												collection_entry_deleted_status 	= 	0  $where

											 ORDER BY 

												collection_entry_no ASC";

		$result_collection_entry		= mysql_query($select_collection_entry);

		// Filling up the array

		$collection_entry_data 		= array();

		while ($record_collection_entry = mysql_fetch_array($result_collection_entry))

		{

		 $collection_entry_data[] 	= $record_collection_entry;

		}

		return $collection_entry_data;

	}

	function editQuotation(){

		$collection_entry_id 			= getId('collection_entry', 'collection_entry_id', 'collection_entry_uniq_id', dataValidation($_GET['id'])); 

		 $select_collection_entry		=	"SELECT 

												collection_entry_uniq_id, collection_entry_date,

												collection_entry_no,collection_entry_branch_id,

												collection_entry_payment_mode,collection_entry_salesman_id,

												collection_entry_total_amount,collection_entry_id,
												collection_entry_currency_id,collection_entry_customer_id

											 FROM 

												collection_entry

											 WHERE 

												collection_entry_deleted_status 	=  0 			AND 

												collection_entry_id				= '".$collection_entry_id."'

											 ORDER BY 

												collection_entry_no ASC";//;exit;

		$result_collection_entry 		= mysql_query($select_collection_entry);

		$record_collection_entry 		= mysql_fetch_array($result_collection_entry);

		return $record_collection_entry;

	}

	function editPaymentDetail()

	{

		$collection_entry_id 	= getId('collection_entry', 'collection_entry_id', 'collection_entry_uniq_id', dataValidation($_GET['id'])); 

		  $select_collection_entry_detail 	= "	SELECT 

													*
													
													FROM 

														collection_entry_details

													LEFT JOIN 

														invoice_entry 

													ON 

														invoice_entry_id 							= collection_entry_detail_invoice_entry_id

													
													WHERE 

														collection_entry_detail_deleted_status		 	= 0 							AND 

														collection_entry_detail_collection_entry_id 		= '".$collection_entry_id."'";//exit;

		$result_collection_entry_detail 	= mysql_query($select_collection_entry_detail);

		$count_collection_entry 					= mysql_num_rows($result_collection_entry_detail);

		$arr_collection_entry_product_to_detail 	= array();

		

		while($record_collection_entry_product_to_detail = mysql_fetch_array($result_collection_entry_detail)) {

			$arr_collection_entry_product_to_detail[] = $record_collection_entry_product_to_detail;

		}

		return $arr_collection_entry_product_to_detail;

	}

	

	function updateQuotation(){

		$collection_entry_branch_id                   	= trim($_POST['collection_entry_branch_id']);

		$collection_entry_date                 			= NdateDatabaseFormat($_POST['collection_entry_date']);
		$collection_entry_total_amount					= trim($_POST['collection_entry_total_amount']);
		
		$collection_entry_uniq_id						= trim($_POST['collection_entry_uniq_id']);
		$collection_entry_id							= trim($_POST['collection_entry_id']);
		$collection_entry_currency_id					= trim($_POST['collection_entry_currency_id']);
		$collection_entry_no							= trim($_POST['collection_entry_no']);
		$collection_entry_customer_id							= trim($_POST['collection_entry_customer_id']);
		//Product Detail

		$collection_entry_detail_invoice_entry_id     	= $_POST['collection_entry_detail_invoice_entry_id'];

		 $collection_entry_detail_amount					= $_POST['collection_entry_detail_amount'];
		 $collection_entry_detail_invoice_amount			= $_POST['collection_entry_detail_invoice_amount'];

		$collection_entry_detail_disc_amount			= $_POST['collection_entry_detail_disc_amount'];

		$collection_entry_detail_balance_amount			= $_POST['collection_entry_detail_balance_amount'];

		$collection_entry_detail_payment_mode     		= $_POST['collection_entry_detail_payment_mode'];

		$collection_entry_detail_bank_id     			= $_POST['collection_entry_detail_bank_id'];

		$collection_entry_detail_remarks     			= $_POST['collection_entry_detail_remarks'];
		
		$collection_entry_detail_id						= $_POST['collection_entry_detail_id'];
		$collection_entry_detail_customer_id						= $_POST['collection_entry_detail_customer_id'];
		$collection_entry_detail_paid_amount			= $_POST['collection_entry_detail_paid_amount'];

		$request_fields 						= ((!empty($collection_entry_branch_id)) && (!empty($collection_entry_date)));

		

		checkRequestFields($request_fields, PROJECT_PATH, "collection-entry/index.php?page=edit&id=$collection_entry_uniq_id");

		$ip												= getRealIpAddr();

		 $update_customer 					= sprintf("	UPDATE 

															collection_entry 

														SET 

															collection_entry_branch_id 				= '%d',
															collection_entry_currency_id 			= '%d',
															collection_entry_date 					= '%s',
															collection_entry_total_amount 			= '%f',
															collection_entry_modified_by 			= '%d',
															collection_entry_modified_on 			= UNIX_TIMESTAMP(NOW()),
															collection_entry_modified_ip			= '%s'
														WHERE               
															collection_entry_id         			= '%d'", 
															$collection_entry_branch_id,
															$collection_entry_currency_id,
															$collection_entry_date,
															$collection_entry_total_amount,
															$_SESSION[SESS.'_session_user_id'], 
															$ip, 
															$collection_entry_id); //exit;

		mysql_query($update_customer);

		

		for($po_index = 0; $po_index < count($collection_entry_detail_invoice_amount); $po_index++) {

			$detail_request_fields 						= 	((!empty($collection_entry_detail_amount[$po_index])) && 

									 						(!empty($collection_entry_detail_invoice_entry_id[$po_index])));

			if($detail_request_fields) {

				if(isset($collection_entry_detail_id[$po_index]) && (!empty($collection_entry_detail_id[$po_index]))) {

					$update_collection_entry_detail 			= sprintf("	UPDATE 

																			collection_entry_details 

																		SET  

																			collection_entry_detail_amount  		= '%f',
																			
																			collection_entry_detail_invoice_amount  = '%f',
																			
																			collection_entry_detail_disc_amount  	= '%f',
																			
																			collection_entry_detail_balance_amount  = '%f',
																			collection_entry_detail_paid_amount		= '%f',
																			collection_entry_detail_payment_mode	= '%d',
																			collection_entry_detail_bank_id			= '%d',
																			collection_entry_detail_remarks			= '%s',
																			collection_entry_detail_modified_by 	= '%d',

																			collection_entry_detail_modified_on 	= UNIX_TIMESTAMP(NOW()),

																			collection_entry_detail_modified_ip 	= '%s'

																		WHERE 

																			collection_entry_detail_collection_entry_id 	= '%d' AND 

																			collection_entry_detail_id 				= '%d'",

																			$collection_entry_detail_amount[$po_index],
																			$collection_entry_detail_invoice_amount[$po_index],
																			$collection_entry_detail_disc_amount[$po_index],
																			$collection_entry_detail_balance_amount[$po_index],
																			$collection_entry_detail_paid_amount[$po_index],
																			$collection_entry_detail_payment_mode[$po_index],
																			$collection_entry_detail_bank_id[$po_index],
																			$collection_entry_detail_remarks[$po_index],

																			$_SESSION[SESS.'_session_user_id'], 

																			$ip, 

																			$collection_entry_id, 

																			$collection_entry_detail_id[$po_index]);//exit;

					mysql_query($update_collection_entry_detail);

					$entry_id			= 	$collection_entry_detail_id[$po_index];

				} else {

					$collection_entry_detail_uniq_id 		= generateUniqId();

					$insert_collection_entry_detail 		= sprintf("INSERT INTO collection_entry_details (collection_entry_detail_uniq_id,  

																	collection_entry_detail_amount,collection_entry_detail_invoice_amount,
																	collection_entry_detail_disc_amount,collection_entry_detail_balance_amount,
																	
																	collection_entry_detail_payment_mode,collection_entry_detail_bank_id,

																	collection_entry_detail_invoice_entry_id,collection_entry_detail_collection_entry_id,

																	collection_entry_detail_added_by,

																	collection_entry_detail_added_on, collection_entry_detail_added_ip,collection_entry_detail_remarks,
																	collection_entry_detail_paid_amount) VALUES 

																	('%s', '%f','%f','%f','%f','%d', '%d', '%d','%d', '%d','%d', UNIX_TIMESTAMP(NOW()), '%s','%s',
																	'%f')", 

																	$collection_entry_detail_uniq_id, 

																	$collection_entry_detail_amount[$po_index],
																			$collection_entry_detail_invoice_amount[$po_index],
																			$collection_entry_detail_disc_amount[$po_index],
																			$collection_entry_detail_balance_amount[$po_index],

																			$collection_entry_detail_payment_mode[$po_index],
																			$collection_entry_detail_bank_id[$po_index],

																	$collection_entry_id, $_SESSION[SESS.'_session_user_id'],$ip,
																	$collection_entry_detail_remarks[$po_index],
																	$collection_entry_detail_paid_amount[$po_index]);

					mysql_query($insert_collection_entry_detail);
					$entry_id	= mysql_insert_id();
				}
				
				$entry_no 		= $collection_entry_no;
				$entry_date		= $collection_entry_date;
				$acc_amount		= $collection_entry_detail_amount[$po_index];
				$entry_remark	= $collection_entry_detail_remarks[$po_index];
				$branch_id		= $collection_entry_branch_id;
				$pay_mode		= $collection_entry_detail_payment_mode[$po_index]; 
				$acc_dr_id		= getMasterID($collection_entry_detail_customer_id[$po_index], 'customer');
				//$bank_id		= getMasterID($collection_entry_detail_bank_id[$po_index], 'bank');
				$bank_id		= $collection_entry_detail_bank_id[$po_index];
				$setup_detail	= GetBranchAccSetup($collection_entry_branch_id);
				$cash_id		= $setup_detail['acS_sales_ac2'];
				$acc_cr_id		= ($pay_mode==1)?$cash_id:$bank_id;
				$currency_amt	= getCurrencyAmt($acc_cr_id,$collection_entry_date);
				$acc_amount_mmk	= $acc_amount/$currency_amt;
				$acc_amount_mmk	= ($acc_amount_mmk==$acc_amount)?0:$acc_amount_mmk;
				update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_dr_id, $acc_cr_id, 'D', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);	
				$dr_currency_amt	= getCurrencyAmt($acc_dr_id,$collection_entry_date);
				$acc_amount_mmk	= $acc_amount/$dr_currency_amt;
				$acc_amount_mmk	= ($acc_amount_mmk==$acc_amount)?0:$acc_amount_mmk;
				update_transaction($entry_id, $entry_no, $entry_date, 'collection', $acc_cr_id, $acc_dr_id, 'C', $acc_amount_mmk, $entry_remark, $branch_id,$acc_amount);			
				

			}

		}

		

		pageRedirection("collection-entry/index.php?page=edit&id=$collection_entry_uniq_id&msg=2");			

	}

    function deleteProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['collection_entry_uniq_id'])))

		{

			$product_detail_id 	= $_GET['product_detail_id'];

			$collection_entry_uniq_id = $_GET['collection_entry_uniq_id'];

			mysql_query("UPDATE collection_entry_product_to_details SET collection_entry_product_to_detail_deleted_status = 1 

						WHERE collection_entry_product_to_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$collection_entry_uniq_id&msg=6");

		}

   }

   function deletefrmProductdetail()

   {

		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['collection_entry_uniq_id'])))

		{

			$product_detail_id 		= $_GET['product_detail_id'];

			$collection_entry_uniq_id 	= $_GET['collection_entry_uniq_id'];

			mysql_query("UPDATE collection_entry_product_frm_details SET collection_entry_product_frm_detail_deleted_status = 1 

						WHERE collection_entry_product_frm_detail_id = ".$product_detail_id." ");

			header("Location:index.php?page=edit&id=$collection_entry_uniq_id&msg=6");

		}

   } 

   function ReceivedQty($detail_id){

   		$select_rec_qty			= "SELECT 

										SUM(collection_entry_product_to_detail_qty) AS sus_qty 

									FROM 

										collection_entry_product_to_details  	

									WHERE 

										collection_entry_product_to_detail_deleted_status 				= 0  					AND

										collection_entry_product_to_detail_product_invoice_detail_id		= '".$detail_id."'					

									GROUP BY 

										collection_entry_product_to_detail_product_invoice_detail_id";

		$result_rec_qty			= mysql_query($select_rec_qty);

		$record_rec_qty 		= mysql_fetch_array($result_rec_qty);

		return $record_rec_qty['sus_qty'];

   }

   function ReceivedfrmQty($detail_id){

   		$select_rec_qty			= "SELECT 

										SUM(collection_entry_product_frm_detail_qty) AS sus_qty 

									FROM 

										collection_entry_product_frm_details  	

									WHERE 

										collection_entry_product_frm_detail_deleted_status 				= 0  					AND

										collection_entry_product_frm_detail_product_invoice_detail_id		= '".$detail_id."'					

									GROUP BY 

										collection_entry_product_frm_detail_product_invoice_detail_id";

		$result_rec_qty			= mysql_query($select_rec_qty);

		$record_rec_qty 		= mysql_fetch_array($result_rec_qty);

		return $record_rec_qty['sus_qty'];

   }		

	function deleteSuspensentry(){

		deleteUniqRecords('collection_entry', 'collection_entry_deleted_by', 'collection_entry_deleted_on' , 'collection_entry_deleted_ip','collection_entry_deleted_status', 'collection_entry_id', 'collection_entry_uniq_id', '1');
		
	$ip = getRealIpAddr();
	$checked = $_POST['deleteCheck'];
	$count = count($checked);

	for($i=0; $i < $count; $i++) {
		$deleteCheck = $checked[$i]; 
		$detail_id = getId('collection_entry', 'collection_entry_id', 'collection_entry_uniq_id', $deleteCheck); 
   		$select_rec_qty			= "SELECT 
										collection_entry_detail_id
									FROM 
										collection_entry_details  	
									WHERE 
										collection_entry_detail_deleted_status 			= 0  					AND
										collection_entry_detail_collection_entry_id		= '".$detail_id."'					
									GROUP BY 
										collection_entry_detail_id"; 

		$result_rec_qty			= mysql_query($select_rec_qty);
		while($record_collection_entry = mysql_fetch_array($result_rec_qty)) {
				DeleteAccountTrasaction($record_collection_entry['collection_entry_detail_id'],'collection');
		}
	}

		deleteMultiRecords('collection_entry_details', 'collection_entry_detail_deleted_by', 'collection_entry_detail_deleted_on', 'collection_entry_detail_deleted_ip', 'collection_entry_detail_deleted_status', 'collection_entry_detail_collection_entry_id', 'collection_entry','collection_entry_id','collection_entry_uniq_id', '1');  
		
		pageRedirection("collection-entry/index.php?msg=7");				

	}



?>