<?php 

	function addthick()

	{

		if(isset($_POST['thick_insert'])) {

		

			$thick_val   = trim($_POST['thick_val']);

			$thick_active_status = 'active';

			

			if(!empty($thick_val)) {

				$select_thick = "SELECT thick_val FROM thickness

							  WHERE thick_val = '".$thick_val."' 

							  AND thick_deleted_status = 0";

			$result_thick = mysql_query($select_thick);

			$rows_thick   = mysql_num_rows($result_thick);

			// add country 

				if($rows_thick !=1) 

				{

					$ip = getRealIpAddr();

					$insert_thick = "INSERT INTO thickness(thick_val, thick_added_by, thick_added_on,

									   thick_added_ip, thick_active_status) 

									   VALUES ('".$thick_val."', '".$_SESSION[SESS.'_session_user_id']."',

									   UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$thick_active_status."')";

					

					mysql_query($insert_thick);

					header("Location:index.php?page=add&msg=1"); //added successfully

					} else {

					header("Location:index.php?page=add&msg=4"); // This country name already taken

				}

			} else {

				header("Location:index.php?page=add&msg=3");

			}

		} 

	

	}

	

	

	function listthick()

	{

	

		$where =' thick_deleted_status = 0'; 

	    $select_country = "SELECT thick_val,thick_id FROM thickness 

			              WHERE $where ORDER BY thick_id DESC ";

		 $result = mysql_query($select_country);

 

  // Filling up the array

		  $country_data = array();

		 

		  while ($row = mysql_fetch_array($result))

		  {

			 $country_data[] = $row;

		  }

	return $country_data;

   }

   

   function editthick()

   {

      if(isset($_GET['thick_id']))

	   {

	      $thick_id = $_GET['thick_id'];

		 

		  

		   $select_country = "SELECT thick_id,thick_val FROM thickness 

			              WHERE thick_id = '".$thick_id."' ";

		 $result = mysql_query($select_country);

 

  // Filling up the array

		  $country = array();

		 $country = mysql_fetch_array($result);

	return $country;

	   		

   	   }

   }



   function updatethick()

   {

   		if(isset($_POST['thick_update']))

		{		

			$thick_id = trim($_POST['thick_id']);

			$thick_val   = trim($_POST['thick_val']);

			/*$thick_active_status = $_POST['country_active_status'];*/

			if(!empty($thick_val))

			{

						$ip = getRealIpAddr();

				mysql_query("UPDATE thickness SET  thick_val           = '".$thick_val."', 

												 thick_modified_by    = '".$_SESSION[SESS.'_session_user_id']."', 

												 thick_modified_on    = UNIX_TIMESTAMP(NOW()), 

												 thick_modified_ip    = '".$ip."' 

								  WHERE thick_id = ".$thick_id." LIMIT 1"); 

								 

							 

					header("Location:index.php?page=edit&thick_id=$thick_id&msg=2"); //updated successfully

					

			}

			else {

			

				header("Location:index.php?page=edit&thick_id=$thick_id&msg=3");

			}

			

		}

   }

   function check_country_state($id){

	     $select_state	 = "	SELECT 

									state_id 

								FROM 

									states

								WHERE  

									state_deleted_status 	= 0 				AND 

									state_country_id		= '".$id."'";

		$result_state 		= mysql_query($select_state);

		 $row_state	 		= mysql_num_rows($result_state);

		 return $row_state;

   }	

	

   function deleteCountry()

   {

   		if(isset($_POST['delete_thick']))

		{
		$id =$_POST['deleteCheck'];
		$ip = getRealIpAddr();

		for($i=0;$i<count($id);$i++){
		$update="UPDATE thickness SET thick_deleted_status = '1',
										thick_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
										thick_deleted_on = UNIX_TIMESTAMP(NOW()), 
										thick_deleted_ip    = '".$ip."'
										WHERE 
										thick_id ='".$id[$i]."' ";
			
			mysql_query($update);
										
										}

			/*deleteRecords('countries', 'country_deleted_by', 'country_deleted_on', 'country_deleted_ip', 'country_deleted_status', 'country_id', '1'); // Table name, table field - deleted_by, table field name2, table field name3, table field name*/ 

			 

		header("Location:index.php?msg=5");

		}

   

   } 		



	

	



?>