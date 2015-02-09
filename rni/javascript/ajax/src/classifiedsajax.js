var Sliderloadstatustext="<img src='images/Classifieds_Loading.gif' />";
var LeftPanelLoad="<img src='images/clocks.gif' />";
function PostClassifiedsHere()
{
	document.location="../postclassifieds.php";
}
function _leftPanelLoad(_refId,_displayId,_fileName,CatId)
{
	document.getElementById(_displayId).innerHTML 	=  LeftPanelLoad;
	if(document.getElementById('SponsoredListings'))document.getElementById('SponsoredListings').innerHTML 	=  Sliderloadstatustext;
	if(document.getElementById('PerPageListings'))document.getElementById('PerPageListings').innerHTML 	=  Sliderloadstatustext;
	var Values = _displayId;
	var success = function(t){_leftPanelLoadComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = _fileName; 
    var pars = 'checkText=' + _refId + '&CatId=' + CatId ;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function _leftPanelLoadComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById(Values).innerHTML 								= stripslashes(strValue[0],"\\","");
	if(document.getElementById('SponsoredListings'))document.getElementById('SponsoredListings').innerHTML 					= stripslashes(strValue[1],"\\","");
	if(document.getElementById('PerPageListings'))document.getElementById('PerPageListings').innerHTML 					= stripslashes(strValue[2],"\\","");
	if(document.getElementById('AtoZLinks'))document.getElementById('AtoZLinks').innerHTML 					        = stripslashes(strValue[3],"\\","");
	if(document.getElementById('TopPerPage'))document.getElementById('TopPerPage').innerHTML 					        = stripslashes(strValue[4],"\\","");
}
function _leftPanelLoadDetail(_refId,_displayId,_fileName)
{
	document.getElementById(_displayId).innerHTML 	=  LeftPanelLoad;
	var Values = _displayId;
	var success = function(t){_leftPanelLoadDetailComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = _fileName; 
    var pars = 'checkText=' + _refId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function _leftPanelLoadDetailComplete(t, Values)
{// alert(t.responseText)
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById(Values).innerHTML 								= stripslashes(strValue[0],"\\","");
}
function EditClassifieds(Ident,TypeAction)
{ 
	document.getElementById('fAction').value = TypeAction;
	document.getElementById('ProductIdent').value = Ident;
	document.frmClassifields.submit();
}
function DeleteClassifieds(Ident,TypeAction)
{ alert(TypeAction);
	if(!confirm('Do you want to delete the record'))
		return false;
	document.getElementById('fAction').value = TypeAction;
	document.getElementById('ProductIdent').value = Ident;
	document.frmClassifields.submit();
}
function ClassifiedListingPerPage(spanid,page,filename,Display)   
{ 
	var Values = Display;
	var success = function(t){ClassifiedListingPerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page ;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ClassifiedListingPerPageComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("spProfileDisplay").innerHTML 			= stripslashes(strValue[0],"\\","");
	document.getElementById(Values).innerHTML 					= stripslashes(strValue[1],"\\","");
}
function Category(setValues,Ident,FileName)
{
	if(document.getElementById('SponsoredListings'))document.getElementById('SponsoredListings').innerHTML 	=  Sliderloadstatustext;
	if(document.getElementById('PerPageListings'))document.getElementById('PerPageListings').innerHTML 	=  Sliderloadstatustext;
	var success = function(t){CategoryComplete(t,Ident);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function CategoryComplete(t,Values,spanId,Ident)
{	
	var strValue = t.responseText.split('||');
	Values = Values.toString();
	document.getElementById("MainListing").innerHTML 				= stripslashes(strValue[0],"\\","");
	document.getElementById("CategoryListing").innerHTML 			= stripslashes(strValue[1],"\\","");
	document.getElementById("LocalDealsHeader").innerHTML 			= stripslashes(strValue[2],"\\","");
	document.getElementById("TabListings").innerHTML 				= stripslashes(strValue[3],"\\","");
	document.getElementById("SponsoredListings").innerHTML 			= stripslashes(strValue[4],"\\","");
	document.getElementById("PerPageListings").innerHTML 			= stripslashes(strValue[5],"\\","");
	document.getElementById("AtoZLinks").innerHTML 					= stripslashes(strValue[6],"\\","");
	//document.getElementById("LeftPanel").innerHTML 					= stripslashes(strValue[8],"\\","");
	Distance  = stripslashes(strValue[7],"\\","");
	ActiveClassName		= "VioletTabActive";
	InActiveClassName	= "VioletTabInActive";
	EmptyClassName		= "VioletTabEmpty";
	ActivePanelTab		= 1;
	startajaxtabs("MainTab");
	SliderState = strValue[9];
	DynamicMiles = Distance;	
	init();
	ChageSliderText(DynamicMiles);
}

function ClassifidesPerPage(spanid,page,filename,orderby,Display)
{
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var Values = Display;
	var success = function(t){ClassifiedsPerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&sortby='+ orderby; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ClassifiedsPerPageComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[0],"\\","");
	document.getElementById(Values).innerHTML 					= stripslashes(strValue[1],"\\","");
}

function SortByClassifieds(setValues,Value,Ident,FileName)
{
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";	
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext

	var success = function(t){SortByCompleteClassifieds(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&SortBy=' + Value + '&Ident=' + Ident; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function SortByCompleteClassifieds(t,Value)
{
	document.getElementById("PerPageListingsTD").vAlign 	= "top";	
	document.getElementById("PerPageListings").innerHTML = stripslashes(t.responseText,"\\","");
}

function MoreListing(setValues,Ident,UserId,FileName)
{ 
	var success = function(t){MoreListingComplete(t,Ident);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident + '&ml=' + UserId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function MoreListingComplete(t,Values,spanId,Ident)
{	
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
//	document.getElementById("MainListing").innerHTML 			= stripslashes(strValue[0],"\\","");
	document.getElementById("CategoryListing").innerHTML 		= stripslashes(strValue[1],"\\","");
	document.getElementById("SponsoredListings").innerHTML 		= stripslashes(strValue[2],"\\","");
	document.getElementById("PerPageListings").innerHTML 		= stripslashes(strValue[3],"\\","");
	document.getElementById("TabListings").innerHTML 			= stripslashes(strValue[4],"\\","");
	ActiveClassName		= "VioletTabActive";
	InActiveClassName	= "VioletTabInActive"
	EmptyClassName		= "VioletTabEmpty"
	ActivePanelTab		= 1;
	startajaxtabs("MainTab");
}

function ChangeCategoryDetails(setValues,Ident,Miles,FileName)
{	
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("SponsoredListingsTD").vAlign 	= "middle";
	document.getElementById("SponsoredListingsTD").height 	=  10;
	document.getElementById("SponsoredListings").innerHTML	=	Sliderloadstatustext
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var success = function(t){ChangeCategoryDetailsComplete(t,Ident);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident + '&range=' +  Miles; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ChangeCategoryDetailsComplete(t,Values,spanId,Ident)
{	
	document.getElementById("SponsoredListingsTD").vAlign 	    =   "Top";
	document.getElementById("PerPageListings").vAlign 			= 	"Top";
	document.getElementById("SponsoredListings").vAlign 		= 	"Top";
	var strValue = t.responseText.split('||');
	Values = Values.toString();
	//document.getElementById("MainListing").innerHTML 			= stripslashes(strValue[0],"\\","");
	//alert(stripslashes(strValue[1],"\\",""));
	document.getElementById("CategoryListing").innerHTML 		= stripslashes(strValue[1],"\\","");	
	document.getElementById("SponsoredListings").innerHTML 		= stripslashes(strValue[2],"\\","");
	document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[3],"\\","");
	document.getElementById("PerPageListings").innerHTML 		= stripslashes(strValue[4],"\\","");
	document.getElementById("TabListings").innerHTML 			= stripslashes(strValue[5],"\\","");
	document.getElementById("FreeListingTPL").innerHTML 		= stripslashes(strValue[6],"\\","");
	document.getElementById("AtoZLinks").innerHTML 				= stripslashes(strValue[7],"\\","");
	document.getElementById("CategoryListing").vAlign 			= 	"Top";

	if (stripslashes(strValue[4],"\\","") == "")
	{
		document.getElementById("AtoZLinks").style.display			 = "none";
		document.getElementById("SortByTitle").style.visibility  	 = "hidden";	
		document.getElementById("SortByBox").style.visibility   	 = "hidden";
	}
	else
	{
		document.getElementById("AtoZLinks").style.display 			= "inline";	
		document.getElementById("SortByTitle").style.visibility  	= "visible";	
		document.getElementById("SortByBox").style.visibility   	= "visible";
	}
	//document.getElementById("Loading1").innerHTML="";
	ActiveClassName		= "VioletTabActive";
	InActiveClassName	= "VioletTabInActive"
	EmptyClassName		= "VioletTabEmpty"
	ActivePanelTab		= 1;
	startajaxtabs("MainTab");
	
}

function setDirection(setValues,Ident,FileName)
{
	var success = function(t){DirectionComplete(t,Ident);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function DirectionComplete(t,Values,spanId,Ident)
{	
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("spGetDirection").innerHTML 				= stripslashes(strValue[0],"\\","");
}

function AtoZListing(spanid,listingletter,filename,Display)
{
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var Values = Display;
	var success = function(t){AtoZListingComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&alpha=' + listingletter; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AtoZListingComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("PerPageListingsTD").vAlign 	= "top";
	document.getElementById("TopPerPage").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById(Values).innerHTML 		= stripslashes(strValue[1],"\\","");
	document.getElementById("AtoZLinks").innerHTML 	= stripslashes(strValue[2],"\\","");
}

function ShowRateEdit(SpanId,DisplayId,ListintIdent,ReviewIdent,FileName)
{
	var success = function(t){ShowRateEditComplete(t,DisplayId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
    var pars = '&setValues=' + SpanId +'&ReviewIdent=' + ReviewIdent +'&ListintIdent=' + ListintIdent;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowRateEditComplete(t,spanId)
{
	document.getElementById(spanId).innerHTML 	= stripslashes(t.responseText,"\\","");
}
function RateIt(countArray,SpanID,FileName,ReviewCheck)
{ //alert(countArray)
	var frmValues = "";
	var tvalues;
	if(ReviewCheck == '')
		ReviewCheck = 0;
	for(i=0;i<countArray;i++)
	{
		spanId=SpanID+"--"+i;
		tvalues = document.getElementById(spanId).value;
		if(frmValues == "")
			frmValues = tvalues;
		else
			frmValues += "||"+tvalues;
	} //alert(frmValues)
	var ratetvalues = document.getElementById('RateIt--1').value;
	var Producttvalues = document.getElementById('RateIt--0').value;
	var success = function(t){RateItComplete(t,spanId,ratetvalues,Producttvalues);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
    var pars = '&setValues=' + SpanID +'&frmValues=' + frmValues +'&HideValue=' + ReviewCheck; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function RateItComplete(t,spanId,rate,Ident)
{	//alert(t.responseText);
	var strValue = Array();
	strValue = t.responseText.split('||'); 
	wrapper_full(Ident,0,0,0,0,0,0,0,strValue[0],strValue[1]);
	if(document.getElementById("RatingImage"))
		document.getElementById("RatingImage").innerHTML 	= stripslashes(strValue[4],"\\","");
	if(strValue[1] == 1)
		document.getElementById(Ident+"_vote").innerText 	= " vote";
	else
		document.getElementById(Ident+"_vote").innerText 	= " votes";
	
	
	if(strValue[1] != 0)
		document.getElementById("viewReview").innerHTML 	= "Your review";
	
	document.getElementById("spLatestReviews").innerHTML 	= stripslashes(strValue[2],"\\","");
	//overlayclose('rateitContent');
}
function AddReviewFormFunction(SpanId,Ident,Filename)
{
	var success = function(t){AddReviewFormFunctionComplete(t,SpanId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = Filename;
    var pars = '&setValues=' + SpanId +'&Ident=' + Ident; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AddReviewFormFunctionComplete(t,SpanId)
{
	var strValue = t.responseText; 
	document.getElementById('Addreview').innerHTML = strValue;
}
function RateItOverLayForm(obj,Ident,DisplayIdent,ListingIdent,FileName,XPOS,YPOS,Comment)
{
	var Values = DisplayIdent;
	var success = function(t){RateItOverLayFormComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ListintIdent='+ListingIdent+'&Comment='+Comment;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function RateItOverLayFormComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	return reviewoverlay(Obj,Values,'',XPOS,YPOS);
}
function OverLayCloseImgOver()
{
	document.getElementById("CloseImg").src = "images/close-red.gif";
}
function OverLayCloseImgOut()
{
	document.getElementById("CloseImg").src = "images/close-green.gif";
}
function overlayclose1(){
	document.getElementById('LayerContent').style.display="none"
}

function BookMarkOverLayUpdate(obj,Ident,DisplayIdent,ListingIdent,FileName,XPOS,YPOS,Title,Blog,PName)
{
	var Layers = '';
	Layers += "<span style='width:500px; nowrap'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
	if(Ident == 'showBlogUpdated')
		Layers += "<td width='94%' valign='top' class='OverLayTitle'>Blog It</td>";
	else
		Layers += "<td width='94%' valign='top' class='OverLayTitle'>BookMark</td>";
	Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlayclose1();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
	Layers += "</tr><tr><td align='center' class='GreenFont'><span id='LayerForm'>Loading ...</span></td></tr></table></span>";
	document.getElementById('LayerContent').innerHTML 	= Layers;
	reviewoverlay(obj,'LayerContent','',XPOS,YPOS);
	var Values = DisplayIdent;
	var success = function(t){BookMarkOverLayUpdateComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&b='+ListingIdent+'&Title='+Title+'&l='+ListingIdent+'&t='+Blog+'&PName='+PName; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function BookMarkOverLayUpdateComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	//wrapper_full(Ident,0,0,0,0,0,0,0,strValue[0],strValue[1]);
	document.getElementById('LayerForm').innerHTML = strValue;
}
function PreviousNext(RefId,Ident,FileName)
{
	document.getElementById('DetailBody').innerHTML 	=  LeftPanelLoad;
	var Values = RefId;
	var success = function(t){PreviousNextComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+RefId+'&d='+Ident; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function PreviousNextComplete(t,Values)
{	
	var strValue = Array();
	strValue = t.responseText.split('||');  
	Values = Values.toString();
	document.getElementById('DetailBody').innerHTML = strValue[0];
	document.getElementById('LocalDealsHeader').innerHTML = strValue[1];
	document.getElementById('DetailTop').innerHTML = strValue[2];
}
function editFailed(t, Values)
{
}


///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// Common Functions (Related to PHP) start here ////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
function parseArrayString(temp,Loop)
{
	var tempArray = new Array();
	tempArray = temp.split("\n");
	if(Loop == "Yes")
	{
		return tempArray;
	}
	else if(Loop == "No")
	{
		return tempArray;
	}
}
function stripslashes( str, from, to ) 
{
	var idx = str.indexOf( from );
    while ( idx > -1 ) 
	{
        str = str.replace( from, to ); 
        idx = str.indexOf( from );
    }
    return str;
}
function removeChar(input) 
{
	var output = "";
	for (var i = 0; i < input.length; i++) 
	{
		if ((input.charCodeAt(i) == 13) && (input.charCodeAt(i + 1) == 10)) 
		{
			i++;
			output += " ";
		} 
		else 
		{
			output += input.charAt(i);
	   }
	}
	return output;
}
function Trim(TRIM_VALUE)
{
	if(TRIM_VALUE.length < 1)
	{
		return"";
	}
	TRIM_VALUE = RTrim(TRIM_VALUE);
	TRIM_VALUE = LTrim(TRIM_VALUE);
	if(TRIM_VALUE=="")
	{
		return "";
	}
	else
	{
		return TRIM_VALUE;
	}
} //End Function
function RTrim(VALUE)
{
	var w_space = String.fromCharCode(32);
	var v_length = VALUE.length;
	var strTemp = "";
	if(v_length < 0)
	{
		return"";
	}
	var iTemp = v_length -1;
	while(iTemp > -1)
	{
		if(VALUE.charAt(iTemp) == w_space)
		{
		}
		else
		{
			strTemp = VALUE.substring(0,iTemp +1);
			break;
		}
		iTemp = iTemp-1;
	} 
	return strTemp;
} 
function LTrim(VALUE)
{
	var w_space = String.fromCharCode(32);
	if(v_length < 1)
	{
		return"";
	}
	var v_length = VALUE.length;
	var strTemp = "";
	var iTemp = 0;
	while(iTemp < v_length)
	{
		if(VALUE.charAt(iTemp) == w_space)
		{
		}
		else
		{
			strTemp = VALUE.substring(iTemp,v_length);
			break;
		}
		iTemp = iTemp + 1;
	} 
	return strTemp;
} 
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// Common Functions (Related to PHP) End here ////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

