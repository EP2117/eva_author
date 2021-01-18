<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	if( (isset($_GET["type"])) && (!empty($_GET["type"]))  ) {
		if ($_GET["type"] == '2'){
			$select_godown_code 	=	"SELECT 
											SUBSTRING( MAX( godown_code ) , 3, 6 )  AS godown_code  
										 FROM 
										 	godowns
										 WHERE 
											godown_code  				LIKE 'GD%' 											AND
								   			godown_company_id			='".$_SESSION[SESS.'_session_company_id']."'		AND
								   			godown_deleted_status 		= 0";
			$result_godown_code 	= mysql_query($select_godown_code);
			$record_godown_code   	= mysql_fetch_array($result_godown_code);					
			$max_godown_code = $record_godown_code['godown_code'];
			$godown_code = 'GD'.substr(('000000'.++$max_godown_code),-6);
			echo  "<input name='godown_code' type='text' value='".$godown_code."' class='form-control' id='godown_code' readonly ='readonly' />";
		} else {
			echo  "<input name='godown_code' type='text' value='' class='form-control' id='godown_code'    />";
		}	
	
		  
	  
	}	
?>
