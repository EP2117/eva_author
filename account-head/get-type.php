<?php 
require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');
	$val = $_GET["type_one_id"];
	$select="<option value=''>--Select--</option>";
	if($val == 'pl') {
			foreach($arr_account_type21 as $account_type2_value => $account_type2_list) {
					$select .= "<option value='".$account_type2_value."'>".$account_type2_list."</option>";
			}
	} else if($val == 'bs') {
			foreach($arr_account_type22 as $account_type2_value => $account_type2_list) {
					$select .= "<option value='".$account_type2_value."'>".$account_type2_list."</option>";
			}
	}

echo $select;
?>
