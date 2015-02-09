// JavaScript Document
function save_Details(id,countArray,displayid,filename) //this function  used to save the datails in Db Like coupon page,profile page etc...
{  
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
	var success = function(t){SavelabelComplete(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename;
    var pars = 'checkText=' + txtValue + '&objIdent=' + txtValues + '&Id=' + id;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
	
}
function SavelabelComplete(t,Values)
{	
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();		
	//alert(Values);
	document.getElementById(Values).innerHTML = stripslashes(strValue[0],"\\","");	
	showAsEditable(Values, true);
}
function showAsEditable(obj, clear)//shows stylesheet effect 
{
    if (!clear){Element.addClassName(obj, 'editable');}
	else{Element.removeClassName(obj, 'editable');}
}
function editFailed(t, Values)
{
}