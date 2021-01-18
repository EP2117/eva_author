

  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('employee-form').elements.length; i++) {
	  document.getElementById('employee-form').elements[i].checked = checked;
	}
}

function calulateSalary(val,obj){
	moneyFrmtFn(obj);
	var pasic_pay = $("#basic_pay").val().replace(/,/g, '');
	pasic_pay =Number(pasic_pay);
	var day_Salary = pasic_pay/30;
	var hr_Salary  = day_Salary/9;
	$("#deduction_day").val(forNum(day_Salary)).attr("readonly",true);
	$("#deduction_hrs").val(forNum(hr_Salary)).attr("readonly",true);
}

function setTwoNumberDecimal(val,obj,sn,format) {
	var str = parseFloat(val).toFixed(2)
	if(Number(str)<=100){
		if(isNaN(str)){
			$(obj).val('');
		}else{
			$(obj).val(str);
		}
	}else if(Number(str)>100){
		alert('Please enter value  below 100%');
		$(obj).val('');
	}	
}

function calculate_leavedays(val,obj){
	var total_leave = Number($("#leave_permit").val());
	var total =0;
	$('.leave_day').each(function (){
		if($(this).val()!=''){
			total = Number(total)+Number($(this).val());
		}
	});
	if(total_leave<total){
		alert("please enter minimum "+total_leave+ "days")
		$(obj).val("");
	}
}

function status_enabledisable(val){
	var status_val = Number($("#status").val());
	if(status_val==2){
		$(".checkSts").attr("readonly",false);
		$("#bonus_1,#allowance_1").prop("checked", true);
	}else{
		$(".checkSts").attr("readonly",true);
		$("#bonus_2,#allowance_2").prop("checked", true);
	}
}