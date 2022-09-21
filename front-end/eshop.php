<?php

	use Page\PageComponents as P;

	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
	P::initPage('Trgovina', 'Lorem ipsum');
	P::addCss('/assets/css/pages/eshop.css');


	function renderResultExample($active = false) {
		echo '<div class="result flx ' . ($active ? 'colored' : '') . '">
				<div class="img"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNclgYAAbgBDtCPvQwAAAAASUVORK5CYII="></div>
				<div class="bio">
					<div class="upper flx">
						<div class="general">
							<h3>
								<a href="/oglas/">PowerMac G5 Apple računalnik</a>
							</h3>
							<ul class="props">
								<li><i class="fas fa-info-circle"></i> Novo</li>
								<li><i class="fas fa-map-marker-alt"></i> Maribor</li>
							</ul>
						</div>
						<div class="meta flx">
							<strong class="price">Pokličite za ceno</strong>
							<div class="logo"><img src="https://i.imgur.com/TrKgxgE.png"></div>
						</div>
					</div>
					<div class="lower flx">
						<p>Objavljeno 10.2.2021</p>
						<a class="save ' . ($active ? 'active' : '') . '"><i class="fa fa-bookmark"></i></a>
					</div>
				</div>
			</div>';
	}

?>


<!DOCTYPE html>
<html lang="sl">
	<?php P::renderHead(); ?>
	<body>
		<?php P::renderHeader(); ?>

		<div class="cw">

			<div id="eshop-bio">
				<div class="cover"></div>
				<div class="bio tile flx">
					<div class="left">
						<div class="logo">
							<img src="https://i.imgur.com/csfOSA5.png">
						</div>
						<div class="info">
							<ul>
								<li class="location">
									<i class="fas fa-map-marker-alt"></i> Naziv firme<br>Mariborska ulica 13 b<br>2000 Maribor<br>MB - Podravska
								</li>
								<li>
									<i class="fas fa-phone fa-flip-horizontal"></i>
									<a href="#">041 000 000</a>
								</li>
								<li>
									<i class="fas fa-envelope"></i>
									<a href="#">janez.novak@sema-soft.com</a>
								</li>
								<li>
									<i class="fas fa-external-link"></i>
									<a href="#">www.spletnastran.com</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="right">
						<div class="head flx">
							<div class="title">
								<h1>Uporabniško ime / naziv firme</h1>
								<p>Zanesljiva izbira</p>
							</div>
							<div class="social">
								<a href="#"><i class="fab fa-facebook"></i></a>
								<a href="#"><i class="fab fa-instagram"></i></a>
								<a href="#"><i class="fab fa-linkedin-in"></i></a>
							</div>
						</div>

						<div class="description">
							<p>
								<strong>Uradno zastopstvo za Sema GmbH, program za lesene konstrukcije, stopnice, oblaganje fasad in ostrešij, lesene terase. </strong>
							</p>
							<br>
							<p>Delovni čas: 8:00 - 17:00</p>
							<p>Način prevzema in dostave: po dogovoru ali preko pošte</p>
						</div>

						<div class="date-registered">
							Uporabnik od 21.11.2015
						</div>
					</div>
				</div>
			</div>

			<div class="flx shop-divide">
				<div class="left banners small">
					<div class="banner"></div>
				</div>

				<div class="right">

					<div class="sort-by flx">
						<p>Število rezultatov: 8451</p>
						<select class="select" name="sort" data-placeholder="Razvrsti oglase">
							<option></option>
							<option value="1">Po ceni</option>
							<option value="2">Zadnji oglasi</option>
						</select>
					</div>

					<div class="pagination flx">
						<a href="#" class="text"><i class="far fa-chevron-left"></i> Prejšnja stran</a>
						<a href="#">1</a>
						<a href="#">2</a>
						<a href="#" class="active">3</a>
						<a href="#">4</a>
						<a href="#" class="text">Naslednja stran <i class="far fa-chevron-right"></i></a>
					</div>

					<div class="post-results">
						<?php for($i = 0; $i < 6; $i++) renderResultExample(false); ?>
					</div>

					<div class="pagination flx">
						<a href="#" class="text"><i class="far fa-chevron-left"></i> Prejšnja stran</a>
						<a href="#">1</a>
						<a href="#">2</a>
						<a href="#" class="active">3</a>
						<a href="#">4</a>
						<a href="#" class="text">Naslednja stran <i class="far fa-chevron-right"></i></a>
					</div>

				</div>

			</div>

		</div>

		<script src="/assets/js/pages/category.js"></script>

		<?php P::renderFooter(); ?>
	</body>
</html>