<?php 
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

	  $select="SELECT * FROM account_opening_balance LEFT JOIN account_sub ON account_sub_id=oP_account_sub_id WHERE account_sub_type_id='3' ";
	$query=mysql_query($select);

while($result=mysql_fetch_array($query)){ 
	$amt=$result['oP_frgn_debit_amnt']+$result['oP_frgn_credit_amnt'];
	$uniq_id = generateUniqId();
  	 $select_inv="SELECT * FROM invoice_entry WHERE invoice_entry_customer_id='".$result['account_sub_master_id']."' AND invoice_entry_no='OB'";
	$query_inv=mysql_query($select_inv);
	$reulst_inv=mysql_fetch_array($query_inv);
	$invoice_id=$reulst_inv['invoice_entry_id'];
	//$num_row=mysql_num_rows($query_inv);
	// $invoice_id;exit;
	if($invoice_id==0){
  	  $insert="INSERT INTO invoice_entry SET invoice_entry_uniq_id='".$uniq_id."',invoice_entry_no='OB',invoice_entry_date='".date('Y-m-d')."',invoice_entry_customer_id='".$result['account_sub_master_id']."',invoice_entry_net_amount='".$amt."',invoice_entry_company_id=1,invoice_entry_branch_id='".$result['oP_branch_id']."',invoice_entry_financial_year=1,invoice_entry_direct_type=2";
		mysql_query($insert);
	    
	}
	else{
	
	
 	 $update="UPDATE invoice_entry SET invoice_entry_customer_id='".$result['account_sub_master_id']."',invoice_entry_net_amount='".$amt."',invoice_entry_company_id=1,invoice_entry_branch_id='".$result['oP_branch_id']."',invoice_entry_financial_year=1,invoice_entry_direct_type=2 WHERE invoice_entry_id='".$invoice_id."'";
	mysql_query($update);
	    
	}

	//echo mysql_insert_id();
	
	}
	echo 'successful';
?>
