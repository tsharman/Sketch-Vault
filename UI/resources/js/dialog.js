$(document).ready(function() {
	$(".dialog").hide();
	$("#shadow").hide();
	$("#shadow").click(function() {
		$(".dialog").fadeOut(200);
		$(this).delay(200).fadeOut(200);
	});
});
