<?php 
	function accountHeadList(){
	
		$query = "SELECT account_head_name,account_head_id
				 FROM account_heads 
				 ORDER BY account_head_name ASC ";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	function accounSubtHeadList($id){
	
		$query = "SELECT account_sub_name,account_sub_id
				 FROM  account_sub 
				 WHERE
				 	account_sub_head_id	= '".$id."'	
				 ORDER BY account_sub_name ASC ";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}

	function listOpening($type, $date, $acc_id, $branch_id) {

		$where = '';

		$amt = 0;

//$type = "D";
		if(!empty($branch_id)!=''){
				$where	.=" AND oP_branch_id =  '".$branch_id."'";
		}

		 $select_opening_balance = "SELECT oP_credit_amnt, oP_debit_amnt,oP_frgn_debit_amnt, oP_frgn_credit_amnt FROM  account_opening_balance 

								  WHERE oP_company_id = '".$_SESSION[SESS.'_session_company_id']."'

								  AND oP_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	

								  $where

								  AND oP_account_sub_id = '".$acc_id."'";

		$result_opening_balance = mysql_query($select_opening_balance);

		$record_opening_balance = mysql_fetch_array($result_opening_balance);
		$a_where	= '';
		if(!empty($branch_id)!=''){
				$a_where	.=" AND oP_branch_id =  '".$branch_id."'";
		}

		if($type == 'C') {

			$select_opening = "SELECT SUM(acc_transaction_amount) AS open_amt,SUM(acc_transaction_amount_mmk) AS open_amt_mmk FROM  acc_transaction 

									  WHERE acc_transaction_deleted_status = 0 
									  
									  AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'

									  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	

									  AND acc_transaction_branch_id = '".$branch_id."' 

									  AND acc_transaction_date < '".$date."'
									  
									  AND acc_transaction_cord = 'D' 
									  
									  AND acc_transaction_account_id = '".$acc_id."'";
									//echo  $select_opening;exit;$a_where

			$result_opening = mysql_query($select_opening);

			$record_opening = mysql_fetch_array($result_opening); 		

			$amt = $record_opening_balance['oP_credit_amnt'] + $record_opening['open_amt'];
			$amt_mmk 	= $record_opening_balance['oP_frgn_credit_amnt'] + $record_opening['open_amt_mmk'];

		} else {

			$select_opening = "SELECT SUM(acc_transaction_amount) AS open_amt,SUM(acc_transaction_amount_mmk) AS open_amt_mmk FROM  acc_transaction 

									  WHERE acc_transaction_deleted_status = 0 
									  
									  AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'

									  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	

									   AND acc_transaction_date < '".$date."'
									   
									   AND acc_transaction_branch_id = '".$branch_id."' 

									  AND acc_transaction_cord = 'C' 
									  
									  AND acc_transaction_account_id = '".$acc_id."'";
 										//$a_where
			$result_opening = mysql_query($select_opening);

			$record_opening = mysql_fetch_array($result_opening); 			

			$amt = $record_opening_balance['oP_debit_amnt'] + $record_opening['open_amt'];
			$amt_mmk 	= $record_opening_balance['oP_frgn_debit_amnt'] + $record_opening['open_amt_mmk'];

		}	

		//echo $record_opening_balance['opening_balance_credit_amount'] ; exit;

		if ($amt > 0) {

			return array($amt,$amt_mmk);

		} else return 0;				

	}
	function listTransaction($trans_date, $id, $branch_id){ 
			//$val = explode(' - ',$_REQUEST['sub_account']);
			//$id = $val[0];
			//$paymode = $_REQUEST['payment_mode']==0? '1,2':$_REQUEST['payment_mode'];
			$where	= '';	
			if(!empty($branch_id)!=''){
				$where	.=" AND acc_transaction_branch_id = '".$branch_id."'";
			}	
			
			if(isset($_REQUEST['fromdate']) && (!empty($_REQUEST['fromdate'])) && isset($_REQUEST['todate']) && 
		(!empty($_REQUEST['todate']))) {
		
			$where .= " AND acc_transaction_date BETWEEN '".NdateDatabaseFormat($_REQUEST['fromdate'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['todate'])."'";	
			
		}
		$select_transaction = "SELECT acc_transaction_no, acc_transaction_date, acc_transaction_type, 

								  acc_transaction_account_id, acc_transaction_account_id1, acc_transaction_cord,

								  acc_transaction_amount, acc_transaction_remark,

								  account1.account_sub_name AS account_name,

								  account2.account_sub_name as account_name1,
								  acc_transaction_amount_mmk

								  FROM acc_transaction 

								  LEFT JOIN account_sub AS account1 ON  acc_transaction.acc_transaction_account_id = account1.account_sub_id 

								  LEFT JOIN account_sub AS account2 ON  acc_transaction.acc_transaction_account_id1 = account2.account_sub_id

								  WHERE acc_transaction_deleted_status = 0 AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'

								  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	

								  AND acc_transaction_account_id = '".$id."'
								  $where
								  
								  ORDER BY FIELD (acc_transaction_cord, 'C', 'D')";
								  
								//echo  $select_transaction;exit;

		$result_transaction = mysql_query($select_transaction);

		$arr_transaction    = array();

		while ($record_transaction = mysql_fetch_array($result_transaction)) {

			   $arr_transaction[]  = $record_transaction;

		}

		return $arr_transaction;

			
			
			
	}
?>
