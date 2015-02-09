{literal}
<script src="../javascript/validation.js" language="javascript" type="text/javascript"></script>
<script src="../javascript/ajax/prototype.js" language="javascript" type="text/javascript"></script>
<script>
function InsertAnalysis(objForm){
	
	var form_name=document.frm_edit_profile;
	document.frm_edit_profile.hdAction.value ='Update';
	document.frm_edit_profile.submit();
}


</script>
{/literal}
<form name="frm_edit_profile" method="post" action="">
<input type="hidden" name="hdAction">
<input type="hidden" name="id" value="{$id}">
<input type="hidden" name="prev_status" value="{$UserValue[0].Status}">

{if $Update eq 1}
	<br>
	<table border="0" align="center" cellpadding="0" cellspacing="0" width="75%">
		<tr>
		  <td align="center" class="ErrorMsg">&nbsp;</td>
	  </tr>
		<tr><td align="center" class="ErrorMsg">{$Errmsg}{$strMsg}</td></tr>
	</table>
	<br>
{/if}
<br>
<table width="100%"  border="0" cellspacing="2" cellpadding="0">
	<tr> 
      <td height="30" colspan="3" valign="top" class="FormHeader">User Profile</td>
    </tr>
	<tr>
		<td width="7%">&nbsp;</td>
		<td align="center" valign="top" colspan="2">
			<table width="95%"  border="0" align="left" cellpadding="0" cellspacing="0" class="TableBorder" style="border-collapse:collapse">
				<tr class="GridHeader">
					<td colspan="2">Edit Profile</td>
				</tr>
				<tr>
					<td align="right" class="text"  height="25%" colspan="2" style="padding-left:5px">
						<span class="mand" style="padding-right:5px; ">* Mandatory</span>
					</td>
				</tr>
				<tr> 
					<td height="127" colspan="2" style="padding-left:5px"> 
						<fieldset class="Fieldset" style="width:625px;"><legend>User Details</legend>
							<table width="80%"  border="0" cellspacing="2" cellpadding="2">
							</table>
							<table width="99%"  border="0" cellspacing="2" cellpadding="8">
												<tr>
													<td  width="31%" valign="top" class="text"><label for="txtRUserName">First Name<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell"><input style="background-color:#ffffff" name="txtfirstname" id="txtfirstname" type="text"    class="featuredtxtbox"   value="{$UserValue[0].firstname}" size="43" >			
												</tr>
												<tr>
													<td  width="31%" valign="top" class="text"><label for="txtRUserName">Username<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell"><input style="background-color:#ffffff" name="txtlastname" id="txtlastname" type="text"    class="featuredtxtbox"   value="{$UserValue[0].lastname}" size="43">			
												</tr>
							
												<tr>
													<td  width="31%" valign="top" class="text"><label for="txtRUserName">Username<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell"><input style="background-color:#ffffff" name="txtusername" type="text"    class="featuredtxtbox" value="{$UserValue[0].username}"  size="43"  id="txtusername">			
												</tr>
												
												<tr>
													<td width="31%" valign="top" class="text"><label for="txtRPassword">Password<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell"><input style="background-color:#ffffff"  size="43" name="txtpassword" class="featuredtxtbox" value="{$UserValue[0].password}"  type="password"  id="txtRPassword"/>
												</tr>
												<tr>
													<td width="31%" valign="top" class="text">Email Address<span class="mand">*</span></label></td>
													<td width="56%" class="ListCell"><input style="background-color:#ffffff" name="txtemail" size="43" class="featuredtxtbox" value="{$UserValue[0].email}"  type="text" id="txtemail" />
												</tr>
												<tr>
												  <td width="24%" height="30" valign="top" class="text" style="padding-left:5px;" nowrap>Group</td>
												  <td width="76%" valign="top">
												  <select name="txtgrouplist[]" id="txtgrouplist[]" class="txtbox" multiple="multiple" size="5" >
														{html_options values=$GroupId output=$GroupValue selected=$grouplist}
												  </select>				  
												  </td>
												</tr>	
												<tr>
													<td class="text" valign="top">Document List</td>
													<td width="76%" valign="top">
													  <select name="documentslist[]" id="documentslist[]" class="txtbox" multiple="multiple" size="5" >
															{html_options values=$documentsId output=$documentsValue selected=$documentlist}
													  </select>				  													
													</td>
												</tr>
												<tr>
													<td class="text" valign="top">Date of Birth</td>
													<td class="ListCell">
													  <select name="month" style="width:50px;" id="month" tabindex="13">
														{html_options options=$monthsList selected=$UserValue[0].month}
													  </select>
													  <select name="day" style="width:50px;" id="day" tabindex="14">
														{html_options options=$daysList selected=$UserValue[0].day}
													  </select>					
													  <select name="year" style="width:60px;" id="year" tabindex="15">
														{html_options options=$yearList selected=$UserValue[0].year}
													  </select>&nbsp;<font size="1" color="#FF6600">[ mm/dd/yyyy ]</font>
													</td>
												</tr>		
												<tr>
													<td class="text" valign="top">City</td>
													<td class="ListCell">
														<input style="background-color:#ffffff" name="txtcity" type="text" class="featuredtxtbox" value="{$UserValue[0].city}" size="43"  id="txtcity">			
													</td>
												</tr>
												<tr>
													<td class="text" valign="top">State</td>
													  <td class="ListCell">
													  <!--<input style="background-color:#ffffff" name="txtstate" type="text" class="featuredtxtbox"  size="43"  id="txtstate"  value="{$UserValue[0].state}">-->	
													<select name="txtstate" id="txtstate" class="txtbox">
														<option value="0">Select</option>
														{html_options values=$StateCode output=$StateName selected=$UserValue[0].state}	
													  </select>
														<!--input style="background-color:#ffffff" name="txtstate" type="text" class="textbox1" value="PA" readonly="true" size="43"  id="txtstate"-->			
													</td>
												</tr>
									
												<tr>
													<td class="text" valign="top">Zip</td>
													<td class="ListCell">
														<input style="background-color:#ffffff" size="43" name="txtzip"  id="txtzip" class="featuredtxtbox"   value="{$UserValue[0].zip}"  type="text"/>
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
		<td width="73%" height="25%" align="center"><input type="button" name="Submit" class="button" value="Update Profile" onclick="InsertAnalysis(this.form)"/></td>
		<td>&nbsp;</td>
	</tr>
</table>
</form>
{literal}
<script>
document.frm_edit_profile.txtusername.focus();
</script>
{/literal}
