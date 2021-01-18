<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');

			
			
			$select_branch		=	"SELECT 
									supplier_id, supplier_name, 
									supplier_code, supplier_uniq_id
								 FROM 
									suppliers 
								 WHERE 
									supplier_deleted_status 	= 	0 
								 ORDER BY 
									supplier_id ASC";

		$result_branch 		= mysql_query($select_branch);

		// Filling up the array

		$supplier_data 		= array();
        $sno =1;
		while ($record_branch = mysql_fetch_array($result_branch))

		{
             //  print_r($record_branch); echo $sno++."<br>"; 
			 $supplier_name		= $record_branch['supplier_name'];
			 $supplier_id		= $record_branch['supplier_id'];
			 $ip				= getRealIpAddr();
		$select_acc_group = "SELECT account_head_id FROM account_heads
												WHERE account_head_name	 like 'Sundry Creditor' 
												AND account_head_deleted_status = '0' LIMIT 1";
							
							$result_acc_group = mysql_query($select_acc_group);
							
							$row_acc_group = mysql_fetch_array($result_acc_group);
							
							$account_head_id = $row_acc_group['account_head_id'];
		
		$insert_accounts = "INSERT INTO account_sub(account_sub_name,account_sub_head_id,account_sub_code_type,account_sub_company_id,account_sub_added_by, 
															account_sub_added_on,account_sub_added_ip,account_sub_master_id,account_sub_type_id) 
													VALUES ('".$supplier_name."', '".$account_head_id."','supplier','1',
															'1',UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$supplier_id."','4')";
															
		mysql_query($insert_accounts);
        
		}  exit;



?>

