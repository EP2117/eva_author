<?php 

	function get_supplier(){
	$select="SELECT * FROM  suppliers WHERE supplier_deleted_status =0";
	$query=mysql_query($select);
	
	while($result=mysql_fetch_array($query)){
	
	$record[]=$result;
	
	}
	return $record;
	}
	function GETBANK(){
	$select="SELECT account_sub_code,account_sub_name,account_sub_id FROM  account_sub WHERE account_sub_deleted_status =0 AND account_sub_type_id	 = 	'2' ";
	$query=mysql_query($select);
	
	while($result=mysql_fetch_array($query)){
	
	$record[]=$result;
	
	}
	return $record;
	}
	
	function GETCASH(){
	$select="SELECT account_sub_code,account_sub_name,account_sub_id FROM  account_sub WHERE account_sub_deleted_status =0 AND account_sub_type_id	 = 	1 ";
	//echo $select;exit;
	$query=mysql_query($select);
	
	while($result=mysql_fetch_array($query)){
	
	$record[]=$result;
	
	}
	return $record;
	}
	
	function GetAutoNo()
	{
		 $select_payment_no					= "SELECT MAX(payment_no) AS maxval 
																 
																 FROM 

																purchase_payment 

														   WHERE 

																p_deleted_status 	= 0";
																//echo  $select_payment_no;exit;
		$result_payment_no						= mysql_query($select_payment_no);
		$record_payment_no 						= mysql_fetch_array($result_payment_no);	
		$maxval 								= substr($record_payment_no['maxval'],3,7); 
		//echo $record_payment_no['maxval']; exit;
		if($maxval > 0) {
			$payment_no 							= substr(('00000'.++$maxval),-5);
			//echo $payment_no;exit;
		} else {
			$payment_no 							=substr(('00001'.++$maxval),-5);

		}
		return $payment_no;
	}

	function paymentInsertUpdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];	
		$branchid = $_POST['branchid'];	
		$ip	= getRealIpAddr();	
	
		$select_branch	= "SELECT branch_prefix FROM branches WHERE  branch_id = '".$branchid."' ";
		//echo $select_branch;exit;
		$result_branch = mysql_query($select_branch);
		$res = mysql_fetch_array($result_branch); 		  
		$payment_no='PM'.GetAutoNo();
		
		mysql_query("BEGIN");	
		
		
			if(empty($_REQUEST['id'])){
			
				 $query = "INSERT INTO purchase_payment SET p_branchid='".$_REQUEST['branchid']."', p_supplier_location='".$_REQUEST['supplier_location']."', p_supplier_name='".$_REQUEST['supplier_name']."', p_paymentdate='".NdateDatabaseFormat($_REQUEST['paymentdate'])."',p_paymentterm='".$_REQUEST['paymentterm']."',p_bankname='".$_REQUEST['bankname']."',p_acno='".$_REQUEST['acno']."',payment_currency_id='".$_REQUEST['payment_currency_id']."', payment_no='".$payment_no."' , payment_currency_rate='".$_REQUEST['payment_currency_rate']."',p_company_id='$bC', p_added_by='$by', p_added_on=NOW(), p_added_ip='$ip',p_cash='".$_REQUEST['cash']."'";
			//echo $query ;exit;
			
			}else{
			
				$query = "UPDATE purchase_payment SET p_branchid='".$_REQUEST['branchid']."', p_supplier_location='".$_REQUEST['supplier_location']."', p_supplier_name='".$_REQUEST['supplier_name']."',p_cash='".$_REQUEST['cash']."', p_paymentdate='".NdateDatabaseFormat($_REQUEST['paymentdate'])."',p_paymentterm='".$_REQUEST['paymentterm']."',p_bankname='".$_REQUEST['bankname']."',p_acno='".$_REQUEST['acno']."',payment_currency_id='".$_REQUEST['payment_currency_id']."',payment_no='".$payment_no."', p_modified_by='$by', p_modified_on=NOW(),p_modified_ip='$ip' WHERE paymentId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
				
				for($k=1;$k<=$_REQUEST['payment_count'];$k++){
				
	
					 if(empty($_REQUEST['iid_'.$k])){
					
					 	$query ="INSERT INTO purchase_payment_details SET pi_paymentId='".$last_id."', pi_invoiceId='".$_REQUEST['invoiceid_'.$k]."',pi_purchaseamnt='".$_REQUEST['purchaseamnt_'.$k]."',pi_advanceamnt='".$_REQUEST['advanceamnt_'.$k]."',pi_paidamnt='".$_REQUEST['paidamnt_'.$k]."',pi_paidamnt_cur='".$_REQUEST['paidamnt_cur_'.$k]."',pi_amount='".$_REQUEST['amount_'.$k]."',pi_amount_cur='".$_REQUEST['amount_cur_'.$k]."',pi_balanceamnt='".$_REQUEST['balanceamnt_'.$k]."',pi_balanceamnt_cur='".$_REQUEST['balanceamnt_cur_'.$k]."',pi_descount_per='".$_REQUEST['pay_det_desc_per_'.$k]."',pi_descount_amt='".$_REQUEST['pay_det_desc_amount_'.$k]."' ";
					 }else{
					   $query ="UPDATE purchase_payment_details SET pi_invoiceId='".$_REQUEST['invoiceid_'.$k]."',pi_purchaseamnt='".$_REQUEST['purchaseamnt_'.$k]."',pi_advanceamnt='".$_REQUEST['advanceamnt_'.$k]."',pi_paidamnt='".$_REQUEST['paidamnt_'.$k]."',pi_paidamnt_cur='".$_REQUEST['paidamnt_cur_'.$k]."',pi_amount='".$_REQUEST['amount_'.$k]."',pi_amount_cur='".$_REQUEST['amount_cur_'.$k]."',pi_balanceamnt='".$_REQUEST['balanceamnt_'.$k]."',pi_balanceamnt_cur='".$_REQUEST['balanceamnt_cur_'.$k]."',pi_descount_per='".$_REQUEST['pay_det_desc_per_'.$k]."',pi_descount_amt='".$_REQUEST['pay_det_desc_amount_'.$k]."' WHERE pi_paymentId='".$last_id."' AND paymentInvioiceId='".$_REQUEST['iid_'.$k]."'"; 
	
					 }					  				
					$qry 			= mysql_query($query);
					$detail_ids		= mysql_insert_id();
					$detail_id=($detail_ids=='')?$_REQUEST['iid_'.$k]:$detail_ids;
					//echo $detail_id;exit;
					$entry_no 		= substr(('000000'.$last_id),-5);
					$entry_date		= NdateDatabaseFormat($_REQUEST['paymentdate']);
					$branch_id		= $_REQUEST['branchid'];
					$bank_id		= $_REQUEST['bankname'];
					//$bank_id		= getMasterID($_REQUEST['bankname'], 'bank');
					
					$setup_detail	= GetBranchAccSetup($branch_id);
					//$cash_id		= $setup_detail['acS_sales_ac2'];
					$cash_id		= $_REQUEST['cash'];
					$pay_mode		= $_REQUEST['paymentterm'];
					$acc_dr_id		= ($pay_mode==1)?$cash_id:$bank_id;
					$acc_cr_id		= getMasterID($_REQUEST['supplier_name'], 'supplier');
					$acc_amount		= $_REQUEST['amount_'.$k];
					$acc_amount_cur	= $_REQUEST['amount_cur_'.$k];
					$entry_remark	= "Payment Amount";
					
					update_transaction($detail_id, $entry_no, $entry_date, 'purchase-payment', $acc_dr_id, $acc_cr_id, 'D', $acc_amount, $entry_remark, $branch_id,$acc_amount_cur);	
					update_transaction($detail_id, $entry_no, $entry_date, 'purchase-payment', $acc_cr_id, $acc_dr_id, 'C', $acc_amount, $entry_remark, $branch_id,$acc_amount_cur);
					
					if($_REQUEST['pay_det_desc_amount_'.$k]>0){
					
					$setup_detail	= GetBranchAccSetup($branch_id);
					$cash_id		= $setup_detail['acS_sales_ac2'];
					$acc_dr_id		= $cash_id;
					$acc_cr_id		= getMasterID($_REQUEST['supplier_name'], 'supplier');
					$acc_amount		= $_REQUEST['pay_det_desc_amount_'.$k];
					$acc_amount_cur	= (($acc_amount/$_REQUEST['payment_currency_rate'])>0)?($acc_amount/$_REQUEST['payment_currency_rate']):0;
					$entry_remark	= "Payment Discount";
						
						update_transaction($detail_id, $entry_no, $entry_date, 'purchase-payment-discount', $acc_dr_id, $acc_cr_id, 'D', $acc_amount, $entry_remark, $branch_id, $acc_amount_cur);	
						update_transaction($detail_id, $entry_no, $entry_date, 'purchase-payment-discount', $acc_cr_id, $acc_dr_id, 'C', $acc_amount, $entry_remark, $branch_id, $acc_amount_cur);
						
					}
					
						
					
					if(empty($qry)){					
						$rollBack=true;
						break;
					}
				}
				
			} 
			
			if(empty($rollBack)){	
				mysql_query("COMMIT");
				if(empty($_REQUEST['id'])){
					//exit;
					pageRedirection("eva-payment-entry/index.php?page=add&msg=1");	
				}else{
					pageRedirection("eva-payment-entry/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
		
	}
	function listPayment(){
	$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND p_branchid = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND p_paymentdate BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		if((isset($_REQUEST['search_supplier_id']))&& !empty($_REQUEST['search_supplier_id']))
		{
		$where.="AND p_supplier_name ='".$_REQUEST['search_supplier_id']."' ";
		}
		
		$query  = "SELECT payment_no,branch_name,DATE_FORMAT(p_paymentdate ,'%d/%m/%Y') AS p_paymentdate,supplier_name,paymentId
				    FROM purchase_payment
					LEFT JOIN branches ON p_branchid = branch_id
					LEFT JOIN suppliers ON 	supplier_id	 = p_supplier_name
					WHERE p_deleted_status=0 $where
					ORDER BY payment_no DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function paymentEdit($id){
		 $query  = "SELECT *,DATE_FORMAT(p_paymentdate ,'%d/%m/%Y') AS p_paymentdate,p_paymentterm
				    FROM purchase_payment 
					
					WHERE 
					p_deleted_status = 0 AND
					paymentId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function paymentDtailsEdit($id){
		
		 $query = "SELECT *,invoiceNo,pI_invoicetotal,pI_invoice_total_amt,pR_advanceAmnt,pR_advance_amount
					FROM purchase_payment_details 	
					LEFT JOIN purchase_invoice ON invoiceId = pi_invoiceId 
					LEFT JOIN
						purchase_order
					ON
						purchaseId							= pI_purchaseId			
					WHERE pi_paymentId='".$id."' AND
					purchase_payment_details.pi_deleted_status ='0' 
					";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
		function paymentdelete(){
	
	//print_r($_REQUEST['deleteCheck']);exit;
	if(isset($_REQUEST['deleteCheck']))
		{ 
			
				$checked      = $_POST['deleteCheck'];
				$count 		  = count($checked);
				for($i=0; $i < $count; $i++) 
				{ 
					$deleteCheck = $checked[$i]; 
					$ip 	= getRealIpAddr();
					
					
					     $update_addend 	= "UPDATE  purchase_payment
									SET 
										p_deleted_status    = '1',
										p_deleted_by    	   = '".$_SESSION[SESS.'_session_user_id']."',
		                                p_deleted_on        = UNIX_TIMESTAMP(NOW()),
		                                p_deleted_ip	        = '".$ip."'
								WHERE               
										paymentId             	= '".$deleteCheck."' ";
										//echo $update_addend;exit;
								mysql_query($update_addend);
				
					     $update_details	= "UPDATE  purchase_payment_details
									SET 
										pi_deleted_status    	= '1',
										pi_deleted_by    	   	= '".$_SESSION[SESS.'_session_user_id']."',
		                                pi_deleted_on        	= UNIX_TIMESTAMP(NOW()),
		                                pi_deleted_ip	        = '".$ip."'
								WHERE               
										pi_paymentId             	= '".$deleteCheck."' ";
										//print_r($update_overtime);//exit;
								mysql_query($update_details);
								
					$update_transaction	="UPDATE acc_transaction SET
												 acc_transaction_deleted_status      = 1,
												 acc_transaction_deleted_by    		= '".$_SESSION[SESS.'_session_user_id']."', 
												 acc_transaction_deleted_on    		= UNIX_TIMESTAMP(NOW()), 
												 acc_transaction_deleted_ip    		=	'".$ip."' 
										   WHERE acc_transaction_voucher_id 		= '".$deleteCheck."'
											 AND acc_transaction_type  	IN   ('purchase-payment-discount', 'purchase-payment') ";   
					
					mysql_query($update_transaction);		
					
				}	
				header("Location:index.php");
		}else{header("Location:index.php");}
		
	
	
	}
	
	 function deleteProductdetail()

      { echo 'test';exit;

		if((isset($_REQUEST['paymentInvioiceId'])) )

		{
          $ip	= getRealIpAddr();
		$paymentInvioiceId 	= $_GET['paymentInvioiceId'];

			$paymentId = $_GET['paymentId'];
			
			/*$select ="SELECT * FROM purchase_order WHERE purchaseId ='".$purchaseId."'";
			$query=mysql_query($select);
			$result = mysql_fetch_array($query);
			$pR_totalAmnt 	= $result['pR_totalAmnt'];
			$pR_advanceAmnt 	= $result['pR_advanceAmnt'];
			
			
			$select_details="SELECT * FROM purchase_order_products WHERE purOrdPorductId ='".$purOrdPorductId."'";
			
			$query_details=mysql_query($select_details);
			$result_details = mysql_fetch_array($query_details);
			
			 $pRp_unitprice 	= $result_details['pRp_unitprice'];
			 
			 $total_gross = $pR_totalAmnt - $pRp_unitprice; //echo "</br>";
			 $total_net = $total_gross - $pR_advanceAmnt;
			 
			 
			 $update = "UPDATE purchase_order SET pR_totalAmnt ='".$total_gross."',pR_net_total_amnt ='".$total_net."'
			 WHERE purchaseId ='".$purchaseId."'  ";//exit;*/
			
			 //mysql_query($update);
			
		 $delete = "UPDATE  purchase_payment_details SET pi_deleted_status = '1' ,
								pi_deleted_by ='".$_SESSION[SESS.'_session_user_id']."',
								pi_deleted_on =UNIX_TIMESTAMP(NOW()),
								pi_deleted_ip ='".$ip."'
						WHERE paymentInvioiceId	 = '".$paymentInvioiceId."' ";
						echo  $delete;exit;
			mysql_query($delete);

			header("Location:index.php");

		}

		

   } 

?>
