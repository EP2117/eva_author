<?php

	function group_by($key, $data) {
		$result = array();

		foreach($data as $val) {
			if(array_key_exists($key, $val)){
				$result[$val[$key]][] = $val;
			}else{
				$result[""][] = $val;
			}
		}

		return $result;
	}

	function listReport(){
		$where='';
		if($_REQUEST['type']==1){
			$where .= " group by account_sub_head_id";
		}
		 $id = $_REQUEST['type'];
		 
		 $query = "SELECT IF($id=1,account_head_id,account_sub_id) as id,IF($id=1,account_head_name,account_sub_name) as name FROM  account_sub
				   LEFT JOIN account_heads ON account_sub_head_id = account_head_id 
				   WHERE account_sub_deleted_status=0 and account_head_deleted_status=0 and account_head_type1 NOT IN ('bs') $where";
		 $result = mysql_query($query);
		 $response =array();
		
			 while($resultData = mysql_fetch_array($result)){		 
				$response[]= $resultData;
			 }
		
		return $response;
	}
	
	function profit_loss($id,$type,$fromdate,$todate){
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
								WHERE (aeA_credit_ac = '".$id."' or aeA_debit_ac = '".$id."') AND (aeA_advance_date BETWEEN  '".date('Y-m-d',strtotime($fromdate))."' AND '".date('Y-m-d',strtotime($todate))."')";
								 
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
	function getCreditTotal($group_id,$acc_id,$where,$group_by){
		$acc ='';
		if($acc_id != ''){
			$acc = " AND acc_transaction_account_id = '".$acc_id."'";
		}

	 	$select_credit_total = "SELECT SUM(acc_transaction_amount) AS amount FROM  acc_transaction
						 LEFT JOIN account_sub ON account_sub_id = acc_transaction_account_id
						 LEFT JOIN account_heads ON account_head_id =  account_sub_head_id 
								WHERE acc_transaction_cord = 'C' AND acc_transaction_deleted_status = 0 
								AND  account_head_type1 ='pl' AND account_sub_head_id = '".$group_id."' 
								AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND account_sub_deleted_status = 0
								$acc $where
								GROUP BY $group_by"; 
		$result_credit_total = mysql_query($select_credit_total);
		$credit_total  = mysql_fetch_array($result_credit_total);
		return $credit_total['amount'];
		if($credit_total['amount'] == ' '){
			return 0;
		}
	}
	function getDebitTotal($group_id,$acc_id,$where,$group_by){
		$acc 		='';
		if($acc_id != ''){
			$acc = " AND acc_transaction_account_id = '".$acc_id."'";
		}		
		$select_debit_total = " SELECT SUM(acc_transaction_amount) AS amount FROM  acc_transaction
						 LEFT JOIN account_sub ON account_sub_id = acc_transaction_account_id
						 LEFT JOIN account_heads ON account_head_id =  account_sub_head_id 
								WHERE acc_transaction_cord = 'D' AND acc_transaction_deleted_status = 0 
								AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
								AND  account_head_type1 ='pl' AND account_sub_head_id = '".$group_id."' AND account_sub_deleted_status = 0 
								$acc $where
								GROUP BY $group_by";
		$result_debit_total = mysql_query($select_debit_total);
		$debit_total  = mysql_fetch_array($result_debit_total);
		return $debit_total['amount'];
		if($debit_total['amount'] == ' '){
			return 0;
		}			
	}	
	
	
	function DetailledgerReport()
	{ 
		$where	='';	
		if(!empty($_REQUEST['type'])) {
			$search_report_type = $_REQUEST['type'];
		}else{
			$search_report_type= '';
		}

		if(!empty($_REQUEST['fromdate'])) {
			$trip_from_date              = NdateDatabaseFormat($_REQUEST['fromdate']);
		}
		if(!empty($_REQUEST['todate'])) {
			$to_date_search               = NdateDatabaseFormat($_REQUEST['todate']);
		} 
	 
	
		if((!empty($trip_from_date)) && (!empty($to_date_search)) ){
			$where .=  " AND  acc_transaction_date  BETWEEN '".$trip_from_date."' AND '".$to_date_search."'";  
		}
	

		if(isset($_GET['branchid'])) {
			$search_branch_id = $_GET['branchid']; 
		} else {
			$search_branch_id = ""; 
		}	
	
		//Selecttion for all branch entries
 		if($search_branch_id != '') {
		
			if (($_SESSION['session_type'] == 'multi'))  {
			 $where .= " AND acc_transaction_branch_id IN (".$_SESSION[SESS.'session_user_branch_id'].") ";
		} 
		else if ($_SESSION['session_type'] == 'single')  {
			$where .= " AND acc_transaction_branch_id = '".$_SESSION[SESS.'session_user_branch_id']."' ";
		}  else {
				$where .= "AND acc_transaction_branch_id = '".$search_branch_id."'";
			}	
		}
			 $pl_arr 		= array();
			 $pl_income_arr = array();
		$lsno = 0; 
		$asno = 0; 	
		$last_sno = 0;
		$tmp_amt = 0;
		
		$left_total = 0;
		$right_total = 0;
		$left_sub_total = 0;
		$right_sub_total = 0;
		$id ='';	
		$sno1 = 1;
		$sno2 = 1;
	
	
		if ($search_report_type == '1') {
		 	$select_account_name = "SELECT account_head_id, account_head_code,account_head_name, account_head_type1, account_account_head_type2
									FROM account_heads 
									WHERE  account_head_deleted_status = 0
									AND account_head_type1 = '1'  AND account_head_type2 IN	('op','pu','ci','sa','cl','mf')
									ORDER BY account_head_name"; 
//									GROUP BY account_group_name ASC"; 
										
		} else {
		 	 $select_account_name = "SELECT account_sub_id, account_sub_name, account_head_id, 
			 						account_head_name,account_head_code, account_head_type1, account_head_type2, account_sub_code,account_sub_type_id
									FROM account_sub 
									INNER JOIN account_heads ON account_head_id = account_sub_head_id
									WHERE account_head_type1 = 'pl'  AND account_head_type2 IN	('op','pu','ci','sa','cl','mf') 
									AND account_head_deleted_status = 0 AND account_sub_deleted_status = 0 GROUP BY account_sub_head_id
									 ORDER BY account_head_name ASC, account_sub_name ASC";	 	
									// AND account_group_deleted_status = 0 GROUP BY account_group_name, accounts_name ASC"; 
		}	
		$result_account_name = mysql_query($select_account_name);
		$row_account_name = mysql_num_rows($result_account_name);
		

		while($record_account_name  = mysql_fetch_array($result_account_name )) {
			
			if ($search_report_type == '1') {
				$account_id 			 = $record_account_name['account_head_id'];
				$acc_id 			 	 = '';
				$account_sub_type_id	 	 	 = '';
				$acc_name 			 	 = $record_account_name['account_head_name']." - ".$record_account_name['account_head_code'];
				$acc_group_credit_amount = getCreditTotal($record_account_name['account_head_id'],'',$where, 'account_head_id');
				$acc_group_debit_amount	 = getDebitTotal($record_account_name['account_head_id'], '',$where, 'account_head_id');					
			} else {
				$account_id 			 = $record_account_name['account_head_id'];
				$acc_id 			 	 = $record_account_name['account_sub_id'];
				$account_sub_type_id	 	= $record_account_name['account_sub_type_id'];
				$acc_name 			 	 = $record_account_name['account_sub_name'].' - '.$record_account_name['account_sub_code'];				
				$acc_group_credit_amount = getCreditTotal($record_account_name['account_head_id'],$record_account_name['account_sub_id'],$where, 'acc_transaction_account_id');
				$acc_group_debit_amount	 = getDebitTotal($record_account_name['account_head_id'], $record_account_name['account_sub_id'],$where, 'acc_transaction_account_id');					
			}		
			$group_type2 			 =  $record_account_name['account_head_type2'];		
			$total_amount = $acc_group_credit_amount + $acc_group_debit_amount;
			
	
			
			if($total_amount > 0){
				if( ($group_type2 == 'op') ||($group_type2 == 'pu')  || ($group_type2 == 'ci')) {	
					if(($acc_group_credit_amount - $acc_group_debit_amount) < 0){
						$group_print_side = 'A';
					} else {
						$group_print_side = 'L';
					}	
				}	
				
				if( ($group_type2 == 'sa') || ($group_type2 == 'cl')   ) {	
					if(($acc_group_debit_amount - $acc_group_credit_amount) < 0){
						$group_print_side = 'L';
					} else {
						$group_print_side = 'A';
					}	
				}	
				
				if($group_print_side == 'L'){
				
					if ($search_report_type == 'detailed') {
						if ($id != $account_id) {
							if ($sno1 != 1) {
								$pl_arr[$lsno][0] = "Total";
								$pl_arr[$lsno][1] = number_format($left_sub_total,2,'.','');
								$lsno = $lsno + 1;							
							}						
							$pl_arr[$lsno][0] = "<strong>".$record_account_name['account_head_name']." - ".$record_account_name['account_head_code']."</strong>";
							$pl_arr[$lsno][1] = '';	
							$lsno = $lsno + 1;	
							$left_sub_total = 0;	
							$sno1 = 1;
						}
					}					
					$tmp_amt = $acc_group_debit_amount - $acc_group_credit_amount;
					if($tmp_amt < 0){
						$tmp_amt =	$tmp_amt * -1;	
					}	
					if($tmp_amt != 0){
						$pl_arr[$lsno][0] = $acc_name;						
						$pl_arr[$lsno][1] = number_format($tmp_amt,2,'.','');
						$pl_arr[$lsno][4] = $acc_id;
						$pl_arr[$lsno][5] = $account_sub_type_id;
					}			
					if($tmp_amt == 0){
						$pl_arr[$lsno][0] = $acc_name;
						$pl_arr[$lsno][1] = number_format($tmp_amt,2,'.','');
						$pl_arr[$lsno][4] = $acc_id;
						$pl_arr[$lsno][5] = $account_sub_type_id;
					}
//					$pl_arr[$lsno][2] = '';
//					$pl_arr[$lsno][3] = '';	
					$left_total = $left_total + $tmp_amt;	
					$left_sub_total = $left_sub_total + $tmp_amt;	
					$lsno = $lsno + 1;	
					$sno1 = $sno1 + 1;			
				} else {
					if ($search_report_type == 'detailed') {
						if ($id != $account_id) {
							if ($sno2 != 1) {
								$pl_income_arr[$asno][2] = "Total";
								$pl_income_arr[$asno][3] = number_format($right_sub_total,2,'.','');
								$asno = $asno + 1;							
							}							
							$pl_income_arr[$asno][2] = "<strong>".$record_account_name['account_head_name']." - ".$record_account_name['account_head_code']."</strong>";
							$pl_income_arr[$asno][3] = '';	
							$asno = $asno + 1;	
							$sno2 = 1;	
							$right_sub_total = 0;												
						}
					}					
					$tmp_amt = $acc_group_credit_amount - $acc_group_debit_amount;
					if($tmp_amt < 0){
						$tmp_amt =	$tmp_amt * -1;	
					}	
					if($tmp_amt != 0){
						$pl_income_arr[$asno][2] = $acc_name;						
						$pl_income_arr[$asno][3] = number_format($tmp_amt,2,'.','');
						$pl_income_arr[$lsno][6] = $acc_id;
						$pl_income_arr[$lsno][7] = $account_sub_type_id;
					}	
					if($tmp_amt == 0){
						$pl_income_arr[$asno][2] = $acc_name;
						$pl_income_arr[$asno][3] = number_format($tmp_amt,2,'.','');
						$pl_income_arr[$lsno][6] = $acc_id;
						$pl_income_arr[$lsno][7] = $account_sub_type_id;
					}	
//					$pl_arr[$asno][0] = '';
//					$pl_arr[$asno][1] = '';
					$right_total = $right_total + $tmp_amt;	
					$right_sub_total = $right_sub_total + $tmp_amt;
					$asno = $asno + 1;	
					$sno2 = $sno2 + 1;							
				}
				if ($search_report_type == 'detailed') {
					$id = $account_id;
				}			  
			}
		}		
	
		if($lsno > $asno) {
			$last_sno = $lsno;
		} else {
			$last_sno = $asno;	
		}
	
		if($last_sno > 0){
			if(($left_total - $right_total) < 0) {
				$pl_arr[$last_sno][0] = 'Gross Profit c/f';
				$pl_arr[$last_sno][1] = number_format(($right_total - $left_total),2,'.','');	
				$last_sno = $last_sno + 1;
			}
			if(($right_total - $left_total) < 0) {
				$pl_income_arr[$last_sno][2] = 'Gross Loss c/f';
				$pl_income_arr[$last_sno][3] = number_format(($left_total - $right_total),2,'.','');	
				$last_sno = $last_sno + 1;
			}	
			
			$pl_arr[$last_sno][1] = '=============';
			$pl_income_arr[$last_sno][3] = '=============';	
			$last_sno = $last_sno + 1;	
			
			if($right_total > $left_total) {
				$pl_arr[$last_sno][1] = number_format($right_total,2,'.','');
				$pl_income_arr[$last_sno][3] = number_format($right_total,2,'.','');	
				$last_sno = $last_sno + 1;
			} else {
				$pl_arr[$last_sno][1] = number_format($left_total,2,'.','');
				$pl_income_arr[$last_sno][3] = number_format($left_total,2,'.','');	
				$last_sno = $last_sno + 1;
			}
			
			$pl_arr[$last_sno][1] = '=============';
			$pl_income_arr[$last_sno][3] = '=============';	
			$last_sno = $last_sno + 1;		
			
			if(($left_total - $right_total) < 0) {
				$pl_arr[$last_sno][0] = 'Gross Profit b/f';
				$pl_arr[$last_sno][1] = number_format(($right_total - $left_total),2,'.','');	
				$last_sno = $last_sno + 1;
			}
			if(($right_total - $left_total) < 0) {
				$pl_income_arr[$last_sno][2] = 'Gross Loss b/f';
				$pl_income_arr[$last_sno][3] = number_format(($left_total - $right_total),2,'.','');	
				$last_sno = $last_sno + 1;
			}	
		
		}

		//Trading
		$lsno = $last_sno; 
		$asno = $last_sno; 	
		$tmp_amt = 0;
		
		$left_total = 0;
		$right_total = 0;	
		$group_print_side ='';
		$id ='';
		
		if ($search_report_type == '1') {
			$select_account_name = "SELECT account_head_id, account_head_name, account_head_type1, account_head_type2,account_head_code
										FROM account_heads 
										WHERE  account_head_type1 = 'pl'  AND account_head_type2 IN	('in','ex')
										AND account_head_deleted_status = 0 GROUP BY account_head_id ASC";										
										// AND account_head_deleted_status = 0 ORDER BY account_head_name";
										
		} else {
			  $select_account_name = "SELECT account_sub_id, account_sub_name, account_head_id, account_head_name,account_head_code, account_head_type1, account_head_type2, account_sub_code,account_sub_type_id
									FROM account_sub 
									LEFT JOIN account_heads ON account_head_id = account_sub_head_id
									WHERE account_head_type1 = 'pl'  AND account_head_type2 IN	('in','ex')
									AND account_head_deleted_status = 0 GROUP BY account_sub_head_id, account_sub_name ASC"; 									
//									AND account_head_deleted_status = 0 ORDER BY account_head_id ASC, account_sub_name ASC"; 		
									
		}																
		$result_account_name = mysql_query($select_account_name);
		$row_account_name = mysql_num_rows($result_account_name);
		

		while($record_account_name  = mysql_fetch_array($result_account_name )) {
			if ($search_report_type == 'summary') {
				$account_id 			 	= $record_account_name['account_head_id'];
				$acc_id 			 	 	= '';
				$account_sub_type_id 			 	= '';
				$acc_name 			 	 	= $record_account_name['account_head_name'].' - '.$record_account_name['account_head_code'];
				$acc_group_credit_amount 	= getCreditTotal($record_account_name['account_head_id'],'',$where, 'account_head_id');
				$acc_group_debit_amount	 	= getDebitTotal($record_account_name['account_head_id'],'',$where, 'account_head_id');					
			} else {
				$account_id 			 	= $record_account_name['account_head_id'];
				$acc_id 			 	 	= $record_account_name['account_sub_id'];
				$account_sub_type_id	 	 		= $record_account_name['account_sub_type_id'];
				$acc_name 			 	 	= $record_account_name['account_sub_name'].' - '.$record_account_name['account_sub_code'];				
				$acc_group_credit_amount 	= getCreditTotal($record_account_name['account_head_id'],$record_account_name['account_sub_id'],$where, 'acc_transaction_account_id');
				$acc_group_debit_amount	 	= getDebitTotal($record_account_name['account_head_id'],$record_account_name['account_sub_id'],$where, 'acc_transaction_account_id');					
			}		
			$group_type2 			 		=  $record_account_name['account_head_type2'];		

			$total_amount = $acc_group_credit_amount + $acc_group_debit_amount;
			
							
			if($total_amount > 0){
				if( $group_type2 == 'ex' ) {	
					if(($acc_group_credit_amount - $acc_group_debit_amount) < 0){
						$group_print_side = 'L';
					} else {
						$group_print_side = 'A';
					}	
				}	
				
				if( $group_type2 == 'in' ) {	
					if(($acc_group_debit_amount - $acc_group_credit_amount) < 0){
						$group_print_side = 'A';
					} else {
						$group_print_side = 'L';
					}	
				}	
				
				if($group_print_side == 'L')	{
					if ($search_report_type == 'detailed') {
						if ($id != $account_id) {
							if ($sno1 != 1) {
								$pl_arr[$lsno][0] = "Total";
								$pl_arr[$lsno][1] = number_format($left_sub_total,2,'.','');
								$lsno = $lsno + 1;	
							}						
							$pl_arr[$lsno][0] = "<strong>".$record_account_name['account_head_name'].' - '.$record_account_name['account_head_code']."</strong>";
							$pl_arr[$lsno][1] = '';	
							$lsno = $lsno + 1;	
							$left_sub_total = 0;	
							$sno1 = 1;	
							$id = $account_id;					

						}
					}				
					$tmp_amt = $acc_group_debit_amount - $acc_group_credit_amount;
					if($tmp_amt < 0){
						$tmp_amt =	$tmp_amt * -1;	
					}	
					if($tmp_amt != 0){
						$pl_arr[$lsno][0] = $acc_name;
						$pl_arr[$lsno][1] =  number_format($tmp_amt,2,'.','');
						$pl_arr[$lsno][4] = $acc_id;
						$pl_arr[$lsno][5] = $account_sub_type_id;
					}			
					if($tmp_amt == 0){
						$pl_arr[$lsno][0] = $acc_name;
						$pl_arr[$lsno][1] =  number_format($tmp_amt,2,'.','');
						$pl_arr[$lsno][4] = $acc_id;
						$pl_arr[$lsno][5] = $account_sub_type_id;
					}
//					$pl_arr[$lsno][2] = '';
//					$pl_arr[$lsno][3] = '';	
					$left_total = $left_total + $tmp_amt;
					$left_sub_total = $left_sub_total + $tmp_amt;
					$lsno = $lsno + 1;	
					$sno1 = $sno1 + 1;					
				} else {
				
					if ($search_report_type == 'detailed') {
						if ($id != $account_id) {
							if ($sno2 != 1) {
								$pl_income_arr[$asno][2] = "Total";
								$pl_income_arr[$asno][3] = number_format($right_sub_total,2,'.','');
								$asno = $asno + 1;	
							}							
							$pl_income_arr[$asno][2] = "<strong>".$record_account_name['account_head_name'].' - '.$record_account_name['account_head_code']."</strong>";
							$pl_income_arr[$asno][3] = '';	
							$asno = $asno + 1;	
							$right_sub_total = 0;												
							$sno2 = 1;
								$id = $account_id;							
						}
					}					
					$tmp_amt = $acc_group_credit_amount - $acc_group_debit_amount;
					if($tmp_amt < 0){
						$tmp_amt =	$tmp_amt * -1;	
					}	
					if($tmp_amt != 0){
						$pl_income_arr[$asno][2] = $acc_name;
						$pl_income_arr[$asno][3] = number_format($tmp_amt,2,'.','');
						$pl_income_arr[$asno][6] = $acc_id;
						$pl_income_arr[$asno][7] = $account_sub_type_id;
					}	
					if($tmp_amt == 0){
						$pl_income_arr[$asno][2] = $acc_name;
						$pl_income_arr[$asno][3] =  number_format($tmp_amt,2,'.','');
						$pl_income_arr[$asno][6] = $acc_id;
						$pl_income_arr[$asno][7] = $account_sub_type_id;
					}	
//					$pl_arr[$asno][0] = '';
//					$pl_arr[$asno][1] = '';
					$right_total = $right_total + $tmp_amt;	
					$right_sub_total = $right_sub_total + $tmp_amt;
					$asno = $asno + 1;	
					$sno2 = $sno2 + 1;						
				}
				if ($search_report_type == 'detailed') {
					$id = $account_id;
				}			  
			   
			}
		}	
		if ($search_report_type == 'detailed') {	
			$pl_arr[$lsno][0] = "Total";
			$pl_arr[$lsno][1] = number_format($left_sub_total,2,'.','');
			$lsno = $lsno + 1;		
			$pl_income_arr[$asno][2] = "Total";
			$pl_income_arr[$asno][3] = number_format($right_sub_total,2,'.','');
			$lsno = $lsno + 1;				
		}
		
		if($lsno > $asno) {
			$last_sno = $lsno;
		} else {
			$last_sno = $asno;	
		}
	
		if($last_sno > 0){
			if(($left_total - $right_total) < 0) {
				$pl_arr[$last_sno][0] = 'Net Profit';
				$pl_arr[$last_sno][1] = number_format(($right_total - $left_total),2,'.','');	
				$last_sno = $last_sno + 1;
			}
			if(($right_total - $left_total) < 0) {
				$pl_income_arr[$last_sno][2] = 'Net Loss';
				$pl_income_arr[$last_sno][3] = number_format(($left_total - $right_total),2,'.','');	
				$last_sno = $last_sno + 1;
			}	
			
			$pl_arr[$last_sno][1] = '=============';
			$pl_income_arr[$last_sno][3] = '=============';	
			$last_sno = $last_sno + 1;	
			
			if(($left_total - $right_total) > 0) {
				$pl_arr[$last_sno][1] = number_format($left_total,2,'.','');
				$pl_income_arr[$last_sno][3] = number_format($left_total,2,'.','');	
				$last_sno = $last_sno + 1;
			} else {
				$pl_arr[$last_sno][1] = number_format($left_total,2,'.','');
				$pl_income_arr[$last_sno][3] = number_format($left_total,2,'.','');	
				$last_sno = $last_sno + 1;
			}
			
			$pl_arr[$last_sno][1] = '=============';
			$pl_income_arr[$last_sno][3] = '=============';	
			$last_sno = $last_sno + 1;	
		
		}
		
			return array($pl_arr,$pl_income_arr);
		}
		
		
		function getProfitLoss() {
			//Sale Entry Start
			$where = " WHERE invoice_entry_deleted_status =0 AND invoice_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND invoice_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
			
			if(isset($_REQUEST['fromdate']) && (!empty($_REQUEST['fromdate'])) && isset($_REQUEST['todate']) && 
			(!empty($_REQUEST['todate']))) {
			
				$where .= " AND invoice_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['fromdate'])."'
						   AND '".NdateDatabaseFormat($_REQUEST['todate'])."'";	
				
			}
			
			if(isset($_REQUEST['branchid']) && (!empty($_REQUEST['branchid']))) {
				$where .= " AND invoice_entry_branch_id = '".dataValidation($_REQUEST['branchid'])."'";
			}
			
			   $select_invoice_entry = "SELECT invoice_entry_id, invoice_entry_no, invoice_entry_date, 
									  SUM(invoice_entry_net_amount)as invoice_entry_net_amount,branch_name,invoice_entry_branch_id,
									  invoice_entry_direct_type,product_category_name
									  FROM invoice_entry_product_details
									  LEFT JOIN  invoice_entry ON 
										invoice_entry_id 	= invoice_entry_product_detail_invoice_entry_id	
									LEFT JOIN  products ON 
										product_id 		= invoice_entry_product_detail_product_id			
									  LEFT JOIN  product_categories ON 
										product_category_id 		= product_product_category_id
									  LEFT JOIN branches ON branch_id = invoice_entry_branch_id
									  $where
									  GROUP BY product_category_id ASC";
									// echo $select_invoice_entry;exit;
			$result_invoice_entry = mysql_query($select_invoice_entry);
			//$count_invoice_entry  = mysql_num_rows($result_invoice_entry);
			$arr_invoice_entry    = array();
			while($record_invoice_entry = mysql_fetch_array($result_invoice_entry)) {
				
				$arr_invoice_entry[] = $record_invoice_entry;
			}
			
			$sale_entry = $arr_invoice_entry;
			//Sale Entry End
			
			//Sale Return Start
			$where2 = " WHERE credit_note_entry_deleted_status =0 AND credit_note_entry_financial_year = '".$_SESSION[SESS.'_session_financial_year']."' AND credit_note_entry_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		
			if(isset($_REQUEST['fromdate']) && (!empty($_REQUEST['fromdate'])) && isset($_REQUEST['todate']) && 
			(!empty($_REQUEST['todate']))) {
			
				$where2 .= " AND credit_note_entry_date BETWEEN '".NdateDatabaseFormat($_REQUEST['fromdate'])."'
						   AND '".NdateDatabaseFormat($_REQUEST['todate'])."'";	
				
			}
			
			if(isset($_REQUEST['branchid']) && (!empty($_REQUEST['branchid']))) {
				$where2 .= " AND credit_note_entry_branch_id = '".dataValidation($_REQUEST['branchid'])."'";
			}
			
		  $select_invoice_entry2 = "SELECT SUM(credit_note_entry_product_detail_total )as credit_entry_amount
						  FROM credit_note_entry_product_details 
						  LEFT JOIN credit_note_entry ON credit_note_entry_id = credit_note_entry_product_detail_credit_note_entry_id
						  $where2";
			$result_invoice_entry2 = mysql_query($select_invoice_entry2);
			$count_invoice_entry2  = mysql_num_rows($result_invoice_entry2);
			$arr_invoice_entry2    = array();
			while($record_invoice_entry2 = mysql_fetch_array($result_invoice_entry2)) {
				
				$arr_invoice_entry2[] = $record_invoice_entry2;
			}
			
			$sale_return_entry = $arr_invoice_entry2;
			//Sale Return End
			
			//Purchase entry start
			$where3 = " WHERE pR_deleted_status =0 AND  pR_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
		
			if(isset($_REQUEST['fromdate']) && (!empty($_REQUEST['fromdate'])) && isset($_REQUEST['todate']) && 
			(!empty($_REQUEST['todate']))) {
			
				$where3 .= " AND pR_purchase_date BETWEEN '".NdateDatabaseFormat($_REQUEST['fromdate'])."'
						   AND '".NdateDatabaseFormat($_REQUEST['todate'])."'";	
				
			}
			if(isset($_REQUEST['branchid']) && (!empty($_REQUEST['branchid']))) {
				$where3 .= " AND pR_branchid = '".dataValidation($_REQUEST['branchid'])."'";
			}
			
			$select_invoice_entry3 = "SELECT SUM(pRp_unitprice) as purchase_amount FROM  purchase_order_products LEFT JOIN 		purchase_order ON purchaseId = pRp_purchaseId LEFT JOIN products ON product_id = pRp_product_id $where3";
			$result_invoice_entry3 = mysql_query($select_invoice_entry3);
			$count_invoice_entry3  = mysql_num_rows($result_invoice_entry3);
			$arr_invoice_entry3    = array();
			while($record_invoice_entry3 = mysql_fetch_array($result_invoice_entry3)) {
				
				$arr_invoice_entry3[] = $record_invoice_entry3;
			}
			
			$purchase_entry = $arr_invoice_entry3;
			//Purchase entry end
			
			//Purchase entry return start
			$where4 = " WHERE dne_child_detail_deleted_status =0 AND pI_deleted_status = 0 AND pI_company_id = '".$_SESSION[SESS.'_session_company_id']."'";
			if(isset($_REQUEST['fromdate']) && (!empty($_REQUEST['fromdate'])) && isset($_REQUEST['todate']) && 
			(!empty($_REQUEST['todate']))) {
				$where4 .= " AND pI_invoice_date BETWEEN '".NdateDatabaseFormat($_REQUEST['fromdate'])."'
						   AND '".NdateDatabaseFormat($_REQUEST['todate'])."'";	
			}
			if(isset($_REQUEST['branchid']) && (!empty($_REQUEST['branchid']))) {
				$where4 .= " AND pI_branchid = '".dataValidation($_REQUEST['branchid'])."'";
			}
			$select_invoice_entry4 = "SELECT SUM(dne_child_detail_amount) as debit_entry_amount
							  FROM  dn_entry_child_details
							  LEFT JOIN dn_entry ON dn_entry_id = dne_child_detail_dn_entry_id
							  LEFT JOIN purchase_invoice ON invoiceId = dn_entry_invoice_id
							  LEFT JOIN purchase_order ON purchaseId = pI_purchaseId
							  LEFT JOIN 
									product_con_entry_child_product_details 
							  ON 
									product_con_entry_child_product_detail_id = dne_child_detail_product_id $where4";
			$result_invoice_entry4 = mysql_query($select_invoice_entry4) or die(mysql_error());
			$count_invoice_entry4  = mysql_num_rows($result_invoice_entry4);
			$arr_invoice_entry4    = array();
			while($record_invoice_entry4 = mysql_fetch_array($result_invoice_entry4)) {
				
				$arr_invoice_entry4[] = $record_invoice_entry4;
			}
			
			$purchase_return_entry = $arr_invoice_entry4;
			//Purchase entry return end
			
			//Opening Stock,Closing Stock,Carry Inwards Start
			$where5	= '';	
			if(isset($_REQUEST['branchid']) && (!empty($_REQUEST['branchid']))){
				$where5	.=" AND acc_transaction_branch_id = '".$_REQUEST['branchid']."'";
			}	
			
			if(isset($_REQUEST['fromdate']) && (!empty($_REQUEST['fromdate'])) && isset($_REQUEST['todate']) && 
			(!empty($_REQUEST['todate']))) {
			
				$where5 .= " AND acc_transaction_date BETWEEN '".NdateDatabaseFormat($_REQUEST['fromdate'])."'
						   AND '".NdateDatabaseFormat($_REQUEST['todate'])."'";	
				
			}
			$select_transaction = "SELECT acc_transaction.acc_transaction_account_id, account1.account_sub_head_id, account1.account_sub_name AS account_name, haccount.account_head_type2,
									  SUM(acc_transaction_amount_mmk) as transaction_amount

									  FROM acc_transaction 

									  LEFT JOIN account_sub AS account1 ON  acc_transaction.acc_transaction_account_id = account1.account_sub_id
									  
									  LEFT JOIN account_heads AS haccount ON  account1.account_sub_head_id = haccount.account_head_id

									  WHERE acc_transaction_deleted_status = 0 AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'

									  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	

									  AND (haccount.account_head_type2 = 'op' OR haccount.account_head_type2 = 'cl' OR haccount.account_head_type2 = 'ci' OR haccount.account_head_type2 = 'co' OR haccount.account_head_type2 = 'mf')
									  $where5
									  
									  GROUP BY (haccount.account_head_type2)";
									  
									//echo  $select_transaction;exit;

			$result_transaction = mysql_query($select_transaction) or die(mysql_error());

			$arr_transaction    = array();

			while ($record_transaction = mysql_fetch_array($result_transaction)) {

				   $arr_transaction[]  = $record_transaction;

			}

			$transaction_entry = $arr_transaction;
			//Opening Stock,Closing Stock,Carry Inwards End
			
			//Income/Expense start
			$select_transaction6 = "SELECT acc_transaction.acc_transaction_account_id, account1.account_sub_head_id, account1.account_sub_name AS account_name, haccount.account_head_type2,
									  SUM(acc_transaction_amount_mmk) as transaction_amount

									  FROM acc_transaction 

									  LEFT JOIN account_sub AS account1 ON  acc_transaction.acc_transaction_account_id = account1.account_sub_id
									  
									  LEFT JOIN account_heads AS haccount ON  account1.account_sub_head_id = haccount.account_head_id

									  WHERE acc_transaction_deleted_status = 0 AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'

									  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	

									  AND (haccount.account_head_type2 = 'in' OR haccount.account_head_type2 = 'ex')
									  $where5
									  
									  GROUP BY (acc_transaction_account_id) ORDER BY account_head_type2 DESC";
									  
									//echo  $select_transaction;exit;

			$result_transaction6 = mysql_query($select_transaction6) or die(mysql_error());

			$arr_transaction6    = array();

			while ($record_transaction6 = mysql_fetch_array($result_transaction6)) {

				   $arr_transaction6[]  = $record_transaction6;

			}

			$income_expense_entry = $arr_transaction6;
			$income_expense_entry = group_by("account_head_type2", $income_expense_entry);
			//Income/Expense end
			
			return array($sale_entry,$sale_return_entry,$purchase_entry,$purchase_return_entry,$transaction_entry,$income_expense_entry);
		}

?>
