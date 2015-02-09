{literal}
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
			if(char==''){
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
  
	
	
</script>
{/literal}
<link href="css/Main.css" rel="stylesheet" type="text/css">
<form name="frmUserList" method="post">
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
      <td align="center" style="padding-top:10px"><fieldset style="width:600px">
        <legend class="SearchFont">Search Member</legend>
        <table width="100%"   cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td  colspan="2" valign="top" class="FormHeader1"  align="center" style="padding-top:10px">{$Alphabets}</td>
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
        <td width="18%" style="padding-left:5px" nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('username','{$SortType}')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont">Name </span></a></td>
        <td width="18%" style="padding-left:5px" nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('email','{$SortType}')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont"> Email </span></a></td>
        <td width="14%" style="padding-left:5px "nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('created_on','{$SortType}')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Added
          Date</span> </a></td>
        <td width="14%" style="padding-left:5px "nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('Status','{$SortType}')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Status</span></a> </td>
        <td class="GridHeader" width="5%">&nbsp;</td>
      </tr>
      {section name="val" loop=$UserList} {if $smarty.section.val.iteration
      % 2 eq 0} {assign var="ClassName" value="GridCell1"} {else} {assign
      var="ClassName" value="GridCell2"} {/if}
      {if $UserList[val].Status eq "Active"}
      {assign var="StatusFont" value="GreenFont"}
      {elseif $UserList[val].Status eq "Inactive"}
      {assign var="StatusFont" value="RedFont"}
      {else}
      {assign var="StatusFont" value="OrangeFont"}
      {/if}
      <tr class="{$ClassName}">
        <td><input id="chk" name="chk[]" type="checkbox" value="{$UserList[val].id}" /></td>
        <td style="padding-left:5px;">{$UserList[val].firstname|stripslashes} {$UserList[val].lastname|stripslashes} </td>
        <td style="padding-left:5px;">{$UserList[val].email|stripslashes} </td>
        <td style="padding-left:5px;">{$UserList[val].created_on} </td>
        <td style="padding-left:5px;"><font class="{$StatusFont}">{$UserList[val].Status} </font></td>
        <td style="padding-left:5px;" nowrap><a href="javascript:Edit('{$UserList[val].id}')" ><img src="images/button_edit.png" border="none" style="cursor:pointer;" title="Edit Broker List"></a>  <img src="images/button_drop.png" style="cursor:pointer;"  border="none" title="Delete Broker List" onclick="DeleteSelected('{$UserList[val].id}')"></td>
      </tr>
      {sectionelse}
      <tr>
        <td colspan="6" align="center" height="20" class="ErrorMsg">
        No User Details Found      </td>      
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
