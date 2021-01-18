<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

			
			
			$select_branch		=	"SELECT 
									customer_id, customer_name, customer_code, 	customer_contact_no, customer_uniq_id
								 FROM 
									customers 
								 WHERE 
									customer_deleted_status 	= 	0 AND 
									customer_active_status 	    =	'active'
								 ORDER BY 
									customer_id ASC";

		$result_branch 		= mysql_query($select_branch);

		// Filling up the array

		$customer_data 		= array();
        $sno =1;
		while ($record_branch = mysql_fetch_array($result_branch))

		{
             //  print_r($record_branch); echo $sno++."<br>"; 
			 $customer_name		= $record_branch['customer_name'];
			 $customer_id		= $record_branch['customer_id'];
			 $ip				= getRealIpAddr();
		$select_acc_group = "SELECT account_head_id FROM account_heads
												WHERE account_head_name	 like 'Sundry Debtors' 
												AND account_head_deleted_status = '0' LIMIT 1";
							
							$result_acc_group = mysql_query($select_acc_group);
							
							$row_acc_group = mysql_fetch_array($result_acc_group);
							
							$account_head_id = $row_acc_group['account_head_id'];
		
		$insert_accounts = "INSERT INTO account_sub(account_sub_name,account_sub_head_id,account_sub_code_type,account_sub_company_id,account_sub_added_by, 
															account_sub_added_on,account_sub_added_ip,account_sub_master_id,account_sub_type_id) 
													VALUES ('".$customer_name."', '".$account_head_id."','customer','1',
															'1',UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$customer_id."','3')";
															
		mysql_query($insert_accounts);
        
		}  exit;



?>

