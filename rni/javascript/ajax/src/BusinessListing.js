function insertRatingValues(ListingIdent,DisplayIdent,FileName)
{
	var Values = DisplayIdent;
	//alert(DisplayIdent)
	var ratingValues = new Array();
	ratingValues[0] = document.getElementById("r_price_value").value;
	ratingValues[1] = document.getElementById("r_courtesy_value").value;
	ratingValues[2] = document.getElementById("r_quality_value").value;
	ratingValues[3] = document.getElementById("r_professionalism_value").value;
	ratingValues[4] = document.getElementById("r_service_value").value;
	var success = function(t){RatingComplete(t,Values,ListingIdent);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'BussinessIdent='+ListingIdent+'&RatingValues='+ratingValues+'&RatingType=BusinessRating'; //alert(pars)
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function RatingComplete(t,Values,Ident)
{	
	var strValue = t.responseText.split("||"); 
	Values = Values.toString();
	wrapper_full(Ident,0,0,0,0,0,0,0,strValue[0],'Business');
	var ProductType = 'Business';
	document.getElementById('NoVotes').innerHTML = "<span id='votes' onclick=\"overlaycloseVotes();overlayclose('LayerContent');VotesDisplayBusiness(this,'DisplayVoteBusiness',"+Ident+",'-40',12,'CommonRating.php','"+ProductType+"');\" style='cursor:pointer; text-decoration:underline'>"+strValue[1]+" vote</span>"
	//document.getElementById('NoVotes').innerHTML = strValue[1];
	document.getElementById('RatingImageShow').innerHTML = strValue[2];
	document.getElementById('showReviewpage').innerHTML = "";
	//document.getElementById('showReviewpage').innerHTML = "<span id='BusinessRating' onClick=return BusinessRating(this,'ratingContent') style='cursor:pointer;color:#0000FF;text-decoration:underline;'>your review</span>";
	//document.getElementById('ratingContentReview').innerHTML = strValue[3];
	//return BusinessRating('BusinessRating','ratingContentReview');
}
function displayForms(Ident,DisplayIdent,FileName)
{
	var Values = DisplayIdent;
	var success = function(t){DiplayFormsComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'Id='+Ident;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function DiplayFormsComplete(t,Values)
{
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	BusinessRating(this,Values);
}
function loadingFiles(Ident,CategoryId,ListingId,DisplayIdent,FileName)
{
	var Values = DisplayIdent;
	var success = function(t){LoadingFilesComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'Id='+Ident+'&CatId='+CategoryId+'&ListingId='+ListingId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function LoadingFilesComplete(t,Values)
{
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
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
function BusinessDedcuction(ListingIdent,UserId,t,deductionFor,FileName){
	var success = function(t){DeductionUpdateComplete(t);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'SetValues=Deduction&ListingIdent='+ListingIdent+'&BusinessStatus='+t+'&deductionfor='+deductionFor+'&UserId='+UserId;
	var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function DeductionUpdateComplete(t){
	//alert(t.responseText)
}
function editFailed(Values){
	//alert('response')
}
