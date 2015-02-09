var ClassifiedVar = '';
var AnnouncementVar = '';
var ClassifiedVar1 = '';
var CalssifiedCarModelVar = '';
var z = 1;
var loadstatustext="<img src='images/green-tab_loading.gif'/>"
/*function RssFeed(obj,DisplayId)
{
	var Layers = '';
	Layers += "<span style='width:500px; nowrap'><table width='100%' border='0' cellpadding='0' cellspacing='0'><tr>";
	Layers += "<td width='94%' valign='top' class='OverLayTitle'>Review It</td>";
	Layers += "<td width='6%' align='right' valign='top' class='OverLayTitle'><span class='DisplayCellText' onMouseOver='OverLayCloseImgOver();' onMouseOut='OverLayCloseImgOut()' onClick='overlayclose1();' style='cursor:pointer'><img src='images/close-green.gif' name='CloseImg' id='CloseImg' border='0' align='top'></span></td>";
	Layers += "</tr><tr><td align='center' class='GreenFont'><span id='LayerForm'>Loading ...</span></td></tr></table></span>";
	document.getElementById('LayerContent').innerHTML 	= Layers;
	Rating(obj,DisplayId);
	var success = function(t){RssFeedComplete(t,DisplayId,obj,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var setValues;
	var url = FileName;
    var pars = '&setValues=' + RefId +'&PIdent=' + PIdent +'&ProductType=' + ProductType+'&Comment='+Comment;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function RssFeedComplete(t,spanId,RefId,XPOS,YPOS)
{
	//document.getElementById('LayerForm').innerHTML 	= stripslashes(t.responseText,"\\","");
}*/
function  ChangeEmailAddress(RefId,OldEmail,NewEmail,Filename){
	document.getElementById('Saving').innerHTML = '<b><font color="red">Saving...</font></b>'
	var NewEmailId = document.getElementById(NewEmail).value;
	var OldEmailId = document.getElementById(OldEmail).value;
	var Values = '';
	var success = function(t){ChangeEmailAddressComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
    var pars = 'setValues='+RefId+'&NewEmail='+ NewEmailId+'&OldEmail='+ OldEmailId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ChangeEmailAddressComplete(t,Values){	
	strValue = t.responseText.split('||'); 
	if(strValue[0] != "")
		document.getElementById('ChangeEmail').innerHTML = strValue[0];
	else
		overlayclose('innerContent');
	document.getElementById('newemail').innerHTML = strValue[1];
	document.getElementById('ResendSucess').innerHTML = "";
}
function ResendActivationMail(RefId,MemberIdent,Filename){
	document.getElementById('ResendSucess').innerHTML = '<b><font color="red">Resending...</font></b>'
	var Values = '';
	var success = function(t){ResendActivationMailComplete(t,Values);}
	var failure = function(t){editFailed(t);}
	var url = Filename;
    var pars = 'setValues='+RefId+'&MemberIdent='+ MemberIdent; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ResendActivationMailComplete(t,Values){ 
	document.getElementById('ResendSucess').innerHTML = '<b>' + t.responseText + '</b>';
}
function ChangeEmailAddressOverLayForm(obj,Ident,MemberIdent,DisplayIdent,FileName,FuncName){
	var Values = DisplayIdent;
	var success = function(t){ChangeEmailAddressOverLayFormComplete(t,obj,Values);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&MemberIdent='+ MemberIdent; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ChangeEmailAddressOverLayFormComplete(t,Obj,Values){	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	return changeEmailAddressoverlay(Obj,Values,'');
}
function BookMark(SpanId,Profilename,MemberId,DisplayId,filename){ 
	document.getElementById(DisplayId).innerHTML=loadstatustext
	var Values = DisplayId;
	var success = function(t){ProfileNextComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId + '&id=' + Profilename + '&MemberId=' + MemberId;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ProfileNext(SpanId,Profilename,DisplayId,filename){ 
	document.getElementById(DisplayId).innerHTML=loadstatustext
	var Values = DisplayId;
	var success = function(t){ProfileNextComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'objIdent=' + SpanId + '&id=' + Profilename;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ProfileNextComplete(t, Values){ 	
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
	showAsEditable(Values, true);
}
function DisplayFullReview(spanid,ident,filename){
	var Values = spanid;
	var success = function(t){perpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&ident=' + ident; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}


function FriendsperpageDispaly(spanid,page,filename,Display,MemberId,Limit){ 	
	var Values = Display;
	var success = function(t){FriendsperpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page+'&mid='+MemberId+'&limit='+Limit;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function FriendsperpageComplete(t, Values){ 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
}






function DisplayFullReButtals(spanid,ident,filename,ProfileName){
	var Values = spanid;
	var success = function(t){perpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&ident=' + ident + '&id=' + ProfileName;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
//This Function  used to display the Pergpage
function guestBookperpageDispaly(spanid,page,id,filename,Display){
	var Values = Display;
	var success = function(t){perpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&Id=' + id;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
//This Function  used to display the Pergpage
function perpageDispaly(spanid,page,filename,Display){ 
	var Values = Display;
	var success = function(t){perpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
//This Function  used to display the Pergpage
function perpageDispalyReview(spanid,page,filename,Display,CategoryId){ 
	var Values = Display;
	var success = function(t){perpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&d=' + CategoryId;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function perpageComplete(t, Values){ 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
	showAsEditable(Values, true);
}
//This Function  used to display the Moive Pergpage
function MovieperpageDispaly(spanid,page,opvalue,filename,Display){ 	
	document.getElementById(Display).innerHTML=loadstatustext
	var Values = Display;
	var success = function(t){MovieperpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&mid='+ opvalue;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function MovieperpageComplete(t, Values){ 
	Values = Values.toString();	
	document.getElementById(Values).innerHTML = t.responseText;
	showAsEditable(Values, true);
}
//This Function  used to display the Classifieds PerPage
function ClassifidesPerPage(spanid,page,opvalue,usrid,filename,Display){ 
	var Values = Display;
	var success = function(t){ClassifidesPerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&c='+ opvalue + '&ml='+ usrid;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ClassifidesPerPageComplete(t, Values){ 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
	showAsEditable(Values, true);
}
//This Function  used to display the Moive Pergpage
function BlogsPerPage(spanid,page,filename,Display){ 
	var Values = Display;
	var success = function(t){BlogsPerPagePerPageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function BlogsPerPagePerPageComplete(t, Values){ 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
	showAsEditable(Values, true);
}
//This Function  used to display the Moive cast Pergpage
function MovieCastperpageDispaly(spanid,page,opvalue,filename,Display,type){ 
	document.getElementById(Display).innerHTML=loadstatustext
	var Values = Display;
	var success = function(t){MovieperpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&mid='+ opvalue+"&type=" + type ;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function MovieCastperpageDispalyComplete(t, Values){ 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
	showAsEditable(Values, true);
}
//This Function  used to display the Moive Pergpage
function MoviePhotoPreview(spanid,count,page,opvalue,filename,Display){ 
	document.getElementById(Display).innerHTML=loadstatustext
	var Values = Display;
	var success = function(t){MovieperpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&mid='+ opvalue + "&count=" +count;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function MoviePhotoPreviewComplete(t, Values){ 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
	showAsEditable(Values, true);
}
//This Function  used to display the Moive Genre Pergpage
function MovieGenreperpageDispaly(spanid,page,opvalue,type,year,letter,filename,Display){ 
	document.getElementById(Display).innerHTML=loadstatustext
	var Values = Display;
	var success = function(t){MovieperpageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&g='+ opvalue + "&t=" + type + "&y=" + year + "&o=" + letter; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function MovieGenreperpageComplete(t, Values){ 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = t.responseText;
	showAsEditable(Values, true);
}
//this function  used to display the Next Next Catalog
function NextCatalog(spanId,DisplayId,OrderId,filename,memberId,pagename,profilename){  
	var Values = DisplayId;
	var success = function(t){NextCatalogComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanId + '&OrderId=' + OrderId + '&MemberId=' + memberId + '&pagename=' + pagename + '&id=' + profilename;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function NextCatalogComplete(t, Values){ 
	strValue = t.responseText.split('||'); 
	if(strValue[4] == 'normal'){
		document.getElementById('spMainDisplay').innerHTML = strValue[0];
		document.getElementById('imageDispaly').innerHTML = strValue[1];
		document.getElementById('Front').src = strValue[2];
		document.getElementById('Back').src = strValue[3];
	}else if(strValue[1] == 'thumb'){
		document.getElementById('spMainDisplay').innerHTML = strValue[0];
	}else{
		document.getElementById('spMainDisplay').innerHTML = strValue[0];
		document.getElementById('spDisplay').innerHTML = strValue[1];
		document.getElementById('orginal').src = strValue[2];
	}
	showAsEditable(Values, true);
}
//This function  used to display the Froant And Back Image
function DisplayImageBack(spanId,DispalyId,ImageIdent,filename,DisplayPage){
	var Values = DispalyId;
	var success = function(t){CatalogImageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanId + '&ImageIdent=' + ImageIdent + '&pagename=' + DisplayPage; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
//This Function  Used To display the ThumbNail Image, normal Image, Medium Image
function DisplayImage(spanId,DispalyId,ImageIdent,filename,DisplayPage,memberid,ProfileName){
	var Values = DispalyId;
	var success = function(t){CatalogImageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanId + '&ImageIdent=' + ImageIdent + '&MemberId=' + memberid + '&pagename=' + DisplayPage + '&id=' + ProfileName; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function CatalogImageComplete(t, Values){ 
	Values = Values.toString();
	strValue = t.responseText.split('||'); 
	if(strValue[2] == 'thumb'){
		document.getElementById('spMainDisplay').innerHTML = strValue[0];
		document.getElementById('spDisplay').innerHTML = strValue[1];
	}else if(strValue[4] == 'normal'){ 
		document.getElementById('spMainDisplay').innerHTML = strValue[0];
		document.getElementById('imageDispaly').innerHTML = strValue[1];
		document.getElementById('Front').src = strValue[2];
		document.getElementById('Back').src = strValue[3];
	}else if(strValue[3] == 'medium'){ 
		document.getElementById('spMainDisplay').innerHTML = strValue[0];
		document.getElementById('imageDispaly').innerHTML = strValue[1];
		document.getElementById('orginal').src = strValue[2];
	}else if(strValue[3] == 'Orginal'){
		document.getElementById('spMainDisplay').innerHTML = strValue[0];
		document.getElementById('spDisplay').innerHTML = strValue[1];
		document.getElementById('orginal').src = strValue[2];
	}else
		document.getElementById(Values).src = t.responseText;
	showAsEditable(Values, true);
}
//This function used to delete the catalog
function DeleteCatalogs(ImageIdent,msg,filename,mainId,subId){ 
	if(!confirm("Are you sure to Delete the Image?\nClick Ok if yes, otherwise click Cancel for not to upload."))
		return;
	var Values = new Array();
	Values[0] = mainId;
	Values[1] = subId;
	var success = function(t){CatalogComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + msg + '&objIdent=' + ImageIdent; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function CatalogComplete(t, Values){  
	strValue = t.responseText.split('||'); 
	document.getElementById(Values[0]).innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById(Values[1]).innerHTML = stripslashes(strValue[1],"\\","");
	showAsEditable(Values, true);
}
function checkForGender(){
	if(document.getElementById("PersonalDetails--2").value == ""){
		var len = document.frmProfile.Gender.length;
		for(i=0;i<len;i++){
			if(document.frmProfile.Gender[i].checked == true)
			var Val = document.frmProfile.Gender[i].value;
			document.getElementById("PersonalDetails--2").value = Val;
		}
	}
}
//this function  used to save the datails in Db Like coupon page,profile page etc...

function save_Details(id,countArray,displayid,filename){
	var spanId;
	var txtValue="";
	var txtValues;
	var tvalues;
	var myfile;
	if(id=="InviteNonMembersList" || id=="InviteMembersList" || id=="RemindMembersList" || id=="RemindNonMembersList" || id=="InviteFriendsStep1" || id=="InviteFriendsStep2" || id=="DeleteMembersList" || id=="DeleteNonMembersList"){
		for(i=0;i<countArray;i++){
			spanId=id+"--"+i;
			if(document.getElementById(spanId).checked==true){
				txtValues = spanId;
				tvalues = document.getElementById(spanId).value;
				txtValue += tvalues+"||";
			}
		}
	}
	else
	{
		if(countArray>0){
			for(i=0;i<countArray;i++){
				spanId=id+"--"+i;				
				txtValues=spanId;
				tvalues = document.getElementById(spanId).value;
				tvalues=tvalues.replace('&','__');
				txtValue+=tvalues+"||";
			}
		}else{
			txtValues = id;
			txtValue = id;
		}
	}
	var Values = displayid;
	var success = function(t){SavelabelComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'checkText=' + txtValue + '&objIdent=' + txtValues + '&Id=' + id;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function GalleryDragDropUpDate(SpanId,Values,FileName)
{
	var success = function(t){GalleryDragDropUpDateComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
    var pars = '&objIdent=' + SpanId + '&Values=' + Values;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function GalleryDragDropUpDateComplete(t,Values)
{
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();	
	if(strValue[0] != "")
		document.getElementById("GraphicsDisplay").innerHTML = stripslashes(strValue[0],"\\","");	
}
function dragImageGallery(SpanId,ImageIdent,displayid,FileName){
	var Values = displayid;
	if(SpanId=="AddAlbumName" || SpanId=="SetDefaultAlbum"){
		ImageIdent = document.getElementById(ImageIdent).value;
	}
	var success = function(t){displayChangeValues(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
    var pars = '&ImageId=' + ImageIdent + '&SpanIdent=' + SpanId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function displayChangeValues(t,Values){	
	var strValue = t.responseText.split('||');	
	Values = Values.toString();
	document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
	if(strValue[1] != "")
		document.getElementById("GraphicsDisplay").innerHTML = stripslashes(strValue[1],"\\","");
	Product.makeImagesSortable();
	
}
function dragPersonalSumMenu(SpanId,ImageIdent,displayid,FileName){
	var Values = displayid;
	if(SpanId=="AddAlbumName" || SpanId=="SetDefaultAlbum"){
		ImageIdent = document.getElementById(ImageIdent).value;
	}
	var success = function(t){dragPersonalSumMenuComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = FileName;
    var pars = '&ImageId=' + ImageIdent + '&SpanIdent=' + SpanId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function dragPersonalSumMenuComplete(t,Values){	
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById("spDisplay").innerHTML = stripslashes(strValue[1],"\\","");
}
function approve_deny(id,countArray,displayid,filename){
	var spanId;
	var tvalues;
	if(id=="ApproveAll" || id=="DenyAll"){
		var strContent = new Array();	
		var txtValues = new Array();
		for(k=0;k<countArray;k++){
			spanId="FriendsRequest"+"--"+k;
			if(document.getElementById(spanId).checked==true){
				tvalues = document.getElementById(spanId).value;
				strContent += tvalues+"||";
			}	
		}
	}else{
		var strContent="";	
		var txtValues;
		var NewId=id.split("--");
		txtValues=NewId[0];
		spanId="FriendsRequest"+"--"+NewId[1];
		if(document.getElementById(spanId).checked==true){
			tvalues = document.getElementById(spanId).value;
			strContent = tvalues;
		}
	}
	var Values = displayid;
	var success = function(t){SavelabelComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'checkText=' + strContent + '&objIdent=' + txtValues + '&Id=' + id;  
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
//This function  used to save the catalog details
function save_DetailsCatalog(id,countArray,displayid,filename,countArray1){ 
	var spanId;
	var txtValue="";
	var txtValue1="";
	var txtValues;
	var tvalues;
	var tvalues1;
	var myfile;
	for(i=0;i<countArray;i++){
		spanId=id+"--"+i;
		txtValues=spanId;
		tvalues = document.getElementById(spanId).value;
		tvalues=tvalues.replace('&','__');
		txtValue+=tvalues+"||";
	}
	for(i=1;i<countArray1;i++){
		spanId=id+i+"--"+i;
		txtValues=spanId;
		tvalues1 = document.getElementById(txtValues).value;
		tvalues1=tvalues1.replace('&','__');
		txtValue1+=tvalues1+"__";
	}
	txtValue = txtValue + txtValue1;
	var Values=displayid;
	var success = function(t){SavelabelComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'checkText=' + id + '&objIdent=' + txtValue; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
//this function  used to save the datails in Db Like coupon page,profile page etc...
function save_Detailsreview(id,countArray,displayid,filename,insert){
	var spanId;
	var txtValue="";
	var txtValues;
	var tvalues;
	var myfile;
	if(id=="InviteNonMembersList" || id=="InviteMembersList" || id=="RemindMembersList" || id=="RemindNonMembersList"){
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
				tvalues = document.getElementById(spanId).value;
				tvalues=tvalues.replace('&','__');
				txtValue+=tvalues+"||";
			}
		}else{
			txtValues = id;
			txtValue = id;
		}
	}
	var Values = displayid;
	var success = function(t){SavelabelComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'checkText=' + txtValue + '&objIdent=' + txtValues + '&Id=' + id + '&strVal=' + insert;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function SavelabelComplete(t,Values){
	//alert(t.responseText);
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();	
	if(document.getElementById(Values))
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
	if(Values=="DeleteFriends"){	
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("spMainDiaplay").innerHTML = stripslashes(strValue[1],"\\","");
	}else if(Values=="PersonalSumMenu"){
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[1],"\\","");
	}else if(strValue[2] == "index"){		
		dismissboxv2();	
		document.getElementById('Zipcodedropinboxv2cover').style.height = "150";
		document.getElementById('Zipcodedropinboxv2').style.height = "150";
		document.location.href = strValue[3];
	}else if(strValue[1] == "ZipCodeError"){
		document.getElementById("spZipCode").innerHTML = stripslashes(strValue[0],"\\","");	
		
		if(document.getElementById('showstate')){
			document.getElementById('StateChoice').innerHTML = stripslashes(strValue[2],"\\","");
			document.getElementById('showstate').style.visibility = "visible";				
			document.getElementById('showstate').style.display = "inline";
			document.getElementById('hideStateText1').style.visibility = "hidden";				
			document.getElementById('hideStateText1').style.display = "none";	
			document.getElementById('Zipcodedropinboxv2cover').style.height = "400";
			document.getElementById('Zipcodedropinboxv2').style.height = "400";			
		}
		
		//document.getElementById('Zipcodedropinboxv2cover').style.height = "170";
		//document.getElementById('Zipcodedropinboxv2').style.height = "170";	
	}
	else if(strValue[2] == "ZipCodeByState")
	{
		document.getElementById("spZipCode").innerHTML = stripslashes(strValue[1],"\\","");	
		document.getElementById("StateChoice").innerHTML = stripslashes(strValue[0],"\\","");
	}
	else if(strValue[2] == "GuestBook"){			
		document.getElementById("GComments").innerHTML = stripslashes(strValue[1],"\\","");			
		document.getElementById("spPersonalGuestBook").innerHTML = stripslashes(strValue[0],"\\","");		
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[3],"\\","");		
		if(document.getElementById("innerContent"))
			overlayclose('innerContent')	
	}else if(strValue[2] == "GuestBookLoginError"){
		document.getElementById("spMainDiaplay").innerHTML = stripslashes(strValue[0],"\\","");	
		document.getElementById("GuestBookLoginError").innerHTML = stripslashes(strValue[1],"\\","");		
	}else if(strValue[2] == "DeleteGuestBook"){				
		document.getElementById("spMainDiaplay").innerHTML = stripslashes(strValue[0],"\\","");	
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[1],"\\","");		
	}else if(strValue[2] == "ContactSended"){
		document.getElementById("ContactMePreview").innerHTML = stripslashes(strValue[0],"\\","");	
		document.getElementById("SendMessage").innerHTML = stripslashes(strValue[1],"\\","");
	}else if(strValue[2] == 'top'){
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("checkEdit").innerHTML = stripslashes(strValue[1],"\\","");			
	}else if(strValue[3] == 'sum') {
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[2]);
	}else if(strValue[2] == 'Error'){
		document.getElementById("checkAvailMsg").innerHTML = stripslashes(strValue[1],"\\","");						
	}else if(strValue[3] == 'ContactInsert'){ 
		document.getElementById("spMainDiaplay").innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[1]);
		document.getElementById("memberimage").src = stripslashes(strValue[2]);
	}else if(strValue[3] == 'UpdateHeader'){ 
		document.getElementById("TotalReviewAdd").innerHTML = stripslashes(strValue[1]);
		document.getElementById("ratingImage").src = stripslashes(strValue[2]);
		document.getElementById("addreviews").innerHTML = "Ratings Feedback";	
	}else if(strValue[2] == 'updaterebuttalsheader'){ 
		document.getElementById("addrebuttals").innerHTML = "("+stripslashes(strValue[1])+")";
	}else{
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("checkEdit1").innerHTML = stripslashes(strValue[1],"\\","");	
	}
	showAsEditable(Values, true);
}

function edit_label(obj,textid,msgid,filename,forImage){  
	var textValue;	
	if(textid!=''){
		textValue = textid; 
		if(document.getElementById(textid))
			textValue = document.getElementById(textid).value;
	}else
		textValue = "";		
	var Values = msgid
	var success = function(t){labelComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'checkText=' + textValue + '&objIdent=' + obj;
	if(forImage)
		pars+= '&forImage=1';
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function labelComplete(t,Values){	 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	if(strValue[1] == 'CheckProfile'){
		document.getElementById('checkAvailMsgProfile').innerHTML = strValue[0];
	}else
		document.getElementById(Values).innerHTML = strValue[0];
	
	/*For Hidding the LeftMenu Scroll Bar Images in Personal Page*/
	if(document.getElementById('spDisplay')){
		offsetHeight = (document.getElementById('spDisplay').offsetHeight);
		if(offsetHeight < 350){
			document.getElementById('sliderDiv1').style.display = "None";
			document.getElementById('sliderDiv1').style.display = "None";
		}else if(offsetHeight > 350){	
			document.getElementById('sliderDiv1').style.display = "inline";
			document.getElementById('sliderDiv1').style.display = "inline";
			init();
		}
	}
	/*Ends Here*/
	showAsEditable(Values, true);
}
function editblog_label(obj,textid,mainid,msgid,filename){  
	var textValue;
	if(textid!='')
		textValue = document.getElementById(textid).value;
	else
		textValue = "";
	var Values = new Array();
	Values[0] = mainid;
	Values[1] = msgid;
	var success = function(t){bloglabelComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'checkText=' + textValue + '&objIdent=' + obj;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function bloglabelComplete(t,Values){	
	var strValue = t.responseText.split('||'); 
	document.getElementById(Values[0]).innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById(Values[1]).innerHTML = stripslashes(strValue[1],"\\","");
}
//This function  used to display the values from the DB
function display_textarea(obj,filename,countArray,textareaName,type){ 

	if(!document.getElementById("temp"+obj).checked)
		obj = 0;
	var Values = new Array();
	Values[0] = obj;
	Values[1] = countArray;
	Values[2] = textareaName;
	Values[3] = type;
	var success = function(t){displayTextareaComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'objIdent=' + obj + '&textarea=' + Values[2]; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function displayTextareaComplete(t, Values){ 
	var strValue = t.responseText.split('--');
	document.getElementById('spDisplay').innerHTML = stripslashes(strValue[0]);
	if(strValue[2]=='Image'){ 
		document.getElementById('memberimage').src = strValue[1];
	}else{
		if(strValue[1] == "NoCouponImages"){				
			document.getElementById('spDisplay').innerHTML = stripslashes(strValue[0]);
			for(i=1; i<7; i++)
			{
				document.getElementById('CouponDetails--'+i).value = "";
				document.getElementById('CouponDetails--'+i).disabled = "disabled";
			}
			document.getElementById('CouponDetails--0').value = 0;			
		}
		else{	
			document.getElementById('CouponDetails--1').disabled = false;
			document.getElementById('CouponDetails--2').disabled = false;
			document.getElementById('CouponDetails--3').disabled = false;
			document.getElementById('CouponDetails--4').disabled = false;
			document.getElementById('CouponDetails--5').disabled = false;
			document.getElementById('CouponDetails--6').disabled = false;
			for(var i=1;i<=Values[1];i++){ 
				if(Values[3] == "value"){ 
					document.getElementById(Values[2]+'_textarea'+i).value = stripslashes(strValue[i],"\\","");
					document.getElementById('CouponDetails--0').value = strValue[1];
					
				}else if(Values[3] == "html"){ 
					document.getElementById(Values[2]+'_textarea'+i).innerHTML = strValue[i];
				}
			}
		}
	}
	showAsEditable(Values, true);
}
// Edit Textarea
function edit_textarea(obj,rows,cols,scrollcolor){
	obj = obj.toString();
	var mytool_array = obj.split("_");
	var id = mytool_array[0];
	Element.hide(id);
	var textValue = document.getElementById(id).innerText;
	var textarea ="<div id='"+id+"_editor'><textarea id='"+id+"_edit' name='"+id+"' rows='"+rows+"' style='border:1px solid;width="+cols+"%;scrollbar-base-color:"+scrollcolor+";'>"+textValue+"</textarea></div>";
	new Insertion.After(id,textarea);
	Field.focus(id+'_edit');
}
// This function used to Edit generate dynamic textboxes
function edit_multitextarea(obj,rows,cols,scrollcolo,countArray,mysp1,mysp2){
	obj = obj.toString();
	var mytool_array = obj.split("_");
	var myId = mytool_array[0];
	var id;
	var textValue;
	for(var i=0;i<countArray;i++){
		id = myId+"--"+i;
		Element.hide(id);
		textValue = document.getElementById(id).innerText;
		var textarea ="<span id='"+id+"_editor'><textarea id='"+id+"_edit' name='"+id+"' rows='"+rows+"' style='border:1px solid;width="+cols+"%;scrollbar-base-color:"+scrollcolo+";'>"+textValue+"</textarea></span>";
		new Insertion.After(id,textarea);
	}
	z++;
	////New Add Text Edit here Id = 1	
	if(mysp1 != '' || mysp2 !=''){
		var temp = document.getElementById(mysp1).innerText;
		if(temp != '' && temp != 'undefined'){
			var test = parseArrayString(temp,'Yes');
			for(var p=test.length-1;p>=0;p--){
				Element.hide(mysp1);
				var textbox = "<span id='my_span--"+p+"_editor'><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<textarea name='my_span--"+p+"_edit' id='my_span--"+p+"' rows='"+rows+"' style='border:1px solid;width="+cols+"%;scrollbar-base-color:"+scrollcolo+";' class='TxtBox'>"+LTrim(test[p])+"</textarea></span><br>";
				new Insertion.After(mysp1, textbox);
			}
		}
		////New Add Text Edit here Id = 2
		var temp1 = document.getElementById(mysp2).innerText;
		if(temp1 != '' && temp1 != "undefined"){
			var test1 = parseArrayString(temp1,'Yes');
			for(var p1=test1.length-1;p1>=0;p1--){
				Element.hide(mysp2);
				var textbox1="<span id='my_span1--"+p1+"_editor'><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<textarea name='my_span1--"+p1+"_edit' id='my_span1--"+p1+"' rows='"+rows+"' style='border:1px solid;width="+cols+"%;scrollbar-base-color:"+scrollcolo+";' class='TxtBox'>"+LTrim(test1[p1])+"</textarea></span><br>";
				new Insertion.After(mysp2, textbox1);
			}
		}
	}
}
// Edit Single Textbox
function edit_textbox(obj,size){
	obj = obj.toString();
	var mytool_array = obj.split("_");
	var id = mytool_array[0];
	Element.hide(id);
	var textbox ="<div id='"+id+"_editor'><input id='"+id+"_edit' name='" +id+"' type='text' value=\""+document.getElementById(id).innerHTML+"\" size='"+size+"' class='TxtBox'/ style='height:20;'></div>";
	new Insertion.After(id, textbox);
	Field.focus(id + '_edit');
}
// Edit Textbox with Save Button
function edit_textboxandbutton(id,size,countArray,type){ 
	var values = stripslashes(document.getElementById(id).innerHTML,"\"","\'"); 
	if(values == "------" || values == "No Answer"){
		values = "";
	}
	Element.hide(id);
	var textbox ="<span id='"+id+"_editor'><input id='"+id+"_edit' name='" +id+"' type='text' value=\""+values+"\" size='"+size+"' class='smallTxtBox'/>";
	var button = "&nbsp;&nbsp;&nbsp;<input id='"+id+"_save' type='image' src='images_Business/save.gif' align='absmiddle' style='padding-right:2px'></span>";
    new Insertion.After(id, textbox+button);
	Field.focus(id + '_edit');
    Event.observe(id+'_save', 'click', function(){saveChanges(id,countArray,type)}, false);
}
// This function used to Edit generate dynamic textboxes
function edit_multitextbox(obj,size,countArray,mysp1,mysp2){ 
	obj = obj.toString();
	var mytool_array = obj.split("_");
	var myId = mytool_array[0];
	var id;	
	for(var i=0;i<countArray;i++){
		id = myId+"--"+i;
		Element.hide(id);
		var textbox ="<span id='"+id+"_editor'>";
		var value  = document.getElementById(id).innerHTML;
		value = value.replace(/<BR>/g,'');
		var temp = new Array();
		temp = value.split('-');
		textbox +="<input id='"+id+"_edit' name='"+id+"' type='text' value=\""+value+"\" size='"+size+"' class='TxtBox'/></span>";
		new Insertion.After(id, textbox);
	}
	z++;
	////New Add Text Edit here Id = 1	
	if(mysp1 != '' || mysp2 !='')
	{
		var temp = document.getElementById(mysp1).innerText;		
		if(temp != '' && temp != 'undefined')
		{
			var test = parseArrayString(temp,'Yes');
			for(var p=test.length-1;p>=0;p--)
			{
				Element.hide(mysp1);
				var textbox = "<span id='my_span--"+p+"_editor'><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input name='my_span--"+p+"_edit' id='my_span--"+p+"' type=text class=TxtBox value='"+LTrim(test[p])+"'></span><br>";
				//new Insertion.After(mysp1, textbox);
			}
		}
		
		////New Add Text Edit here Id = 2
		var temp1 = document.getElementById(mysp2).innerText;
		if(temp1 != '' && temp1 != "undefined")
		{
			var test1 = parseArrayString(temp1,'Yes');
			for(var p1=test1.length-1;p1>=0;p1--)
			{
				Element.hide(mysp2);
				var textbox1="<span id='my_span1--"+p1+"_editor'><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input name='my_span1--"+p1+"_edit' id='my_span1--"+p1+"' type=text class=TxtBox value='"+LTrim(test1[p1])+"'></span><br>";
				new Insertion.After(mysp2, textbox1);
			}
		}
	}
}



function edit_multiSelectbox(obj,size,countArray,mysp1,mysp2){
	obj = obj.toString();
	var TimeHrsOpr = new Array(
							   	new Array('','closed'),new Array('00:30','12:30  a.m.'),new Array('01:00','1:00  a.m.'),new Array('01:30','1:30  a.m.'),new Array('02:00','2:00  a.m.'),new Array('02:30','2:30  a.m.'),new Array('03:00','3:00  a.m.'),new Array('03:30','3:30  a.m.'),new Array('04:00','4:00  a.m.'),new Array('04:30','4:30  a.m.'),new Array('05:00','5:00  a.m.'),new Array('05:30','5:30  a.m.'),new Array('06:00','6:00  a.m.'),new Array('06:30','6:30  a.m.'),new Array('07:00','7:00  a.m.'),new Array('07:30','7:30  a.m.'),new Array('08:00','8:00  a.m.'),new Array('08:30','8:30  a.m.'),new Array('09:00','9:00  a.m.'),new Array('09:30','9:30  a.m.'),new Array('10:00','10:00  a.m.'),new Array('10:30','10:30  a.m.'),new Array('11:00','11:00  a.m.'),new Array('11:30','11:30  a.m.'),new Array('12:00','12:00  p.m.'),new Array('12:30','12:30  p.m.'),new Array('13:00','1:00  p.m.'),new Array('13:30','1:30  p.m.'),new Array('14:00','2:00  p.m.'),new Array('14:30','2:30  p.m.'),new Array('15:00','3:00  p.m.'),new Array('15:30','3:30  p.m.'),new Array('16:00','4:00  p.m.'),new Array('16:30','4:30  p.m.'),new Array('17:00','5:00  p.m.'),new Array('17:30','5:30  p.m.'),new Array('18:00','6:00  p.m.'),new Array('18:30','6:30  p.m.'),new Array('19:00','7:00  p.m.'),new Array('19:30','7:30  p.m.'),new Array('20:00','8:00  p.m.'),new Array('20:30','8:30  p.m.'),new Array('21:00','9:00  p.m.'),new Array('21:30','9:30  p.m.'),new Array('22:00','10:00  p.m.'),new Array('22:30','10:30  p.m.'),new Array('23:00','11:00  p.m.'),new Array('23:30','11:30  p.m.')
								);
	var Time_length = TimeHrsOpr.length;
	var optionSelected;
	var mytool_array = obj.split("_");
	var myId = mytool_array[0];
	var id;
	for(var i=0;i<countArray;i++){
		id = myId+"--"+i;
		Element.hide(id);
		var textbox ="<span id='"+id+"_editor'>";
		var value  = document.getElementById(id).innerHTML;
		value = value.replace(/<BR>/g,'');
		var temp = new Array();
		temp = value.split('-');
	//textbox +="<input id='"+id+"_edit' name='"+id+"' type='text' value=\""+value+"\" size='"+size+"' class='TxtBox'/></span>";
		textbox += "<select name='"+id+i+"0' id='"+id+i+"0' class='TxtBox'>";
		for(j=0;j<Time_length;j++){
			if(TimeHrsOpr[j][0]==temp[0])
				optionSelected = "selected";
			else optionSelected = "";
			textbox += "<option value=\""+TimeHrsOpr[j][0]+"\" "+optionSelected+">"+TimeHrsOpr[j][1]+"</option>";
		}
		textbox += "</select> to <select name='"+id+i+"1' id='"+id+i+"1' class='TxtBox'>";
		for(j=0;j<Time_length;j++){
			if(TimeHrsOpr[j][0]==temp[1])
				optionSelected = "selected";
			else optionSelected = "";
			textbox += "<option value=\""+TimeHrsOpr[j][0]+"\" "+optionSelected+">"+TimeHrsOpr[j][1]+"</option>";
		}
		textbox += "</select>";
		new Insertion.After(id, textbox);
	}
	z++;
	////New Add Text Edit here Id = 1	
	if(mysp1 != '' || mysp2 !='')
	{
		var temp = document.getElementById(mysp1).innerText;		
		if(temp != '' && temp != 'undefined')
		{
			var test = parseArrayString(temp,'Yes');
			for(var p=test.length-1;p>=0;p--)
			{
				Element.hide(mysp1);
				var textbox = "<span id='my_span--"+p+"_editor'><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input name='my_span--"+p+"_edit' id='my_span--"+p+"' type=text class=TxtBox value='"+LTrim(test[p])+"'></span><br>";
				//new Insertion.After(mysp1, textbox);
			}
		}
		
		////New Add Text Edit here Id = 2
		var temp1 = document.getElementById(mysp2).innerText;
		if(temp1 != '' && temp1 != "undefined")
		{
			var test1 = parseArrayString(temp1,'Yes');
			for(var p1=test1.length-1;p1>=0;p1--)
			{
				Element.hide(mysp2);
				var textbox1="<span id='my_span1--"+p1+"_editor'><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input name='my_span1--"+p1+"_edit' id='my_span1--"+p1+"' type=text class=TxtBox value='"+LTrim(test1[p1])+"'></span><br>";
				new Insertion.After(mysp2, textbox1);
			}
		}
	}
}
function add_box(mysp1,mysp2,obj,hiddenId)// Add New two Textboxs 
{
	if(document.getElementById(mysp1).innerHTML == '')
		var textbox = "<span id='"+mysp1+"_editor'>"+"<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+z+"_edit' class='TxtBox'></span>";
	else
		var textbox = "<span id='"+mysp1+"_editor'>"+"<br><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+z+"_edit' class='TxtBox'></span>";
	
	if(document.getElementById(mysp2).innerHTML == '')
		var textbox1 = "<span id='"+mysp2+"_editor'>"+"<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+(z+1)+"_edit' class='TxtBox'></span>";
	else
		var textbox1 = "<span id='"+mysp2+"_editor'>"+"<br><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<input type='text' name='mytext--"+(z+1)+"_edit' class='TxtBox'></span>";
	
	new Insertion.After(mysp1, textbox);
	new Insertion.After(mysp2, textbox1);
	z++;
	
	Element.hide(obj);
	//var button = "<span id='"+obj+"_editor'> <input id='"+obj+"_save' type='image' src='images_Business/save_btn.png'/>&nbsp;&nbsp;<input id='"+obj+"_cancel' type='image' src='images_Business/cancel_btn.png'/></span>";
	var button = "<span id='"+obj+"_editor'> <span id='"+obj+"_save' class='BlueLink'/>Save</span><span id='"+obj+"_cancel' class='BlueLink'/>Cancel</span></span>";
	new Insertion.After(obj, button);
	Event.observe(obj+'_save', 'click', function(){addSaveChanges(obj,hiddenId,mysp1,mysp2)}, false);
    Event.observe(obj+'_cancel', 'click', function(){addCleanUp(obj,hiddenId,mysp1,mysp2)}, false);
}


function add_texarea(mysp1,mysp2,hiddenId,obj)// Add New two Textareaboxs 
{
	if(document.getElementById(mysp1).innerHTML == '')
		var textareabox = "<span id='"+mysp1+"_editor'>"+"<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<textarea name='mytext--"+z+"_edit' rows='5' style='border:1px solid;width:94%;scrollbar-base-color:#BD0408;'></textarea></span>";
	else
		var textareabox = "<span id='"+mysp1+"_editor'>"+"<br><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<textarea name='mytext--"+z+"_edit' class='TeatAreascroll' rows='5' style='border:1px solid;width:94%;scrollbar-base-color:#BD0408;'></textarea></span>";
	
	if(document.getElementById(mysp2).innerHTML == '')
		var textareabox1 = "<span id='"+mysp2+"_editor'>"+"<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<textarea name='mytext--"+(z+1)+"_edit' class='TeatAreascroll' rows='5' style='border:1px solid;width:94%;scrollbar-base-color:#BD0408;'></textarea></span>";
	else
		var textareabox1 = "<span id='"+mysp2+"_editor'>"+"<br><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<textarea name='mytext--"+(z+1)+"_edit' class='TeatAreascroll' rows='5' style='border:1px solid;width:94%;scrollbar-base-color:#BD0408;'></textarea></span>";

	new Insertion.After(mysp1, textareabox);
	new Insertion.After(mysp2, textareabox1);
	z++;
	
	Element.hide(obj);
	var button = "<span id='"+obj+"_editor'> <input id='"+obj+"_save' type='image' src='images_Business/save_btn.png'/>&nbsp;&nbsp;<input id='"+obj+"_cancel' type='image' src='images_Business/cancel_btn.png'/></span>";
	new Insertion.After(obj, button);
	Event.observe(obj+'_save', 'click', function(){addSaveChanges(obj,hiddenId,mysp1,mysp2)}, false);
    Event.observe(obj+'_cancel', 'click', function(){addCleanUp(obj,hiddenId,mysp1,mysp2)}, false);
}
function addCleanUp(obj,hiddenId,mysp1,mysp2, keepEditable)// Add New Textbox Button Clean
{
	Element.remove(mysp1+'_editor');
	Element.remove(mysp2+'_editor');
	Element.remove(obj+'_editor');
	Element.show(mysp1);
	Element.show(mysp2);
	Element.show(obj);

	document.getElementById(hiddenId).style.visibility='visible';
	document.getElementById(hiddenId).style.display='inline';
}
function addSaveChanges(obj,hiddenId,mysp1,mysp2)//Save New Textbox Values 
{ 
	var id = obj;
	var m = (z-1);
	var new_content;
	var Values = new Array();
	var ident = new Array();
	new_content  = escape($F('mytext--'+m+'_edit'))+"||";
	new_content += escape($F('mytext--'+z+'_edit'));
	Values[0] 	= mysp1;
	Values[1] 	= mysp2;
	Values[2]	= hiddenId;
	ident[0] 	= mysp1;
	ident[1] 	= mysp2;
	
	var success = function(t){addComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}

	addCleanUp(obj,hiddenId,mysp1,mysp2, true);
    var url = varFileName;
	
    var pars = 'id=' + id + '&content=' + new_content + '&ident=' + ident;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
var flag=0;//to add <br> only once
function addComplete(t, Values)// New Textbox Values Compltete and Re-store
{	
	Values = Values.toString();
	var ValId = Values.split(",");
	var Value = t.responseText.split("||");	
	Value[0] = Value[0].replace(/\r\n/g,'')	
	if(Value[0] != "")
	{
		
		if(document.getElementById(ValId[0]).innerHTML == '')
		{
			document.getElementById(ValId[0]).innerHTML = "<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;"+stripslashes(Value[0],"\\","");
		}
		else
		{
			document.getElementById(ValId[0]).innerHTML += "<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<font style='line-height:20px'>"+stripslashes(Value[0],"\\","")+"</font>";
		}
	}
	if(Value[1] != '')
	{
		if(document.getElementById(ValId[1]).innerHTML == '')
		{
			document.getElementById(ValId[1]).innerHTML = "<img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;"+stripslashes(Value[1],"\\","");
		}
		else
		{
			document.getElementById(ValId[1]).innerHTML += "<br><img src='images_Personal/dot.gif' align='absmiddle'>&nbsp;&nbsp;<font style='line-height:20px'>"+stripslashes(Value[1],"\\","")+"</font>";
		}
	}
	
	document.getElementById('Values[2]').style.visibility='visible';
	document.getElementById('Values[2]').style.display='inline';
	showAsEditable(Values, true);
}

var flag=0;//to add <br> only once
function edit_checkbox(obj,checkboxId,Values)// Edit Dynamic Checkboxes
{
	var checkValue = new Array();
	var id;
	for(var i=0;i<Values.length;i++)
	{
		id = checkboxId+"--"+i;
		if(document.getElementById(id).innerHTML != '')
			checkValue[i] = "checked";
		else
			checkValue[i] = "";
		Element.hide(id);		
		if(flag == 0)
			var checkbox = "<span id='"+id+"_editor'><input type='checkbox' id='"+id+"_edit' name='"+id+"' value='"+Values[i]+"' "+checkValue[i]+">&nbsp;&nbsp;"+Values[i]+"&nbsp;</span><br>";
		else
			var checkbox = "<span id='"+id+"_editor'><input type='checkbox' id='"+id+"_edit' name='"+id+"' value='"+Values[i]+"' "+checkValue[i]+">&nbsp;&nbsp;"+Values[i]+"&nbsp;</span>";
		new Insertion.After(id, checkbox);
		
	}
	flag = 1;
}

var flag=0;//to add <br> only once
function edit_checkbox_Business(obj,checkboxId,Values)// Edit Dynamic Checkboxes
{
	var checkValue = new Array();
	var id;
	var Paymentevent;
	for(var i=0;i<Values.length;i++)
	{
		id = checkboxId+"--"+i;
		if(document.getElementById(checkboxId+"--0").innerHTML != ''){
			var disableIds=' disabled ';
		}
		else var disableIds='';
		if(document.getElementById(id).innerHTML != '')
			checkValue[i] = "checked";
		else
			checkValue[i] = "";
		Element.hide(id);		
		if(flag == 0){
			if(i == 0){
				disableIds = "";
				Paymentevent = " onclick=\"PaymentsEvent('"+checkboxId+"')\" ";
			}
			var checkbox = "<span id='"+id+"_editor'><input type='checkbox' id='"+id+"_edit' name='"+id+"' value='"+Values[i]+"' "+checkValue[i]+""+disableIds+Paymentevent+">&nbsp;&nbsp;"+Values[i]+"&nbsp;</span><br>";
		}
		else{
			if(i == 0){
				disableIds = "";
				Paymentevent = " onclick=\"PaymentsEvent('"+checkboxId+"')\" ";
			}
			var checkbox = "<span id='"+id+"_editor'><input type='checkbox' id='"+id+"_edit' name='"+id+"' value='"+Values[i]+"' "+checkValue[i]+""+disableIds+Paymentevent+">&nbsp;&nbsp;"+Values[i]+"&nbsp;</span>";
		}
		new Insertion.After(id, checkbox);
	}
	flag = 1;
}

function PaymentsEvent(idValue){
	var checkBoxAction = document.getElementById(idValue+"--0_edit").checked;
	for(var i=1;i<7;i++){
		if(checkBoxAction == true){
			document.getElementById(idValue+"--"+i+"_edit").checked = false
			document.getElementById(idValue+"--"+i+"_edit").disabled = true
		}else{
			document.getElementById(idValue+"--"+i+"_edit").disabled = false
		}
	}
}

function edit_radiobuttons(obj,radiobuttonId,Values)// Edit Dynamic Checkboxes
{
	var checkValue = new Array();
	var id;
	var radiobutton = "";
	for(var i=0;i<Values.length;i++)
	{
		id = radiobuttonId+"--"+i;
		if(document.getElementById(id).innerHTML != '')
			checkValue[i] = "checked";
		else
			checkValue[i] = "";
		
		
		Element.hide(id);
		radiobutton += "<span id='"+id+"_editor'><input type='radio' id='"+id+"_edit' name='"+id+"' value='"+Values[i]+"' "+checkValue[i]+">"+Values[i]+"</span>";
		
		}
	var savebutton = "&nbsp;&nbsp;<input id='"+id+"_save' type='image' src='images_Business/save.gif' align='absmiddle'></span>";
	new Insertion.After(id, radiobutton+savebutton);	
}

function edit_button(obj,countArray,type,mysp1,mysp2)//Edit Add and Cancel button
{
	Element.hide(obj);
	var button = "<span id='"+obj+"_editor'><span id='"+obj+"_save' class='BlueLink'/>Save</span><span id='"+obj+"_cancel' class='BlueLink'>Cancel</span></span>";
	new Insertion.After(obj, button);
	if(obj != "hoursOfOperation_Button"){
		Event.observe(obj+'_save', 'click', function(){saveChanges(obj,countArray,type,mysp1,mysp2)}, false);
    	Event.observe(obj+'_cancel', 'click', function(){cleanUp(obj,countArray,type,mysp1,mysp2)}, false);
	}else{
		Event.observe(obj+'_save', 'click', function(){saveChanges_hours(obj,countArray,type,mysp1,mysp2,"MessageBoxajax.php")}, false);
    	Event.observe(obj+'_cancel', 'click', function(){cleanUp_hours(obj,countArray,type,mysp1,mysp2,"MessageBoxajax.php")}, false);
	}
}
function cleanUp(obj,countArray,type,mysp1,mysp2, keepEditable)// Cleanup  div or span id
{
	obj = obj.toString();
	var my = obj.split("_");
	var id = my[0];
	if(obj == "myInterests_Button" || obj == "myHeadLine_Button")//For Mouse Over Effect in adim personal page
	{
			if(document.getElementById("MyInterestTempTd")  )
				document.getElementById("MyInterestTempTd").style.display = "none";
	}
	if(type == "multiple")
	{
		for(var i=0;i<countArray;i++)
		{
			id = my[0]+"--"+i;
			Element.remove(id+'_editor');
    		Element.show(obj);
			Element.show(id);
		}
		if(mysp1 != '' || mysp2 != '')
		{
			////Remove  Add Textbox ///////
			var temp = document.getElementById(mysp1).innerText;
			if(temp != '')
			{
				var tempArray = parseArrayString(temp,'No');
				for(var c=tempArray.length-1;c>=0;c--)
				{
					Element.remove('my_span--'+c+'_editor');
					Element.show(mysp1);
				}
			}
			////Remove  Add Textbox///////
			var temp1 = document.getElementById(mysp2).innerText;
			if(temp1 != '')
			{
				var tempArray1 = parseArrayString(temp1,'No');
				for(var d=tempArray1.length-1;d>=0;d--)
				{
					Element.remove('my_span1--'+d+'_editor');
					Element.show(mysp2);
				}
			}
		}
		Element.remove(obj+'_editor');
	}
	else if(type == "one" || type == "Two")
	{
		Element.remove(obj+'_editor');
		Element.show(obj);
	}
	else
	{
		Element.remove(id+'_editor');
		Element.remove(obj+'_editor');
		Element.show(obj);
		Element.show(id);
	}
	
	if(type == "multiple" && (mysp1 != "" || mysp2 != ""))
	{
		document.getElementById(my[0]+'Add_Button').style.visibility='visible';
		document.getElementById(my[0]+'Add_Button').style.display='inline';
	}
}
function saveChanges(obj,countArray,type,mysp1,mysp2)// Save Edit Textbox Values
{
	obj = obj.toString();
	var mytool_array = obj.split("_");
	var id = mytool_array[0];
	var new_addcontent = "";
	var new_addcontent1 = "";
	var Values = new Array();	
	if(obj == "myBandWebsite_Button")
	{
		URL = document.getElementById("myBandWebsite_edit").value;
		if(!IsValidURL(URL,"Website"))
			return false;
		
	}
	if(obj == "myInterests_Button")
	{
			if(document.getElementById("MyInterestTempTd"))
				document.getElementById("MyInterestTempTd").style.display = "none";
	}
	if(type == "multiple")
	{
		var new_content = "";
		var ident = new Array();
		for(var i=0;i<countArray;i++)
		{
			id = mytool_array[0]+"--"+i;
			if(mytool_array[0] != "hoursOfOperation")
				new_content += escape($F(id+'_edit'))+"||";
			else new_content += document.getElementById(mytool_array[0]+"--"+i+i+"0").value+"-"+document.getElementById(mytool_array[0]+"--"+i+i+"1").value+"||";
			ident[i] = id;
			Values[i] = id;
			id.innerHTML = "Saving...";
		}
		
		
		var success = function(t){editCompleteArray(t, Values);}
		var failure = function(t){editFailed(t, Values);}
		
		if(mysp1 != '' || mysp2 != '')
		{
				
			////Remove  Add Textbox///////
			var temp = document.getElementById(mysp1).innerText;
			var countVal = Values.length;
			if(temp != '')
			{
				var tempArray = parseArrayString(temp,'No');
				for(var c=tempArray.length-1;c>=0;c--)
				{
					new_addcontent += escape($F('my_span--'+c+'_edit'))+"||";
					Values[countVal+c] = "my_span--"+c;
				}
				
				var success = function(t){editCompleteArray(t, Values);}
				var failure = function(t){editFailed(t, Values);}
			}
			countVal = Values.length;
			////Remove  Add Textbox///////
			var temp1 = document.getElementById(mysp2).innerText;
			if(temp1 != '')
			{
				var tempArray1 = parseArrayString(temp1,'No');
				
				for(var d=tempArray1.length-1;d>=0;d--)
				{
					new_addcontent1 += escape($F('my_span1--'+d+'_edit'))+"||";
					Values[countVal+d] = "my_span1--"+d;
				}
				var success = function(t){editCompleteArray(t, Values);}
				var failure = function(t){editFailed(t, Values);}
			}
		}
	}
	else
	{
		var ident = "";
		var new_content = escape($F(id+'_edit'));
		id.innerHTML = "Saving...";
		var Values = id;
		var success = function(t){editComplete(t, Values);}
		var failure = function(t){editFailed(t, Values);}
	}
	
	cleanUp(obj,countArray,type,mysp1,mysp2, true);

    var url = varFileName;
    var pars = 'id=' + id + '&content=' + new_content + '&ident=' + ident + '&new_addcontent=' + new_addcontent + '&new_addcontent1=' + new_addcontent1;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

/*	Save Changes in Hours of Opearation	starts here */

function editradiobutton(Value){
	var radioButton = "";
	var radioValues = new Array(
								new Array('','Do Not Display Hours'),
								new Array('24_HOURS','24 hours a day'),
								new Array('HrsOfDays','Use hours of operation below:')
								);
	for(var i=0;i<3;i++){
		//radioButton += "<input type='radio' value='"+radioValues[i][0]+"'> "+radioValues[i][1];
		var j=i+1;
		if(Value == radioValues[i][0])
			radioButton = "<input type='radio' name='Hours' id='Hours"+j+"' value='"+radioValues[i][0]+"' checked> "+radioValues[i][1];
		else radioButton = "<input type='radio' name='Hours' id='Hours"+j+"' value='"+radioValues[i][0]+"'> "+radioValues[i][1];
		
		document.getElementById("hoursradio--"+i).innerHTML = radioButton;
	}
}


/*function saveChanges_hours(obj,countArray,type,mysp1,mysp2)// Save Edit Textbox Values
{
	obj = obj.toString();
	var mytool_array = obj.split("_");
	var id = mytool_array[0];
	var new_addcontent = "";
	var new_addcontent1 = "";
	var Values = new Array();	
	if(obj == "myBandWebsite_Button")
	{
		URL = document.getElementById("myBandWebsite_edit").value;
		if(!IsValidURL(URL,"Website"))
			return false;
		
	}
	if(obj == "myInterests_Button")
	{
			if(document.getElementById("MyInterestTempTd"))
				document.getElementById("MyInterestTempTd").style.display = "none";
	}
	if(type == "multiple")
	{
		for(i=1;i<4;i++){
			if(document.getElementById("Hours"+i).checked == true){
				var HrsOpr = document.getElementById("Hours"+i).value;
				document.getElementById("Hours"+i).checked = true;
			}
		}
		var new_content = "";
		var ident = new Array();
		for(var i=0;i<countArray;i++)
		{
			id = mytool_array[0]+"--"+i;
			if(mytool_array[0] != "hoursOfOperation")
				new_content += escape($F(id+'_edit'))+"||";
			else new_content += document.getElementById(mytool_array[0]+"--"+i+i+"0").value+"-"+document.getElementById(mytool_array[0]+"--"+i+i+"1").value+"||";
			ident[i] = id;
			Values[i] = id;
			id.innerHTML = "Saving...";
		}
		
		
		var success = function(t){editCompleteArray(t, Values);}
		var failure = function(t){editFailed(t, Values);}
		
		if(mysp1 != '' || mysp2 != '')
		{
				
			////Remove  Add Textbox///////
			var temp = document.getElementById(mysp1).innerText;
			var countVal = Values.length;
			if(temp != '')
			{
				var tempArray = parseArrayString(temp,'No');
				for(var c=tempArray.length-1;c>=0;c--)
				{
					new_addcontent += escape($F('my_span--'+c+'_edit'))+"||";
					Values[countVal+c] = "my_span--"+c;
				}
				
				var success = function(t){editCompleteArray(t, Values);}
				var failure = function(t){editFailed(t, Values);}
			}
			countVal = Values.length;
			////Remove  Add Textbox///////
			var temp1 = document.getElementById(mysp2).innerText;
			if(temp1 != '')
			{
				var tempArray1 = parseArrayString(temp1,'No');
				
				for(var d=tempArray1.length-1;d>=0;d--)
				{
					new_addcontent1 += escape($F('my_span1--'+d+'_edit'))+"||";
					Values[countVal+d] = "my_span1--"+d;
				}
				var success = function(t){editCompleteArray(t, Values);}
				var failure = function(t){editFailed(t, Values);}
			}
		}
	}
	else
	{
		var ident = "";
		var new_content = escape($F(id+'_edit'));
		id.innerHTML = "Saving...";
		var Values = id;
		var success = function(t){editComplete(t, Values);}
		var failure = function(t){editFailed(t, Values);}
	}
	
	cleanUp(obj,countArray,type,mysp1,mysp2, true);

    var url = varFileName;
    var pars = 'id=' + id + '&content=' + new_content + '&ident=' + ident + '&new_addcontent=' + new_addcontent + '&new_addcontent1=' + new_addcontent1;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}*/

/*	Save Changes in Hours of Opearation ends here	*/

function editComplete(t, Values)// Edit Complete Single Textbox or Textarea Values
{	
	Values = Values.toString();
	var temp = stripslashes(t.responseText,"\\","");	
	var temp1;
	if(Values != 'myInterests')
 	{
		temp1 = temp.replace(/\n/g, '<br>');
		temp1 = temp.replace(/<BR>/g,'');
	}
	else
		temp1 = temp;
	var NullValues = Values.split("-");
	//if(temp1 != '')	
	if(Values != 'myInterests' ||  Values != 'companyDiscription')
		document.getElementById(Values).innerText = temp1; // By Riyaz To show without any changes in alignment on 25-09-2006
	else
		document.getElementById(Values).innerHTML = temp1
	// NB for to display ------ // 
	if(temp == '' && NullValues[1] == "NB")  {
		document.getElementById(Values).innerHTML = "------";
	}
	
	if(document.getElementById(Values+'_spEditValue').innerHTML)
		document.getElementById(Values+'_spEditValue').innerHTML = temp1;

	showAsEditable(Values, true);
}
function editCompleteArray(t,Values)// Edit Complte
{
	Values = Values.toString();
	var Val = new Array();
	var ValId = new Array();
	Val = t.responseText.split("||");
	ValId = Values.split(",");
	for(var m=0;m<ValId.length;m++)
	{
		//alert("***"+Val[m]+"***")
		Val[m]= Trim(Val[m].replace(/\r\n/g,''));		
		if(Val[m] != "undefined" && Val[m] != '')
		{
			document.getElementById(ValId[m]).innerText = stripslashes(Val[m],"\\","");	
		}
		else
		{
			document.getElementById(ValId[m]).innerText = "";	
		}
	}
	var getElementId = ValId[0].split("--");
	if(getElementId != '')
	{
		document.getElementById(getElementId[0]+'Add_Button').style.visibility='visible';
		document.getElementById(getElementId[0]+'Add_Button').style.display='inline';
	}
    showAsEditable(Values, true);
}
function edit_dropdownonly(id)
{
	var currentValue = document.getElementById(id).innerText;
	var selectedValue;
	Element.hide(id);
	var selectedId = getValues(id);
	var selectoption = "<span id='"+id+"_editor'><select id='"+id+"_edit' class='SelectTxtBox'>";
//	selectedId.length
	for(i=0;i<selectedId.length;i++)
	{
		if(selectedId[i]==currentValue)
		{
			selectedValue="selected";
		}
		else
		{
			selectedValue="";
		}
		selectoption += "<option value='"+selectedId[i]+"' "+selectedValue+">"+selectedId[i]+"</option>";
	}
	selectoption += "</select>";
	new Insertion.After(id, selectoption);
}
function edit_dropdownbox(id,currentValues,width)
{
	currentValues = document.getElementById(id).innerHTML;
	var selectValue;
	Element.hide(id);
	var selectedId = getValues(id);
	var selectoption = "<span id='"+id+"_editor'><select id='"+id+"_edit' class='SelectTxtBox' style='width:"+width+"'>";
	if(id != 'Gender')
		selectoption += "<option value=''>No Answer</option>";
	for(var i=0;i<selectedId.length;i++)
	{
		if(selectedId[i] == currentValues)
			selectValue = "selected";
		else
			selectValue = "";
			selectoption += '<option value=\"'+selectedId[i]+'\" '+selectValue+'>'+selectedId[i]+'</option>';
	}
	selectoption += "</select>";
	var savebutton = "&nbsp;&nbsp;<input id='"+id+"_save' type='image' src='images_Business/save.gif' align='absmiddle'></span>";
	new Insertion.After(id, selectoption+savebutton);
	Event.observe(id+'_save', 'click', function(){savedropdown(id)}, false);
}
function edit_dropdownboxDOB(id,currentValues,width)
{
	var selectValue;
	Element.hide(id);
	MonArray = new Array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	var DataArray = currentValues.split('-');
	selectoption ="";
	id1= "Date"
	var selectoption = "<span id='"+id+"_editor'><span id='"+id1+"'><select id='"+id1+"_edit' class='SelectTxtBox' style='width:35px'>";	
	selectoption += '<option value=\"\">--</option>';
	for(var i=1;i<=31;i++)
	{
		if(i<10)
			date = "0"+i;
		else
			date = i;
		if(i == DataArray[2])
			selectValue = "selected";
		else
			selectValue = "";
		selectoption += '<option value=\"'+date+'\" '+selectValue+'>'+date+'</option>';
	}
	selectoption += "</select></span>";
	id2 = "Month";
	var selectoptionMonth = "<span id='"+id2+"'><select id='"+id2+"_edit' class='SelectTxtBox' style='width:35px'>";
		selectoptionMonth += '<option value=\"\">--</option>';
	for(var i=1; i<=12;i++)
	{
		if(i<10)
			month = "0"+i;
		else
			month = i;
		if(i == DataArray[1])
			selectValue = "selected";
		else
			selectValue = "";
		selectoptionMonth += '<option value=\"'+month+'\" '+selectValue+'>'+month+'</option>';
	}
	selectoptionMonth += "</select></span>";
	id3="Year";
	var dt 	  = new Date();
	var year  = dt.getYear();
	var selectoptionYear = "<span id='"+id3+"'><select id='"+id3+"_edit' class='SelectTxtBox' style='width:55px'>";
	selectoptionYear += '<option value="">--</option>';	
	for(var i=1900;i<=year;i++)
	{
		if(i == DataArray[0])
			selectValue = "selected";
		else
			selectValue = "";
		selectoptionYear += '<option value=\"'+i+'\" '+selectValue+'>'+i+'</option>';
	}
	selectoptionYear += "</select></span>";
	//alert(selectoptionYear);
	selectoption = selectoption+" "+selectoptionMonth+" "+selectoptionYear
	var savebutton = "&nbsp;&nbsp;<input id='"+id+"_save' type='image' src='images_Business/save.gif' align='absmiddle'></span>";
	new Insertion.After(id, selectoption + savebutton);
	Event.observe(id+'_save', 'click', function(){SaveDob(id)}, false);
}
function savedropdownDOB(spanid,values,Year,Month,Day,filename)
{
	var Values = spanid;
	var success = function(t){savedropdownDOBComplete(t,Values,Year,Month,Day);}
	var failure = function(t){editFailed(t, Values);}
	cleardropdown(spanid, true);
	var url = filename; 
    var pars = 'checkText=' + spanid + '&values=' + values; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});	
	
}
function savedropdownDOBComplete(t,Values,Year,Month,Day)
{
	Values = Values.toString();	
	var strValue = t.responseText.split('||');
	if(Day != ""){
		Mydate = new Date(Year,Month,Day)
		MonArray = new Array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		Year = Mydate.getFullYear()
		Month = Mydate.getMonth()
		Day = Mydate.getDate()	
		var dob = MonArray[Month]+" "+Day+", "+Year;		
		document.getElementById(Values).innerHTML = dob;
	}
	else
		document.getElementById(Values).innerHTML = "No Answer";
}
function savedropdown(id)
{
	
	var ident = "";
	var new_content = escape($F(id+'_edit'));
	innerHTML = "Saving...";
	var Values = id;		
	var success = function(t){savedropdownComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}	
	cleardropdown(id, true);	
    var url = varFileName;
    var pars = 'id=' + id + '&content=' + new_content;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

// This below function used for To Create Multiple Drop Down Boxex //
/*
function edit_multidropdownbox(id,currentValues,width)
{
	currentValues = document.getElementById(id).innerHTML;
	var selectValue;
	Element.hide(id);
	var ids = id.split("_");
	
	var selectoption="";
	var selectedId;
	for(var j = 0; j < ids.length; j++) {
		selectedId = getValues(ids[j]);
		selectoption += "<span id='"+ids[j]+"_editor'><select id='"+ids[j]+"_edit' class='SelectTxtBox' style='width:"+width+"'>";
		for(var i=0;i<selectedId.length;i++)
		{
			if(selectedId[i] == currentValues)
				selectValue = "selected";
			else
				selectValue = "";
			selectoption += "<option value='"+selectedId[i]+"' "+selectValue+">"+selectedId[i]+"</option>";
		}
		selectoption += "&nbsp;&nbsp;</select>";
	}
	var ids = selectoption.split("&nbsp;&nbsp;");
	var savebutton = "&nbsp;&nbsp;<input id='"+id+"_save' type='image' src='images_Business/save.gif' align='absmiddle'></span>";
	new Insertion.After(id, selectoption+savebutton);
	Event.observe(id+'_save', 'click', function(){savemultidropdown(id)}, false);
}
*/

function cleardropdown(id, keepEditable)
{
	Element.remove(id+'_editor');
	Element.show(id);
}
function savedropdownComplete(t, Values)
{		
	Values = Values.toString();
	var strValue = t.responseText.split('||');
	//document.getElementById(Values).innerHTML = stripslashes(t.responseText,"\\",""); // Previously used //
	document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
	if(t.responseText == "")  {
		//document.getElementById(Values).innerHTML = "------";
		document.getElementById(Values).innerHTML = "No Answer";
	}

	if(strValue[2] == 'main') {
		document.getElementById("spMainDiaplay").innerHTML = stripslashes(strValue[1],"\\","");
	}
	
	showAsEditable(Values, true);
}
function showAsEditable(obj, clear)//shows stylesheet effect 
{
    if (!clear){Element.addClassName(obj, 'editable');}
	else{Element.removeClassName(obj, 'editable');}
}


function requestdone() {
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			result = http_request.responseText;
			document.getElementById('myspan').innerHTML = result;            
		} else {
			alert('There was a problem with the request.');
		}
		document.getElementById('ajaxbutton').disabled = false;
	}
}

function setSubCatValue(strvalue)
{
	ClassifiedVar = strvalue
}
function setCatTypeValue(strvalue)
{
	ClassifiedVar1 = strvalue
}
function setCarModelValue(strvalue)
{
	CalssifiedCarModelVar = strvalue
}
function setDropDownEnabled(MemberID)
{
	document.getElementById('selCategory').disabled = false;
	/*if(document.getElementById('selAdType').value == 'Sponsored')
	{
		var value= "Payment";
		var success = function(t){setDropDownEnabledComplete(t, value);}
		var failure = function(t){editFailed(t, Values);}
		var url = 'classifiedajax.php';
		var checkText = 'PayementDetails';
		var pars = 'checkText=' + checkText + '&MemberID=' + MemberID;  //alert(pars);
		var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
	}
	else{
		document.getElementById("Payment").innerHTML = "";
		document.getElementById('selCategory').disabled = false;
	}*/
}
function setDropDownEnabledComplete(t, value)
{
	strValue = t.responseText.split('||'); 
	document.getElementById(value).innerHTML = stripslashes(strValue[0],"\\","");
	if(strValue[1] != 'free')
		document.getElementById('selCategory').disabled = false;
	else
		document.getElementById('selCategory').disabled = true;
}
function setDropDownValues(value,objList,setValues,filename,Type)
{ 
	  var varoption = "Loading subcategories...";
	  if(Type == "SubCat")
	  {
		  document.getElementById('selSubCatetoryOp1').innerHTML = varoption;
		  document.getElementById('selSubCatetory').disabled = true;
	  }
	  else{
		 if(document.getElementById('selSubCategoryOp')) document.getElementById('selSubCategoryOp').innerHTML = varoption;	
		 if(document.getElementById('selListTypeOp')) document.getElementById('selListTypeOp').innerHTML = varoption;
		 if(document.getElementById('selSubCategory'))  document.getElementById('selSubCategory').disabled = true;	
		 if(document.getElementById('selListType'))  document.getElementById('selListType').disabled = true;
	  }
	   
 	var success = function(t){SavelabelDropDownValues(t, objList,value,setValues,Type);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
	var pars = 'value=' + value + '&setValues=' + setValues + '&objIdent=' + objList;  //alert(pars);
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
	
}
function trimString(sInString) {
  sInString = sInString.replace( /^\s+/g, "" );
  return sInString.replace( /\s+$/g, "" );
}
/*
function SavelabelDropDownValues(t,objList,value,setValues)
{
	//alert(t.responseText);
	var varoption ="";
	varoption +="<select>";
	objList.length = 1;		
	var appointmentProperties = new Array();
	var itemsToBeCreated = new Array();
	var items = t.responseText.split(/<item>/g); 
	for(var no=1;no<items.length;no++){ //alert(no)
		var lines = items[no].split(/\n/g); 
		itemsToBeCreated[no] = new Array();//alert(lines.length)
		for(var no2=0;no2<lines.length;no2++){ 
			var key = lines[no2].replace(/<([^>]+)>.*/
			/*								 g,'$1');
			if(key)key = trimString(key);
			var pattern = new RegExp("<\/?" + key + ">","g");
			var value = lines[no2].replace(pattern,'');
			value = trimString(value);
			itemsToBeCreated[no][key] = value; 
		}
		varoption += "<option value='"+itemsToBeCreated[no]['Value']+"'>"+itemsToBeCreated[no]['Text']+"</option>";
		
	}
	varoption += "</select>";
	document.getElementById('selSubCategory1').innerHTML = varoption;
}
*/
function SavelabelDropDownValues(t,objList,value,setValues,Type)
{


if(Type == "SubCat")
{	//alert(t.responseText);
 if(document.getElementById('selSubCatetoryOp1'))  document.getElementById('selSubCatetoryOp1').innerHTML = "Select a Sub Category";
	if( (t.responseText !='' && t.responseText != 'undefined') && (t.responseText != '' && t.responseText != '#') ) {
		var strReturnText = t.responseText.split('||'); 	
		objList.length = 1;		
			for(i=0;i<strReturnText.length;i++)
			{
				var strTextSplit  = strReturnText[i].split("#");
				objList.length++;
				objList[i+1].value = strTextSplit[0];
				objList[i+1].text  = strTextSplit[1];
				if(setValues == "setSubCategory") { 
					if(objList[i+1].value == AnnouncementVar)
						objList[i+1].selected = true;
				}
			}
			 if(document.getElementById('selSubCatetory'))  document.getElementById('selSubCatetory').disabled = false;
		}
		else {
		 if(document.getElementById('selSubCatetory'))  document.getElementById('selSubCatetory').disabled = true;
		 document.getElementById('selSubCatetoryOp1').innerHTML = "--------------------------";
		}
}
else{	
	 if(document.getElementById('selSubCategoryOp'))document.getElementById('selSubCategoryOp').innerHTML = "Choose your Sub Category.....";	
	 if(document.getElementById('selListTypeOp'))document.getElementById('selListTypeOp').innerHTML = "Choose your Sub Category.....";
	if( (t.responseText !='' && t.responseText != 'undefined') && (t.responseText != '' && t.responseText != '#') ) {
		var strReturnText = t.responseText.split('||'); 
		objList.length = 1;		
		for(i=0;i<strReturnText.length;i++)
		{
			var strTextSplit  = strReturnText[i].split("#");
			objList.length++;
			objList[i+1].value = strTextSplit[0];
			objList[i+1].text  = strTextSplit[1];
			if(setValues == "setSubCategory") {
				if(objList[i+1].value == ClassifiedVar)
					objList[i+1].selected = true;
			}
			if(setValues == "setTypeListing") {
				if(objList[i+1].value == ClassifiedVar1)
					objList[i+1].selected = true;
			}
			if(setValues == "setCarModels") {
				if(objList[i+1].value == CalssifiedCarModelVar)
					objList[i+1].selected = true;
			}
		}
	}
	if(document.getElementById('selSubCategory'))document.getElementById('selSubCategory').disabled = false;	
 	if(document.getElementById('selListType'))document.getElementById('selListType').disabled = false;	
 }
}

function getProfileImage(spanid,obj,filename)
{
	var success = function(t){SavelabelDropDownValues(t, objList);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
	var pars = '&objIdent=' + obj;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function DeletePersoanlImage(spanId,ImageName,displayid,filename)
{
	var Values;
	Values = displayid;
	var success = function(t){PersoanlImageComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + ImageName + '&objIdent=' + spanId; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function PersoanlImageComplete(t, Values)
{
	var strValue = t.responseText.split('||');  
	Values = Values.toString();
	document.getElementById("PersonalPhoto").innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById(Values).innerHTML = stripslashes(strValue[1],"\\","");
	showAsEditable(Values, true);
}
function editFailed(t, Values)
{
}
function RowCheckbox(objId) // This function used for select checkbox when clicking the text // 
{
	if(document.getElementById(objId).checked)
	{
		document.getElementById(objId).checked=false;
	}
	else
	{
		document.getElementById(objId).checked=true;
	}
}
function OverLayCloseImgOver()
{
	document.getElementById("CloseImg").src = "images/close-red.gif";
}
function OverLayCloseImgOut()
{
	document.getElementById("CloseImg").src = "images/close-green.gif";
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
function PeopleContactMeOverLayForm(obj,Ident,DisplayIdent,ProfileName,FileName,XPOS,YPOS)
{
	var Values = DisplayIdent;
	var success = function(t){PeopleContactMeOverLayFormComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ProfileName='+ProfileName;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function PeopleContactMeOverLayFormComplete(t,Obj,Values,XPOS,YPOS)
{	
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	return peoplecontactmeoverlay(Obj,Values,'',XPOS,YPOS);
}
function ShowAddGuestBookOverLayForm(obj,Ident,DisplayIdent,ProfileName,FileName,XPOS,YPOS)
{
	var Values = DisplayIdent;
	var success = function(t){ShowAddGuestBookOverLayFormComplete(t,obj,Values,XPOS,YPOS);}
	var failure = function(t){editFailed(t);}
	var url = FileName;
    var pars = 'setValues='+Ident+'&ProfileName='+ProfileName;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function ShowAddGuestBookOverLayFormComplete(t,Obj,Values,XPOS,YPOS)
{	
	//alert(t.responseText) 
	var strValue = t.responseText; 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = strValue;
	return gusetbookoverlay(Obj,Values,'',XPOS,YPOS);
}
function SendSMSValidation()
{
	objForm = document.frmSendToPhone;
	if(!IsNumber(objForm.Phone1.value,"Phone Number"))
	{
		objForm.Phone1.focus();
		return false;
	}
	if(!IsNumber(objForm.Phone2.value,"Phone Number"))
	{
		objForm.Phone2.focus();
		return false;
	}
	if(!IsNumber(objForm.Phone3.value,"Phone Number"))
	{
		objForm.Phone3.focus();
		return false;
	}
	if(!IsValid(objForm.Provider.value,"Wireless Carrier"))
	{
		objForm.Provider.focus();
		return false;
	}
	SendToPhone(5,'SendToPhone',AjaxFileName);
}

function SendToPhone(countArray,SpanID,FileName)
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
	
	document.getElementById("showSendToPhone").innerHTML = stripslashes(t.responseText,"\\","");
}

function ReviewHelp(setValues,HelpValue,Ident,spanId,FileName)
{
	var success = function(t){ReviewHelpComplete(t, HelpValue,spanId,Ident);}
	var failure = function(t){editFailed(t, HelpValue);}
	var url = FileName;
    var pars = '&HelpValue=' + HelpValue + '&setValues=' + setValues + '&Ident=' + Ident;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}

function ReviewHelpComplete(t,Values,spanId,Ident)
{	
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	if(strValue[2] == "Yes") {
		document.getElementById("Votes"+Ident).innerHTML = stripslashes(strValue[0],"\\","");
	}
	document.getElementById(spanId).innerHTML = stripslashes(strValue[1],"\\","");
}

function LoadPersonalPage(spanid,Op,Id,FileName)
{
	var success = function(t){LoadPersonalPageComplete(t,spanid,Op);}
	var failure = function(t){editFailed(t);}
	var url 	= FileName;
    var pars 	=  'setValues=' + Op + '&Id=' +Id;
    var myAjax 	= new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function LoadPersonalPageComplete(t,spanId,Op)
{	//alert(t.responseText);
	var strValue = t.responseText.split('||'); 	
	document.getElementById(spanId).innerHTML 			= stripslashes(strValue[0],"\\","");
	if(Op!="MyArtistProfile")
		document.getElementById("loadFlash").style.display = "none";
	if(Op=="MyArtistProfile")
		document.getElementById("loadFlash").style.display = "inline";
}
function ShowUserBlogPage(spanid,Op,Id,BlogId,CatName,FileName)
{
	var success = function(t){ShowUserBlogPageComplete(t,spanid);}
	var failure = function(t){editFailed(t);}
	var url 	= FileName;
    var pars 	=  'setValues=' + Op + '&Id=' +Id + '&BlogId=' +BlogId + '&CatName=' +CatName;
    var myAjax 	= new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function ShowUserBlogPageComplete(t,spanId)
{	
	var strValue = t.responseText.split('||');
	document.getElementById(spanId).innerHTML 			= stripslashes(strValue[0],"\\","");
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
//////////////////////////////////////////////////////////////////////////////////////////////////// 
//JavaScript Document