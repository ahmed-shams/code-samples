function coupons(TempaId)
{
	//document.getElementById('TemplateId').value=TempaId;
	//document.businessfrm.submit();
	var url = 'CouponDisplay.php';
    var pars = 'TemplateId=' + TempaId;
    var myAjax = new Ajax.Request(url, {method:'post',postBody:pars});
}