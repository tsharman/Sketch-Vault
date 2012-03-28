<?php
require_once 'xhp/init.php';
require_once 'lib/authentication.php';
require_once 'UI/topnav.php';
require_once 'UI/post.php';
require_once 'UI/panels.php';
require_once 'UI/dialog.php';
?>

<!DOCTYPE html PUBLIC "-//W3C/DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<!-- METADATA -->
	<title>The Sketch Vault</title>
	<meta name="title" content="The Sketch Vault" />
	<meta name="description" content="The Sketch Vault aggregates and organizes your favorited web comics so you dont have to." />
	<link rel="image_src" href="/UI/resources/images/appicon.png" />

	<!-- STYLESHEETS -->
	<link rel="icon" type="image/ico" href="/UI/resources/images/heartfavi.ico" />
	<link href="/UI/resources/css/topnav.css" rel="stylesheet" type="text/css"/>
	<link href="/UI/resources/css/main.css" rel="stylesheet" type="text/css"/>
	<link href="/UI/resources/css/input.css" rel="stylesheet" types="text/css" />
	<link href="/UI/resources/css/post.css" rel="stylesheet" type="text/css"/>
	<link href="/UI/resources/css/dialog.css" rel="stylesheet" type="text/css"/>
	<link href="/UI/resources/css/panels.css" rel="stylesheet" types="text/css" />
	<link href="/UI/resources/css/general.css" rel="stylesheet" types="text/css" />
	
	<!-- SCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="/UI/resources/js/post.js" type="text/javascript"></script>
	<script src="/UI/resources/js/dialog.js" type="text/javascript"></script>
	<script src="/UI/resources/js/topnav.js" type="text/javascript"></script>
	
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-29510831-1']);
	  _gaq.push(['_setDomainName', 'sketchv.com']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>
<body>

<?php
global $loginUrl;
$currentPage = (isset($_GET["page"])) ? $_GET["page"] : "new";
$currentFilter = (isset($_GET["filter"])) ? $_GET["filter"] : "all";
echo '<script> 
		type="'.$currentPage.'";
		filter="'.$currentFilter.'";
	</script>';
echo <hc:sign_in_dialog loginUrl={$loginUrl} />;
echo <hc:top_nav />;
?>
<div id="content">
	<?php
	echo <hc:post_list  />;
	if(isset($_SESSION["userData"])) {
		echo <hc:user_meta_panel />;
	}
	echo
		<a href="http://www.twitter.com/sketchvault">
			<hc:simple_msg_panel 
				id="twitter_panel" 
				url="/UI/resources/images/twitter.png" 
				message="Got suggestions? Get in touch with us at @sketchvault" />
		</a>;


	?>
</div>
</body>
</html>
