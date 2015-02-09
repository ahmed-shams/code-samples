var CatValue = new Array();
function getposOffset(overlay, offsettype){
	var totaloffset=(offsettype=="left")? overlay.offsetLeft : overlay.offsetTop;
	var parentEl=overlay.offsetParent;
	while (parentEl!=null){
		totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
		parentEl=parentEl.offsetParent;
	}
	return totaloffset;
}

function GetDropDownList(type,SpanId,SubCat,ContentValues,FileName){

	//alert(ContentValues);
	ContentValues = ContentValues.replace(" ","_");		
	document.getElementById(SpanId).innerHTML= '<img src="images/loading.gif" />';
	document.getElementById("Edit_"+SpanId).align= "left";
	document.getElementById("Edit_"+SpanId).innerHTML= '<span onClick=Close("'+type+'","'+SpanId+'","'+SubCat+'","'+ContentValues+'","'+FileName+'") class="EditLink">Close</span>';
	var success = function(t){GetDropDownListComplete(t,SpanId);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars =  'objIdent=' + type + '&subCat='+SubCat+'&SpanId='+SpanId+'&contentValues='+ContentValues;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});	
}
function GetDropDownListComplete(t,SpanId){	
	var strValue = t.responseText.split('||');	
	document.getElementById(SpanId).innerHTML	= strValue;
	var LoopId = SpanId.split('_');	
	document.getElementById("Edit_PanelSpanId_"+LoopId[1]).style.display = "block";
	document.getElementById("PanelClose_"+LoopId[1]).style.display = "block";	
}
function GetRssDropDownList(type,SpanId,SubCat,ContentValues,FileName){
	ContentValues = ContentValues.replace(" ","_");	
	
	document.getElementById("RSS"+SpanId).innerHTML= '<img src="images/loading.gif" />';

	//document.getElementById("RSSEdit_"+SpanId).align= "left";
	document.getElementById("RSSEdit_"+SpanId).innerHTML= '<span onClick=RssClose("'+type+'","'+SpanId+'","'+SubCat+'","'+ContentValues+'","'+FileName+'")><b>Close</b></span>';
	var success = function(t){GetRssDropDownListComplete(t,SpanId);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars =  'objIdent=' + type + '&subCat='+SubCat+'&SpanId='+SpanId+'&rsscontentValues='+ContentValues;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});	
}
function GetRssDropDownListComplete(t,SpanId){	
	var strValue = t.responseText.split('||');	
	document.getElementById("RSS"+SpanId).innerHTML	= strValue;
	var LoopId = SpanId.split('_');	
	document.getElementById("RSSEdit_PanelSpanId_"+LoopId[1]).style.display = "block";
	document.getElementById("RSSPanelClose_"+LoopId[1]).style.display = "block";	
}
function setDropDownValues(value,objList,setValues,filename){ 

	
	if(value != "Any"){
 	var success = function(t){SavelabelDropDownValues(t, objList,value,setValues);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
	var pars = 'value=' + value + '&setValues=' + setValues + '&objIdent=' + objList; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
	}
}
function SavelabelDropDownValues(t,objList,value,setValues){
	var strValue = t.responseText.split('||'); 
	document.getElementById(objList).innerHTML = strValue;
}
function Add_Details(id,countArray,displayid,Countid,ContentValues,filename){ 
	var spanId;
	var txtValue="";
	var txtValues;
	var tvalues;
	var myfile;

	document.getElementById("Loading").innerHTML  = '<img src="images/loading.gif" />';
	
	ContentValues = ContentValues.replace(" ","_");

	if(id=="InviteNonMembersList" || id=="InviteMembersList" || id=="RemindMembersList" || id=="RemindNonMembersList" || id=="InviteFriendsStep1" || id=="InviteFriendsStep2" || id=="DeleteMembersList" || id=="DeleteNonMembersList"){
		for(i=0;i<countArray;i++){
			spanId=id+"--"+i;
			if(document.getElementById(spanId).checked==true){
				txtValues = spanId;
				tvalues = document.getElementById(spanId).value;
				txtValue += tvalues+"||";
			}
		}
	}else{
		if(countArray>0){
			for(i=0;i<countArray;i++){
				spanId=id+"--"+i;				
				txtValues=spanId;
				if(document.getElementById(spanId))
					tvalues = document.getElementById(spanId).value;
				else 
					tvlaues ="";
				tvalues=tvalues.replace('&','__');
				txtValue+=tvalues+"||";
				
			}
		}else{
			txtValues = id;
			txtValue = id;
		}
	}
	
	txtValue = document.getElementById("Index_"+Countid).value+"||"+txtValue;//To Know Which index is edited
	Id = Countid.split("_");
	if( document.getElementById(id+"--2"))
		txtValue1 = document.getElementById(id+"--2").value
	else
		txtValue1 = "";
	if(document.getElementById(id+"--3"))
		SubCat1 = document.getElementById(id+"--3").value;	
	else
		SubCat1= "";
	document.getElementById("Edit_"+Countid).innerHTML = "<span onClick=GetDropDownList('"+id+"','"+Countid+"','"+SubCat1+"','"+ContentValues+"','"+filename+"')>Edit</span>";
	var Values = displayid;
	var success = function(t){Add_DetailsComplete(t, Values,Countid);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'objIdent=' +"Listing_"+ id + '&checkText=' + txtValue + '&id=' + Id[1]+'&contentValues='+ContentValues;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function Add_DetailsComplete(t,Values,Countid){	
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();	
	Countid = Countid.toString();
	//alert(strValue);
	if(strValue[0] != "")
		document.getElementById("Title_" + Countid).innerHTML = strValue[0];		
	document.getElementById("Content_"+document.getElementById("Refresh_"+Countid).value+"_"+Countid).innerHTML = strValue[1];	
	showAsEditable(Values, true);
}

function GetIndexData(type,spanId,ContentValues,id,FileName)
{	
	var Values = spanId;	
	var success = function(t){GetIndexDataComplete(t, Values,id);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
	var pars = 'objIdent='+"Listing_"+type+ '&id='+id+'&contentid='+type+'&contentValues='+ContentValues;  //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function GetIndexDataComplete(t,values,id)
{
	var strValue = t.responseText.split('||'); 	
	//alert(strValue);
	values = values.toString();	
	id = id.toString();		
	document.getElementById(values+"_PanelSpanId_"+id).innerHTML = strValue[1];
}

function index_edit_textbox(obj,size,type,spanId,displayid,ContentValues,FileName){
	Type = "Panel";
	ObjValue = obj;
	SizeValue = size;
	SapnidValue = spanId;
	ContentValue = ContentValues;
	FileNameText = FileName;
	DisplayId = displayid;
	
	obj = obj.toString();
	var mytool_array = obj.split("_");
	id = obj;
	prevValue = document.getElementById(id).innerHTML;
	Element.hide(id);	
	classname= "EditTxtBox";	
	//alert(document.getElementById("Index_Flag_"+displayid).style.display );
	if(document.getElementById("Index_Flag_"+displayid).style.display == "none")
	{
		var textbox ="<input id='"+id+"_edit' name='" +id+"' type='text' value=\""+document.getElementById(id).innerHTML+"\" size='"+size+"'  maxlength='5' class='"+classname+"'/ onkeyup=\"UpdateContent(this,'"+type+"','"+obj+"','"+spanId+"','"+displayid+"','"+ContentValues+"','"+FileName+"');\" onClick='disableWindowOnclick();'>";
		document.getElementById("Index_Flag_"+displayid).style.display = "inline";
		new Insertion.After(id, textbox);
		Field.focus(id + '_edit');
		textboxflag = 1
	}	
}
function Save_ZipCode(id,spanid,indexid,type,Zipcode,ContentValues,FileName)
{
	index =  document.getElementById("Index_PanelSpanId_"+indexid).value	
	var Values = spanid;	
	var success = function(t){Save_ZipCodeComplete(t, Values,type,indexid);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
	//alert(id);
	var pars = 'objIdent='+id+ '&Zipcode='+Zipcode+'&index='+index+'&indexid='+indexid+'&spanid='+spanid+'&type='+type+'&contentValues='+ContentValues; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function Update_ZipCode(id,spanid,indexid,type,Zipcode,city,state,country,contentValues,FileName){		
	
	city = city.replace('_',' ');
	state = state.replace('_',' ');
	country = country.replace('_',' ');
	var SubCat ='';
	document.getElementById("PanelSpanId_"+indexid).id = "PanelSpanId_"+indexid;
	document.getElementById("Edit_PanelSpanId_"+indexid).innerHTML = "<span onClick=GetDropDownList('"+type+"','PanelSpanId_"+indexid+"','"+SubCat+"','"+contentValues+"','"+FileName+"')>Edit</span>";
	document.getElementById(spanid).innerHTML = "<img src='images/loading.gif' />";
	index =  document.getElementById("Index_PanelSpanId_"+indexid).value
	index =  document.getElementById("Index_PanelSpanId_"+indexid).value	
	var Values = spanid;	
	var success = function(t){Update_ZipCodeComplete(t, Values,type,indexid);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
	var pars = 'objIdent='+id+ '&zipcode='+Zipcode+'&index='+index+'&indexid='+indexid+'&spanid='+spanid+'&type='+type+'&city='+city+'&state='+state+'&country='+country; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function Update_ZipCodeComplete(t,values,type,id)
{
	var strValue = t.responseText.split('||'); 
	values = values.toString();	
	id = id.toString();		
	//alert(spanid)	
	if(document.getElementById("ZipcodeLayer"))
		document.getElementById("ZipcodeLayer").style.display = "none";
		//alert(strValue[0]);
	if(strValue[0] != "")
		document.getElementById("Content_"+type+"_PanelSpanId_"+id).innerHTML = strValue[0];
	if(strValue[1] != "")
		document.getElementById("PanelRight_"+id).innerHTML = strValue[1];
	if(strValue[2] != "")
		prevValue = strValue[2];
	document.getElementById("Index_Flag_"+id).style.display = "none";

}

function GetRssIndexData(type,spanId,ContentValues,id,FileName)
{
	//document.getElementById(spanId+"_PanelSpanId_"+id).innerHTML = "";
	var Values = spanId;	
	var success = function(t){GetRssIndexDataComplete(t, Values,id);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
	var pars = 'objIdent='+type+ '&id='+id+'&contentid='+type+'&rsscontentValues='+ContentValues;	
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});

}
function GetRssIndexDataComplete(t,values,id)
{
	var strValue = t.responseText.split('||'); 	
	values = values.toString();	
	id = id.toString();	
	//alert(strValue)
	document.getElementById(values+"_PanelSpanId_"+id).innerHTML = strValue[0];
	/*For Temporary*/
	//document.getElementById(values+"_PanelSpanId_"+id).innerHTML = "";
	
	document.getElementById("RSSTitle_PanelSpanId_"+id).innerHTML = strValue[1];
}


function Add_ContentDetails(type,ContentValues,filename){ 
	var Values = "";
	var success = function(t){Add_ContentDetailsComplete(t);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'objIdent=' +"Listing_"+ type +'&contentValues='+ContentValues+'&updatetype=addcontent';
	
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function Add_ContentDetailsComplete(t){	
	var strValue = t.responseText.split('||'); 
	//alert(strValue);
}

function RemovePanel(Index,PanelId, FileName,PanelType)
{
	var Values = "";
	var success = function(t){RemovePanelComplete(t,PanelId,PanelType);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
	//alert(FileName);
    var pars = 'objIdent=DeletePanel'+'&index='+Index+'&paneltype='+PanelType;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function RemovePanelComplete(t,PanelId,PanelType){	
	var strValue = t.responseText.split('||');
	if(PanelType == "Services")
		document.getElementById("PanelBorder_"+PanelId).style.display = "none";
	else if(PanelType == "Feeds")
		document.getElementById("mediafile_"+PanelId).style.display = "none";
}