<?php /* Smarty version 2.6.9, created on 2008-02-08 02:55:14
         compiled from groupwisereport.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'groupwisereport.tpl', 236, false),)), $this); ?>
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

function ShowHideGroupUsers(GrpIdent) {
	if (document.getElementById("Userlist"+GrpIdent).style.display == "none") {
		document.getElementById("Userlist"+GrpIdent).style.display = "block";
		document.getElementById("plusminus"+GrpIdent).innerHTML = "-";
	} else {
		document.getElementById("Userlist"+GrpIdent).style.display = "none";
		document.getElementById("plusminus"+GrpIdent).innerHTML = "+";
	}
}

function report(Name,DocumentsAssigned,readDocuments,unreadDocuments) {
	var popupWindow = window.open(\'\',null,\'height=500,width=700,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes\');
	var tmp = popupWindow.document;
	tmp.write(\'<html><head><title>\'+Name+\'- Report</title><link href=\\"css/Main.css" rel=\\"stylesheet\\" type=\\"text/css\\">\');
	tmp.write(\'<body><br><br><center><table width=\\"100%\\" height=\\"60%\\"  border=\\"0\\" cellspacing=\\"0\\" cellpadding=\\"0\\" class=\\"bdr\\"><tr height=\\"25px\\"><td><font class=\\"printFormHeader\\">\'+Name+\' Document List</font><span style=\\"padding-left:350px\\"> <span style=\\"cursor:pointer\\" onclick=\\"window.print()\\">Print</span> <img src=\\"images/print-icon.gif\\" style=\\"cursor:pointer\\" onclick=\\"window.print()\\"></span></td></tr><tr height=\\"25px\\"><td><font class=\\"Orangefnt\\" size=\\"18\\">Assigned Docuemnts List<br></font></td></tr><tr><td valign=\\"top\\" style=\\"padding-left:10px\\"><font class=\\"Orangefnttxt\\">\'+DocumentsAssigned+\'</font></td></tr><tr height=\\"25px\\"><td><font class=\\"greenfnt\\" size=\\"+8\\">Read Docuemnts List</font></td></tr><tr><td valign=\\"top\\" style=\\"padding-left:10px\\"><font class=\\"greenfnttxt\\">\'+readDocuments+\'</font></td></tr><tr height=\\"25px\\"><td><font class=\\"redfnt\\" size=\\"+8\\">Unread Docuemnts List</font></td></tr><tr><td valign=\\"top\\" style=\\"padding-left:10px\\"><font class=\\"redfnttxt\\">\'+unreadDocuments+\'</font></td></tr></table>\');
	tmp.write(\'</center></body></head></html>\');
	tmp.close();
}

function groupreport() {
	printpagecontent = document.getElementById("Printgroupreport").innerHTML;
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
	<td align="left" style="padding-left:65px;">
		<strong style="font-family:Arial, Helvetica, sans-serif; color:#990000;">Document(s) List</strong><br />
		<div name="txtevent"  id="txtevent" wrap="soft" STYLE="overflow-x: hidden; overflow-y: scroll; font-family:Arial, Helvetica, sans-serif; font-size:12px;"  ></div>	
	</td>
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
      <td height="30" valign="top" class="FormHeader" style="padding-left:40px">Groupwise Report List  <span style=" cursor:pointer;padding-left:500px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal;" onclick="groupreport()">print <img src="images/print-icon.gif" /></span></td>
    </tr>
    <tr>
    
    <td valign="top" style="padding-left:10px;">  
    
<table width="100%"  border="1" cellpadding="0" cellspacing="0" align="center" class="TableBorder" style="border-collapse:collapse">
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
        <td width="10%" style="padding-left:5px "nowrap><?php if ($this->_tpl_vars['type'] == 'asc'):  $this->assign('SortType', 'desc'); ?> <?php else:  $this->assign('SortType', 'asc'); ?>
          <?php endif; ?><a onClick="getCategorySort('Status','<?php echo $this->_tpl_vars['SortType']; ?>
')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Documents Unread</span></a> </td>
		  <td width="4%" class="WhiteFont" style="cursor:pointer">Print</td>
      </tr>
      <?php unset($this->_sections['Grp']);
$this->_sections['Grp']['name'] = 'Grp';
$this->_sections['Grp']['loop'] = is_array($_loop=$this->_tpl_vars['GroupList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Grp']['show'] = true;
$this->_sections['Grp']['max'] = $this->_sections['Grp']['loop'];
$this->_sections['Grp']['step'] = 1;
$this->_sections['Grp']['start'] = $this->_sections['Grp']['step'] > 0 ? 0 : $this->_sections['Grp']['loop']-1;
if ($this->_sections['Grp']['show']) {
    $this->_sections['Grp']['total'] = $this->_sections['Grp']['loop'];
    if ($this->_sections['Grp']['total'] == 0)
        $this->_sections['Grp']['show'] = false;
} else
    $this->_sections['Grp']['total'] = 0;
if ($this->_sections['Grp']['show']):

            for ($this->_sections['Grp']['index'] = $this->_sections['Grp']['start'], $this->_sections['Grp']['iteration'] = 1;
                 $this->_sections['Grp']['iteration'] <= $this->_sections['Grp']['total'];
                 $this->_sections['Grp']['index'] += $this->_sections['Grp']['step'], $this->_sections['Grp']['iteration']++):
$this->_sections['Grp']['rownum'] = $this->_sections['Grp']['iteration'];
$this->_sections['Grp']['index_prev'] = $this->_sections['Grp']['index'] - $this->_sections['Grp']['step'];
$this->_sections['Grp']['index_next'] = $this->_sections['Grp']['index'] + $this->_sections['Grp']['step'];
$this->_sections['Grp']['first']      = ($this->_sections['Grp']['iteration'] == 1);
$this->_sections['Grp']['last']       = ($this->_sections['Grp']['iteration'] == $this->_sections['Grp']['total']);
?> <?php if ($this->_sections['val']['iteration'] % 2 == 0): ?> <?php $this->assign('ClassName', 'GridCell1'); ?> <?php else: ?> <?php $this->assign('ClassName', 'GridCell2'); ?> <?php endif; ?>
      <?php if ($this->_tpl_vars['UserList'][$this->_sections['val']['index']]['Status'] == 'Active'): ?>
      <?php $this->assign('StatusFont', 'GreenFont'); ?>
      <?php elseif ($this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['Status'] == 'Inactive'): ?>
      <?php $this->assign('StatusFont', 'RedFont'); ?>
      <?php else: ?>
      <?php $this->assign('StatusFont', 'OrangeFont'); ?>
      <?php endif; ?>
	  
      <tr >
        <td colspan="5" style="padding-left:5px;" class="<?php echo $this->_tpl_vars['ClassName']; ?>
">
			<?php if ($this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['Userlist'][0]['Name'] != ""): ?>
			<span id="plusminus<?php echo $this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['id']; ?>
" onclick="ShowHideGroupUsers('<?php echo $this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['id']; ?>
')" style="cursor:pointer; font-size:18px; font-weight:bolder;">+ </span> <span onclick="ShowHideGroupUsers('<?php echo $this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['id']; ?>
')" style="cursor:pointer; font-size:12px; font-weight:bolder;"><?php echo ((is_array($_tmp=$this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['Value'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</span>
			<?php else: ?>
			<span style="font-size:18px; font-weight:bolder;">-  </span> <span style="font-size:12px; font-weight:bolder;"><?php echo ((is_array($_tmp=$this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['Value'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</span>
			<?php endif; ?>	
				
		</td>
      </tr>
	  <tr>
	  	<td colspan="5">
			<span id="Userlist<?php echo $this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['id']; ?>
" style="display:none; padding-left:12px; ">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<?php $this->assign('UserList', $this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['Userlist']); ?>
			<?php unset($this->_sections['usr']);
$this->_sections['usr']['name'] = 'usr';
$this->_sections['usr']['loop'] = is_array($_loop=$this->_tpl_vars['UserList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['usr']['show'] = true;
$this->_sections['usr']['max'] = $this->_sections['usr']['loop'];
$this->_sections['usr']['step'] = 1;
$this->_sections['usr']['start'] = $this->_sections['usr']['step'] > 0 ? 0 : $this->_sections['usr']['loop']-1;
if ($this->_sections['usr']['show']) {
    $this->_sections['usr']['total'] = $this->_sections['usr']['loop'];
    if ($this->_sections['usr']['total'] == 0)
        $this->_sections['usr']['show'] = false;
} else
    $this->_sections['usr']['total'] = 0;
if ($this->_sections['usr']['show']):

            for ($this->_sections['usr']['index'] = $this->_sections['usr']['start'], $this->_sections['usr']['iteration'] = 1;
                 $this->_sections['usr']['iteration'] <= $this->_sections['usr']['total'];
                 $this->_sections['usr']['index'] += $this->_sections['usr']['step'], $this->_sections['usr']['iteration']++):
$this->_sections['usr']['rownum'] = $this->_sections['usr']['iteration'];
$this->_sections['usr']['index_prev'] = $this->_sections['usr']['index'] - $this->_sections['usr']['step'];
$this->_sections['usr']['index_next'] = $this->_sections['usr']['index'] + $this->_sections['usr']['step'];
$this->_sections['usr']['first']      = ($this->_sections['usr']['iteration'] == 1);
$this->_sections['usr']['last']       = ($this->_sections['usr']['iteration'] == $this->_sections['usr']['total']);
?>
			<?php if ($this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'] != ""): ?>
			  <tr>
				<td width="31%" class="RedFont"><?php echo $this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name']; ?>
</td>
				<td width="29%"><img title="View <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 Assigned documents" src="images/user-assigned.gif" style="cursor:pointer;" onclick="ShowHideEventform('<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 Assigned documents','<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['documentsAssigned'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
')"  /></td>
				<td width="22%"><img title="View <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 read documents" src="images/user-read.gif" style="cursor:pointer;" onclick="ShowHideEventform('<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 read documents','<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['readdocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
')"/></td>
				<td width="12%"><img title="View <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 unread documents" src="images/user-unread.gif" style="cursor:pointer;" onclick="ShowHideEventform('<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 unread documents','<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['unreaddocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
')" /></td>
				<td width="6%"><img title="Print <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 documents" src="images/print-icon.gif" style="cursor:pointer;" onclick="report('<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
','<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['documentsAssigned'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
','<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['readdocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
','<?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['unreaddocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
')" /></td>				
			  </tr>
			  <tr height="5px;">
			  	<td colspan="5"></td>
			  </tr>
			<?php endif; ?>
			<?php endfor; endif; ?>
			</table>			
			</span>		
		</td>
	  </tr>
      <?php endfor; else: ?>
      <tr>
        <td colspan="6" align="center" height="20" class="ErrorMsg">
        No User Details Found      </td>      
      </tr>     
      <?php endif; ?>
      <tr bgcolor="#FFFFFF" >
        <td height="20" colspan="6" align="left" class="GridFooter" style="padding-left:5px"><span class="WhiteFont"><?php echo $this->_tpl_vars['printperpage']; ?>
</span></td>
      </tr>
    </table>
    </td>    
    </tr>  
	
	<tr>
      <td>	  
	  <div id="Printgroupreport" style="display:none;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	  	<td class="printFormHeader" align="left">Group Report</td>
	  	<td  align="right"><span style="cursor:pointer;" onclick="window.print()">Print <img src="images/print-icon.gif" /></span></td>
	  </tr> 	
		  <tr >
		  	<td colspan="2" >
<table width="98%"  border="0" cellspacing="0" cellpadding="0" class="bdr" align="center">	 
	  	<tr height="28px;">
			<td width="13%" class="NameHeadertxt" nowrap="nowrap"><strong>Group Name</strong></td>
			<td width="13%" class="NameHeadertxt" nowrap="nowrap"><strong>User Name</strong></td>			
			<td><font class="Orangefnt" size="18">Documents Assigned</font></td>
			<td><font class="greenfnt" size="+8">Documents Read</font></td>
			<td><font class="redfnt" size="+8">Documents Unread</font></td>
		</tr>
		<?php unset($this->_sections['Grp']);
$this->_sections['Grp']['name'] = 'Grp';
$this->_sections['Grp']['loop'] = is_array($_loop=$this->_tpl_vars['GroupList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Grp']['show'] = true;
$this->_sections['Grp']['max'] = $this->_sections['Grp']['loop'];
$this->_sections['Grp']['step'] = 1;
$this->_sections['Grp']['start'] = $this->_sections['Grp']['step'] > 0 ? 0 : $this->_sections['Grp']['loop']-1;
if ($this->_sections['Grp']['show']) {
    $this->_sections['Grp']['total'] = $this->_sections['Grp']['loop'];
    if ($this->_sections['Grp']['total'] == 0)
        $this->_sections['Grp']['show'] = false;
} else
    $this->_sections['Grp']['total'] = 0;
if ($this->_sections['Grp']['show']):

            for ($this->_sections['Grp']['index'] = $this->_sections['Grp']['start'], $this->_sections['Grp']['iteration'] = 1;
                 $this->_sections['Grp']['iteration'] <= $this->_sections['Grp']['total'];
                 $this->_sections['Grp']['index'] += $this->_sections['Grp']['step'], $this->_sections['Grp']['iteration']++):
$this->_sections['Grp']['rownum'] = $this->_sections['Grp']['iteration'];
$this->_sections['Grp']['index_prev'] = $this->_sections['Grp']['index'] - $this->_sections['Grp']['step'];
$this->_sections['Grp']['index_next'] = $this->_sections['Grp']['index'] + $this->_sections['Grp']['step'];
$this->_sections['Grp']['first']      = ($this->_sections['Grp']['iteration'] == 1);
$this->_sections['Grp']['last']       = ($this->_sections['Grp']['iteration'] == $this->_sections['Grp']['total']);
?>
		<?php if ($this->_sections['Grp']['iteration'] % 2 == 0): ?>
		<?php $this->assign('bgcolor', "#ECF5FB"); ?>
		<?php else: ?>
		<?php $this->assign('bgcolor', "#E4ECF6"); ?>
		<?php endif; ?>
	  	<tr bgcolor="<?php echo $this->_tpl_vars['bgcolor']; ?>
" style="border-bottom:#006699;">
			<td width="10%" class="Nametxt" ><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['Value'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 </strong></td>
			<td colspan="4">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
					<?php $this->assign('UserList', $this->_tpl_vars['GroupList'][$this->_sections['Grp']['index']]['Userlist']); ?>
					<?php unset($this->_sections['usr']);
$this->_sections['usr']['name'] = 'usr';
$this->_sections['usr']['loop'] = is_array($_loop=$this->_tpl_vars['UserList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['usr']['show'] = true;
$this->_sections['usr']['max'] = $this->_sections['usr']['loop'];
$this->_sections['usr']['step'] = 1;
$this->_sections['usr']['start'] = $this->_sections['usr']['step'] > 0 ? 0 : $this->_sections['usr']['loop']-1;
if ($this->_sections['usr']['show']) {
    $this->_sections['usr']['total'] = $this->_sections['usr']['loop'];
    if ($this->_sections['usr']['total'] == 0)
        $this->_sections['usr']['show'] = false;
} else
    $this->_sections['usr']['total'] = 0;
if ($this->_sections['usr']['show']):

            for ($this->_sections['usr']['index'] = $this->_sections['usr']['start'], $this->_sections['usr']['iteration'] = 1;
                 $this->_sections['usr']['iteration'] <= $this->_sections['usr']['total'];
                 $this->_sections['usr']['index'] += $this->_sections['usr']['step'], $this->_sections['usr']['iteration']++):
$this->_sections['usr']['rownum'] = $this->_sections['usr']['iteration'];
$this->_sections['usr']['index_prev'] = $this->_sections['usr']['index'] - $this->_sections['usr']['step'];
$this->_sections['usr']['index_next'] = $this->_sections['usr']['index'] + $this->_sections['usr']['step'];
$this->_sections['usr']['first']      = ($this->_sections['usr']['iteration'] == 1);
$this->_sections['usr']['last']       = ($this->_sections['usr']['iteration'] == $this->_sections['usr']['total']);
?>
					<?php if ($this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name'] != ""): ?>					
					<!-- section here to list all users -->
					<tr >
						<td width="13%" class="Nametxt" style="border-bottom:1px solid #ECE9D8;" ><strong><?php echo $this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['Name']; ?>
</strong></td>
						<td width="29%" style="border-bottom:1px solid #ECE9D8;">
							<table>
								<!-- section here to list all documents under the user -->
								<tr>
									<td><font class="Orangefnttxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['documentsAssigned'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</font></td>
								</tr>
							</table>
						</td>
						<td width="29%" style="border-bottom:1px solid #ECE9D8;">
							<table>
								<!-- section here to list all documents under the user -->
								<tr>
									<td><font class="greenfnttxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['readdocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</font></td>
								</tr>
							</table>
						</td>
						<td width="29%" style="border-bottom:1px solid #ECE9D8;">
							<table>
								<!-- section here to list all documents under the user -->
								<tr>
									<td><font class="redfnttxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['usr']['index']]['unreaddocumentslist'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</font></td>
								</tr>
							</table>
						</td>
					</tr>
					<?php else: ?>
					<tr><td colspan="4" width="700" align="center" class="Orangefnttxt">No Users Found</td></tr>
					<?php endif; ?>
					<?php endfor; endif; ?>						
				</table>
			</td>	
		</tr>
		<?php endfor; endif; ?>
        </table>			</td>
		  </tr>
		</table>
	  
	  	
		</div>	
		</td>
    </tr>
  </table>
</form>