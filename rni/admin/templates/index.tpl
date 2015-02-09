{literal}
<script language="javascript" src="../javascript/validation.js"></script>
<script>
function validation(myform)
{
	if(!IsValid(myform.username.value,"User Name"))
	{
	
		myform.username.focus();
		return false;
	}
	
	if(!IsValid(myform.password.value,"Password"))
	{
	
		myform.password.focus();
		return false;
	}
	
	return true;
}
</script>
{/literal}
<html>
<title>Admin Control Panel</title>

<link href="{$SiteGlobalPath}siteadmin/css/Main.css" rel="stylesheet" type="text/css">
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" onLoad="document.form.username.focus()">
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr>
			<td align="center" valign="middle" bgcolor="#4476B7">
				<table width="777" height="537" border="0" cellpadding="0" cellspacing="0" class="fullbdr">
					<tr valign="top"> 
						<td height="192" colspan="3" background="images/index_01.gif" class="loginheadertxt" style="padding-top:20px;padding-left:20px;"></td>
					</tr>
					<tr> 
						<td width="351" height="222" rowspan="2" valign="top"><IMG SRC="images/index_02.gif" WIDTH=351 HEIGHT=222 ALT=""></td>
						<td colspan="2" valign="top"><IMG SRC="images/index_03.gif" WIDTH=426 HEIGHT=46 ALT=""></td>
					</tr>
					<tr> 
						<td width="338" height="176" valign="top" background="images/index_04.gif">
							<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
								<tr> 
									<td height="50" align="center" class="loginheadtxt">ADMIN LOGIN</td>
								</tr>
								<tr> 
									<td height="20" align="center" class="ErrorMsg">{$ErrMsg}</td>
								</tr>
								<tr> 
									<td align="center" valign="top">
									<form name="form" method="post" action="index.php" onSubmit="return validation (this)">
										<table width="90%" border="0" cellspacing="0" cellpadding="0">
											<tr> 
												<td width="25%" align="right" valign="middle" class="blacktxtbold" style="padding-right: 10px;">User Name:</td>
												<td width="57%" colspan="2"> <input class="txtfield" type="text"  id="username" name="username" value="" /></td>
											</tr>
											<tr> 
												<td align="right" valign="middle" class="blacktxtbold" style="padding-right: 10px;">Password:</td>
												<td colspan="2"><input class="txtfield" type="password"  name="password" value="" /></td>
											</tr>
											<tr> 
												<td width="25%">&nbsp;</td>
												<td width="48%" height="25" align="right"><input type="submit" value="Login" class="btn" name="login"></td>
												<td width="5%">&nbsp;</td>
											</tr>
										</table>
									</form>
									</td>
								</tr>
								<tr> 
									<td>&nbsp;</td>
								</tr>
							</table>
							</td>
							<td width="88" align="right"><IMG SRC="images/index_05.gif" WIDTH=88 HEIGHT=176 ALT=""></td>
						</tr>
						<tr valign="top"> 
							<td height="123" colspan="3" background="images/index_06.gif">&nbsp;</td>
						</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
