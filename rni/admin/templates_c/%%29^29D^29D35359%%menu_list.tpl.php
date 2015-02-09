<?php /* Smarty version 2.6.9, created on 2008-01-28 05:57:18
         compiled from menu_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'menu_list.tpl', 134, false),)), $this); ?>
<?php echo '
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
'; ?>


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
	<?php if ($this->_tpl_vars['strMsg'] != ""): ?>
		<tr><td align="center" class="ErrorMsg"><?php echo $this->_tpl_vars['strMsg']; ?>
</td></tr>
	<br>
	<?php endif; ?>
	<tr>
		<td height="30" colspan="2" valign="top" class="FormHeader">Menu List </td>
	</tr>

	<tr><td  align="right" style="padding-right:30px" class="select_menu"><div align="right">Select menu Type
			<select name="menu_types"  class="select_menu" onchange="doSubmit(this.value)">
			<?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['strMenuValues'],'output' => $this->_tpl_vars['strMenuTypes'],'selected' => $this->_tpl_vars['selected_menu']), $this);?>

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
				<?php unset($this->_sections['val']);
$this->_sections['val']['name'] = 'val';
$this->_sections['val']['loop'] = is_array($_loop=$this->_tpl_vars['MenuList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['val']['show'] = true;
$this->_sections['val']['max'] = $this->_sections['val']['loop'];
$this->_sections['val']['step'] = 1;
$this->_sections['val']['start'] = $this->_sections['val']['step'] > 0 ? 0 : $this->_sections['val']['loop']-1;
if ($this->_sections['val']['show']) {
    $this->_sections['val']['total'] = $this->_sections['val']['loop'];
    if ($this->_sections['val']['total'] == 0)
        $this->_sections['val']['show'] = false;
} else
    $this->_sections['val']['total'] = 0;
if ($this->_sections['val']['show']):

            for ($this->_sections['val']['index'] = $this->_sections['val']['start'], $this->_sections['val']['iteration'] = 1;
                 $this->_sections['val']['iteration'] <= $this->_sections['val']['total'];
                 $this->_sections['val']['index'] += $this->_sections['val']['step'], $this->_sections['val']['iteration']++):
$this->_sections['val']['rownum'] = $this->_sections['val']['iteration'];
$this->_sections['val']['index_prev'] = $this->_sections['val']['index'] - $this->_sections['val']['step'];
$this->_sections['val']['index_next'] = $this->_sections['val']['index'] + $this->_sections['val']['step'];
$this->_sections['val']['first']      = ($this->_sections['val']['iteration'] == 1);
$this->_sections['val']['last']       = ($this->_sections['val']['iteration'] == $this->_sections['val']['total']);
?>
					<?php $this->assign('CurrParentId', $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Parent_ID']); ?>
					<?php $this->assign('NextIndex', $this->_sections['val']['index']+1); ?>
					<?php $this->assign('PrevIndex', $this->_sections['val']['index']-1); ?>
					<?php $this->assign('NextParentId', $this->_tpl_vars['MenuList'][$this->_tpl_vars['NextIndex']]['Parent_ID']); ?>
					<?php $this->assign('NextMenuId', $this->_tpl_vars['MenuList'][$this->_tpl_vars['NextIndex']]['Ident']); ?>
					<?php $this->assign('PreviousMenuId', $this->_tpl_vars['MenuList'][$this->_tpl_vars['PrevIndex']]['Ident']); ?>

					<?php if ($this->_sections['val']['iteration'] % 2 == 0): ?>
					<?php $this->assign('ClassName', 'GridCell1'); ?>
					<?php else: ?>
					<?php $this->assign('ClassName', 'GridCell2'); ?>
					<?php endif; ?>

					<?php if ($this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Status'] == 'Active'): ?>
						<?php $this->assign('StatusFont', 'GreenFont'); ?>
					<?php elseif ($this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Status'] == 'Deleted'): ?>
						<?php $this->assign('StatusFont', 'RedFont'); ?>
					<?php else: ?>
						<?php $this->assign('StatusFont', 'OrangeFont'); ?>
					<?php endif; ?>
				<tr class="<?php echo $this->_tpl_vars['ClassName']; ?>
">
					<td><input id="chk" name="chk[]" type="checkbox" value="<?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Ident']; ?>
"><input type="hidden" value="<?php echo $this->_tpl_vars['sort']; ?>
"><input type="hidden" value="<?php echo $this->_tpl_vars['type']; ?>
"></td>
					<td  valign="top" style="padding-left:5px;">
						<a href="javascript:SubMenu('<?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Ident']; ?>
')" style="cursor:pointer; color:#FFFFFF;" class="Listvalue"><?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['MainMenu']; ?>
</a>	
					</td>
					<td style="padding-left:5px;"><?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['MenuType']; ?>
</td>
					<td>
						<table  border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td  align="right">
								<?php if ($this->_sections['val']['index'] != 0): ?>
									<?php if ($this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Order_id'] != 0): ?>
										<a onclick="moveup('<?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Ident']; ?>
','<?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Order_id']; ?>
','<?php echo $this->_tpl_vars['PreviousMenuId']; ?>
')" style="cursor:pointer;"><img src="images/uparrow.gif" width="15" height="13" border="0" alt="Move Up"></a>
									<?php endif; ?>
								<?php endif; ?>
								</td>
								
								<td  align="left">
								<?php if ($this->_sections['val']['index'] != $this->_tpl_vars['MenuListCount']-1): ?>
									<a onclick="movedown('<?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Ident']; ?>
','<?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Order_id']; ?>
','<?php echo $this->_tpl_vars['NextMenuId']; ?>
')" style="cursor:pointer;"><img src="images/downarrow.gif" width="15" height="13" border="0" alt="Move Down"></a>
								<?php endif; ?>								
								</td>
							</tr>
						</table>
					</td>
					<td  valign="top" style="padding-left:5px;"><font class="<?php echo $this->_tpl_vars['StatusFont']; ?>
"><?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Status']; ?>
</font></td>
					<td style="padding-left:5px;"><a href="javascript:Edit('<?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Ident']; ?>
')" ><img src="images/button_edit.png" border="none" style="cursor:pointer" title="Edit Menu List"></a> <img src="images/button_drop.png" style="cursor:pointer;"  border="none" title="Delete Menu List" onclick="DeleteSelected('<?php echo $this->_tpl_vars['MenuList'][$this->_sections['val']['index']]['Ident']; ?>
')" /></td>
				</tr>
				<?php endfor; else: ?>
					<tr><td colspan="6" class="ErrorMsg" align="center" height="20">No Records Found</td></tr>
				<?php endif; ?>
				<tr>
					<td colspan="7" class="GridFooter" align="center" height="20"><?php echo $this->_tpl_vars['printperpage']; ?>
</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>