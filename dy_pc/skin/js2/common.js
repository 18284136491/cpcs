// JavaScript Document
function gotoUrl(url)
{
	window.location.href(url);
}
function beMove(obj,type)
{
	if(type)
	{
		$(obj).addClass("beMove");
		$(obj).css("color","#71c7d5");
	}
	else
	{
		$(obj).removeClass("beMove");
		$(obj).css("color","#fff");
	}
}
function go(url){
	location.href=url;
}
function reJson() {
     $.getJSON("/leftDao.php?callback=?",function(json){
												 // alert(json.tz_money);
					$("#tz_money").html(json.tz_money);
					$("#user_money").html(json.user_money);
					$("#user_num").html(json.user_num);										
					
			  }
		);
}
function ChangeLeft(url,id){
	window.open(url,id);  	
}