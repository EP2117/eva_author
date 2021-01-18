<?php 

	function listReport(){
		$where='';
		if($_REQUEST['type']==1){
			$where .= " group by account_sub_head_id";
		}
		 $id = $_REQUEST['type'];
		 
		 $query = "SELECT IF($id=1,account_head_id,account_sub_id) as id,IF($id=1,account_head_name,account_sub_name) as name FROM  account_sub
				   LEFT JOIN account_heads ON account_sub_head_id = account_head_id 
				   WHERE account_sub_deleted_status=0 and account_head_deleted_status=0 $where";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	
	function liablity_assets($id,$type,$fromdate,$todate){
		
		$response =array();
		
		if($type==1){
			
			$query ="SELECT account_sub_id FROM account_heads
					 LEFT JOIN account_sub ON account_head_id= account_sub_head_id
					 where account_sub_head_id='".$id."' ";
					 $result = mysql_query($query);
					 $data =array();
					 while($resultData = mysql_fetch_array($result)){		 
						array_push($data,$resultData['account_sub_id']);
					 }
					 
					$array_debit =$array_credit=0;
					
					foreach($data as $id){		   
					
						$query = "SELECT SUM(IF(aeA_credit_ac=$id,aeA_amount,0)) AS credit, SUM(IF(aeA_debit_ac=$id,aeA_amount,0)) AS debit  FROM account_payable
								WHERE (aeA_credit_ac = '".$id."' or aeA_debit_ac ='".$id."') AND (aeA_advance_date BETWEEN  '".date('Y-m-d',strtotime($fromdate))."' AND '".date('Y-m-d',strtotime($todate))."')";
								 
							 $result = mysql_query($query);
							 $response =array();
							 while($resultData = mysql_fetch_array($result)){		 
								$array_credit += $resultData['credit'];
								$array_debit += $resultData['debit'];
							 }		
					}
					$response['credit']=$array_credit;
					$response['debit']=$array_debit;
					
						
		}elseif($type==2){
			$query = "SELECT SUM(IF(aeA_credit_ac=$id,aeA_amount,0)) AS credit, SUM(IF(aeA_debit_ac=$id,aeA_amount,0)) AS debit  FROM account_payable
						LEFT JOIN account_sub ON account_sub_id=$id
						LEFT JOIN account_heads ON account_sub_head_id=account_head_id
						WHERE (aeA_credit_ac = '".$id."' or aeA_debit_ac = '".$id."') AND (aeA_advance_date BETWEEN  '".date('Y-m-d',strtotime($fromdate))."' AND '".date('Y-m-d',strtotime($todate))."')"; 
			 $result = mysql_query($query);	
			 $resultData = mysql_fetch_array($result);	
			 	 
			 $response['credit']= $resultData['credit'];
			 $response['debit']= $resultData['debit'];
			
		}
		
		return $response;
	}
	function listOpening($type, $date, $acc_id, $branch_id) {
		$where = '';
		$amt = 0;
		
		$select_opening = "SELECT SUM(acc_transaction_amount) AS open_amt FROM  acc_transaction 
								  WHERE acc_transaction_deleted_status = 0 AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'
								  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	
								  AND acc_transaction_branch_id = '".$branch_id."' AND acc_transaction_date < '".dateDatabaseFormat($date)."'
								  AND acc_transaction_cord = '".$type."' AND acc_transaction_account_id = '".$acc_id."'";
		$result_opening = mysql_query($select_opening);
		$record_opening = mysql_fetch_array($result_opening); 

		
		 $select_opening_balance = "SELECT oP_debit_amnt, oP_credit_amnt FROM  account_opening_balance 
								  WHERE oP_company_id = '".$_SESSION[SESS.'_session_company_id']."'
								  AND oP_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	
								  AND oP_branch_id =  '".$branch_id."'
								  AND oP_account_sub_id = '".$acc_id."'";
		$result_opening_balance = mysql_query($select_opening_balance);
		$record_opening_balance = mysql_fetch_array($result_opening_balance);
		if($type == 'C') {
			$amt = $record_opening_balance['oP_credit_amnt'] + $record_opening['open_amt'];
		} else {
			$amt = $record_opening_balance['oP_debit_amnt'] + $record_opening['open_amt'];
		}	
		if ($amt > 0) {
			return $amt;
		} else return 0;				
	}
	
	function listOpening_head($type, $date, $acc_id, $branch_id) {
		$where = '';
		$amt = 0;
		
		$select_opening = "SELECT SUM(acc_transaction_amount) AS open_amt, account_sub.account_sub_head_id
									FROM acc_transaction LEFT JOIN account_sub ON account_sub.account_sub_id = acc_transaction.acc_transaction_account_id  
								  WHERE acc_transaction_deleted_status = 0 AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'
								  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	
								  AND acc_transaction_branch_id = '".$branch_id."' AND acc_transaction_date < '".dateDatabaseFormat($date)."'
								  AND acc_transaction_cord = '".$type."' AND account_sub.account_sub_head_id = '".$acc_id."'";
		$result_opening = mysql_query($select_opening);
		$record_opening = mysql_fetch_array($result_opening); 

		
		 $select_opening_balance = "SELECT oP_debit_amnt, oP_credit_amnt, account_sub.account_sub_head_id FROM  account_opening_balance LEFT JOIN account_sub ON account_sub.account_sub_id = account_opening_balance.oP_account_sub_id 
								  WHERE oP_company_id = '".$_SESSION[SESS.'_session_company_id']."'
								  AND oP_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	
								  AND oP_branch_id =  '".$branch_id."'
								  AND account_sub.account_sub_head_id = '".$acc_id."'";
		$result_opening_balance = mysql_query($select_opening_balance);
		$record_opening_balance = mysql_fetch_array($result_opening_balance);
		if($type == 'C') {
			$amt = $record_opening_balance['oP_credit_amnt'] + $record_opening['open_amt'];
		} else {
			$amt = $record_opening_balance['oP_debit_amnt'] + $record_opening['open_amt'];
		}	
		if ($amt > 0) {
			return $amt;
		} else return 0;				
	}
	
	function ledgerReport($type="")
	{

		if($type == "detail") {
			$where =" account_sub_deleted_status = 0 "; 
			
			$select_accounts = "SELECT account_sub_type_id,account_sub_id, account_sub_name, account_head_name,
									CASE account_sub_code_type
										WHEN 'customer' THEN cus.customer_code
										WHEN 'supplier' THEN sup.supplier_code
									END as acc_code	
								FROM account_sub
								LEFT JOIN account_heads ON account_head_id  = account_sub_head_id 
								LEFT JOIN customers AS cus ON ( account_sub_code_type = 'customer' AND account_sub_master_id = cus.customer_id )
								LEFT JOIN suppliers AS sup ON ( account_sub_code_type = 'supplier' AND account_sub_master_id = sup.supplier_id )							
							  WHERE $where 
							  ORDER BY account_sub_name";
		} else {
				$where =" account_head_deleted_status = 0 "; 
			
			$select_accounts = "SELECT account_head_id, account_head_name, account_sub_type_id
								FROM account_heads LEFT JOIN account_sub ON account_sub.account_sub_head_id = account_heads.account_head_id						
							  WHERE $where GROUP BY account_head_id";
		}
		 $result = mysql_query($select_accounts);
 
  // Filling up the array
		  $accounts_data = array();
		 
		  while ($row = mysql_fetch_array($result))
		  {
			 $accounts_data[] = $row;
		  }
		return $accounts_data;
	}
	function getAccountTransaction($from_date, $to_date, $branch_id, $account_id, $type=''){
		if($type == "detail") {
			$select_ledger_entry = "SELECT SUM(CASE WHEN acc_transaction_cord = 'C' THEN acc_transaction_amount_mmk ELSE NULL END) AS cr_amt, 
										   SUM(CASE WHEN acc_transaction_cord = 'D' THEN acc_transaction_amount_mmk ELSE NULL END) AS dr_amt 
									FROM acc_transaction  
									WHERE acc_transaction_deleted_status =0 AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' 
									AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."' 
									AND acc_transaction_date BETWEEN '".NdateDatabaseFormat($from_date)."' AND '".NdateDatabaseFormat($to_date)."'
									AND acc_transaction_branch_id = '".dataValidation($branch_id)."'
									AND acc_transaction_account_id = '".dataValidation($account_id)."'
									GROUP BY acc_transaction_account_id";
		} else {
								
			$select_ledger_entry = "SELECT SUM(CASE WHEN acc_transaction_cord = 'C' THEN acc_transaction_amount_mmk ELSE NULL END) AS cr_amt, 
										   SUM(CASE WHEN acc_transaction_cord = 'D' THEN acc_transaction_amount_mmk ELSE NULL END) AS dr_amt, account_sub.account_sub_head_id
									FROM acc_transaction LEFT JOIN account_sub ON account_sub.account_sub_id = acc_transaction.acc_transaction_account_id
									WHERE acc_transaction_deleted_status =0 AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' 
									AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."' 
									AND acc_transaction_date BETWEEN '".NdateDatabaseFormat($from_date)."' AND '".NdateDatabaseFormat($to_date)."'
									AND acc_transaction_branch_id = '".dataValidation($branch_id)."'
									AND account_sub.account_sub_head_id = '".dataValidation($account_id)."'
									GROUP BY account_sub_head_id";
		}
								
		$result_ledger_entry = mysql_query($select_ledger_entry);
		$record_ledger_entry = mysql_fetch_array($result_ledger_entry);
		$cr_amt = $record_ledger_entry['cr_amt'];
		$dr_amt = $record_ledger_entry['dr_amt'];
		return array($cr_amt, $dr_amt);	
	
	}
?>
