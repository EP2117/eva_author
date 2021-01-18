<?php 

	function listReport(){
		$where='';
		if($_REQUEST['type']==1){
			$where .= " group by account_sub_head_id";
		}
		 $id = $_REQUEST['type'];
		 
		 $query = "SELECT IF($id=1,account_head_id,account_sub_id) as id,IF($id=1,account_head_name,account_sub_name) as name FROM  account_sub
				   LEFT JOIN account_heads ON account_sub_head_id = account_head_id 
				   WHERE account_sub_deleted_status=0 and account_head_deleted_status=0 and account_head_type1 IN ('bs') $where";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function getOpeningBalance($accounts_id,$credit_or_debit){
		if(isset($_GET['search_acc_transaction_branch_id'])) {
			$search_acc_transaction_branch_id = $_GET['search_acc_transaction_branch_id']; 
		} else {
			$search_acc_transaction_branch_id = ""; 
		}
			
		$ac_where = '';
		if($search_acc_transaction_branch_id != '') {
		
			if(!empty($search_acc_transaction_branch_id)) {
				$ac_where .=" AND oP_branch_id  =  '".$search_acc_transaction_branch_id."' "; 
			} else {
				$ac_where .=" AND  oP_branch_id  =  ''"; 
			}
		}
	 	  	$select_account = "SELECT 	oP_credit_amnt, oP_debit_amnt 
							FROM account_opening_balance 
							 LEFT JOIN account_sub ON account_sub_id = oP_account_sub_id
							 LEFT JOIN account_heads ON account_head_id =  account_sub_head_id 
							WHERE oP_company_id = '".$_SESSION[SESS.'_session_company_id']."'
						  	AND oP_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
							$ac_where
							AND oP_account_sub_id ='".$accounts_id."'";
			$result_account  = mysql_query($select_account);
			$count_account   = mysql_num_rows($result_account);
			$record_account  = mysql_fetch_array($result_account);
			$ac_credit_amount = $record_account['oP_credit_amnt'];
			$ac_debit_amount = $record_account['oP_debit_amnt'];
			
			
			
			if ($credit_or_debit == 'C'){
				return $opening_amount = $ac_credit_amount; 
			} else if ($credit_or_debit == 'D'){
				return $opening_amount = $ac_debit_amount; 
			} else {
				return $opening_amount = 0;
			}
 
	} 
	
	
		function getPreviousTransactionAmount($acc_id,$credit_or_debit,$from_date){ 
		$where1 ='';
		
		if(!empty($from_date)) {
			$tra_date_search	           	 = NdateDatabaseFormat($from_date);
			$where1 						.=  "AND  acc_transaction_date < '".$tra_date_search."'"; 
		}
		if(isset($_GET['search_acc_transaction_branch_id'])) {
			$search_acc_transaction_branch_id = $_GET['search_acc_transaction_branch_id']; 
		} else {
			$search_acc_transaction_branch_id = ""; 
		}
		$ac_where = '';
		if($search_acc_transaction_branch_id != '') {
		
			if(!empty($search_acc_transaction_branch_id)) {
				$where1 .=" AND acc_transaction_branch_id  =  '".$search_acc_transaction_branch_id."' "; 
			}
		}		
		if($acc_id != ''){
			$where1 .= " AND acc_transaction_account_id = '".$acc_id."'";
		}
				 
		$debit_amount = "SELECT SUM(acc_transaction_amount) AS acc_transaction_amount 
						 FROM acc_transaction 
						 LEFT JOIN account_sub ON account_sub_id = acc_transaction_account_id
						 LEFT JOIN account_heads ON account_head_id =  account_sub_head_id 
						 LEFT JOIN financial_years ON financial_year_id = acc_transaction_financial_year
						 WHERE acc_transaction_date >= financial_year_opening_date
						 AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'
						 AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
						 AND acc_transaction_deleted_status=0  and acc_transaction_cord ='".$credit_or_debit."' 
						 AND account_head_type1 ='bs'
						 $where1 GROUP BY acc_transaction_account_id";  
		$result_amount = mysql_query($debit_amount);
		$record_amount = mysql_fetch_array($result_amount);
		return $acc_transaction_amount = $record_amount['acc_transaction_amount'];
	}
	function getTransactionAmount($acc_id,$credit_or_debit,$from_date,$todate){ 
		$where2 ='';
			
		
		
		if(!empty($from_date) && !empty($todate) ) {
			$ledger_entry_to_date						= NdateDatabaseFormat($todate);
			$tra_date_search							= NdateDatabaseFormat($from_date);
			$where2 .=  "AND  acc_transaction_date BETWEEN '".$tra_date_search."' AND '".$ledger_entry_to_date."' "; 
			}
		
		if(isset($_GET['search_acc_transaction_branch_id'])) {
			$search_acc_transaction_branch_id = $_GET['search_acc_transaction_branch_id']; 
		} else {
			$search_acc_transaction_branch_id = ""; 
		}
			
		$ac_where = '';
		if($search_acc_transaction_branch_id != '') {
		
			if(!empty($search_acc_transaction_branch_id)) {
				$where2 .=" AND acc_transaction_branch_id  =  '".$search_acc_transaction_branch_id."' "; 
			}
		}		
		  
		if($acc_id != ''){
			$where2 .= " AND acc_transaction_account_id = '".$acc_id."'";
		}
			 
		$debit_amount = "SELECT SUM(acc_transaction_amount) AS acc_transaction_amount 
						 FROM acc_transaction 
						 LEFT JOIN account_sub ON account_sub_id = acc_transaction_account_id
						 LEFT JOIN account_heads ON account_head_id =  account_sub_head_id 
						 WHERE acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'
						 AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'
						 AND acc_transaction_deleted_status=0  and acc_transaction_cord ='".$credit_or_debit."' 
						 AND account_head_type1 ='bs'
						 $where2 GROUP BY acc_transaction_account_id";  
		$result_amount = mysql_query($debit_amount);
		$record_amount = mysql_fetch_array($result_amount);
		return $acc_transaction_amount = $record_amount['acc_transaction_amount'];
	}
	function ledgerReport()
	{
	$where2 ='';
 
    $where =''; 
	$where_date = '';
	
	$pl_arr 	= array();
	$pl_ass_arr = array();
	$lsno = 0; 
	$asno = 0; 	
	$l_summary_sno = 0; 
	$a_summary_sno = 0; 	
	$last_sno = 0;
	$tmp_amt = 0;
	$id ='';	
	$sno1 = 1;
	$sno2 = 1;	
	
			$from_date                 = $_REQUEST['fromdate'];
			$to_date                 	= $_REQUEST['todate'];
			$branch_id                 = $_REQUEST['branchid'];
		if(!empty($_REQUEST['type'])) {
			$search_report_type = $_REQUEST['type'];
		}else{
			$search_report_type= '';
		}
		
		$tot_cr_closing_amount = 0;
		$tot_dr_closing_amount = 0;		
		$right_det_grd_total	= 0;
		$left_det_grd_total		= 0;
		$select_acc_group 			= "	SELECT 
											account_head_id, 
											account_head_name,
											account_head_code, 
											account_head_type1, 
											account_head_type2 
									   	FROM 
									   		account_heads 
										WHERE 
											account_head_type1 				= 'bs' and
											account_head_deleted_status = 0 
										ORDER BY 
											account_head_id ASC";			
				
		$result_acc_group = mysql_query($select_acc_group);
		$i		= 0;
		while($record_acc_group  = mysql_fetch_array($result_acc_group )) {
		
			$where = " account_sub_deleted_status = 0 AND account_sub_company_id = '".$_SESSION[SESS.'_session_company_id']."' AND account_head_type1 = 'bs' "; 
			
			 $select_account = "SELECT account_sub_id, account_sub_name,account_sub_code, account_head_type2, account_head_name,account_head_code, account_head_id,
			 							account_sub_type_id
								FROM account_sub
								LEFT JOIN account_heads ON account_head_id  = account_sub_head_id 
								WHERE $where
								AND account_sub_head_id = '".$record_acc_group['account_head_id']."'   
								GROUP BY account_sub_id
								ORDER BY account_head_name ASC, account_sub_name ASC";//exit;			
					
			$result_account = mysql_query($select_account);
						$tot_debit_amount	= 0;
						$tot_credit_amount	= 0;
			while($record_account  = mysql_fetch_array($result_account)) {
					$total_amount = 0;
						$cr_opening_amt = getOpeningBalance($record_account['account_sub_id'],'C');
						$dr_opening_amt = getOpeningBalance($record_account['account_sub_id'],'D');
						
						$cr_previous_amt =  getPreviousTransactionAmount($record_account['account_sub_id'],'C',$from_date);
						$dr_previous_amt =  getPreviousTransactionAmount($record_account['account_sub_id'],'D',$from_date);
						
						$get_cr_open_amt		= $cr_opening_amt + $cr_previous_amt;
						$get_dr_open_amt		= $dr_opening_amt + $dr_previous_amt;
					
						if (($cr_opening_amt + $cr_previous_amt) > ($dr_opening_amt + $dr_previous_amt)){
							$credit_opening_balance_amount = ($cr_opening_amt + $cr_previous_amt) - ($dr_opening_amt + $dr_previous_amt) ;
							$debit_opening_balance_amount  = 0;
						} else {
							$credit_opening_balance_amount = 0;
							$debit_opening_balance_amount  = ($dr_opening_amt + $dr_previous_amt) - ($cr_opening_amt + $cr_previous_amt);	
						} 
						
						$opening_amount						= $credit_opening_balance_amount+$debit_opening_balance_amount;
						
						$get_cr_amt	= getTransactionAmount($record_account['account_sub_id'],'C',$from_date,$to_date);
						$get_dr_amt	= getTransactionAmount($record_account['account_sub_id'],'D',$from_date,$to_date);
						
						
						
					if($record_account['account_sub_type_id']=="1" || $record_account['account_sub_type_id']=="2"){
						$cr_amt = number_format($get_cr_amt + $get_cr_open_amt,2,'.','');
						$dr_amt = number_format($get_dr_amt + $get_dr_open_amt,2,'.','');
					}else{					
						$cr_amt = number_format($get_cr_amt,2,'.','') ;
						$dr_amt = number_format($get_dr_amt,2,'.','') ;	
					}
						//echo $dr_amt."---".	$cr_amt; exit;	

					if (($cr_amt - $dr_amt) > 0) {
						$cr_amt = ($cr_amt - $dr_amt);
						$dr_amt = 0;
					} else {
						$dr_amt = ($dr_amt - $cr_amt);
						$cr_amt = 0;										
					}

					if($record_account['account_sub_type_id']=="1" || $record_account['account_sub_type_id']=="2" ){
						if($dr_amt>0 || $cr_amt>0){
							$dr_amt	= ($dr_amt==0)?$opening_amount:$dr_amt;
							$cr_amt	= ($cr_amt==0)?$opening_amount:$cr_amt;	
						}
					}
						
						
						
					if(($dr_amt+$cr_amt) > 0) {
							
								if($search_report_type == "2"){
									$pl_arr[$i]['accounts_name']			=  $record_account['account_sub_name']."-".$record_account['account_sub_code'];
									$pl_arr[$i]['account_group_name']		=  $record_account['account_head_name']."-".$record_account['account_head_code'];
									$pl_arr[$i]['accounts_group_id']		=  $record_account['account_head_id'];
									$pl_arr[$i]['accounts_id']				=  $record_account['account_sub_id'];
									$pl_arr[$i]['credit_amount']			=  $cr_amt;
									$pl_arr[$i]['debit_amount']				=  $dr_amt;
									
									$i	= $i+1;
								}
								else{
										$tot_credit_amount	=  $tot_credit_amount+$cr_amt;
										$tot_debit_amount	=  $tot_debit_amount+$dr_amt;
								}
							
						}// end total amount
					
						
					} // sub loop end 
					if($search_report_type == "1"){
						if(($tot_credit_amount+$tot_debit_amount)>0){		
							$pl_arr[$i]['account_group_name']			=  $record_acc_group['account_head_name']."-".$record_acc_group['account_head_code'];
							$pl_arr[$i]['credit_amount']				=  number_format($tot_credit_amount,2,'.','');
							$pl_arr[$i]['debit_amount']					=  number_format($tot_debit_amount,2,'.','');
							$i	= $i+1;
						}
					}	
						$tot_debit_amount	= 0;
						$tot_credit_amount	= 0;
			} //main loop end
			return array($pl_arr);
		}

?>
