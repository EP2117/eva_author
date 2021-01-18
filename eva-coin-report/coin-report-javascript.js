 
 function requestIdFn(val){
	$.getJSON('product-detail.php?action=request_details&reqid='+val,function(josn) {  
		if(0<josn.length){
			var apnd;
			$("#warehouse_rcpt").val(josn[0]['godown_name']);
			$("#employee_rcpt").val(josn[0]['employee_name']);
			$("#department_rcpt").val(josn[0]['department_name']);
			$("#date_rcpt").val(josn[0]['iRq_rqdate']);
			$("#reqtype_rcpt").val(josn[0]['iRq_req_type']);
			$("#reqtype_rcpt").val(josn[0]['iRq_req_type']);
			$("#nopackage_rcpt").val(josn[0]['iRq_noofpaking']);
			$("#packdetails_rcpt").val(josn[0]['iRq_pakingdetails']);
			//$("#remark_rcpt").val(josn[0]['iRq_remarks']);
			
			for(var i=0;i<josn.length;i++){
				
				apnd += '<tr>';
				apnd += '<td><input type="hidden" name="idd_'+i+'" value=""><input type="hidden" name="productid_rcpt_'+i+'"  value='+josn[i]['iRp_productid']+'>'+josn[i]['product_name']+'</td>';
				apnd += '<td>'+josn[i]['product_code']+'</td>';
				apnd += '<td><input type="text" class="form-control" name="stock_rcpt_'+i+'" id="stock_rcpt_'+i+'"></td>';
				apnd += '<td><input type="text" class="form-control" name="qty_rcpt_'+i+'" id="qty_rcpt_'+i+'"></td>';
				apnd += '<td><input type="text" class="form-control" name="bal_qty_rcpt_'+i+'" id="bal_qty_rcpt_'+i+'" ></td>';
				apnd += '<td><input type="text" class="form-control" name="stock_rcpt_'+i+'" id="stock_rcpt_'+i+'"></td>';
				apnd += '<td><input type="text" class="form-control" name="stock_rcpt_'+i+'" id="stock_rcpt_'+i+'"></td>';
				apnd += '<td><input type="text" class="form-control" name="stock_rcpt_'+i+'" id="stock_rcpt_'+i+'"></td>';
				apnd += '<td><input type="text" class="form-control" name="stock_rcpt_'+i+'" id="stock_rcpt_'+i+'"></td>';
				apnd += '<td><input type="text" class="form-control" name="stock_rcpt_'+i+'" id="stock_rcpt_'+i+'"></td>';
				apnd += '<td><input type="text" class="form-control" name="stock_rcpt_'+i+'" id="stock_rcpt_'+i+'"></td>';
				apnd += '</tr>';
				
			}
			$("#receipt_apnd").val(josn.length);
			$("#receipt_table >tbody").html(apnd);
		}else{
			alert("No record found")
		}
		
	});
 }

 
 
 