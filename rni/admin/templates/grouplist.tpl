{literal}
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
			if(char==''){
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
		getCategory(val,0,'','');
	   
	}
	
	function checkEnter(e,val){ //e is event object passed from function invocation
		var characterCode //literal character code will be stored in this variable
		var character=val;
		characterCode = e.keyCode; //character code is contained in IE's keyCode property
		
		if(characterCode == 13){ //if generated character code is equal to ascii 13 (if enter key)
		if(character){
		getCategory(val,0,'','');
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
		var url     =  '../ajax/documentsystem.php';
		var pars    = 'op=SaveAddGroup&txt2_id='+GenreId+'&txt2_Value='+GenreValue;
		var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
	} else {
		alert("Enter group name");
		$("AddGroup").focus();
	}
}


function SaveEditGroupValues(GenreId,GenreValueId)	{
	GenreValue = $(GenreValueId).value
	var success = function(t){ SaveEditGroupValuesComplete(t);}
	var failure = function(t){ editFailed(t);}
	var url     =  '../ajax/documentsystem.php';
	var pars    = 'op=SaveEditGroup&id='+GenreId+'&Value='+GenreValue;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function SaveEditGroupValuesComplete(t) {
	window.location.href = 'grouplist.php';
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
	getCategory(val,0,'','');
   
}

	
	
</script>
{/literal}
<link href="css/Main.css" rel="stylesheet" type="text/css">
<form name="frmGroupList" method="post">
  <input type="hidden" name="id"  value="{$id}">
  <input type="hidden" name="hdAction" value="{$hdAction}">
  <input type="hidden" name="hSAction" value="{$char}">
  <input type="hidden" name="char" value="{$char}">
  <input type="hidden" name="url" value="{$url}">
  <input type="hidden" name="IdentAry" >
  <input type="hidden" name="ResetOffset">
  {if $Delete eq 1 || $Add eq 1 || $Edit eq 1}<br>
  <table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" class="NormalFont">
    <tr>
      <td align="center" valign="top"  colspan="3" class="ErrorMsg">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top"  colspan="3" class="ErrorMsg">{$strMsg} </td>
    </tr>
  </table>
  {/if} <br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" style="padding-top:10px">
			<fieldset style="width:600px">
			<legend class="SearchFont">Search Group</legend>
				<table width="100%"   cellpadding="0" cellspacing="0" border="0">
					<tr> 
						<td  colspan="2" valign="top" class="FormHeader1"  align="center" style="padding-top:10px">{$Alphabets}</td>
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
        <td width="18%" style="padding-left:5px" nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('username','{$SortType}')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont">Name </span></a></td>
        <td></td>
      </tr>
      {section name="val" loop=$GroupList} 
	  {if $smarty.section.val.iteration
      % 2 eq 0} {assign var="ClassName" value="GridCell1"} {else} {assign
      var="ClassName" value="GridCell2"} {/if}
      <tr class="{$ClassName}">
        <td><input id="chk" name="chk[]" type="checkbox" value="{$GroupList[val].id}" /></td>
        <td style="padding-left:5px;" nowrap="nowrap" width="50%">{$GroupList[val].Value|stripslashes} 
				<span id="EditGroupFrame{$GroupList[val].id}" style="display:none;">
			<input  class="txtbox" type="text" name="EditGroup{$GroupList[val].id}" id="EditGroup{$GroupList[val].id}" value="{$GroupList[val].Value|stripslashes}" />
			<input type="button" name="SaveGenre" class="analysisbutton1" id="SaveGenre" value="Save" onclick="SaveEditGroupValues('{$GroupList[val].id}','EditGroup{$GroupList[val].id}')" />
		</span>
	</td>
        
        <td style="padding-left:5px;" nowrap width="10%">
		<!--<a href="javascript:Edit('{$GroupList[val].id}')" >-->
		<img src="images/button_edit.png" border="none" style="cursor:pointer;" title="Edit Broker List" onclick="ShowHideEditGroupFrame('EditGroupFrame{$GroupList[val].id}')">
		<img src="images/button_drop.png" style="cursor:pointer;"  border="none" title="Delete Broker List" onclick="DeleteSelected('{$GroupList[val].id}')">
		</td>      	
	  </tr>
	  
      {sectionelse}
      <tr>
        <td colspan="6" align="center" height="20" class="ErrorMsg">
        No Group Details Found      </td>      
      </tr>     
      {/section}
      <tr bgcolor="#FFFFFF" >
        <td height="20" colspan="6" align="left" class="GridFooter" style="padding-left:5px"><span class="WhiteFont">{$printperpage}</span></td>
      </tr>
    </table>
    </td>
    
    </tr>
    
  </table>
</form>
