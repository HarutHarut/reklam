<?php

	//Prevent direct access
	if(!defined('ROOT')) die;

	use Page\PageComponents as P;

?>

<div id="footer-container" class="<?php echo !P::$hasFooterMargin ? 'no-margin' : ''; ?>">
	<div class="cw">
		<div id="footer" class="flx">
			<div class="seg">
				<h3>Kategorije oglasov</h3>
				<ul>
					<li>
						<a href="#">Avtomobili, vozila</a>
					</li>
					<li>
						<a href="#">Tehnologija</a>
					</li>
					<li>
						<a href="#">Vse za dom</a>
					</li>
					<li>
						<a href="#">Materiali, oprema</a>
					</li>
					<li>
						<a href="#">Kmetijstvo</a>
					</li>
					<li>
						<a href="#">Stroji, orodja</a>
					</li>
					<li>
						<a href="#">Šport, navtika</a>
					</li>
					<li>
						<a href="#">Storitve, delo</a>
					</li>
					<li>
						<a href="#">Zasebni stiki</a>
					</li>
				</ul>
			</div>
			<div class="seg">
				<h3>Oglasi.si</h3>
				<ul>
					<li>
						<a href="#">O nas</a>
					</li>
					<li>
						<a href="/pogosta-vprasanja/">Pogosta vprašanja</a>
					</li>
					<li>
						<a href="#">Kontakt</a>
					</li>
					<li>
						<a href="#">Pogoji uporabe</a>
					</li>
					<li>
						<a href="#">Varovanje osebnih podatkov</a>
					</li>
				</ul>
			</div>
			<div class="seg">
				<h3>Poslovni partnerji</h3>
				<ul>
					<li>
						<a href="#">Oglaševanje</a>
					</li>
					<li>
						<a href="#">Vsi poslovni partnerji</a>
					</li>
				</ul>
			</div>
			<div class="seg">
				<h3>Spletna trgovina</h3>
			</div>
			<div class="seg">
				<a id="footer-fb" href="#">Spremljajte nas <i class="fab fa-facebook"></i></a>
			</div>

			<div id="footer-contact-circle" class="flx center">
				<h4>Podpora uporabnikom:</h4>
				<div class="contact">
					<a href="tel:041886000" class="flx"><i class="fas fa-phone fa-flip-horizontal"></i> 041 886 000
					</a>
					<p>PON - PET: 8:00 - 14:00</p>
					<a href="mailto:info@oglasi.si" class="flx"><i class="fas fa-envelope"></i> info@oglasi.si</a>
					<p>VSAK DAN: 00:00 - 24:00</p>
				</div>
				<a href="#" class="btn blue oval">Pogosta vprašanja</a>
			</div>

		</div>
		<div id="socket">
			© Oglasi.si. Vse pravice pridržane.
		</div>
	</div>
	<script src="/assets/js/imgpnl.js"></script>
	<script src="/assets/js/jui/jquery-ui.min.js"></script>
</div>

<?php if(!isset($_COOKIE['cookies_agreed'])) { ?>
	<div id="cookies-disc">
		<div class="cw flx">
			<div class="content">
				<h3>Uporaba piškotkov na Oglasi.si</h3>
				<p>To spletno mesto uporablja piškotke. Če se z uporabo strinjate nadaljujte brskanje s klikom na gumb “Dovoli”. V kolikor nadaljujete z ogledom spletnega mesta bodo nastavljeni piškotki, ki so nujno potrebni za delovanje spletnega mesta.</p>
			</div>
			<a class="btn oval white">Dovoli piškotke</a>
		</div>
	</div>
	<script>
		$(function() {
			$('#cookies-disc a').click(function() {
				Cookies.set('cookies_agreed', '1', {expires: 800});
				$('#cookies-disc').fadeOut(100);
			});
		});
	</script>
<?php } ?>
