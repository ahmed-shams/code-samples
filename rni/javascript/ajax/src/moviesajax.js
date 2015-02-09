// JavaScript Document
var Moivesloadstatustext="<img src='images/loading_2.gif'/>"
function Moviesave_Details(id,countArray,displayid,filename) //this function  used to save the datails in Db Like coupon page,profile page etc...
{  
	document.getElementById("Loading").innerHTML=Moivesloadstatustext;
	var spanId;
	var txtValue="";
	var txtValues;
	var tvalues;
	var myfile;

	if(id=="InviteNonMembersList" || id=="InviteMembersList" || id=="RemindMembersList" || id=="RemindNonMembersList" || id=="InviteFriendsStep1" || id=="InviteFriendsStep2")
	{
		for(i=0;i<countArray;i++)
		{
			spanId=id+"--"+i;
			if(document.getElementById(spanId).checked==true)
			{
				txtValues = spanId;
				tvalues = document.getElementById(spanId).value;
				txtValue += tvalues+"||";
			}
		}
	}
	else
	{
		if(countArray>0)
		{
			
			for(i=0;i<countArray;i++)
			{
				
				spanId=id+"--"+i;				
				txtValues=spanId;
				tvalues = document.getElementById(spanId).value;
				tvalues=tvalues.replace('&','__');
				txtValue+=tvalues+"||";
			}
		}
		else
		{
			txtValues = id;
			txtValue = id;
		}
	}
	var Values = displayid;
	var success = function(t){MoivesSavelabelComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'checkText=' + txtValue + '&objIdent=' + txtValues + '&Id=' + id;   
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
	
}
function Moviessave_Detailsreview(id,countArray,displayid,filename,insert) //this function  used to save the datails in Db Like coupon page,profile page etc...
{  
	var spanId;
	var txtValue="";
	var txtValues;
	var tvalues;
	var myfile;
	document.getElementById("Loading").innerHTML=Moivesloadstatustext;
	if(id=="InviteNonMembersList" || id=="InviteMembersList" || id=="RemindMembersList" || id=="RemindNonMembersList")
	{
		for(i=0;i<countArray;i++)
		{
			spanId=id+"--"+i;
			if(document.getElementById(spanId).checked==true)
			{
				txtValues = spanId;
				tvalues = document.getElementById(spanId).value;
				txtValue += tvalues+"||";
			}
		}
	}
	else
	{
		if(countArray>0)
		{
			for(i=0;i<countArray;i++)
			{
				spanId=id+"--"+i;
				txtValues=spanId;
				tvalues = document.getElementById(spanId).value;
				tvalues=tvalues.replace('&','__');
				txtValue+=tvalues+"||";
			}
		}
		else
		{
			txtValues = id;
			txtValue = id;
		}
	}
	
	var Values = displayid;
	var success = function(t){MoivesSavelabelComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'checkText=' + txtValue + '&objIdent=' + txtValues + '&Id=' + id + '&strVal=' + insert;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
	
}


function MoivesSavelabelComplete(t,Values)
{	

	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
	document.getElementById("Loading").innerHTML="";
	if(Values=="DeleteFriends")
	{	
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("spMainDiaplay").innerHTML = stripslashes(strValue[1],"\\","");
	}
	else if(Values=="PersonalSumMenu")
	{
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[1],"\\","");
	}
	else if(strValue[2] == "index")
	{
		document.getElementById('Zipcodedropinboxv2cover').style.height = "150";
		document.getElementById('Zipcodedropinboxv2').style.height = "150";
		window.location="index.php";
		document.getElementById("spZipcode").innerHTML = stripslashes(strValue[0],"\\","");
	}
	else if(strValue[1] == "ZipCodeError")
	{
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById('Zipcodedropinboxv2cover').style.height = "175";
		document.getElementById('Zipcodedropinboxv2').style.height = "175";
	}
	
	else if(strValue[2] == "GuestBook")
	{			
		document.getElementById("GComments").innerHTML = stripslashes(strValue[1],"\\","");	
		document.getElementById("spPersonalGuestBook").innerHTML = stripslashes(strValue[0],"\\","");		
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[3],"\\","");			
	}
	else if(strValue[2] == "GuestBookLoginError")
	{
		document.getElementById("spMainDiaplay").innerHTML = stripslashes(strValue[0],"\\","");	
		document.getElementById("GuestBookLoginError").innerHTML = stripslashes(strValue[1],"\\","");		
		
	}
	else if(strValue[2] == "DeleteGuestBook")
	{				
		document.getElementById("spMainDiaplay").innerHTML = stripslashes(strValue[0],"\\","");	
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[1],"\\","");		
		
	}
	else if(strValue[2] == "ContactSended")
	{
		document.getElementById("ContactMePreview").innerHTML = stripslashes(strValue[0],"\\","");	
		document.getElementById("SendMessage").innerHTML = stripslashes(strValue[1],"\\","");
	}
		
	else if(strValue[2] == 'top')
	{
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("checkEdit").innerHTML = stripslashes(strValue[1],"\\","");			
	}		
	else if(strValue[3] == 'sum') {
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById(Values).innerHTML = stripslashes(strValue[1],"\\","");
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[2]);
	}
	else if(strValue[2] == 'Error')
	{
		document.getElementById("checkAvailMsg").innerHTML = stripslashes(strValue[1],"\\","");						
	}
	else if(strValue[3] == 'ContactInsert')
	{ 
		document.getElementById("spMainDiaplay").innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("spDisplay").innerHTML = stripslashes(strValue[1]);
		document.getElementById("memberimage").src = stripslashes(strValue[2]);
	}
	else if(strValue[3] == 'UpdateHeader')
	{ 
		document.getElementById("TotalReviewAdd").innerHTML = stripslashes(strValue[1]);
		document.getElementById("ratingImage").src = stripslashes(strValue[2]);
		document.getElementById("addreviews").innerHTML = "Ratings Feedback";	
	}
	else if(strValue[2] == 'updaterebuttalsheader')
	{ 
		document.getElementById("addrebuttals").innerHTML = "("+stripslashes(strValue[1])+")";
	}
	else
	{
		document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");
		document.getElementById("checkEdit1").innerHTML = stripslashes(strValue[1],"\\","");	
		
	}
	
	showAsEditable(Values, true);
}
