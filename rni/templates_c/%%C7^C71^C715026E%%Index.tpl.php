<?php /* Smarty version 2.6.9, created on 2008-02-06 05:00:48
         compiled from Index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/PageStart.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2">
		  	
		  </td>
        </tr>
		<tr>
			<td align="center" style="padding-top:20px;" ><span class="ErrorMsg" id="LoginErrorMsg"><?php if ($this->_tpl_vars['strMsg']):  echo $this->_tpl_vars['strMsg'];  endif; ?></span></td>
		</tr>
        <tr>
          <td width="71%" valign="middle" style="padding-top:25px;" align="center">
		  	  <?php if ($this->_tpl_vars['InnerTpl'] != ""): ?>
			  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['InnerTpl'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			  <?php else: ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "loginpage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			  <?php endif; ?>
		  </td>
          <td width="29%" align="center" valign="top">
		  	<!--Advertisment START-->	
			<?php if ($this->_tpl_vars['InnerTpl'] != "forgetpwd.tpl" && $this->_tpl_vars['InnerTpl'] != ""): ?>
			  <table width="219" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td class="titleleft">&nbsp;</td>
				  <td align="center" valign="middle" class="titlemid"><table width="80%" border="0" cellpadding="0" cellspacing="0">
					<tr>
					  <td align="center" class="hdrtext" nowrap="nowrap">Announcement(s)</td>
					</tr>
				  </table></td>
				  <td class="titleright">&nbsp;</td>
				</tr>			
				<tr>
				  <td class="leftbdr">&nbsp;</td>
				  <td class="Documentlist" height="50px;" style="padding-top:10px;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr height="28px;">
						<td class="paginationfont">You have <span class="ErrorMsg"><?php echo $this->_tpl_vars['unread_doc']; ?>
</span> unread documents</td>
					  </tr>
					  <tr>
						<td class="orangetext"><?php echo $this->_tpl_vars['Unreaddoclist']; ?>
</td>
					  </tr>
					</table>
				  <td class="rightbdr">&nbsp;</td>
				</tr>
				<tr>
				  <td class="btmleft"></td>
				  <td class="btmmid"></td>
				  <td class="btmright"></td>
				</tr>
			  </table>
			  <?php endif; ?>
			 <!--Advertisment END-->	
		  </td>
        </tr>
      </table>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes/PageEnd.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
