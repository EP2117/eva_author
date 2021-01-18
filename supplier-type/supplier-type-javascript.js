
  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('supplier_type_form').elements.length; i++) {
	  document.getElementById('supplier_type_form').elements[i].checked = checked;
	}
} 


