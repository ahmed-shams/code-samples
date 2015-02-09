{literal}
<script type="text/javascript" language="javascript">
function submitdocform(LoggedIn) {
	if (LoggedIn ==  0) {
		alert("You must change your password while you login for first time");
		return false;
	} else {
		document.frmdoclist.op.value = "listdocs";
		document.frmdoclist.hdAction.value = "";
		document.frmdoclist.action = 'index.php';
		document.frmdoclist.submit();	
		return true;
	}
}

function GetDocumentlistByReadStatus(Status) {
	switch(Status) {
		case "Read":
			document.frmdoclist.hdAction.value = "ReadDoc";
			break;
		case "UnRead":
			document.frmdoclist.hdAction.value = "UnReadDoc";
			break;
	}
	document.frmdoclist.action = 'index.php';
	document.frmdoclist.submit();	
}
</script>
{/literal}
<table width="682" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	  <td class="titleleft">&nbsp;</td>
	  <td align="center" valign="middle" class="titlemid"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td class="hdrtext" align="left">Welcome {$UserList[0].firstname|stripslashes}</td>
		  <td align="right" class="hdrtext">Total Documents <span class="Totalcount" style="cursor:pointer;" onClick="return submitdocform('{$UserList[0].LoggedIn}')">{$UsersdocCount} </span></td>
		</tr>
	  </table></td>
	  <td class="titleright">&nbsp;</td>
	</tr>
	<tr>
	  <td rowspan="2" class="leftbdr">&nbsp;</td>
	  <td align="center" valign="top">&nbsp;</td>
	  <td rowspan="2" class="rightbdr">&nbsp;</td>
	</tr>
	<tr>
	  <td align="center" valign="top"><table width="50%" border="0" cellpadding="0" cellspacing="0" class="border">
		<tr>
		  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td colspan="3"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				  <tr align="center">
					<td class="gridcolor">
					<span class="doctext" style="cursor:pointer;" onClick="GetDocumentlistByReadStatus('Read');">Documents Read</span>
					<span class="doctext" style="color:#990000;" onClick="GetDocumentlistByReadStatus('Read');">{$read_doc}</span>
					</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				  <tr align="center">
					<td class="gridcolor">
						<span class="doctext" onClick="GetDocumentlistByReadStatus('UnRead');">Documents Unread</span>
						<span class="doctext" style="color:#990000;" onClick="GetDocumentlistByReadStatus('UnRead');">{$unread_doc}</span>
					</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				</table></td>
			  </tr>
			</table>
			  </td>
		</tr>
	  </table></td>
	</tr>
	<tr>
	  <td class="btmleft"></td>
	  <td class="btmmid"></td>
	  <td class="btmright"></td>
	</tr>
  </table>	
