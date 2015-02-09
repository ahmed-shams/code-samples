var ImgArray = new Array(new Image(),new Image())
ImgArray[0].src = "images/Rating_Red.gif"
ImgArray[1].src = "images/Rating_Gray.gif"
var RatePanelLoad="<img src='images/clocks.gif' />";
function CommonReviewValidation(ProductType) 
{
	objForm = document.frmReviews;
	if(!IsValid(objForm.ReviewSubject.value,"Subject"))
	{
		objForm.ReviewSubject.focus();
		return false;
	}
	if(objForm.ReviewSubject.value.length > 50)
	{
		alert("Subject should have maximum 50 characters");
		objForm.ReviewSubject.focus();
		return false;
	}
	if(!IsValid(objForm.ReviewComment.value,"Comment"))
	{
		objForm.ReviewComment.focus();
		return false;
	}
	if(objForm.ReviewComment.value.length > 1500)
	{
		alert("ReviewComment should have maximum 1500 characters");
		objForm.ReviewSubject.focus();
		return false;
	}
	ReviewItCommon(4,'ReviewIt','CommonRating.php',ProductType);
	overlayclose('LayerContent'); return false
}

function hoverRating(RV)
{
	if (RV >= 1)
	{
		if(document.getElementById("RateIt--1").value >="1") {
			document.getElementById("Star1").src = "images/Rating_Red.gif"
		} else
			document.getElementById("Star1").src = "images/Outline_Gray.gif"
		document.getElementById("selRating").innerHTML = RV+"-"+"Terrible!";
	}
	if (RV >= 2)
	{
		if(document.getElementById("RateIt--1").value >="2") {
			document.getElementById("Star2").src = "images/Rating_Red.gif"
		} else
			document.getElementById("Star2").src = "images/Outline_Gray.gif"
		document.getElementById("selRating").innerHTML = RV+"-"+"Bad!";
	}
	if (RV >= 3)
	{
		if(document.getElementById("RateIt--1").value >="3") {
			document.getElementById("Star3").src = "images/Rating_Red.gif"
		}  else
			document.getElementById("Star3").src = "images/Outline_Gray.gif"
		document.getElementById("selRating").innerHTML = RV+"-"+"Ok!";
	}
	if (RV >= 4)
	{	
		if(document.getElementById("RateIt--1").value >="4") {
			document.getElementById("Star4").src = "images/Rating_Red.gif"
		} else
			document.getElementById("Star4").src = "images/Outline_Gray.gif"
		document.getElementById("selRating").innerHTML = RV+"-"+"Good!";
	}
	if (RV >= 5)
	{
		if(document.getElementById("RateIt--1").value >="5") {
			document.getElementById("Star5").src = "images/Rating_Red.gif"
		} else
			document.getElementById("Star5").src = "images/Outline_Gray.gif"
		document.getElementById("selRating").innerHTML = RV+"-"+"Great!";
	}
	return false;
} 

function outRating(RV)
{
	var val = (document.getElementById("selRating").innerHTML).split("-");
	if (RV >= 1) {
		if(document.getElementById("RateIt--1").value >="1") {
			document.getElementById("Star1").src = "images/Rating_Red.gif"
		} else {
			document.getElementById("Star1").src = "images/Rating_Gray.gif"
		}
	}
	if (RV >= 2) {
		if(document.getElementById("RateIt--1").value >="2") {
			document.getElementById("Star2").src = "images/Rating_Red.gif"
		} else {
			document.getElementById("Star2").src = "images/Rating_Gray.gif"
		}
	}
	if (RV >= 3) {
		if(document.getElementById("RateIt--1").value >="3") {
			document.getElementById("Star3").src = "images/Rating_Red.gif"
		} else {
			document.getElementById("Star3").src = "images/Rating_Gray.gif"
		}
	}
	if (RV >= 4) {
		if(document.getElementById("RateIt--1").value >="4") {
			document.getElementById("Star4").src = "images/Rating_Red.gif"
		} else {
			document.getElementById("Star4").src = "images/Rating_Gray.gif"
		}
	}
	if (RV >= 5) {
		if(document.getElementById("RateIt--1").value >="5") {
			document.getElementById("Star5").src = "images/Rating_Red.gif"
		} else {
			document.getElementById("Star5").src = "images/Rating_Gray.gif"
		}
	}
	return false;
}
function newRatingEntered(RV)
{
	
	if (RV >= 1) {
		document.getElementById("Star1").src = ImgArray[0].src
		document.getElementById("selRating").innerHTML = RV+"-"+"Terrible!";
	}	
	else {
		document.getElementById("Star1").src = ImgArray[1].src
	}
	if (RV >= 2) {
		document.getElementById("Star2").src = ImgArray[0].src
		document.getElementById("selRating").innerHTML = RV+"-"+"Bad!";
	}
	else {
		document.getElementById("Star2").src = "images/Rating_Gray.gif"
	}
	if (RV >= 3) {
		document.getElementById("Star3").src = ImgArray[0].src
		document.getElementById("selRating").innerHTML = RV+"-"+"Ok!";
	}
	else {
		document.getElementById("Star3").src = "images/Rating_Gray.gif"
	}
	if (RV >= 4) {
		document.getElementById("Star4").src = ImgArray[0].src
		document.getElementById("selRating").innerHTML = RV+"-"+"Good!";
	}
	else{
		document.getElementById("Star4").src = "images/Rating_Gray.gif"
	}
	if (RV >= 5) {
		document.getElementById("Star5").src = ImgArray[0].src
		document.getElementById("selRating").innerHTML = RV+"-"+"Great!";
	}
	else{
		document.getElementById("Star5").src = "images/Rating_Gray.gif"
	}
	document.getElementById("RateIt--1").value = RV
	return false
}

function MoreDescription(Ident)
{
var Desc = document.getElementById('Desc_'+Ident).value;

	//var Desc1 = Desc.replace("\r",'<br>');
	//alert(Desc);
	//new Effect.SlideDown('moredescription_'+Ident);// return false;
	document.getElementById('moredescription_'+Ident).innerHTML  = Desc+" "+"<span class='MoreHideLink' onclick=HideDescription("+Ident+") style='cursor:pointer'>hide</span>";
}
function HideDescription(Ident)
{
	var Desc = document.getElementById('Desc_'+Ident).value;
	//var Desc1 = Desc.replace('\r\n','<br>');
	//new Effect.SlideDown('moredescription_'+Ident);// return false;
	document.getElementById('moredescription_'+Ident).innerHTML  = Desc.slice(0,150)+" "+"<span class='MoreHideLink' onclick=MoreDescription("+Ident+") style='cursor:pointer'>more</span>";
}
function characterAlert(val,strformfield,SpanId,name) 
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
function getposOffset(overlay, offsettype){
	var totaloffset=(offsettype=="left")? overlay.offsetLeft : overlay.offsetTop;
	var parentEl=overlay.offsetParent;
	while (parentEl!=null){
		totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
		parentEl=parentEl.offsetParent;
	}
	return totaloffset;
}

function Rating(curobj, subobjstr, opt_position,XPOS,YPOS){ 

	if (document.getElementById){
		//alert(opt_position.indexOf("bottom"))
		var subobj=document.getElementById(subobjstr)
		subobj.style.display=(subobj.style.display!="block")? "block" : "none"
		var xpos=getposOffset(curobj, "left")+((typeof opt_position!="undefined" && opt_position.indexOf("right")!=-1)? -(subobj.offsetWidth-curobj.offsetWidth) : 0) 
		var ypos=getposOffset(curobj, "top")+((typeof opt_position!="undefined" && opt_position.indexOf("bottom")!=-1)? curobj.offsetHeight : 0)
		xpos=xpos-XPOS
		ypos=ypos+YPOS
		subobj.style.left=xpos+"px"
		subobj.style.top=ypos+"px"
		return false
	}else
		return true
}

function overlayclose(subobj){
	document.getElementById(subobj).style.display="none"
}
function overlayclose1(){
	//Effect.Fade(document.getElementById('LayerContent'))
	//return false;
	document.getElementById('LayerContent').style.display="none"
}
function OverLayCloseImgOver()
{
	document.getElementById("CloseImg").src = "images/close-red.gif";
}
function OverLayCloseImgOut()
{
	document.getElementById("CloseImg").src = "images/close-green.gif";
}
function overlaycloseVotes(){
	//new Effect.Fade(document.getElementById('LayerContent'));
	document.getElementById('VotesLayer').style.display="none"
	
}
function RatingFormShow(obj,RefId,DisplayId,PIdent,FileName,ProductType,Comment,XPOS,YPOS)
{
	//alert();
	//document.getElementById('LayerContent').style.display="block"
	var Layers = '';
	Layers += "<span style='width:500px; z-index:999' id='Effectspan'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
	Layers += "<td width='94%' valign='top' class='OverLayTitle'>Rate It</td>";
	Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlayclose1();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
	Layers += "</tr><tr><td align='center' class='GreenFont'><span id='LayerForm'>Loading ...</span></td></tr></table></span>";
	document.getElementById('LayerContent').innerHTML 	= Layers;
	Rating(obj,DisplayId,'',XPOS,YPOS);
	var success = function(t){RatingFormShowComplete(t,DisplayId,obj,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var setValues;
	var url = FileName;
    var pars = '&setValues=' + RefId +'&PIdent=' + PIdent +'&ProductType=' + ProductType+'&Comment='+Comment; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function RatingFormShowComplete(t,spanId,RefId,XPOS,YPOS)
{
	//new Effect.toggle($('LayerForm'),'blind')
	//alert(t.responseText);
	//document.getElementById('LayerForm').style.display = "none";
	document.getElementById('LayerForm').innerHTML 	= stripslashes(t.responseText,"\\","");
	//new Effect.SlideDown('LayerForm'); return false;
}
function AddReviewForm(SpanId,Ident,Filename,ProductType)
{
	var success = function(t){AddReviewFormComplete(t,SpanId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = Filename;
    var pars = '&setValues=' + SpanId +'&Ident=' + Ident +'&ProductType=' + ProductType; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AddReviewFormComplete(t,SpanId)
{	
	var strValue = t.responseText; 
	document.getElementById('Addreview').innerHTML = strValue;
}

function ReviewItCommon(countArray,SpanID,FileName,ProductType)
{
	var frmValues = "";
	var tvalues;
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
	var success = function(t){ReviewItCommonComplete(t,spanId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
    var pars = '&setValues=' + SpanID +'&frmValues=' + frmValues +'&ProductType=' + ProductType; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ReviewItCommonComplete(t,spanId)
{  
	var strValue = Array();
	strValue = t.responseText.split('||'); 
	/*wrapper_full(Ident,0,0,0,0,0,0,0,strValue[0],strValue[1]);
	if(document.getElementById("RatingImage"))
		document.getElementById("RatingImage").innerHTML 	= stripslashes(strValue[4],"\\","");
	if(strValue[1] == 1)
		document.getElementById(Ident+"_vote").innerText 	= " vote";
	else
		document.getElementById(Ident+"_vote").innerText 	= " votes";
	
	
	if(strValue[1] != 0)
		document.getElementById("viewReview").innerHTML 	= "";*/
	
	document.getElementById("spLatestReviews").innerHTML 	= stripslashes(strValue[0],"\\","");
	
}
function RateItCommon(countArray,SpanID,FileName,ProductType)
{
	var frmValues = "";
	var tvalues;
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
	var success = function(t){RateItCommonComplete(t,spanId,ratetvalues,Producttvalues,ProductType);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
    var pars = '&setValues=' + SpanID +'&frmValues=' + frmValues +'&ProductType=' + ProductType; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function RateItCommonComplete(t,spanId,rate,Ident,ProductType)
{  //alert(t.responseText);
	var strValue = Array();
	strValue = t.responseText.split('||'); 
	wrapper_full(Ident,0,0,0,0,0,0,0,strValue[0],ProductType);
	//document.getElementById("Rating-"+Ident).innerHTML 	= stripslashes(strValue[0],"\\","");
	if(document.getElementById("RatingImage"))
		document.getElementById("RatingImage").innerHTML 	= stripslashes(strValue[4],"\\","");
	if(strValue[1] == 1) { 
		document.getElementById(Ident+"_vote").innerHTML 	= "<span id='votes' onclick=\"overlaycloseVotes();overlayclose('LayerContent');VotesDisplay(this,'DisplayVote',"+Ident+",'-40',12,'CommonRating.php','"+ProductType+"');\" style='cursor:pointer; text-decoration:underline'>"+strValue[1]+" vote</span>";
	}
	else{ 
		document.getElementById(Ident+"_vote").innerHTML 	= "<span id='votes' onclick=\"overlaycloseVotes();overlayclose('LayerContent');VotesDisplay(this,'DisplayVote',"+Ident+",'-40',12,'CommonRating.php','"+ProductType+"');\" style='cursor:pointer; text-decoration:underline'>"+strValue[1]+" votes</span>";
	}
	
	
	if(strValue[1] != 0)
		document.getElementById("viewReview").innerHTML 	= "";
	
	//document.getElementById("spLatestReviews").innerHTML 	= stripslashes(strValue[2],"\\","");
	
	
}

function ShowRateEdit(SpanId,DisplayId,ListintIdent,ReviewIdent,FileName,ProductType)
{
	var success = function(t){ShowRateEditComplete(t,DisplayId);}
	var failure = function(t){editFailed(t);}
	var setValuess;
	var url = FileName;
    var pars = '&setValues=' + SpanId +'&ReviewIdent=' + ReviewIdent +'&ListintIdent=' + ListintIdent +'&ProductType=' + ProductType;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowRateEditComplete(t,spanId)
{
	document.getElementById(spanId).innerHTML 	= stripslashes(t.responseText,"\\","");
}
function BiddingValidtion()
{
	objForm = document.frmBidNow;
	if(!IsValid(objForm.txtBidAmount.value,"Bid Amount"))
	{
		objForm.txtBidAmount.focus();
		return false;
	}
}
function VotesDisplay(obj,RefId,Ident,XPOS,YPOS,FileName,ProductType)
{
		var Layers = '';
		Layers += "<span style='width:360px; nowrap'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
		Layers += "<td width='94%' valign='top' class='OverLayTitle'>Rating List</td>";
		Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlaycloseVotes();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
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
	var strValue = t.responseText; 
	Values = Values.toString();
	//document.getElementById('LayerVote').style.display = "none";
	document.getElementById('LayerVote').innerHTML = strValue;
	//new Effect.SlideDown('LayerVote'); return false;
}

function VotesDisplayBusiness(obj,RefId,Ident,XPOS,YPOS,FileName,ProductType)
{
		var Layers = '';
		Layers += "<span style='width:600px; nowrap'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
		Layers += "<td width='94%' valign='top' class='OverLayTitle'>Rating List</td>";
		Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlaycloseVotes();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
		Layers += "</tr><tr><td align='center' class='GreenFont' valign='middle'><span id='LayerVote'>Loading ...</span></td></tr></table></span>";
		document.getElementById('VotesLayer').innerHTML 	= Layers;
		reviewoverlay(obj,'VotesLayer','',XPOS,YPOS);
		var Values = Ident;
		var success = function(t){VotesDisplayBusinessComplete(t,Values);}
		var failure = function(t){editFailed(t);}
		var url = FileName;
		var pars = 'setValues='+RefId+'&Ident='+Ident+'&ProductType='+ProductType; //alert(pars)
		var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function VotesDisplayBusinessComplete(t,Values)
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
	//document.getElementById('VotesList').style.display = "none";
	document.getElementById("VotesList").innerHTML 			= stripslashes(strValue[0],"\\","");
	//new Effect.SlideDown('VotesList'); return false;
	/*document.getElementById(Values).innerHTML 					= stripslashes(strValue[1],"\\","");*/
}

function PerPageRateBusiness(RefId,ProductType,Ident,FileName,StartLimit,EndLimit,ClickType)
{
	document.getElementById("VotesList").innerHTML = RatePanelLoad;
	var Values = RefId;
	var success = function(t){PerPageRateBusinessComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName; 
    var pars = 'setValues=' + RefId + '&Ident=' + Ident+'&ProductType='+ProductType+'&StartLimit='+StartLimit+'&EndLimit='+EndLimit+'&ClickType='+ClickType; //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function PerPageRateBusinessComplete(t, Values)
{ //alert(t.responseText);
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("VotesList").innerHTML 			= stripslashes(strValue[0],"\\","");
	/*document.getElementById(Values).innerHTML 					= stripslashes(strValue[1],"\\","");*/
}

function SearchDetailsbyTagwords(TagWords)
{
	document.getElementById('SearchText').value = TagWords;
	document.getElementById('DetailsFrm').submit();
}
function LoadingLayer()
{
	var Loading=""
	Loading += "<table border=0><tr><td class='LoadingLayer' height='5'>Loading...</td></tr></table>";
	return Loading;
}
function ReviewRemove(SpanId,ReviewIdent,Filename,ProductType,ProductId)
{
	if(!confirm("Do you want to remove"))
		return false;
	var Loading = LoadingLayer();
	document.getElementById("Loadinglayer").innerHTML = Loading;
	var Values = "";
	var success = function(t){ReviewRemoveComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
	var pars = 'setValues='+SpanId+'&ReviewIdent='+ReviewIdent+'&ProductType='+ProductType+'&ProductId='+ProductId;
	var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ReviewRemoveComplete(t,Values)
{
	var strValue = t.responseText.split('||'); 
	document.getElementById("spLatestReviews").innerHTML 			= stripslashes(strValue[0],"\\","");
}
function ReviewEditFormShow(obj,RefId,DisplayId,PIdent,FileName,ProductType,Comment,XPOS,YPOS,ReviewId)
{
	//alert();
	//document.getElementById('LayerContent').style.display="block"
	var Layers = '';
	Layers += "<span style='width:500px; z-index:999' id='Effectspan'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
	Layers += "<td width='94%' valign='top' class='OverLayTitle'>Edit Review</td>";
	Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlayclose1();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
	Layers += "</tr><tr><td align='center' class='GreenFont'><span id='LayerForm'>Loading ...</span></td></tr></table></span>";
	document.getElementById('LayerContent').innerHTML 	= Layers;
	Rating(obj,DisplayId,'',XPOS,YPOS);
	var success = function(t){ReviewEditFormShowComplete(t,DisplayId,obj,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var setValues;
	var url = FileName;
    var pars = '&setValues=' + RefId +'&PIdent=' + PIdent +'&ProductType=' + ProductType+'&Comment='+Comment+'&ReviewId='+ReviewId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ReviewEditFormShowComplete(t,spanId,RefId,XPOS,YPOS)
{
	document.getElementById('LayerForm').innerHTML 	= stripslashes(t.responseText,"\\","");
}
function SendToPhoneOverLayForm(obj,Ident,DisplayIdent,ListingIdent,FileName)
{
	var Layers = '';
	Layers += "<span style='width:500px; nowrap'><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr>";
	Layers += "<td width='94%' valign='top' class='OverLayTitle'>Send 2 Phone</td>";
	Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlayclose1();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
	Layers += "</tr><tr><td align='center' class='GreenFont'><span id='LayerForm'>Loading ...</span></td></tr></table></span>";
	document.getElementById('LayerContent').innerHTML 	= Layers;
	phoneoverlay(obj,DisplayIdent,'');
	var Values = DisplayIdent;
	var success = function(t){SendToPhoneOverLayFormComplete(t,obj,Values);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ListintIdent='+ListingIdent;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function SendToPhoneOverLayFormComplete(t,Obj,Values) 
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	//document.getElementById('LayerForm').style.display = "none";
	document.getElementById('LayerForm').innerHTML = strValue;
	//new Effect.SlideDown('LayerForm'); return false;
	//document.getElementById('LayerForm').innerHTML = strValue;
	//return phoneoverlay(Obj,Values,'');
}