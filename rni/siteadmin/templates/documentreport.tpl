{literal}
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
			if(char==''){
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
  	
	function SendRemainder(Ident) {
		document.frmReport.id.value=Ident;
		document.frmReport.hdAction.value="SendRemainder";
		document.frmReport.submit();
	}
	
	
</script>
{/literal}
<link href="css/Main.css" rel="stylesheet" type="text/css">
<form name="frmReport" method="post">
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
  
  <table width="100%"  border="0">
    <tr>
      <td height="30" valign="top" class="FormHeader" style="padding-left:40px">Document Report List </td>
    </tr>
    <tr>
    
    <td valign="top">
    
<table width="90%"  border="1" cellpadding="0" cellspacing="0" align="center" class="TableBorder" style="border-collapse:collapse">
      <tr class="GridHeader">
        <td width="18%" style="padding-left:5px" nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('username','{$SortType}')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont">Name </span></a></td>
        <td width="18%" style="padding-left:5px" nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('email','{$SortType}')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont"> Documents Assigned </span></a></td>
        <td width="14%" style="padding-left:5px "nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('created_on','{$SortType}')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Documents Read</span> </a></td>
        <td width="14%" style="padding-left:5px "nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('Status','{$SortType}')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Documents Unread</span></a> </td>
        <td class="GridHeader" width="5%">Send Remainder</td>		
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
        <td style="padding-left:5px;">{$UserList[val].firstname|stripslashes} {$UserList[val].lastname|stripslashes} </td>
        <td style="padding-left:5px;">{$UserList[val].documentsAssigned|stripslashes} </td>
        <td style="padding-left:5px;" class="GreenFont">{$UserList[val].readdocumentslist} </td>
        <td style="padding-left:5px;" class="RedFont">{$UserList[val].unreaddocumentslist} </td>
        <td style="padding-left:5px;" nowrap>
			{if $UserList[val].documentsAssigned != "" && $UserList[val].unreaddocumentslist != ""} <img title="Send Remainder" style="cursor:pointer;" onclick="SendRemainder('{$UserList[val].id}');" src="images/email_link.png" /> {/if}
		</td>
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
