
  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('overtime-form').elements.length; i++) {
	  document.getElementById('overtime-form').elements[i].checked = checked;
	}
}  
function getEmployeesName(val,obj,typ){	
	var branch = $('#branchid').val();
	if(branch !=''){
		$.getJSON("empdetails_ajaxfile.php?action=employeeList&val="+val+"&branch="+branch, function( json ) {
			if(json.length>0){																						
				var applicantName = [];		
				for(var i=0;i<json.length;i++){			
					applicantName[i] = json[i]['employee_id']+' - '+json[i]['employee_name'];
				}		
				$(obj).autocomplete({
					maxResults: 10,
					source: applicantName,
					select: function(event,ui) { 
						var textval = ui.item.value;
						var item = textval.split(' - ');
						if(typ!=2){
							$("#ot_empid").val(item[0]);
							//getHrAmount(item[0]);
						}
					}
				});		
			}else{
				
				//$(obj).val('');
				//$("#ot_empid").val("");
			}
		});	
	}else{
		$(obj).val('');$("#ot_empid").val("");
		alert("please select branch");
	}
 }
 function getHrAmount(id){
	 $.getJSON("empdetails_ajaxfile.php?action=overtimeAmnt&emp_id="+id, function( json ) {
	 	$("#ot_amount").val(json['employee_overtime_hrs']);
	 });																								  
 }
 
function get_amt(id){//alert(id);
	var emp_id=$('#ot_empid').val();
	
	$.get('emp_list.php',{emp_id:emp_id,id:id},function(data){//alert(data);
				$('#ot_rate').val(data);	  
					  
					  });	
	
	
}
 
 function get_tot_amt(){//alert();
	 var hr=$('#ot_durationtime').val();
	 var nor_amt=$('#ot_rate').val();
	 
	 total = parseFloat(nor_amt) * parseFloat(hr);
	 $('#ot_amount').val(total.toFixed(2));
	 
	 
 }
 
 function countTimer(){
	 var start_time = $("#ot_starttime").val();
	 var end_time = $("#ot_endtime").val();
	 var diff = ( new Date("1970-1-1 " + end_time) - new Date("1970-1-1 " + start_time) ) / 1000 / 60 / 60;  
	 $("#ot_durationtime").val(diff);
 }
 
 
 
 
 