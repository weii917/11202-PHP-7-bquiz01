// JavaScript Document
// mouseover滑鼠滑進mainmu區域的動作會在.mainmu子元素顯示.mw裡的東西
// mouseout移開.mainmu區域會觸發隱藏子元素.mw
$(document).ready(function(e) {
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
// 傳遞一個 URL 作為參數時，URL 將取代當前的瀏覽器位置
function lo(x) 
{
	location.replace(x)
}
// 當按下，會觸發此函式將x的id="cover"淡入並載入url的內容
function op(x,y,url)
{
	$(x).fadeIn()
	if(y)
	$(y).fadeIn()
	if(y&&url)
	$(y).load(url)
}
// 當按下此a tag裡的內容，會觸發此函式將x的id="cover"淡出
function cl(x)
{
	$(x).fadeOut();
}