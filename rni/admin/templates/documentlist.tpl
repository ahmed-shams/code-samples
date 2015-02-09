{literal}
<script type="text/javascript">
	 function checkAll(val){
		objForm=document.frmdocumentList;
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
 
	ptr=document.frmdocumentList;
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
				document.frmdocumentList.hdAction.value=hAction;
				document.frmdocumentList.submit();				 
			}
		}
		return;
  }
  function Edit(Ident){
  		window.location.href = 'edit_document.php?id='+Ident;
		/*document.frmdocumentList.id.value=Ident;
		document.frmdocumentList.hdAction.value="Edit";		
		document.frmdocumentList.action = "edit_document.php";
		document.frmdocumentList.submit();	*/			
	}
  function DeleteSelected(Ident){
		if(confirm("Are you sure to delete this Record")){
		document.frmdocumentList.id.value=Ident;
		document.frmdocumentList.hdAction.value="DeleteSelected";
		document.frmdocumentList.submit();
		}
	}
	
  function getCategory(char){
			document.frmdocumentList.hSAction.value=char;
			document.frmdocumentList.hdAction.value="Search";
			document.frmdocumentList.ResetOffset.value="Yes";
			if(char==''){
			document.frmdocumentList.char.value="";
				//if(document.frmdocumentList.url.value=="")
				document.frmdocumentList.action="userlist.php";
				//else
				//document.frmdocumentList.action=document.frmdocumentList.url.value;
			}
			document.frmdocumentList.submit();
	}
	
  function getCategorySort(name,type1){
			document.frmdocumentList.action="documentlist.php?sort="+name+"&type="+type1;
			document.frmdocumentList.submit();
   }
   
	function getBroker(){
	if(document.frmdocumentList.Broker_Name.value=="")
	{
		alert("Search field should not be empty");
		return false;
	}
		var val=document.frmdocumentList.Broker_Name.value;
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
<form name="frmdocumentList" method="post">
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
        <legend class="SearchFont">Search Documents</legend>
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
      <td height="30" valign="top" class="FormHeader" style="padding-left:40px">Documents List </td>
    </tr>
    <tr>
      <td width="95%" align="left" style="padding-left:40px" nowrap><input type="button" name="button" value="Check All" onclick="checkAll(1)" class="analysisbutton1">
         
        <input type="button" name="button" value="Clear All" onclick="checkAll(0)" class="analysisbutton1">
         
        <input type="button" name="button" value="Delete Selected" onclick="deleteSelRecords('Delete')"  class="analysisbutton2">
         
      </td>
    </tr>
    <tr>
    
    <td valign="top">
    
<table width="90%"  border="1" cellpadding="0" cellspacing="0" align="center" class="TableBorder" style="border-collapse:collapse">
      <tr class="GridHeader">
        <td width="2%">&nbsp;</td>
        <td width="18%" style="padding-left:5px" nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('documentname','{$SortType}')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont">Document Name </span></a></td>
        <td width="18%" style="padding-left:5px" nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('doc_OriginalName','{$SortType}')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont"> File Name </span></a></td>
        <td width="14%" style="padding-left:5px "nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('created_on','{$SortType}')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Added
          Date</span> </a></td>
        <td class="GridHeader" width="5%">&nbsp;</td>
      </tr>
      {section name="val" loop=$documentList} 
	  {if $smarty.section.val.iteration  % 2 eq 0} 
	  {assign var="ClassName" value="GridCell1"} {else} 
	  {assign var="ClassName" value="GridCell2"} {/if}
      {if $documentList[val].Status eq "Active"}
      {assign var="StatusFont" value="GreenFont"}
      {elseif $documentList[val].Status eq "Inactive"}
      {assign var="StatusFont" value="RedFont"}
      {else}
      {assign var="StatusFont" value="OrangeFont"}
      {/if}
      <tr class="{$ClassName}">
        <td><input id="chk" name="chk[]" type="checkbox" value="{$documentList[val].id}" /></td>
        <td style="padding-left:5px;">{$documentList[val].documentname|stripslashes} </td>
        <td style="padding-left:5px;">{$documentList[val].doc_OriginalName|stripslashes} </td>
        <td style="padding-left:5px;">{$documentList[val].created_on}</td>
		
        <td style="padding-left:5px;" nowrap>
		<img src="images/download_icon.gif" style="cursor:pointer" onclick="location.href='download.php?id={$documentList[val].id}'" />
		<a href="javascript:Edit('{$documentList[val].id}')" ><img src="images/button_edit.png" border="none" style="cursor:pointer;" title="Edit document"></a> 
		<img src="images/button_drop.png" style="cursor:pointer;"  border="none" title="Delete document List" onclick="DeleteSelected('{$documentList[val].id}')">
		</td>
      </tr>
      {sectionelse}
      <tr>
        <td colspan="6" align="center" height="20" class="ErrorMsg">
        No Document Details Found      </td>      
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
