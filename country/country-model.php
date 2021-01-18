<?php 

	function addCountry()

	{

		if(isset($_POST['country_insert'])) {

		

			$country_name   = trim($_POST['country_name']);

			$country_active_status = 'active';

			

			if(!empty($country_name)) {

				$select_country = "SELECT country_name FROM countries

							  WHERE country_name = '".$country_name."' 

							  AND country_deleted_status = 0";

			$result_country = mysql_query($select_country);

			$rows_country   = mysql_num_rows($result_country);

			// add country 

				if($rows_country !=1) 

				{

					$ip = getRealIpAddr();

					$insert_country = "INSERT INTO countries(country_name, country_added_by, country_added_on,

									   country_added_ip, country_active_status) 

									   VALUES ('".$country_name."', '".$_SESSION[SESS.'_session_user_id']."',

									   UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$country_active_status."')";

					

					mysql_query($insert_country);

					header("Location:index.php?page=add&msg=1"); //added successfully

					} else {

					header("Location:index.php?page=add&msg=4"); // This country name already taken

				}

			} else {

				header("Location:index.php?page=add&msg=3");

			}

		} 

	

	}

	

	

	function listCountry()

	{

	

		$where =' country_deleted_status = 0'; 

		

		if(!empty($_REQUEST['search_country_active_status'])) {

			$where .= " AND country_active_status='".$_REQUEST['search_country_active_status']."'";

		}	

				



		if(!empty($_REQUEST['search_country_name'])) {

			$where .=" AND  country_name  LIKE '%".$_REQUEST['search_country_name']."%' "; 

		}

	   $select_country = "SELECT country_id,country_name,country_active_status FROM countries 

			              WHERE $where ORDER BY country_active_status,country_name ";

		 $result = mysql_query($select_country);

 

  // Filling up the array

		  $country_data = array();

		 

		  while ($row = mysql_fetch_array($result))

		  {

			 $country_data[] = $row;

		  }

	return $country_data;

   }

   

   function editCountry()

   {

      if(isset($_GET['id']))

	   {

	      $country_id = $_GET['id'];

		 

		  

		   $select_country = "SELECT country_name,country_active_status FROM countries 

			              WHERE country_id = '".$country_id."' ";

		 $result = mysql_query($select_country);

 

  // Filling up the array

		  $country = array();

		 $country = mysql_fetch_array($result);

	return $country;

	   		

   	   }

   }



   function updateCountry()

   {

   		if(isset($_POST['country_update']))

		{		

			$country_id = trim($_POST['country_id']);

			$country_name   = trim($_POST['country_name']);

			$country_active_status = $_POST['country_active_status'];

			if(!empty($country_name))

			{

					$select_country = "SELECT country_name FROM countries

								  WHERE country_name = '".$country_name."' 

								  AND country_id != '".$country_id."' 

								  AND country_deleted_status = 0";

				$result_country = mysql_query($select_country);

				$rows_country   = mysql_num_rows($result_country);

				// add country 

					if($rows_country !=1) 

					{

						if($country_active_status=='inactive'){

							$state_rows	= check_country_state($country_id); 

							if($state_rows>0){

								header("Location:index.php?page=edit&country_id=$country_id&msg=7"); exit;

							}

						}

						$ip = getRealIpAddr();

				mysql_query("UPDATE countries SET  country_name           = '".$country_name."', 

												 country_active_status         = '".$country_active_status."', 

												 country_modified_by    = '".$_SESSION[SESS.'_session_user_id']."', 

												 country_modified_on    = UNIX_TIMESTAMP(NOW()), 

												 country_modified_ip    = '".$ip."' 

								  WHERE country_id = ".$country_id." LIMIT 1"); 

								 

							 

					header("Location:index.php?page=edit&country_id=$country_id&msg=2"); //updated successfully

					}else {

							header("Location:index.php?page=edit&country_id=$country_id&msg=4");

					}

			}

			else {

			

				header("Location:index.php?page=edit&country_id=$country_id&msg=3");

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

   		if(isset($_POST['delete_country']))

		{
		$id =$_POST['deleteCheck'];
		$ip = getRealIpAddr();

		for($i=0;$i<count($id);$i++){
		$update="UPDATE countries SET country_deleted_status = '1',
										country_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
										country_deleted_on = UNIX_TIMESTAMP(NOW()), 
										country_deleted_ip    = '".$ip."'
										WHERE 
										country_id ='".$id[$i]."' ";
			
			mysql_query($update);
										
										}

			/*deleteRecords('countries', 'country_deleted_by', 'country_deleted_on', 'country_deleted_ip', 'country_deleted_status', 'country_id', '1'); // Table name, table field - deleted_by, table field name2, table field name3, table field name*/ 

			 

		header("Location:index.php?msg=5");

		}

   

   } 		



	

	



?>