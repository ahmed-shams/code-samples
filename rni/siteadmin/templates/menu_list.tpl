{literal}
<script type="text/javascript">
	 function checkAll(val){
		objForm=document.frmMenuList;
		len=objForm.elements.length;
		var i;
		for(i=0; i<len; i++){
		if(objForm.elements[i].name =="chk[]")
		{
		 objForm.elements[i].checked=val;
		}
    }
 }
 
 function deleteSelRecords(hAction){
 	switch(hAction){
		case "Delete":
			var Msg = "Are you sure to delete selected Record(s)";
			break;
		case "Active":
			var Msg = "Are you sure to Activate selected Record(s)";
			break;	
		case "Inactive":
			var Msg = "Are you sure to InActivate selected Record(s)";
			break;		
	}
	ptr=document.frmMenuList;
	len=ptr.elements.length;
	var i=0;
	var y=0;
	for(i=0; i<len; i++)
	{
		if (ptr.elements[i].name=="chk[]")
		 { 
			if(ptr.elements[i].checked == 1)
			{
				y=1;
		 	}	
		 }
	}
	if( y!= 1)
		{
		alert("Select Any One Of Record");
		}
	else
		{
			if(confirm(Msg))
			{
				document.frmMenuList.hdAction.value=hAction;
				document.frmMenuList.submit();				 
			}
		}
		return;
  }
function Edit(Ident){
		document.frmMenuList.Ident.value=Ident;
		document.frmMenuList.hdAction.value="Edit";
		document.frmMenuList.action = "edit_menu.php";
		document.frmMenuList.submit();				
	}
    function DeleteSelected(Ident){
			if(confirm("Are you sure to delete this Record")){
			document.frmMenuList.Ident.value=Ident;
			document.frmMenuList.hdAction.value="DeleteSelected";
			document.frmMenuList.submit();
		}
	}
</script>
<script language="javascript">
function moveup(Id,OrderId,PreviousMenuId)
{
	document.frmMenuList.hdId.value    		= Id;
	document.frmMenuList.OrderId.value 		= OrderId;
	document.frmMenuList.PreviousMenuId.value = PreviousMenuId;
	document.frmMenuList.KeyId.value   		= "up";
	document.frmMenuList.haction.value   	= 1;
	document.frmMenuList.submit();
}
function movedown(Id,OrderId,NextMenuId)
{
	document.frmMenuList.hdId.value    	= Id;
	document.frmMenuList.OrderId.value 	= OrderId;
	document.frmMenuList.NextMenuId.value = NextMenuId;
	document.frmMenuList.KeyId.value   	= "down";
	document.frmMenuList.haction.value   = 1;
	document.frmMenuList.submit();
}
function doSubmit(val)
{
	document.frmMenuList.menu_types.value   = val;
	document.frmMenuList.offset.value   = 0;
	document.frmMenuList.submit();
}

function SubMenu(Ident)
{
document.frmMenuList.Ident.value=Ident;
document.frmMenuList.SubMenuType.value="SubMenu";
document.frmMenuList.action = "Submenu.php";
document.frmMenuList.submit();		
}
</script>
{/literal}

<form name="frmMenuList" method="post">
<input type="hidden" name="hdId" id="hdId">
<input type="hidden" name="OrderId" id="OrderId">
<input type="hidden" name="KeyId" id="KeyId">
<input type="hidden" name="NextMenuId" id="NextMenuId">
<input type="hidden" name="PreviousMenuId" id="PreviousMenuId">
<input type="hidden" name="MainMenus" id="MainMenus">
<input type="hidden" name="MenuId" id="MenuId">
<input type="hidden" name="haction" id="haction">
<input type="hidden" name="MenuType" id="MenuType">
<input type="hidden" name="SubMenuType">
<input type="hidden" name="Ident">
<input type="hidden" name="hdAction">
<input type="hidden" name="offset">

<table width="100%"  border="0">
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	{if $strMsg neq ""}
		<tr><td align="center" class="ErrorMsg">{$strMsg}</td></tr>
	<br>
	{/if}
	<tr>
		<td height="30" colspan="2" valign="top" class="FormHeader">Menu List </td>
	</tr>

	<tr><td  align="right" style="padding-right:30px" class="select_menu"><div align="right">Select menu Type
			<select name="menu_types"  class="select_menu" onchange="doSubmit(this.value)">
			{html_options values = $strMenuValues output = $strMenuTypes selected=$selected_menu}
			</select>
		</div></td></tr>
	<tr>
		<td   align="left" style="padding-left:20px" valign="bottom"><input type="button" name="button" value="Check All" onclick="checkAll(1)" class="button"> 
			<input type="button" name="button" value="Clear All" onclick="checkAll(0)" class="button"> 
			<input type="button" name="button" value="Delete Selected" onclick="deleteSelRecords('Delete')" class="button"> 
			<input type="button" name="button" value="Activate Selected" onclick="deleteSelRecords('Active')" class="button"> 
			<input type="button" name="button" value="DeActivate Selected" onclick="deleteSelRecords('Inactive')" class="button"> 
		</td>
		
	</tr>
	<tr>
		<td colspan="2" valign="top">
			<table width="95%"  border="1" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse">
				<tr class="GridHeader">
					<td width="2%">&nbsp;</td>
					<td width="40%"  valign="top" style="padding-left:5px;"><span class="WhiteFont">Menu Name</span></td>
					<td width="7%" align="left" valign="top" style="padding-left:5px;">Menu Type </span></td>
					<td width="5%" align="center" valign="top" style="padding-left:5px;"><span class="WhiteFont">Action</span></td>   
					<td width="5%" valign="top" style="padding-left:5px;"><span class="WhiteFont">Status</span></td>
					<td width="4%" class="GridHeader">&nbsp;</td>
				</tr>
				{section name="val" loop=$MenuList}
					{assign var="CurrParentId" value=$MenuList[val].Parent_ID}
					{assign var="NextIndex" value=$smarty.section.val.index+1}
					{assign var="PrevIndex" value=$smarty.section.val.index-1}
					{assign var="NextParentId" value=$MenuList[$NextIndex].Parent_ID}
					{assign var="NextMenuId" value=$MenuList[$NextIndex].Ident}
					{assign var="PreviousMenuId" value=$MenuList[$PrevIndex].Ident}

					{if $smarty.section.val.iteration % 2 eq 0}
					{assign var="ClassName" value="GridCell1"}
					{else}
					{assign var="ClassName" value="GridCell2"}
					{/if}

					{if $MenuList[val].Status eq "Active"}
						{assign var="StatusFont" value="GreenFont"}
					{elseif $MenuList[val].Status eq "Deleted"}
						{assign var="StatusFont" value="RedFont"}
					{else}
						{assign var="StatusFont" value="OrangeFont"}
					{/if}
				<tr class="{$ClassName}">
					<td><input id="chk" name="chk[]" type="checkbox" value="{$MenuList[val].Ident}"><input type="hidden" value="{$sort}"><input type="hidden" value="{$type}"></td>
					<td  valign="top" style="padding-left:5px;">
						<a href="javascript:SubMenu('{$MenuList[val].Ident}')" style="cursor:pointer; color:#FFFFFF;" class="Listvalue">{$MenuList[val].MainMenu}</a>	
					</td>
					<td style="padding-left:5px;">{$MenuList[val].MenuType}</td>
					<td>
						<table  border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td  align="right">
								{if $smarty.section.val.index neq 0}
									{if $MenuList[val].Order_id neq 0}
										<a onclick="moveup('{$MenuList[val].Ident}','{$MenuList[val].Order_id}','{$PreviousMenuId}')" style="cursor:pointer;"><img src="images/uparrow.gif" width="15" height="13" border="0" alt="Move Up"></a>
									{/if}
								{/if}
								</td>
								
								<td  align="left">
								{if $smarty.section.val.index neq $MenuListCount-1}
									<a onclick="movedown('{$MenuList[val].Ident}','{$MenuList[val].Order_id}','{$NextMenuId}')" style="cursor:pointer;"><img src="images/downarrow.gif" width="15" height="13" border="0" alt="Move Down"></a>
								{/if}								
								</td>
							</tr>
						</table>
					</td>
					<td  valign="top" style="padding-left:5px;"><font class="{$StatusFont}">{$MenuList[val].Status}</font></td>
					<td style="padding-left:5px;"><a href="javascript:Edit('{$MenuList[val].Ident}')" ><img src="images/button_edit.png" border="none" style="cursor:pointer" title="Edit Menu List"></a> <img src="images/button_drop.png" style="cursor:pointer;"  border="none" title="Delete Menu List" onclick="DeleteSelected('{$MenuList[val].Ident}')" /></td>
				</tr>
				{sectionelse}
					<tr><td colspan="6" class="ErrorMsg" align="center" height="20">No Records Found</td></tr>
				{/section}
				<tr>
					<td colspan="7" class="GridFooter" align="center" height="20">{$printperpage}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
