<?php /* Smarty version 2.6.9, created on 2008-01-25 13:10:56
         compiled from grouplist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'grouplist.tpl', 259, false),)), $this); ?>
<?php echo '
<script type="text/javascript">
	 function checkAll(val){
		objForm=document.frmGroupList;
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
 
	ptr=document.frmGroupList;
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
				document.frmGroupList.hdAction.value=hAction;
				document.frmGroupList.submit();				 
			}
		}
		return;
  }
  function Edit(Ident){
		document.frmGroupList.id.value=Ident;
		document.frmGroupList.hdAction.value="Edit";
		document.frmGroupList.action = "edit_genre.php";
		document.frmGroupList.submit();				
	}
  function DeleteSelected(Ident){
		if(confirm("Are you sure to delete this Record")){
		document.frmGroupList.id.value=Ident;
		document.frmGroupList.hdAction.value="DeleteSelected";
		document.frmGroupList.submit();
		}
	}
	
  function getCategory(char){
			document.frmGroupList.hSAction.value=char;
			document.frmGroupList.hdAction.value="Search";
			document.frmGroupList.ResetOffset.value="Yes";
			if(char==\'\'){
			document.frmGroupList.char.value="";
				//if(document.frmGroupList.url.value=="")
				document.frmGroupList.action="grouplist.php";
				//else
				//document.frmGroupList.action=document.frmGroupList.url.value;
			}
			document.frmGroupList.submit();
	}
	
  function getCategorySort(name,type1){
			document.frmGroupList.action="grouplist.php?sort="+name+"&type="+type1;
			document.frmGroupList.submit();
   }
   
	function getBroker(){
	if(document.frmGroupList.Broker_Name.value=="")
	{
		alert("Search field should not be empty");
		return false;
	}
		var val=document.frmGroupList.Broker_Name.value;
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
function ShowHideEditGroupFrame(EditGroupFrameId)	{
	if ($(EditGroupFrameId)) {
		if ($(EditGroupFrameId).style.display == "none")
			$(EditGroupFrameId).style.display = "block";
		else
			$(EditGroupFrameId).style.display = "none";
	}
}  

function  AddNewGroup()	{
	if ($("AddGroupFrame")) {
		if ($("AddGroupFrame").style.display == "none")
			$("AddGroupFrame").style.display = "block";
		else
			$("AddGroupFrame").style.display = "none";
	}
}

function SaveAddGroupValues(TextGenre)	{
	if ($("AddGroup").value != "")	{
		GenreId = $(TextGenre).value;
		GenreValue = $(TextGenre).value
		var success = function(t){ SaveEditGroupValuesComplete(t);}
		var failure = function(t){ editFailed(t);}
		var url     =  \'../ajax/documentsystem.php\';
		var pars    = \'op=SaveAddGroup&txt2_id=\'+GenreId+\'&txt2_Value=\'+GenreValue;
		var myAjax  = new Ajax.Request(url, {method:\'post\', postBody:pars, onSuccess:success, onFailure:failure});	
	} else {
		alert("Enter group name");
		$("AddGroup").focus();
	}
}


function SaveEditGroupValues(GenreId,GenreValueId)	{
	GenreValue = $(GenreValueId).value
	var success = function(t){ SaveEditGroupValuesComplete(t);}
	var failure = function(t){ editFailed(t);}
	var url     =  \'../ajax/documentsystem.php\';
	var pars    = \'op=SaveEditGroup&id=\'+GenreId+\'&Value=\'+GenreValue;
	var myAjax  = new Ajax.Request(url, {method:\'post\', postBody:pars, onSuccess:success, onFailure:failure});	
}

function SaveEditGroupValuesComplete(t) {
	window.location.href = \'grouplist.php\';
}

function editFailed(t)	{
	alert("failed");
}

function getVendor(){
	if(document.frmGroupList.Group_Name.value=="")	{
		document.frmGroupList.Group_Name.focus();
		alert("Search field should not be empty");
		return false;
	}
	var val=document.frmGroupList.Group_Name.value;
	getCategory(val,0,\'\',\'\');
   
}

	
	
</script>
'; ?>

<link href="css/Main.css" rel="stylesheet" type="text/css">
<form name="frmGroupList" method="post">
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
		<td align="center" style="padding-top:10px">
			<fieldset style="width:600px">
			<legend class="SearchFont">Search Group</legend>
				<table width="100%"   cellpadding="0" cellspacing="0" border="0">
					<tr> 
						<td  colspan="2" valign="top" class="FormHeader1"  align="center" style="padding-top:10px"><?php echo $this->_tpl_vars['Alphabets']; ?>
</td>
					</tr>
					<tr> 
						<td  valign="top" class="BlackFont" colspan="3" width="50%" style="padding-left:70px;padding-bottom:10px">Group Name:
							<input type="text" name="Group_Name" id="Group_Name" class="txtboxsearch" onkeypress="return checkEnter(event,this.value)">
							<input name="searchVendor" type="button" class="button" value=" Search " onclick="getVendor()">
						</td>
					</tr>
				</table>
			</fieldset>
		</td>
	</tr>
</table>  
  <table width="100%"  border="0">
    <tr>
      <td height="30" valign="top" class="FormHeader" style="padding-left:40px">Group List </td>
    </tr>
    <tr>
      <td width="90%" align="left" style="padding-left:40px" nowrap>
	   <input type="button" name="button" value="Add Group" onclick="AddNewGroup()" class="analysisbutton1">

	   <input type="button" name="button" value="Check All" onclick="checkAll(1)" class="analysisbutton1">
       <input type="button" name="button" value="Clear All" onclick="checkAll(0)" class="analysisbutton1">
       <input type="button" name="button" value="Delete Selected" onclick="deleteSelRecords('Delete')"  class="analysisbutton2">
      </td>
    </tr>
    <tr>
		<td width="90%" align="left" style="padding-left:40px" nowrap>
		<span id="AddGroupFrame" style="display:none;">
			<input type="text" name="AddGroup" id="AddGroup" value="" class="txtbox"  />
			<input type="button" name="SaveGenre" id="SaveGenre" value="Save" onclick="SaveAddGroupValues('AddGroup')" class="analysisbutton1" />
		</span>
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
        <td></td>
      </tr>
      <?php unset($this->_sections['val']);
$this->_sections['val']['name'] = 'val';
$this->_sections['val']['loop'] = is_array($_loop=$this->_tpl_vars['GroupList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	  <?php if ($this->_sections['val']['iteration'] % 2 == 0): ?> <?php $this->assign('ClassName', 'GridCell1'); ?> <?php else: ?> <?php $this->assign('ClassName', 'GridCell2'); ?> <?php endif; ?>
      <tr class="<?php echo $this->_tpl_vars['ClassName']; ?>
">
        <td><input id="chk" name="chk[]" type="checkbox" value="<?php echo $this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['id']; ?>
" /></td>
        <td style="padding-left:5px;" nowrap="nowrap" width="50%"><?php echo ((is_array($_tmp=$this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['Value'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 
				<span id="EditGroupFrame<?php echo $this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['id']; ?>
" style="display:none;">
			<input  class="txtbox" type="text" name="EditGroup<?php echo $this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['id']; ?>
" id="EditGroup<?php echo $this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['id']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['Value'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" />
			<input type="button" name="SaveGenre" class="analysisbutton1" id="SaveGenre" value="Save" onclick="SaveEditGroupValues('<?php echo $this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['id']; ?>
','EditGroup<?php echo $this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['id']; ?>
')" />
		</span>
	</td>
        
        <td style="padding-left:5px;" nowrap width="10%">
		<!--<a href="javascript:Edit('<?php echo $this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['id']; ?>
')" >-->
		<img src="images/button_edit.png" border="none" style="cursor:pointer;" title="Edit Broker List" onclick="ShowHideEditGroupFrame('EditGroupFrame<?php echo $this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['id']; ?>
')">
		<img src="images/button_drop.png" style="cursor:pointer;"  border="none" title="Delete Broker List" onclick="DeleteSelected('<?php echo $this->_tpl_vars['GroupList'][$this->_sections['val']['index']]['id']; ?>
')">
		</td>      	
	  </tr>
	  
      <?php endfor; else: ?>
      <tr>
        <td colspan="6" align="center" height="20" class="ErrorMsg">
        No Group Details Found      </td>      
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