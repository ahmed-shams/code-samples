{literal}
<script type="text/javascript">
function ShowHideEventform(title,Value) {
	divwin=dhtmlwindow.open('divbox', 'div', 'Eventdiv', title , 'width=250px,height=200px,left=350px,top=200px,resize=1,scrolling=0'); 
	if (Value != "")	{
		document.getElementById("txtevent").innerHTML = Value;
	} else {
		document.getElementById("txtevent").innerHTML = "No Users Found";
	}
	return false;
}

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
				document.frmReport.action="documentwisereport.php";
				//else
				//document.frmReport.action=document.frmReport.url.value;
			}
			document.frmReport.submit();
	}
	
  function getCategorySort(name,type1){
			document.frmReport.action="documentwisereport.php?sort="+name+"&type="+type1;
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
	
function report() {
	printpagecontent = document.getElementById("Printdocumentreport").innerHTML;
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
		<strong style="font-family:Arial, Helvetica, sans-serif; color:#990000;">User's List</strong><br />
		<div name="txtevent"  id="txtevent" wrap="soft" STYLE="overflow-x: hidden; overflow-y: scroll; font-family:Arial, Helvetica, sans-serif; font-size:12px;" ></div>	
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
      <td height="30" valign="top" class="FormHeader" style="padding-left:40px">Documentwise Report List <span style=" cursor:pointer;padding-left:500px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal;" onclick="report()">print <img src="images/print-icon.gif" /></span></td>
    </tr>
    <tr>
    
    <td valign="top" style="padding-left:10px;">    
<table width="100%"  border="1" cellpadding="0" cellspacing="0" align="center" class="TableBorder" style="border-collapse:collapse">
      <tr class="GridHeader">
        <td width="18%" style="padding-left:5px" nowrap class="WhiteFont">Name</td>
        <td width="18%" style="padding-left:5px" nowrap class="WhiteFont">Users Assigned </td>
        <td width="14%" style="padding-left:5px "nowrap class="WhiteFont">Users Read</td>
        <td width="14%" style="padding-left:5px "nowrap class="WhiteFont">Users Unread</td>
      </tr>
      {section name="val" loop=$docsList} {if $smarty.section.val.iteration
      % 2 eq 0} {assign var="ClassName" value="GridCell1"} {else} {assign
      var="ClassName" value="GridCell2"} {/if}
      {if $docsList[val].Status eq "Active"}
      {assign var="StatusFont" value="GreenFont"}
      {elseif $docsList[val].Status eq "Inactive"}
      {assign var="StatusFont" value="RedFont"}
      {else}
      {assign var="StatusFont" value="OrangeFont"}
      {/if}
      <tr >
        <td style="padding-left:5px;" class="{$ClassName}">{$docsList[val].documentname|stripslashes} </td>
        <td style="padding-left:5px;" align="center"><img title="View {$docsList[val].documentname|stripslashes} Assigned Users" src="images/user-assigned.gif" onclick="ShowHideEventform('{$docsList[val].documentname|stripslashes} Assigned Users','{$docsList[val].UserName|stripslashes}')" /> </td>
        <td style="padding-left:5px;" class="GreenFont" align="center"><img src="images/user-read.gif" title="View {$docsList[val].documentname|stripslashes} Users who read" onclick="ShowHideEventform('{$docsList[val].documentname|stripslashes} Users who read','{$docsList[val].ReadUserfullName|stripslashes}')" /></td>
        <td style="padding-left:5px;" class="RedFont" align="center"><img src="images/user-unread.gif" title="View {$docsList[val].documentname|stripslashes} Users who unread" onclick="ShowHideEventform('{$docsList[val].documentname|stripslashes} Users who unread','{$docsList[val].UnreadUserfullName|stripslashes}')" /></td>
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
	  <div id="Printdocumentreport" style="display:none;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	  	<td class="printFormHeader" align="left">Document Report</td>
	  	<td  align="right"><span style="cursor:pointer;" onclick="window.print()">Print <img src="images/print-icon.gif" /></span></td>
	  </tr> 	
		  <tr>
			<td colspan="2">
<table width="100%"  border="1" cellspacing="2" cellpadding="0" class="bdr" >	 
	  	<tr height="28px;">
			<td width="14%" class="NameHeadertxt" nowrap="nowrap"><strong>Document Name</strong></td>
			<td width="28%"><font class="Orangefnt" size="18">Users Assigned</font></td>
			<td width="22%"><font class="greenfnt" size="+8">Users Read</font></td>
			<td width="36%"><font class="redfnt" size="+8">Users Unread</font></td>
		</tr>
	   {section name="val" loop=$docsList}
          <tr>
		  	<td width="14%" nowrap="nowrap"><font class="Nametxt">{$docsList[val].documentname|stripslashes}</font></td>
			<td width="28%"><font class="Orangefnttxt">{$docsList[val].UserName|stripslashes}</font></td>
			<td width="22%"><font class="greenfnttxt">{$docsList[val].ReadUserfullName|stripslashes}</font></td>
			<td width="36%"><font class="redfnttxt">{$docsList[val].UnreadUserfullName|stripslashes}</font></td>
          </tr>
		  {/section}
        </table>
			</td>
		  </tr>	  
		</table>	  		
		</div>
		</td>
    </tr>
    
  </table>
</form>
