

var loadstatustext="<img src='../images/mail-loading.gif' />"
function HideShow(SpanId,Profilename,DisplayId,filename){ 
	var Values = DisplayId;
	var success = function(t){ProfileNextComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId + '&id=' + Profilename;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function CreateFolder(SpanId,txtname,DisplayId,filename){ //alert(Profilename);
	var tvalues;
	var Values = DisplayId;
	tvalues = document.getElementById(txtname).value;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId + '&txtvalue=' + tvalues;  //{$Typemail}
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function Displaymails(SpanId,DisplayId,filename,typemail)
{	
	document.getElementById("RightMailBoxTd").height = "440px";
	document.getElementById("RightMailBoxTd").vAlign = "middle";
	document.getElementById(DisplayId).innerHTML=loadstatustext
	var Values = DisplayId;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId + '&typemail=' + typemail;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function DisplayCount(SpanId,DisplayId,filename)
{
	var Values = DisplayId;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function selectedmark(SpanId,DisplayId,countArray,filename,typemail,FolderIdent)
{ 
	if(!confirm("Are you sure to delete the selected mail."))
			return;
	var Values = DisplayId;
	var txtValue="";
	var txtValues;
	var tvalues;
	
	countArray = parseInt(countArray) + 1;
	for(i=1;i<countArray;i++)
	{
		CheckID=SpanId+"--"+i;
		//if(document.getElementById(CheckID).checked == true)
			//alert(document.getElementById(CheckID).checked)
		if(document.getElementById(CheckID).checked==true)
		{
			tvalues = document.getElementById(CheckID).value;
			txtValue += tvalues+"||";
		}
	}
	//alert(txtValue);
	var success = function(t){CreateComplete(t, Values);} 
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId+ '&txtValue=' + txtValue+ '&typemail=' + typemail+ '&MailIdent=' + FolderIdent; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function  selectmarkcheckedtofolder(SpanId,FolderIdent,countArray,DisplayId,filename,typemail,selectid,folder)
{ 
	var Values = DisplayId;
	var txtValue="";
	var txtValues;
	var tvalues;
	
	countArray = parseInt(countArray) + 1;  
	for(i=1;i<countArray;i++)
	{
		CheckID=selectid+"--"+i;
		//if(document.getElementById(CheckID).checked == true)
			//alert(document.getElementById(CheckID).checked)
		if(document.getElementById(CheckID).checked==true)
		{
			tvalues = document.getElementById(CheckID).value;
			txtValue += tvalues+"||";
		}
	}
	//alert(txtValue);
	var success = function(t){CreateComplete(t, Values);} 
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId+ '&txtValue=' + txtValue+ '&typemail=' + typemail+ '&FolderIdent=' + FolderIdent+ '&MailIdent=' + folder;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function selectmarkchecked(SpanId,DisplayId,MailIdent,filename,option,typemail)
{ //alert(MailIdent);
	if(option == 'delete'){
		if(!confirm("Are you sure to delete the selected mail."))
			return;
	}
	document.getElementById(DisplayId).innerHTML=loadstatustext
	var Values = DisplayId;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId+ '&MailIdent=' + MailIdent+ '&Typemail=' + typemail;  //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SelectedMailShown(SpanId,MailIdent,DisplayId,filename,Typemail,iteration,pagecount,FolderIdent)
{
	
	document.getElementById(DisplayId).innerHTML=loadstatustext
	var Values = DisplayId;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId +'&MailIdent=' + MailIdent +'&Typemail=' + Typemail +'&iteration=' + iteration +'&pagecount=' + pagecount+'&FolderIdent=' + FolderIdent; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SelectedMailShownFolder(SpanId,MailIdent,DisplayId,filename,Typemail,Foldername)
{
	document.getElementById("RightMailBoxTd").height = "440px";
	document.getElementById("RightMailBoxTd").vAlign = "middle";	
	document.getElementById(DisplayId).innerHTML=loadstatustext
	var Values = DisplayId;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId +'&MailIdent=' + MailIdent +'&Typemail=' + Typemail +'&Foldername=' + Foldername; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ReplaceFolder(SpanId,FolderIdent,MailIdent,DisplayId,filename)
{
	document.getElementById(DisplayId).innerHTML=loadstatustext
	var Values = DisplayId;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId +'&MailIdent=' + MailIdent +'&FolderIdent=' + FolderIdent;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SendMessage(SpanId,DisplayId,countArray,filename,typemail)
{ 
	var txtValue="";
	var txtValues;
	var tvalues;
	var SpanId1;
	var Values = DisplayId;
	
	for(i=0;i<countArray;i++)
	{ 
		SpanId1=SpanId+"--"+i;
		//txtValues=SpanId1;
		tvalues = document.getElementById(SpanId1).value;
		tvalues=tvalues.replace('&','__');
		txtValue+=tvalues+"||";
	}
		
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId +'&txtValues=' + txtValue +'&Typemail=' + typemail;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function Perpage(SpanId,DisplayId,PerpageCount,filename,perpagestatus,Ident,typemail)
{
	document.getElementById(DisplayId).innerHTML=loadstatustext
	var Values = DisplayId;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId +'&PerpageCount=' + PerpageCount +'&perpagestatus=' + perpagestatus +'&MailIdent=' + Ident +'&typemail=' + typemail;  //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function PerpageSingle(SpanId,MailIdent,typemail,DisplayId,filename,perpagestatus,iteration)
{	
	document.getElementById(DisplayId).innerHTML=loadstatustext
	var Values = DisplayId;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId +'&MailIdent=' + MailIdent +'&perpagestatus=' + perpagestatus +'&typemail=' + typemail +'&iteration=' + iteration; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function CreateComplete(t, Values)
{ 
	strValue = t.responseText.split('||');
	document.getElementById("RightMailBoxTd").vAlign = "top";
	Values = Values.toString();
	if(strValue[2]=='CountBoth') {
		if(strValue[0] != 0)
			strValue[0] = 'Inbox ('+strValue[0]+')'
		else
			strValue[0] = 'Inbox';
		document.getElementById(Values).innerHTML = strValue[0];
	}
	else
		document.getElementById(Values).innerHTML = strValue[0];
	if(strValue[3] == 'selectedmail')
	{
		if(strValue[1] == 0)
			strValue[1] = '';
		else
			strValue[1] = '(' + strValue[1] + ')';
		if(strValue[2] == 'sent')
			document.getElementById("sentcountmail").innerHTML = strValue[1];
		else if(strValue[2] == 'inbox')
			document.getElementById("inboxcountmail").innerHTML = strValue[1];
		document.getElementById("PFNL").innerHTML = strValue[4];
		document.getElementById("count1").innerHTML = strValue[5];
		document.getElementById("count2").innerHTML = strValue[5];
		document.getElementById("count").innerHTML = strValue[6];
	}
	else if(strValue[4] =='countmail')
	{ 
		if(strValue[1] == 0)
			strValue[1] =1;

		document.getElementById("count").innerHTML = strValue[1];
		document.getElementById("count1").innerHTML = strValue[3];
		document.getElementById("PFNL").innerHTML = strValue[2];
		document.getElementById("PageCount").value = strValue[1];
	}
	else if(strValue[5] =='sentmail')
	{
		document.getElementById("PFNL").innerHTML = strValue[1];
		document.getElementById("count2").innerHTML = strValue[2];
		document.getElementById("count").innerHTML = strValue[3]; 
		document.getElementById("count1").innerHTML = strValue[4];
		if(strValue[6] == "")
			strValue[6] = 'All Messages';
		document.getElementById("messages").innerHTML = strValue[6];
	}
	else if(strValue[4] =='perpagesentmail')
	{
		if(strValue[2] == 0)
			strValue[2] =1;
		document.getElementById("PFNL").innerHTML = strValue[1];
		document.getElementById("count").innerHTML = strValue[2];
		document.getElementById("count1").innerHTML = strValue[3];
	}
	else if(strValue[2]=='CountBoth')
	{ 
		if(strValue[1] != 0)
			strValue[1] = 'Sent ('+strValue[1]+')'
		else
			strValue[1] = 'Sent';
		document.getElementById('sentmail').innerHTML = strValue[1];
	}
	else if(strValue[3]=='allmessages')
	{
		document.getElementById("PFNL").innerHTML = strValue[1];
		document.getElementById("count1").innerHTML = strValue[2];
		document.getElementById("count2").innerHTML = strValue[2];
	}
	else if(strValue[4] == 'nextmail')
	{
		document.getElementById("PFNL").innerHTML = strValue[1]; 
		document.getElementById("count").innerHTML = strValue[2]; 
		document.getElementById("count1").innerHTML = strValue[3]; 
		document.getElementById("count2").innerHTML = strValue[3]; 
	}
	showAsEditable(Values, true);
}

/*function editFailed(t, Values)
{
	alert("Database Operation Failed!");
}*/
function edit_textboxFolder(id,idValue,idIdent,size,DisplayId,filename)// Edit Textbox with Save Button
{ 
	var values = idValue; //alert(values);
	if(values == "------" || values == "No Answer")
	{
		values = "";
	}
	document.getElementById(DisplayId).style.display = 'none';
	Element.hide(id);
	var textbox ="<span id='"+id+"_editor'><input id='"+id+"_edit' name='" +id+"' type='text' value=\""+values+"\" size='"+size+"' class='smallTxtBox'/>";
	var button = "&nbsp;&nbsp;&nbsp;<input id='"+id+"_save' type='image' src='images_Business/save.gif' align='absmiddle' style='padding-right:2px'></span>";
    new Insertion.After(id, textbox+button);
	Field.focus(id + '_edit');
    Event.observe(id+'_save', 'click', function(){saveChangesFolder(id,idIdent,filename)}, false);
}

function saveChangesFolder(id,FolderIdent,filename)
{	
	var new_content = escape($F(id+'_edit'));
	id.innerHTML = "Saving...";
	var Values = id;
	var success = function(t){editCompleteFolder(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	
	var url = filename;
    var pars = 'id=' + id + '&content=' + new_content + '&FolderIdent=' + FolderIdent;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function editCompleteFolder(t, Values)// Edit Complete Single Textbox or Textarea Values
{
	Values = Values.toString();
	var temp = stripslashes(t.responseText,"\\","");  
	document.getElementById('FolderOptions').innerHTML = temp;

	showAsEditable(Values, true);
}

function FolderPopUp(SpanId,MailIdent,DisplayId,filename,typemail,FolderIdent)
{
	var Values = DisplayId;
	var success = function(t){CreateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId +'&MailIdent=' + MailIdent +'&typemail=' + typemail +'&MailIdent=' + FolderIdent; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowForm(MailIdent)
{ 
	FolderPopUp('Show',MailIdent,'MoveFolder','personalmailboxajax.php');
}
function Action(opValue)
{	
			myWidth = (document.body.clientWidth/2)+101; 
			//alert(myWidth);
			boxid_1 = document.getElementById("Movev2cover").id;
			boxid_2 = document.getElementById("Movev2").id;
			assign(663, 272, 15, boxid_1, boxid_2);
			document.getElementById('Movev2cover').style.visibility = "visible";
			document.getElementById('Movev2cover').style.display = "inline";
			document.getElementById('Movev2').style.visibility = "visible";
			document.getElementById('Movev2').style.display = "inline";					
			initboxv2();
			
}
function ShowFormMain(MailIdent,typemail,FolderIdent)
{	
	FolderPopUp('Showmain',MailIdent,'MoveMainFolder','personalmailboxajax.php',typemail,FolderIdent)
}
function ActionMain(opValue)
{	
			myWidth = (document.body.clientWidth/2)+105; 
			boxid_1 = document.getElementById("MovevMain2cover").id;
			boxid_2 = document.getElementById("MovevMain2").id;
			assign(770, 275, 20, boxid_1, boxid_2);
			document.getElementById('MovevMain2cover').style.visibility = "visible";
			document.getElementById('MovevMain2cover').style.display = "inline";
			document.getElementById('MovevMain2').style.visibility = "visible";
			document.getElementById('MovevMain2').style.display = "inline";					
			initboxv2();
			
}