$(document).ready(function() {
	$("#sign_in_button").click(function() {
		if($("#sign_in_dialog").is(":visible")) {
			$("#sign_in_dialog").fadeOut(200);
			return;
		}
		var pos = $(this).position();
		var width = $(this).outerWidth();
		var height = $(this).outerHeight();
		var dialogWidth = $("#sign_in_dialog").outerWidth();
		$("#sign_in_dialog").css({
				position: "absolute",
				top: (pos.top + height) + "px",
				left: (pos.left - dialogWidth + width) + "px"
			});
		$("#sign_in_dialog").fadeIn(200);
	});
	$("#sign_out_button").click(function() {
		window.location = "logout.php";
	});

});
