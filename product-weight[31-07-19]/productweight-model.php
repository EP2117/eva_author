<?php 
	function productweight(){		
		
		
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
	
			for($i=1; $i<=$_REQUEST['prodweight_apnd']; $i++){
				
				if(empty($_REQUEST['wg_id_'.$i])){
				
				 	 $query = "INSERT INTO weight_calulation SET wc_brand_id='".$_REQUEST['product_brand_id']."', wc_thickid='".$_REQUEST['thick_'.$i]."', wc_wight_inches='".$_REQUEST['width_inches_'.$i]."',wc_wight_mm='".$_REQUEST['width_mm_'.$i]."',wc_length_feet='".$_REQUEST['length_feet_'.$i]."',wc_length_mm='".$_REQUEST['length_mm_'.$i]."',wc_weight_ton='".$_REQUEST['weight_ton_'.$i]."',wc_weight_mm='".$_REQUEST['weight_mm_'.$i]."',wc_added_by='$by',wc_added_on=NOW(),wc_added_ip='$ip'";
				
				//echo $query;exit;
				
				}else{
				
					  $query = "UPDATE weight_calulation SET wc_brand_id='".$_REQUEST['product_brand_id']."', wc_thickid='".$_REQUEST['thick_'.$i]."', wc_wight_inches='".$_REQUEST['width_inches_'.$i]."',wc_wight_mm='".$_REQUEST['width_mm_'.$i]."',wc_length_feet='".$_REQUEST['length_feet_'.$i]."',wc_length_mm='".$_REQUEST['length_mm_'.$i]."',wc_weight_ton='".$_REQUEST['weight_ton_'.$i]."',wc_weight_mm='".$_REQUEST['weight_mm_'.$i]."',wc_modified_by='$by',wc_modified_on=NOW(),wc_modified_ip='$ip' WHERE weightcalcId='".$_REQUEST['wg_id_'.$i]."' ";
				
				}
				 $qry   = mysql_query($query);
				
					if(empty($qry)){					
						$rollBack=true;
						break;
					}				
			}
			
			
			
		if(empty($rollBack)){						
			mysql_query("COMMIT");
	
			if(empty($_REQUEST['id'])){
				pageRedirection("product-weight/index.php?page=add&msg=1");	
			}else{
				pageRedirection("product-weight/index.php?&msg=2");	
			}			
		}else{						
			mysql_query("ROLLBACK");	
		
		}
	}
	
	function proweightList(){
		
		 $query  = "SELECT brand_name,brand_id
						FROM weight_calulation	
						LEFT JOIN brands ON  brand_id = wc_brand_id
						group BY wc_brand_id ORDER BY weightcalcId DESC";
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
		
	}
	
	
	function editEmpAplicantLang($id){
		 $query = "SELECT * FROM hr_emplyoment_appliaction_lanuages
		 			WHERE eApL_emApId='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		 return $response;
	}
	function editproweight($id){
		 $query = "SELECT * FROM weight_calulation
		 			WHERE wc_brand_id='$id'";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		 return $response;
	}
	
	
	function appdelete(){
	
	
		
		if(isset($_REQUEST['deleteCheck']))
		{//echo 'sdf54';exit;
			
				$checked      = $_POST['deleteCheck'];
				$count 		  = count($checked);
				for($i=0; $i < $count; $i++) 
				{ 
					$deleteCheck = $checked[$i]; 
					$ip 	= getRealIpAddr();
					
					
					     $update_addend 	= "UPDATE weight_calulation
									SET 
										wc_deleted_status    = '1',
										wc_deleted_by    	   = '".$_SESSION[SESS.'_session_user_id']."',
		                                wc_deleted_on        = UNIX_TIMESTAMP(NOW()),
		                                wc_deleted_ip        = '".$ip."'
								WHERE               
										emApId             	= '".$deleteCheck."' "; 
										//print_r($update_overtime);//exit;
				mysql_query($update_addend);
				
				
				
					
				}	
				header("Location:index.php");
		}else{header("Location:index.php");}
		
	
	
	}
	
?>