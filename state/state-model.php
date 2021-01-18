<?php 

	function addState()

	{

		if(isset($_POST['state_insert'])) { 

		

			

			$state_name   = trim($_POST['state_name']);

			$state_active_status = 'active';

			$state_country_id = trim($_POST['state_country_id']);

			if(!empty($state_name))

			{

				$select_state = "SELECT state_name FROM states

							  WHERE state_name = '".$state_name."' AND state_deleted_status = 0";

			$result_state = mysql_query($select_state);

			$rows_state   = mysql_num_rows($result_state);

			// add state 

				if($rows_state !=1) 

				{

				

					$ip = getRealIpAddr();

					$insert_state = "INSERT INTO states(state_name, state_country_id, state_added_by, state_added_on,

									   state_added_ip, state_active_status) 

									   VALUES ('".$state_name."', '".$state_country_id."', '".$_SESSION[SESS.'_session_user_id']."',

									   UNIX_TIMESTAMP(NOW()) , '".$ip."', '".$state_active_status."')";

					

					mysql_query($insert_state);

					header("Location:index.php?page=add&msg=1"); //added successfully

					} else {

					header("Location:index.php?page=add&msg=4"); // This state name already taken

				}

			}

			else{

				header("Location:index.php?page=add&msg=5");

			}

		} 

	

	}

	

	

	function listState()

	{

	

		$where =' state_deleted_status = 0'; 

	

		if(!empty($_REQUEST['search_state_name'])) {

			$where .=" AND  state_name  LIKE '%".$_REQUEST['search_state_name']."%' "; 

		}

		

		if(!empty($_REQUEST['search_state_active_status'])) {

			$where .= " AND state_active_status='".$_REQUEST['search_state_active_status']."'";

		}		

	   $select_state = "SELECT state_id,state_name,state_active_status,country_name FROM states

	   						LEFT JOIN countries ON country_id = state_country_id 

			              WHERE $where

						  ORDER BY state_id DESC";

		 $result = mysql_query($select_state);

 

  // Filling up the array

		  $state_data = array();

		 

		  while ($row = mysql_fetch_array($result))

		  {

			 $state_data[] = $row;

		  }

	return $state_data;

   }

   

   function editState()

   {

      if(isset($_GET['id']))

	   {

	      $state_id = $_GET['id'];

		 

		  

		   $select_state = "SELECT state_name,state_active_status,state_country_id,country_name

		   					FROM states LEFT JOIN countries ON country_id=state_country_id 

							WHERE state_id = '".$state_id."'";

		 $result = mysql_query($select_state);

 

  // Filling up the array

		  $state = array();

		 

		  $state = mysql_fetch_array($result);

	return $state;

	   		

   	   }

   }



   function updateState()

   {

   		if(isset($_POST['state_update']))

		{

			

			$state_id 				= trim($_POST['state_id']);

			$state_name   			= trim($_POST['state_name']);

			$state_country_id   	= trim($_POST['state_country_id']);

			$state_active_status 	= trim($_POST['state_active_status']);

			if(!empty($state_name))

			{

					$select_state = "SELECT state_name FROM states

								  WHERE state_name = '".$state_name."' 

								  AND state_id != '".$state_id."' AND state_deleted_status = 0";

				$result_state = mysql_query($select_state);

				$rows_state   = mysql_num_rows($result_state);

				// add state 

					if($rows_state !=1) 

					{

						if($state_active_status=='inactive'){

							$state_rows	= check_state_city($state_id); 

							if($state_rows>0){

								header("Location:index.php?page=edit&state_id=$state_id&msg=7"); exit;

							}

						}

						$ip = getRealIpAddr();

				mysql_query("UPDATE states SET  state_name           = '".$state_name."', 

												state_country_id     = '".$state_country_id."', 

												 state_active_status         = '".$state_active_status."', 

												 state_modified_by    = '".$_SESSION[SESS.'_session_user_id']."', 

												 state_modified_on    = UNIX_TIMESTAMP(NOW()), 

												 state_modified_ip    = '".$ip."' 

								  WHERE state_id = ".$state_id." LIMIT 1"); 

					header("Location:index.php?page=edit&state_id=$state_id&msg=2"); //updated successfully

					}else {

							header("Location:index.php?page=edit&state_id=$state_id&msg=4");

					}

			}

			else {

			

				header("Location:index.php?page=edit&state_id=$state_id&msg=5");

			}

			

		}

   }

   function check_state_city($id){

	     $select_state	 = "	SELECT 

									city_id 

								FROM 

									cities

								WHERE  

									city_active_status	= 'active'			AND

									city_delete_status 	= 0 				AND 

									city_state_id		= '".$id."'"; 

		$result_state 		= mysql_query($select_state);

		 $row_state	 		= mysql_num_rows($result_state);

		 return $row_state;

   }	

  function deletestate()

   {

   		if(isset($_POST['delete_state']))

		{
		$id =$_POST['deleteCheck'];
		$ip = getRealIpAddr();

		for($i=0;$i<count($id);$i++){
		$update="UPDATE states SET state_deleted_status = '1',
										state_deleted_by = '".$_SESSION[SESS.'_session_user_id']."',
										state_deleted_on = UNIX_TIMESTAMP(NOW()), 
										state_deleted_ip    = '".$ip."'
										WHERE 
										state_id ='".$id[$i]."' ";
			
			mysql_query($update);
										
										}

					header("Location:index.php?msg=3");

		}

   

   }	







?>