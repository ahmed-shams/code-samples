{include file = "includes/PageStart.tpl"}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2">
		  	
		  </td>
        </tr>
		<tr>
			<td align="center" style="padding-top:20px;" ><span class="ErrorMsg" id="LoginErrorMsg">{if $strMsg}{$strMsg}{/if}</span></td>
		</tr>
        <tr>
          <td width="71%" valign="middle" style="padding-top:25px;" align="center">
		  	  {if $InnerTpl ne ""}
			  {include file = $InnerTpl}
			  {else}
				{include file = "loginpage.tpl"}
			  {/if}
		  </td>
          <td width="29%" align="center" valign="top">
		  	<!--Advertisment START-->	
			{if $InnerTpl ne "forgetpwd.tpl" and $InnerTpl ne ""}
			  <table width="219" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td class="titleleft">&nbsp;</td>
				  <td align="center" valign="middle" class="titlemid"><table width="80%" border="0" cellpadding="0" cellspacing="0">
					<tr>
					  <td align="center" class="hdrtext" nowrap="nowrap">Announcement(s)</td>
					</tr>
				  </table></td>
				  <td class="titleright">&nbsp;</td>
				</tr>			
				<tr>
				  <td class="leftbdr">&nbsp;</td>
				  <td class="Documentlist" height="50px;" style="padding-top:10px;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr height="28px;">
						<td class="paginationfont">You have <span class="ErrorMsg">{$unread_doc}</span> unread documents</td>
					  </tr>
					  <tr>
						<td class="orangetext">{$Unreaddoclist}</td>
					  </tr>
					</table>
				  <td class="rightbdr">&nbsp;</td>
				</tr>
				<tr>
				  <td class="btmleft"></td>
				  <td class="btmmid"></td>
				  <td class="btmright"></td>
				</tr>
			  </table>
			  {/if}
			 <!--Advertisment END-->	
		  </td>
        </tr>
      </table>
 {include file = "includes/PageEnd.tpl"}

