function saveLogin_submit(){
		if(!IsValid(document.userloginfrm.txtusername.value,"Username"))
		{
		document.userloginfrm.txtusername.focus();
		return false;
		}
		
		if(!IsValid(document.userloginfrm.txtpassword.value,"Password"))
		{
		document.userloginfrm.txtpassword.focus();
		return false;
		}
return true;
}

function Validate(){
/*  	if(document.frmRegister.txt_FirstName.value == "") {
		alert("First Name should not be empty");
		document.frmRegister.txt_FirstName.focus();
		return false;
	}

  	if(document.frmRegister.txt_Address.value == "") {
		alert("Address should not be empty");
		document.frmRegister.txt_Address.focus();
		return false;
	}
  	if(document.frmRegister.txt_UserName.value == "") {
		alert("User Name should not be empty");
		document.frmRegister.txt_UserName.focus();
		return false;
	}

	if(!isEmail(document.frmRegister.txt_UserName.value)) {
		document.frmRegister.txt_UserName.focus();
		return false;		
	}
	

  	if(document.frmRegister.txt_Password.value == "") {
		alert("Password should not be empty");
		document.frmRegister.txt_Password.focus();
		return false;
	}
	
	if(document.frmRegister.txt_Password.value.length<5) {
		alert("your password must contain minimum 5 characters!");
		document.frmRegister.txt_Password.focus();
		return false;
	}	

	if(document.frmRegister.RConfirmPassword.value != document.frmRegister.txt_Password.value) {
		alert("Password and Confirm password are not same");
		document.frmRegister.txt_Password.value="";
		document.frmRegister.RConfirmPassword.value="";
		document.frmRegister.txt_Password.focus();
		return false;
	}
*/
	if(!isEmail(document.frmRegister.txt_Email.value)) {
		document.frmRegister.txt_Email.focus();
		return false;		
	}
	
		
/*	if(document.getElementById("RVerification")){
		if(!IsValid(document.frmRegister.RVerification.value,"Verification Code")){
			document.frmRegister.RVerification.focus();
			return false;
		}else{	
			return true;
		}
	}*/
}


function ValidateLogin(){
	
	if ($("txtusername").value == "") {
		$("LoginErrorMsg").innerHTML = "User Name should not be empty"; 
		$("txtusername").focus();
		return false;
	}

  	if($("txtpassword").value == "") {
		$("LoginErrorMsg").innerHTML = "Password should not be empty"; 
		$("txtpassword").focus();
		return false;
	}
	else {
		$("LoginErrorMsg").innerHTML = "<img src='images/smallloading01.gif'>";
		username = $("txtusername").value;
		password = $("txtpassword").value;	
		var success = function(t){ LoginSuccessComplete(t);}
		var failure = function(t){ editFailed(t);}
		var url     =  'ajax/documentsystem.php';
		var pars    = 'op=login&Username='+username+'&password='+password;						
		var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	

	}
}

function LoginSuccessComplete(t)	{
	//window.location.href = 'index.php?op=validuser';
	$("LoginErrorMsg").innerHTML = t.responseText;
}

function editFailed(t)	{
		alert(t.responseText);	
}

function forgetpwd()
	{
		
		if(!IsValid(document.frmforget.txtusername.value,"User Name"))
		{
		document.frmforget.txtusername.focus();
		return false;
		}
		if(document.frmforget.txtusername.value == "")
		{
		 
		document.frmforget.submit();
	    }
return true;
	}

