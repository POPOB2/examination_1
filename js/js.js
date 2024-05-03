// JavaScript Document
$(document).ready(function(e) {
	$(".mw").hide(); // 載入網頁先隱藏全部
    $(".mainmu").mouseover(
		function()
		{
			$(this).children(".mw").stop().show()
		}
	)
	$(".mainmu").mouseout(
		function ()
		{
			$(this).children(".mw").hide()
		}
	)
});


function lo(x)
{
	location.replace(x)
}


function op(x,y,url)
{
	$(x).fadeIn() // x淡入(顯示)

	if(y)
		$(y).fadeIn()

	if(y&&url)
		$(y).load(url) // y裡面顯示url
}


function cl(x)
{
	$(x).fadeOut();
}