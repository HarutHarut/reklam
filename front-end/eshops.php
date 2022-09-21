<?php

	use Page\PageComponents as P;

	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
	P::initPage('Seznam trgovin', 'Lorem ipsum');
	P::addCss('/assets/css/pages/eshops.css');


	function renderResultExample($active = false) {
		echo '<div class="result flx ' . ($active ? 'colored' : '') . '">
				<div class="img"><img src="https://i.imgur.com/S7C37j6.png"></div>
				<div class="bio">
					<div class="upper flx">
						<div class="general">
							<h3>
								<a href="/trgovina/">KA d.o.o., osebno svetovanje pri osebnih financah </a>
							</h3>
							<ul class="props">
								<li><i class="fas fa-info-circle"></i> Vodilni na področju nadzora vode in drugih tekočin</li>
								<li><i class="fas fa-map-marker-alt"></i> Sveti Trije Kralji v Slovenskih Goricah</li>
							</ul>
						</div>
						<div class="meta flx">
							<strong class="post-count">Število oglasov: 15</strong>
							<a href="#" class="btn oval">Spletna trgovina <i class="fas fa-shopping-cart"></i></a>
						</div>
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

			<div class="intro-banner flx">
				<div class="banner"></div>
			</div>

			<?php
				P::renderBreadcrumbs([
					['Domača stran', '/'],
					['Poslovni uporabniki', '#'],
				]);
			?>

			<div class="sublinks-box tile">
				<h1>Poslovni uporabniki</h1>
				<ul class="flx">
					<li>
						<a href="#"><strong>Računalniki</strong><span>82</span></a>
					</li>
					<li>
						<a href="#"><strong>Računalniki</strong><span>120</span></a>
					</li>
					<li>
						<a href="#"><strong>Monitorji</strong><span>82</span></a>
					</li>
					<li>
						<a href="#"><strong>Miške, tipkovnice</strong><span>3</span></a>
					</li>

					<li>
						<a href="#"><strong>Računalniki</strong><span>82</span></a>
					</li>
					<li>
						<a href="#"><strong>Računalniki</strong><span>120</span></a>
					</li>
					<li>
						<a href="#"><strong>Monitorji</strong><span>82</span></a>
					</li>
					<li>
						<a href="#"><strong>Miške, tipkovnice</strong><span>3</span></a>
					</li>

					<li>
						<a href="#"><strong>Računalniki</strong><span>82</span></a>
					</li>
					<li>
						<a href="#"><strong>Računalniki</strong><span>120</span></a>
					</li>
					<li>
						<a href="#"><strong>Monitorji</strong><span>82</span></a>
					</li>
					<li>
						<a href="#"><strong>Miške, tipkovnice</strong><span>3</span></a>
					</li>

					<li>
						<a href="#"><strong>Računalniki</strong><span>82</span></a>
					</li>
					<li>
						<a href="#"><strong>Računalniki</strong><span>120</span></a>
					</li>
					<li>
						<a href="#"><strong>Monitorji</strong><span>82</span></a>
					</li>
				</ul>
			</div>

			<div class="flx shop-divide">
				<div class="left banners">
					<div class="banner"></div>
					<div class="banner"></div>
				</div>

				<div class="right">

					<div class="sort-by flx">
						<div class="search">
							<input type="text" placeholder="Išči med 1784 trgovinami.."/><i class="far fa-search fa-flip-horizontal"></i>
						</div>
						<p>Število rezultatov: 8451</p>
						<select class="select" name="sort" data-placeholder="Razvrsti trgovine">
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