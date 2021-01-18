checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('sw_list_form').elements.length; i++) {
	  document.getElementById('sw_list_form').elements[i].checked = checked;
	}
} 

function calcInchesMM(type){
	if(type == "inches") {
		if(document.getElementById('inches_txt').value != "") {
			mm = parseFloat(document.getElementById('inches_txt').value) * 25.4;
			document.getElementById('mm_txt').value = parseFloat(mm).toFixed(2);
		}
	}
	else if(type == "mm") {
		if(document.getElementById('mm_txt').value != "") {
			inches = parseFloat(document.getElementById('mm_txt').value) / 25.4;
			document.getElementById('inches_txt').value = parseFloat(inches).toFixed(2);
		}
	}
	else {}
}