$(function(){
	$('a.link').on('click',function(e){
		e.preventDefault();
		var val=$(this).text();
		alert(val);
	});
});