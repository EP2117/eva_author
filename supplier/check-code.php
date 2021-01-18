<?php  

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	if( (isset($_GET["type"])) && (!empty($_GET["type"]))  ) {

		if ($_GET["type"] == '2'){

			$select_supplier_code 	=	"SELECT 

											SUBSTRING( MAX( supplier_code ) , 3, 6 )  AS supplier_code  

										 FROM 

										 	suppliers

										 WHERE 

											supplier_code  				LIKE 'SU%' 											AND

								   			supplier_company_id			='".$_SESSION[SESS.'_session_company_id']."'		AND

								   			supplier_deleted_status 		= 0";

			$result_supplier_code 	= mysql_query($select_supplier_code);

			$record_supplier_code   	= mysql_fetch_array($result_supplier_code);					

			$max_supplier_code = $record_supplier_code['supplier_code'];

			$supplier_code = 'SU'.substr(('000000'.++$max_supplier_code),-6);

			echo  "<input name='supplier_code' type='text' value='".$supplier_code."' class='form-control' id='supplier_code' readonly ='readonly' />";

		} else {

			echo  "<input name='supplier_code' type='text' value='' class='form-control' id='supplier_code'    />";

		}	

	

		  

	  

	}	

?>

