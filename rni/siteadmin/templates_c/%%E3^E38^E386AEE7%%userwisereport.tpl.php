<?php /* Smarty version 2.6.9, created on 2008-02-08 02:59:34
         compiled from userwisereport.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'userwisereport.tpl', 206, false),array('modifier', 'replace', 'userwisereport.tpl', 210, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	 function checkAll(val){
		objForm=document.frmReport;
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
 
	ptr=document.frmReport;
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
				document.frmReport.hdAction.value=hAction;
				document.frmReport.submit();				 
			}
		}
		return;
  }
  function Edit(Ident){
		document.frmReport.id.value=Ident;
		document.frmReport.hdAction.value="Edit";
		document.frmReport.action = "edit_user.php";
		document.frmReport.submit();				
	}
  function DeleteSelected(Ident){
		if(confirm("Are you sure to delete this Record")){
		document.frmReport.id.value=Ident;
		document.frmReport.hdAction.value="DeleteSelected";
		document.frmReport.submit();
		}
	}
	
  function getCategory(char){
			document.frmReport.hSAction.value=char;
			document.frmReport.hdAction.value="Search";
			document.frmReport.ResetOffset.value="Yes";
			if(char==\'\'){
			document.frmReport.char.value="";
				//if(document.frmReport.url.value=="")
				document.frmReport.action="userlist.php";
				//else
				//document.frmReport.action=document.frmReport.url.value;
			}
			document.frmReport.submit();
	}
	
  function getCategorySort(name,type1){
			document.frmReport.action="userlist.php?sort="+name+"&type="+type1;
			document.frmReport.submit();
   }
   
	function getBroker(){
	if(document.frmReport.Broker_Name.value=="")
	{
		alert("Search field should not be empty");
		return false;
	}
		var val=document.frmReport.Broker_Name.value;
		getCategory(val,0,\'\',\'\');
	   
	}
	
	function checkEnter(e,val){ //e is event object passed from function invocation
		var characterCode //literal character code will be stored in this variable
		var character=val;
		characterCode = e.keyCode; //character code is contained in IE\'s keyCode property
		
		if(characterCode == 13){ //if generated character code is equal to ascii 13 (if enter key)
		if(character){
		getCategory(val,0,\'\',\'\');
		}else{
		alert("Search field should not be empty");
		}
		return false;
		}
		return true;
	} 
  	
	function SendRemainder(Ident) {
		document.frmReport.id.value=Ident;
		document.frmReport.hdAction.value="SendRemainder";
		document.frmReport.submit();
	}
function ShowHideEventform(title,Value) {
	divwin=dhtmlwindow.open(\'divbox\', \'div\', \'Eventdiv\', title , \'width=250px,height=200px,left=220px,top=150px,resize=1,scrolling=0\'); 
	if (Value != "")	{
		document.getElementById("txtevent").innerHTML = Value;
	} else {
		document.getElementById("txtevent").innerHTML = "No Documents Found";
	}
	return false;
}

function report() {
	printpagecontent = document.getElementById("Printuserreport").innerHTML;
	var popupWindow = window.open(\'\',null,\'height=500,width=700,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes\');
	var tmp = popupWindow.document;
	tmp.write(\'<html><head><title>Report</title><link href=\\"css/Main.css" rel=\\"stylesheet\\" type=\\"text/css\\">\');
	tmp.write(\'<body><br><br><center>\'+printpagecontent);
	tmp.write(\'</center></body></head></html>\');
	tmp.close();
}

</script>
<script language="javascript" src="../javascript/dhtmlwindow.js"></script>
'; ?>

<link href="css/Main.css" rel="stylesheet" type="text/css">
<link href="css/dhtmlwindow.css" rel="stylesheet" type="text/css">
<div id="Eventdiv" style="display:none">
  <p style="height: 400px; position:absolute;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" style="padding-left:65px;"><strong style="font-family:Arial, Helvetica, sans-serif; color:#990000;">Document(s) List</strong><br />
        <div name="txtevent"  id="txtevent" wrap="soft" STYLE="overflow-x: hidden; overflow-y: scroll; font-family:Arial, Helvetica, sans-serif; font-size:12px;"  ></div></td>
    </tr>
  </table>
  </p>
</div>
<form name="frmReport" method="post">
  <input type="hidden" name="id"  value="<?php echo $this->_tpl_vars['id']; ?>
">
  <input type="hidden" name="hdAction" value="<?php echo $this->_tpl_vars['hdAction']; ?>
">
  <input type="hidden" name="hSAction" value="<?php echo $this->_tpl_vars['char']; ?>
">
  <input type="hidden" name="char" value="<?php echo $this->_tpl_vars['char']; ?>
">
  <input type="hidden" name="url" value="<?php echo $this->_tpl_vars['url']; ?>
">
  <input type="hidden" name="IdentAry" >
  <input type="hidden" name="ResetOffset">
  <?php if ($this->_tpl_vars['Delete'] == 1 || $this->_tpl_vars['Add'] == 1 || $this->_tpl_vars['Edit'] == 1): ?><br>
  <table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" class="NormalFont">
    <tr>
      <td align="center" valign="top"  colspan="3" class="ErrorMsg">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top"  colspan="3" class="ErrorMsg"><?php echo $this->_tpl_vars['strMsg']; ?>
 </td>
    </tr>
  </table>
  <?php endif; ?> <br>
  <table width="100%"  border="0">
    <tr>
      <td height="30" valign="top" class="FormHeader" style="padding-left:40px">Userwise Report List <span style=" cursor:pointer;padding-left:500px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal;" onclick="report()">print <img src="images/print-icon.gif" /></span></td>
	 </tr>
    <tr>
      <td valign="top"><table width="90%"  border="1" cellpadding="0" cellspacing="0" align="center" class="TableBorder" style="border-collapse:collapse">
          <tr class="GridHeader">
            <td width="18%" style="padding-left:5px" nowrap><?php if ($this->_tpl_vars['type'] == 'asc'):  $this->assign('SortType', 'desc'); ?> <?php else:  $this->assign('SortType', 'asc'); ?>
              <?php endif; ?><a onClick="getCategorySort('username','<?php echo $this->_tpl_vars['SortType']; ?>
')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont">Name </span></a></td>
            <td width="18%" style="padding-left:5px" nowrap><?php if ($this->_tpl_vars['type'] == 'asc'):  $this->assign('SortType', 'desc'); ?> <?php else:  $this->assign('SortType', 'asc'); ?>
              <?php endif; ?><a onClick="getCategorySort('email','<?php echo $this->_tpl_vars['SortType']; ?>
')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont"> Documents Assigned </span></a></td>
            <td width="14%" style="padding-left:5px "nowrap><?php if ($this->_tpl_vars['type'] == 'asc'):  $this->assign('SortType', 'desc'); ?> <?php else:  $this->assign('SortType', 'asc'); ?>
              <?php endif; ?><a onClick="getCategorySort('created_on','<?php echo $this->_tpl_vars['SortType']; ?>
')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Documents Read</span> </a></td>
            <td width="14%" style="padding-left:5px "nowrap><?php if ($this->_tpl_vars['type'] == 'asc'):  $this->assign('SortType', 'desc'); ?> <?php else:  $this->assign('SortType', 'asc'); ?>
              <?php endif; ?><a onClick="getCategorySort('Status','<?php echo $this->_tpl_vars['SortType']; ?>
')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Documents Unread</span></a> </td>
            <td class="GridHeader" width="5%">Send Reminder</td>
          </tr>
          <?php unset($this->_sections['val']);
$this->_sections['val']['name'] = 'val';
$this->_sections['val']['loop'] = is_array($_loop=$this->_tpl_vars['UserList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?> <?php if ($this->_sections['val']['iteration'] % 2 == 0): ?> <?php $this->assign('ClassName', 'GridCell1'); ?> <?php else: ?> <?php $this->assign('ClassName', 'GridCell2'); ?> <?php endif; ?>
          <?php if ($this->_tpl_vars['UserList'][$this->_sections['val']['index']]['Status'] == 'Active'): ?>
          <?php $this->assign('StatusFont', 'GreenFont'); ?>
          <?php elseif ($this->_tpl_vars['UserList'][$this->_sections['val']['index']]['Status'] == 'Inactive'): ?>
          <?php $this->assign('StatusFont', 'RedFont'); ?>
          <?php else: ?>
          <?php $this->assign('StatusFont', 'OrangeFont'); ?>
          <?php endif; ?>
          <tr >
            <td style="padding-left:5px;" class="<?php echo $this->_tpl_vars['ClassName']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['firstname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['lastname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 </td>
            <td style="padding-left:5px;" align="center"><img title="View <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['firstname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 Assigned documents" src="images/user-assigned.gif" onclick="ShowHideEventform('<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['firstname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 Assigned documents','<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['documentsAssigned'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
')" />  </td>
            <td style="padding-left:5px;" align="center"><img src="images/user-read.gif" title="View <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['firstname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 read documents"  onclick="ShowHideEventform('<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['firstname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 read documents','<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['readdocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
')" />  </td>
            <td style="padding-left:5px;" align="center"><img src="images/user-unread.gif" title="View <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['firstname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 unread documents" onclick="ShowHideEventform('<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['documentname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 unread documents','<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['unreaddocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
')" /> </td>
            <td style="padding-left:5px;" nowrap align="center"> <?php if (((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['documentsAssigned'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<br>
              ", "") : smarty_modifier_replace($_tmp, "<br>
              ", "")) != "" && ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['unreaddocumentslist'])) ? $this->_run_mod_handler('replace', true, $_tmp, "<br>
              ", "") : smarty_modifier_replace($_tmp, "<br>
              ", "")) != ""): ?> <img title="Send Remainder" style="cursor:pointer;" onclick="SendRemainder('<?php echo $this->_tpl_vars['UserList'][$this->_sections['val']['index']]['id']; ?>
');" src="images/email_link.png" /> <?php else: ?> <?php endif; ?> </td>
          </tr>
          <?php endfor; else: ?>
          <tr>
            <td colspan="6" align="center" height="20" class="ErrorMsg"> No User Details Found </td>
          </tr>
          <?php endif; ?>
          <tr bgcolor="#FFFFFF" >
            <td height="20" colspan="6" align="left" class="GridFooter" style="padding-left:5px"><span class="WhiteFont"><?php echo $this->_tpl_vars['printperpage']; ?>
</span></td>
          </tr>
        </table></td>
    </tr>
	<tr>
      <td>	  
	  <div id="Printuserreport" style="display:none;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	  	<td class="printFormHeader" align="left" >User Report</td>
	  	<td  align="right"><span style="cursor:pointer;" onclick="window.print()">Print <img src="images/print-icon.gif" /></span></td>
	  </tr> 	
		  <tr>
			<td colspan="2">
<table width="100%"  border="1" cellspacing="2" cellpadding="0" class="bdr" >	 
	  	<tr height="28px;">
			<td width="14%" class="NameHeadertxt"><strong>User Name</strong></td>
			<td width="28%"><font class="Orangefnt" size="18">Assigned Docuemnts List</font></td>
			<td width="22%"><font class="greenfnt" size="+8">Read Docuemnts List</font></td>
			<td width="36%"><font class="redfnt" size="+8">Unread Docuemnts List</font></td>
		</tr>
	   <?php unset($this->_sections['val']);
$this->_sections['val']['name'] = 'val';
$this->_sections['val']['loop'] = is_array($_loop=$this->_tpl_vars['UserList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          <tr>
		  	<td width="14%" nowrap="nowrap"><font class="Nametxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['firstname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['lastname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</font></td>
			<td width="28%"><font class="Orangefnttxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['documentsAssigned'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</font></td>
			<td width="22%"><font class="greenfnttxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['readdocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</font></td>
			<td width="36%"><font class="redfnttxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['unreaddocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</font></td>
          </tr>
		  <?php endfor; endif; ?>
        </table>
			</td>
		  </tr>		  
		</table>
	  
	  		
		</div>
		</td>
    </tr>
  </table>
</form>