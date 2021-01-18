<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

			
			
			$select_branch		=	"SELECT 
										account_sub_master_id,
										oP_debit_amnt
									 FROM 
										account_opening_balance
									 INNER JOIN
										account_sub
									 ON
										account_sub_id	= oP_account_sub_id 
									 WHERE 
										account_sub_deleted_status 	= 	0 AND
										account_sub_code_type		= 'supplier'
									 ORDER BY 
										account_sub_master_id ASC";

		$result_branch 		= mysql_query($select_branch);

		// Filling up the array

		$customer_data 		= array();
        $sno =1;
		while ($record_branch = mysql_fetch_array($result_branch))

		{
             //  print_r($record_branch); echo $sno++."<br>"; 
			 $pI_supplier_id		= $record_branch['account_sub_master_id'];
			 $pI_invoice_date				= "2018-08-30";
			 $pI_invoicetotal		=  $record_branch['oP_debit_amnt'];
			 $pI_company_id		= "1";
			 $pI_branchid		= "4";
			 
			 
			$select_inv_no = "SELECT MAX(invoiceNo) AS maxval FROM purchase_invoice 
							  WHERE  	pI_deleted_status =0
							  AND 		pI_branchid = '".$pI_branchid."'
							  AND 		pI_company_id = '".$pI_company_id."'";
	
			$result_inv_no = mysql_query($select_inv_no);
			$record_inv_no = mysql_fetch_array($result_inv_no);	
			$maxval = $record_inv_no['maxval']; 
			if($maxval > 0) {
				$invoiceNo = substr(('00000'.++$maxval),-5);
			} else {
				$invoiceNo = substr(('00000'.++$maxval),-5);
			}
			 
			 
			 $ip				= getRealIpAddr();
		if($pI_invoicetotal>0){
			$invoice_entry_uniq_id							= generateUniqId();
			$insert_accounts = "INSERT INTO purchase_invoice(invoiceNo,pI_invoice_date,pI_supplier_id,pI_invoicetotal,pI_company_id, 
														pI_added_by,pI_added_on,pI_added_ip,
														pI_branchid) 
														VALUES ('".$invoiceNo."', '".$pI_invoice_date."','".$pI_supplier_id."',
																'".$pI_invoicetotal."','".$pI_company_id."',
																'1',UNIX_TIMESTAMP(NOW()) , '".$ip."','".$pI_branchid."')";
			mysql_query($insert_accounts);
		}
        
		}  exit;



?>

