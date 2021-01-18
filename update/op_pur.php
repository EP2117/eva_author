<?php 
require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	 $select="SELECT * FROM account_opening_balance LEFT JOIN account_sub ON account_sub_id=oP_account_sub_id WHERE account_sub_type_id='4' ";
	$query=mysql_query($select);
	while($result=mysql_fetch_array($query)){
		$amt=$result['oP_frgn_debit_amnt']+$result['oP_frgn_credit_amnt'];
	$uniq_id = generateUniqId();
	
	$select_inv="SELECT * FROM purchase_invoice WHERE pI_supplier_id='".$result['account_sub_master_id']."' AND invoiceNo='OB'";
	$query_inv=mysql_query($select_inv);
	$reulst_inv=mysql_fetch_array($query_inv);
	$invoice_id=$reulst_inv['invoiceId'];
	if($invoice_id==0){
	$insert="INSERT purchase_invoice SET invoiceNo='OB',pI_invoice_date='".date('Y-m-d')."',pI_supplier_id='".$result['account_sub_master_id']."',pI_net_total='".$amt."',pI_company_id=1,pI_branchid='".$result['oP_branch_id']."'";
	
	mysql_query($insert);	
	}else{
	 $update="UPDATE purchase_invoice SET pI_invoice_date='".date('Y-m-d')."',pI_supplier_id='".$result['account_sub_master_id']."',pI_net_total='".$amt."',pI_company_id=1,pI_branchid='".$result['oP_branch_id']."' WHERE invoiceId='".$invoice_id."'";
	mysql_query($update);
	}
	
	}
	echo "successful";

?>
