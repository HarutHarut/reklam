<?php

	use Page\PageComponents as P;

	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
	P::initPage('Seznam oglasov', 'Lorem ipsum');
	P::addCss('/assets/css/pages/category.css');

	P::addJs('https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js');
	P::addCss('https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css');

	function renderResultExample($active = false) {
		echo '<div class="result flx ' . ($active ? 'colored' : '') . '">
				<div class="img"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNclgYAAbgBDtCPvQwAAAAASUVORK5CYII="></div>
				<div class="bio">
					<div class="upper flx">
						<div class="general">
							<h3>
								<a href="/oglas/">Prenosni računalnik HP G450 malo rabljen</a>
							</h3>
							<ul class="props">
								<li><i class="fas fa-info-circle"></i> Rabljeno</li>
								<li><i class="fas fa-map-marker-alt"></i> Sveti Trije Kralji v Slovenskih Goricah</li>
								<li>*še neka “special” lastnost</li>
							</ul>
						</div>
						<div class="meta flx">
							<strong class="price">560 €</strong>
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
	<body class="orange">
		<?php P::renderHeader(); ?>

		<div class="cw">

			<div class="intro-banner flx">
				<div class="banner"></div>
			</div>

			<?php
				P::renderBreadcrumbs([
					['Tehnika', '#'],
					['Računalništvo', '#'],
				]);
			?>

			<div class="sublinks-box tile np">
				<h1 class="bgt">Računalništvo</h1>
				<ul class="flx">
					<li>
						<a href="#"><strong>Računalniki</strong><span class="bgt">82</span></a>
					</li>
					<li>
						<a href="#"><strong>Računalniki</strong><span class="bgt">120</span></a>
					</li>
					<li>
						<a href="#"><strong>Monitorji</strong><span class="bgt">82</span></a>
					</li>
					<li>
						<a href="#"><strong>Miške, tipkovnice</strong><span class="bgt">3</span></a>
					</li>

					<li>
						<a href="#"><strong>Računalniki</strong><span class="bgt">82</span></a>
					</li>
					<li>
						<a href="#"><strong>Računalniki</strong><span class="bgt">120</span></a>
					</li>
					<li>
						<a href="#"><strong>Monitorji</strong><span class="bgt">82</span></a>
					</li>
					<li>
						<a href="#"><strong>Miške, tipkovnice</strong><span class="bgt">3</span></a>
					</li>

					<li>
						<a href="#"><strong>Računalniki</strong><span class="bgt">82</span></a>
					</li>
					<li>
						<a href="#"><strong>Računalniki</strong><span class="bgt">120</span></a>
					</li>
					<li>
						<a href="#"><strong>Monitorji</strong><span class="bgt">82</span></a>
					</li>
					<li>
						<a href="#"><strong>Miške, tipkovnice</strong><span class="bgt">3</span></a>
					</li>

					<li>
						<a href="#"><strong>Računalniki</strong><span class="bgt">82</span></a>
					</li>
					<li>
						<a href="#"><strong>Računalniki</strong><span class="bgt">120</span></a>
					</li>
					<li>
						<a href="#"><strong>Monitorji</strong><span class="bgt">82</span></a>
					</li>
				</ul>
			</div>

			<div class="flx shop-divide">
				<div class="left post-filters np">
					<h2><i class="fal fa-sliders-h"></i> Dodatni kriteriji</h2>

					<div class="filter open">
						<h3 class="flx">Regija <i class="far fa-chevron-down"></i></h3>
						<div class="filter-scroll">
							<ul class="filter-checklist">
								<li>
									<label><input type="checkbox"><span class="text">LJ - Osrednjeslovenska<i class="far fa-times"></i></span></label>
								</li>
								<li>
									<label><input type="checkbox"><span class="text">MB - Podravska<i class="far fa-times"></i></span></label>
								</li>
								<li>
									<label><input type="checkbox"><span class="text">CE - Savinjska<i class="far fa-times"></i></span></label>
								</li>
								<li>
									<label><input type="checkbox"><span class="text">KR - Gorenjska<i class="far fa-times"></i></span></label>
								</li>
								<li>
									<label><input type="checkbox"><span class="text">GO - Severna Primporska<i class="far fa-times"></i></span></label>
								</li>
							</ul>
						</div>
					</div>

					<div class="filter">
						<h3 class="flx">Vrsta ponudbe <i class="far fa-chevron-down"></i></h3>
						<div class="filter-scroll">
						</div>
					</div>

					<div class="filter open">
						<h3 class="flx">Cena <i class="far fa-chevron-down"></i></h3>
						<div class="filter-scroll">
							<div class="filter-range">

								<input
										type="hidden"
										class="rangeslider"
										name="price"
										value=""
										data-type="double"
										data-min="0"
										data-max="1000"
										data-from="0"
										data-to="1000"/>

								<div class="range-input flx">
									<input type="text" class="range-input-from" value="0"/> -
									<input type="text" class="range-input-to" value="1000"/> €
								</div>

							</div>
						</div>
					</div>

					<div class="filter">
						<h3 class="flx">Starost oglasa <i class="far fa-chevron-down"></i></h3>
						<div class="filter-scroll">
						</div>
					</div>

					<div id="filter-controls" class="filter tc">
						<button class="btn oval update bgt">Posodobi filter</button>
					</div>

					<div class="banner"></div>

					<div class="sponsored-shop">
						<div class="shop">
							<img src="https://i.imgur.com/rEtylvK.png">
							<p>Pintera d.o.o.</p>
						</div>
						<a href="#">Oglasi trgovca</a>
					</div>

					<div class="sponsored-shop">
						<div class="shop">
							<img src="https://i.imgur.com/Gmn2C0t.png">
							<p>Hemp light sp.</p>
						</div>
						<a href="#">Oglasi trgovca</a>
					</div>

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
						<a href="#" class="active bgt">3</a>
						<a href="#">4</a>
						<a href="#" class="text">Naslednja stran <i class="far fa-chevron-right"></i></a>
					</div>

					<div class="post-results">
						<?php renderResultExample(true); ?>
						<div class="result-banner flx">
							<div class="banner"></div>
						</div>
						<?php for($i = 0; $i < 5; $i++) renderResultExample(false); ?>
						<div class="result-banner flx">
							<div class="banner"></div>
						</div>
					</div>

					<div class="pagination flx">
						<a href="#" class="text"><i class="far fa-chevron-left"></i> Prejšnja stran</a>
						<a href="#">1</a>
						<a href="#">2</a>
						<a href="#" class="active bgt">3</a>
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
