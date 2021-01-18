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
	$k		= 1;
	$led_id		= '';
	foreach( $xlsx->rows() as $k => $r) {
	?> 
  <tr>
    <?php 
		$rows = 0;
		if(!empty($r[1]) && $r[3]!= 'Color') {
			$product_brand 					= trim($r[2]);
			$product_code 					= trim($r[0]);
			$product_name 					= trim($r[1]);
			$product_colour_name			= trim($r[3]);
			$produc_thick					= trim($r[4]);
			$product_width 					= trim($r[5]);
			$product_width_mm				= number_format(($product_width*25.4),'4','.','');
			$product_feet 					= trim($r[6]);
			$product_feet_mm				= number_format(($product_feet*304.8),'4','.','');
			$product_weight_kg 				= trim($r[7]);
			$product_weight_ton				= number_format(($product_weight_kg/1000),'4','.','');
			
			/*$select="select * FROM product_colours WHERE product_colour_name ='".$product_colour_name."'";
			$query=mysql_query($select);
			$result=mysql_fetch_array($query);
			$product_colour_id=$result['product_colour_id'];*/

			$select="select * FROM thickness WHERE thick_val ='".$produc_thick."'";
			$query=mysql_query($select);
			$result=mysql_fetch_array($query);
			$thick_id=$result['thick_id'];
			
			 $select_product_code 	=	"SELECT 
												product_con_entry_child_product_detail_id 
											 FROM 
												product_con_entry_child_product_details
											 WHERE 
												product_con_entry_child_product_detail_code  		= '".$product_code."'			AND
												product_con_entry_child_product_detail_thick_ness	= '".$thick_id."'				AND
												product_con_entry_child_product_detail_type 		= 2"; 
				$result_product_code 	= mysql_query($select_product_code);
				$record_product_code   	= mysql_fetch_array($result_product_code);					
				$product_detail_id 		= $record_product_code['product_con_entry_child_product_detail_id'];
				
			  $select_stock_ledger 	=	"SELECT 
												stock_ledger_id 
											 FROM 
												stock_ledger
											 WHERE 
												stock_ledger_trans_no  		= '".$product_code."'			AND
												stock_ledger_prd_type		= '2'							AND
												stock_ledger_thick_ness		= '".$thick_id."'				AND	
												stock_ledger_godown_id		= '1'							AND
												stock_ledger_entry_id		 = '".$product_detail_id."'		AND			
												stock_ledger_entry_type 	= 'OPEN-ENTRY'"; 
				$result_stock_ledger 	= mysql_query($select_stock_ledger);
				
				while($record_stock_ledger   	= mysql_fetch_array($result_stock_ledger)){
					$led_id	.=$record_stock_ledger['stock_ledger_id']."-";
				}
					$led_id	.=$k."=".$led_id."<br>";
					//echo $select_stock_ledger."<br>";
					$k	= $k+1;
		}
		 $i=$i +1;
 	?>
  </tr>
 <?php $a = $a +1; } exit; ?>
</table>
<?php } ?>
<h1>Upload</h1>
<form method="post" enctype="multipart/form-data">
*.XLSX <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Parse" />
</form>

</body>
</html>
