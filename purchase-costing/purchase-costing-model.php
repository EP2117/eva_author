<?php 

	function addCountry()

	{

		if(isset($_POST['pur_costing_insert'])) {

		

			$pur_costing_name   = trim($_POST['pur_costing_name']);

			$pur_costing_active_status = 'active';

			

			if(!empty($pur_costing_name)) {

				$select_pur_costing = "SELECT pur_costing_name FROM pur_costings

							  WHERE pur_costing_name = '".$pur_costing_name."' 

							  AND pur_costing_deleted_status = 0";

			$result_pur_costing = mysql_query($select_pur_costing);

			$rows_pur_costing   = mysql_num_rows($result_pur_costing);

			// add pur_costing 

				if($rows_pur_costing !=1) 

				{

					$ip = getRealIpAddr();

					$insert_pur_costing = "INSERT INTO pur_costings(pur_costing_name, pur_costing_added_by, pur_costing_added_on,

									   pur_costing_added_ip, pur_costing_active_status) 

									   VALUES ('".$pur_costing_name."', '".$_SESSION[SESS.'_session_user_id']."',

									   UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$pur_costing_active_status."')";

					

					mysql_query($insert_pur_costing);

					header("Location:index.php?page=add&msg=1"); //added successfully

					} else {

					header("Location:index.php?page=add&msg=4"); // This pur_costing name already taken

				}

			} else {

				header("Location:index.php?page=add&msg=3");

			}

		} 

	

	}

	

	

	function listCountry()

	{

	

		$where =' pur_costing_deleted_status = 0'; 

		

		if(!empty($_REQUEST['search_pur_costing_active_status'])) {

			$where .= " AND pur_costing_active_status='".$_REQUEST['search_pur_costing_active_status']."'";

		}	

				



		if(!empty($_REQUEST['search_pur_costing_name'])) {

			$where .=" AND  pur_costing_name  LIKE '%".$_REQUEST['search_pur_costing_name']."%' "; 

		}

	   $select_pur_costing = "SELECT pur_costing_id,pur_costing_name,pur_costing_active_status FROM pur_costings 

			              WHERE $where ORDER BY pur_costing_active_status,pur_costing_name ";

		 $result = mysql_query($select_pur_costing);

 

  // Filling up the array

		  $pur_costing_data = array();

		 

		  while ($row = mysql_fetch_array($result))

		  {

			 $pur_costing_data[] = $row;

		  }

	return $pur_costing_data;

   }

   

   function editCountry()

   {

      if(isset($_GET['id']))

	   {

	      $pur_costing_id = $_GET['id'];

		 

		  

		   $select_pur_costing = "SELECT pur_costing_name,pur_costing_active_status FROM pur_costings 

			              WHERE pur_costing_id = '".$pur_costing_id."' ";

		 $result = mysql_query($select_pur_costing);

 

  // Filling up the array

		  $pur_costing = array();

		 $pur_costing = mysql_fetch_array($result);

	return $pur_costing;

	   		

   	   }

   }



   function updateCountry()

   {

   		if(isset($_POST['pur_costing_update']))

		{		

			$pur_costing_id = trim($_POST['pur_costing_id']);

			$pur_costing_name   = trim($_POST['pur_costing_name']);

			$pur_costing_active_status = $_POST['pur_costing_active_status'];

			if(!empty($pur_costing_name))

			{

					$select_pur_costing = "SELECT pur_costing_name FROM pur_costings

								  WHERE pur_costing_name = '".$pur_costing_name."' 

								  AND pur_costing_id != '".$pur_costing_id."' 

								  AND pur_costing_deleted_status = 0";

				$result_pur_costing = mysql_query($select_pur_costing);

				$rows_pur_costing   = mysql_num_rows($result_pur_costing);

				// add pur_costing 

					if($rows_pur_costing !=1) 

					{


						$ip = getRealIpAddr();

				mysql_query("UPDATE pur_costings SET  pur_costing_name           = '".$pur_costing_name."', 

												 pur_costing_active_status         = '".$pur_costing_active_status."', 

												 pur_costing_modified_by    = '".$_SESSION[SESS.'_session_user_id']."', 

												 pur_costing_modified_on    = UNIX_TIMESTAMP(NOW()), 

												 pur_costing_modified_ip    = '".$ip."' 

								  WHERE pur_costing_id = ".$pur_costing_id." LIMIT 1"); 

								 

							 

					header("Location:index.php?page=edit&pur_costing_id=$pur_costing_id&msg=2"); //updated successfully

					}else {

							header("Location:index.php?page=edit&pur_costing_id=$pur_costing_id&msg=4");

					}

			}

			else {

			

				header("Location:index.php?page=edit&pur_costing_id=$pur_costing_id&msg=3");

			}

			

		}

   }

   function check_pur_costing_state($id){

	     $select_state	 = "	SELECT 

									state_id 

								FROM 

									states

								WHERE  

									state_deleted_status 	= 0 				AND 

									state_pur_costing_id		= '".$id."'";

		$result_state 		= mysql_query($select_state);

		 $row_state	 		= mysql_num_rows($result_state);

		 return $row_state;

   }	

	

   function deleteCountry()

   {

   		if(isset($_POST['delete_pur_costing']))

		{
		$id =$_POST['deleteCheck'];
		$ip = getRealIpAddr();

		for($i=0;$i<count($id);$i++){
		$update="UPDATE pur_costings SET pur_costing_deleted_status = '1',
										pur_costing_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
										pur_costing_deleted_on = UNIX_TIMESTAMP(NOW()), 
										pur_costing_deleted_ip    = '".$ip."'
										WHERE 
										pur_costing_id ='".$id[$i]."' ";
			
			mysql_query($update);
										
										}

			/*deleteRecords('pur_costings', 'pur_costing_deleted_by', 'pur_costing_deleted_on', 'pur_costing_deleted_ip', 'pur_costing_deleted_status', 'pur_costing_id', '1'); // Table name, table field - deleted_by, table field name2, table field name3, table field name*/ 

			 

		header("Location:index.php?msg=5");

		}

   

   } 		



	

	



?>