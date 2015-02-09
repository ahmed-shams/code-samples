// JavaScript Document
function LoadArtistPage(spanid,Ident,FileName)
{
	var success = function(t){LoadArtistPageComplete(t,spanid);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars =  'objIdent=' + Ident;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function LoadArtistPageComplete(t,spanId)
{	
	var strValue = t.responseText.split('||'); 
	//alert(strValue)	
	document.getElementById(spanId).innerHTML 			= stripslashes(strValue[0],"\\","");

}

function LoadArtistAlbumPage(spanid,Ident,AlbumId,FileName)
{
	var success = function(t){LoadArtistPageComplete(t,spanid);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars =  'objIdent=' + Ident +'&AlbumId='+AlbumId;
	//alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function LoadArtistAlbumPageComplete(t,spanId)
{	
	//alert(t.responseText);
	var strValue = t.responseText.split('||'); 
	alert(strValue[0])	
	document.getElementById(spanId).innerHTML 			= stripslashes(strValue[0],"\\","");
}

function __AlbumDetails(spanid,AlbumId,displayId,FileName){
	var success = function(t){loadAlbumDetails(t,displayId);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars =  'objIdent=' + spanid +'&AlbumId='+AlbumId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function loadAlbumDetails(t,displayId){	
	var strValue = t.responseText; 
	document.getElementById(displayId).innerHTML = strValue;
}

function __getSingleAlbumDetails(spanid,AlbumId,FileName){
	var success = function(t){loadSingleAlbumDetails(t,spanid);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars =  'objIdent=' + spanid +'&AlbumId='+AlbumId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function loadSingleAlbumDetails(t,spanid){	
	var strValue = t.responseText.split('||');
	document.getElementById('showTitle').innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById('showDetails').innerHTML = stripslashes(strValue[1],"\\","");
}

function edit_ScrollBar(btobj,obj,noofscrolls,rows,cols,scrollcolor)
{	
	obj = obj.toString();
	var mytool_array = obj.split("_");
	var id = mytool_array[0];
	var selectValue;
	
	var selectedId = getValues(id);	
	var selectoption = new Array();
	for(j=1; j<=noofscrolls; j++)
	{
		selectoption[j] = "<select  id='"+id+j+"' class='SelectTxtBox' style='width:"+150+"'>";
		currentValues = document.getElementById(id+j).innerHTML;
		currentValues = currentValues.replace('&amp;','&');
		selectoption[j] += "<option value=''>Choose One</option>";
		for(var i=0;i<selectedId.length;i++)
		{
			if(selectedId[i] == currentValues)
				selectValue = "selected";
			else
				selectValue = "";
			selectoption[j] += '<option value=\"'+selectedId[i]+'\" '+selectValue+'>'+selectedId[i]+'</option>';
		}
			selectoption[j] += "</select>";	
	}
	var ChangeText = "<span id ='"+btobj+"'><span id = '" +id+"_save' onClick='SaveBandGenre(\""+btobj+"\",\""+id+"\","+noofscrolls+",\"getEditableValue_Personal.php\");'>Save</span>&nbsp;&nbsp;<span id ='"+ id+"_cancle' onClick='SaveBandGenreComplete(\"\",\""+btobj+"\",\""+id+ "\",\""+noofscrolls+"\")'>Cancel</span></span>";

	
	document.getElementById(btobj).innerHTML = ChangeText;
	for(j=1; j<=noofscrolls; j++)
	{
		document.getElementById(id+"_"+j).innerHTML = selectoption[j];
	}
}
function SaveBandGenre(btspanId,spanid,noofscrolls,FileName)
{
	var DataArray  = new Array();
	for(i = 1;i<=noofscrolls;i++)
	{
		DataArray[i] = document.getElementById(spanid+i).value;
	}
	
	if(noofscrolls == "1")
	{
		var value1 = DataArray[1];
	}
	if(noofscrolls == "3")
	{
		var value1 = DataArray[1].replace('&','|||');
		var value2 = DataArray[2].replace('&','|||');
		var value3 = DataArray[3].replace('&','|||');
	}

	var success = function(t){SaveBandGenreComplete(t, btspanId,spanid,noofscrolls);}
	var failure = function(t){editFailed(t,btspanId, spanid,noofscrolls);}
	var url = FileName;
    var pars = 'checkText=' + spanid + '&value1=' + value1 + '&value2=' + value2+'&value3='+value3;//alert(pars);   
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SaveBandGenreComplete(t,btspanId,spanid,noofscrolls)
{
	//alert(t.responseText);
	document.getElementById(btspanId).innerHTML ="<span id='"+btspanId+"' onClick='edit_ScrollBar(\""+btspanId+"\",\""+spanid+"\","+noofscrolls+",5,99,\"#07347D\")'> Edit </span>";
	for(i = 1;i<=noofscrolls; i++)
	{		
		document.getElementById(spanid+"_"+i).innerHTML = "<span id="+spanid+i+">"+document.getElementById(spanid+i).value+"</span>";		
		
	}
}
function save_banddetails(Ident,DisplayId,AId,FileName)
{
	var Values = DisplayId;
	var success = function(t){save_banddetailsComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
    var pars = 'checkText=' + AId + '&objIdent=' + Ident;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function save_banddetailsComplete(t, Values)
{
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();	
	//alert(strValue)
	document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
}

function save_displayorderUp(DisplayOrder,DisplayId,AId,AlbumIdent,FileName)
{ 
	var Values = DisplayId;
	var success = function(t){save_displayorderUpComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
    var pars = 'checkText=' + AId + '&objIdent=' + DisplayOrder + '&AlbumIdent=' + AlbumIdent;  
	//alert(pars);  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function save_displayorderUpComplete(t, Values)
{	//alert(t.responseText);
	//return false;
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();	
	document.getElementById(Values).innerHTML = strValue[0];
}
function save_displayorderDown(DisplayOrder,DisplayId,AId,AlbumIdent,FileName)
{
	var Values = DisplayId;
	var success = function(t){save_displayorderDownComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
    var pars = 'checkText=' + AId + '&objIdent=' + DisplayOrder + '&AlbumIdent=' + AlbumIdent;    
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function save_displayorderDownComplete(t, Values)
{
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();	
	//alert(strValue)
	document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
}
function save_showsdetails(Ident,DisplayId,AId,FileName)
{
	var Values = DisplayId;
	var success = function(t){save_showsdetailsComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
    var pars = 'checkText=' + AId + '&objIdent=' + Ident;    
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function save_showsdetailsComplete(t, Values)
{
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();	
	//alert(strValue)
	document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
}
function save_deleteshows(Ident,DisplayId,AId,FileName)
{
	var Values = DisplayId;
	var success = function(t){save_deleteshowsComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
    var pars = 'checkText=' + AId + '&objIdent=' + Ident;    
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function save_deleteshowsComplete(t, Values)
{
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();	
	document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
}


function ViewShows(RefId,ShowIdent,Filename)
{
	var Values = RefId;
	var success = function(t){ViewShowsComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
    var pars = 'checkText='+RefId+'&ShowIdent='+ShowIdent; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ViewShowsComplete(t,Values)
{	
	//alert(t.responseText)
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('spMainDiaplay').innerHTML = strValue;
	document.getElementById('loadFlash').style.display = "none";
}



function AddFans(RefId,ProductIdent,ProfileName,PageName,Filename)
{

	document.getElementById('FansAdded').innerHTML 	= "<font color=#FF0000 size=1>Adding...</font>";
	var Values = RefId;
	var success = function(t){AddFansComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
    var pars = 'checkText='+RefId+'&PersonalIdent='+ProductIdent+'&MemberIdent='+ProfileName+'&PageName='+PageName; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AddFansComplete(t,Values)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('FansAdded').innerHTML 	= "";
	document.getElementById('FansError').innerHTML 	= "";
	document.getElementById('FansList').innerHTML = strValue;
}
function RemoveFans(RefId,ProductIdent,ProfileName,PageName,Filename)
{
	document.getElementById('FansRemoving').innerHTML 	= "<font color=#FF0000 size=1>Deleting...</font>";
	var Values = RefId;
	var success = function(t){RemoveFansComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
    var pars = 'checkText='+RefId+'&PersonalIdent='+ProductIdent+'&MemberIdent='+ProfileName+'&PageName='+PageName; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function RemoveFansComplete(t,Values)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('FansRemoving').innerHTML 	= "";
	document.getElementById('FansList').innerHTML = strValue;
}

function overlaycloseVotes(){
	document.getElementById('VotesLayer').style.display="none"
}
function OverLayCloseImgOver()
{
	document.getElementById("CloseImg").src = "../images/close-red.gif";
}
function OverLayCloseImgOut()
{
	document.getElementById("CloseImg").src = "../images/close-green.gif";
}
function VotesDisplay(obj,RefId,Ident,XPOS,YPOS,FileName,ProductType)
{
		var Layers = '';
		Layers += "<span style='width:360px; nowrap'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
		Layers += "<td width='94%' valign='top' class='OverLayTitle'>Rating List</td>";
		Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlaycloseVotes();' style='cursor:pointer'><img src='../images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
		Layers += "</tr><tr><td align='center' class='GreenFont' valign='middle'><span id='LayerVote'>Loading ...</span></td></tr></table></span>";
		document.getElementById('VotesLayer').innerHTML 	= Layers;
		reviewoverlay(obj,'VotesLayer','',XPOS,YPOS);
		var Values = Ident;
		var success = function(t){VotesDisplayComplete(t,Values);}
		var failure = function(t){editFailed(t);}
		var url = FileName;
		var pars = 'setValues='+RefId+'&Ident='+Ident+'&ProductType='+ProductType; //alert(pars)
		var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function VotesDisplayComplete(t,Values)
{	
	//alert(t.responseText);
	var strValue = t.responseText; 
	Values = Values.toString();
	//LayerGrow(0,0,0,0,0,0,0,0,strValue);
	document.getElementById('LayerVote').innerHTML = strValue;
}

function PerPageRate(RefId,ProductType,Ident,FileName,StartLimit,EndLimit,ClickType)
{
	document.getElementById("VotesList").innerHTML = RatePanelLoad;
	var Values = RefId;
	var success = function(t){PerPageRateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName; 
    var pars = 'setValues=' + RefId + '&Ident=' + Ident+'&ProductType='+ProductType+'&StartLimit='+StartLimit+'&EndLimit='+EndLimit+'&ClickType='+ClickType; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function PerPageRateComplete(t, Values)
{ //alert(t.responseText);
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("VotesList").innerHTML 			= stripslashes(strValue[0],"\\","");
	/*document.getElementById(Values).innerHTML 					= stripslashes(strValue[1],"\\","");*/
}

