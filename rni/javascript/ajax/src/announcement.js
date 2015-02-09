var Sliderloadstatustext="<img src='images/Announcement_loading.gif' />"
var LeftPanelLoad="<img src='images/clocks.gif' />";

function _leftPanelLoadDetail(_refId,_displayId,_fileName,whereClause)
{ //alert(whereClause);
	document.getElementById(_displayId).innerHTML 	=  LeftPanelLoad;
	var Values = _displayId;
	var success = function(t){_leftPanelLoadDetailComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = _fileName; 
    var pars = 'checkText=' + _refId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function _leftPanelLoadDetailComplete(t, Values)
{
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById(Values).innerHTML 								= stripslashes(strValue[0],"\\","");
}
function _leftPanelLoad(_refId,_displayId,_fileName,whereClause,Tags,CIdent)
{ //alert(whereClause);
	document.getElementById(_displayId).innerHTML 	=  LeftPanelLoad;
	if(document.getElementById('FeaturedListings'))document.getElementById('FeaturedListings').innerHTML 	=  Sliderloadstatustext;
	if(document.getElementById('FreeListingSort'))document.getElementById('FreeListingSort').innerHTML 	=  Sliderloadstatustext;
	var Values = _displayId;
	var success = function(t){_leftPanelLoadComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = _fileName; 
    var pars = 'checkText=' + _refId + '&whereClause=' + whereClause + '&Tags=' + Tags + '&CIdent=' + CIdent;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function _leftPanelLoadComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById(Values).innerHTML 								= stripslashes(strValue[0],"\\","");
	if(document.getElementById('FeaturedListings'))document.getElementById('FeaturedListings').innerHTML 					= stripslashes(strValue[1],"\\","");
	if(document.getElementById('FreeListingSort'))document.getElementById('FreeListingSort').innerHTML 					= stripslashes(strValue[2],"\\","");
	if(document.getElementById('AtoZLinks'))document.getElementById('AtoZLinks').innerHTML 					        = stripslashes(strValue[3],"\\","");
	if(document.getElementById('TopPerPage'))document.getElementById('TopPerPage').innerHTML 					        = stripslashes(strValue[4],"\\","");
}
function Category(setValues,Ident,FileName)
{
	if(document.getElementById('FeaturedListings'))document.getElementById('FeaturedListings').innerHTML 	=  Sliderloadstatustext;
	if(document.getElementById('FreeListingSort'))document.getElementById('FreeListingSort').innerHTML 	=  Sliderloadstatustext;
	var success = function(t){CategoryComplete(t,Ident);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function CategoryComplete(t,Values,spanId,Ident)
{	
	var strValue = t.responseText.split('||'); 
	document.getElementById("MainListing").innerHTML 			= stripslashes(strValue[0],"\\","");	
	document.getElementById("AnnouncementCategories").innerHTML = stripslashes(strValue[1],"\\","");	
	document.getElementById("LocalNewsHeader").innerHTML 		= stripslashes(strValue[2],"\\","");	
	document.getElementById("FeaturedListings").innerHTML 		= stripslashes(strValue[3],"\\","");		
	document.getElementById("FreeListings").innerHTML 			= stripslashes(strValue[4],"\\","");
	document.getElementById("TabListings").innerHTML 			= stripslashes(strValue[5],"\\","");	
	document.getElementById("FreeListingSort").innerHTML 		= stripslashes(strValue[8],"\\","");	
	document.getElementById('AtoZLinks').innerHTML 				= stripslashes(strValue[9],"\\","");
	Distance  = stripslashes(strValue[6],"\\",""); 
	ActiveClassName		= "VioletTabActive";
	InActiveClassName	= "VioletTabInActive"
	EmptyClassName		= "VioletTabEmpty"
	ActivePanelTab		= 1;	
	startajaxtabs("MainTab");
	SliderState = strValue[7];
	DynamicMiles = Distance;	
	init();
	ChageSliderText(DynamicMiles);
}
function AnnouncementsPerPage(spanid,page,opvalue,usrid,orderby,filename,Display)   //This Function  used to display the Announcements PerPage
{ 
	var Values = Display;
	var success = function(t){AnnouncementsPerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&c='+ opvalue + '&ml='+ usrid + '&sortby='+ orderby;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AnnouncementsPerPageComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[0],"\\","");
	document.getElementById(Values).innerHTML 					= stripslashes(strValue[1],"\\","");
}
function SortBy(setValues,Value,Ident,FileName)
{ 
	document.getElementById("FreeListingTable").vAlign   = "middle";
	document.getElementById("FreeListingTable").align   = "center"; 
	document.getElementById("FreeListingSort").innerHTML=Sliderloadstatustext
	var success = function(t){SortByComplete(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&SortBy=' + Value + '&Ident=' + Ident;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SortByComplete(t,Values,spanId,Value)
{	
	var strValue = t.responseText.split('||'); 
	//Values = Values.toString();
	document.getElementById("FreeListingTable").vAlign   = "top";
	document.getElementById("FreeListingTable").align   = "left"; 
	document.getElementById("FreeListingSort").innerHTML 			= stripslashes(strValue[0],"\\","");
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
	document.getElementById("MainListing").innerHTML 			= stripslashes(strValue[0],"\\","");
	document.getElementById("AnnouncementCategories").innerHTML = stripslashes(strValue[1],"\\","");
	document.getElementById("LocalNewsHeader").innerHTML 		= stripslashes(strValue[2],"\\","");
	document.getElementById("FeaturedListings").innerHTML 		= stripslashes(strValue[3],"\\","");
	document.getElementById("FreeListings").innerHTML 			= stripslashes(strValue[4],"\\","");
	document.getElementById("TabListings").innerHTML 			= stripslashes(strValue[5],"\\","");
	ActiveClassName		= "VioletTabActive";
	InActiveClassName	= "VioletTabInActive"
	EmptyClassName		= "VioletTabEmpty"
	ActivePanelTab		= 1;
}

function ChangeCategoryDetails(setValues,Ident,Miles,FileName)
{	
	//alert(document.getElementById("FreeListingSort").sty);
	//alert(document.getElementById("FreeListingTable").vAlign);
	//FreturedListingTd	
	document.getElementById("FreturedListingTd").height   = "60";
	document.getElementById("FreturedListingTd").vAlign   = "middle";
	document.getElementById("FreeListingTable").vAlign   = "middle";
	document.getElementById("FreeListingTable").align   = "center"; 
	document.getElementById("FreeListingSort").innerHTML=Sliderloadstatustext
	document.getElementById("FeaturedListings").innerHTML=Sliderloadstatustext
	var success = function(t){ChangeCategoryDetailsComplete(t,Ident);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident + '&range=' +  Miles; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ChangeCategoryDetailsComplete(t,Values,spanId,Ident)
{	
	var strValue = t.responseText.split('||'); ;
	Values = Values.toString();//alert(strValue[3])
	//alert(strValue)
	//document.getElementById("MainListing").innerHTML 			= stripslashes(strValue[0],"\\","");
	if(strValue[3] == "")
		document.getElementById("FreturedListingTd").height   = "10";
	document.getElementById("FreeListingTable").vAlign    = "Top";
	document.getElementById("FreeListingTable").align     = "left";
	document.getElementById("FreturedListingTd").vAlign   = "Top";	
	document.getElementById("TopPerPage").vAlign   = "Top";	
	document.getElementById("AnnouncementCategories").innerHTML = stripslashes(strValue[1],"\\","");	
	document.getElementById("LocalNewsHeader").innerHTML 		= stripslashes(strValue[2],"\\","");
	document.getElementById("FeaturedListings").innerHTML 		= stripslashes(strValue[3],"\\","");	
	document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[4],"\\","");
	document.getElementById("FreeListingSort").innerHTML 		= stripslashes(strValue[5],"\\","");
	document.getElementById("TabListings").innerHTML 			= stripslashes(strValue[6],"\\","");
	document.getElementById("LeftPanel").innerHTML 				= stripslashes(strValue[7],"\\","");
	//document.getElementById("SiteTitle").innerHTML 				= "World";
	document.getElementById("FreeListingTPL").innerHTML 				= stripslashes(strValue[8],"\\","");	
	
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
	document.getElementById("spGetDirection").innerHTML=Sliderloadstatustext
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
	document.getElementById("FreeListingTable").vAlign 		= "middle";
	document.getElementById("FreeListingTable").align 		= "center"; 
	document.getElementById("FreeListingSort").innerHTML	=	Sliderloadstatustext
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
	document.getElementById("FreeListingTable").vAlign 		= "top";
	document.getElementById("TopPerPage").innerHTML 		= stripslashes(strValue[0],"\\","");
	document.getElementById("FreeListingSort").innerHTML 	= stripslashes(strValue[1],"\\","");
	document.getElementById("AtoZLinks").innerHTML 			= stripslashes(strValue[2],"\\","");
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
{
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
	}

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
{	//alert(t.responseText)
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
function RateItOverLayForm(obj,Ident,DisplayIdent,ListingIdent,FileName,XPOS,YPOS)
{
	var Values = DisplayIdent;
	var success = function(t){RateItOverLayFormComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ListintIdent='+ListingIdent;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function RateItOverLayFormComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	return reviewoverlay(Obj,Values,'',XPOS,YPOS);
}

function editFailed(t, Values)
{
}
function ShowBlogBook(obj,Ident,DisplayIdent,FileName,XPOS,YPOS)
{
	var Values = DisplayIdent;
	var success = function(t){ShowBlogBookComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowBlogBookComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('Message').innerHTML = "Loading ...";
	return reviewoverlay(Obj,Values,'',XPOS,YPOS);
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
	document.getElementById('LayerForm').innerHTML = strValue;
}
function overlayclose(){
	document.getElementById('LayerContent').style.display="none"
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
{	//alert(t.responseText);
	var strValue = Array();
	strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById('DetailBody').innerHTML = strValue[2];
	document.getElementById('LocalNewsHeader').innerHTML = strValue[1];
	document.getElementById('DetailTop').innerHTML = strValue[0];
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

