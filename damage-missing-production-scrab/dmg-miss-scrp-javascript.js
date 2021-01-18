function checkedAll(obj){
	var check =$(obj).prop('checked');
	
	if(check==true)
		$('.check').prop('checked',true);
	else
		$('.check').prop('checked',false);
	
}
 function selecttype(val){
	if(val==1){
		$("#request").show();
		$("#receipt").hide();
	}else if(val==2){
		$("#receipt").show();
		$("#request").hide();

	}
  }
 
function addReqRow(){
 	
	var last_val = $("#mising_dmg_apnd").val();
	var sno      = parseInt(last_val)+1;
	
	var apnd  = '<tr id="remove_req_'+sno+'">';
		
		apnd += '<td><input type="hidden" name="pid_'+sno+'" value=""><input type="text" class="form-control" name="prod_name_'+sno+'" id="prod_name_'+sno+'" onKeyUp="return get_product(this.value,this,'+sno+',1);"></td>';
		apnd += '<td><input type="text" class="form-control" name="prod_code_'+sno+'" id="prod_code_'+sno+'" readonly></td>';
		apnd += '<td><input type="text" class="form-control" name="prod_uom_one_'+sno+'" id="prod_uom_one_'+sno+'" readonly></td>';
/*		apnd += '<td><input type="text" class="form-control" name="prod_uom_two_'+sno+'" id="prod_uom_two_'+sno+'" readonly></td>';
*/		apnd += '<td><input type="text" class="form-control" name="color_'+sno+'" id="color_'+sno+'" readonly></td>';
		apnd += '<td><input type="text" class="form-control" name="thick_'+sno+'" id="thick_'+sno+'" readonly></td>';
		apnd += '<td><input type="text" class="form-control" name="width_'+sno+'" id="width_'+sno+'" readonly></td>';
		apnd += '<td><input type="text" class="form-control" name="length_'+sno+'" id="length_'+sno+'" readonly></td>';
		apnd += '<td><input type="text" class="form-control" name="qty_'+sno+'" id="qty_'+sno+'" onchange="return mant_calculate(this.value,this,'+sno+',1);"></td>';
		/*	apnd += '<td><input type="text" class="form-control" style="text-align:right" name="rate_'+sno+'" id="rate_'+sno+'" readonly></td>';
	    apnd += '<td><input type="text" class="form-control" style="text-align:right" name="amount_'+sno+'" id="amount_'+sno+'" readonly></td>';*/
		apnd += '<td><button class="glyphicon glyphicon-minus" title="Remove row"  type="button" onclick="removeRow('+sno+')"></button></td>';
		apnd += '</tr>';
		
		$("#mising_dmg_apnd").val(sno);
		$("#mising_dmg_table >tbody").append(apnd);
 }
 
 /*function request_data(){
	 $.getJSON('inventory-reqrec-model.php?rqst&reqid='+val,function(josn) {
	}
 }
 */
 
 function requestPO(val){
	 if(val!=''){
		$.getJSON('product-detail.php?action=request_details&poid='+val,function(josn) {  
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
					apnd += '<td><input type="hidden" name="idd_'+i+'" value=""><input type="hidden" name="s_productentryid_'+i+'"  value='+josn[i]['production_order_product_detail_id']+'><input type="hidden" name="s_productid_'+i+'"  value='+josn[i]['production_order_product_detail_product_id']+'>'+josn[i]['product_name']+' </td>';
					apnd += '<td>'+josn[i]['product_code']+'</td>';
					apnd += '<td>'+josn[i]['product_uom_name']+'</td>';
					apnd += '<td><input type="text" class="form-control" name="s_prod_uom_two_'+i+'" id="s_prod_uom_two_'+i+'" value='+josn[i]['product_uom_name']+' readonly></td>';
					apnd += '<td><input type="text" class="form-control" name="s_color_'+i+'" id="s_color_'+i+'" value='+josn[i]['product_colour_name']+' readonly></td>';
					apnd += '<td><input type="text" class="form-control" name="s_thick_'+i+'" id="s_thick_'+i+'" value='+josn[i]['product_thick_ness']+' readonly></td>';
					apnd += '<td><input type="text" class="form-control" name="s_width_'+i+'" id="s_width_'+i+'" value='+josn[i]['production_order_product_detail_width_feet']+' readonly></td>';
					apnd += '<td><input type="text" class="form-control" style="text-align:right" name="s_qty_'+i+'" id="s_qty_'+i+'" onchange="return mant_calculate(this.value,this,'+i+',2);" ></td>';
					apnd += '<td><input type="text" class="form-control" style="text-align:right" name="s_rate_'+i+'" id="s_rate_'+i+'" value='+josn[i]['product_cost_price']+' readonly></td>';
					apnd += '<td><input type="text" class="form-control" name="s_amount_'+i+'" id="s_amount_'+i+'" readonly ></td>';
	
	
					apnd += '<td></td>';
					apnd += '</tr>';
					
				}
				$("#scrp_apnd").val(josn.length);
				$("#scrp_table >tbody").html(apnd);
			}else{
				alert("No record found")
			}
			
		});
	 }else{
		 alert("Please select po data");
		 $("#scrp_table >tbody").html('<tr><td colspan="10" style="text-alig:center;">No records found</td></tr>');
	 }
 }
 function mant_calculate(val,obj,id,typ){
	if(typ==1){
		var qty = Number($("#qty_"+id).val()); 
		var rate = $("#rate_"+id).val().replace(/,/g , ''); 
		rate=Number(rate);
		$("#amount_"+id).val(forNum(qty*rate));
	}else if(typ==2){
		var qty = Number($("#s_qty_"+id).val()); 
		var rate = $("#s_rate_"+id).val().replace(/,/g , ''); 
		rate=Number(rate);
		$("#s_amount_"+id).val(forNum(qty*rate));
	}

 }
 
 function get_product(val,obj,sno,type){
	
	if($('#ds_date').val()!=''){
		$.getJSON('product-detail.php?action=get_prodname&val='+val,function(json) { 
			if(json.length>0){																						
				var productName = [];		
				for(var i=0;i<json.length;i++){			
					productName[i] = json[i]['product_con_entry_child_product_detail_id']+' - '+json[i]['product_con_entry_child_product_detail_code']+' - '+json[i]['product_con_entry_child_product_detail_name'];
				}	
				$(obj).autocomplete({
					maxResults: 10,
					source: productName,
					select: function(event,ui) { 
						var textval = ui.item.value;
						var item = textval.split(' - ');
						get_productdetails(item[0],obj,sno,type);
					}
				});		
			}else{
				alert("No data available");
				$(obj).val("");
			}
		});	
	}else{
		alert('Please select date');
		$(obj).val("");
	}
 }
 
 function get_productdetails(id,obj,sno,type){
	
	$.getJSON('product-detail.php?action=prod_details&id='+id+'&ds_date='+$("#ds_date").val(),function(json) { 
			if(0<json[0]['length']){
				$("#prod_code_"+sno).val(json[0]['product_con_entry_child_product_detail_code']);
				$("#prod_uom_one_"+sno).val(json[0]['product_uom_name']);
				/*$("#prod_uom_two_"+sno).val(json[0]['product_uom_name']);*/	
				$("#color_"+sno).val(json[0]['product_colour_name']);
				$("#thick_"+sno).val(json[0]['product_con_entry_child_product_detail_thick_ness']);
				$("#width_"+sno).val(json[0]['product_con_entry_child_product_detail_width_inches']);
				$("#length_"+sno).val(json[0]['length']);
				<!--$("#rate_"+sno).val(json[0]['product_cost_price']);-->
			}else{
					alert("Product length is not available");
			}
			
	});	
																							
 }
 function getemployee(val,obj){	
	 if(val!=''){
		$.getJSON("../ajax-file/hr-process-ajaxfile.php?action=employees&val="+val, function( json ) {
			if(json.length>0){																						
				var employeeName = [];		
				for(var i=0;i<json.length;i++){			
					employeeName[i] = json[i]['employee_id']+' - '+json[i]['employee_name'];
				}	
				$(obj).autocomplete({
					maxResults: 10,
					source: employeeName,
					select: function(event,ui) { 
						var textval = ui.item.value;
						var item = textval.split(' - ');
					}
				});		
			}else{
			}
		});
	 }else{
		 alert('Please Entry Value');			 
	 }
	 
 }
 
