<?php

	use Page\PageComponents as P;

	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
	P::initPage('Pogosta vprašanja', 'Lorem ipsum');
	P::addCss('/assets/css/pages/page.css');

?>


<!DOCTYPE html>
<html lang="sl">
	<?php P::renderHead(); ?>
	<body>
		<?php P::renderHeader(); ?>

		<div class="cw">

			<div class="page-heading flx">
				<h1>Oglaševanje in ceniki</h1>
			</div>

			<div id="subpage-container" class="flx">
				<div id="subpage">
					<div class="content tile">
						<h2>Oglaševanje za pravne osebe</h2>

						<div class="heading-pin">
							<span>1.</span>
							<h3>Zakaj odpreti e-trgovino na Oglasi.si?</h3>
						</div>

						<p class="brd">
							Spletno e-trgovino na Oglasi.si lahko odprejo le pravne osebe. Omogoča vam hitro, učinkovito in cenovno ugodno povečanje obsega vaših potencialnih kupcev ter prepoznavnosti. Za oglaševanje na Oglasi.si se najprej opravi
							<a href="/registracija/" class="lnk">registracije podjetja</a>
							. Tekom hitrega postopka registracije pridobite profil za oglaševanje.
						</p>

						<div class="heading-pin">
							<span>2.</span>
							<h3>Cenik oglaševanja za pravne osebe</h3>
						</div>

						<p>
							Pravnim osebam je na voljo oddaja
							<em>do 5 oglasov brezplačno</em>. Za oddajo večjega števila oglasov sta na voljo paketa
							<em>MAXI</em> in <em>PROFI</em>.
							<br><br> Pri zakupu plačljivih paketov je omogočena funkcija enkratne objave oglasa, ki je lahko objavljen ves čas trajanja zakupovanja paketa ( trajanje oglasa). V primeru nepodaljšanja paketa za oglaševanje pravnih oseb se obstoječi objavljeni oglasi pravne osebe deaktivirajo, vendar se iz uporabniškega profila ne izbrišejo - po ponovnem zakupu paketa se lahko ponovno aktivira oglase, da bodo vidni potencialnim strankam.
						</p>


						<div class="pricing-boxes flx">

							<div class="box">
								<i class="far fa-gem"></i>
								<h4>Paket MINI</h4>
								<div class="prices">
									<div class="price"><strong>Brezplačno</strong></div>
								</div>
								<ul class="l1">
									<li><i class="fas fa-check-circle"></i> <strong>5</strong> oglasov</li>
									<li><i class="fas fa-check-circle"></i> Oglas objavljen 30 dni</li>
								</ul>
								<ul class="l2">
									<li><i class="far fa-times-circle"></i> Pregled statistike</li>
								</ul>
							</div>


							<div class="box">
								<i class="far fa-gem"></i>
								<h4>Paket MAXI</h4>
								<div class="prices">
									<div class="price"><strong>19,90 €</strong> / mesec</div>
									<div class="price"><strong>39,90 €</strong> / 3 mesece</div>
									<div class="price"><strong>99,90 €</strong> / 12 mesecev</div>
								</div>
								<ul class="l1">
									<li><i class="fas fa-check-circle"></i> <strong>50</strong> oglasov</li>
									<li>
										<i class="fas fa-check-circle"></i>
										<strong class="inf">∞</strong> trajanje oglasov
									</li>
								</ul>
								<ul class="l2">
									<li><i class="fas fa-check-circle"></i> Pregled statistike</li>
								</ul>
							</div>

							<div class="box">
								<i class="far fa-gem"></i>
								<h4>Paket PROFI</h4>
								<div class="prices">
									<div class="price"><strong>39,90 €</strong> / mesec</div>
									<div class="price"><strong>79,90 €</strong> / 3 mesece</div>
									<div class="price"><strong>199,90 €</strong> / 12 mesecev</div>
								</div>
								<ul class="l1">
									<li>
										<i class="fas fa-check-circle"></i> <strong class="inf">∞</strong> oglasov
									</li>
									<li>
										<i class="fas fa-check-circle"></i>
										<strong class="inf">∞</strong> trajanje oglasov
									</li>
								</ul>
								<ul class="l2">
									<li><i class="fas fa-check-circle"></i> Pregled statistike</li>
									<li><i class="fas fa-check-circle"></i> Vključen XML izvoz</li>
								</ul>
							</div>


						</div>

						<h2>Oglaševanje za fizične osebe</h2>


						<div class="heading-pin">
							<span>1.</span>
							<h3>Kdaj je oglaševanje za fizične osebe plačljivo? </h3>
						</div>

						<p class="brd">
							Oglaševanje za posameznike oz. fizične osebe je na Oglasi.si brezplačno.
							<br><br>V primeru oglaševanja v plačljivi kategoriji
							<em>ZASEBNI STIKI</em> je na voljo plačilo za objavo posameznega oglasa, objavljenega 30 dni za 4,99 € oz. lahko izbirate med ponudbo paketov, ki jih lahko zakupite za obdobje meseca dni, 3 mesece ali 12 mesecev.
						</p>

						<div class="heading-pin">
							<span>2.</span>
							<h3>Cenik oglaševanja za fizične osebe</h3>
						</div>

						<p>
							Cenik oglaševanja za fizične osebe velja le v primeru, da je izbrana kategorija plačljiva.
						</p>

						<div class="pricing-boxes flx">

							<div class="box">
								<i class="far fa-gem"></i>
								<h4>Paket 1 MESEC</h4>
								<div class="prices">
									<div class="price"><strong>Brezplačno</strong></div>
								</div>
								<ul class="l1">
									<li><i class="fas fa-check-circle"></i> <strong>5</strong> oglasov</li>
									<li><i class="fas fa-check-circle"></i> Oglas objavljen 30 dni</li>
								</ul>
								<ul class="l2">
									<li><i class="far fa-times-circle"></i> Pregled statistike</li>
								</ul>
							</div>


							<div class="box">
								<i class="far fa-gem"></i>
								<h4>Paket 3 MESECI</h4>
								<div class="prices">
									<div class="price"><strong>19,90 €</strong> / mesec</div>
									<div class="price"><strong>39,90 €</strong> / 3 mesece</div>
									<div class="price"><strong>99,90 €</strong> / 12 mesecev</div>
								</div>
								<ul class="l1">
									<li><i class="fas fa-check-circle"></i> <strong>50</strong> oglasov</li>
									<li>
										<i class="fas fa-check-circle"></i>
										<strong class="inf">∞</strong> trajanje oglasov
									</li>
								</ul>
								<ul class="l2">
									<li><i class="fas fa-check-circle"></i> Pregled statistike</li>
								</ul>
							</div>

							<div class="box">
								<i class="far fa-gem"></i>
								<h4>Paket 12 MESECEV</h4>
								<div class="prices">
									<div class="price"><strong>39,90 €</strong> / mesec</div>
									<div class="price"><strong>79,90 €</strong> / 3 mesece</div>
									<div class="price"><strong>199,90 €</strong> / 12 mesecev</div>
								</div>
								<ul class="l1">
									<li>
										<i class="fas fa-check-circle"></i> <strong class="inf">∞</strong> oglasov
									</li>
									<li>
										<i class="fas fa-check-circle"></i>
										<strong class="inf">∞</strong> trajanje oglasov
									</li>
								</ul>
								<ul class="l2">
									<li><i class="fas fa-check-circle"></i> Pregled statistike</li>
									<li><i class="fas fa-check-circle"></i> Vključen XML izvoz</li>
								</ul>
							</div>


						</div>

					</div>

					<div class="help flx sub-tile tile">
						<strong>Imate dodatno vprašanje?</strong>
						<div class="option">
							<a href="#"><i class="fas fa-phone fa-flip-horizontal"></i> 041 886 000</a>
							<p>PON - PET: 8:00 - 14:00</p>
						</div>
						<div class="option">
							<a href="#"><i class="fas fa-envelope"></i> info@oglasi.si</a>
							<p>VSAK DAN: 00:00 - 24:00</p>
						</div>
					</div>

					<div class="create-post sub-tile tile">
						<p>Želite oddati nov oglas?</p>
						<a class="btn oval blue" href="/nov-oglas/">Oddaj oglas <i class="far fa-plus"></i></a>
					</div>

				</div>

				<div id="subpage-banner">
					<div class="banner"></div>
				</div>

			</div>
		</div>

		<?php P::renderFooter(); ?>
	</body>
</html>
