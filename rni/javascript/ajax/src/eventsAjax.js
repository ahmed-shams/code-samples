// JavaScript Document
var loadstatustext1="<img src='images/events-loading.gif'/>"
var RatePanelLoad="<img src='images/clocks.gif' />";
function YougetitFriends(FriendsList,Id)
{
	document.getElementById(Id).value = FriendsList;
}
function PreviousNext(RefId,Ident,FileName)
{ 
	document.getElementById('DetailBody').innerHTML 	=  RatePanelLoad;
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
	document.getElementById('DetailBody').innerHTML = strValue[1];
	document.getElementById('DetailTop').innerHTML = strValue[0];
}
function _detailLeftPanelLoad(RefId,Filename)
{
	document.getElementById('LeftCategoryPanel').innerHTML = RatePanelLoad;
	var success = function(t){_detailLeftPanelLoadComplete(t);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
    var pars = '&setValues=' + RefId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function _detailLeftPanelLoadComplete(t)
{
	document.getElementById('LeftCategoryPanel').innerHTML = t.responseText;
}
function ChangeCategoryDetails(setValues,Ident,Miles,FileName)
{	
	document.getElementById('DisplaySponser').innerHTML = loadstatustext1;
	document.getElementById('DisplayAll').innerHTML = loadstatustext1;

	var success = function(t){AllEventsDetailsComplete(t,Ident);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident + '&range=' +  Miles; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AtoZListing(spanid,listingletter,filename,Display)
{
	//document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("DisplayAll").innerHTML	=	loadstatustext1
	var Values = Display;
	var success = function(t){AllEventsDetailsComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&alpha=' + listingletter; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AllEventsDetails(ShowId,DisplayId,DisplayIdAll,Filename,TagsSearch,List,DC){ 
	var Values = DisplayId;
	document.getElementById('DisplaySponser').innerHTML = loadstatustext1;
	document.getElementById('DisplayAll').innerHTML = loadstatustext1;
	var success = function(t){AllEventsDetailsComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
    var pars = 'setValues='+ShowId+'&TagsSearch='+TagsSearch+'&List='+List+'&DC='+DC; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function trimString(sInString) {
  sInString = sInString.replace( /^\s+/g, "" );
  return sInString.replace( /\s+$/g, "" );
}
function AnnouncementsPerPage(spanid,page,opvalue,usrid,orderby,filename,Display)   //This Function  used to display the Announcements PerPage
{ 
	var Values = Display;
	//document.getElementById('DisplaySponser').innerHTML = loadstatustext1;
	document.getElementById('DisplayAll').innerHTML = loadstatustext1;
	var success = function(t){AllEventsDetailsComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&c='+ opvalue + '&ml='+ usrid + '&sortby='+ orderby; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function EventsPerPage(spanid,page,opvalue,usrid,orderby,filename,Display)   //This Function  used to display the Announcements PerPage
{ 
	document.getElementById('CalendarEventListDispaly').innerHTML = RatePanelLoad;
	var Values = Display;
	var success = function(t){EventsPerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&c='+ opvalue + '&ml='+ usrid + '&sortby='+ orderby; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function EventsPerPageComplete(t, Values)
{
	document.getElementById('CalendarEventListDispaly').innerHTML = t.responseText;
}
function DeleteImage(spanid,Ident,ImageName,Filename)
{
	if(!confirm("Do you want to remove"))
		return false;
	var Values = "";
	var success = function(t){DeleteImageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = Filename; 
    var pars = 'checkText=' + spanid + '&Ident=' + Ident + '&ImageName='+ ImageName;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure})	
}
function DeleteImageComplete(t, Values)
{
		
	document.getElementById('ImageClear').innerHTML = "";
}
function SortByEvents(setValues,Value,Ident,FileName)
{
	var Values = "";
	document.getElementById('DisplayAll').innerHTML = loadstatustext1;
	var success = function(t){AllEventsDetailsComplete(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&SortBy=' + Value + '&Ident=' + Ident;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function getFilename()
{
	var UrlPath2 = window.location; 
	var url1 = UrlPath2.toString(); 
	var UrlPathSplit1 = url2.split("/"); 
	var Filename1 = UrlPathSplit1.reverse(); 
	if(Filename1[0].indexOf("?") > 0)
	{
		var SplitFilename1 = Filename1[0].split("?"); 
		if(Filename1[0] != "eventslisting.php" )
		{ 
			var varname1 = SplitFilename1[1].split("="); 
			if(varname1[0] == 'd')
				SplitFilename1[0] = "eventlisting.php";
		}
		return SplitFilename1[0];
	}
	else{
		return Filename1[0];
	}
}
function CategoryDisplayPanel(setValues,Ident,FileName)
{	
	//var FilenameRe = getFilename(); alert(FilenameRe);
	var Value = "";
	document.getElementById('DisplayAll').innerHTML = loadstatustext1;
	document.getElementById('DisplaySponser').innerHTML = loadstatustext1;
	var success = function(t){AllEventsDetailsComplete(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AllEventsDetailsComplete(t,Values)
{	//alert(t.responseText);
	strValue = t.responseText.split('||'); 
	Values = Values.toString(); 
	document.getElementById('DisplaySponser').innerHTML = strValue[0];
	document.getElementById('DisplayAll').innerHTML = strValue[1];
	document.getElementById('AtoZLinks').innerHTML = strValue[2];
	document.getElementById('PerpageShown').innerHTML = strValue[3];
	document.getElementById('LeftCategoryPanel').innerHTML = strValue[6];
	
}


function RateItOverLayFormEvents(obj,Ident,DisplayIdent,ListingIdent,FileName,XPOS,YPOS)
{
	var Values = DisplayIdent;
	var success = function(t){RateItOverLayFormEventsComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ListintIdent='+ListingIdent; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function RateItOverLayFormEventsComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText; 
	Values = Values.toString(); 
	document.getElementById(Values).innerHTML = strValue;
	return reviewoverlay(Obj,Values,'',XPOS,YPOS);
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
function RateItEvents(countArray,SpanID,FileName,ReviewCheck)
{
	var frmValues = "";
	var tvalues;
	if(ReviewCheck == '')
		ReviewCheck = 0;
	for(i=0;i<countArray;i++)
	{
		spanId=SpanID+"--"+i;
		tvalues = document.getElementById(spanId).value;
		tvalues=tvalues.replace('&','__');
		if(frmValues == "")
			frmValues = tvalues;
		else
			frmValues += "||"+tvalues;
	}
	var ratetvalues = document.getElementById('RateIt--1').value;
	var Producttvalues = document.getElementById('RateIt--0').value;
	var success = function(t){RateItCompleteEvents(t,spanId,ratetvalues,Producttvalues);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
    var pars = '&setValues=' + SpanID +'&frmValues=' + frmValues +'&HideValue=' + ReviewCheck; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
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
function RateItCompleteEvents(t,spanId,rate,Ident)
{	
	var strValue = Array();
	strValue = t.responseText.split('||'); 
	wrapper_full(Ident,0,0,0,0,0,0,0,strValue[0],strValue[1]);
	if(document.getElementById("RatingImage"))
		document.getElementById("RatingImage").innerHTML 	= stripslashes(strValue[4],"\\","");
	if(strValue[1] != 0){
		if(document.getElementById("viewReview"))
			document.getElementById("viewReview").innerHTML 	= "Your review";
	}
	
	if(strValue[1] == 1){
		document.getElementById(Ident+"_vote").innerText 	= "vote";}
	else{
		document.getElementById(Ident+"_vote").innerText 	= "votes";}
	document.getElementById("spLatestReviews").innerHTML 	= stripslashes(strValue[2],"\\","");
}
function __loadCalendarType(RefId,SpanId,DisplayId,FileName)
{
	var Values = DisplayId;
	document.getElementById('PreviousClickId').value = "";
	//var loadstatustext1="<img src='images/events-loading.gif'/>";
	//document.getElementById(DisplayId).innerHTML=loadstatustext1
	var success = function(t){__loadCalendarTypeComplete(t, Values,SpanId);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName; 
    var pars = "objIdent1=" + RefId +"&SpanId="+SpanId; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function hideSelectBoxes() { 
	for(var i = 0; i < document.forms.length; i++) {
		for(var e = 0; e < document.forms[i].length; e++){
			if(document.forms[i].elements[e].tagName == "SELECT") {
				document.forms[i].elements[e].style.visibility="hidden";
			}
		}
	}
	//document.getElementById('NavMenu').visibility = 'none';
}
function __loadCalendarTypeComplete(t, Values,SpanId)
{
	var strValue = Array();
	strValue = t.responseText.split('||'); 
	document.getElementById(Values).innerHTML = strValue[0];
	//myDialog.setDialog('loading','loading','loading');
	//document.getElementById('MiniCalendar').style.display="none";
	myDialog.start();
	//hideSelectBoxes();
	showSpecificType(SpanId,'calendarLoading','eventsAjax1.php');
}
function showSpecificType(SpanId,DisplayId,FileName)
{
	var Values = DisplayId;
	if(SpanId == 'Week')
		getWeekDays();
	document.getElementById("SelValue").value = SpanId;
	var strDay    = document.getElementById("CurrentDay").value;
	var strMonth  = document.getElementById("CurrentMonth").value;
	var strYear   = document.getElementById("CurrentYear").value;
	var StrType   = document.frmCalendar.SelValue.value;
	
	var SMonth    = document.getElementById("StartMon").value;
	var EMonth    = document.getElementById("EndMon").value;
	
	var MemId     =  document.frmCalendar.MemberId.value;
	if(SMonth!="10"){
		SMonth = "0"+SMonth
	}
	if(EMonth!="10"){
		EMonth = "0"+EMonth
	}
	
	if(StartLimit > 0){
		StartLimit = StartLimit + 2;
	} else {
		StartLimit = 0;
	}
	
	if(EndLimit > 0){
		EndLimit = EndLimit + 2;
	} else {
		EndLimit = 2;
	}
	
	var SDate     = document.getElementById("StartYear").value+"-"+SMonth+"-"+document.getElementById("StartDay").value;
	var EDate     = document.getElementById("EndYear").value+"-"+EMonth+"-"+document.getElementById("EndDay").value;
	var qstr      = "Day="+strDay+"&Month="+strMonth+"&Year="+strYear+"&Type="+StrType+"&StDate="+SDate+"&EtDate="+EDate+"&SLimit="+StartLimit+"&LLimit="+EndLimit+"&MemberId="+MemId;
	var success = function(t){CalendarTypeComplete(t, Values,SpanId);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName; 
    var pars = "objIdent1=" + SpanId +"&"+qstr; 	//alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function CalendarTypeComplete(t, Values,SpanId)
{ //alert(t.responseText)
	var strValue = Array();
	strValue = t.responseText.split('||'); 
	
	myDialog.cd();
	//document.getElementById('MiniCalendar').style.display="block";
	//document.getElementById(Values).innerHTML = strValue[0];
	document.getElementById('ShowEventDetailsAll').innerHTML = strValue[2];
	document.getElementById('LeftCategoryPanel').innerHTML = strValue[3]; //alert(strValue[3])
	showSpecificTemplateType(SpanId);
	//alert(strValue[1]);
	setEventsDetails(strValue[1]);
	
	//showSpecificTemplate(SpanId);
}
function timingoutset()
{
	document.getElementById('Message').innerHTML = "Loading";
	//return true;	
}
function setEventsDetails(EventDetails)
{	//alert(EventDetails);
	ShowHideEventDetails();
	var SplitEventDetails = EventDetails.split("^^^"); 
	var StartTable ="<table width='100%' border='0' cellspacing='1' align='left'><tr><td><table width='100%' border='0' cellspacing='1'>";
	var EndTable =" </table></td></tr></table>";
	 var ConCateDays = "";
	var Eday1 =""
	var YearFlag = 4; //alert(SplitEventDetails.length);
	var ImageTag = "";
	/*EmptyMonthValues();
	EmptyDayValues();
	EmptyYearValues();
	EmptyWeekValues();*/
	for(var i=0;i<SplitEventDetails.length;i++)
	{
		var SplitEventDetail = SplitEventDetails[i].split("---"); 
		var EventDate   = SplitEventDetail[1];
		var SplitEventDate  = EventDate.split("-");
		var EDay  = getEval(SplitEventDate[2]); 
		var EMon  = SplitEventDate[1];
		var EYear = SplitEventDate[0];
		var STime = SplitEventDetail[3];
		var EventId = SplitEventDetail[2];
		//if(EventId == '1001')
			//alert(EventId);
		var EventDay = SplitEventDate[2];
		var ETitle = SplitEventDetail[0];
		var EventDesc = SplitEventDetail[5];
		var MemberId  = SplitEventDetail[4]; 
		var CurMember = document.getElementById("MemberId").value;
		if(MemberId == CurMember){
			var ClassName = "YellowColor";
			var FColor    = "#990000";
			var JScript   = "EditEventDetails"
			var evtDay    = EventDay
		} else {
			var ClassName = "EventDetailsBgColor";
			var FColor    = "#FFFFFF";
			var JScript   = "ShowAllMonthDetails";
			var evtDay    = EventDay
		} 
		var SelType = document.getElementById("SelValue").value;
		switch(SelType){
			case "Days":
						if(EDay.length == 1){
							EDay = "0" + EDay;
						} 
						var SptSTime    = STime.split(":");
						var StartTime   = SptSTime[0];
						var SSTime      = SptSTime[0];
						if(StartTime != 10){
							StartTime = StartTime.replace("0","");
						}
						
						if(StartTime > 12){
							var time = "pm";
							StartTime = StartTime-12;
						} else {
							var time = "am";
						}
						if((SptSTime[1] == 15 || SptSTime[1] == 30) && StartTime == 00)
							StartTime = 12;
						if(SptSTime[1] == 30 || SptSTime[1] == 45)
							DTimeId      = "Day"+StartTime+time+2;
						else
						 	DTimeId      = "Day"+StartTime+time+1;
						 if(MemberId == CurMember){
							 var evtDay  = EventId	
						 } else {
							 var evtDay    = SSTime	
						 }//.replace('\r\n','<br>')
						 var EAddress = SplitEventDetail[6];
						var EventDesc1 = EventDesc;
						//var EventDetail =  "<a href='#EvDe' onClick='javascript:" + JScript +"(" + evtDay +")'><td class=" + ClassName + "><font color=" + FColor + ">"+ SplitEventDetail[0].slice(0,14)+"</font></td></a>";
						 SplitEventDetail[0] = SplitEventDetail[0].replace("^","'");
						  SplitEventDetail[0] = SplitEventDetail[0].replace("^","'");
						 if(MemberId == CurMember)
							var EventDetail =  "<tr><a style='cursor:pointer'><td onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc1 + "','user','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" class=" + ClassName + " style='cursor:pointer' align='left'  title=\"" + SplitEventDetail[0] + "\"><font color=" + FColor + ">"+ SplitEventDetail[0].slice(0,50)+"</font></td></a><tr>";
						else
							var EventDetail =  "<tr class='EventDetailsBgColor'><a id='eventd' style='cursor:pointer'><td onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc1 + "','other','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" class='ClassName' style='cursor:pointer' align='left'  title=\"" + SplitEventDetail[0] + "\"><font color=" + FColor + ">"+ SplitEventDetail[0].slice(0,50)+"</font></td></a></tr>";					
						if(STime != '00:00:00')
							document.getElementById(DTimeId).innerHTML = StartTable + EventDetail + EndTable;
						else {
							ConCateDays += StartTable + EventDetail + EndTable;
							document.getElementById('hdDayId').innerHTML = ConCateDays;
						}
						//alert(ConCateDays);
						break;
			case "Week":
						if(EDay.length == 1){
							EDay = "0"+EDay;
						} 
						var SptSTime    = STime.split(":");
						var StartTime   = SptSTime[0]; //alert(SptSTime[1])
						var StTime      = SptSTime[0];
						if(StartTime != 10){
							StartTime = StartTime.replace("0","");
						}
						
						if(StartTime > 12){
							var time = "pm";
							StartTime = StartTime-12;
							
						} else {
							var time = "am";
						}
						 SplitEventDetail[0] = SplitEventDetail[0].replace("^","'");
						  SplitEventDetail[0] = SplitEventDetail[0].replace("^","'");
						if(MemberId == CurMember){
							var EventDetail1 =  "<tr class='EventDetailsBgColor'><a style='cursor:pointer'><td onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc + "','user','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" class=" + ClassName + " valign='top' style='cursor:pointer'  title=\"" + SplitEventDetail[0] + "\"><font color=" + FColor + ">"+ SplitEventDetail[0].slice(0,10)+"</font></td></a></tr>";
						} else {
						
							var EventDetail1 =  "<tr class='EventDetailsBgColor'><a id='eventid' style='cursor:pointer'><td onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc + "','other','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" class=" + ClassName + " style='cursor:pointer'  title=\"" + SplitEventDetail[0] + "\"><font color=" + FColor + ">"+ SplitEventDetail[0].slice(0,14)+"</font></td></a></tr>";
						}
						if((SptSTime[1] == 15 || SptSTime[1] == 30) && StartTime == 00)
							StartTime = 12;
						if(EDay == DayArray[0]){
							if(SptSTime[1] == 30 || SptSTime[1] == 45)
								TimeId      = "SWeekDay"+StartTime+time+1;
							else
								TimeId      = "FWeekDay"+StartTime+time+1;
							 TimeId1      = 'strDay'+1;
						}
						
						if(EDay == DayArray[1]){
							if(SptSTime[1] == 30 || SptSTime[1] == 45)
								TimeId      = "SWeekDay"+StartTime+time+2;
							else
							  	TimeId      = "FWeekDay"+StartTime+time+2;
							   TimeId1      = 'strDay'+2;
						}
						if(EDay == DayArray[2]){
							if(SptSTime[1] == 30 || SptSTime[1] == 45)
								TimeId      = "SWeekDay"+StartTime+time+3;
							else
							  	TimeId      = "FWeekDay"+StartTime+time+3;
							 TimeId1      = 'strDay'+3;
						}
						if(EDay == DayArray[3]){
							if(SptSTime[1] == 30 || SptSTime[1] == 45)
								TimeId      = "SWeekDay"+StartTime+time+4;
							else
							  	TimeId      = "FWeekDay"+StartTime+time+4;
							   TimeId1      = 'strDay'+4;
						}
						if(EDay == DayArray[4]){
							if(SptSTime[1] == 30 || SptSTime[1] == 45)
								TimeId      = "SWeekDay"+StartTime+time+5;
							else
							  	TimeId      = "FWeekDay"+StartTime+time+5;
							   TimeId1      = 'strDay'+5;
						}
						if(EDay == DayArray[5]){
							if(SptSTime[1] == 30 || SptSTime[1] == 45)
								TimeId      = "SWeekDay"+StartTime+time+6;
							else
							  	TimeId      = "FWeekDay"+StartTime+time+6;
							   TimeId1      = 'strDay'+6;
						}
						if(EDay == DayArray[6]){
							if(SptSTime[1] == 30 || SptSTime[1] == 45)
								TimeId      = "SWeekDay"+StartTime+time+7;
							else
							 	TimeId      = "FWeekDay"+StartTime+time+7;
							  TimeId1      = 'strDay'+7;
						}
						if(STime != '00:00:00')
							document.getElementById(TimeId).innerHTML =  StartTable + EventDetail1 + EndTable;
						else {
							var NonTimeValue = document.getElementById('NonTime').value;
							if(NonTimeValue != TimeId1)
								ConCateDays = "";
							ConCateDays += StartTable + EventDetail1 + EndTable;
							document.getElementById(TimeId1).innerHTML = ConCateDays;
							document.getElementById('NonTime').value = TimeId1;
						}
						break;
			case "Month": 
						if(InActivecount == 0)
							var Active = 0
						else
							var Active = getEval(InActivecount);
						//alert(InActivecount);
						EDay  = getEval(SplitEventDate[2]) + Active;  
						//EDay = 3;
						var getEventsMonthValue = document.getElementById('event_'+EDay).value;
						var getEventsMonthValue1 = document.getElementById('countevent_'+EDay).value; 
						Eday1 = EDay;
						 SplitEventDetail[0] = SplitEventDetail[0].replace("^","'");
						 SplitEventDetail[0] = SplitEventDetail[0].replace("^","'");
						 if(getEventsMonthValue1 == EDay){
						 	SplitEventDetail[14] = "";
							ImageTag = "";
						 }
						 else
							ImageTag = SplitEventDetail[14];
						 if(SplitEventDetail[14] != '')
						 	var ShowTitle = "<img src='"+ SplitEventDetail[14]+"' border='0' alt=\"" + SplitEventDetail[0] + "\">";
						else
							var ShowTitle = SplitEventDetail[0].slice(0,14);
						//alert(SplitEventDetail[0]);
						 if(MemberId == CurMember){
							 if(SplitEventDetail[14] != '')
								var EventDetail =  "<tr class=''><a><td align='center' onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc + "','user','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" style='cursor:pointer'><font color=" + FColor + ">"+ ShowTitle +"</font></td></a></tr>";
							else
								var EventDetail =  "<tr class='EventDetailsBgColor'><a ><td align='center' onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc + "','user','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" class=" + ClassName + " style='cursor:pointer' title=\"" + SplitEventDetail[0] + "\"><font color=" + FColor + ">"+ SplitEventDetail[0].slice(0,14)+"</font></td></a></tr>";
						}
						else{
							 if(SplitEventDetail[14] != '')
								var EventDetail =  "<tr class=''><a id='eventd'><td onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc + "','other','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" class='' style='cursor:pointer'><font color=" + FColor + ">"+ ShowTitle +"</font></td></a></tr>";					
							else
								var EventDetail =  "<tr class='EventDetailsBgColor'><a id='eventd'><td onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc + "','other','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" class='ClassName' style='cursor:pointer' title=\"" + SplitEventDetail[0] + "\"><font color=" + FColor + ">"+ SplitEventDetail[0].slice(0,14)+"</font></td></a></tr>";					
						}
						if(getEventsMonthValue1 != Eday1)
							YearFlag = 0;
						var eventcount = getEventsMonthValue.split("<tr");
						if(eventcount.length > 4) {
							if(YearFlag == 0) {
								EventDetail = getEventsMonthValue+"<tr><td align='right'><a href='#EvDe' onClick='javascript:ShowAllMonthDetails(" + evtDay +")'  title='more'><font class='FontColormore'>more...</font></a></td></tr>";			
								YearFlag = 1;
							}
							else
								EventDetail = getEventsMonthValue;
						}
						else
							EventDetail = getEventsMonthValue+EventDetail;
							//alert(getEventsMonthValue1)
						
							document.getElementById(EDay).innerHTML = StartTable + EventDetail + EndTable;
							if(document.getElementById('countevent_'+EDay))document.getElementById('countevent_'+EDay).value = Eday1;
							if(document.getElementById('event_'+EDay))document.getElementById('event_'+EDay).value = EventDetail;
							//setTimeout("timingoutset()",5000);
						break;
			case "Year":
						var YearIdName = "Year"+EMon; //alert(YearIdName)
						//if(EMon == '08')
							//alert(YearIdName);
						var EventDetailyear1 = document.getElementById('val_'+YearIdName).value; 
						var EventDetailyear2 = document.getElementById('EventCount_'+YearIdName).value; 
						 SplitEventDetail[0] = SplitEventDetail[0].replace("^","'");
						 SplitEventDetail[0] = SplitEventDetail[0].replace("^","'");
						if(MemberId == CurMember)
							var EventDetail =  "<tr class='EventDetailsBgColor'><td align='left' onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc + "','user','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" class=" + ClassName + " style='cursor:pointer'  title=\"" + SplitEventDetail[0] + "\"><font color=" + FColor + ">"+ SplitEventDetail[0].slice(0,50)+"</font></td></tr>";
						else
							var EventDetail =  "<tr class='EventDetailsBgColor'><td align='left' onClick=\"HideGoogleMaps1(event," + EventId + ",'" + ETitle + "','" + EventDesc + "','other','" + SplitEventDetail[6] + "','" + SplitEventDetail[7] + "','" + SplitEventDetail[8] + "','" + SplitEventDetail[9] + "','" + SplitEventDetail[10] + "','" + SplitEventDetail[11] + "','" + SplitEventDetail[12] + "','" + SplitEventDetail[13] + "')\" class='ClassName' style='cursor:pointer'  title=\"" + SplitEventDetail[0] + "\"><font color=" + FColor + ">"+ SplitEventDetail[0].slice(0,50)+"</font></td></tr>";					
						var eventcount1 = EventDetailyear1.split("<tr"); //alert(eventcount1.length)
						if(EventDetailyear2 != YearIdName)
							YearFlag = 0;
						if(eventcount1.length > 4) {
							if(YearFlag == 0) {
								EventDetail = EventDetailyear1+"<tr><td align='right'><a href='#EvDe' onclick=\"javascript:ShowAllMonthDetails(" + evtDay +"," + EMon + ")\" style='cursor:pointer'  title='more'><font class='FontColormore'>more...</font></a></td></tr>";			
								YearFlag = 1;
							}
							else
								EventDetail = EventDetailyear1;
						}
						else
							EventDetail = EventDetailyear1 + EventDetail;
						//alert(EventDetailyear2); alert(YearIdName);
						document.getElementById(YearIdName).innerHTML = StartTable + EventDetail + EndTable;
						document.getElementById('val_'+YearIdName).value = EventDetail;
						document.getElementById('EventCount_'+YearIdName).value = YearIdName;
						/*if(EventDetailyear2 == YearIdName) {
							if(eventcount1.length > 4){
								return false;
							}
						}*/
						break;
		}
		
	
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
function showSpecificTemplateType(Type)
{
	switch(Type){
		case "Days":
					ShowMonthYearForWeek();
					DisplayCurrentDay();
					break;
		case "Week":
					getWeekDays();
					break;
		case "Month":
					getDays();
					ShowMonthYear();
					break;
		case "Year":
					getYears();
					break;
	}
	TodayDetails();
}
function ShowAllEventDetails(Month,Year)
{
	var Values = 'ShowEventDetailsAll';
	var success = function(t){ShowAllEventDetailsComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = 'eventsAjax1.php'; 
    var pars = 'objIdent=ShowEventDetails' + '&Month=' + Month + '&Year=' + Year;  //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowAllEventDetailsComplete(t, Values)
{
	//alert(t.responseText)
	document.getElementById(Values).innerHTML = t.responseText;
}
function ShowCalendar(SpanId,DisplayId,filename){ 
	//var loadstatustext1="<img src='images/progressbar_long_green.gif'/>";
	//document.getElementById(DisplayId).innerHTML=loadstatustext1
	document.getElementById("calen").style.display = "block";
	document.getElementById("month").style.display = "none";
	var Values = DisplayId;
	var success = function(t){CalendarComplete(t, Values,SpanId);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId;  //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function CalendarComplete(t, Values,SpanId)
{ 	
	//strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
	document.getElementById('calendart').value = SpanId;
	if(SpanId == 'Month') {
		initMonthScheduler();
		/*getDays();
		ShowMonthYear();
		TodayDetails();*/
	}
	else if(SpanId == 'Days')
		initDayScheduler();
	else if(SpanId == 'Week')
		initWeekScheduler();
	//showSpecificTemplate(SpanId);
	/*if(document.getElementById('DaysId'))document.getElementById('DaysId').style.display  = 'block'; 
	if(document.getElementById('WeekId'))document.getElementById('WeekId').style.display  = 'none';
	if(document.getElementById('MonthId'))document.getElementById('MonthId').style.display = 'none';
	if(document.getElementById('YearId'))document.getElementById('YearId').style.display  = 'none';
	DisplayCurrentDay();
	ShowMonthYearForWeek();
	TodayDetails();*/
	//showAsEditable(Values, true);
}

function ShowAllReviews(SpanId,DispalyId,Ident,Filename)
{
	var success = function(t){ShowAllReviewsComplete(t,DispalyId);}
	var failure = function(t){editFailed(t);}	
	var url = Filename;
    var pars = '&setValues=' + SpanId + '&Ident=' + Ident; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function ShowAllReviewsComplete(t,Values)
{	//alert(t.responseText)
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById(Values).innerHTML 				= stripslashes(strValue[0],"\\","");
	document.getElementById('ViewMore').innerHTML 				= stripslashes(strValue[1],"\\","");
}

function setDirection(setValues,Ident,FileName)
{
	//document.getElementById("spGetDirection").innerHTML=Sliderloadstatustext1
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
function AddCalendarType(obj,Ident,DisplayIdent,ListingIdent,FileName,XPOS,YPOS,Title)
{
	var Layers = '';
	Layers += "<span style='width:500px; nowrap'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
	Layers += "<td width='94%' valign='top' class='OverLayTitle'>Add in Calendar</td>";
	Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlayclose1();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
	Layers += "</tr><tr><td align='center' class='GreenFont'><span id='LayerForm'>Loading ...</span></td></tr></table></span>";
	document.getElementById('LayerContent').innerHTML 	= Layers;
	reviewoverlay(obj,'LayerContent','',XPOS,YPOS);
	var Values = DisplayIdent;
	var success = function(t){AddCalendarTypeComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ProductIdent='+ListingIdent+'&Title='+Title; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AddCalendarTypeComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('LayerForm').innerHTML = strValue;
}
function AddWillingUser(RefId,ProductIdent,ProfileName,Filename)
{
	document.getElementById('WillingUserAdded').innerHTML 	= "Adding...";
	var Values = RefId;
	var success = function(t){AddWillingUserComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
    var pars = 'setValues='+RefId+'&ProductIdent='+ProductIdent+'&ProfileName='+ProfileName; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AddWillingUserComplete(t,Values)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('InterestedUser').innerHTML = strValue;
}
function DeleteInterestedUser(RefId,Ident,ProductIdent,Filename,Load)
{
	document.getElementById(Load).innerText 	= "        "+"Removing...";
	var Values = RefId;
	var success = function(t){DeleteInterestedUserComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
    var pars = 'setValues='+RefId+'&Ident='+Ident+'&ProductIdent='+ProductIdent; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function DeleteInterestedUserComplete(t,Values)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('InterestedUser').innerHTML = strValue;
}