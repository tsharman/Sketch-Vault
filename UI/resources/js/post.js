$(document).ready(function() {
		page = 1;
		var clicked;
		$(".post_heading_favorited").click(function() {
			if(clicked === undefined) {
				clicked = $(this);
			}
			var postid = $(this).attr('data-postid');
			var userid = $(this).attr('data-userid');
			//TODO: CLEAN UP CODE
			if(!userid) {
				var pos = $(this).position();
				var width = $(this).outerWidth();
				var dialogWidth = $("#sign_in_dialog").outerWidth();
				
				//handling placement of dialog
				if($("#sign_in_dialog").is(":visible") && (clicked.get(0) == $(this).get(0))) {
					//if post liked is the same then we simply remove the dialog
					$("#sign_in_dialog").fadeOut(200);
				}
				else if(clicked.get(0) != $(this).get(0)) {
				//if post liked is different than previous one then we move the dialog down
					$("#sign_in_dialog").fadeOut(200, function() {
						$("#sign_in_dialog").css({
							top: (pos.top - 10) + "px",
							left: (pos.left + width + 30) + "px"
						});
					});
					$("#sign_in_dialog").delay(200).fadeIn(200);
					clicked = $(this);
				}
				else {
				//otherwise we just show the dialog (first time liking something)
					$("#sign_in_dialog").css({
						top: (pos.top - 10) + "px",
						left: (pos.left + width + 30) + "px"
					});
					$("#sign_in_dialog").fadeIn(200);
				}
				return;
			}

			if($(this).hasClass('non_favorited'))
				var url = '/ajax/like.php';
			else
				var url = '/ajax/unlike.php';

			$.ajax({
				url: url,
				type: 'POST',
				data: { postid: postid, userid: userid },
				error: function() { console.log("error while favoriting"); }
			});

			$(this).toggleClass('favorited');
			$(this).toggleClass('non_favorited');

		});
		$(parent.document).scroll(function() {
			if($(document).scrollTop() > ($(document).height() -$(window).height() * 2)) {
				$.ajax({
					async: false,
					url: '/ajax/more_posts.php',
					type: 'GET',
					data: { type: type, page: page, count: 20, filter:filter},
					error: function() {console.log("error while loading more posts"); },
					success: function(msg) {
						$("#content").children(".post_list").append(msg);
						if(msg.length != 0)
							page++; 
					}
				});
			}
		});
})
