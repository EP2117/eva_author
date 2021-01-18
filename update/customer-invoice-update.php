<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

			
			
			$select_branch		=	"SELECT 
										account_sub_master_id,
										oP_credit_amnt
									 FROM 
										account_opening_balance
									 INNER JOIN
										account_sub
									 ON
										account_sub_id	= oP_account_sub_id 
									 WHERE 
										account_sub_deleted_status 	= 	0 AND
										account_sub_code_type		= 'customer'
									 ORDER BY 
										account_sub_master_id ASC";

		$result_branch 		= mysql_query($select_branch);

		// Filling up the array

		$customer_data 		= array();
        $sno =1;
		while ($record_branch = mysql_fetch_array($result_branch))

		{
             //  print_r($record_branch); echo $sno++."<br>"; 
			 $invoice_entry_customer_id		= $record_branch['account_sub_master_id'];
			 $invoice_entry_date				= "2018-08-30";
			 $invoice_entry_net_amount		=  $record_branch['oP_credit_amnt'];
			 $invoice_entry_financial_year	= "1";
			 $invoice_entry_company_id		= "1";
			 $invoice_entry_branch_id		= "4";
			 $ip				= getRealIpAddr();
		 $select_invoice_no = "SELECT MAX(invoice_entry_no) AS maxval FROM invoice_entry 
								  WHERE invoice_entry_deleted_status =0
								  AND invoice_entry_financial_year = '".$invoice_entry_financial_year."'
								  AND invoice_entry_company_id = '".$invoice_entry_company_id."' ";

		$result_invoice_no = mysql_query($select_invoice_no);

		$record_invoice_no = mysql_fetch_array($result_invoice_no);	

		$maxval = $record_invoice_no['maxval']; 

		if($maxval > 0) {

			$invoice_entry_no = substr(('00000'.++$maxval),-5);

		} else {

			$invoice_entry_no = substr(('00000'.++$maxval),-5);

		}
		if($invoice_entry_net_amount>0){
			$invoice_entry_uniq_id							= generateUniqId();
			$insert_accounts = "INSERT INTO invoice_entry(invoice_entry_no,invoice_entry_date,invoice_entry_customer_id,invoice_entry_net_amount,invoice_entry_company_id, 
														invoice_entry_financial_year,invoice_entry_added_by,invoice_entry_added_on,invoice_entry_added_ip,
														invoice_entry_branch_id,invoice_entry_uniq_id) 
														VALUES ('".$invoice_entry_no."', '".$invoice_entry_date."','".$invoice_entry_customer_id."',
																'".$invoice_entry_net_amount."','".$invoice_entry_company_id."','".$invoice_entry_financial_year."',
																'1',UNIX_TIMESTAMP(NOW()) , '".$ip."','".$invoice_entry_branch_id."','".$invoice_entry_uniq_id."')";
			//echo 	$insert_accounts; exit;												
			mysql_query($insert_accounts);
		}
        
		}  exit;



?>

