checked = false;

  function checkedAll () {

	if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('pur_costing_form').elements.length; i++) {

	  document.getElementById('pur_costing_form').elements[i].checked = checked;

	}

  }