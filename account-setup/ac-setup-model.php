<?php 
	function insertUpdateACSetup(){
		
	
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
		$sales = explode('-',$_REQUEST['sales']);
		$sales_return = explode('-',$_REQUEST['sales_return']);
		$sales_ac1 = explode('-',$_REQUEST['sales_ac1']);
		$sales_ac2 = explode('-',$_REQUEST['sales_ac2']);
		$sales_ac3 = explode('-',$_REQUEST['sales_ac3']);
		$purchase = explode('-',$_REQUEST['purchase']);
		$purchase_return = explode('-',$_REQUEST['purchase_return']);
		$purchase_ac1 = explode('-',$_REQUEST['purchase_ac1']);
		$purchase_ac2 = explode('-',$_REQUEST['purchase_ac2']);
		$purchase_ac3 = explode('-',$_REQUEST['purchase_ac3']);
		
		 if(empty($_REQUEST['id'])){

			 $query="INSERT INTO account_setup SET acS_branchid='".$_REQUEST['branchid']."',acS_sales='".$sales[0]."', acS_sales_return='".$sales_return[0]."', acS_sales_ac1='".$sales_ac1[0]."', acS_sales_ac2='".$sales_ac2[0]."', acS_sales_ac3='".$sales_ac3[0]."',acS_ac_date=NOW(),acS_purchase='".$purchase[0]."',acS_purchase_return='".$purchase_return[0]."', acS_purchase_ac1='".$purchase_ac1[0]."', acS_purchase_ac2='".$purchase_ac2[0]."',acS_purchase_ac3='".$purchase_ac3[0]."',acS_company_id='$bC', acS_added_by='$by', acS_added_on=NOW(), acS_added_ip='$ip'  ";
	
		}else{
			
			echo $query="UPDATE account_setup SET acS_branchid='".$_REQUEST['branchid']."',acS_sales='".$sales[0]."', acS_sales_return='".$sales_return[0]."', acS_sales_ac1='".$sales_ac1[0]."', acS_sales_ac2='".$sales_ac2[0]."', acS_sales_ac3='".$sales_ac3[0]."',acS_purchase='".$purchase[0]."',acS_purchase_return='".$purchase_return[0]."', acS_purchase_ac1='".$purchase_ac1[0]."', acS_purchase_ac2='".$purchase_ac2[0]."',acS_purchase_ac3='".$purchase_ac3[0]."', acS_modified_by='$by', acS_gp_modified_on=NOW(), acS_modified_ip='$ip' WHERE acountSetupId='".$_REQUEST['id']."' ";
			
		}
		
		$qry = mysql_query($query);
		$last_id = mysql_insert_id();
		
		if(!empty($qry)){
			mysql_query("COMMIT");
			
			if(empty($_REQUEST['id'])){
				pageRedirection("account-setup/index.php?page=add&msg=1");	
			}else{
				pageRedirection("account-setup/index.php?&msg=2");	
			}	
		}else{
			mysql_query("ROLLBACK");
			
		}
	}
	function listACSetup(){
		
		$query  = "SELECT acountSetupId,branch_name,DATE_FORMAT(acS_ac_date ,'%d-%m-%Y') AS acS_ac_date 
				    FROM account_setup
					LEFT JOIN branches ON acS_branchid = branch_id 
					ORDER BY acountSetupId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editACSetup($id){
		$query  = "SELECT *,DATE_FORMAT(acS_ac_date ,'%d-%m-%Y') AS acS_ac_date
				    FROM account_setup 
					WHERE acountSetupId ='$id'";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}


?>