<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	if( (isset($_GET["type"])) && (!empty($_GET["type"]))  ) {
		if ($_GET["type"] == '2'){
			$select_branch_code 	=	"SELECT 
											SUBSTRING( MAX( branch_code ) , 3, 6 )  AS branch_code  
										 FROM 
										 	branches
										 WHERE 
											branch_code  				LIKE 'BR%' 											AND
								   			branch_company_id			='".$_SESSION[SESS.'_session_company_id']."'		AND
								   			branch_deleted_status 		= 0";
			$result_branch_code 	= mysql_query($select_branch_code);
			$record_branch_code   	= mysql_fetch_array($result_branch_code);					
			$max_branch_code = $record_branch_code['branch_code'];
			$branch_code = 'AT'.substr(('000000'.++$max_branch_code),-6);
			echo  "<input name='branch_code' type='text' value='".$branch_code."' class='form-control' id='branch_code' readonly ='readonly' />";
		} else {
			echo  "<input name='branch_code' type='text' value='' class='form-control' id='branch_code'    />";
		}	
	
		  
	  
	}	
?>
