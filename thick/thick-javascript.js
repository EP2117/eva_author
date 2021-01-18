checked = false;

  function checkedAll () {

	if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('country_form').elements.length; i++) {

	  document.getElementById('country_form').elements[i].checked = checked;

	}

  }