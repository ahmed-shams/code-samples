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

function report(Name,DocumentsAssigned,readDocuments,unreadDocuments) {
	var popupWindow = window.open('',null,'height=500,width=700,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes');
	var tmp = popupWindow.document;
	tmp.write('<html><head><title>'+Name+'- Report</title><link href=\"css/Main.css" rel=\"stylesheet\" type=\"text/css\">');
	tmp.write('<body><br><br><center><table width=\"100%\" height=\"60%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"bdr\"><tr height=\"25px\"><td><font class=\"printFormHeader\">'+Name+' Document List</font><span style=\"padding-left:350px\"> <span style=\"cursor:pointer\" onclick=\"window.print()\">Print</span> <img src=\"images/print-icon.gif\" style=\"cursor:pointer\" onclick=\"window.print()\"></span></td></tr><tr height=\"25px\"><td><font class=\"Orangefnt\" size=\"18\">Assigned Docuemnts List<br></font></td></tr><tr><td valign=\"top\" style=\"padding-left:10px\"><font class=\"Orangefnttxt\">'+DocumentsAssigned+'</font></td></tr><tr height=\"25px\"><td><font class=\"greenfnt\" size=\"+8\">Read Docuemnts List</font></td></tr><tr><td valign=\"top\" style=\"padding-left:10px\"><font class=\"greenfnttxt\">'+readDocuments+'</font></td></tr><tr height=\"25px\"><td><font class=\"redfnt\" size=\"+8\">Unread Docuemnts List</font></td></tr><tr><td valign=\"top\" style=\"padding-left:10px\"><font class=\"redfnttxt\">'+unreadDocuments+'</font></td></tr></table>');
	tmp.write('</center></body></head></html>');
	tmp.close();
}

function groupreport() {
	printpagecontent = document.getElementById("Printgroupreport").innerHTML;
	var popupWindow = window.open('',null,'height=500,width=700,status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes');
	var tmp = popupWindow.document;
	tmp.write('<html><head><title>Report</title><link href=\"css/Main.css" rel=\"stylesheet\" type=\"text/css\">');
	tmp.write('<body><br><br><center>'+printpagecontent);
	tmp.write('</center></body></head></html>');
	tmp.close();
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
      <td height="30" valign="top" class="FormHeader" style="padding-left:40px">Groupwise Report List  <span style=" cursor:pointer;padding-left:500px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal;" onclick="groupreport()">print <img src="images/print-icon.gif" /></span></td>
    </tr>
    <tr>
    
    <td valign="top" style="padding-left:10px;">  
    
<table width="100%"  border="1" cellpadding="0" cellspacing="0" align="center" class="TableBorder" style="border-collapse:collapse">
      <tr class="GridHeader">
        <td width="18%" style="padding-left:5px" nowrap class="WhiteFont">Name </td>
        <td width="18%" style="padding-left:5px" nowrap class="WhiteFont">Documents Assigned</td>
        <td width="14%" style="padding-left:5px "nowrap class="WhiteFont">Documents Read</td>
        <td width="10%" style="padding-left:5px "nowrap class="WhiteFont">Documents Unread</td>
		  <td width="4%" class="WhiteFont" style="cursor:pointer">Print</td>
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
        <td colspan="5" style="padding-left:5px;" class="{$ClassName}">
			{if $GroupList[Grp].Userlist[0].Name ne ""}
			<span id="plusminus{$GroupList[Grp].id}" onclick="ShowHideGroupUsers('{$GroupList[Grp].id}')" style="cursor:pointer; font-size:18px; font-weight:bolder;">+ </span> <span onclick="ShowHideGroupUsers('{$GroupList[Grp].id}')" style="cursor:pointer; font-size:12px; font-weight:bolder;">{$GroupList[Grp].Value|stripslashes}</span>
			{else}
			<span style="font-size:18px; font-weight:bolder;">-  </span> <span style="font-size:12px; font-weight:bolder;">{$GroupList[Grp].Value|stripslashes}</span>
			{/if}	
				
		</td>
      </tr>
	  <tr>
	  	<td colspan="5">
			<span id="Userlist{$GroupList[Grp].id}" style="display:none; padding-left:12px; ">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			{assign var="UserList" value=$GroupList[Grp].Userlist}
			{section name="usr" loop=$UserList}
			{if $UserList[usr].Name ne ""}
			  <tr>
				<td width="31%" class="RedFont">{$UserList[usr].Name}</td>
				<td width="29%"><img title="View {$UserList[usr].Name|stripslashes} Assigned documents" src="images/user-assigned.gif" style="cursor:pointer;" onclick="ShowHideEventform('{$UserList[usr].Name|stripslashes} Assigned documents','{$UserList[usr].documentsAssigned|stripslashes}')"  /></td>
				<td width="22%"><img title="View {$UserList[usr].Name|stripslashes} read documents" src="images/user-read.gif" style="cursor:pointer;" onclick="ShowHideEventform('{$UserList[usr].Name|stripslashes} read documents','{$UserList[usr].readdocumentslist|stripslashes}')"/></td>
				<td width="12%"><img title="View {$UserList[usr].Name|stripslashes} unread documents" src="images/user-unread.gif" style="cursor:pointer;" onclick="ShowHideEventform('{$UserList[usr].Name|stripslashes} unread documents','{$UserList[usr].unreaddocumentslist|stripslashes}')" /></td>
				<td width="6%"><img title="Print {$UserList[usr].Name|stripslashes} documents" src="images/print-icon.gif" style="cursor:pointer;" onclick="report('{$UserList[usr].Name|stripslashes}','{$UserList[usr].documentsAssigned|stripslashes}','{$UserList[usr].readdocumentslist|stripslashes}','{$UserList[usr].unreaddocumentslist|stripslashes}')" /></td>				
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
		{section name="Grp" loop=$GroupList}
		{if $smarty.section.Grp.iteration % 2 eq 0 }
		{assign var="bgcolor" value="#ECF5FB"}
		{else}
		{assign var="bgcolor" value="#E4ECF6"}
		{/if}
	  	<tr bgcolor="{$bgcolor}" style="border-bottom:#006699;">
			<td width="10%" class="Nametxt" ><strong>{$GroupList[Grp].Value|stripslashes} </strong></td>
			<td colspan="4">
				<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
					{assign var="UserList" value=$GroupList[Grp].Userlist}
					{section name="usr" loop=$UserList}
					{if $UserList[usr].Name ne ""}					
					<!-- section here to list all users -->
					<tr >
						<td width="13%" class="Nametxt" style="border-bottom:1px solid #ECE9D8;" ><strong>{$UserList[usr].Name}</strong></td>
						<td width="29%" style="border-bottom:1px solid #ECE9D8;">
							<table>
								<!-- section here to list all documents under the user -->
								<tr>
									<td><font class="Orangefnttxt">{$UserList[usr].documentsAssigned|stripslashes}</font></td>
								</tr>
							</table>
						</td>
						<td width="29%" style="border-bottom:1px solid #ECE9D8;">
							<table>
								<!-- section here to list all documents under the user -->
								<tr>
									<td><font class="greenfnttxt">{$UserList[usr].readdocumentslist|stripslashes}</font></td>
								</tr>
							</table>
						</td>
						<td width="29%" style="border-bottom:1px solid #ECE9D8;">
							<table>
								<!-- section here to list all documents under the user -->
								<tr>
									<td><font class="redfnttxt">{$UserList[usr].unreaddocumentslist|stripslashes}</font></td>
								</tr>
							</table>
						</td>
					</tr>
					{else}
					<tr><td colspan="4" width="700" align="center" class="Orangefnttxt">No Users Found</td></tr>
					{/if}
					{/section}						
				</table>
			</td>	
		</tr>
		{/section}
        </table>			</td>
		  </tr>
		</table>
	  
	  	
		</div>	
		</td>
    </tr>
  </table>
</form>
