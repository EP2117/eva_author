<?php ob_start();

	function addCity()

	{

		if(isset($_POST['city_insert'])) { 

		

			

			$city_name   = trim($_POST['city_name']);

			$city_active_status = 'active';

			$city_country_id   = trim($_POST['city_country_id']);

			$city_state_id   = trim($_POST['city_state_id']);

			if(!empty($city_name))

			{

				$select_city = "SELECT city_name FROM cities

							  WHERE city_name = '".$city_name."' 

							  AND city_delete_status = 0";

			$result_city = mysql_query($select_city);

			$rows_city   = mysql_num_rows($result_city);

			// add city 

				if($rows_city !=1) 

				{

				

					$ip = getRealIpAddr();

					$insert_city = "INSERT INTO cities(city_name,city_country_id,city_state_id, city_added_by, city_added_on,

									   city_added_ip, city_active_status) 

									   VALUES ('".$city_name."', '".$city_country_id."','".$city_state_id."',

									   '".$_SESSION[SESS.'_session_user_id']."',

									   UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$city_active_status."')";

					

					mysql_query($insert_city);

					header("Location:index.php?page=add&msg=1"); //added successfully

					} else {

					header("Location:index.php?page=add&msg=4"); // This city name already taken

				}

			}

			else{

				header("Location:index.php?page=add&msg=5");

			}

		} 

	

	}

	

	

	function listCity()

	{

	

		$where =' city_deleted_status = 0'; 

	

		if(!empty($_REQUEST['search_city_name'])) {

			$where .=" AND  city_name  LIKE '%".$_REQUEST['search_city_name']."%' "; 

		}



		if(!empty($_REQUEST['search_city_active_status'])) {

			$where .= " AND city_active_status='".$_REQUEST['search_city_active_status']."'";

		}		

		

	

		

		

		

		

	   $select_city = "SELECT city_id,city_name,city_active_status,state_name,country_name FROM cities 

					   LEFT JOIN countries ON country_id = city_country_id

					   LEFT JOIN states ON state_id = city_state_id

					   WHERE $where

					   ORDER BY city_name";

		 $result = mysql_query($select_city);

 

  // Filling up the array

		  $city_data = array();

		 

		  while ($row = mysql_fetch_array($result))

		  {

			 $city_data[] = $row;

		  }

	return $city_data;

   }

   

   function editCity()

   {

      if(isset($_GET['id']))

	   {

	      $city_id = $_GET['id'];

		 

		  

		   $select_city = "SELECT city_name,city_active_status,city_country_id,city_state_id,state_name,country_name FROM cities 

						   LEFT JOIN countries ON country_id = city_country_id

						   LEFT JOIN states ON state_id = city_state_id

			               WHERE city_id = '".$city_id."' ";

		 $result = mysql_query($select_city);

 

  // Filling up the array

		  $city = mysql_fetch_array($result);

	return $city;

	   		

   	   }

   }



   function updateCity()

   {

   		if(isset($_POST['city_update']))

		{

			$city_name   			= trim($_POST['city_name']);

			$city_country_id   		= trim($_POST['city_country_id']);

			$city_state_id   		= trim($_POST['city_state_id']);

			$city_active_status 	= $_POST['city_active_status'];

			$city_id 				= $_POST['city_id'];

			if(!empty($city_name))

			{

				$select_city = "SELECT city_name FROM cities

								  WHERE city_name = '".$city_name."' 

								  AND city_id != '".$city_id."' AND city_delete_status = 0"; 

				$result_city = mysql_query($select_city);

				$rows_city   = mysql_num_rows($result_city);

				// add city 

					if($rows_city !=1) 

					{

						if($city_active_status=='inactive'){

							$state_rows	= check_other_city($city_id); 

							if($state_rows>0){

								header("Location:index.php?page=edit&city_id=$city_id&msg=7"); exit;

							}

						}

						$ip = getRealIpAddr();

					

								 

					 mysql_query("UPDATE cities SET  city_name           = '".$city_name."', 

				 								 city_country_id     = '".$city_country_id."', 

												 city_state_id       = '".$city_state_id."', 

												 city_active_status         = '".$city_active_status."', 

												 city_modified_by    = '".$_SESSION[SESS.'_session_user_id']."', 

												 city_modified_on    = UNIX_TIMESTAMP(NOW()), 

												 city_modified_ip    = '".$ip."' 

								  WHERE city_id = ".$city_id." LIMIT 1"); 

					header("Location:index.php?page=edit&city_id=$city_id&msg=2"); //updated successfully

					}else {

							header("Location:index.php?page=edit&city_id=$city_id&msg=4");

					}

			}

			else {

			

				header("Location:index.php?page=edit&city_id=$city_id&msg=5");

			}

			

		}

   }

   function check_other_city($id){

	     $select_city	 = "	SELECT 

									supplier_id 

								FROM 

									suppliers

								WHERE  

									supplier_active_status	= 'active'			AND

									supplier_deleted_status = 0 				AND 

									supplier_city_id		= '".$id."'"; 

		$result_city 		= mysql_query($select_city);

		 $row_city	 		= mysql_num_rows($result_city);

		 return $row_city;

   }	

	

   function deleteCity()

   {

   		if(isset($_POST['delete_city']))

		{

			$id =$_POST['deleteCheck'];
		$ip = getRealIpAddr();

		for($i=0;$i<count($id);$i++){
		$update="UPDATE cities SET city_deleted_status = '1',
										city_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
										city_deleted_on = UNIX_TIMESTAMP(NOW()), 
										city_deleted_ip    = '".$ip."'
										WHERE 
										city_id ='".$id[$i]."' ";
			
			mysql_query($update);

		header("Location:index.php?msg=3");

		}

   }

   } 		



	

	function getStateList($id)

	{

		

	   $select_state = "SELECT state_id,state_name,state_country_id FROM states

			              WHERE state_deleted_status = 0 AND state_active_status = 'active' AND state_country_id = '".$id."'

						  ORDER BY state_name ASC";

		 $result = mysql_query($select_state);

 

  // Filling up the array

		  $state_data = array();

		 

		  while ($row = mysql_fetch_array($result))

		  {

			 $state_data[] = $row;

		  }

	return $state_data;

   }

	





?>