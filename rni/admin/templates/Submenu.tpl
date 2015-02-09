{literal}
<script>
function Edit(Ident)
{
	document.frmMenuList.Ident.value=Ident;
	document.frmMenuList.hdAction.value="Edit";
	document.frmMenuList.action = "edit_submenu.php";
	document.frmMenuList.submit();		
}
</script>
{/literal}
<form name="frmMenuList" method="post">
<input type="hidden" name="Ident">
<input type="hidden" name="hdAction">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td height="30" colspan="2" valign="top" class="FormHeader">Sub Menu List&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" valign="top">
			<table width="90%"  border="1" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse">
				<tr class="GridHeader">
					<td style="padding-left:5px;">Main Menu Name</td>
					<td style="padding-left:5px;">Sub Menu Name</td>
					<td>&nbsp;</td>
				</tr>
				{section name=val loop=$SubMenuList}
					{if $smarty.section.val.iteration % 2 eq 0}
						{assign var="ClassName" value="GridCell1"}
					{else}
						{assign var="ClassName" value="GridCell2"}
					{/if}
					<tr class="{$ClassName}">
						<td style="padding-left:5px;">{$MainMenu[val]}</td>
						<td style="padding-left:5px;">{$SubMenuList[val]}</td>
						<td>&nbsp;
							<a href="javascript:Edit('{$MainMenuId[val]}')">
								<img src="images/button_edit.png" border="none" title="Edit Sub Menu List" style="cursor:pointer;">
							</a>
						</td>
					</tr>
				{/section}
				<tr>
					<td colspan="7" class="GridFooter" align="center" height="20">{$printperpage}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>