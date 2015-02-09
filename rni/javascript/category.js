// JavaScript Document

function Show_Category_VendorList(Cat_Id,Category_Name)	{
	$("Contentdiv").innerHTML = "<img src='images/smallloading.gif'>";
	var success = function(t){ Show_Category_VendorListComplete(t);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=listCategoryVendor&Cat_Id='+Cat_Id+'&Category_Name='+Category_Name;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function Show_Category_VendorListComplete(t)	{
	$("Contentdiv").innerHTML = t.responseText;
	window.location.href = "#";
}


function Show_Cat_Accessory_VendorList(id,Cat_Id,Acc_Name,Product_Name,CategoryName,Prod_Id)	{
	$("Contentdiv").innerHTML = "<img src='images/smallloading.gif'>";
	var success = function(t){ Show_Cat_Accessory_VendorListComplete(t);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=listCatAccessoryVendor&id='+id+'&Cat_Id='+Cat_Id+'&Acc_Name='+Acc_Name+'&Product_Name='+Product_Name+'&CategoryName='+CategoryName+'&Prod_Id='+Prod_Id;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function Show_Cat_Accessory_VendorListComplete(t)	{ 
	$("Contentdiv").innerHTML = t.responseText;
	window.location.href = "#";
}

function Show_Pdt_Accessory_VendorList(id,Cat_Id,Acc_Name,Product_Name,Category_Name,Prod_Id)	{
	$("Contentdiv").innerHTML = "<img src='images/smallloading.gif'>";
	var success = function(t){ Show_Pdt_Accessory_VendorListComplete(t,Acc_Name);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=listPdtAccessoryVendor&id='+id+'&Cat_Id='+Cat_Id+'&Acc_Name='+Acc_Name+'&Category_Name='+Category_Name;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function Show_Pdt_Accessory_VendorListComplete(t,Acc_Name)	{
	$("Contentdiv").innerHTML = t.responseText;
	Acc_Name = Acc_Name.replace(/ /g,"_");
	document.getElementById("TopContentId").id = Acc_Name;
	window.location.href = "#"+Acc_Name;
}

function SortCatagories(SortBy)	{
	$("Contentdiv").innerHTML = "<img src='images/smallloading.gif'>";	
	var success = function(t){ SortCatagoriesComplete(t);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=SortCatagories&SortBy='+SortBy;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function SortCatagoriesComplete(t)	{
	$("Contentdiv").innerHTML = t.responseText;
	window.location.href = "#";
}

function ShowProducts(Cat_Id,GenreId,offset,ViewId,Cat_Name,PPFlag)	{
	$("Contentdiv").innerHTML = "<img src='images/smallloading.gif'>";	
	var success = function(t){ ShowProductsComplete(t);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=listCatProduct&Cat_Id='+Cat_Id+'&GenreId='+GenreId+'&offset='+offset+'&ViewId='+ViewId+'&Cat_Name='+Cat_Name+'&PPFlag='+PPFlag;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function ShowProductsComplete (t)	{
	$("Contentdiv").innerHTML = t.responseText;
	$("TopContentIdFocus").focus();
	//window.location.href = "#";
}

function editFailed(t) {
	alert("Ajax failed");	
}


function ShowProduct_VendorList(Prod_Id,Cat_Id,CategoryName)	{
	$("Contentdiv").innerHTML = "<img src='images/smallloading.gif'>";
	var success = function(t){ ShowProduct_VendorListComplete(t);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=listVendorProduct&Prod_Id='+Prod_Id+'&Cat_Id='+Cat_Id+'&CategoryName='+CategoryName;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
	
}

function ShowProduct_VendorListComplete(t)	{
//	alert(t.responseText);
	$("Contentdiv").innerHTML = t.responseText;
	window.location.href = "#";
}

function ShowAllProducts(Cat_Id,CategoryName,GenreId)	{
	$("Contentdiv").innerHTML = "<img src='images/smallloading.gif' align='center'>";
	var success = function(t){ ShowAllProductsComplete(t);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=ShowAllProducts&Cat_Id='+Cat_Id+'&CategoryName='+CategoryName+'&GenreId='+GenreId;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function ShowAllProductsComplete(t)	{
		//alert(t.responseText);	
		$("Contentdiv").innerHTML = t.responseText;
		window.location.href = "#";

}

function AddIpAddressInfo(Producturl,IpAddress,Product_Id,Vendor_Id)	{
	var success = function(t){ AddIpAddressInfoComplete(t,Producturl);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=AddIpAddressInfo&txt_Website_Code='+Producturl+'&txt_IpAddress='+IpAddress+'&txt_Product_Id='+Product_Id+'&txt_Vendor_Id='+Vendor_Id;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function AddIpAddressInfoComplete(t,Producturl)	{
		//window.open (Producturl, "",  "location=0,status=1,scrollbars=1,width=500,height=500");
		
}

function AddAccessoryIpAddressInfo(Producturl,Acc_Id,Vendor_Id)	{
	var success = function(t){ AddAccessoryIpAddressInfoComplete(t,Producturl);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=AddAccessoryIpAddressInfo&txt_Website_Code='+Producturl+'&txt_Acc_Id='+Acc_Id+'&txt_Vendor_Id='+Vendor_Id;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function AddAccessoryIpAddressInfoComplete(t,Producturl)	{
	//alert(t.responseText);
	//window.open (Producturl, "",  "location=0,status=1,scrollbars=1,width=500,height=500");
}

function AddCategoryIpAddressInfo(Producturl,Cat_Id,Vendor_Id)	{
	var success = function(t){ AddCategoryIpAddressInfoComplete(t,Producturl);}
	var failure = function(t){ editFailed(t);}
	var url     =  'ajax/catagory.php';
	var pars    = 'op=AddCategoryIpAddressInfo&txt_Website_Code='+Producturl+'&txt_Cat_Id='+Cat_Id+'&txt_Vendor_Id='+Vendor_Id;
	var myAjax  = new Ajax.Request(url, {method:'post', postBody:pars, onSuccess:success, onFailure:failure});	
}

function AddCategoryIpAddressInfoComplete(t,Producturl)	{
	//alert(t.responseText);
	////window.open (Producturl, "",  "location=0,status=1,scrollbars=1,width=500,height=500");
}

