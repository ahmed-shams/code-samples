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
				document.frmReport.action="groupwisememberlist.php";
				//else
				//document.frmReport.action=document.frmReport.url.value;
			}
			document.frmReport.submit();
	}
	
  function getCategorySort(name,type1){
			document.frmReport.action="groupwisememberlist.php?sort="+name+"&type="+type1;
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
function ShowHideEventform(title,Value) {
	divwin=dhtmlwindow.open('divbox', 'div', 'Eventdiv', title , 'width=250px,height=200px,left=220px,top=150px,resize=1,scrolling=0'); 
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
</script>
<script language="javascript" src="../javascript/dhtmlwindow.js"></script>
{/literal}
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
      <td height="30" valign="top" class="FormHeader" style="padding-left:40px">Groupwise Member List </td>
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
          {/if}<a onClick="getCategorySort('email','{$SortType}')" style="cursor:pointer" class="WhiteFont" ><span class="WhiteFont"> Email </span></a></td>
        <td width="14%" style="padding-left:5px "nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('created_on','{$SortType}')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Added Date</span> </a></td>
        <td width="14%" style="padding-left:5px "nowrap>{if $type eq "asc"}{assign
          var="SortType" value="desc"} {else}{assign var="SortType" value="asc"}
          {/if}<a onClick="getCategorySort('Status','{$SortType}')" class="WhiteFont" style="cursor:pointer"><span class="WhiteFont">Status</span></a> </td>
      </tr>
      {section name="Grp" loop=$GroupList} {if $smarty.section.val.iteration
      % 2 eq 0} {assign var="ClassName" value="GridCell1"} {else} {assign
      var="ClassName" value="GridCell2"} {/if}
      {if $UserList[val].Status eq "Active"}
      {assign var="StatusFont" value="GreenFont"}
      {elseif $GroupList[val].Status eq "Inactive"}
      {assign var="StatusFont" value="RedFont"}
      {else}
      {assign var="StatusFont" value="OrangeFont"}
      {/if}
	  
      <tr >
        <td colspan="4" style="padding-left:5px;" class="{$ClassName}">
			{if $GroupList[Grp].Userlist[0].id ne ""}
			<span id="plusminus{$GroupList[Grp].id}" onclick="ShowHideGroupUsers('{$GroupList[Grp].id}')" style="cursor:pointer; font-size:18px; font-weight:bolder;">+ </span> <span onclick="ShowHideGroupUsers('{$GroupList[Grp].id}')" style="cursor:pointer; font-size:12px; font-weight:bolder;">{$GroupList[Grp].Value|stripslashes}</span>
			{else}
			<span style="font-size:18px; font-weight:bolder;">-  </span> <span style="font-size:12px; font-weight:bolder;">{$GroupList[Grp].Value|stripslashes}</span>
			{/if}	
				
		</td>
      </tr>
	  <tr>
	  	<td colspan="4">
			<span id="Userlist{$GroupList[Grp].id}" style="display:none; padding-left:12px; ">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			{assign var="UserList" value=$GroupList[Grp].Userlist}
			{section name="usr" loop=$UserList}
			  {if $UserList[usr].Status eq "Active"}
			  {assign var="StatusFont" value="GreenFont"}
			  {elseif $UserList[usr].Status eq "Inactive"}
			  {assign var="StatusFont" value="RedFont"}
			  {else}
			  {assign var="StatusFont" value="OrangeFont"}
			  {/if}
			
			{if $UserList[usr].id ne ""}
			  <tr class="GridCell2" height="25px;">
				<td width="27%" class="OrangeFont">{$UserList[usr].Name}</td>
				<td  width="29%">{$UserList[usr].email|stripslashes}</td>
				<td  width="21%">{$UserList[usr].created_on|stripslashes}</td>
				<td  width="15%"><font class="{$StatusFont}">{$UserList[usr].Status|stripslashes}</font></td>
				<td width="8%" nowrap style="padding-left:5px;"><a href="javascript:Edit('{$UserList[usr].id}')" ><img src="images/button_edit.png" border="none" style="cursor:pointer;" title="Edit Broker List"></a>  <img src="images/button_drop.png" style="cursor:pointer;"  border="none" title="Delete Broker List" onclick="DeleteSelected('{$UserList[usr].id}')"></td>
			  </tr>
			  <tr height="5px;">
			  	<td colspan="5"></td>
			  </tr>
			{/if}
			{/section}
			</table>			
			</span>		
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
