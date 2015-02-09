<?php /* Smarty version 2.6.9, created on 2008-01-28 07:31:45
         compiled from changepwd.tpl */ ?>
<?php echo '
<script type="text/javascript" language="javascript">
function ValidateUpdateProfile() {
	if ($("RConfirmPassword").value == "" ) {
		alert("Confirm password should not be empty.");
		$("RConfirmPassword").focus();
		return false;
	}

	if ($("txt_password").value != $("RConfirmPassword").value ) {
		alert("Password and confirm password should be same.");
		$("RConfirmPassword").value = "";
		$("RConfirmPassword").focus();
		return false;
	} else {
		document.frmUpdateProfile.action = \'index.php\';
		document.frmUpdateProfile.submit();
		return true;
	}
}
</script>
'; ?>

<table width="99%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td height="14"></td>
	</tr>
	<?php if ($this->_tpl_vars['strCPMsg']): ?>
	<tr>
	  <td class="ErrorMsg" align="center"><?php echo $this->_tpl_vars['strCPMsg']; ?>
</td>
	</tr>
	<tr>
	  <td height="14"></td>
	</tr>
	<?php endif; ?>
	<tr>
	  <td>
	  	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#878787">
		 	<tr>
				<td bgcolor="#878787">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FAFAFA">
						<tr>
							<td>
								<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td colspan="2">
											<form name="frmUpdateProfile" action="" method="post" enctype="multipart/form-data" onsubmit="return ValidateUpdateProfile();"  >
											<input type="hidden" name="op" id="op" value="UpdatePassword">
											<input type="hidden" name="txt_LoggedIn" id="txt_LoggedIn" value="1">
											<input type="hidden" name="hdUserid" id="hdUserid" value="<?php echo $this->_tpl_vars['UserList'][0]['id']; ?>
" />											
											<table width="96%" border="0" cellspacing="5" cellpadding="1">
												<tr>
													<td align="left"  class="FormHeading">Change Password</td>
													<td align="right"><span class="orangeFont">* Mandatory Fields</span></td>
												</tr> 
												<tr>
													<td colspan="2" align="center"><div class="ErrorMsg" id="CPErrorMsg"></div></td>
												</tr> 
											
												<tr>
													<td  width="31%" valign="top" class="RequiredField"><label for="txtRUserName">Username<span class="orangeFont">*</span></label></td>
													<td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff" name="txt_username" type="text"    class="textbox1" value="<?php echo $this->_tpl_vars['UserList'][0]['username']; ?>
"  size="39"  id="txt_username">			
													<br /><span class="HelpText">(Username is your Login Id eg. johndoe@top10media.com)</span></td>
												</tr>
												
												<tr>
													<td width="31%" valign="top" class="RequiredField"><label for="txtRPassword">Password<span class="orangeFont">*</span></label></td>
													<td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff"  size="39" name="txt_password" class="textbox1" value="<?php echo $this->_tpl_vars['UserList'][0]['password']; ?>
"  type="password"  id="txt_password"/>
													<br /><span class="HelpText">(Your password must contain minimum 5 characters.)</span>		</td>		
												</tr>
											
												<tr>
													<td width="31%" valign="top" class="RequiredField"><label for="txtConfirmPassword">Confirm Password<span class="orangeFont">*</span></label></td>
													<td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff"  size="39" name="RConfirmPassword" class="textbox1" type="password" value="<?php echo $this->_tpl_vars['RConfirmPassword']; ?>
" id="RConfirmPassword"  />
													<br /><span class="HelpText">(Re-type the password as above.)</span></td>
												</tr>
												<tr id="GetStarted" style="visibility:visible;position:relative;">
													<td width="31%">&nbsp;</td>
													<td class="ListCell" align="left"><input type="image" src="images/submit.gif" class="ratesubm" >	
													</td>
												</tr>
											</table>
											</form>
										</td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
	</tr>
</table>