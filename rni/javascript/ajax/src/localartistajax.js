var Sliderloadstatustext="<img src='images/loading-artists.gif' />";

function Category(setValues,Ident,FileName,ViewType)
{
	var Identvalue = Ident.replace('&','__');
	var success = function(t){CategoryComplete(t,Identvalue);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Identvalue + '&viewtype=' + ViewType;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function CategoryComplete(t,Values,spanId,Ident)
{	
	var strValue = t.responseText.split('||'); 
		document.getElementById("PerPageSponsorListings").innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[1],"\\","");
		document.getElementById("PerPageListings").innerHTML 		= stripslashes(strValue[2],"\\","");
		var Distance = stripslashes(strValue[3]);
		document.getElementById("NoArtist").innerHTML 		= stripslashes(strValue[4],"\\","");		
		document.getElementById("ListingViewImages").innerHTML 		= stripslashes(strValue[5],"\\","");
		
	ActiveClassName		= "VioletTabActive";
	InActiveClassName	= "VioletTabInActive"
	EmptyClassName		= "VioletTabEmpty"
	ActivePanelTab		= 1;
	startajaxtabs("MainTab");
	init();
	DynamicMiles = Distance;	
	ChageSliderText(DynamicMiles);
}

function SponsorPerPage(spanid,page,filename,orderby,Display)
{
	var Values = Display;
	var success = function(t){SponsorPerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&sortby='+ orderby; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function SponsorPerPageComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("PerPageListingsTD").vAlign 	= "Top";
	document.getElementById(Values).innerHTML 	= stripslashes(strValue[0],"\\","");
}

function ArtistPerPage(spanid,page,viewtype,filename,orderby,Display)
{
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var SliderLocation =  document.getElementById("attachedFieldValue").value;
	var Values = Display;
	var success = function(t){ArtistPerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&viewtype='+ viewtype + '&sortby='+ orderby + '&range=' + SliderLocation; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function ArtistPerPageComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("PerPageListings").vAlign 				= 	"Top";
	document.getElementById("PerPageListingsTD").vAlign 			= 	"Top";

	document.getElementById("TopPerPage").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById(Values).innerHTML 		= stripslashes(strValue[1],"\\","");
}

function SortByArtist(setValues,Value,FileName)
{
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";	
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext

	var success = function(t){SortByCompleteArtists(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&SortBy=' + Value; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function SortByCompleteArtists(t,Value)
{	
	document.getElementById("PerPageListingsTD").vAlign 	= "Top";
	document.getElementById("PerPageListings").vAlign 		=  "Top";
	document.getElementById("PerPageListings").innerHTML = stripslashes(t.responseText,"\\","");
}

function ListingView(setValue,ChangeValue,DispalyId,SliderLocation,FileName)
{
	var Values = DispalyId;
	//var SliderLocation =  document.getElementById("attachedFieldValue").value;
	var success = function(t){ListingViewComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName; 
    var pars = '&checkText=' + setValue + '&ChangeValue=' + ChangeValue + '&range=' + SliderLocation; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function ListingViewComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("PerPageListings").vAlign 				= 	"Top";
	document.getElementById("PerPageListingsTD").vAlign 			= 	"Top";
	document.getElementById("TopPerPage").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById(Values).innerHTML 		= stripslashes(strValue[1],"\\","");
}

function ArtistChangeCategoryDetails(setValues,Ident,TotalArtists,Miles,View,FileName)
{	
	if(TotalArtists == 0) 	{
		document.getElementById("SponsoredListingsTD").vAlign 	= "middle";
		document.getElementById("SponsoredListingsTD").height 	= 80;
		document.getElementById("PerPageSponsorListings").innerHTML	= Sliderloadstatustext
	}
	if(TotalArtists != 0) {
		//document.getElementById("SponsoredListingsTD").height 		= 215;
		document.getElementById("SponsoredListingsTD").vAlign 	= "middle";
		//document.getElementById("PerPageSponsorListings").innerHTML	=	Sliderloadstatustext
	}
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var success = function(t){ArtistChangeCategoryDetailsComplete(t,Ident,TotalArtists);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident + '&range=' +  Miles + '&ArtistView=' + View+ '&TotalArtist=' + TotalArtists; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ArtistChangeCategoryDetailsComplete(t,Ident,TotalArtists)
{	
	document.getElementById("PerPageListings").vAlign 			= "Top";
	document.getElementById("PerPageListingsTD").vAlign 		= "Top";
	document.getElementById("PerPageSponsorListings").vAlign 	= "Top";
	document.getElementById("SponsoredListingsTD").vAlign 		= "Top";
	var strValue = t.responseText.split('||');
	//alert(strValue);
	if(TotalArtists == 0) {
		document.getElementById("NoArtistTD").height 				= "";
		document.getElementById("NoArtistTD").vAlign 				= "Top";
		document.getElementById("ListingViewImages").innerHTML 		= stripslashes(strValue[0],"\\","");
		document.getElementById("NoArtist").innerHTML 				= stripslashes(strValue[1],"\\","");
		document.getElementById("PerPageSponsorListings").innerHTML = stripslashes(strValue[2],"\\","");
		document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[3],"\\","");
		document.getElementById("PerPageListings").innerHTML 		= stripslashes(strValue[4],"\\","");
		document.getElementById("LeftPanel").innerHTML 				= stripslashes(strValue[5],"\\","");
	}
	if(TotalArtists != 0) {
		//document.getElementById("ListingViewImages").innerHTML 		= stripslashes(strValue[0],"\\","");
		document.getElementById("PerPageSponsorListings").innerHTML = stripslashes(strValue[1],"\\","");
		document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[2],"\\","");
		document.getElementById("PerPageListings").innerHTML 		= stripslashes(strValue[3],"\\","");
		document.getElementById("LeftPanel").innerHTML 				= stripslashes(strValue[4],"\\","");
	}
}

function ViewFeaturedMembers(spanid,Display,filename)
{
	var Values = Display;
	var success = function(t){ViewFeaturedMembersComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; s
    var pars = 'checkText=' + spanid + '&p=' + page + '&sortby='+ orderby; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function ViewFeaturedMembersComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById(Values).innerHTML 	= stripslashes(strValue[0],"\\","");
}

function ShowInterestOverLayForm(obj,Ident,DisplayIdent,Name,FileName,XPOS,YPOS)
{
	var Values = DisplayIdent;
	var success = function(t){ShowInterestOverLayFormComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ListingName='+Name;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowInterestOverLayFormComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText;
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	return showInterstoverlay(Obj,Values,'',XPOS,YPOS);
}

function ShowSendEmailOverLayForm(obj,Ident,DisplayIdent,Id,FileName,XPOS,YPOS)
{
	var Values = DisplayIdent;
	var success = function(t){ShowSendEmailOverLayFormComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ArtistID='+Id;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowSendEmailOverLayFormComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText;
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	return sendemailoverlay(Obj,Values,'',XPOS,YPOS);
}

function ContactMemberValidation()
{
	objForm = document.frmSendEmail;
	if(!IsValid(objForm.Subject.value,"Subject"))
	{
		objForm.Subject.focus();
		return false;
	}
	SendEmail(3,'SendEmail','localartistajax.php');
}
function SendEmail(countArray,SpanID,FileName)
{
	var frmValues = "";
	var tvalues;
	for(i=0;i<countArray;i++)
	{
		spanId=SpanID+"--"+i;
		tvalues = document.getElementById(spanId).value;
		if(frmValues == "")
			frmValues = tvalues;
		else
			frmValues += "||"+tvalues;
	}
	var success = function(t){SendToPhoneComplete(t,spanId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
    var pars = '&setValues=' + SpanID +'&frmValues=' + frmValues; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function SendToPhoneComplete(t,spanId)
{	
	document.getElementById("showSendEmail").innerHTML = stripslashes(t.responseText,"\\","");
}
