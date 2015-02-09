function PostAnnouncementHere()
{
	document.location = "../postannouncements.php";	
}
function AnnouncementsPerPage1(spanid,page,opvalue,usrid,orderby,filename,Display)   //This Function  used to display the Announcements PerPage
{  
	var Values = Display;
	var success = function(t){AnnouncementsPerPageComplete1(t, Values);}
	var failure = function(t){editFailed(t, Values);}
	var url = filename; 
    var pars = 'checkText=' + spanid + '&p=' + page + '&c='+ opvalue + '&ml='+ usrid + '&sortby='+ orderby; 
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars, onSuccess:success, onFailure:failure});
}
function AnnouncementsPerPageComplete1(t, Values)
{ 
	var strValue = t.responseText.split('||'); 
	Values = Values.toString();
	document.getElementById("spMainDiaplay").innerHTML 			= stripslashes(strValue[0],"\\","");
}

function EditAnnouncement(Ident,TypeAction)
{
	//alert(Ident);
	document.getElementById('fAction').value = TypeAction;
	document.getElementById('ProductIdent').value = Ident;
	document.frmAnnouncement.submit();
}

function DeleteAnnouncement(Ident,EIdent)
{
	if(confirm("Do you really want to delete."))
	{
		document.getElementById('fAction').value = 'Delete';
		document.getElementById('EIdent').value = EIdent;
		document.getElementById('DeleteComment').value = Ident;
		document.frmAnnouncement.submit();
	}
	else
		return false;
}