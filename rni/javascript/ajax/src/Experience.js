// JavaScript Document
function ExperienceShowValue(str,spanid,lengthtext)
{ 
	//str=str.replace('\n','<br>');
	var count = str.length;
	if(count < lengthtext) {
		//if(count < 30) str1 = str+'more...';
		//else str1 = str;
		document.getElementById(spanid).innerText = str;
	}
}
var z = 1;

function edit_textareaExp(obj,rows,cols,scrollcolor,textcount)// Edit Textarea
{ 
	obj = obj.toString();
	var mytool_array = obj.split("_");
	var id = mytool_array[0];
	Element.hide(id);
	var textValue = document.getElementById(id).innerText;
	var SpanId = id+'exp';
	var lengthtext = textcount;
	var textarea ="<div id='"+id+"_editor'><textarea id='"+id+"_edit' name='"+id+"' rows='"+rows+"' style='border:1px solid;width="+cols+"%;scrollbar-base-color:"+scrollcolor+";' onkeyup=ExperienceShowValue(this.value,'"+SpanId+"','"+lengthtext+"');>"+textValue+"</textarea></div>";
	new Insertion.After(id,textarea);
	Field.focus(id+'_edit');
}

function add_boxExp(mysp1,mysp2,obj,hiddenId,textcount)// Add New two Textboxs 
{ 
	hiddenId = hiddenId.toString();
	var mytool_array = hiddenId.split("_");
	var id = mytool_array[0];
	var SpanId = id+'exp';
	var lengthtext = textcount;
	if(document.getElementById(mysp1).innerHTML == '')
		var textbox = "<span id='"+mysp1+"_editor'>"+"<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+z+"_edit' class='TxtBox' onkeyup=ExperienceShowValue(this.value,'"+SpanId+z+"','"+lengthtext+"');></span>";
	else
		var textbox = "<span id='"+mysp1+"_editor'>"+"<br><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+z+"_edit' class='TxtBox' onkeyup=ExperienceShowValue(this.value,'"+SpanId+(z+1)+"','"+lengthtext+"');></span>";
	
	if(document.getElementById(mysp2).innerHTML == '')
		var textbox1 = "<span id='"+mysp2+"_editor'>"+"<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+(z+1)+"_edit' class='TxtBox' onkeyup=ExperienceShowValue(this.value,'"+SpanId+(z+1)+"','"+lengthtext+"');></span>";
	else
		var textbox1 = "<span id='"+mysp2+"_editor'>"+"<br><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+(z+1)+"_edit' class='TxtBox' onkeyup=ExperienceShowValue(this.value,'"+SpanId+(z+2)+"','"+lengthtext+"');></span>";
	
	new Insertion.After(mysp1, textbox);
	new Insertion.After(mysp2, textbox1);
	z++;
	
	Element.hide(obj);
	var button = "<span id='"+obj+"_editor'> <span id='"+obj+"_save' class='BlueLink'/>Save</span><span id='"+obj+"_cancel' class='BlueLink'/>Cancel</span></span>";
	new Insertion.After(obj, button);
	Event.observe(obj+'_save', 'click', function(){addSaveChanges(obj,hiddenId,mysp1,mysp2)}, false);
    Event.observe(obj+'_cancel', 'click', function(){addCleanUp(obj,hiddenId,mysp1,mysp2)}, false);
}
var y = 1;
function add_boxExpTeam(mysp1,mysp2,obj,hiddenId,textcount)// Add New two Textboxs 
{ 
	hiddenId = hiddenId.toString();
	var mytool_array = hiddenId.split("_");
	var id = mytool_array[0];
	var SpanId = id+'exp';
	var lengthtext = textcount;
	if(document.getElementById(mysp1).innerHTML == '')
		var textbox = "<span id='"+mysp1+"_editor'>"+"<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+y+"_edit' class='TxtBox' onkeyup=ExperienceShowValue(this.value,'"+SpanId+y+"','"+lengthtext+"');></span>";
	else
		var textbox = "<span id='"+mysp1+"_editor'>"+"<br><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+y+"_edit' class='TxtBox' onkeyup=ExperienceShowValue(this.value,'"+SpanId+(y+1)+"','"+lengthtext+"');></span>";
	
	if(document.getElementById(mysp2).innerHTML == '')
		var textbox1 = "<span id='"+mysp2+"_editor'>"+"<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+(y+1)+"_edit' class='TxtBox' onkeyup=ExperienceShowValue(this.value,'"+SpanId+(y+1)+"','"+lengthtext+"');></span>";
	else
		var textbox1 = "<span id='"+mysp2+"_editor'>"+"<br><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+(y+1)+"_edit' class='TxtBox' onkeyup=ExperienceShowValue(this.value,'"+SpanId+(y+2)+"','"+lengthtext+"');></span>";
	
	new Insertion.After(mysp1, textbox);
	new Insertion.After(mysp2, textbox1);
	y++;
	
	Element.hide(obj);
	var button = "<span id='"+obj+"_editor'> <span id='"+obj+"_save' class='BlueLink'/>Save</span><span id='"+obj+"_cancel' class='BlueLink'/>Cancel</span></span>";
	new Insertion.After(obj, button);
	Event.observe(obj+'_save', 'click', function(){addSaveChanges(obj,hiddenId,mysp1,mysp2)}, false);
    Event.observe(obj+'_cancel', 'click', function(){addCleanUp(obj,hiddenId,mysp1,mysp2)}, false);
}

function display_textareaExp(obj,filename,countArray,textareaName,type)
{
	var Values = new Array();	
	if(document.getElementById("temp"+obj).checked)
		Values[0] = obj;
	else
		Values[0] = 0;
	Values[1] = countArray;
	Values[2] = textareaName;
	Values[3] = type;
	
	var success = function(t){displayTextareaCompleteExp(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'objIdent=' + obj + '&textarea=' + Values[2];
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function displayTextareaCompleteExp(t, Values)
{
	var strValue = t.responseText.split('--'); 
	document.getElementById('spDisplay').innerHTML = stripslashes(strValue[0],"\\","");
	
	//for(var i=1;i<=Values[1];i++)
	//{ 
		if(Values[3] == "value")
		{
			//document.getElementById(Values[2]+'_textarea'+i).value = stripslashes(strValue[i],"\\","");
			document.getElementById('ExpTemplateId').value = strValue[1];
		}
			
	//}
	showAsEditable(Values, true);
}

function edit_buttonexp(obj,countArray,type,mysp1,mysp2)//Edit Add and Cancel button
{
	Element.hide(obj);
	var button = "<span id='"+obj+"_editor'><span id='"+obj+"_save' class='BlueLink'/>Save</span><span id='"+obj+"_cancel' class='BlueLink'>Cancel</span></span>";
	new Insertion.After(obj, button);
	Event.observe(obj+'_save', 'click', function(){saveChangesexp(obj,countArray,type,mysp1,mysp2)}, false);
    Event.observe(obj+'_cancel', 'click', function(){cleanUpexp(obj,countArray,type,mysp1,mysp2)}, false);
}
function cleanUpexp(obj,countArray,type,mysp1,mysp2, keepEditable)// Cleanup  div or span id
{
	obj = obj.toString();
	var my = obj.split("_");
	var id = my[0];
	if(type == "multiple")
	{
		for(var i=0;i<countArray;i++)
		{
			id = my[0]+"--"+i;
			Element.remove(id+'_editor');
    		Element.show(obj);
			Element.show(id);
		}
		if(mysp1 != '' || mysp2 != '')
		{
			////Remove  Add Textbox ///////
			var temp = document.getElementById(mysp1).innerText;
			if(temp != '')
			{
				var tempArray = parseArrayString(temp,'No');
				for(var c=tempArray.length-1;c>=0;c--)
				{
					Element.remove('my_span--'+c+'_editor');
					Element.show(mysp1);
				}
			}
			////Remove  Add Textbox///////
			var temp1 = document.getElementById(mysp2).innerText;
			if(temp1 != '')
			{
				var tempArray1 = parseArrayString(temp1,'No');
				for(var d=tempArray1.length-1;d>=0;d--)
				{
					Element.remove('my_span1--'+d+'_editor');
					Element.show(mysp2);
				}
			}
		}
		Element.remove(obj+'_editor');
	}
	else if(type == "one" || type == "Two")
	{
		Element.remove(obj+'_editor');
		Element.show(obj);
	}
	else
	{
		Element.remove(id+'_editor');
		Element.remove(obj+'_editor');
		Element.show(obj);
		Element.show(id);
	}
	
	if(type == "multiple" && (mysp1 != "" || mysp2 != ""))
	{
		document.getElementById(my[0]+'Add_Button').style.visibility='visible';
		document.getElementById(my[0]+'Add_Button').style.display='inline';
	}
}
function saveChangesexp(obj,countArray,type,mysp1,mysp2)// Save Edit Textbox Values
{ 

	obj = obj.toString();
	var mytool_array = obj.split("_");
	var id = mytool_array[0];
	var new_addcontent = "";
	var new_addcontent1 = "";
	var Values = new Array();
	if(type == "multiple")
	{
		var new_content = "";
		var ident = new Array();
		for(var i=0;i<countArray;i++)
		{
			id = mytool_array[0]+"--"+i;
			new_content += escape($F(id+'_edit'))+"||";
			ident[i] = id;
			Values[i] = id;
			id.innerHTML = "Saving...";		
		}
		var success = function(t){editCompleteArray(t, Values);}
		var failure = function(t){editFailed(t, Values);}
		
		if(mysp1 != '' || mysp2 != '')
		{
			////Remove  Add Textbox///////
			var temp = document.getElementById(mysp1).innerText;
			var countVal = Values.length;
			if(temp != '')
			{
				var tempArray = parseArrayString(temp,'No');
				for(var c=tempArray.length-1;c>=0;c--)
				{
					new_addcontent += escape($F('my_span--'+c+'_edit'))+"||";
					Values[countVal+c] = "my_span--"+c;
				}
				var success = function(t){editCompleteArray(t, Values);}
				var failure = function(t){editFailed(t, Values);}
			}
			countVal = Values.length;
			////Remove  Add Textbox///////
			var temp1 = document.getElementById(mysp2).innerText;
			if(temp1 != '')
			{
				var tempArray1 = parseArrayString(temp1,'No');
				for(var d=tempArray1.length-1;d>=0;d--)
				{
					new_addcontent1 += escape($F('my_span1--'+d+'_edit'))+"||";
					Values[countVal+d] = "my_span1--"+d;
				}
				var success = function(t){editCompleteArray(t, Values);}
				var failure = function(t){editFailed(t, Values);}
			}
		}
	}
	else
	{
		var ident = "";
		var new_content = escape($F(id+'_edit'));
		id.innerHTML = "Saving...";
		var Values = id;
		var success = function(t){editComplete(t, Values);}
		var failure = function(t){editFailed(t, Values);}
	}
	
	cleanUp(obj,countArray,type,mysp1,mysp2, true);
	
    var url = varFileName;
    var pars = 'id=' + id + '&content=' + new_content + '&ident=' + ident + '&new_addcontent=' + new_addcontent + '&new_addcontent1=' + new_addcontent1;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function edit_multitextboxexp(obj,size,countArray,mysp1,mysp2,textcount)// This function used to Edit generate dynamic textboxes
{ 
	obj = obj.toString();
	var mytool_array = obj.split("_");
	var myId = mytool_array[0];
	var id;
	var SpanId = myId+'exp';
	var lengthtext = textcount;
	var a = 1;
	for(var i=0;i<countArray;i++)
	{  
		id = myId+"--"+i;
		Element.hide(id);
		var textbox ="<span id='"+id+"_editor'>";
		textbox +="<input id='"+id+"_edit' name='"+id+"' type='text' value=\""+document.getElementById(id).innerHTML+"\" size='"+size+"' class='TxtBox'/ onkeyup=ExperienceShowValue(this.value,'"+SpanId+a+"','"+lengthtext+"');></span>";
		new Insertion.After(id, textbox);
		a++;
	}
	z++;

	////New Add Text Edit here Id = 1	
	if(mysp1 != '' || mysp2 !='')
	{
		var temp = document.getElementById(mysp1).innerText;
		if(temp != '' && temp != 'undefined')
		{
			var test = parseArrayString(temp,'Yes');
			for(var p=test.length-1;p>=0;p--)
			{
				Element.hide(mysp1);
				var textbox = "<span id='my_span--"+p+"_editor'><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input name='my_span--"+p+"_edit' id='my_span--"+p+"' type=text class=TxtBox value='"+LTrim(test[p])+"' onkeyup=ExperienceShowValue(this.value,'"+SpanId+"'+'1','"+lengthtext+"');></span><br>";
				new Insertion.After(mysp1, textbox);
			}
		}
		
		////New Add Text Edit here Id = 2
		var temp1 = document.getElementById(mysp2).innerText;
		if(temp1 != '' && temp1 != "undefined")
		{
			var test1 = parseArrayString(temp1,'Yes');
			for(var p1=test1.length-1;p1>=0;p1--)
			{
				Element.hide(mysp2);
				var textbox1="<span id='my_span1--"+p1+"_editor'><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input name='my_span1--"+p1+"_edit' id='my_span1--"+p1+"' type=text class=TxtBox value='"+LTrim(test1[p1])+"' onkeyup=ExperienceShowValue(this.value,'"+SpanId+"'+'2','"+lengthtext+"');></span><br>";
				new Insertion.After(mysp2, textbox1);
			}
		}
	}
}
