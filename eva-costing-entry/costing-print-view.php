<!DOCTYPE html>
<html>
<head>
    <title>Advance</title>
   	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style type="text/css" media="all">
/* @page{
margin-left: 0px;
margin-right: 0px;
margin-top: 12.7mm;
margin-bottom: 12.7mm;
}*/

		   table{
				/*border-left:1px solid #000000;*/
			}
			tr{
/*				width:100%;
				display: table;*/
			}
			td{
				padding:5px;
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

<body >

   <table style="width:100%;font-size:12px;" cellspacing="0"  class="report-outer-table">

   <tr>
	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' >EVE STEEL <br/><span style="font-size:14px;"> </span></td>
	</tr>
	<tr>
 	 <td width="100%" colspan="4" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:16px;padding:10px;' > COSTING ENTRY </td>
	</tr>
   <tr>
	  <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:left;font-weight:bold;font-size:13px;' >INVOICE NO : &nbsp;<?=$invoice_entry_edit['invoiceNo']?></td>
	 <td width="50%" colspan="2" class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:13px;' >DATE : <?=dateGeneralFormatN($invoice_entry_edit['cs_costingdate'])?></td>
	</tr>
	
	
	
 </table>
 <br>
	
	
<?php
											
	if($invoice_entry_prd_edit){?>
	
	
			<table style="width:100%" class="report-outer-table" id="product_detail_rls">
			<tr>
				  <td colspan="8" class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:13px;' >PRODUCT DETAILS </td>
			</tr>
			 
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:5%;' > SNO </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:18%;' > NAME </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' > CURRENCY </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' > RATE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' > FRG.RATE </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' > AMOUNT BY CUR </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' > AMOUNT BY MMK </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' > REMARKS </td>
			</tr>
			
	<?php  
	$sno=1;			
	foreach($invoice_entry_prd_edit as $getDetail){

 ?>	
			<tr>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$sno++?> </td>
				<td class="report-border-right report-border-bottom " style='text-align:center;font-size:11px;' > 
					<?=$getDetail['pur_costing_name']?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['currency_name']?></td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['c_rate'],2,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['c_frgnrate'],2,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['c_amount_cur'],2,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=number_format($getDetail['c_amount'],2,'.','')?> </td>
				<td class="report-border-right report-border-bottom" style='text-align:center;font-size:11px;' > 
					<?=$getDetail['c_remarks']?> </td>
				
			</tr>

	
<?php   } ?>

			</table>
			<?php
}


 ?>
</tbody>
 </table>

<br/>	
<table style="width:100%;font-size:11px;" cellspacing="0"  class="report-outer-table">
	<tr>
		<td class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:5%;' >  </td>
				<td class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:18%;' >  </td>
				<td class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' >  </td>
				<td class="report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%;' >  </td>
		<td class="report-border-right report-border-bottom" style='text-align:center;font-weight:bold;font-size:11px;width:10%' > TOTAL AMOUNT </td>
		<td class="report-border-right report-border-bottom" style='text-align:right;font-weight:bold;font-size:11px;width:10%' > <?=number_format($invoice_entry_edit['cs_total_frgnrate'],2,'.','')?> &nbsp;&nbsp;</td><td style="text-align:right;font-weight:bold;font-size:11px;width:10%" class="report-border-bottom report-border-right"><?=number_format($invoice_entry_edit['cs_total_rate'],2,'.','')?> &nbsp;&nbsp;</td>
		<td style="text-align:right;font-weight:bold;font-size:11px;width:10%" class="report-border-bottom">&nbsp;</td>
	</tr>
	
</table>
   
		

</body>


</html>
