<?php

	//Prevent direct access
	if(!defined('ROOT')) die;

	use Page\PageComponents as P;

?>

<div id="header-container">
	<div id="header-main">
		<div class="cw flx">
			<div class="logo">
				<a href="/"><img src="/assets/res/logo.svg"></a>
			</div>
			<div class="search flx">
				<input type="text" placeholder="Išči med 143889 oglasi..">
				<div class="region">
					<label class="flx center"><i class="fas fa-map-marker-alt"></i><span>Celotna Slovenija</span><i class="fal fa-chevron-down"></i>
					</label>
					<div class="region-select">
						<ul>
							<li><?php P::renderCheckbox('osrednja', 'LJ - Osrednjeslovenska', 'LJ'); ?></li>
							<li><?php P::renderCheckbox('podravska', 'MB - Podravska', 'MB'); ?></li>
							<li><?php P::renderCheckbox('savinjska', 'CE - Savinjska', 'CE'); ?></li>
							<li><?php P::renderCheckbox('gorenjska', 'KR - Gorenjska', 'KR'); ?></li>
							<li><?php P::renderCheckbox('sprimorska', 'GO - S. Primorska', 'GO'); ?></li>
							<li><?php P::renderCheckbox('jprimorska', 'KP - J. Primorska', 'KP'); ?></li>
							<li><?php P::renderCheckbox('notranjska', 'PO - Notranjska', 'PO'); ?></li>
							<li><?php P::renderCheckbox('dolenjska', 'NM - Dolenjska', 'NM'); ?></li>
							<li><?php P::renderCheckbox('pomurska', 'MS - Pomurska', 'MS'); ?></li>
							<li><?php P::renderCheckbox('koroska', 'SG - Koroška', 'SG'); ?></li>
							<li><?php P::renderCheckbox('posavksa', 'KK - Posavska', 'KK'); ?></li>
							<li><?php P::renderCheckbox('zasavska', 'TR - Zasavska', 'TR'); ?></li>
						</ul>
					</div>
				</div>
				<button><i class="far fa-search fa-flip-horizontal"></i></button>
			</div>
			<div class="add">
				<a href="/nov-oglas/" class="btn blue oval">Oddaj oglas <i class="fal fa-plus"></i></a>
			</div>
		</div>
	</div>
	<div id="header-sub">
		<div class="cw flx">
			<div class="cat-modal-el categories-toggle<?php echo P::$isCategoriesBrowserOpen ? ' force-open open' : ''; ?>">
				<?php if(P::$showCategoriesBrowser) { ?>
					<div class="cat-toggle-btn">Kategorije<?php echo P::$isIndex ? '' : ' <i class="far fa-chevron-down"></i>'; ?></div>
					<div class="categories">
						<ul>
							<li class="blue">
								<a href="/kategorija/"><i class="fas fa-car"></i>Avtomobilizem</a>
							</li>
							<li class="blue">
								<a href="#"><i class="fas fa-tv"></i>Tehnika</a>
							</li>
							<li class="orange">
								<a href="#"><i class="fas fa-home"></i>Vse za dom</a>
							</li>
							<li class="orange">
								<a href="#"><i class="fas fa-couch"></i>Materiali, oprema</a>
							</li>
							<li class="green">
								<a href="#"><i class="fas fa-tractor"></i>Kmetijstvo</a>
							</li>
							<li class="green">
								<a href="#"><i class="fas fa-hammer"></i>Stroji, orodja</a>
							</li>
							<li class="blue">
								<a href="#"><i class="fas fa-dumbbell"></i>Šport, navtika</a>
							</li>
							<li class="blue">
								<a href="#"><i class="fas fa-briefcase"></i>Storitve, delo</a>
							</li>
							<li class="red">
								<a href="#"><i class="fas fa-heart"></i>Zasebni stiki</a>
							</li>
						</ul>
					</div>
				<?php } ?>
			</div>
			<div class="options">
				<?php if(P::isUserLoggedIn()) { ?>
					<a href="/profil/">
						<i class="far fa-user"></i>Pozdravljeni, <?php echo P::$loggedInUserData['name_first']; ?>
					</a>
					<a href="/profil/shranjeno/">
						<i class="far fa-bookmark"></i>Shraneni oglasi
					</a>
				<?php } else { ?>
					<a data-modal="modal-login"><i class="far fa-user"></i>Prijava</a>
					<a><i class="far fa-bookmark"></i>Shranjeni oglasi</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div id="header-categories-browse" class="cat-modal-el">
	<div class="category">
		<div class="bio flx">
			<i class="fal fa-car blue"></i>
			<h2>Avtomobilizem</h2>
			<a href="#" class="btn oval blue">1865 oglasov</a>
		</div>
		<div class="subcategories flx">
			<ul class="flx">
				<li>
					<a href="#">Avtomobili <span>123</span></a>
				</li>
				<li>
					<a href="#">Dekoracija in potrošni material <span>123</span></a>
				</li>
				<li>
					<a href="#">Gospodinjski aparati <span>123</span></a>
				</li>
				<li>
					<a href="#">Male živali <span>123</span></a>
				</li>
				<li>
					<a href="#">Vrt in vrtni stroji <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="category">
		<div class="bio flx">
			<i class="fal fa-tv blue"></i>
			<h2>Tehnika</h2>
			<a href="#" class="btn oval blue">1865 oglasov</a>
		</div>
		<div class="subcategories flx">
			<ul class="flx">
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Dekoracija in potrošni material <span>123</span></a>
				</li>
				<li>
					<a href="#">Gospodinjski aparati <span>123</span></a>
				</li>
				<li>
					<a href="#">Male živali <span>123</span></a>
				</li>
				<li>
					<a href="#">Vrt in vrtni stroji <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="category">
		<div class="bio flx">
			<i class="fal fa-home orange"></i>
			<h2>Vse za dom</h2>
			<a href="#" class="btn oval blue">1865 oglasov</a>
		</div>
		<div class="subcategories flx">
			<ul class="flx">
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Dekoracija in potrošni material <span>123</span></a>
				</li>
				<li>
					<a href="#">Gospodinjski aparati <span>123</span></a>
				</li>
				<li>
					<a href="#">Male živali <span>123</span></a>
				</li>
				<li>
					<a href="#">Vrt in vrtni stroji <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="category"></div>
	<div class="category"></div>
	<div class="category"></div>
	<div class="category"></div>
	<div class="category"></div>
	<div class="category">
		<div class="bio flx">
			<i class="fal fa-home red"></i>
			<h2>Zasebni stiki</h2>
			<a href="#" class="btn oval blue">1865 oglasov</a>
		</div>
		<div class="subcategories flx">
			<ul class="flx">
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Dekoracija in potrošni material <span>123</span></a>
				</li>
				<li>
					<a href="#">Gospodinjski aparati <span>123</span></a>
				</li>
				<li>
					<a href="#">Male živali <span>123</span></a>
				</li>
				<li>
					<a href="#">Vrt in vrtni stroji <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
				<li>
					<a href="#">Pohištvo <span>123</span></a>
				</li>
			</ul>
		</div>
	</div>
</div>

<div id="modal-login" class="modal">
	<div class="content">
		<div class="head">
			<h2>Prijava v Oglasi.si</h2>
		</div>
		<div class="tc ext-logins">
			<a class="btn oval fb"><i class="fab fa-facebook"></i> Facebook prijava</a>
			<a class="btn oval google"><img src="/assets/res/ico/google.svg"> Google prijava</a>
		</div>
		<div class="login-oglasi">
			<div class="sep"><strong>Ali se prijavite</strong></div>
			<form class="frm-inputs" onsubmit="return false;">

				<div class="row">
					<?php
						P::renderInput(
							'email',
							'Vpišite vaš e-poštni naslov',
							'fas fa-user',
							'Vnesite veljaven e-poštni naslov',
							'fw',
							'email',
							'required'
						);
					?>
				</div>

				<div class="row last">
					<?php
						P::renderInput(
							'psw',
							'Vpišite vaše geslo',
							'fas fa-lock',
							'Vnesite veljavno gesl',
							'fw',
							'password',
							'required'
						);
					?>
				</div>

				<div class="forgotten-password">
					<a href="#">Ste pozabili geslo?</a>
				</div>

				<button class="btn oval blue fw">Prijava</button>
			</form>

			<div class="new-user">
				<p>
					Še nimate profila?
					<a href="/registracija/" class="lnk">Registracija</a>
				</p>
			</div>
		</div>
	</div>
</div>
