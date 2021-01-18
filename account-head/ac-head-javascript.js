
function gettype(){
	var type_one_id = document.getElementById('account_head_type1').value;
	
	$.get('get-type.php',{type_one_id:type_one_id},function(data) {
		$('#account_head_type2').html(data);
	});
	
}


function checkedAll(obj){
	var check =$(obj).prop('checked');
	
	if(check==true)
		$('.check').prop('checked',true);
	else
		$('.check').prop('checked',false);
	
}
 
 function DisplayType3(){
 	var type_one_id = document.getElementById('account_head_type2').value;
	$("#d_manuf_inex").hide();
	if(type_one_id=="mf"){
		$("#d_manuf_inex").show();
	}
 }