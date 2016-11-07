<?php
require_once 'connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "xhtml11.dtd">
<html ng-app>
<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251" />
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" name="viewport" />
	<TITLE>ZEN Events</TITLE>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="source/css/jquery-ui.min.css">
	<link rel="stylesheet" href="source/css/jquery-ui.structure.min.css">
	<link rel="stylesheet" href="source/css/jquery-ui.theme.min.css">
	<link rel="stylesheet" href="source/css/bootstrap.min.css">
	<link rel="stylesheet" href="source/css/bootstrap.min.css.map">
	<link rel="stylesheet" href="source/css/tether.min.css">
	<link rel="stylesheet" href="source/css/tether-theme-arrows.min.css">
	<link rel="stylesheet" href="source/css/tether-theme-basic.min.css">
	<link rel="stylesheet" href="source/css/bootstrap-theme.css">
	<link rel="stylesheet" href="source/css/style.css">
	<script src="source/js/jquery-ui.min.js"></script>
	<script src="source/js/tether.min.js"></script>
	<script src="source/js/angular.js"></script>
	<script src="source/js/backbone.js"></script>
	<script src="source/js/bootstrap.min.js"></script>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '1909067872653575',
				xfbml      : true,
				version    : 'v2.7'
			});
		};

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.7&appId=1909067872653575";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="wrapper">

	<?php include 'assets/templates/header.php'; ?>

	<div class="content">

		<script src="fb.js"></script>

		<!--
          Below we include the Login Button social plugin. This button uses
          the JavaScript SDK to present a graphical Login button that triggers
          the FB.login() function when clicked.
        -->

		<!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
		</fb:login-button>

		<div id="status">
		</div>

		<div
			class="fb-like"
			data-share="true"
			data-width="450"
			data-show-faces="true">
		</div>

		<div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="true" data-auto-logout-link="true"></div>-->

		<div id="map"></div>
		<p id="demo">
			<?php
			include 'init.php';
			?>
		</p>

	</div>

	<script src="map.js"></script>
	<script src="source/js/script.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeCoj8w8dKz4pJheRS-omzCchD6EaYhOE&signed_in=true&libraries=places&callback=initMap"
			async defer></script>


</div>
<div id="loader"></div>
<script>
	mapGo();
</script>
</body>
</html>