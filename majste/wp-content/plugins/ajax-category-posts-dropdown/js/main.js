var ajax = new Array();

function getacpd_postsList(sel, blogurl)
{
	var mainCats = sel.options[sel.selectedIndex].value;
	document.getElementById('acpd_posts').options.length = 0;
	if(mainCats.length>0){
		var index = ajax.length;
		ajax[index] = new sack();
		
		ajax[index].requestFile = blogurl+'/wp-content/plugins/ajax-category-posts-dropdown/getacpd_posts.php?mainCats='+mainCats;
		ajax[index].onCompletion = function(){ createacpd_posts(index) };	
		ajax[index].runAJAX();	
	}
}

function createacpd_posts(index)
{
	var obj = document.getElementById('acpd_posts');
	eval(ajax[index].response);
}


function gotoPost()
{
	var url = document.getElementById('acpd_posts').value;
	window.location = url;
}