<?php 
	require('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php 
if (isset($_FILES['file'])) {
	
	require_once "simplexlsx.class.php";
	
	$xlsx = new SimpleXLSX( $_FILES['file']['tmp_name'] );
	
	

?>


<table border="1" cellpadding="3" style="border-collapse: collapse">

	<?php
	$i=1;
	list($cols,) = $xlsx->dimension();
	//echo "<pre>";
	//print_r($xlsx->rows()); exit;
	$a= 0;
	foreach( $xlsx->rows() as $k => $r) {
	
	?> 
 
  <tr>
    <?php 
	
		$rows = 0;
		if(!empty($r[1]) && $r[1]!= 'name') {
			$customer_code		= $r[0];	
			$headoff_amt		= $r[2];
			$sbgg_amt			= $r[3];
			$sbgg_adv_amt		= $r[4];
			$sbgg2_amt			= $r[5];
			$sbgg2_adv_amt		= $r[6];
			$thiriyadana_amt	= $r[7];
			$boc_amt			= $r[8];
			$fyear				= "1";
			$company_id			= "1";
			
			$select_branch		=	"SELECT 
									customer_id, customer_name, customer_code, 	customer_contact_no, customer_uniq_id
								 FROM 
									customers 
								 WHERE 
									customer_deleted_status 	= 	0 							AND 
									customer_code				= '".$customer_code."'			AND
									customer_active_status 	    =	'active'
								 ORDER BY 
									customer_id ASC";

			$result_branch 		= mysql_query($select_branch);
			$record_branch 		= mysql_fetch_array($result_branch);
			
			$customer_id		= $record_branch['customer_id'];
			
			$select_account_sub		=	"SELECT 
										account_sub_id
									 FROM 	
										account_sub 
									 WHERE 
										account_sub_master_id 		= '".$customer_id."'							AND 
										account_sub_code_type		= 'customer'
								 ORDER BY 
									account_sub_id ASC";

			$result_account_sub 		= mysql_query($select_account_sub);
			$record_account_sub 		= mysql_fetch_array($result_account_sub);
			$account_sub_id				= $record_account_sub['account_sub_id'];
			if($headoff_amt!='' && $headoff_amt>0){	
					$credit_amnt		= $headoff_amt;
					$debit_amnt			= 0;
					$branch_id			= "4";
					  $query="INSERT INTO account_opening_balance SET oP_account_sub_id='".$account_sub_id."',oP_debit_amnt='".$debit_amnt."', 	oP_credit_amnt='".$credit_amnt."',oP_frgn_debit_amnt='".$debit_amnt."', oP_frgn_credit_amnt='".$credit_amnt."',oP_company_id='".$company_id."',oP_financial_year='".$fyear."' ,oP_branch_id='".$branch_id."' ";
					  mysql_query($query);
			}
			if($sbgg_amt!='' && $sbgg_amt>0){	
					$credit_amnt		= $sbgg_amt;
					$debit_amnt			= 0;
					$branch_id			= "3";
					  $query="INSERT INTO account_opening_balance SET oP_account_sub_id='".$account_sub_id."',oP_debit_amnt='".$debit_amnt."', 	oP_credit_amnt='".$credit_amnt."',oP_frgn_debit_amnt='".$debit_amnt."', oP_frgn_credit_amnt='".$credit_amnt."',oP_company_id='".$company_id."',oP_financial_year='".$fyear."' ,oP_branch_id='".$branch_id."' ";
					  mysql_query($query);
					
			}
			if($sbgg_adv_amt!='' && $sbgg_adv_amt>0){
					$credit_amnt		= 0;
					$debit_amnt			= $sbgg_adv_amt;
					$branch_id			= "3";
					  $query="INSERT INTO account_opening_balance SET oP_account_sub_id='".$account_sub_id."',oP_debit_amnt='".$debit_amnt."', 	oP_credit_amnt='".$credit_amnt."',oP_frgn_debit_amnt='".$debit_amnt."', oP_frgn_credit_amnt='".$credit_amnt."',oP_company_id='".$company_id."',oP_financial_year='".$fyear."' ,oP_branch_id='".$branch_id."' ";
					  mysql_query($query);
					
			}
			if($sbgg2_amt!='' && $sbgg2_amt>0){	
					$credit_amnt		= $sbgg2_amt;
					$debit_amnt			= 0;
					$branch_id			= "6";
					  $query="INSERT INTO account_opening_balance SET oP_account_sub_id='".$account_sub_id."',oP_debit_amnt='".$debit_amnt."', 	oP_credit_amnt='".$credit_amnt."',oP_frgn_debit_amnt='".$debit_amnt."', oP_frgn_credit_amnt='".$credit_amnt."',oP_company_id='".$company_id."',oP_financial_year='".$fyear."' ,oP_branch_id='".$branch_id."' ";
					  mysql_query($query);
					
			}
			if($sbgg2_adv_amt!='' && $sbgg2_adv_amt>0){
					$credit_amnt		= 0;
					$debit_amnt			= $sbgg2_adv_amt;
					$branch_id			= "6";
					  $query="INSERT INTO account_opening_balance SET oP_account_sub_id='".$account_sub_id."',oP_debit_amnt='".$debit_amnt."', 	oP_credit_amnt='".$credit_amnt."',oP_frgn_debit_amnt='".$debit_amnt."', oP_frgn_credit_amnt='".$credit_amnt."',oP_company_id='".$company_id."',oP_financial_year='".$fyear."' ,oP_branch_id='".$branch_id."' ";
					  mysql_query($query);
					
			}
			if($thiriyadana_amt!='' && $thiriyadana_amt>0){
					$credit_amnt		= $thiriyadana_amt;
					$debit_amnt			= 0;
					$branch_id			= "7";
					  $query="INSERT INTO account_opening_balance SET oP_account_sub_id='".$account_sub_id."',oP_debit_amnt='".$debit_amnt."', 	oP_credit_amnt='".$credit_amnt."',oP_frgn_debit_amnt='".$debit_amnt."', oP_frgn_credit_amnt='".$credit_amnt."',oP_company_id='".$company_id."',oP_financial_year='".$fyear."' ,oP_branch_id='".$branch_id."' ";
					  mysql_query($query);
					
			}
			if($boc_amt!='' && $boc_amt>0){
					$credit_amnt		= $boc_amt;
					$debit_amnt			= 0;
					$branch_id			= "8";
					  $query="INSERT INTO account_opening_balance SET oP_account_sub_id='".$account_sub_id."',oP_debit_amnt='".$debit_amnt."', 	oP_credit_amnt='".$credit_amnt."',oP_frgn_debit_amnt='".$debit_amnt."', oP_frgn_credit_amnt='".$credit_amnt."',oP_company_id='".$company_id."',oP_financial_year='".$fyear."' ,oP_branch_id='".$branch_id."' ";
					  mysql_query($query);
					
			}
		}
							
	
		 $i=$i +1;


	
	
	
 	?>
  </tr>
 <?php $a = $a +1; } ?>
</table>
<?php } ?>
<h1>Upload</h1>
<form method="post" enctype="multipart/form-data">
*.XLSX <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Parse" />
</form>

</body>
</html>
