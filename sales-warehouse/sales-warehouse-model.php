<?php
	function listData(){
		$select_data		=	"SELECT * FROM ton_per_feet WHERE deleted_status=0 AND active_status = 'active'
								 ORDER BY id ASC";
		$result_data 		= mysql_query($select_data);
		// Filling up the array
		$data 		= array();
		while ($record_data = mysql_fetch_array($result_data))
		{
		 $data[] 	= $record_data;
		}
		return $data;
	}	

	
	function insertData(){
		
		$thick		= trim($_POST['thick']);
		$inches     = trim($_POST['inches_txt']);
		$mm			= trim($_POST['mm_txt']);
		$feet		= trim($_POST['feet_txt']);
		$ton 		= trim($_POST['ton_txt']);
		$ip			= getRealIpAddr();
		
		//check already exist or not
		$select_data		=	"SELECT * FROM ton_per_feet WHERE thick='".$thick."' AND inches='".$inches."' AND deleted_status =0";
		$result_data 		= mysql_query($select_data);
		$rows = mysql_num_rows($result_data);
		if($rows > 0) {
			pageRedirection("sales-warehouse/index.php?msg=4");
		} else {
			$insert_data 	= sprintf("INSERT INTO ton_per_feet  (thick, inches, mm, feet, ton, added_by, added_on, added_ip,
										company_id) VALUES ('%d', '%f', '%f','%f', '%f', '%d', UNIX_TIMESTAMP(NOW()), '%s',
										'%d')", 
										$thick, $inches, $mm, $feet, $ton, $_SESSION[SESS.'_session_user_id'],$ip, $_SESSION[SESS.'_session_company_id']);
			//echo $insert_godown; exit;																  
			mysql_query($insert_data);
			pageRedirection("sales-warehouse/index.php?msg=1");
		}
	}

	function editData($id){
		$select_data = "SELECT * FROM ton_per_feet WHERE id=".$id;
		$result_data = mysql_query($select_data);
		$record_data = mysql_fetch_array($result_data);
		return $record_data;
	}	
	
	function updateData(){
		$id         = trim($_REQUEST['id']);
		$thick		= trim($_POST['thick']);
		$inches     = trim($_POST['inches_txt']);
		$mm			= trim($_POST['mm_txt']);
		$feet		= trim($_POST['feet_txt']);
		$ton 		= trim($_POST['ton_txt']);
		$ip			= getRealIpAddr();
		
		//check already exist or not
		$select_data		=	"SELECT * FROM ton_per_feet WHERE thick='".$thick."' AND inches='".$inches."' AND deleted_status =0 AND id != ".$id;
		$result_data 		= mysql_query($select_data);
		$rows = mysql_num_rows($result_data);
		if($rows > 0) {
			pageRedirection("sales-warehouse/index.php?msg=4&id=$id");
		} else {
			$update_data = sprintf("UPDATE ton_per_feet SET 
										thick = '%d',
										inches = '%f',
										mm = '%f',
										feet = '%d',
										ton = '%f',
										modified_by = '%d',
										modified_on = UNIX_TIMESTAMP(NOW()),
										modified_ip	= '%s'
									WHERE               
										id             		= '%d'", 
										$thick,
										$inches,
										$mm,
										$feet,
										$ton,
										$_SESSION[SESS.'_session_user_id'], 
										$ip, 
										$id); 
			mysql_query($update_data);
			pageRedirection("sales-warehouse/index.php?msg=5&id=$id");
		}
	}
	
	function deleteData(){
	
		if(isset($_REQUEST['select_all'])){
			$ip	= getRealIpAddr();
			
			for($i=0;$i<count($_REQUEST['select_all']);$i++){
			
				$delete ="UPDATE ton_per_feet SET deleted_status	 = 1 ,
															deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
															deleted_on = UNIX_TIMESTAMP(NOW()),
															deleted_ip = '".$ip."'
							WHERE id = '".$_REQUEST['select_all'][$i]."' ";
			
				mysql_query($delete);
				header("Location:index.php?msg=3");
			
			
			}
		}
	}
	
?>