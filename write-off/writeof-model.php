<?php 



	function damgMsingScrpDetails(){
		
		 $query  = "SELECT damage_entry_id,damage_entry_no,damage_entry_date,damage_entry_type_id FROM damage_entry WHERE  damage_entry_deleted_status = 0 ORDER BY damage_entry_id DESC";
		// echo  $query;exit;
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}




	function writeoffInsertUpdate(){
		
		$by = $_SESSION[SESS.'_session_user_id'];		
		$bC = $_SESSION[SESS.'_session_company_id'];		
		$ip	= getRealIpAddr();	
		
		mysql_query("BEGIN");	
		
			if(empty($_REQUEST['id'])){
				  $writeoff_uniq_id 	= generateUniqId();
				  
				 $query = "INSERT INTO write_off SET wr_dmgMsgScrpId='".$_REQUEST['dmgmsg_Scrp_id']."', wr_branchid='".$_REQUEST['branchid']."', wr_warehouseid='".$_REQUEST['warehouseid']."',wr_date='".NdateDatabaseFormat($_REQUEST['write_date'])."',wr_type='".$_REQUEST['writeof_type']."',wr_type_id='".$_REQUEST['write_off_type_id']."',wr_company_id='$bC', wr_added_by='$by', wr_added_on= UNIX_TIMESTAMP(NOW()), wr_added_ip='$ip',writeoff_uniq_id='".$writeoff_uniq_id."'";
			
			}else{
			
				$query = "UPDATE write_off SET wr_dmgMsgScrpId='".$_REQUEST['dmgmsg_Scrp_id']."', wr_branchid='".$_REQUEST['branchid']."', wr_warehouseid='".$_REQUEST['warehouseid']."',wr_date='".NdateDatabaseFormat($_REQUEST['write_date'])."',wr_type='".$_REQUEST['writeof_type']."',wr_modified_by='$by', wr_modified_on= UNIX_TIMESTAMP(NOW()),wr_modified_ip='$ip' WHERE writeoffId='".$_REQUEST['id']."'";
			
			}
			$qry = mysql_query($query);		
			$last_id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : mysql_insert_id();
			$writeoff_entry_no = substr(('00000'.$last_id),-5);
			if(empty($qry)){
			
				$rollBack=true;
				
			}else{
			
			//Product Detail
		$writeoff_entry_product_detail_id     			= $_POST['writeoff_entry_product_detail_id'];
		$writeoff_entry_product_detail_product_type     = $_POST['writeoff_entry_product_detail_product_type'];
		$writeoff_entry_product_detail_id     			= $_POST['writeoff_entry_product_detail_id'];
		$writeoff_entry_product_detail_dm_detail_id     = isset($_POST['writeoff_entry_product_detail_dm_detail_id'])?$_POST['writeoff_entry_product_detail_dm_detail_id']:'';
		$writeoff_entry_product_detail_product_id     	= $_POST['writeoff_entry_product_detail_product_id'];
		$writeoff_entry_product_detail_product_color_id = $_POST['writeoff_entry_product_detail_product_color_id'];
		$writeoff_entry_product_detail_product_thick  	= isset($_POST['writeoff_entry_product_detail_product_thick'])?$_POST['writeoff_entry_product_detail_product_thick']:'';
		$writeoff_entry_product_detail_width_inches  	= isset($_POST['writeoff_entry_product_detail_width_inches'])?$_POST['writeoff_entry_product_detail_width_inches']:'';
		$writeoff_entry_product_detail_width_mm 		= isset($_POST['writeoff_entry_product_detail_width_mm'])?$_POST['writeoff_entry_product_detail_width_mm']:'';
		$writeoff_entry_product_detail_length_feet 		= isset($_POST['writeoff_entry_product_detail_length_feet'])?$_POST['writeoff_entry_product_detail_length_feet']:'';
		$writeoff_entry_product_detail_length_mm 		= isset($_POST['writeoff_entry_product_detail_length_mm'])?$_POST['writeoff_entry_product_detail_length_mm']:'';
		$writeoff_entry_product_detail_weight_tone 		= isset($_POST['writeoff_entry_product_detail_weight_tone'])?$_POST['writeoff_entry_product_detail_weight_tone']:'';
		$writeoff_entry_product_detail_weight_kg 		= isset($_POST['writeoff_entry_product_detail_weight_kg'])?$_POST['writeoff_entry_product_detail_weight_kg']:'';
		$writeoff_entry_product_detail_qty 				= isset($_POST['writeoff_entry_product_detail_qty'])?$_POST['writeoff_entry_product_detail_qty']:'';
		$writeoff_entry_product_detail_osf_uom_ton		= isset($_POST['writeoff_entry_product_detail_osf_uom_ton'])?$_POST['writeoff_entry_product_detail_osf_uom_ton']:'';
		$writeoff_entry_product_detail_mother_child_type		= isset($_POST['writeoff_entry_product_detail_mother_child_type'])?$_POST['writeoff_entry_product_detail_mother_child_type']:'';
		
				
				for($i = 0; $i < count($writeoff_entry_product_detail_product_id); $i++) { 
				// echo $writeoff_entry_product_detail_qty[$i]; exit;
					$detail_request_fields 							= 	((!empty($writeoff_entry_product_detail_product_id[$i])));
					if($detail_request_fields) {
						$writeoff_entry_product_detail_uniq_id 	= generateUniqId();
						if(!empty($writeoff_entry_product_detail_id[$i])){
						
						 $update_query="UPDATE writeoff_entry_product_details 
																	SET
																	writeoff_entry_product_detail_width_inches	='".$writeoff_entry_product_detail_width_inches[$i]."',
																	writeoff_entry_product_detail_width_mm		='".$writeoff_entry_product_detail_width_mm[$i]."',
																	writeoff_entry_product_detail_length_feet	='".$writeoff_entry_product_detail_length_feet[$i]."',
																	writeoff_entry_product_detail_length_mm		='".$writeoff_entry_product_detail_length_mm[$i]."',
																	writeoff_entry_product_detail_weight_tone	='".$writeoff_entry_product_detail_weight_tone[$i]."',
																	writeoff_entry_product_detail_weight_kg		='".$writeoff_entry_product_detail_weight_kg[$i]."',
																	writeoff_entry_product_detail_qty			='".$writeoff_entry_product_detail_qty[$i]."',
															writeoff_entry_product_detail_mother_child_type		='".$writeoff_entry_product_detail_mother_child_type[$i]."',
																	writeoff_entry_product_detail_deleted_by	='".$by."',
																	writeoff_entry_product_detail_deleted_on	= UNIX_TIMESTAMP(NOW()),
																	writeoff_entry_product_detail_deleted_ip	='".$ip."'
																WHERE
																	writeoff_entry_product_detail_id			='".$writeoff_entry_product_detail_id[$i]."' ";
																	
					mysql_query($update_query);	
						$detail_id		= $writeoff_entry_product_detail_id[$i];
						
						}else{
						$insert_writeoff_entry_product_detail 		= sprintf("INSERT INTO writeoff_entry_product_details 
																						(writeoff_entry_product_detail_uniq_id,writeoff_entry_product_detail_writeoff_entry_id,
																						 writeoff_entry_product_detail_dm_detail_id,writeoff_entry_product_detail_dm_entry_id,
																						 writeoff_entry_product_detail_product_id,writeoff_entry_product_detail_product_color_id,
																						 writeoff_entry_product_detail_product_type, writeoff_entry_product_detail_product_thick,
																						 writeoff_entry_product_detail_width_inches,writeoff_entry_product_detail_width_mm,
																						 writeoff_entry_product_detail_length_feet,writeoff_entry_product_detail_length_mm,
																						 writeoff_entry_product_detail_weight_tone,writeoff_entry_product_detail_weight_kg,
																						 writeoff_entry_product_detail_qty,
																						 writeoff_entry_product_detail_added_by, writeoff_entry_product_detail_added_on,
																						 writeoff_entry_product_detail_added_ip,
																						 writeoff_entry_product_detail_mother_child_type) 
																			VALUES     ('%s', '%d', 
																						'%d', '%d',
																						'%d', '%d',
																						'%d', '%d', 
																						'%f', '%f',
																						'%f', '%f', 
																						'%f', '%f', 
																						'%f',  
																						'%d', UNIX_TIMESTAMP(NOW()), '%s','%d' )", 
																				 $writeoff_entry_product_detail_uniq_id,$last_id,
																				 $writeoff_entry_product_detail_dm_detail_id[$i],$_REQUEST['dmgmsg_Scrp_id'],
																				 $writeoff_entry_product_detail_product_id[$i],$writeoff_entry_product_detail_product_color_id[$i],
																				 $writeoff_entry_product_detail_product_type[$i], $writeoff_entry_product_detail_product_thick[$i],
																				 $writeoff_entry_product_detail_width_inches[$i],$writeoff_entry_product_detail_width_mm[$i],
																				 $writeoff_entry_product_detail_length_feet[$i],$writeoff_entry_product_detail_length_mm[$i],
																				 $writeoff_entry_product_detail_weight_tone[$i],$writeoff_entry_product_detail_weight_kg[$i],
																				 $writeoff_entry_product_detail_qty[$i], $_SESSION[SESS.'_session_user_id'],$ip
																				 ,$writeoff_entry_product_detail_mother_child_type[$i]);
																				 //echo $insert_writeoff_entry_product_detail; exit;
						mysql_query($insert_writeoff_entry_product_detail);
						$detail_id		= mysql_insert_id();
					}	
						if($writeoff_entry_product_detail_product_type[$i]==1){
							$produt_id											=	$writeoff_entry_product_detail_product_id[$i];
							$product_colour_id									=	"1";
							$product_thick										=	"1";
							$width_inches										= 	"1";
							$width_mm											= 	"1";
							$length_feet										= 	"1";
							$length_meter										= 	"1";
							$ton_qty											= 	"1";
							$kg_qty												= 	"1";
							$product_detail_qty									= 	(-1*$writeoff_entry_product_detail_qty[$i]);
							$prd_type											= 	'1';
							$child_tpye											= 	$writeoff_entry_product_detail_mother_child_type[$i];
						}
						else{
							$produt_id											=	$writeoff_entry_product_detail_product_id[$i];
							$product_colour_id									=	$writeoff_entry_product_detail_product_color_id[$i];
							$product_thick										=	$writeoff_entry_product_detail_product_thick[$i];
							$width_inches										= 	$writeoff_entry_product_detail_width_inches[$i];
							$width_mm											= 	$writeoff_entry_product_detail_width_mm[$i];
							$length_feet										= 	$writeoff_entry_product_detail_length_feet[$i];
							$length_meter										= 	$writeoff_entry_product_detail_length_mm[$i];
							$ton_qty											= 	$writeoff_entry_product_detail_weight_tone[$i];
							$kg_qty												= 	$writeoff_entry_product_detail_weight_kg[$i];
							$product_detail_qty									= 	-1;
							$prd_type											= 	2;
							$child_tpye											= 	$writeoff_entry_product_detail_mother_child_type[$i];
							
						}
						
						$stock_ledger_entry_type							= 	"write-off";
						$writeoff_entry_branch_id							=  $_REQUEST['branchid'];
						//echo $_SESSION[SESS.'_session_user_branch_type'];exit;
						if($_SESSION[SESS.'_session_user_branch_type']==1){
							$product_con_entry_godown_id						= 	$_REQUEST['warehouseid'];
							stockLedger($child_tpye,'out',$last_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $writeoff_entry_branch_id,  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['write_date']), $writeoff_entry_no,$stock_ledger_entry_type, $prd_type,$width_inches,$width_mm,$product_colour_id,$product_thick);
							
							if($writeoff_entry_product_detail_product_type[$i]!=1){
								$child_produt_d										=  Child_prod_detail($produt_id);
								$produt_id											=  $child_produt_d['product_con_entry_child_product_detail_id'];
							}
							
							$product_con_entry_godown_id						= 	$_REQUEST['warehouseid'];
							stockLedger($child_tpye,'out',$last_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $writeoff_entry_branch_id,  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['write_date']), $writeoff_entry_no,$stock_ledger_entry_type, $prd_type,$width_inches,$width_mm,$product_colour_id,$product_thick);
						}
						else{
							$product_con_entry_godown_id						= 	$_REQUEST['warehouseid'];
							stockLedger($child_tpye,'out',$last_id,$detail_id,$produt_id,$length_feet,$length_meter,$ton_qty,$kg_qty,$product_detail_qty, $writeoff_entry_branch_id,  $product_con_entry_godown_id, NdateDatabaseFormat($_REQUEST['write_date']), $writeoff_entry_no,$stock_ledger_entry_type, $prd_type,$width_inches,$width_mm,$product_colour_id,$product_thick);
						}
					}
				}
				
			}
			
			if(empty($rollBack)){	
				mysql_query("COMMIT");
				if(empty($_REQUEST['id'])){
					pageRedirection("write-off/index.php?page=add&msg=1");	
				}else{
					pageRedirection("write-off/index.php?&msg=2");	
				}	
			}else{	
				mysql_query("ROLLBACK");
			}
			
			
			
			
		
	}
	function listwriteoff(){
		$where	= '';
		if(!empty($_REQUEST['search_branch_id'])){
			$where	.=" AND wr_branchid = '".$_REQUEST['search_branch_id']."'";
		}
		if((isset($_REQUEST['search_from_date'])) && !empty($_REQUEST['search_from_date']) && isset($_REQUEST['search_to_date'])&& !empty($_REQUEST['search_to_date']))
		{
		$where.="AND wr_date BETWEEN '".NdateDatabaseFormat($_REQUEST['search_from_date'])."'
					   AND '".NdateDatabaseFormat($_REQUEST['search_to_date'])."' ";
		}
		$query  = "SELECT writeoffId,damage_entry_no,wr_type,branch_name,godown_name,DATE_FORMAT(wr_date ,'%d/%m/%Y') AS wr_date
				    FROM write_off
					LEFT JOIN
						damage_entry
					ON
						damage_entry_id		= wr_dmgMsgScrpId
					LEFT JOIN branches ON wr_branchid = branch_id	
					LEFT JOIN godowns ON wr_warehouseid = godown_id
					WHERE wr_deleted_status=0	 $where
					ORDER BY writeoffId DESC";
				    
		$result = mysql_query($query);
		$array_result = array();
		while($resultData = mysql_fetch_array($result)){
			$array_result[] = $resultData;
		}
		return $array_result;
		
	}
	
	function editWriteoff($id){
		$query  = "SELECT A.*,DATE_FORMAT(wr_date ,'%d/%m/%Y') AS wr_date
				    FROM write_off A 
					WHERE writeoffId ='$id'
					
					AND wr_deleted_status =0";
				    
		 $result = mysql_query($query);	
		 $array_result = mysql_fetch_array($result);		 
		 return $array_result;
	}
	function editwriteofproduct($id){
		
		  $query = "SELECT 
		  				A.*,product_name,
						product_uom_name,
						product_code,
						brand_name,
						product_colour_name,
						product_con_entry_child_product_detail_code,
						product_con_entry_child_product_detail_name
					FROM 
						writeoff_entry_product_details A
					LEFT JOIN 
						product_con_entry_child_product_details 
					ON 
						product_con_entry_child_product_detail_id				= writeoff_entry_product_detail_product_id	
		 			LEFT JOIN products ON writeoff_entry_product_detail_product_id = product_id
					LEFT JOIN product_colours ON product_colour_id = product_con_entry_child_product_detail_color_id
					LEFT JOIN product_uoms ON product_uom_id = product_product_uom_id
					LEFT JOIN brands ON brand_id = product_brand_id
					
					WHERE writeoff_entry_product_detail_writeoff_entry_id='$id'
					AND writeoff_entry_product_detail_deleted_status	 =0
					";
		 $result = mysql_query($query);
		 $response =array();
		 while($resultData = mysql_fetch_array($result)){		 
			$response[]= $resultData;
		 }
		return $response;
	}
	
	function product_delete(){//echo $_REQUEST['uniq_id'];exit;
	
		if((isset($_REQUEST['product_detail_id'])) && (isset($_REQUEST['uniq_id'])))

		{
		$uniq_id =$_REQUEST['uniq_id'];
		$id		 =$_REQUEST['product_detail_id']; 
	mysql_query("UPDATE writeoff_entry_product_details SET writeoff_entry_product_detail_deleted_status = 1 

						WHERE writeoff_entry_product_detail_id = '".$id."' ");

			header("Location:index.php?page=edit&id=$uniq_id&msg=6");
	}
	
	}
	
		
function writeofdelete(){
	
	if(isset($_REQUEST['select_all'])){
		$ip									= getRealIpAddr();
		
		for($i=0;$i<count($_REQUEST['select_all']);$i++){
		  $delete_budget_entry ="UPDATE  write_off SET wr_deleted_status = 1 ,
		 												wr_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														wr_deleted_on	 = UNIX_TIMESTAMP(NOW()),
														wr_deleted_ip = '".$ip."'
						WHERE writeoffId = '".$_REQUEST['select_all'][$i]."' ";//exit;
		
		mysql_query($delete_budget_entry);
		
		 $delete_budget_entry ="UPDATE   writeoff_entry_product_details SET writeoff_entry_product_detail_deleted_status = 1 ,
		 												writeoff_entry_product_detail_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
														writeoff_entry_product_detail_deleted_on = UNIX_TIMESTAMP(NOW()),
														writeoff_entry_product_detail_deleted_ip = '".$ip."'
						WHERE writeoff_entry_product_detail_writeoff_entry_id = '".$_REQUEST['select_all'][$i]."' ";//exit;
		
		mysql_query($delete_budget_entry);
			header("Location:index.php");
		
		
		}
	
	}
	
	}
	


?>
