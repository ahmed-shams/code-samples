{literal}
<script type="text/javascript" language="javascript">

var DownloadDocument = function (docIdent)	{
	window.location.href="downloaddocuments.php?op=Downloaddoc&docIdent="+docIdent;
}

var UpdateStatus = function () {
	if (document.getElementById("status").checked == true) {
		document.getElementById("txtStatus").value = "Read";
	} else {
		document.getElementById("txtStatus").value = "UnRead";
	}		
}
</script>
{/literal}
<script src="javascript/main.js" language="javascript" type="text/javascript"></script>
<form name="frmdetailedDocview" action="index.php" method="post" enctype="multipart/form-data" >
<input type="hidden" name="op" value="UpdateStatus">
<input type="hidden" name="txtStatus" id="txtStatus" value="" />
<input type="hidden" name="txtid" id="txtid" value="{$documentlist[0].id}" />
<table width="99%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td height="14"></td>
	</tr>
	{if $strMsg}
	<tr>
	  <td class="ErrorMsg" align="center">{$strMsg}</td>
	</tr>
	<tr>
	  <td height="14"></td>
	</tr>
	{/if}
	<tr>
	  <td>
	  	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#878787">
		 	<tr>
				<td bgcolor="#878787">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FAFAFA">
						<tr>
							<td>
								<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td colspan="2">
											<table width="96%" border="0" cellspacing="5" cellpadding="1">
												<tr>
													<td colspan="2" align="left"  class="FormHeading">Document Details<span class="orangeFont"></span></td>
												</tr> 
												<tr>
													<td colspan="2" align="center"><div class="ErrorMsg" id="ErrorMsg"></div></td>
												</tr> 
												<tr>
												  <td  width="31%" valign="top" class="RequiredField">Title</td>
												  <td width="56%" class="ListCell" align="left"><span style="background-color:#FAFAFA; border:none;" class="textbox1">{$documentlist[0].documentname|stripslashes}</span></td>
												</tr>
												<tr>
												  <td  width="31%" valign="top" class="RequiredField">Document File</td>
												  <td width="56%" class="ListCell" align="left">
												  	<span style="background-color:#FAFAFA; border:none;" class="textbox1">{$documentlist[0].doc_OriginalName}</span>
													<img src="images/download_icon.gif" style="cursor:pointer; padding-left:12px;" title="download {$documentlist[0].doc_OriginalName}" onclick="DownloadDocument('{$documentlist[0].id}');" />												  </td>
												</tr>
												<tr>
												  <td  width="31%" valign="top" class="RequiredField"><label for="txtRUserName">Description<span class="orangeFont">*</span></label></td>
												  <td width="56%" class="ListCell" align="left"><textarea style="background-color:#FAFAFA; border:none; font-family:Arial, Helvetica, sans-serif;"  name="txt2_doc_description"  cols="65" rows="10" id="txt2_doc_description" >{$documentlist[0].doc_description|stripslashes|strip_tags}</textarea></td>
												</tr>
												<tr>
												  <td  width="31%" valign="top" class="RequiredField">Status</td>
												  <td width="56%" class="ListCell" align="left"> 
												  	<input type="radio" name="status" id="status" value="read" {if $documentlist[0].Status eq "Read"} checked="checked" {/if}> <span style="background-color:#FAFAFA; border:none;" class="textbox1">Read</span>
													<input type="radio" name="status" id="status" value="unread" {if $documentlist[0].Status eq "UnRead"} checked="checked" {/if}> <span style="background-color:#FAFAFA; border:none;" class="textbox1">Unread</span>												  </td>
												</tr>
												<tr>
													<td></td>
													<td align="left"><input type="image" src="images/submit.gif" class="ratesubm" onclick="return UpdateStatus();" ></td>													
												</tr> 
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
	</tr>
</table>
</form>