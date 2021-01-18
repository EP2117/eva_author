<!DOCTYPE html>
<html>
<head>
    <title><?php echo $lang['lang_invoice_report']; ?></title>
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php require_once '../includes/common.php'; ?>
 <style type="text/css" media="all">
		   table{
				/*border-left:1px solid #000000;*/
			}
			tr{
				width:100%;
				display: table;
			}
			tbody tr.head {
				/*width:100%;*/
				page-break-before: always;
				page-break-inside: avoid;
			}
			@media screen {
				tbody .head{
					display: none;
				}
			}  
		.report-table-border-top {
		border-top:1px solid #000000 !important;
		}
		.report-table-border-bottom {
		border-bottom:1px solid #000000 !important;
		}
		.report-border-top {
		border-top:1px solid #000000 !important;
		}
		.report-border-right {
		border-right:1px solid #000000 !important;
		}
		.report-border-bottom {
		border-bottom:1px solid #000000 !important;
		}
		.report-border-left {
		border-left:1px solid #000000 !important;
		}
		
		.report-padding-top-bottom {
		padding:5px 0px;
		}
		.report-padding-table-top-bottom {
		padding:4px 0px;
		}
		.repor-table-border 
		{
		border-left:1px solid #000000 !important;
		 
		}
		.repor-table-left-bottom
		{
		border-bottom:1px solid #000000 !important; 
		border-left:1px solid #000000 !important;
		}
		.report-outer-table {
		border:1px solid #000000 !important;
		}
		</style>  
   
</head>
<body>
   <table style="width:100%;" cellspacing="0" class="report-outer-table">
   <thead>
	<tr class="head">
		<td style='text-align:left;font-size:150%;font-weight:bold; ' class="report-border-left report-border-top " colspan="4">
		<img src="<?php echo PROJECT_PATH.'/images/'.$_SESSION[SESS.'_session_company_logo']?>" alt='' title='' width='80' />
		<span style="font-size:30px;"><?php echo $list_company['company_name']?></span>
		</td>
		<td style='text-align:right;' class="report-border-top report-border-right" colspan="2"><?php echo nl2br($list_company['company_address'])?></td>
	</tr>
	<tr >
		<td colspan='7' class='report-border-left report-background report-border-top report-border-right' style='width:100%; text-align:center; font-size:16px;'><strong><?php echo  $lang['lang_invoice_report']?> - <?php echo $date_display?></strong>
	</td>
	</tr>
    <tr>
      <th style="width:6%; padding:3px;" class=" report-border-left report-border-top report-border-right report-border-bottom report-padding-top-bottom">S.No</th>
      <th style="width:15%; padding:3px;" class="report-border-right report-border-top report-border-bottom report-padding-top-bottom"><?php echo $lang['lang_invoice_no']; ?></th>
      <th style="width:15%; padding:3px;" class="report-border-right report-border-top report-border-bottom report-padding-top-bottom"><?php echo $lang['lang_date']; ?></th>
      <th style="width:30%; padding:3px;" class="report-border-right report-border-top report-border-bottom report-padding-top-bottom"><?php echo $lang['lang_customer']; ?></th>
	  <th style="width:15%; padding:3px;" class="report-border-right report-border-top report-border-bottom report-padding-top-bottom"><?php echo $lang['lang_sales_man']; ?></th>
      <th style="width:17%; padding:3px;" class="report-border-right report-border-top report-border-bottom report-padding-top-bottom"><?php echo $lang['lang_total']; ?> </th>
    </tr>
 </thead>
	<?php 	  
	$sno = 1; 
	$total = 0; 
	if($list_invoice_entry) {
		foreach($list_invoice_entry as $get_value){
		$total += $get_value['invoice_entry_total_amount'];
	?>
    <tr >
      <td style="width:6%; padding:3px;" class=" report-border-left report-border-right report-border-bottom report-padding-top-bottom"><?php echo $sno++; ?></td>
      <td style="width:15%; padding:3px;" class="report-border-right report-border-bottom report-padding-top-bottom"><?php echo $get_value['invoice_entry_no'];?></td>
      <td style="width:15%; padding:3px;" class="report-border-right report-border-bottom report-padding-top-bottom"><?php echo dateGeneralFormat($get_value['invoice_entry_date']);?></td>
      <td  style="width:30%; padding:3px;" class="report-border-right report-border-bottom report-padding-top-bottom"><?php echo $get_value['customer_name'].'-'.$get_value['customer_code'];?></td>
	  <td  style="width:15%; padding:3px;" class="report-border-right report-border-bottom report-padding-top-bottom"><?php echo $get_value['salesman_name'];?></td> 
      <td  style="width:17%; padding:3px; text-align:right;" class="report-border-right report-border-bottom report-padding-top-bottom"><?php echo number_format($get_value['invoice_entry_total_amount'],2,'.','');?></td>
    </tr>
    
    <?php }  ?>
	<tr >
      <td colspan="5" class="report-border-right report-border-bottom report-padding-top-bottom" style="width:81%; padding:3px; font-weight:bold; text-align:right"><?php echo $lang['lang_total']; ?></td>
      <td  style="width:17%; padding:3px; text-align:right; font-weight:bold;" class="report-border-right report-border-bottom report-padding-top-bottom"><?php echo $total; ?></td>
    </tr>
	<?php }?>
    <tr >
      <td colspan="6" class="report-padding-top-bottom" style="width:100%; padding:3px; text-align:right; font-weight:bold;">&nbsp;</td>
    </tr>
  </table>
</body>
</html>
