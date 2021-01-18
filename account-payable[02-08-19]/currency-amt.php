<?php
	require_once('../includes/config/config.php');
	require_once('../includes/config/utility-class.php');
		$cur_id			= $_REQUEST['cur_id'];
		$cur_amt		= $_REQUEST['cur_amt'];
		$entry_date		= NdateDatabaseFormat($_REQUEST['cur_date']);
		if(isset($_REQUEST['type'])){
		
		$select_account  = "SELECT 
								currency_detail_amount,
								currency_detail_currency_id,
								currency_name
							FROM
								currency_details
							LEFT JOIN
									currencies 
							   	ON
									currency_detail_currency_id				= currency_id 
							WHERE
									currency_detail_deleted_status			= 0												AND
									currency_detail_date					<='".$entry_date."'			 
							 ORDER BY 
									currency_detail_date DESC
							LIMIT 0,1";
						//	echo $select_account;exit;	
		$result_account = mysql_query($select_account);
		$record_account = mysql_fetch_array($result_account);
				if($_SESSION[SESS.'_default_currency_id']==$cur_id){
					$currency_amt	= 1;
				}else{
					$currency_amt	= $record_account['currency_detail_amount'];
				}
				
			echo $cur_amt/$currency_amt;
	
	}else{
		$select_account  = "SELECT 
								currency_detail_amount,
								currency_detail_currency_id,
								currency_name
							FROM
								currency_details
							LEFT JOIN
									currencies 
							   	ON
									currency_detail_currency_id				= currency_id 
							WHERE
									currency_detail_deleted_status			= 0												AND
									currency_detail_date					<='".$entry_date."'			 
							 ORDER BY 
									currency_detail_date DESC
							LIMIT 0,1";
						//echo $select_account;exit;	
		$result_account = mysql_query($select_account);
		$record_account = mysql_fetch_array($result_account);
		if($_SESSION[SESS.'_default_currency_id']==$cur_id){
			$currency_amt	= 1;
			$display		= '';
		}
		else{
			$currency_amt	= $record_account['currency_detail_amount'];
			$display		= "1 MMK=".$record_account['currency_detail_amount']." ".$record_account['currency_name'];
		}
	echo $cur_amt*$currency_amt."@".$display;
	}
	
?>