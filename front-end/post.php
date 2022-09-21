<?php

	use Page\PageComponents as P;

	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
	P::initPage('Oglas naziv lorem ipsum', 'Lorem ipsum');
	P::addCss('/assets/css/pages/post.css');
	P::addCss('https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lightgallery-bundle.min.css');
	P::addCss('https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lg-thumbnail.css');
	P::addCss('https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lg-zoom.css');

	$productImages = ['https://www.bolha.com/image-w920x690/samsung/prodam-samsung-s20-ultra-raketo-med-mobiteli-slika-32689802.jpg', 'https://www.bolha.com/image-w920x690/samsung/prodam-samsung-s20-ultra-raketo-med-mobiteli-slika-32689803.jpg', 'https://www.bolha.com/image-w920x690/samsung/prodam-samsung-s20-ultra-raketo-med-mobiteli-slika-32689804.jpg', 'https://www.bolha.com/image-w920x690/samsung/prodam-samsung-s20-ultra-raketo-med-mobiteli-slika-32689805.jpg', 'https://www.bolha.com/image-w920x690/samsung/prodam-samsung-s20-ultra-raketo-med-mobiteli-slika-32689808.jpg'];
	$productImagesCount = count($productImages);
	$enableGallery = $productImagesCount > 0;
?>


<!DOCTYPE html>
<html lang="sl">
	<?php P::renderHead(); ?>
	<body>
		<?php P::renderHeader(); ?>

		<div class="cw">

			<div class="intro-banner flx">
				<div class="banner"></div>
			</div>

			<?php
				P::renderBreadcrumbs([
					['Tehnika', '#'],
					['Računalništvo', '#'],
					['Monitorji', '#'],
				]);
			?>


			<div id="post" class="flx">

				<div class="content">

					<div class="tile">
						<div class="head">
							<div class="upper flx">
								<strong class="tag">Prodam</strong><strong class="price">1000 €</strong>
							</div>
							<div class="title">
								<h1>LCD Monitor Samsung Syncmaster 19” WIDE, AOC E2470SWH64616469499</h1>
							</div>
						</div>

						<div class="gallery">
							<div class="gallery-main">
								<img src="<?php echo $productImages[0]; ?>"/>
								<div class="gallery-main-controls np">
									<div class="arr left"><i class="fal fa-chevron-left"></i></div>
									<div class="arr right"><i class="fal fa-chevron-right"></i></div>
									<div class="fullscreen"><i class="fal fa-expand-alt"></i></div>
									<div class="count"><span>1</span>&nbsp;od <?php echo $productImagesCount; ?></div>
								</div>
							</div>
							<?php if($enableGallery) { ?>
								<div class="gallery-thumbnails">
									<?php foreach($productImages as $i => $img) { ?>
										<div class="gallery-thumbnail<?php echo $i === 0 ? ' active' : ''; ?>">
											<img data-main="<?php echo $img; ?>" src="<?php echo $img; ?>"/>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>

						<div id="lightgallery">
							<?php foreach($productImages as $i => $img) { ?>
								<a href="<?php echo $img; ?>">
									<img src="<?php echo $img; ?>"/>
								</a>
							<?php } ?>
						</div>

						<div class="controls flx np">
							<a><i class="fal fa-bookmark"></i> Shrani oglas</a>
							<a id="post-share-btn"><i class="fal fa-share-alt"></i> Deli oglas</a>
							<a><i class="fal fa-print"></i> Natisni oglas</a>
							<a data-modal="modal-report"><i class="fal fa-exclamation-triangle"></i> Prijavi zlorabo</a>

							<div class="overlay share">
								<div class="flx">
									<a><i class="fab fa-facebook"></i> Facebook</a>
									<a><i class="fas fa-envelope"></i> Posreduj prijatelju</a>
								</div>
							</div>

						</div>
					</div>


					<div class="tile">
						<h2>Podatki in karakteristike</h2>
						<table class="specs-tbl">
							<tr>
								<td>Stanje</td>
								<td>Rabljeno</td>
							</tr>
							<tr>
								<td>Originalna embalaža</td>
								<td>Da</td>
							</tr>
							<tr>
								<td>Račun</td>
								<td>Da</td>
							</tr>
							<tr>
								<td>Proizvajalec</td>
								<td>LG</td>
							</tr>
							<tr>
								<td>Dimenzije</td>
								<td>100 x 100 x 100 cm</td>
							</tr>
							<tr>
								<td>Ločljivost zaslona</td>
								<td>100 x 100</td>
							</tr>
						</table>
					</div>

					<div class="tile">
						<h2>Podrobnejši opis</h2>
						<p>
							Zaradi selitve prodajam odlično ohranjen MONTIOR– LG 4K 27” LED monitor – LG7UL650. Kupljen je bil nov, uporabljen pa zgolj 4 mesece. Originalna škatla ter vsi računi dodani.<br><br>

							-27" UHD (3840 x 2160) IPS Display<br>-VESA DisplayHDR 400 <br>-sRGB 99% Color Gamut
							<br>-3-Side Virtually Borderless Display <br>-Height / Pivot / Tilt Adjustable Stand
							<br>-Radeon FreeSync™ Technology
							<br><br> Odličen za urejanje slik in videov, ter grafično oblikovanje.
						</p>
					</div>

					<div class="tile">
						<h2>Lokacija</h2>
						<div class="location flx">
							<p>Sveti Trije Kraljii v Slovenskih Goricah, LJ - Osrednjeslovenska</p>
							<a href="#" data-modal="modal-map">
								<i class="fas fa-map-marker-alt"></i> Prikaži lokacijo na zemljevidu
							</a>
						</div>
					</div>

					<div class="banner-container">
						<div class="banner"></div>
					</div>

					<div class="tile np">
						<h2>Sorodni oglasi</h2>
						<div class="suggested-posts flx">
							<div class="sug-post">
								<img src="https://i.imgur.com/7JF5U4Z.png">
								<a href="#">Prenosni računalnik HP</a>
								<strong>500 €</strong>
							</div>
							<div class="sug-post">
								<img src="https://i.imgur.com/7JF5U4Z.png">
								<a href="#">Prenosni računalnik HP</a>
								<strong>500 €</strong>
							</div>
							<div class="sug-post">
								<img src="https://i.imgur.com/7JF5U4Z.png">
								<a href="#">Prenosni računalnik HP</a>
								<strong>500 €</strong>
							</div>
							<div class="sug-post">
								<img src="https://i.imgur.com/7JF5U4Z.png">
								<a href="#">Prenosni računalnik HP</a>
								<strong>500 €</strong>
							</div>
							<div class="sug-post">
								<img src="https://i.imgur.com/7JF5U4Z.png">
								<a href="#">Prenosni računalnik HP</a>
								<strong>500 €</strong>
							</div>
						</div>
					</div>
				</div>

				<div class="sidebar">

					<div class="tile seller">

						<!--

							<div class="bio">
								<div class="avatar">
									<span style="background-color:#EFA00B;">JN</span>
								</div>
								<a href="#">Janez Novak</a>
								<p>ID uporabnika: 6757 </p>
							</div>

							<div class="info phone">
								<i class="fa fa-phone fa-flip-horizontal"></i>
								<a href="#" class="af">+ 386 41 556 858</a>
							</div>

							<div class="info location">
								<i class="fa fa-map-marker-alt"></i>
								<a href="#" class="af">Sveti Trije Kraljii v Slovenskih Goricah</a>
							</div>

							<div class="info contact">
								<i class="fa fa-envelope"></i>
								<a class="btn oval white brd">Kontaktiraj oglaševalca</a>
							</div>

							<div class="all-posts">
								<a href="#">Vsi oglasi oglaševalca</a>
							</div>

							-->


						<div class="bio">
							<div class="avatar">
								<img src="https://i.imgur.com/TrKgxgE.png">
							</div>
							<a href="#">Atriva d.o.o.</a>
							<p>ID uporabnika: 6757 </p>
						</div>

						<div class="info phone">
							<i class="fa fa-phone fa-flip-horizontal"></i>
							<a href="#" class="af">+ 386 41 556 858</a>
						</div>

						<div class="info location multiline">
							<i class="fa fa-map-marker-alt"></i>
							<a href="#" class="af"><span>Mariborska ulica 13 b<br>2000 Maribor<br>MB - Podravska</span>
							</a>
						</div>

						<div class="info website">
							<i class="fa fa-external-link-alt"></i>
							<a href="#" class="af">www.atriva.com</a>
						</div>

						<div class="info contact">
							<i class="fa fa-envelope"></i>
							<a class="btn oval white brd" data-modal="modal-message">Kontaktiraj trgovca</a>
						</div>

						<div class="all-posts">
							<a href="#">Vsi oglasi trgovca</a>
						</div>

					</div>

					<div class="banner"></div>

					<div class="tile post-info">
						<ul>
							<li><i class="fas fa-check-circle"></i> Objavljeno: <strong>10.2.2021 ob 21:53</strong></li>
							<li><i class="fas fa-clock"></i> Oglas poteče: <strong>10.3.2021</strong></li>
							<li><i class="fas fa-eye"></i> Število ogledov: <strong>100</strong></li>
						</ul>
					</div>

					<div class="banner small"></div>

				</div>

			</div>

		</div>

		<div id="modal-message" class="modal">
			<div class="content">
				<div class="message-content">
					<h2>Pošljite sporočilo oglaševalcu</h2>
					<div class="email-head">
						<p>Prejemnik sporočila: <strong>Janez Novak</strong></p>
						<p>
							Zadeva: oglas na Oglasi.si -
							<strong>LCD Monitor Samsung Syncmaster 19”” WIDE, AOC E2470SWH64616469499</strong>
						</p>
					</div>
					<form class="email-form frm-inputs">
						<div class="row">
							<?php
								P::renderInput(
									'name',
									'Vpišite vaše ime',
									null,
									'Vnesite veljavno ime',
									'fw',
									'text',
									'required',
									'Ime'
								);
							?>
						</div>
						<div class="row">
							<?php
								P::renderInput(
									'email',
									'Vpišite vaš e-poštni naslov',
									null,
									'Vnesite veljaven e-poštni naslov',
									'fw',
									'email',
									'required',
									'E-pošta'
								);
							?>
						</div>
						<div class="row">
							<?php
								P::renderInput(
									'msg',
									'Napišite, kaj želite vprašati trgovca',
									null,
									'Vnesite veljavno sporočilo',
									'fw',
									'textarea',
									'required',
									'Sporočilo',
								);
							?>
						</div>
						<div class="row">
							<?php P::renderCaptcha(); ?>
						</div>
						<div class="row">
							<div class="row-last-btns">
								<a class="btn oval white brd modal-close">Prekliči</a>
								<a class="btn blue oval">Pošlji sporočilo</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>


		<div id="modal-report" class="modal">
			<div class="content">
				<div class="message-content">
					<div class="head"><h2>Prijavi zlorabo</h2></div>
					<form class="email-form frm-inputs">
						<div class="row">
							<?php
								P::renderInput(
									'msg',
									'Napišite razloga zlorabe oglasa',
									null,
									'Vnesite veljaven razlog',
									'fw',
									'textarea',
									'required',
									'Sporočilo',
								);
							?>
						</div>
						<div class="row">
							<?php P::renderCaptcha(); ?>
						</div>
						<div class="row">
							<div class="row-last-btns">
								<a class="btn oval white brd modal-close">Prekliči</a>
								<a class="btn blue oval">Prijavi zlorabo</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div id="modal-map" class="modal modal-map">
			<div class="content">
				<div id="map" data-lat="46.5576439" data-lng="15.6455854"></div>
			</div>
		</div>

		<script src="/assets/js/pages/post.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initModalMap&v=weekly"></script>
		<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/lightgallery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/plugins/zoom/lg-zoom.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/plugins/thumbnail/lg-thumbnail.min.js"></script>

		<?php P::renderFooter(); ?>

	</body>
</html>
