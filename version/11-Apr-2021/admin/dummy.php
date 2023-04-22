<?php
$name="regular";
	$query=<<<J
	$(function(){
		$("a.listItem:contains('$name')").trigger('click');
		});
	J;
	echo $query;
?>