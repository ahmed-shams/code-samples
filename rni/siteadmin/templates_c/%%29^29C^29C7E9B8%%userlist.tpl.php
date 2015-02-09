<?php /* Smarty version 2.6.9, created on 2008-01-25 13:10:52
         compiled from userlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'userlist.tpl', 210, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	 function checkAll(val){
		objForm=document.frmUserList;
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
 
	ptr=document.frmUserList;
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
				document.frmUserList.hdAction.value=hAction;
				document.frmUserList.submit();				 
			}
		}
		return;
  }
  function Edit(Ident){
		document.frmUserList.id.value=Ident;
		document.frmUserList.hdAction.value="Edit";
		document.frmUserList.action = "edit_user.php";
		document.frmUserList.submit();				
	}
  function DeleteSelected(Ident){
		if(confirm("Are you sure to delete this Record")){
		document.frmUserList.id.value=Ident;
		document.frmUserList.hdAction.value="DeleteSelected";
		document.frmUserList.submit();
		}
	}
	
  function getCategory(char){
			document.frmUserList.hSAction.value=char;
			document.frmUserList.hdAction.value="Search";
			document.frmUserList.ResetOffset.value="Yes";
			if(char==\'\'){
			document.frmUserList.char.value="";
				//if(document.frmUserList.url.value=="")
				document.frmUserList.action="userlist.php";
				//else
				//document.frmUserList.action=document.frmUserList.url.value;
			}
			document.frmUserList.submit();
	}
	
  function getCategorySort(name,type1){
			document.frmUserList.action="userlist.php?sort="+name+"&type="+type1;
			document.frmUserList.submit();
   }
   
	function getBroker(){
	if(document.frmUserList.Broker_Name.value=="")
	{
		alert("Search field should not be empty");
		return false;
	}
		var val=document.frmUserList.Broker_Name.value;
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
  
	
	
</script>
'; ?>

<link href="css/Main.css" rel="stylesheet" type="text/css">
<form name="frmUserList" method="post">
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
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" style="padding-top:10px"><fieldset style="width:600px">
        <legend class="SearchFont">Search Member</legend>
        <table width="100%"   cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td  colspan="2" valign="top" class="FormHeader1"  align="center" style="padding-top:10px"><?php echo $this->_tpl_vars['Alphabets']; ?>
</td>
          </tr>
          <tr>
            <td  valign="top" class="BlackFont" colspan="3" width="50%"  align="center" style="padding-left:10px;padding-bottom:10px">Name:
              <input type="text" name="Broker_Name" id="Broker_Name" class="txtboxsearch" onkeypress="return checkEnter(event,this.value)">
              <input name="searchBroker" type="button" class="button" value=" Search " onclick="getBroker()">
            </td>
          </tr>
        </table>
        </fieldset></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="100%"  border="0">
    <tr>
      <td height="30" valign="top" class="FormHeader" style="padding-left:40px">Member List </td>
    </tr>
    <tr>
      <td width="95%" align="left" style="padding-left:40px" nowrap><input type="button" name="button" value="Check All" onclick="checkAll(1)" class="analysisbutton1">
         
        <input type="button" name="button" value="Clear All" onclick="checkAll(0)" class="analysisbutton1">
         
        <input type="button" name="button" value="Delete Selected" onclick="deleteSelRecords('Delete')"  class="analysisbutton2">
         
        <input type="button" name="button" value="Activate" onclick="deleteSelRecords('Active')"  class="analysisbutton1">
         
        <input type="button" name="button" value="DeActivate" onclick="deleteSelRecords('Inactive')"  class="analysisbutton1">
      </td>
    </tr>
    <tr>
    
    <td valign="top">
    
<table width="90%"  border="1" cellpadding="0" cellspacing="0" align="center" class="TableBorder" style="border-collapse:collapse">
      <tr class="GridHeader">
        <td width="2%">&nbsp;</td>
        <td width="18%" style="padding-left:5px" nowrap><?php if ($this->_tpl_vars['type'] == 'asc'):  $this->assign('SortType', 'desc'); ?> <?php else:  $this->assign('SortType', 'asc'); ?>
          <?php endif; ?><a onClick="getCategorySort('username','<?php echo $this->_tpl_vars['SortType']; ?>
')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont">Name </span></a></td>
        <td width="18%" style="padding-left:5px" nowrap><?php if ($this->_tpl_vars['type'] == 'asc'):  $this->assign('SortType', 'desc'); ?> <?php else:  $this->assign('SortType', 'asc'); ?>
          <?php endif; ?><a onClick="getCategorySort('email','<?php echo $this->_tpl_vars['SortType']; ?>
')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont"> Email </span></a></td>
        <td width="14%" style="padding-left:5px "nowrap><?php if ($this->_tpl_vars['type'] == 'asc'):  $this->assign('SortType', 'desc'); ?> <?php else:  $this->assign('SortType', 'asc'); ?>
          <?php endif; ?><a onClick="getCategorySort('created_on','<?php echo $this->_tpl_vars['SortType']; ?>
')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Added
          Date</span> </a></td>
        <td width="14%" style="padding-left:5px "nowrap><?php if ($this->_tpl_vars['type'] == 'asc'):  $this->assign('SortType', 'desc'); ?> <?php else:  $this->assign('SortType', 'asc'); ?>
          <?php endif; ?><a onClick="getCategorySort('Status','<?php echo $this->_tpl_vars['SortType']; ?>
')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Status</span></a> </td>
        <td class="GridHeader" width="5%">&nbsp;</td>
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
      <tr class="<?php echo $this->_tpl_vars['ClassName']; ?>
">
        <td><input id="chk" name="chk[]" type="checkbox" value="<?php echo $this->_tpl_vars['UserList'][$this->_sections['val']['index']]['id']; ?>
" /></td>
        <td style="padding-left:5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['firstname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['lastname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 </td>
        <td style="padding-left:5px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['UserList'][$this->_sections['val']['index']]['email'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 </td>
        <td style="padding-left:5px;"><?php echo $this->_tpl_vars['UserList'][$this->_sections['val']['index']]['created_on']; ?>
 </td>
        <td style="padding-left:5px;"><font class="<?php echo $this->_tpl_vars['StatusFont']; ?>
"><?php echo $this->_tpl_vars['UserList'][$this->_sections['val']['index']]['Status']; ?>
 </font></td>
        <td style="padding-left:5px;" nowrap><a href="javascript:Edit('<?php echo $this->_tpl_vars['UserList'][$this->_sections['val']['index']]['id']; ?>
')" ><img src="images/button_edit.png" border="none" style="cursor:pointer;" title="Edit Broker List"></a>  <img src="images/button_drop.png" style="cursor:pointer;"  border="none" title="Delete Broker List" onclick="DeleteSelected('<?php echo $this->_tpl_vars['UserList'][$this->_sections['val']['index']]['id']; ?>
')"></td>
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
    
  </table>
</form>