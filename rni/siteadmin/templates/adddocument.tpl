{literal}
<script src="../javascript/validation.js" language="javascript" type="text/javascript"></script>
<script language="JavaScript" src='../scripts/innovaeditor.js'></script>
<script language="JavaScript" src="../javascript/CalendarPopup.js"></script>
<script>
var cal1x = new CalendarPopup();

function InsertProduct(objForm){
	if(document.getElementById("txt2_Product_Image").value=='' )
	{
		alert('Upload the Image');
		return false;	
	}else{
	document.frm_add_document.hdAction.value ="Add_Product";
	document.frm_add_document.submit();
	}
}

function ValidatePrice(Price,PriceId)	{
 if (!IsAmount(Price,"Price")) {
 	$(PriceId).value = "0";
 	$(PriceId).focus();
	return false;
 }
}

function ValidateURL(UrlVal,UrlIdent)	{
	if (!IsValidURL(UrlVal,"7")) {
		$(UrlIdent).value = "http://";
		$(UrlIdent).focus();
		return false;
	}
}

function Upload(){
	if(!IsValid(frm_add_document.txt2_documentname.value,"Document name")){
		frm_add_document.txt2_documentname.focus();
		return false;
	} else if (!IsValid(frm_add_document.txt2_doc_filename.value,"Document Path")){
		frm_add_document.txt2_doc_filename.focus();
		return false;
	} else if(document.getElementById("txt2_doc_filename").value=='' )
	{
		alert('Upload the document');
		return false;	
	} else {	
		document.frm_add_document.hdAction1.value ="Add";
		document.frm_add_document.submit();
	}
}
</script>

{/literal}
<form name="frm_add_document" method="post" action="" enctype="multipart/form-data" onsubmit="return Upload(this.form);">
  <input type="hidden" name="hdAction" value="">
  <input type="hidden" name="txt2_created_on" value="{$Today}"/>
  <input type="hidden" name="hdAction1" value="">
  <input type="hidden" name="Ident" value="{$Ident}">
  <table width="100%"  border="0" cellspacing="0" cellpadding="2">
    {if $Errmsg neq ""}
    <tr>
      <td height="20" class="ErrorMsg" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="20" class="ErrorMsg" align="center">{$Errmsg}</td>
    </tr>
    {/if}
    <tr>
      <td colspan="">&nbsp;</td>
    </tr>
    <tr>
      <td class="formheader" style="padding-left:38px" colspan="">Document Details<br></td>
    </tr>
    <tr>
      <td align="center" valign="top" colspan="" style="padding-right:20px"><table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0" class="TableBorder" style="border-collapse:collapse">
          <tr class="GridHeader">
            <td>Add Document Details </td>
          </tr>
          <tr>
            <td width="49%" valign="top" align="right" class="mantadory"><font color="red" size="2">*
                Mandatory</font>&nbsp;</td>
          </tr>
          <tr width="80%">
            <td height="25%" style="padding-left:5px"><table width="95%"  border="0" cellspacing="0" cellpadding="8" style="border-collpase:collaspe;">
                <tr>
                  <td width="24%" height="30" valign="top" class="text" style="padding-left:5px;" nowrap>Document Name<font class="mantadory">*</font></td>
                  <td width="76%" valign="top"><input name="txt2_documentname" type="text" class="txtbox" id="txt2_documentname" value="{$Imgpaths[0].documentname}" size="30">                  </td>
                </tr>
                <tr>
                  <td width="24%" height="30" valign="top" class="text" style="padding-left:5px;" nowrap>Document File<font class="mantadory">*</font></td>
                  <td width="76%" valign="top"><input type="file" name="txt2_doc_filename" id="txt2_doc_filename" size="25" >
				  <input type="submit" name="Submit" class="button" value="Upload" />
                    <!--div id="imageload"  style="display:none;">
                      <img src="" /></div-->
					 {if $Ident && $Imgpath neq ''}
					 <div id="imageload" class="color">
					 <img src="../products/medium{$Imgpath}" />					 </div> 
					 {/if}                  </td>
                </tr>
				<tr>
				  <td width="24%" height="30" valign="top" class="text" style="padding-left:5px;" nowrap>Group</td>
				  <td width="76%" valign="top">
				  <select name="txt2_grouplist[]" id="txt2_grouplist[]" class="txtbox" multiple="multiple" size="6" >
						{html_options values=$GroupId output=$GroupValue}
				  </select>				  
				  </td>
				</tr>	
				
				<tr>
				  <td width="24%" height="30" valign="top" class="text" style="padding-left:5px;" nowrap>Users</td>
				  <td width="76%" valign="top">
				  <select name="txt2_userlist[]" id="txt2_userlist[]" class="txtbox" multiple="multiple" size="6" >
						{html_options values=$userlistId output=$userlistValue}
				  </select>				  
				  </td>
				</tr>	
				
                <tr>
                  <td width="24%" class="text" valign="top"  colspan="2" nowrap>Document Description: <br />
                    <br />
                  <textarea name="txt2_doc_description" class="featuredtxtarea" cols="70" rows="10" id="txt2_doc_description"></textarea>
									<script> 
										var oEdit1 = new InnovaEditor("oEdit1");
										oEdit1.REPLACE("txt2_doc_description");
									</script>				  </td>
                </tr>
                								
              </table></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25%" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td width="73%" height="25%" align="center"><input type="submit" name="Submit" class="button" value="Add Document"  /></td>
    </tr>
  </table>
</form>
