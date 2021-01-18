<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
		
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();
		$oP_branch_id	= $_REQUEST['branchid'];	
		//print_r($_REQUEST);exit;
		/*echo "<pre>";*/
		//print($_REQUEST['op_blnc']);exit;
		mysql_query("BEGIN");	
		for($i=0;$i<$_REQUEST['op_blnc'];$i++){
			//echo $_REQUEST['op_blnc'][$i];exit;
			//echo $i;
			//echo $_REQUEST['id_'.$i];exit;
			 if(empty($_REQUEST['id_'.$i])){
	
				     $query="INSERT INTO account_opening_balance SET oP_account_sub_id='".$_REQUEST['ac_subhead_id_'.$i]."',oP_debit_amnt='".$_REQUEST['debit_amnt_'.$i]."', 	oP_credit_amnt='".$_REQUEST['credit_amnt_'.$i]."',oP_frgn_debit_amnt='".$_REQUEST['frgn_debit_amnt_'.$i]."', oP_frgn_credit_amnt='".$_REQUEST['frgn_credit_amnt_'.$i]."',oP_company_id='$bC',oP_financial_year='".$_SESSION[SESS.'_session_financial_year']."' ,oP_branch_id='".$oP_branch_id."' ";
		
			}else{
				
				  $query="UPDATE account_opening_balance SET oP_account_sub_id='".$_REQUEST['ac_subhead_id_'.$i]."',oP_debit_amnt='".$_REQUEST['debit_amnt_'.$i]."', oP_credit_amnt='".$_REQUEST['credit_amnt_'.$i]."',oP_frgn_debit_amnt='".$_REQUEST['frgn_debit_amnt_'.$i]."', oP_frgn_credit_amnt='".$_REQUEST['frgn_credit_amnt_'.$i]."',oP_company_id='$bC',oP_financial_year='".$_SESSION[SESS.'_session_financial_year']."',oP_branch_id='".$oP_branch_id."'  WHERE openingBalanceId='".$_REQUEST['id_'.$i]."' ";
				
			}
					$qry = mysql_query($query);
					if(empty($qry)){					
						$rollBack=true;
						break;
					}
		}
		
		if(empty($rollBack)){
			mysql_query("COMMIT");
		
			/*if(empty($_REQUEST['id'])){
				pageRedirection("account-opening-balance/index.php?page=add&msg=1");	
			}else{
				pageRedirection("account-opening-balance/index.php?&msg=2");	
			}*/	
		}else{
			mysql_query("ROLLBACK");
		}
		
	
	
?>