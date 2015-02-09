<?php /* Smarty version 2.6.9, created on 2008-01-25 13:10:46
         compiled from main.tpl */ ?>
<html>
<title>Admin Control Panel</title>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
<link href="css/Main.css" rel="stylesheet" type="text/css">
<?php echo '
<script language="javascript" src="../javascript/ajax/lib/prototype.js" type="text/javascript"></script>
'; ?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
			<td rowspan="2" width="20%" height="100%" valign="top" background="images/cp_navbody_bg.gif"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'leftmenu.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
			<td valign="top" height="20%"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
		</tr>
		<tr> 
			<td valign="top" height="585px"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['InnerTpl'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
		</tr>
	</table>
</body>
</html>