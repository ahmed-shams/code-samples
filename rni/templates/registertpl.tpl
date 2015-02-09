<script src="javascript/main.js" language="javascript" type="text/javascript"></script>
<form name="frmRegister" action="index.php?op=register" method="post" enctype="multipart/form-data" onsubmit="return Validate()" >
<input type="hidden" name="hdAction" value="register">
<!--input type="hidden" name="txtStatus" id="txtStatus"-->
<table width="99%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td height="14"></td>
	</tr>
	{if $strMsg}
	<tr>
	  <td class="ErrorMsg" align="center">{$strMsg}</td>
	</tr>
	<tr>
	  <td height="14"></td>
	</tr>
	{/if}
	<tr>
	  <td style="padding-left:20px;">
	  	<table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="#878787">
		 	<tr>
				<td bgcolor="#878787">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FAFAFA">
						<tr>
							<td>
								<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td colspan="2">
											<table width="96%" border="0" cellspacing="5" cellpadding="1">
												<tr>
													<td align="left"  class="FormHeading">Registration Form</td>
													<td align="right"><span class="orangeFont">* Mandatory Fields</span></td>
												</tr> 
												<tr>
													<td colspan="2" align="center"><div class="ErrorMsg" id="ErrorMsg"></div></td>
												</tr> 
												<tr>
												  <td  width="31%" valign="top" class="RequiredField"><label for="txtRUserName">First Name<span class="orangeFont">*</span></label></td>
												  <td width="56%" class="ListCell" align="left">
												  <input style="background-color:#ffffff" name="txt_FirstName" type="text"    class="textbox1" value="{$txt_FirstName}"  size="39"  id="txt_FirstName">
												  <br /><span id="ErrFirstName"></span></td>
												</tr>
												<tr>
												  <td  width="31%" valign="top" class="RequiredField"><label for="txtRUserName">Last Name<span class="orangeFont">*</span></label></td>
												  <td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff" name="txt_LastName" type="text"    class="textbox1" value="{$txt_LastName}"  size="39"  id="txt_LastName"></td>
												</tr>
												<tr>
												  <td width="31%" valign="top" class="RequiredField"><label for="txtRUserName">Address<span class="orangeFont">*</span></label></td>
												  <td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff" name="txt_Address" type="text"    class="textbox1" value="{$txt_Address}"  size="39"  id="txt_Address"></td>
												</tr>
												
												<tr>
													<td  width="31%" valign="top" class="RequiredField"><label for="txtRUserName">Username<span class="orangeFont">*</span></label></td>
													<td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff" name="txt_UserName" type="text"    class="textbox1" value="{$txt_UserName}"  size="39"  id="txt_UserName">			
													<br /><span class="HelpText">(Username is your Login Id eg. johndoe@top10media.com)</span></td>
												</tr>
												
												<tr>
													<td width="31%" valign="top" class="RequiredField"><label for="txtRPassword">Password<span class="orangeFont">*</span></label></td>
													<td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff"  size="39" name="txt_Password" class="textbox1" value="{$txt_Password}"  type="password"  id="txt_Password"/>
													<br /><span class="HelpText">(Your password must contain minimum 5 characters.)</span>		</td>		
												</tr>
											
												<tr>
													<td width="31%" valign="top" class="RequiredField"><label for="txtConfirmPassword">Confirm Password<span class="orangeFont">*</span></label></td>
													<td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff"  size="39" name="RConfirmPassword" class="textbox1" type="password" id="RConfirmPassword"  />
													<br /><span class="HelpText">(Re-type the password as above.)</span></td>
												</tr>
									
												<tr>
												  <td width="31%" valign="top" class="RequiredField"><label for="txtEmail">Email Address<span class="orangeFont">*</span></label></td>
												  <td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff" name="txt_Email" size="39" class="textbox1" value="{$txt_Email}"  type="text" id="txt_Email" />
													<br />
													<span class="HelpText"> (Enter a valid Email address.) </span> </td>
												</tr>
												<tr>
													<td class="RequiredField" valign="top">City</td>
													<td class="ListCell" align="left">
														<input style="background-color:#ffffff" name="txt_City" type="text" class="textbox1" value="{$txt_City}" size="39"  id="txt_City">			
													</td>
												</tr>
												<tr>
												  <td class="RequiredField" valign="top">State</td>
												  <td class="ListCell" align="left">
												  <select name="txt_State" id="txt_State" class="txtbox">
													  <option value="0">Select</option>
													  {html_options values=$StateCode output=$StateName selected=$txt_State}	
													</select>
												  </td>
												</tr>
									
												<tr>
													<td width="31%" class="RequiredField" valign="top"><label for="txtVerification">Verification Code</label><span class="orangeFont">*</span></td>
													<td width="56%" class="ListCell" align="left"><input style="background-color:#ffffff" size="39" name="RVerification"  class="textbox1"  type="text" id="RVerification"/><br />
													<br />
													 <img src="images/captcha/verify_user.php" alt="" align="baseline">
													</td>
												</tr>
												<tr id="GetStarted" style="visibility:visible;position:relative;">
													<td width="31%">&nbsp;</td>
													<td class="ListCell" align="left"><input type="image" src="images/register_blue.gif" class="ratesubm">
													</td>
												</tr>
											</table>
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
</form>
{$JS_ExtraScript}