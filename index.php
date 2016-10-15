<?php
require_once 'connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "xhtml11.dtd">
<html>
<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251" />
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" name="viewport" />
	<TITLE>Test site</TITLE>
	<link rel="stylesheet" href="//www.ukraine.com.ua/static/parking/style.css" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
	<style type="text/css">
		div.container {
			max-width: 900px;
			width: 100%;
		}
		#demo {
			display: -webkit-box;
			display: -moz-box;
			display: -ms-flexbox;
			display: -webkit-flex;
			display: flex;
			-webkit-flex-wrap: wrap;
			flex-wrap: wrap;
		}
		#demo > div {
			width: 28%;
			padding: 15px;
			margin: 1%;
			margin-bottom: 10px;
			background-color: beige;
		}
		#map {
			height: 500px;
			width: 100%;
		}
		#loader {
			position: fixed;
			top: 0;
			left: 0;
			display: none;
			height: 100%;
			width: 100%;
			background-color: rgba(255,255,255,0.7);
			background-image: url("loader.gif");
			background-repeat: no-repeat;
			background-position: center center;
		}
	</style>
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
<div class="container">

	<div class="content">

		<script src="fb.js"></script>

		<!--
          Below we include the Login Button social plugin. This button uses
          the JavaScript SDK to present a graphical Login button that triggers
          the FB.login() function when clicked.
        -->

		<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
		</fb:login-button>

		<div id="status">
		</div>

		<div
			class="fb-like"
			data-share="true"
			data-width="450"
			data-show-faces="true">
		</div>

		<div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="true" data-auto-logout-link="true"></div>
		
	</div>

	<h2>Look for events</h2>
	<label for="city">Enter City</label>
	<input id="city" type="text" />
	<div class="range">
		<input id="range" type="range" min="0" max="100" step="1" value="20">
	</div>
	<button type="button" onclick="mapGo();">Request data</button>
	<button type="button" onclick="resetDoc();">Reset data</button>

	<div id="map"></div>
	<p id="demo">
	<?php
	include 'init.php';
	?>
	</p>

	<script src="map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeCoj8w8dKz4pJheRS-omzCchD6EaYhOE&signed_in=true&libraries=places&callback=initMap"
			async defer></script>


</div>
<div id="loader"></div>
</body>
</html>