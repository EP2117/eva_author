// JavaScript Document
function validation(){
	
//--------------------------------------Not Null Validation-------------------------------------------------
	this.notNull = function(sts, id, res){
		var str=sts.replace(/^\s*|\s*$/g,"");
		if(str=="") {jAlert(res); $(id).focus(); $(id).focus(); return false;}else {return true;}
	}
//--------------------------------------Email Validation-------------------------------------------------
	/*this.email = function(sts, id, res){
		var str=sts.replace(/^\s*|\s*$/g,"");
		//var Email_Regex = /^[a-z0-9._-]+@[a-z]+.[a-z.]{2,5}$/i;//Example:example@gmail.com
		var Email_Regex =  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
		if(!Email_Regex.test(str)) {jAlert(res); $(id).focus();  return false;}else {return true;}
	}*/
	
	this.email = function(sts, id, res){
		var str=sts.replace(/^\s*|\s*$/g,"");
		//var Email_Regex = /^[a-z0-9._-]+@[a-z]+.[a-z.]{2,5}$/i;//Example:example@gmail.com
		//var Email_Regex =  /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
		var Email_Regex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(!Email_Regex.test(str)) {jAlert(res); $(id).focus();  return false;}else {return true;}
	}
//---------------------------------------Url validation--------------------------------------------------
	this.url = function(str){
		var url=str.replace(/^\s*|\s*$/g,"");
		var url_Regex=/^[http://]+[www]?.[0-9a-z_.]+.[a-z.]{2,5}$/i; //Example:http:www.example.com
		if(!url_Regex.test(url)) {return "<span style='color:#FF0000; font-size:12px;'>Please Enter Valid url</span>";}else {return "";}
	}
//---------------------------------------Pincode validation----------------------------------------------	
	this.pincode = function(str){
		var pin = str.replace(/^\s*|\s*$/g,"");
		var pincode_Regex=/^[0-9]{6}$/i; //Example: 600001
		if(!pincode_Regex.test(pin)) {return "<span style='color:#FF0000; font-size:12px;'>Please Enter Valid Pin Code</span>";}else {return "";}
	}
//---------------------------------------Name Validation-------------------------------------------------	
	this.name = function(str){
		var name = str.replace(/^\s*|\s*$/g,"");
		var name_Regex=/^[a-zA-Z() ]+$/; //Example: Rahul Dravid
		if(!name_Regex.test(name)) {return "<span style='color:#FF0000; font-size:12px;'>Please enter correct value</span>";}else {return "";}
	}
//---------------------------------------Landline Validation---------------------------------------------	
	this.landline = function(str, id, res){
		var landline = str.replace(/^\s*|\s*$/g,"");
		var landline_regex = /^[0-9]{0,5}[-][0-9]{0,15}$/; //Example:044-89562354
		if(!landline_regex.test(landline)) {jAlert(res); $(id).focus();  return false;}else {return true;}
	}
//---------------------------------------Mobile Number Validation----------------------------------------
	this.mobile = function(str, id, res){
		var mobile = str.replace(/^\s*|\s*$/g,"");
		var mobile_regex = /^(\+91?)([0-9]{11})$/i; //Example:+919688236895
		//var mobile_regex = /^\d{10}$/;
		//var mobile_regex = /^([+0-9]{1,3})?([0-9]{10,11})$/i; //Example:+919688236895
		if(!mobile_regex.test(mobile)) {jAlert(res); $(id).focus();  return false;}else {return true;}	
	}
	this.mobiledigit = function(str, id, res){
		var mobiledigit = str.replace(/^\s*|\s*$/g,"");
		//var mobile_regex = /^(\+91?)([0-9]{11})$/i; //Example:+919688236895
		var mobile_regex = /^\d{10}$/;
		//var mobile_regex = /^([+0-9]{1,3})?([0-9]{10,11})$/i; //Example:+919688236895
		if(!mobile_regex.test(mobiledigit)) {jAlert(res); $(id).focus();  return false;}else {return true;}	
	}
//---------------------------------------User Name Min 8 Chars and alpha numeric characters--------------	
	this.username = function(str){
		var username = str.replace(/^\s*|\s*$/g,"");
		var UserName_regex = /^[a-z0-9]{8,}/i; 
		if(!UserName_regex.test(username)) {return "<span style='color:#FF0000; font-size:12px;'>Please enter correct value</span>";}else {return "";}	
	}
//---------------------------------------Date Validation--------------------------------------------------		
	this.date = function(str){
		var date = str.replace(/^\s*|\s*$/g,"");
		var date_regex = /^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/i; //Example: 04-12-2014
		if(!date_regex.test(date)) {return "<span style='color:#FF0000; font-size:12px;'>Please enter correct value</span>";}else {return "";}	
	}
//---------------------------------IP address Validation--------------------------------------------
	this.IPaddress = function(str){
		var ip = str.replace(/^\s*|\s*$/g,"");
		var ip_regex = /^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i;//Example:192.198.1.23
		if(!ip_regex.test(ip)) {return "<span style='color:#FF0000; font-size:12px;'>Please enter correct IP address</span>";}else {return "";}	
	}
//---------------------------------Empty string Validation--------------------------------------------
	this.empty = function(sts){
		var str = sts.replace(/^\s*|\s*$/g,"");
		var empty_regex = /^\s*\S+.*/;//Empty Value
		if(!empty_regex.test(str)) {return "<span style='color:#FF0000; font-size:12px;'>Please enter correct value</span>";}else {return "";}	
	}
//---------------------------------Password Validation--------------------------------------------
	this.password = function(str){
		var pass = str.replace(/^\s*|\s*$/g,"");
		var password_regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;//should contain at least one digit, one lower case, one upper case, 8 from the mentioned characters.
		if(!password_regex.test(pass)) {return "<span style='color:#FF0000; font-size:12px;'>Please enter correct value</span>";}else {return "";}	
	}
//---------------------------------Image Validation--------------------------------------------
	this.image = function(img, id, res){
		var ext=img.split('.').slice(-1);
		if(ext != 'jpg' && ext != 'jpeg' && ext!='png' && ext!='gif') {jAlert(res); $(id).focus();  return false;}else{return true;}
	}
//---------------------------------Landline Number Validation--------------------------------------------
	this.landline_numeric = function(myfield, e, dec){
		var key;
		var keychar;
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		if(myfield.value.length<=100)
		{
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) || (key==45))
		   return true;
		 
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
		}
		else
		{
			if(key==8)
			{
				return true;
			}
			return false;
		}
	   
	}
//---------------------------------Mobile Number Validation--------------------------------------------
	this.mobile_numeric = function(myfield, e, dec){
		var key;
		var keychar;
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		if(myfield.value.length<=100)
		{
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) || (key==43))
		   return true;
		 
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
		}
		else
		{
			if(key==8)
			{
				return true;
			}
			return false;
		}
	   
	}
//---------------------------------Phone Number Validation--------------------------------------------
	this.phone_numeric = function(myfield, e, dec){
		var key;
		var keychar;
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		if(myfield.value.length<=100)
		{
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) || (key==43) || (key==45))
		   return true;
		 
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
		}
		else
		{
			if(key==8)
			{
				return true;
			}
			return false;
		}
	   
	}
//---------------------------------Phone Number With comma Validation--------------------------------------------
	this.phone_multiple = function(myfield, e, dec){
		var key;
		var keychar;
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		if(myfield.value.length<=100)
		{
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) || (key==43) || (key==45) || (key==44))
		   return true;
		 
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
		}
		else
		{
			if(key==8)
			{
				return true;
			}
			return false;
		}
	   
	}
//---------------------------------Float and Numeric only Allowed-----------------------------------------
	this.NumericDot_only = function(myfield, e, dec){
		
		var key;
		var keychar;
		
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) )
		   return true;
		 
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		else if (((".").indexOf(keychar) > -1)){
		   if (myfield.value.indexOf(".") >-1){
			   return false;
		   }else 
		   return true;
		   }
		 
		else
		   return false;
   }
//-----------------------------------Numberic Number only Allowed-----------------------------------------			
	this.Numeric_only = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) )
		   return true;
		 
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
	}
//-----------------------------------Numberic Number and ' '' only Allowed--------------------------------			
	this.feet_only = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==34) || (key==39) )
		   return true;
		 
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
	}
//-------------------------------------Reset All HTML Elements--------------------------------------------
	this.clear_form_elements = function(ele){
		$(ele).find(':input').each(function() {
			switch(this.type) {
				case 'password':
				case 'select-multiple':
				case 'select-one':
				case 'text':
				case 'textarea':
					$(this).val('');
					break;
				case 'checkbox':
				case 'radio':
					this.checked = false;
			}
		});
	}
//-------------------------------------------------Only Text----------------------------------------------
	this.Alpha_only = function(myfield, e, dec){
		var key;
		var keychar;
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) ||(key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  else
		   return false;
	}
//-------------------------------------------------Only Text & & only-------------------------------------
	this.AlphaAnd_only = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) || (key==38) ||(key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  else
		   return false;
	}
//-------------------------------------------------Only Text and Numeric----------------------------------
	this.Alpha_Numeric = function(myfield, e, dec){		
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) ||(key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  // numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
	}
//-------------------------------------------------Only Text, Numeric, @, and dot only--------------------
	this.email_allow = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) || (key==64) || (key==46) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  // numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
	}
//--------------------------------------------Address (Text, Number, Ifan, hash, comma and put stop only--
	this.Address = function(myfield, e, dec){
		var key;
		var keychar;
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) || (key==35) || (key==46) || (key==44) || (key==45) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  // numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
		   
	}
//-------------------------------------------------Only Text & & only-------------------------------------
	this.AlphaDot = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) || (key==46) ||(key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  else
		   return false;
	}
//-------------------------------------------------Only Numeric and single course and double course-------
	this.inch_number = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) || (key==32) || (key==34) || (key==39))
		   return true;
		  // numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
	}
//-----------------------------------Numberic Number only Allowed-----------------------------------------			
	this.null_add = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || 
			(key==9) || (key==13) || (key==27) )
		   return true;
		 
		// numbers
		/*else if ((("0123456789").indexOf(keychar) > -1))
		   return true;*/
		 else
		   return false;
	}
//-------------------------------------------------Only Text and Numeric----------------------------------
	this.Alpha_Numeric_income = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || (key==45) || (key==46) || 
			(key==9) || (key==13) || (key==27) || (key==32) ||(key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  // numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
	}
//-------------------------------------------------Only Text and ifon only--------------------------------
	this.AlphaIfan_only = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) || (key==45) || 
			(key==9) || (key==13) || (key==27) || (key==32) ||(key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  else
		   return false;
	}
//-------------------------------------------------Only Text and ifon only--------------------------------
	this.Alphadot_only = function(myfield, e, dec){
		var key;
		var keychar;
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) ||  (key==46) || 
			(key==9) || (key==13) || (key==27) || (key==32) ||(key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  // numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
	}
//-------------------------------------------------Only Text and ifon only--------------------------------
	this.Alphadotcomma_only = function(myfield, e, dec){
		var key;
		var keychar;
		 
		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		 
		// control keys
		if ((key==null) || (key==0) || (key==8) ||  (key==46) || (key==44) || (key==45) || 
			(key==9) || (key==13) || (key==27) || (key==32) ||(key >= 65 && key <= 90) || (key >= 97 && key <= 122))
		   return true;
		  // numbers
		else if ((("0123456789").indexOf(keychar) > -1))
		   return true;
		 else
		   return false;
	   }
//-------------------------------------------------Disable Enter--------------------------------	

	this.disable_enter = function(e) {
		
		var code = e.keyCode || e.which; 
		if (code  == 13) {               
			e.preventDefault();
			return false;
		}
	}

}
 o_obj= new validation();

 function forNum(num){
		var x=parseFloat(num).toFixed(2);
		//num=num.toFixed(2);
		//var x=num;
		x=x.toString();
		var afterPoint = '';
		if(x.indexOf('.') > 0)
		   afterPoint = x.substring(x.indexOf('.'),x.length);
		x = Math.floor(x);
		x=x.toString();
		var lastThree = x.substring(x.length-3);
		var otherNumbers = x.substring(0,x.length-3);
		if(otherNumbers != '')
			lastThree = ',' + lastThree;
		 res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
	return res;
	}

 function moneyFrmtFn(e){
	var num=e.value.replace(/,/g, "");
	if(num==""){
		e.value="0.00"
	}else{
		var x=parseFloat(num.replace(/,/g , "")).toFixed(2);
		//num=num.toFixed(2);
		//var x=num;
		x=x.toString();
		var afterPoint = '';
		if(x.indexOf('.') > 0)
		   afterPoint = x.substring(x.indexOf('.'),x.length);
		x = Math.floor(x);
		x=x.toString();
		var lastThree = x.substring(x.length-3);
		var otherNumbers = x.substring(0,x.length-3);
		if(otherNumbers != '')
			lastThree = ',' + lastThree;
		 res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
		e.value=(res);
		
	}
}

