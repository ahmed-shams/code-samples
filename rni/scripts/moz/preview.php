<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Email Preview</title>
<!--<link href="style/editor.css" rel="stylesheet" type="text/css">-->
<style>
body{margin:0;background:#FFFFFF;}
.dialogFooter{background-color:#E2E2ED;border-top:#CFCFCF 1px solid;}
.dialogFooter1{background-color:#E2E2ED;border-bottom:#CFCFCF 1px solid;}
.inpRdo {width:13;height:13;margin-right:3;margin-bottom:1}
.inpBtn {font:8pt tahoma,arial,sans-serif;}
.inpBtnOver {}
.inpBtnOut {}
</style>
<script>
	//var sLangDir=dialogArguments.oUtil.langDir;
	//document.write("<scr"+"ipt src='language/"+sLangDir+"/preview.js'></scr"+"ipt>");
</script>
<!--<script>writeTitle()</script>-->
<script>
function bodyOnLoad()
	{ 
//var oEdit=window.opener.oUtil.obj.getHTML(); 
	//var	ta	=	window.opener.document.getElementById('Emailcontent').value;
	//var ta1=ta.split("<usertag></usertag>");
//	var StyleCode=window.opener.document.getElementById('hdStyleCode').value;
//	alert(StyleCode);
	//document.getElementById('Start').innerHTML=ta1[0];
	//document.getElementById('Middle').innerHTML=StyleCode;
	//document.getElementById('End').innerHTML="<br>"+ta1[2]+"<br>";
	}
</script>
</head>
<body style="overflow:auto;background-color:E2E2ED;"> <!--loadTxt();onload="bodyOnLoad()"-->
<table width="100%" align="center" cellpadding="0" cellspacing="0" border=0 bgcolor="#E2E2ED">
<tr valign="top"><td height="37" class="dialogFooter1">&nbsp;</td></tr>
<tr valign="top"><td>
<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0" border=0>
<!--<Tr>
<td style="height:100%">
	<iframe style="width:100%;height:100%;overflow:auto;" src="blank.gif" name="idPreview" id="idPreview"></iframe>
</td>
</tr>-->
<!--<tr>
	<Td height="50" bgcolor="#E9E8F2">&nbsp;</td>
</tr>-->
<tr>
	<Td id="Start" valign="top" style="padding-left:20px;padding-top:25px;" bgcolor="white"><script>	
//	var	ta	=	window.opener.document.getElementById('Emailcontent').value;
	var ta =window.opener.oUtil.obj.getHTML();

	var ta1=ta.split("<usertag></usertag>");

	document.write(ta1[0].replace(/<hr size="1">/,''));
</script></Td>
</tr>
<script language="javascript">
document.write('<tr height="'+window.opener.document.getElementById('hdStyleCodeheight').value+'" valign=top><td  id="Middle" bgcolor="white" style="padding-left:20px;padding-top:0px;" height="'+window.opener.document.getElementById('hdStyleCodeheight').value+'" valign="top">');
document.write(window.opener.document.getElementById('hdStyleCode').value);</script></Td>
</tr>
<!--<script>
document.getElementById("Middle").style.height = window.opener.document.getElementById('hds_h').value;
alert(document.getElementById("Middle").style.height);
</script>-->
<tr>
	<Td id="End" valign="top" bgcolor="#FFFFFF" style="padding-left:20px;padding-bottom:20px;"><script>	

//	var	ta	=	window.opener.document.getElementById('Emailcontent').value;
	var ta =window.opener.oUtil.obj.getHTML();
	var ta1=ta.split("<usertag></usertag>");
	document.write(ta1[2].replace(/<hr size="1">/,''));
</script></Td></tr>
<!--<tr>
<td class="dialogFooter" style="padding:13;padding-top:7;padding-bottom:7;" align="right" bgcolor="#E9E8F2" valign="top">
	<input type="button" name="btnClose" id="btnClose" value="close" onclick="self.close()" class="inpBtn" onmouseover="this.className='inpBtnOver';" onmouseout="this.className='inpBtnOut'">
</td>
</tr>-->
</table>
</td></tr>
<tr valign="top">
<td class="dialogFooter" style="padding:13;padding-top:7;padding-bottom:7;" align="right" bgcolor="#E2E2ED" valign="bottom">
	<input type="button" name="btnClose" id="btnClose" value="close" onclick="self.close()" class="inpBtn" onmouseover="this.className='inpBtnOver';" onmouseout="this.className='inpBtnOut'">
</td>
</tr>
</table>
</body> 
</html>
