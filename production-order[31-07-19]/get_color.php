<?php  

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

		if($_REQUEST['type']==1){




			 $select_branch_code 	=	"SELECT 

											product_colour_id,product_colour_name  

										 FROM 

										 	product_colours

										 WHERE 


								   				product_colour_deleted_status 		= 0";

			$result_branch_code 	= mysql_query($select_branch_code);

			$WHERE ="<option value=''> Select </option>";
			
			while($record_branch_code   	= mysql_fetch_array($result_branch_code)){
			
				$WHERE .="<option value=".$record_branch_code['product_colour_id']."> ".$record_branch_code['product_colour_name']." </option>";
			}					

			

		echo $WHERE;	

			
}else{

			$WHERE ="<option value=''>Select</option>";

			foreach($arr_thick as $key_val=>$get_val){
			$WHERE .="<option value=".$key_val."> ".$get_val." </option>";
			
			}
			
			echo $WHERE;

}		

?>

