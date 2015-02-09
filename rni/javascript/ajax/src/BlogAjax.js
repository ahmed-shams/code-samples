// JavaScript Document
function AddnewBlog()
{
	document.getElementById('fAction').value = "newBlog";
	document.BlogFrmList.submit();	
}

function editBlog(BlogIdent)
{
	document.getElementById('fAction').value   = "EditBlog";
	document.getElementById('BlogIdent').value = BlogIdent;
	document.BlogFrmList.submit();	
}

function editBlogSum(BlogIdent)
{
	document.getElementById('fAction').value   = "EditBlog";
	document.getElementById('BlogIdent').value = BlogIdent;
	document.BlogFrmListSum.submit();	
}