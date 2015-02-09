<html>
<title>Admin Control Panel</title>
<body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
<link href="css/Main.css" rel="stylesheet" type="text/css">
{literal}
<script language="javascript" src="../javascript/ajax/lib/prototype.js" type="text/javascript"></script>
{/literal}
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
			<td rowspan="2" width="20%" height="100%" valign="top" background="images/cp_navbody_bg.gif">{include file='leftmenu.tpl'}</td>
			<td valign="top" height="20%">{include file='header.tpl'}</td>
		</tr>
		<tr> 
			<td valign="top" height="585px">{include file=$InnerTpl}</td>
		</tr>
	</table>
</body>
</html>