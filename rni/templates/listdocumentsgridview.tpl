{literal}
<script type="text/javascript" language="javascript">
function Viewdetaileddocview(DocumentId) {
	$("hddocid").value = DocumentId;
	document.frmdocgrid.action = 'index.php';
	document.frmdocgrid.submit();	
}
</script>
{/literal}
<!--ProductsListList START	-->	
<table width="99%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="padding:10px 0px 8px 8px;">
		<form name="frmdocgrid" method="post" action="index.php">
		<input type="hidden" name="op" id="op" value="listdetaileddocs" /> 
		<input type="hidden" name="hdUserid" id="hdUserid" value="{$UserList[0].id}" />
		<input type="hidden" name="hddocid" id="hddocid" value="" />
		<table width="99%" border="0" cellspacing="0" cellpadding="0" align="left">
		 <tr height="10px"><td></td></tr>	
		 <tr>
			<td> 
		<table width="682" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td class="titleleft">&nbsp;</td>
              <td align="center" valign="middle" class="titlemid"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="hdrtext">Welcome {$UserList[0].firstname|stripslashes}</td>
                  <td align="right" class="hdrtext"></td>
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
              <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="border">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  		<tr>
							<td class="bordermid"><span class="gridtitle">Title</span></td>
							<td class="bordermid"><span class="gridtitle">Name</span></td>
							<td class="bordermid"><span class="gridtitle">Description</span></td>
							<td class="bordermid"><span class="gridtitle">Date</span></td>
							<td class="bordermid"><span class="gridtitle">Status</span></td>
						</tr>				  
						<!--Product List Content START-->	
						{section name="doc" loop=$documentsList}
						{if $smarty.section.doc.iteration mod 2 eq 0 } 
						{assign var="rowcss" value="gridcolor"}
						{else}
						{assign var="rowcss" value=""}
						{/if}
						{if $DocStatus ne ""}
						{if $DocStatus eq $documentsList[doc].Status}
						<tr class="{$rowcss}"> 
							<td class="tableTd" style="cursor:pointer; text-decoration:underline;" title="View {$documentsList[doc].documentname}" onclick="Viewdetaileddocview('{$documentsList[doc].id}');">{$documentsList[doc].documentname|stripslashes|truncate:40:"...":false}</td>
							<td class="tableTd" >{$documentsList[doc].doc_OriginalName|stripslashes}</td>
							<td class="tableTd">{$documentsList[doc].doc_description|stripslashes|truncate:80}</td>
							<td class="tableTd">{$documentsList[doc].created_on|date_format:"%m-%d-%Y"}</td>
							<td class="tableTd">{$documentsList[doc].Status}</td>
						 </tr>
						 {/if}	
						 {else}
						<tr class="{$rowcss}"> 
							<td class="tableTd" style="cursor:pointer; text-decoration:underline;" title="View {$documentsList[doc].documentname}" onclick="Viewdetaileddocview('{$documentsList[doc].id}');">{$documentsList[doc].documentname|stripslashes|truncate:40:"...":false}</td>
							<td class="tableTd" >{$documentsList[doc].doc_OriginalName|stripslashes}</td>
							<td class="tableTd">{$documentsList[doc].doc_description|stripslashes|truncate:80}</td>
							<td class="tableTd">{$documentsList[doc].created_on|date_format:"%m-%d-%Y"}</td>
							<td class="tableTd">{$documentsList[doc].Status}</td>
						 </tr>
						 {/if}
						 {sectionelse}
						 <tr class="tableTdOdd" align="center"> 
						 	<td class="tableTd" colspan="5" align="center" style="padding-left:300px;">No Documents Found</td>
						 </tr>
						 {/section}
						 <!--Product List Content END-->	
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
			</td>
		 </tr>
		</table>
		 </form>
		</td>
		</tr>
	</table>
<!--ProductsListList END-->	
