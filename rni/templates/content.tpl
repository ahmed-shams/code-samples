
<form name="frmdoclist" method="post">
<input type="hidden" name="op" id="op" value="listdocs" /> 
<input type="hidden" name="hdAction" id="hdAction" value="" /> 
<input type="hidden" name="hdUserid" id="hdUserid" value="{$UserList[0].id}" /> 

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="left">
 <tr height="10px"><td></td></tr>	
 <tr>
 	<td> 
			{include file="docstatus.tpl"}
	</td>
 </tr>
</table>
</form>
