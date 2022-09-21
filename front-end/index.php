<?php

	use Page\PageComponents as P;

	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
#	P::setAsIndex();
#	P::initPage('Vstopna stran', 'Lorem ipsum');
	P::addCss('/assets/css/pages/homepage.css');
	#P::$isCategoriesBrowserOpen = true;
	#P::$hasFooterMargin = false;

?>


<!DOCTYPE html>
<html lang="sl">
	<?php 
 
		#include $_SERVER["DOCUMENT_ROOT"] . '/page/include/head.php';	
	
	#P::renderHead();
	
	
	
	
	?>

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
	<!-- <script type="text/javascript">
		if('serviceWorker' in navigator) {
			console.log(' ');
			navigator.serviceWorker.register('service-worker.js')
				.then(function() {
					console.log(' ');
				}).catch(function(err) {
			});
		}
	</script> -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.0/simplebar.min.css" crossorigin="anonymous"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.0/simplebar.min.js" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-js/1.3.0/sticky.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lightgallery-bundle.min.css">

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<link rel="stylesheet" href="/assets/css/imgpnl.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/js/jui/jquery-ui.min.css" type="text/css"/>
	<link rel="stylesheet" href="/assets/js/jui/jquery-ui.structure.min.css" type="text/css"/>


	<?php foreach(PageComponents::$cssFiles as $css) { ?>
		<link rel="stylesheet" href="<?php echo $css; ?>">
	<?php } ?>

	<?php# echo PageComponents::$headContents ?? ''; ?>


</head>



<body>
		 <?php
		
		include $_SERVER["DOCUMENT_ROOT"] . '/page/include/header.php';	
		# P::renderHeader(); ?>

		<div id="hp-slider">
			<div class="cw">
				<div class="content flx">
					<div class="banner"></div>
				</div>
			</div>
		</div>

		<div id="hp-favorite-categories">
			<div class="cw">
				<h2 class="heading"><strong>Priljubljene</strong> kategorije</h2>
				<div class="categories flx">
					<div class="category blue">
						<div class="ico flx center">
							<i class="fas fa-mobile"></i>
							<div class="hover">Išči med<strong>4.531</strong>oglasi</div>
						</div>
						<a href="#">Mobilni telefoni</a>
					</div>
					<div class="category blue">
						<div class="ico flx center">
							<i class="fas fa-mobile"></i>
							<div class="hover">Išči med<strong>4.531</strong>oglasi</div>
						</div>
						<a href="#">Mobilni telefoni</a>
					</div>
					<div class="category blue">
						<div class="ico flx center">
							<i class="fas fa-desktop"></i>
							<div class="hover">Išči med<strong>4.531</strong>oglasi</div>
						</div>
						<a href="#">Računalniki</a>
					</div>
					<div class="category blue">
						<div class="ico flx center">
							<i class="fas fa-blender"></i>
							<div class="hover">Išči med<strong>4.531</strong>oglasi</div>
						</div>
						<a href="#">Gospodinjski<br>aparati</a>
					</div>
					<div class="category green">
						<div class="ico flx center">
							<i class="fas fa-dog"></i>
							<div class="hover">Išči med<strong>4.531</strong>oglasi</div>
						</div>
						<a href="#">Male živali</a>
					</div>
					<div class="category orange">
						<div class="ico flx center">
							<i class="fas fa-tshirt"></i>
							<div class="hover">Išči med<strong>4.531</strong>oglasi</div>
						</div>
						<a href="#">Otroška<br>oblačila</a>
					</div>
					<div class="category red">
						<div class="ico flx center">
							<i class="fas fa-heart"></i>
							<div class="hover">Išči med<strong>4.531</strong>oglasi</div>
						</div>
						<a href="#">Ona išče njega</a>
					</div>
				</div>
			</div>
		</div>

		<div id="hp-paid-banners">
			<div class="cw flx">
				<div class="banner"></div>
				<div class="banner"></div>
				<div class="banner"></div>
			</div>
		</div>

		<div id="hp-vp">
			<div class="cw flx">
				<div class="value flx">
					<div class="ico"><i class="far fa-hourglass-half"></i></div>
					<strong>Z vami že</strong>
					<p>Več kot 20 let</p>
				</div>
				<div class="value flx">
					<div class="ico"><i class="fas fa-user-tie"></i></div>
					<strong>Pri nas oglašuje</strong>
					<p>2.183 trgovcev</p>
				</div>
				<div class="value flx">
					<div class="ico"><i class="far fa-search fa-flip-horizontal"></i></div>
					<strong>Skupaj</strong>
					<p>40.624 oglasov</p>
				</div>
			</div>
		</div>

		<div id="hp-recommended-stores">
			<div class="cw">
				<h2 class="heading"><strong>Izpostavljeni oglasi</strong> trgovcev</h2>
				<div class="content flx">
					<div class="stores">
						<div class="store">

							<div class="head flx">
								<div class="bio">
									<div class="logo flx">
										<img src="https://www.jelovica.com/wp-content/uploads/2018/08/Slovenijales-logo.jpg"/>
									</div>
									<strong>Naziv podjetja, prodaja lesenih konstrukcij</strong>
								</div>
								<a href="#" class="btn oval blue light arr more">
									Poglej več<i class="fal fa-chevron-right"></i>
								</a>
							</div>

							<div class="posts flx">
								<div class="post">
									<div class="img"><img src=""></div>
									<a href="#" class="af">Velenje, 2000 m2</a>
									<strong>10.000 €</strong>
								</div>
								<div class="post">
									<div class="img"><img src=""></div>
									<a href="#" class="af">Velenje, 2000 m2</a>
									<strong>10.000 €</strong>
								</div>
								<div class="post">
									<div class="img"><img src=""></div>
									<a href="#" class="af">Velenje, 2000 m2</a>
									<strong>10.000 €</strong>
								</div>
							</div>

						</div>
						<div class="store">

							<div class="head flx">
								<div class="bio">
									<div class="logo flx">
										<img src="https://www.jelovica.com/wp-content/uploads/2018/08/Slovenijales-logo.jpg"/>
										<i class="fas fa-shopping-cart has-store"></i>
									</div>
									<strong>Naziv podjetja, prodaja lesenih konstrukcij</strong>
								</div>
								<a href="#" class="btn oval blue light arr more">
									Poglej več<i class="fal fa-chevron-right"></i>
								</a>
							</div>

							<div class="posts flx">
								<div class="post">
									<div class="img"><img src=""></div>
									<a href="#" class="af">Velenje, 2000 m2</a>
									<strong>10.000 €</strong>
								</div>
								<div class="post">
									<div class="img"><img src=""></div>
									<a href="#" class="af">Velenje, 2000 m2</a>
									<strong>10.000 €</strong>
								</div>
								<div class="post">
									<div class="img"><img src=""></div>
									<a href="#" class="af">Velenje, 2000 m2</a>
									<strong>10.000 €</strong>
								</div>
							</div>

						</div>
						<div class="store">

							<div class="head flx">
								<div class="bio">
									<div class="logo flx">
										<img src="https://www.jelovica.com/wp-content/uploads/2018/08/Slovenijales-logo.jpg"/>
									</div>
									<strong>Naziv podjetja, prodaja lesenih konstrukcij</strong>
								</div>
								<a href="#" class="btn oval blue light arr more">
									Poglej več<i class="fal fa-chevron-right"></i>
								</a>
							</div>

							<div class="posts flx">
								<div class="post">
									<div class="img"><img src=""></div>
									<a href="#" class="af">Velenje, 2000 m2</a>
									<strong>10.000 €</strong>
								</div>
								<div class="post">
									<div class="img"><img src=""></div>
									<a href="#" class="af">Velenje, 2000 m2</a>
									<strong>10.000 €</strong>
								</div>
								<div class="post">
									<div class="img"><img src=""></div>
									<a href="#" class="af">Velenje, 2000 m2</a>
									<strong>10.000 €</strong>
								</div>
							</div>

						</div>
					</div>
					<div class="banner"></div>
				</div>
			</div>
		</div>

		<div id="hp-last-posts">
			<div class="cw">
				<h2 class="heading"><strong>Zadnji oglasi</strong> fizičnih oseb</h2>
				<div class="posts flx">
					<div class="post">
						<div class="img"><img src=""></div>
						<a href="#">Prenosni računalnik HP</a>
						<div class="price">100 €</div>
					</div>
					<div class="post">
						<div class="img"><img src=""></div>
						<a href="#">Srebrne Nike superge</a>
						<div class="price">100 €</div>
					</div>
					<div class="post">
						<div class="img"><img src=""></div>
						<a href="#">Zlati prinašalec - mladički, pokličite</a>
						<div class="price">100 €</div>
					</div>
					<div class="post">
						<div class="img"><img src=""></div>
						<a href="#">Krompir - Bellarosa</a>
						<div class="price">100 €</div>
					</div>
					<div class="post">
						<div class="img"><img src=""></div>
						<a href="#">Prenosni računalnik HP</a>
						<div class="price">100 €</div>
					</div>
					<div class="post">
						<div class="img"><img src=""></div>
						<a href="#">Srebrne Nike superge</a>
						<div class="price">100 €</div>
					</div>
					<div class="post more">
						<a href="#" class="btn oval blue light arr">Več oglasov <i class="fal fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>

		<div class="new-post-cta">
			<div class="cw">
				<p>Želite oddati nov oglas? Tudi <strong>brez prijave</strong>!</p>
				<a class="btn blue oval" href="/nov-oglas/">Oddaj oglas <i class="far fa-plus"></i></a>
			</div>
		</div>

<?php P::renderFooter(); ?>
	</body>
</html>