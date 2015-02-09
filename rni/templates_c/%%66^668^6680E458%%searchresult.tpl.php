<?php /* Smarty version 2.6.9, created on 2008-01-29 07:31:41
         compiled from searchresult.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'searchresult.tpl', 27, false),array('modifier', 'truncate', 'searchresult.tpl', 58, false),array('modifier', 'date_format', 'searchresult.tpl', 61, false),)), $this); ?>
<?php echo '
<script type="text/javascript" language="javascript">
function Viewdetaileddocview(DocumentId) {
	$("hddocid").value = DocumentId;
	document.frmdocgrid.action = \'index.php\';
	document.frmdocgrid.submit();	
}
</script>
'; ?>

<!--ProductsListList START	-->	
<table width="99%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="padding:10px 0px 8px 8px;">
		<form name="frmdocgrid" method="post" action="index.php">
		<input type="hidden" name="op" id="op" value="listdetaileddocs" /> 
		<input type="hidden" name="hdUserid" id="hdUserid" value="<?php echo $this->_tpl_vars['UserList'][0]['id']; ?>
" />
		<input type="hidden" name="hddocid" id="hddocid" value="" />
		<table width="99%" border="0" cellspacing="0" cellpadding="0" align="left">
		 <tr height="10px"><td></td></tr>	
		 <tr>
			<td> 
		<table width="682" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td class="titleleft">&nbsp;</td>
              <td align="center" valign="middle" class="titlemid"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="hdrtext">Welcome <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][0]['firstname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
                  <td align="right" class="hdrtext"></td>
                </tr>
              </table></td>
              <td class="titleright">&nbsp;</td>
            </tr>
            <tr>
              <td rowspan="2" class="leftbdr">&nbsp;</td>
              <td align="center" valign="top">&nbsp;</td>
              <td rowspan="2" class="rightbdr">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="border">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  		<tr>
							<td class="bordermid"><span class="gridtitle">Title</span></td>
							<td class="bordermid"><span class="gridtitle">Name</span></td>
							<td class="bordermid"><span class="gridtitle">Description</span></td>
							<td class="bordermid"><span class="gridtitle">Date</span></td>
						</tr>
						<!--Product List Content START-->	
						<?php unset($this->_sections['doc']);
$this->_sections['doc']['name'] = 'doc';
$this->_sections['doc']['loop'] = is_array($_loop=$this->_tpl_vars['documentsearchlist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['doc']['show'] = true;
$this->_sections['doc']['max'] = $this->_sections['doc']['loop'];
$this->_sections['doc']['step'] = 1;
$this->_sections['doc']['start'] = $this->_sections['doc']['step'] > 0 ? 0 : $this->_sections['doc']['loop']-1;
if ($this->_sections['doc']['show']) {
    $this->_sections['doc']['total'] = $this->_sections['doc']['loop'];
    if ($this->_sections['doc']['total'] == 0)
        $this->_sections['doc']['show'] = false;
} else
    $this->_sections['doc']['total'] = 0;
if ($this->_sections['doc']['show']):

            for ($this->_sections['doc']['index'] = $this->_sections['doc']['start'], $this->_sections['doc']['iteration'] = 1;
                 $this->_sections['doc']['iteration'] <= $this->_sections['doc']['total'];
                 $this->_sections['doc']['index'] += $this->_sections['doc']['step'], $this->_sections['doc']['iteration']++):
$this->_sections['doc']['rownum'] = $this->_sections['doc']['iteration'];
$this->_sections['doc']['index_prev'] = $this->_sections['doc']['index'] - $this->_sections['doc']['step'];
$this->_sections['doc']['index_next'] = $this->_sections['doc']['index'] + $this->_sections['doc']['step'];
$this->_sections['doc']['first']      = ($this->_sections['doc']['iteration'] == 1);
$this->_sections['doc']['last']       = ($this->_sections['doc']['iteration'] == $this->_sections['doc']['total']);
?>
						<?php if ($this->_sections['doc']['iteration'] % 2 == 0): ?> 
						<?php $this->assign('rowcss', 'gridcolor'); ?>
						<?php else: ?>
						<?php $this->assign('rowcss', ""); ?>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['DocStatus'] != ""): ?>
						<?php if ($this->_tpl_vars['DocStatus'] == $this->_tpl_vars['documentsearchlist'][$this->_sections['doc']['index']]['Status']): ?>
						<tr class="<?php echo $this->_tpl_vars['rowcss']; ?>
"> 
							<td class="tableTd" ><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['documentsearchlist'][$this->_sections['doc']['index']]['documentname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...", false) : smarty_modifier_truncate($_tmp, 40, "...", false)); ?>
</td>
							<td class="tableTd" ><?php echo ((is_array($_tmp=$this->_tpl_vars['documentsearchlist'][$this->_sections['doc']['index']]['doc_OriginalName'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
							<td class="tableTd" ><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['documentsearchlist'][$this->_sections['doc']['index']]['doc_description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 80) : smarty_modifier_truncate($_tmp, 80)); ?>
</td>
							<td class="tableTd" ><?php echo ((is_array($_tmp=$this->_tpl_vars['documentsearchlist'][$this->_sections['doc']['index']]['created_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
						 </tr>
						 <?php endif; ?>	
						 <?php else: ?>
						<tr class="<?php echo $this->_tpl_vars['rowcss']; ?>
"> 
							<td class="tableTd" ><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['documentsearchlist'][$this->_sections['doc']['index']]['documentname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...", false) : smarty_modifier_truncate($_tmp, 40, "...", false)); ?>
</td>
							<td class="tableTd" ><?php echo ((is_array($_tmp=$this->_tpl_vars['documentsearchlist'][$this->_sections['doc']['index']]['doc_OriginalName'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
							<td class="tableTd" ><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['documentsearchlist'][$this->_sections['doc']['index']]['doc_description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 80) : smarty_modifier_truncate($_tmp, 80)); ?>
</td>
							<td class="tableTd" ><?php echo ((is_array($_tmp=$this->_tpl_vars['documentsearchlist'][$this->_sections['doc']['index']]['created_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
						 </tr>
						 <?php endif; ?>
						 <?php endfor; else: ?>
						 <tr class="tableTdOdd" align="center"> 
						 	<td class="tableTd" colspan="5" align="center" style="padding-left:300px;">No Documents Found</td>
						 </tr>
						 <?php endif; ?>
						 <!--Product List Content END-->	
                    </table>
                      </td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class="btmleft"></td>
              <td class="btmmid"></td>
              <td class="btmright"></td>
            </tr>
          </table>	
			</td>
		 </tr>
		</table>
		 </form>
		</td>
		</tr>
	</table>
<!--ProductsListList END-->	