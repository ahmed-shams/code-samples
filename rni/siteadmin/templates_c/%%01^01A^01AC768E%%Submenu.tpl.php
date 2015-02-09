<?php /* Smarty version 2.6.9, created on 2008-01-28 05:57:22
         compiled from Submenu.tpl */ ?>
<?php echo '
<script>
function Edit(Ident)
{
	document.frmMenuList.Ident.value=Ident;
	document.frmMenuList.hdAction.value="Edit";
	document.frmMenuList.action = "edit_submenu.php";
	document.frmMenuList.submit();		
}
</script>
'; ?>

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
				<?php unset($this->_sections['val']);
$this->_sections['val']['name'] = 'val';
$this->_sections['val']['loop'] = is_array($_loop=$this->_tpl_vars['SubMenuList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<?php if ($this->_sections['val']['iteration'] % 2 == 0): ?>
						<?php $this->assign('ClassName', 'GridCell1'); ?>
					<?php else: ?>
						<?php $this->assign('ClassName', 'GridCell2'); ?>
					<?php endif; ?>
					<tr class="<?php echo $this->_tpl_vars['ClassName']; ?>
">
						<td style="padding-left:5px;"><?php echo $this->_tpl_vars['MainMenu'][$this->_sections['val']['index']]; ?>
</td>
						<td style="padding-left:5px;"><?php echo $this->_tpl_vars['SubMenuList'][$this->_sections['val']['index']]; ?>
</td>
						<td>&nbsp;
							<a href="javascript:Edit('<?php echo $this->_tpl_vars['MainMenuId'][$this->_sections['val']['index']]; ?>
')">
								<img src="images/button_edit.png" border="none" title="Edit Sub Menu List" style="cursor:pointer;">
							</a>
						</td>
					</tr>
				<?php endfor; endif; ?>
				<tr>
					<td colspan="7" class="GridFooter" align="center" height="20"><?php echo $this->_tpl_vars['printperpage']; ?>
</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>