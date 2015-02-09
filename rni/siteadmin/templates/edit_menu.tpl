{literal}
<script src="../javascript/validation.js" language="javascript" type="text/javascript"></script>
<script src="../javascript/ajax/prototype.js" language="javascript" type="text/javascript"></script>
<script language="javascript" src="../javascript/boxpopup.js"></script>
<script>
function InsertAnalysis(objForm){
	
	var form_name=document.frm_add_menu;
	document.frm_add_menu.hdAction.value ='Update';
	document.frm_add_menu.submit();
}


</script>
{/literal}
<form name="frm_add_menu" method="post" action="">
<input type="hidden" name="hdAction">
<input type="hidden" name="Ident" value="{$Ident}">
<input type="hidden" name="menu_types" value="{$MenuValue[0].MenuType}">


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
      <td height="30" colspan="3" valign="top" class="FormHeader">Menu's List </td>
    </tr>
	<tr>
		<td width="7%">&nbsp;</td>
		<td align="center" valign="top" colspan="2">
			<table width="95%"  border="0" align="left" cellpadding="0" cellspacing="0" class="TableBorder" style="border-collapse:collapse">
				<tr class="GridHeader">
					<td colspan="2">Edit Menu</td>
				</tr>
				<tr>
					<td align="right" class="text"  height="25%" colspan="2" style="padding-left:5px">
						<span class="mand" style="padding-right:5px; ">* Mandatory</span>
					</td>
				</tr>
				<tr> 
					<td height="127" colspan="2" style="padding-left:5px"> 
						<fieldset class="Fieldset" style="width:625px;"><legend>Menu Details</legend>
							<table width="80%"  border="0" cellspacing="2" cellpadding="2">
							</table>
							<table width="99%"  border="0" cellspacing="2" cellpadding="8">
								<tr > 
									<td width="18%" style="padding-left:5px" class="text" nowrap>Main Menu</td>
									<td width="82%"><input type="text" name="txtMainMenu" class="featuredtxtbox" value="{$MenuValue[0].MainMenu}" size="60"/></td>
								</tr>
								<tr> 
									<td height="45" style="padding-left:5px" valign="top" class="text" nowrap>MainMenu Link<span class="mand">*</span></td>
								 	<td><textarea name="txtMainMenuLink"  rows="3"  class="featuredtxtarea" cols="57">{$MenuValue[0].MainMenuLink}</textarea></td>
								</tr>
								<tr> 
									<td height="45" style="padding-left:5px" valign="top" class="text" nowrap>Sub Menu <span class="mand">*</span></td>
								  	<td><textarea name="txtSubMenu"  rows="3"  class="featuredtxtarea" cols="57">{$MenuValue[0].SubMenu}</textarea></td>
								</tr>
								<tr> 
									<td height="45" style="padding-left:5px" valign="top" class="text" nowrap>SubMenu Link<span class="mand">*</span></td>
								 	<td><textarea name="txtMenuLink"  rows="3"  class="featuredtxtarea" cols="57">{$MenuValue[0].MenuLink}</textarea></td>
								</tr>
								<tr > 
									<td width="16%" style="padding-left:5px" class="text" nowrap>Display Title</td>
									<td width="84%"><input type="text" name="txtDisplayTitle" class="featuredtxtbox" value="{$MenuValue[0].DisplayTitle}" size="60"/></td>
								</tr>
								<tr> 
									<td class="text" style="padding-left:5px" nowrap>Menu Type<span class="mand">*</span></td>
								  	<td>
										<select name="txtMenuType" class="featuredtxtbox" >
											<option value="Admin" {if $MenuValue[0].MenuType eq "Admin"} selected{/if}>Admin</option>
											<option value="Home"  {if $MenuValue[0].MenuType eq "Home"} selected{/if}>Home</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="text">Status:</td>
									<td class="text">
										{if $MenuValue[0].Status eq "Active"}
											<input type="radio" name="txtStatus" value="Active" checked="checked">Active
											<input type="radio" name="txtStatus" value="InActive" >InActive
										{else}
											<input type="radio" name="txtStatus" value="Active" >Active
											<input type="radio" name="txtStatus" value="InActive" checked="checked">InActive
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
		<td width="73%" height="25%" align="center"><input type="button" name="Submit" class="button" value="Update Menu" onclick="InsertAnalysis(this.form)"/></td>
		<td>&nbsp;</td>
	</tr>
</table>
</form>
{literal}
<script>
document.frm_add_menu.txtMainMenu.focus();
</script>
{/literal}
