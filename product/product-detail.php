<?php  

	require_once('../includes/config/config.php');

	require_once('../includes/config/utility-class.php');

	$count					= $_REQUEST['count'];
	$brand_id				= $_REQUEST['brand_id'];
	//$raw_product_list		= getProduct();
	$select_product		=	"SELECT 
								
								brand_name,
								brand_id
								
							 FROM 
							brands 
							
							 WHERE 
								brand_deleted_status 		= 0 
								AND brand_id='".$brand_id."'				
							 ORDER BY 
								brand_name ASC";
	//echo $select_product;exit;
	$result_product 		= mysql_query($select_product);
	$arra_data=array();
	//$sn=0;
	while($get_product			=mysql_fetch_array($result_product)){
		$arra_data[]=$get_product;
		//$arra_data[$sn++]['m_c_type']=1;
	}
	
	/*$select_product1		=	"SELECT 
								product_con_entry_child_product_detail_name as product_name,
								product_con_entry_child_product_detail_code as product_code,
								product_con_entry_child_product_detail_id as product_id
							 FROM 
								product_con_entry_child_product_details 
							WHERE 
								product_con_entry_child_product_detail_deleted_status 		= 0 					
								AND product_con_entry_child_product_detail_product_brand_id='".$brand_id."'				
							 ORDER BY 
								product_con_entry_child_product_detail_id ASC";
	//echo $select_product;exit;
	$result_product1 		= mysql_query($select_product1);

	while($get_product1			=mysql_fetch_array($result_product1)){
		$arra_data[]=$get_product1;
		//$arra_data[$sn++]['m_c_type']=2;
	}
	*/
	//print_r($arra_data);exit;
	
	
	
?>	

	

	<tr  class="odd gradeX">

	<td width="12%">

		<select name="product_detail_raw_product_id[]" id="product_detail_raw_product_id_<?=$count?>" class="form-control select2" style="width:100%">

			  <!--<option value=""> - Select - </option>-->

			<?php

				foreach($arra_data as $get_product){

			?>

					<option value="<?=$get_product['brand_id']?>"  ><?=$get_product['brand_name']?></option>

			<?php

				}

			?>

		</select>

	</td>

	<!--<td width="17%">
   
   

	<input name="product_detail_raw_product_uom[]" type="text" value="" class="form-control" id="product_detail_raw_product_uom_<?=$count?>"  />

	</td>

	<td width="17%">

	<input name="brand_name[]" type="text" value="" class="form-control" id="brand_name_<?=$count?>"/>

	</td>
	
	<td width="17%">

        <input name="product_detail_raw_product_require_line[]" type="text" value="" class="form-control" id="product_detail_raw_product_require_line_1"/>
   </td>-->

  </tr>

