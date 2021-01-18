<?php  
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
	if( (isset($_GET["type"])) && (!empty($_GET["type"]))  ) {
		if ($_GET["type"] == '2'){
			$select_product_code 	=	"SELECT 
											SUBSTRING( MAX( product_code ) , 3, 6 )  AS product_code  
										 FROM 
										 	products
										 WHERE 
											product_code  				LIKE 'PR%' 											AND
								   			product_company_id			='".$_SESSION[SESS.'_session_company_id']."'		AND
								   			product_deleted_status 		= 0";
			$result_product_code 	= mysql_query($select_product_code);
			$record_product_code   	= mysql_fetch_array($result_product_code);					
			$max_product_code = $record_product_code['product_code'];
			$product_code = 'PR'.substr(('000000'.++$max_product_code),-6);
			echo  "<input name='product_code' type='text' value='".$product_code."' class='form-control' id='product_code' readonly ='readonly' />";
		} else {
			echo  "<input name='product_code' type='text' value='' class='form-control' id='product_code'    />";
		}	
	
		  
	  
	}	
?>
