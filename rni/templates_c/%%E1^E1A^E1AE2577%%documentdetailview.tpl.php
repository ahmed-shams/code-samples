<?php /* Smarty version 2.6.9, created on 2008-01-28 08:03:57
         compiled from documentdetailview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'documentdetailview.tpl', 54, false),array('modifier', 'strip_tags', 'documentdetailview.tpl', 64, false),)), $this); ?>
<?php echo '
<script type="text/javascript" language="javascript">

var DownloadDocument = function (docIdent)	{
	window.location.href="downloaddocuments.php?op=Downloaddoc&docIdent="+docIdent;
}

var UpdateStatus = function () {
	if (document.getElementById("status").checked == true) {
		document.getElementById("txtStatus").value = "Read";
	} else {
		document.getElementById("txtStatus").value = "UnRead";
	}		
}
</script>
'; ?>

<script src="javascript/main.js" language="javascript" type="text/javascript"></script>
<form name="frmdetailedDocview" action="index.php" method="post" enctype="multipart/form-data" >
<input type="hidden" name="op" value="UpdateStatus">
<input type="hidden" name="txtStatus" id="txtStatus" value="" />
<input type="hidden" name="txtid" id="txtid" value="<?php echo $this->_tpl_vars['documentlist'][0]['id']; ?>
" />
<table width="99%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td height="14"></td>
	</tr>
	<?php if ($this->_tpl_vars['strMsg']): ?>
	<tr>
	  <td class="ErrorMsg" align="center"><?php echo $this->_tpl_vars['strMsg']; ?>
</td>
	</tr>
	<tr>
	  <td height="14"></td>
	</tr>
	<?php endif; ?>
	<tr>
	  <td>
	  	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#878787">
		 	<tr>
				<td bgcolor="#878787">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FAFAFA">
						<tr>
							<td>
								<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td colspan="2">
											<table width="96%" border="0" cellspacing="5" cellpadding="1">
												<tr>
													<td colspan="2" align="left"  class="FormHeading">Document Details<span class="orangeFont"></span></td>
												</tr> 
												<tr>
													<td colspan="2" align="center"><div class="ErrorMsg" id="ErrorMsg"></div></td>
												</tr> 
												<tr>
												  <td  width="31%" valign="top" class="RequiredField">Title</td>
												  <td width="56%" class="ListCell" align="left"><span style="background-color:#FAFAFA; border:none;" class="textbox1"><?php echo ((is_array($_tmp=$this->_tpl_vars['documentlist'][0]['documentname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</span></td>
												</tr>
												<tr>
												  <td  width="31%" valign="top" class="RequiredField">Document File</td>
												  <td width="56%" class="ListCell" align="left">
												  	<span style="background-color:#FAFAFA; border:none;" class="textbox1"><?php echo $this->_tpl_vars['documentlist'][0]['doc_OriginalName']; ?>
</span>
													<img src="images/download_icon.gif" style="cursor:pointer; padding-left:12px;" title="download <?php echo $this->_tpl_vars['documentlist'][0]['doc_OriginalName']; ?>
" onclick="DownloadDocument('<?php echo $this->_tpl_vars['documentlist'][0]['id']; ?>
');" />												  </td>
												</tr>
												<tr>
												  <td  width="31%" valign="top" class="RequiredField"><label for="txtRUserName">Description<span class="orangeFont">*</span></label></td>
												  <td width="56%" class="ListCell" align="left"><textarea style="background-color:#FAFAFA; border:none; font-family:Arial, Helvetica, sans-serif;"  name="txt2_doc_description"  cols="65" rows="10" id="txt2_doc_description" ><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['documentlist'][0]['doc_description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</textarea></td>
												</tr>
												<tr>
												  <td  width="31%" valign="top" class="RequiredField">Status</td>
												  <td width="56%" class="ListCell" align="left"> 
												  	<input type="radio" name="status" id="status" value="read" <?php if ($this->_tpl_vars['documentlist'][0]['Status'] == 'Read'): ?> checked="checked" <?php endif; ?>> <span style="background-color:#FAFAFA; border:none;" class="textbox1">Read</span>
													<input type="radio" name="status" id="status" value="unread" <?php if ($this->_tpl_vars['documentlist'][0]['Status'] == 'UnRead'): ?> checked="checked" <?php endif; ?>> <span style="background-color:#FAFAFA; border:none;" class="textbox1">Unread</span>												  </td>
												</tr>
												<tr>
													<td></td>
													<td align="left"><input type="image" src="images/submit.gif" class="ratesubm" onclick="return UpdateStatus();" ></td>													
												</tr> 
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
	</tr>
</table>
</form>