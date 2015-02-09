var Sliderloadstatustext="<img src='images/Auction_loading.gif'>"
var LeftPanelLoad="<img src='images/clocks.gif' />";
if(navigator.userAgent.indexOf('MSIE') == -1)
	var CountVar = 1;
else
	var CountVar	= 0;

function addSelectBox(id,CatId,displayId,FileName){
	var Values = displayId;
	var success = function(t){addSelectBoxComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
	var pars = 'Id='+id+'&CatId='+CatId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function addSelectBoxComplete(t, Values){
	var strValue = t.responseText;
//	alert(strValue);
	Values = Values.toString();
	if(strValue!='')
		document.getElementById(Values).innerHTML= strValue;
	if(Values=="loadSubCat1")
		document.getElementById("loadSubCat2").innerHTML= "";
	if(Values=="loadSubCat2")
		document.getElementById("loadSubCat3").innerHTML= "";
}
// JavaScript Document
function ChangeCategoryDetails(setValues,Ident,Miles,FileName){
	document.getElementById("PerPageListingsTD").vAlign 	= "top";
	document.getElementById("FreturedListingTd").vAlign 	= "middle";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	document.getElementById("FeaturedListings").innerHTML	=	Sliderloadstatustext
	var success = function(t){ChangeCategoryDetailsComplete(t,Ident);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Ident=' + Ident + '&range=' +  Miles;  //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ChangeCategoryDetailsComplete(t,Values,spanId,Ident){
	var strValue = t.responseText.split('||');
	document.getElementById("PerPageListings").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById("FeaturedListings").innerHTML = stripslashes(strValue[1],"\\","");
	document.getElementById("TopPerPage").innerHTML = stripslashes(strValue[2],"\\","");
	document.getElementById("AtoZLinks").innerHTML = stripslashes(strValue[4],"\\","");
	document.getElementById("ListingTab").innerHTML = stripslashes(strValue[5],"\\","");
		var Final	= stripslashes(strValue[3],"\\","");
	var itemsToBeCreated = new Array();
	var itemsToBeCreated1 = new Array();
	var items = Final.split(/<item>/g); //alert(items.length);
	if(items.length > 0) {//alert('hai');
		
		for(var no=CountVar;no<items.length;no++){ 
			var lines = items[no].split(/\n/g); 
			itemsToBeCreated[no] = new Array();
			for(var no2=0;no2<lines.length;no2++){ 
				var key = lines[no2].replace(/<([^>]+)>.*/g,'$1');
				if(key)key = trimString(key);
				var pattern = new RegExp("<\/?" + key + ">","g");
				var value = lines[no2].replace(pattern,'');
				value = trimString(value);
				//alert(value);
				itemsToBeCreated[no][key] = value; 
				//alert(itemsToBeCreated[no][key]);
				/*var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
				
				futuredate.displaycountdown("days", formatresults)*/
			}
			//alert(itemsToBeCreated[no]['id']);
				var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
				
				futuredate.displaycountdown("days", formatresults)
			//alert(itemsToBeCreated[no]['perpage']);
		}
		}
	
}
function SelSearch(setValues,Value,Ident,Chkvalue,FileName){
	document.getElementById("PerPageListingsTD").vAlign 	= "top";
	document.getElementById("FeaturedListings").vAlign 		= "top";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	document.getElementById("FeaturedListings").innerHTML	=	Sliderloadstatustext
	var success = function(t){SelSearchByCompleteAuction(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Name=' + Value + '&CatIdent=' + Ident + '&ChkValue=' + Chkvalue; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SelSearchByCompleteAuction(t,Value){	
	var strValue = t.responseText.split('||');
	document.getElementById("FeaturedListings").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById("Viewlistings").innerHTML = stripslashes(strValue[1],"\\","");
	document.getElementById("TopPerPage").innerHTML =  stripslashes(strValue[2],"\\","");
	document.getElementById("FreeListings").innerHTML =  stripslashes(strValue[3],"\\","");
	document.getElementById("AtoZLinks").innerHTML = stripslashes(strValue[4],"\\","");
	document.getElementById("ListingTab").innerHTML = stripslashes(strValue[6],"\\","");

	var Final	= stripslashes(strValue[5],"\\","");
	var itemsToBeCreated = new Array();
	var itemsToBeCreated1 = new Array();
	var items = Final.split(/<item>/g);// alert(items.length);
	if(items.length > 0) {//alert('hai');
		for(var no=CountVar;no<items.length;no++){ 
			var lines = items[no].split(/\n/g); 
			itemsToBeCreated[no] = new Array();
			for(var no2=0;no2<lines.length;no2++){ 
				var key = lines[no2].replace(/<([^>]+)>.*/g,'$1');
				if(key)key = trimString(key);
				var pattern = new RegExp("<\/?" + key + ">","g");
				var value = lines[no2].replace(pattern,'');
				value = trimString(value);
				itemsToBeCreated[no][key] = value; 
			}
			var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
			futuredate.displaycountdown("days", formatresults)
		}
	}
	DynamicMiles =50;	
	ChageSliderText(DynamicMiles);
	init();

}
function SelType(setValues,Value,FileName){
	document.getElementById("PerPageListingsTD").vAlign 	= "top";
	document.getElementById("FeaturedListings").vAlign 		= "top";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	document.getElementById("FeaturedListings").innerHTML	=	Sliderloadstatustext
	var success = function(t){SelTypeByCompleteAuction(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&Name=' + Value ; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SelTypeByCompleteAuction(t,Value){	
	var strValue = t.responseText.split('||');
	document.getElementById("FeaturedListings").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById("Viewlistings").innerHTML = stripslashes(strValue[1],"\\","");
	document.getElementById("TopPerPage").innerHTML =  stripslashes(strValue[2],"\\","");
	document.getElementById("PerPageListings").innerHTML =  stripslashes(strValue[3],"\\","");
	document.getElementById("AtoZLinks").innerHTML = stripslashes(strValue[4],"\\","");
	document.getElementById("ListingTab").innerHTML = stripslashes(strValue[6],"\\","");
	var Final	= stripslashes(strValue[5],"\\","");
	var itemsToBeCreated = new Array();
	var itemsToBeCreated1 = new Array();
	var items = Final.split(/<item>/g); //alert(items.length);
	if(items.length > 0) {//alert('hai');
		for(var no=CountVar;no<items.length;no++){ 
			var lines = items[no].split(/\n/g); 
			itemsToBeCreated[no] = new Array();
			for(var no2=0;no2<lines.length;no2++){ 
				var key = lines[no2].replace(/<([^>]+)>.*/g,'$1');
				if(key)key = trimString(key);
				var pattern = new RegExp("<\/?" + key + ">","g");
				var value = lines[no2].replace(pattern,'');
				value = trimString(value);
				itemsToBeCreated[no][key] = value; 
			}
			var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
			futuredate.displaycountdown("days", formatresults)
		}
	}
	DynamicMiles = 50;	
	ChageSliderText(DynamicMiles);
	init();

	
}
function SortByAuction(setValues,Value,Ident,FileName){
	document.getElementById("PerPageListingsTD").vAlign 	= "top";	
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var success = function(t){SortByCompleteAuction(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&SortBy=' + Value; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SortByCompleteAuction(t,Value){
	var strValue = t.responseText.split('||');
	//alert(strValue[2]); 
	document.getElementById("PerPageListings").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById("TopPerPage").innerHTML = stripslashes(strValue[1],"\\","");
	var Final	= stripslashes(strValue[2],"\\","");
	document.getElementById("ListingTab").innerHTML = stripslashes(strValue[3],"\\","");

	var itemsToBeCreated = new Array();
	var itemsToBeCreated1 = new Array();
	var items = Final.split(/<item>/g);// alert(items.length);
	if(items.length > 0) {//alert('hai');
		for(var no=CountVar;no<items.length;no++){ 
			var lines = items[no].split(/\n/g); 
			itemsToBeCreated[no] = new Array();
			for(var no2=0;no2<lines.length;no2++){ 
				var key = lines[no2].replace(/<([^>]+)>.*/g,'$1');
				if(key)key = trimString(key);
				var pattern = new RegExp("<\/?" + key + ">","g");
				var value = lines[no2].replace(pattern,'');
				value = trimString(value);
				itemsToBeCreated[no][key] = value; 
			}
			var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
			futuredate.displaycountdown("days", formatresults)
		}
	}
}
function ListView(setValues,Value,Ident,FileName){
	document.getElementById("PerPageListingsTD").vAlign 	= "top";	
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var success = function(t){ListCompleteView(t,Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = '&setValues=' + setValues + '&DisplayView=' + Value + '&Ident=' + Ident; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ListCompleteView(t,Value){	
	var strValue = t.responseText.split('||'); 
	document.getElementById("Viewlistings").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById("TopPerPage").innerHTML =  stripslashes(strValue[1],"\\","");
	document.getElementById("FreeListings").innerHTML =  stripslashes(strValue[2],"\\","");
	document.getElementById("AtoZLinks").innerHTML = stripslashes(strValue[3],"\\","");
	document.getElementById("ListingTab").innerHTML = stripslashes(strValue[6],"\\","");
	DynamicMiles =strValue[4];	
	ChageSliderText(DynamicMiles);
	init();
	var Final	= stripslashes(strValue[5],"\\","");
	var itemsToBeCreated = new Array();
	var itemsToBeCreated1 = new Array();
	var items = Final.split(/<item>/g);// alert(items.length);
	if(items.length > 0) {//alert('hai');
		
		for(var no=CountVar;no<items.length;no++){ 
			var lines = items[no].split(/\n/g); 
			itemsToBeCreated[no] = new Array();
			for(var no2=0;no2<lines.length;no2++){ 
				var key = lines[no2].replace(/<([^>]+)>.*/g,'$1');
				if(key)key = trimString(key);
				var pattern = new RegExp("<\/?" + key + ">","g");
				var value = lines[no2].replace(pattern,'');
				value = trimString(value);
				itemsToBeCreated[no][key] = value; 
			}
				var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
				futuredate.displaycountdown("days", formatresults)
			//alert(itemsToBeCreated[no]['perpage']);
		}
		}

}
function AuctionPerPage(spanid,page,filename,orderby,Display){
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var Values = Display;
	var success = function(t){AuctionPerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&sortby='+ orderby; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AuctionPerPageComplete(t, Values){ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("TopPerPage").innerHTML 			= stripslashes(strValue[0],"\\","");
	document.getElementById("PerPageListings").innerHTML 					= stripslashes(strValue[1],"\\","");
	document.getElementById("AtoZLinks").innerHTML 	= stripslashes(strValue[4],"\\","");

	var Final	= stripslashes(strValue[3],"\\","");
	var itemsToBeCreated = new Array();
	var itemsToBeCreated1 = new Array();
	var items = Final.split(/<item>/g);// alert(items.length);
	if(items.length > 0) {//alert('hai');
		
		for(var no=CountVar;no<items.length;no++){ 
			var lines = items[no].split(/\n/g); 
			itemsToBeCreated[no] = new Array();
			for(var no2=0;no2<lines.length;no2++){ 
				var key = lines[no2].replace(/<([^>]+)>.*/g,'$1');
				if(key)key = trimString(key);
				var pattern = new RegExp("<\/?" + key + ">","g");
				var value = lines[no2].replace(pattern,'');
				value = trimString(value);
				itemsToBeCreated[no][key] = value; 
			}
				var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
				futuredate.displaycountdown("days", formatresults)
			//alert(itemsToBeCreated[no]['perpage']);
		}
		}
}
function AtoZListing(spanid,listingletter,filename,Display){
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("PerPageListings").innerHTML	=	Sliderloadstatustext
	var Values = Display;
	var success = function(t){AtoZListingComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&alpha=' + listingletter; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AtoZListingComplete(t, Values){ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("PerPageListingsTD").vAlign 	= "top";
	document.getElementById("TopPerPage").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById("PerPageListings").innerHTML 		= stripslashes(strValue[1],"\\","");
	document.getElementById("AtoZLinks").innerHTML 	= stripslashes(strValue[2],"\\","");
	var Final	= stripslashes(strValue[3],"\\","");
	//alert(Final);
	var itemsToBeCreated = new Array();
	var itemsToBeCreated1 = new Array();
	var items = Final.split(/<item>/g);// alert(items.length);
	if(items.length > 0) {//alert('hai');
		
		for(var no=CountVar;no<items.length;no++){ 
		//alert(items[no]);
			var lines = items[no].split(/\n/g); 
			itemsToBeCreated[no] = new Array();
			for(var no2=0;no2<lines.length;no2++){ 
				//alert(itemsToBeCreated[no]);
				var key = lines[no2].replace(/<([^>]+)>.*/g,'$1');
				if(key)key = trimString(key);
				var pattern = new RegExp("<\/?" + key + ">","g");
				var value = lines[no2].replace(pattern,'');
				value = trimString(value);
				itemsToBeCreated[no][key] = value; 
			}
				var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
				futuredate.displaycountdown("days", formatresults)
		}
		}
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

function ShowHistory(SpanId,DisplayId,ListintIdent,FileName,details)
{
	var success = function(t){ShowHistoryComplete(t,SpanId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
	document.getElementById(SpanId).innerHTML	=	Sliderloadstatustext
    var pars = '&setValues=' + SpanId +'&ListintIdent=' + ListintIdent+'&Details=' + details +'&DisplayId='+DisplayId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowHistoryComplete(t,spanId)
{
	var strValue = t.responseText.split('||'); 
	document.getElementById(spanId).innerHTML 				= stripslashes(strValue[0],"\\","");
}
function ShowSellerInfo(SpanId,DisplayId,ListintIdent,FileName,details,AuctId)
{
	var success = function(t){ShowSellerInfoComplete(t,SpanId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
	document.getElementById(SpanId).innerHTML	=	Sliderloadstatustext
    var pars = '&setValues=' + SpanId +'&ListintIdent=' + ListintIdent+'&Details=' + details +'&DisplayId='+DisplayId+'&AuctId=' + AuctId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowSellerInfoComplete(t,spanId)
{
	var strValue = t.responseText.split('||'); 
	document.getElementById(spanId).innerHTML 				= stripslashes(strValue[0],"\\","");
}
function ShowQuestions(SpanId,DisplayId,ListintIdent,FileName,details,AuctId)
{
	
	var success = function(t){ShowQuestionsComplete(t,SpanId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
	document.getElementById(SpanId).innerHTML	=	Sliderloadstatustext
    var pars = '&setValues=' + SpanId +'&ListintIdent=' + ListintIdent+'&Details=' + details +'&DisplayId='+DisplayId+'&AuctId='+AuctId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowQuestionsComplete(t,spanId)
{
	var strValue = t.responseText.split('||'); 
	document.getElementById(spanId).innerHTML 				= stripslashes(strValue[0],"\\","");
}
function ShowFeedback(SpanId,DisplayId,ListintIdent,FileName,details,AuctId)
{
	var success = function(t){ShowFeedbackComplete(t,SpanId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
	document.getElementById(SpanId).innerHTML	=	Sliderloadstatustext
    var pars = '&setValues=' + SpanId +'&ListintIdent=' + ListintIdent+'&Details=' + details +'&DisplayId='+DisplayId +'&AuctId='+AuctId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowFeedbackComplete(t,spanId)
{
	var strValue = t.responseText.split('||'); 
	document.getElementById(spanId).innerHTML 				= stripslashes(strValue[0],"\\","");
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
{	
	var strValue = Array();
	strValue = t.responseText.split('||'); 
	wrapper_full(Ident,0,0,0,0,0,0,0,strValue[0],strValue[1],'auctions',strValue[3]);
	if(document.getElementById("RatingImage"))
		document.getElementById("RatingImage").innerHTML 	= stripslashes(strValue[4],"\\","");
	if(strValue[1] <= 1){
		document.getElementById(Ident+"_vote").innerText 	= " vote";
		return true;
		}
	else{
		document.getElementById(Ident+"_vote").innerText 	= " votes";
		return true;
		}
	document.getElementById("spLatestReviews").innerHTML 	= stripslashes(strValue[2],"\\","");
	
	if(strValue[3] != 0)
		document.getElementById("viewReview").innerHTML 	= "Your review";
	
	
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

function ButItNow(obj,Ident,DisplayIdent,ListingIdent,FileName,XPOS,YPOS)
{
	//alert();
	var Values = DisplayIdent;
	var success = function(t){ButItNowComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ListintIdent='+ListingIdent;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ButItNowComplete(t,Obj,Values,XPOS,YPOS)
{	//alert(t.responseText);
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	return bidnowlay(Obj,Values,'',XPOS,YPOS);
}
function showLayer(obj,Ident,DisplayIdent,ListingIdent,FileName,XPOS,YPOS)
{
	var Layers = '';
	Layers += "<table width=100% cellpadding='0' cellspacing='0'><tr>";
	Layers += "<td width='94%' height='20' style='padding-left:10px;' valign='middle' bgcolor='#336600' class='OverLayTitle' ><font color='#FFFFFF'><strong>Item Details</strong></font></td>";
	Layers += "<td width='6%' align='right' valign='middle' bgcolor='#336600' class='OverLayTitle'>&nbsp;</td></tr>";
	Layers += "<tr bgcolor='#FFFFFF'><td colspan='2' class='DisplayCellText'>";
	Layers += "<span id='OverLayerTab'>Loading ...</span></td></tr></table>";
	
	document.getElementById('itemlayer').innerHTML 	= Layers;
	bidnowlay(obj,'itemlayer','',XPOS,YPOS);

	var Values = DisplayIdent;
	var success = function(t){showLayerComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ListintIdent='+ListingIdent;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function showLayerComplete(t,Obj,Values,XPOS,YPOS)
{	//alert(t.responseText);
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('OverLayerTab').innerHTML = strValue;
	//document.getElementById(Values).innerHTML = strValue;
	//return bidnowlay(Obj,Values,'',XPOS,YPOS);
}
function BitItNowDetail(obj,Ident,DisplayIdent,ListingIdent,FileName,XPOS,YPOS)
{
	var Values = DisplayIdent;
	var success = function(t){BitItNowDetailComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ListintIdent='+ListingIdent;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function BitItNowDetailComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	return bidnowlay(Obj,Values,'',XPOS,YPOS);
}

function BidIt(obj,setVal,AuctId,Amt,FileName,ReviewCheck)
{ 
	//alert(AuctId);
	//document.getElementById("BidNow").innerHTML = "<table width='98%' border='0' cellspacing='2' cellpadding='2'><tr><td height='20'>&nbsp;</td></tr><tr><td align='center' height='30'><img src='images/People_Loading.gif'></td></tr><tr><td height='20'>&nbsp;</td></tr></table>";
	var success = function(t){BitItComplete(t,AuctId);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+setVal+'&AuctId='+AuctId+'&Amt='+Amt;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});

}

function BitItComplete(t,AuctId)
{	
	
 	var strValue = t.responseText.split('||'); 
	document.getElementById("BidNow").innerHTML 				= stripslashes(strValue[0],"\\","");
	document.getElementById("disbidamount_"+AuctId).innerText 				= stripslashes(strValue[1],"\\","");
	document.getElementById("disbidcount_"+AuctId).innerText 				= stripslashes(strValue[2],"\\","");
	//var strValue = t.responseText; 
	//Values = Values.toString();
	//document.getElementById("BidNow").innerHTML = strValue;
}

function overBidlayclose1(){
	//new Effect.Fade(document.getElementById('LayerContent'))
	//return false;
	document.getElementById('rateitContent').style.display="none"
}
function overItemLayClose(){
	//new Effect.Fade(document.getElementById('LayerContent'))
	//return false;
	document.getElementById('itemlayer').style.display="none"
}
//////////////////////////////// Advanced Search ///////////////////////////////////////////////////////////////////
function _adv_sear_func(cond_Ident,frm_vals,FileName){
	document.getElementById("PerPageListingsTD").vAlign 	= "middle";
	document.getElementById("FeaturedListings").vAlign 		= "middle";
	document.getElementById("PerPageListings").innerHTML	=	"<br><br><br><br><br><br><br>"+Sliderloadstatustext;
	document.getElementById("FeaturedListings").innerHTML	=	"<br><br><br><br>"+Sliderloadstatustext;
	var Value='Idnt';
	var success = function(t){_adv_sear_func_comp(t, Value);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'checkText='+cond_Ident+'&strFrmValues='+frm_vals;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function _adv_sear_func_comp(t, Value){
	var strValue = t.responseText.split('||');
	document.getElementById("FeaturedListings").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById("Viewlistings").innerHTML = stripslashes(strValue[1],"\\","");
	document.getElementById("TopPerPage").innerHTML =  stripslashes(strValue[2],"\\","");
	document.getElementById("FreeListings").innerHTML =  stripslashes(strValue[3],"\\","");
	document.getElementById("AtoZLinks").innerHTML = stripslashes(strValue[4],"\\","");	
	document.getElementById("savedsearchSpan").innerHTML = stripslashes(strValue[5],"\\","");
		var Final	= stripslashes(strValue[6],"\\","");
	var itemsToBeCreated = new Array();
	var itemsToBeCreated1 = new Array();
	var items = Final.split(/<item>/g);// alert(items.length);
	if(items.length > 0) {//alert('hai');
		
		for(var no=CountVar;no<items.length;no++){ 
			var lines = items[no].split(/\n/g); 
			itemsToBeCreated[no] = new Array();
			for(var no2=0;no2<lines.length;no2++){ 
				//alert(itemsToBeCreated[no]);
				var key = lines[no2].replace(/<([^>]+)>.*/g,'$1');
				if(key)key = trimString(key);
				var pattern = new RegExp("<\/?" + key + ">","g");
				var value = lines[no2].replace(pattern,'');
				value = trimString(value);
				itemsToBeCreated[no][key] = value; 
			}
				var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
				futuredate.displaycountdown("days", formatresults)
		}
		}
	DynamicMiles = 50;	
	ChageSliderText(DynamicMiles);
	init();
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

//Watch this update in Auction start here
function WatchthisOverLayUpdate(obj,Ident,DisplayIdent,ListingIdent,FileName,XPOS,YPOS,Title,Blog,PName)
{
	var Layers = '';
	Layers += "<span style='width:500px; nowrap'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
	if(Ident == 'showBlogUpdated')
		Layers += "<td width='94%' valign='top' class='OverLayTitle'>Blog It</td>";
	else
		Layers += "<td width='94%' valign='top' class='OverLayTitle'>Watch This</td>";
	Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlayclose1();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
	Layers += "</tr><tr><td align='center' class='GreenFont'><span id='LayerForm'>Loading ...</span></td></tr></table></span>";
	document.getElementById('LayerContent').innerHTML 	= Layers;
	reviewoverlay(obj,'LayerContent','',XPOS,YPOS);
	var Values = DisplayIdent;
	var success = function(t){WatchthisOverLayUpdateComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&b='+ListingIdent+'&Title='+Title+'&l='+ListingIdent+'&t='+Blog+'&PName='+PName; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function WatchthisOverLayUpdateComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('LayerForm').innerHTML = strValue;
}
//Watch this update in Auction end here

function searchCategory()	{
	document.getElementById('SC').className='NormalBoldLinksTd';
	document.getElementById('BC').className='NormalPlainLinksTd';
	//showSearchBar('ShowSearch','auctionajax.php');
	/*FileName = "auctionajax.php";
	var Values = "";
	var success = function(t){searchCategoryComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+"ShowSearch"; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});*/
	document.getElementById("searchcroll").style.visibility = "visible";
	document.getElementById("searchcroll").style.position = "relative";
	document.getElementById("BrowseCategory").style.visibility = "hidden";
	document.getElementById("BrowseCategory").style.position = "absolute";
	document.getElementById("Contiune").disabled = true;
}
function searchCategoryComplete(t,Values)
{
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById('Search').innerHTML = strValue;
	
}
function browseCategory()	{
	document.getElementById('BC').className='NormalBoldLinksTd';
	document.getElementById('SC').className='NormalPlainLinksTd';
	document.getElementById("BrowseCategory").style.visibility = "visible";
	document.getElementById("BrowseCategory").style.position = "relative";
	document.getElementById("searchcroll").style.visibility = "hidden";
	document.getElementById("searchcroll").style.position = "absolute";
	document.getElementById('Contiune').disabled = false;
}
function getsearchValue(id,SpanVal,Filename)	{
	if(document.getElementById("searchcategory").value=="")	{
		alert("Please enter your correct information to search ");
		document.getElementById("searchcategory").focus();
		return false;
	}
	var success = function(t){getsearchValuefromFunction(t,id);}
	var failure = function(t){editFailed(t);}
	var setValues;
	var url = Filename;
	document.getElementById("searchRes").innerHTML	=	"<img src='../images/green-tab_loading_bk.gif'>";
    var pars = '&setValues=' + SpanVal +'&Ident=' + id+'&Value=' + document.getElementById("searchcategory").value ; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function getsearchValuefromFunction(t,SpanId)
{

	var strValue = t.responseText; 
	document.getElementById('searchRes').innerHTML = strValue;
}
function PreviousNext(RefId,Ident,FileName)
{
	document.getElementById('MainListing').innerHTML 	=  LeftPanelLoad;
	var Values = RefId;
	var success = function(t){PreviousNextComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+RefId+'&id='+Ident; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function PreviousNextComplete(t,Values)
{	
	var strValue = Array();
	strValue = t.responseText.split('||'); 
	//alert(strValue);
	Values = Values.toString();
	document.getElementById('MainListing').innerHTML = strValue[0];
	document.getElementById('DetailLeft').innerHTML = strValue[1];
	reload();
	var Final	= stripslashes(strValue[2],"\\","");
	//alert(Final);
	var itemsToBeCreated = new Array();
	var itemsToBeCreated1 = new Array();
	var items = Final.split(/<item>/g);
	if(items.length > 0) {//alert('hai');
		for(var no=CountVar;no<items.length;no++){ 
			var lines = items[no].split(/\n/g); 
			itemsToBeCreated[no] = new Array();
			for(var no2=0;no2<lines.length;no2++){ 
				var key = lines[no2].replace(/<([^>]+)>.*/g,'$1');
				if(key)key = trimString(key);
				var pattern = new RegExp("<\/?" + key + ">","g");
				var value = lines[no2].replace(pattern,'');
				value = trimString(value);
				itemsToBeCreated[no][key] = value; 
			}
				var futuredate=new cdtime("countdowncontainer"+itemsToBeCreated[no]['id'], itemsToBeCreated[no]['date'])
				futuredate.displaycountdown("days", formatresults)
			}
		}
}
/* Bidding count AJAX starts here*/
function BiddingCount(id,action,filename){
	var Values = "";
	var ConditionCall = "AuctionDetailsReload";
	var success = function(t){BiddingCountComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = filename;
	var pars = 'setValues='+ConditionCall+'&id='+id+'&action='+action;
	var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function BiddingCountComplete(t,Values){
	strValue = t.responseText.split('||');
	document.getElementById('MoreDetails').innerHTML = strValue[0];
	document.getElementById('DisplayContent').innerHTML = strValue[1];
	document.getElementById('BidcountId').innerHTML = strValue[2];
}
/* Bidding count AJAX Ends here*/

function SellerQuestion(obj,RefId,DisplayId,sellId,FileName,ProductType,Comment,XPOS,YPOS,AuctId)
{
	
	//document.getElementById('LayerContent').style.display="block"
	var Layers = '';
	Layers += "<span style='width:500px; z-index:999' id='Effectspan'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
	Layers += "<td width='94%' valign='top' class='OverLayTitle'>Ask a Question</td>";
	Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlayclose1();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
	Layers += "</tr><tr><td align='center' class='GreenFont'><span id='LayerForm'>Loading ...</span></td></tr></table></span>";
	document.getElementById('LayerContent').innerHTML 	= Layers;
	Rating(obj,DisplayId,'',XPOS,YPOS);
	var success = function(t){SellerQuestionComplete(t,DisplayId,obj,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var setValues;
	var url = FileName;
    var pars = '&setValues=' + RefId +'&sellId=' + sellId +'&ProductType=' + ProductType+'&Comment='+Comment+'&AuctId='+AuctId; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SellerQuestionComplete(t,spanId,RefId,XPOS,YPOS)
{
	strValue = t.responseText.split('||');
	document.getElementById('LayerForm').innerHTML 	= stripslashes(strValue[0],"\\","");
}
function AuctionFeedback(obj,RefId,DisplayId,sellId,FileName,ProductType,Comment,XPOS,YPOS,AuctId)
{
	//alert();
	//document.getElementById('LayerContent').style.display="block"
	var Layers = '';
	Layers += "<span style='width:500px; z-index:999' id='Effectspan'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
	Layers += "<td width='94%' valign='top' class='OverLayTitle'>Write Your Feedback</td>";
	Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlayclose1();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
	Layers += "</tr><tr><td align='center' class='GreenFont'><span id='LayerForm'>Loading ...</span></td></tr></table></span>";
	document.getElementById('LayerContent').innerHTML 	= Layers;
	Rating(obj,DisplayId,'',XPOS,YPOS);
	var success = function(t){AuctionFeedbackComplete(t,DisplayId,obj,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var setValues;
	var url = FileName;
    var pars = '&setValues=' + RefId +'&sellId=' + sellId +'&ProductType=' + ProductType+'&Comment='+Comment+'&AuctId='+AuctId; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AuctionFeedbackComplete(t,spanId,RefId,XPOS,YPOS)
{
	strValue = t.responseText.split('||');
	document.getElementById('LayerForm').innerHTML 	= stripslashes(strValue[0],"\\","");
}

function SellerValidation() 
{
	objForm = document.frmQuestions;
	if(objForm.question.value.length > 500)
	{
		alert("Question should have maximum 500 characters");
		objForm.question.focus();
		return false;
	}
	
	insertQuestion(objForm.question.value,objForm.AuctId.value,objForm.sellId.value);
	overlayclose('LayerContent'); return false
}
function insertQuestion(Question,AuctId,SellId)	{
	var Values = "";
	var success = function(t){insertQuestionComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var RefId = 'insert';
	var url = 'auctionajax.php';
    var pars = '&setValues=' + RefId +'&sellId=' + SellId +'&AuctId=' + AuctId+'&Comment='+Question;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
	//var pars = '&setValues= insert&sellId=' + SellId +'&AuctId=' + AuctId+'&Comment='+Question; alert(pars);
    //var myAjax = new Ajax.Request('auctionajax.php', {method:'post',postBody:pars, onSuccess:success, onFailure:failure});

}
function insertQuestionComplete(t,values)	{
	document.getElementById('questionlayer').innerHTML 	= stripslashes(t.responseText,"\\","");
}
function SellerValidation() 
{
	objForm = document.frmQuestions;
	if(objForm.question.value.length > 150)
	{
		alert("Your Feedback should have maximum of 150 characters");
		objForm.question.focus();
		return false;
	}
	
	insertFeedback(objForm.question.value,objForm.subject.value,objForm.AuctId.value);
	overlayclose('LayerContent'); return false
}
function insertFeedback(Question,Subject,AuctId)	{
	var Values = "";
	var success = function(t){insertFeedbackComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var RefId = 'insertFeedback';
	var url = 'auctionajax.php';
    var pars = '&setValues=' + RefId +'&Subject=' + Subject +'&AuctId=' + AuctId+'&Comment='+Question;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
	//var pars = '&setValues= insert&sellId=' + SellId +'&AuctId=' + AuctId+'&Comment='+Question; alert(pars);
    //var myAjax = new Ajax.Request('auctionajax.php', {method:'post',postBody:pars, onSuccess:success, onFailure:failure});

}
function insertFeedbackComplete(t,values)	{
	//alert(t.responseText);
	document.getElementById('feedbacklayer').innerHTML 	= stripslashes(t.responseText,"\\","");
}
function characterCntAlert(val,strformfield,SpanId,name) 
{
	var textField = strformfield;
	if(textField.value.length > val)
	{ 
		textField.value= textField.value.substring(0,val); 
		textField.blur(); 
		alert("Your "+name+" maxminum lenght is "+val+" characters");
	}
	/*if(textField.value.length > val)
	{ 
		document.getElementById('MaxSubject').innerHTML = 0;
		alert("No More Text Can Be Entered");
	}*/
	else
		document.getElementById(SpanId).innerHTML= (val-textField.value.length);
} 
