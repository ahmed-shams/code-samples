var Sliderloadstatustext="<img src='images/People_Loading.gif' />";
var ClockSliderloadstatustext="<img src='images/clocks.gif' />";
function _LocalPeopleListingLoad(RefId,Filename)
{
	document.getElementById('PerPageSponsorListings').innerHTML = Sliderloadstatustext;
	document.getElementById('PerPageListings').innerHTML 		= Sliderloadstatustext;
	document.getElementById('LeftPanel').innerHTML 				= ClockSliderloadstatustext;
	var Values = RefId;
	var success = function(t){_LocalPeopleListingLoadComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = Filename; 
    var pars = 'checkText=' + RefId; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function _LocalPeopleListingLoadComplete(t, Values)
{ //alert(t.responseText);
	var strValue = t.responseText.split('||'); 
	document.getElementById('LeftPanel').innerHTML 	= stripslashes(strValue[0],"\\","");
	document.getElementById('PerPageSponsorListings').innerHTML 	= stripslashes(strValue[1],"\\","");
	document.getElementById('TopPerPage').innerHTML 	= stripslashes(strValue[2],"\\","");
	document.getElementById('PerPageListings').innerHTML 	= stripslashes(strValue[3],"\\","");
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

function PersonalPerPage(spanid,page,viewtype,filename,orderby,Display)
{
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var SliderLocation =  document.getElementById("attachedFieldValue").value;
	var Values = Display;
	var success = function(t){PersonalPerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&viewtype='+ viewtype + '&sortby='+ orderby + '&range=' + SliderLocation; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function PersonalPerPageComplete(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("PerPageListings").vAlign 				= 	"Top";
	document.getElementById("PerPageListingsTD").vAlign 			= 	"Top";
	document.getElementById("TopPerPage").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById(Values).innerHTML 		= stripslashes(strValue[1],"\\","");
}

function SortByPeople(setValues,Value,FileName)
{
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";	
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext

	var success = function(t){SortByCompletePeoples(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&SortBy=' + Value; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function SortByCompletePeoples(t,Value)
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

function PeopleChangeCategoryDetails(setValues,Ident,TotalPeoples,Miles,View,FileName)
{	
	/*if(TotalPeoples == 0) 	{
		document.getElementById("NoPeopleTD").vAlign 	= "middle";
		document.getElementById("NoPeopleTD").height 	= "80";
		document.getElementById("NoPeople").innerHTML	= Sliderloadstatustext
	}
	if(TotalPeoples != 0) {
			//document.getElementById("SponsoredListingsTD").height 		= 215;
		document.getElementById("SponsoredListingsTD").vAlign 	= "middle";
		document.getElementById("PerPageSponsorListings").innerHTML	=	Sliderloadstatustext
	}*/
	document.getElementById("SponsoredListingsTD").vAlign 	= "middle";
	document.getElementById("PerPageSponsorListings").innerHTML	=	Sliderloadstatustext
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var success = function(t){PeopleChangeCategoryDetailsComplete(t,Ident,TotalPeoples);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident + '&range=' +  Miles + '&PeopleView=' + View+ '&TotalPeople=' + TotalPeoples; 
   // alert(pars)
	var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function PeopleChangeCategoryDetailsComplete(t,Ident,TotalPeoples)
{	
	var strValue = t.responseText.split('||'); 
	document.getElementById('PerPageSponsorListings').innerHTML 	= stripslashes(strValue[2],"\\","");
	document.getElementById('TopPerPage').innerHTML 	= stripslashes(strValue[3],"\\","");
	document.getElementById('PerPageListings').innerHTML 	= stripslashes(strValue[4],"\\","");
//alert(t.responseText);
	/*document.getElementById("PerPageListings").vAlign 			= "Top";
	document.getElementById("PerPageListingsTD").vAlign 		= "Top";
	document.getElementById("PerPageSponsorListings").vAlign 	= "Top";
	document.getElementById("SponsoredListingsTD").vAlign 		= "Top";

	var strValue = t.responseText.split('||');	
	//alert(strValue);
	if(TotalPeoples == 0) {
		document.getElementById("NoPeopleTD").height 				= "";
		document.getElementById("NoPeopleTD").vAlign 				= "Top";
		document.getElementById("ListingViewImages").innerHTML 		= stripslashes(strValue[0],"\\","");
		//document.getElementById("NoPeople").innerHTML 				= stripslashes(strValue[1],"\\","");
		document.getElementById("PerPageSponsorListings").innerHTML = stripslashes(strValue[2],"\\","");
		document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[3],"\\","");
		document.getElementById("PerPageListings").innerHTML 		= stripslashes(strValue[4],"\\","");
	}

	if(TotalPeoples != 0) {	
		//document.getElementById("ListingViewImages").innerHTML 		= stripslashes(strValue[0],"\\","");
		document.getElementById("PerPageSponsorListings").innerHTML = stripslashes(strValue[1],"\\","");
		document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[2],"\\","");
		document.getElementById("PerPageListings").innerHTML 		= stripslashes(strValue[3],"\\","");
	}*/
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
    var pars = 'setValues='+Ident+'&PeopleID='+Id;
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
	SendEmail(3,'SendEmail','localpeopleajax.php');
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


