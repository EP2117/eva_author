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
	function listOpening($type, $date, $acc_id, $branch_id) {

		$where = '';

		$amt = 0;

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
				$a_where	.=" AND acc_transaction_branch_id =  '".$branch_id."'";
		}

		if($type != 'C') {

			 $select_opening = "SELECT SUM(acc_transaction_amount) AS open_amt,SUM(acc_transaction_amount_mmk) AS open_amt_mmk FROM  acc_transaction 

									  WHERE acc_transaction_deleted_status = 0 AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'

									  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	

									  $a_where

									  AND acc_transaction_date < '".$date."'

									  AND acc_transaction_cord = 'C' AND acc_transaction_account_id = '".$acc_id."'"; 

			$result_opening = mysql_query($select_opening);

			$record_opening = mysql_fetch_array($result_opening); 		

			$amt 		= $record_opening_balance['oP_credit_amnt'] + $record_opening['open_amt'];
			$amt_mmk 	= $record_opening_balance['oP_frgn_credit_amnt'] + $record_opening['open_amt_mmk'];

		} else {

			$select_opening = "SELECT SUM(acc_transaction_amount) AS open_amt,SUM(acc_transaction_amount_mmk) AS open_amt_mmk FROM  acc_transaction 

									  WHERE acc_transaction_deleted_status = 0 AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'

									  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	

									  $a_where AND acc_transaction_date < '".$date."'

									  AND acc_transaction_cord = 'D' AND acc_transaction_account_id = '".$acc_id."'";

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
	function listTransaction($trans_date, $acc_id, $branch_id){
			//$val = explode(' - ',$_REQUEST['sub_account']);
			//$id = $val[0];
			//$paymode = $_REQUEST['payment_mode']==0? '1,2':$_REQUEST['payment_mode'];		
			
			$where	= '';	
			if(!empty($branch_id)!=''){
				$where	.=" AND acc_transaction_branch_id = '".$branch_id."'";
			}	
			
		$select_transaction = "SELECT acc_transaction_no, acc_transaction_date, acc_transaction_type, 

								  acc_transaction_account_id, acc_transaction_account_id1, acc_transaction_cord,

								  acc_transaction_amount,acc_transaction_amount_mmk, acc_transaction_remark,

								  account1.account_sub_name AS account_name,

								  account2.account_sub_name as account_name1

								  FROM acc_transaction 

								  LEFT JOIN account_sub AS account1 ON  acc_transaction.acc_transaction_account_id = account1.account_sub_id 

								  LEFT JOIN account_sub AS account2 ON  acc_transaction.acc_transaction_account_id1 = account2.account_sub_id

								  WHERE acc_transaction_deleted_status = 0 AND acc_transaction_company_id = '".$_SESSION[SESS.'_session_company_id']."'

								  AND acc_transaction_financial_year = '".$_SESSION[SESS.'_session_financial_year']."'	

								  $where

								  AND acc_transaction_account_id = '".$acc_id."'
								  AND acc_transaction_date  = '".$trans_date."'

								  ORDER BY FIELD (acc_transaction_cord, 'C', 'D')";
		$result_transaction = mysql_query($select_transaction);

		$arr_transaction    = array();

		while ($record_transaction = mysql_fetch_array($result_transaction)) {

			   $arr_transaction[]  = $record_transaction;

		}

		return $arr_transaction;

			
			
			
	}
	
	function opening_stock(){
		
		$id=explode(' - ',$_REQUEST['sub_account']);
		$id= $id[0];
		   $query = "SELECT SUM(IF(aeA_credit_ac=$id,aeA_amount,0)) credit, SUM(IF(aeA_debit_ac=$id,aeA_amount,0)) debit,oP_credit_amnt,oP_debit_amnt
		   			FROM account_payable
					LEFT JOIN account_opening_balance ON oP_account_sub_id =$id
					WHERE (aeA_credit_ac = '".$id."' or aeA_debit_ac ='".$id."' ) AND aeA_advance_date <= '".date('Y-m-d',strtotime($_REQUEST['fromdate']))."' "; 			
						
			 $result = mysql_query($query);
			 $result_Array =array();
			 $resultData = mysql_fetch_array($result);		 
			 $resultArray['credit'] = $resultData['credit']+$resultData['oP_credit_amnt'];
			 $resultArray['debit']  = $resultData['debit']+$resultData['oP_debit_amnt'];
			 array_push($result_Array,$resultArray);
		return $result_Array;
	}
	
?>
