<?php

	//Prevent direct access
	if(!defined('ROOT')) die;

	use Page\PageComponents;

?>
<head>
	<base href="/">
	<link rel="stylesheet" type="text/css" href="/assets/css/core.css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="/assets/res/favico/favicon-16x16.png"/>
	<meta name="msapplication-TileColor" content="#fff">
	<meta name="theme-color" content="#fff">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<link rel="apple-touch-icon" sizes="57x57" href="/assets/res/favico/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/assets/res/favico/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/assets/res/favico/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/res/favico/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/assets/res/favico/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/assets/res/favico/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/assets/res/favico/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/assets/res/favico/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/res/favico/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/assets/res/favico/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/res/favico/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/res/favico/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/res/favico/favicon-16x16.png">
	<meta name="msapplication-TileImage" content="/assets/res/favico/ms-icon-144x144.png">
	<meta name="robots" content="<?php echo PageComponents::$robots ?>"/>
	<title><?php echo PageComponents::$title ?> | oglasi.si</title>
	<meta property="og:title" content="<?php echo PageComponents::$title ?>"/>
	<meta name="description" content="<?php echo PageComponents::$description ?>"/>
	<meta property="og:description" content="<?php echo PageComponents::$description ?>"/>
	<meta name="keywords" content="<?php echo PageComponents::$keywords ?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:image" content="/assets/res/ogimg.jpg"/>
	<meta property="og:image:secure_url" content="/assets/res/ogimg.jpg"/>
	<script src="/assets/js/core.js"></script>
	<meta name="msvalidate.01" content=""/>
	<meta name="mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-title" content="oglasi.si"/>
	<link rel="stylesheet" href="/assets/fonts/fa/css/solid.min.css">
	<link rel="stylesheet" href="/assets/fonts/fa/css/regular.min.css">
	<link rel="stylesheet" href="/assets/fonts/fa/css/light.min.css">
	<link rel="stylesheet" href="/assets/fonts/fa/css/brands.min.css">
	<link rel="stylesheet" href="/assets/fonts/fa/css/fontawesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link rel="manifest" href="/manifest.json">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<script type="text/javascript">
		if('serviceWorker' in navigator) {
			console.log(' ');
			navigator.serviceWorker.register('service-worker.js')
				.then(function() {
					console.log(' ');
				}).catch(function(err) {
			});
		}
	</script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.0/simplebar.min.css" crossorigin="anonymous"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.0/simplebar.min.js" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-js/1.3.0/sticky.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lightgallery-bundle.min.css">

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<?php foreach(PageComponents::$jsFiles as $js) { ?>
		<script src="<?php echo $js; ?>"></script>
	<?php } ?>


	<?php foreach(PageComponents::$cssFiles as $css) { ?>
		<link rel="stylesheet" href="<?php echo $css; ?>">
	<?php } ?>

	<?php echo PageComponents::$headContents ?? ''; ?>

	<link rel="stylesheet" href="/assets/css/imgpnl.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/js/jui/jquery-ui.min.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/js/jui/jquery-ui.structure.min.css" type="text/css"/>

</head>
