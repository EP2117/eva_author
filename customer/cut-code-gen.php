<?php  

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	if( (isset($_GET["id"])) && (!empty($_GET["id"]))  ) {
				$select_branch_code 	=	"SELECT 

											SUBSTRING( MAX( customer_code ) , 2, 6 )  AS customer_code  

										 FROM 

										 	customers

										 WHERE 
											
								   			customer_company_id			='".$_SESSION[SESS.'_session_company_id']."'		AND
											customer_code_gen			= '2'												AND
								   			customer_deleted_status 		= 0";

			$result_branch_code 	= mysql_query($select_branch_code);

			$record_branch_code   	= mysql_fetch_array($result_branch_code);					

			$max_branch_code = $record_branch_code['customer_code'];

			$branch_code = 'C'.substr(('000000'.++$max_branch_code),-6);

			echo  $branch_code;

	}	

?>

