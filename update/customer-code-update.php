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
            $select_branch_code 	=	"SELECT 
											SUBSTRING( MAX( customer_code_n ) , 2, 6 )  AS customer_code_n  
										 FROM 
										 	customers
										 WHERE 
								   			customer_company_id			='".$_SESSION[SESS.'_session_company_id']."'		AND
								   			customer_deleted_status 		= 0";

			$result_branch_code 	= mysql_query($select_branch_code);
			$record_branch_code   	= mysql_fetch_array($result_branch_code);					

			$max_branch_code = $record_branch_code['customer_code_n'];
			$branch_code = 'C'.substr(('000000'.++$max_branch_code),-6);
		 
       echo $branch_code."<br>";
          echo  $update_customer 					= sprintf("UPDATE 
															customers 
														SET 
															customer_code_n 		= '".$branch_code."'
														WHERE               
															customer_id         = '".$record_branch['customer_id']."' "); 

        //  mysql_query($update_customer);
        
		}  exit;



?>

