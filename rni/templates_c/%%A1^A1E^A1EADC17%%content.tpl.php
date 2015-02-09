<?php /* Smarty version 2.6.9, created on 2008-01-28 06:01:54
         compiled from content.tpl */ ?>

<form name="frmdoclist" method="post">
<input type="hidden" name="op" id="op" value="listdocs" /> 
<input type="hidden" name="hdAction" id="hdAction" value="" /> 
<input type="hidden" name="hdUserid" id="hdUserid" value="<?php echo $this->_tpl_vars['UserList'][0]['id']; ?>
" /> 

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="left">
 <tr height="10px"><td></td></tr>	
 <tr>
 	<td> 
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "docstatus.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
 </tr>
</table>
</form>