{literal}
<script src="../javascript/validation.js" language="javascript" type="text/javascript"></script>
<script>
function Validates(obj){
  	if(!IsValid(document.frmRegister.txtusername.value,"Username")) {
		document.frmRegister.txtusername.focus();
		return false;
	}
	if(!IsValid(document.frmRegister.txtpassword.value,"Password")) {
		document.frmRegister.txtPassword.focus();
		return false;
	}		
	if(document.frmRegister.txtpassword.value.length<5) {
		alert("Your password must contain minimum 5 characters!");
		return false;
	}	
	if(!IsValid(document.frmRegister.RConfirmPassword.value, "Confirm Password")) {
		document.frmRegister.RConfirmPassword.focus();
		return false;
	}	
	if(!(document.frmRegister.txtpassword.value == document.frmRegister.RConfirmPassword.value)){
		document.frmRegister.txtpassword.value="";
		document.frmRegister.RConfirmPassword.value="";
		document.frmRegister.txtpassword.focus();
		return false;
	}			
	if(!isEmail(document.frmRegister.txtemail.value)) {
		document.frmRegister.txtemail.focus();
		return false;		
	}
	document.frmRegister.hdAction.value='Add';
	document.frmRegister.submit();
//return true;
}
</script>
{/literal}
<form name="frmRegister" method="post" action="" onSubmit="" >
<input type="hidden" name="hdAction"  >
<input type="hidden" name="id" value="{$id}">
<input type="hidden" name="prev_status" value="{$UserValue[0].Status}">

{if strMsg}
	<br>
	<table border="0" align="center" cellpadding="0" cellspacing="0" width="75%">
		<tr>
		  <td align="center" class="ErrorMsg">&nbsp;</td>
	  </tr>
		<tr><td align="center" class="ErrorMsg">{$Errmsg}{$strMsg}</td></tr>
	</table>
	<br>
{/if}

<table width="100%"  border="0" cellspacing="2" cellpadding="0">
	<tr> 
      <td height="30" colspan="3" valign="top" class="FormHeader">Member Details</td>
    </tr>
	<tr>
		<td width="7%">&nbsp;</td>
		<td align="center" valign="top" colspan="2">
			<table width="95%"  border="0" align="left" cellpadding="0" cellspacing="0" class="TableBorder" style="border-collapse:collapse">
				<tr class="GridHeader">
					<td colspan="2">Add Member</td>
				</tr>
				<tr>
					<td align="right" class="text"  height="25%" colspan="2" style="padding-left:5px">
						<span class="mand" style="padding-right:5px; ">* Mandatory</span>
					</td>
				</tr>
				<tr> 
					<td height="127" colspan="2" style="padding-left:5px"> 
						<fieldset class="Fieldset" style="width:625px;"><legend>Member Details</legend>
							<table width="80%"  border="0" cellspacing="2" cellpadding="2">
							</table>
							<table width="99%"  border="0" cellspacing="2" cellpadding="8">
												<tr>
													<td  width="31%" valign="top" class="text"><label for="txtRUserName">First Name<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell"><input style="background-color:#ffffff" name="txtfirstname" id="txtfirstname" type="text"    class="featuredtxtbox"   value="{$txtusername}" size="39"  ></td>		
												</tr>
												<tr>
													<td  width="31%" valign="top" class="text"><label for="txtRUserName">Last Name<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell"><input style="background-color:#ffffff" name="txtlastname" id="txtlastname" type="text"    class="featuredtxtbox"   value="{$txtusername}" size="39"  >	</td>				
												</tr>
							
												<tr>
													<td  width="31%" valign="top" class="text"><label for="txtRUserName">Username<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell"><input style="background-color:#ffffff" name="txtusername" type="text"    class="featuredtxtbox"   value="{$txtusername}" size="39"  id="txtusername">		</td>			
												</tr>
												
												<tr>
													<td width="31%" valign="top" class="text"><label for="txtRPassword">Password<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell">
														<input style="background-color:#ffffff"  size="39" name="txtpassword" class="featuredtxtbox"  value="password" type="password"  id="txtRPassword"/>
														<br /><span class="text">password (password) </span>
														</td>
													
												</tr>
												<tr>
													<td width="31%" valign="top" class="text"><label for="txtConfirmPassword">Confirm Password<span class="orangeFont">*</span></label></td>
													<td width="56%" class="ListCell">
														<input style="background-color:#ffffff"  size="39" name="RConfirmPassword" class="featuredtxtbox" value="password" type="password" id="RConfirmPassword"  />
														<br /><span class="text">Confirm password (password) </span>
													</td>		
												</tr>
												<tr>
													<td width="31%" valign="top" class="text">Email Address<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell"><input style="background-color:#ffffff" name="txtemail" size="39" class="featuredtxtbox"  value="{$txtemail}"  type="text" id="txtemail" /></td>		
												</tr>
												<tr>
												  <td width="24%" height="30" valign="top" class="text" style="padding-left:5px;" nowrap>Group</td>
												  <td width="76%" valign="top">
												  <select name="txtgrouplist[]" id="txtgrouplist[]" class="txtbox" multiple="multiple" size="6" >
														{html_options values=$GroupId output=$GroupValue}
												  </select>				  
												  </td>
												</tr>	
												
												<tr>
													<td class="text" valign="top">Date of Birth</td>
													<td class="ListCell">
													  <select name="month" style="width:50px;" id="month" tabindex="13">
														{html_options options=$monthsList selected=$month}
													  </select>
													  <select name="day" style="width:50px;" id="day" tabindex="14">
														{html_options options=$daysList selected=$day}
													  </select>					
													  <select name="year" style="width:60px;" id="year" tabindex="15">
														{html_options options=$yearList selected=$year}
													  </select>&nbsp;<font size="1" color="#FF6600">[ mm/dd/yyyy ]</font>
													</td>
												</tr>		
												<tr>
													<td class="text" valign="top">City</td>
													<td class="ListCell">
														<input style="background-color:#ffffff" name="txtcity" type="text" class="featuredtxtbox"  value="{$txtcity}" size="39"  id="txtcity">			
													</td>
												</tr>
												<tr>
													<td class="text" valign="top">State</td>
													  <td class="ListCell">
													  <!--<input style="background-color:#ffffff" name="txtstate" type="text" class="featuredtxtbox"  value="{$txtstate}" size="39"  id="txtstate"  >-->	

													<select name="txtstate" id="txtstate" class="txtbox">
														<option value="0">Select</option>
		 												{html_options values=$StateCode output=$StateName selected=$txtstate}	
													  </select>
													  <!--input style="background-color:#ffffff" name="txtstate" type="text" class="textbox1" value="PA" readonly="true" size="39"  id="txtstate"-->			
													</td>
												</tr>
									
												<tr>
													<td class="text" valign="top">Zip</td>
													<td class="ListCell">
														<input style="background-color:#ffffff" size="39" name="txtzip"  id="txtzip" value="{$txtzip}"   class="featuredtxtbox"    type="text"/>
													</td>
												</tr>
								
								<tr>
									<td class="text">Status:</td>
									<td class="text">
										{if $UserValue[0].Status eq "Active"}
											<input type="radio" name="txtStatus" value="Active" checked="checked">Active
											<input type="radio" name="txtStatus" value="Inactive" >InActive
										{else}
											<input type="radio" name="txtStatus" value="Active" >Active
											<input type="radio" name="txtStatus" value="Inactive" checked="checked">InActive
										{/if}
									</td>
								</tr>
							</table>
					   </fieldset>
				   </td>
				</tr>  
				<tr>
					<td height="25%">&nbsp;</td>
					<td height="25%">&nbsp;</td>
				</tr>
		  </table>
		</td>
	</tr>
	<tr>
		<td height="25%">&nbsp;</td>
		<td height="25%" align="center">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td width="7%" height="25%">&nbsp;</td>
		<td width="73%" height="25%" align="center"><input type="button" name="Submit" class="button" value="Add Member" onClick="return Validates(this.form)"/></td>
		<td>&nbsp;</td>
	</tr>
</table>
</form>
