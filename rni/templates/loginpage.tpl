<script src="javascript/main.js" language="javascript" type="text/javascript"></script>
{literal}
<script type="text/javascript" language="javascript">
function ValidateLogin1() {
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
		document.frmlogin.action = "index.php";
		document.frmlogin.submit();
	}
}
</script>
{/literal}

<form name="frmlogin" method="post">
<input type="hidden" name="op" id="op" value="login" />
<table width="45%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td class="loginleft">&nbsp;</td>
  <td align="center" valign="top" class="loginmid" style="padding-top:8px;">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td class="hdrtext"><img src="images/loginicon.gif" /></td>
		  <td align="right" class="redhdrtext"><span style="cursor:pointer;" onclick="document.frmlogin.op.value='register'; document.frmlogin.submit();">New User Register Here</span></td>
		</tr>
		<tr height="7px"><td colspan="2"></td></tr>
		<tr>
			<td class="redline" colspan="2" ></td>
		</tr>
		<tr height="7px"><td colspan="2"></td></tr>
		<tr>
			<td colspan="2" align="left" class="hdrtext">Already a member ! Sign In</td>
		</tr>
		<tr height="7px"><td colspan="2"></td></tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="31%" class="logintxt" align="right" >Login</td>
					<td width="55%" align="left" style="padding-left:8px;">
					  <input class="Loginbox" type="text" name="txtusername" id="txtusername" value="" />
					 </td>
					 <td width="14%"></td>
				  </tr>
				  <tr height="5px"><td></td></tr>
				  <tr>
					<td class="logintxt" align="right">Password</td>
					<td align="left" style="padding-left:8px;">
					  <input class="Loginbox" type="password" name="txtpassword" id="txtpassword" value="" />
					</td>
					<td><input type="image" src="images/loginbtn.jpg" onClick="return ValidateLogin1()" /></td>
				  </tr>
				  <tr>
					<td></td>
					<td class="forgotpwdtxt" nowrap="nowrap" style="cursor:pointer;" align="left" onclick="document.frmlogin.op.value='forgetpwd'; document.frmlogin.submit();">Forgot Password</td>
					<td class="logintxt"></td>
				  </tr>
				</table>
			</td>
		</tr>
	  </table>
  </td>
  <td class="loginright">&nbsp;</td>
</tr>
<tr>
  <td rowspan="2" class="">&nbsp;</td>
  <td align="center" valign="top">&nbsp;</td>
  <td rowspan="2" class="">&nbsp;</td>
</tr>
	</table>			 
</form> 
