<?php /* Smarty version 2.6.9, created on 2008-01-25 13:10:25
         compiled from forgetpwd.tpl */ ?>
<?php echo '
<script>
function ForgotPassword()	{
	if ($("txt_username").value == "") {
		$("ForgotPwdErrorMsg").innerHTML = "Username should not be empty"; 
		$("txt_username").focus();
		return false;
	}

	if(!isEmail($("txt_username").value)) {
		$("txt_username").focus();
		return false;		
	} 	else {
		$("ForgotPwdErrorMsg").innerHTML = "";
		$("ForgotPwdErrorMsg_01").innerHTML = "<img src=\'images/smallloading01.gif\'>";		
		emailid = $("txt_username").value;
		var success = function(t){ ForgotPasswordComplete(t);}
		var failure = function(t){ editFailed(t);}
		var url     =  \'ajax/documentsystem.php\';
		var pars    = \'op=forgetpwd&emailid=\'+emailid+\'&hdAction=forgot\';
		var myAjax  = new Ajax.Request(url, {method:\'post\', postBody:pars, onSuccess:success, onFailure:failure});	

	}
}

function ForgotPasswordComplete(t)	{
	//alert(t.responseText);
	$("ForgotPwdErrorMsg_01").innerHTML = t.responseText;
}
</script>
'; ?>

<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	  <td height="14"></td>
	</tr>
	<?php if ($this->_tpl_vars['strMsg']): ?>
	<tr>
	  <td class="ErrorMsg" align="center"><?php echo $this->_tpl_vars['strMsg']; ?>
</td>
	</tr>
	<tr>
	  <td height="14"></td>
	</tr>
	<?php endif; ?>
	<tr>
	  <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#878787">
		  <tr>
			<td bgcolor="#878787"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FAFAFA">
				<tr>
				  <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
						<td colspan="2">
						<table width="96%" border="0"    cellspacing="4" cellpadding="1">
<tr>
						<td align="left"  class="FormHeading">Forgot Password</td>
					    <td align="right"><span class="orangeFont">* Mandatory Fields</span></td>
					</tr> 
			<tr>
						<td colspan="2" >&nbsp;</td>
			</tr>	
			  <tr>
				<td  colspan="2" align="center"><span class="ErrorMsg" id="ForgotPwdErrorMsg_01"><?php echo $this->_tpl_vars['strMsg']; ?>
</span></td>
			  </tr>
								
			<tr>
				<td  width="31%" valign="top" class="RequiredField"><label for="txtRUserName">Username<span class="orangeFont">*</span></label></td>
				<td width="56%" class="ListCell" align="left">
				<input style="background-color:#ffffff" name="txt_username" type="text"    class="textbox1" value="<?php echo $this->_tpl_vars['txt_username']; ?>
"  size="39"  id="txt_username">
				<br /><span class="ErrorMsg" id="ForgotPwdErrorMsg">Enter your username</span>
				</td>			
			</tr>
				<tr id="GetStarted" style="visibility:visible;position:relative;">
					<td width="31%">&nbsp;</td>
					<td class="ListCell" align="left">
					<input type="image" src="images/submit.gif" class="ratesubm" onclick="return ForgotPassword();" >
					</td>
				</tr>			
					</table>
						</td>
					  </tr>
					  <tr>
						<td colspan="2">&nbsp;</td>
					  </tr>
				  </table></td>
				</tr>
			</table></td>
		  </tr>
	  </table></td>
	</tr>
</table>