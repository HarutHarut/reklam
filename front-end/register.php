<?php

	use Page\PageComponents as P;

	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
	P::initPage('Registracija', 'Lorem ipsum');
	P::addCss('/assets/css/pages/register.css');

	//User is already logged in, redirect to index
	if(P::isUserLoggedIn()) {
		header('location:/');
		die;
	}

?>


<!DOCTYPE html>
<html lang="sl">
	<?php P::renderHead(); ?>
	<body>
		<?php P::renderHeader(); ?>

		<div class="cw">

			<div class="page-heading flx">
				<h1>Postanite uporabnik <span>Oglasi.si</span></h1>
				<p>
					<i class="fas fa-info-circle"></i> Že imate račun?
					<a class="lnk" data-modal="modal-login">Prijava</a>
				</p>
			</div>

			<div id="reg-container" class="tile" data-type="1">

				<div id="reg-type" class="flx center">
					<div class="indicator"></div>
					<div class="type active first">
						<i class="fas fa-user"></i> <strong>Posameznik</strong>
					</div>
					<div class="type last">
						<i class="fas fa-user-tie"></i> <strong>Podjetje</strong>
					</div>
				</div>

				<div id="reg-user">

					<p>
						<span class="for-type-1 tc fw">Registracija in oglaševanje je za <strong>posameznike brezplačna</strong>.</span>
						<span class="for-type-2 fw">
							Registracija in oglaševanje do <strong>5 objavljenih oglasov</strong> je za pravne osebe <strong>brezplačno</strong>.
							<br><br>
							<a href="/oglasevanje-in-ceniki/">Več o prednostih oglaševanja na Oglasi.si ter cenik paketov.</a>
						</span>
					</p>

					<div class="tc ext-logins">
						<a class="btn oval fb"><i class="fab fa-facebook"></i> Registracija s Facebook</a>
						<a class="btn oval google"><img src="/assets/res/ico/google.svg"> Registracija z Google</a>
					</div>

					<div class="sep"><strong>Ali se registrirajte</strong></div>

					<form class="frm-inputs" onsubmit="return false;" data-step="0">

						<input type="hidden" value="0" name="user_type"/>

						<div class="progress flx">
							<div class="step active">
								<strong>Podatki uporabniškega računa</strong> <i class="fa fa-check"></i>
							</div>
							<div class="step">
								<strong>Kontaktni podatki</strong> <i class="fa fa-check"></i>
							</div>
						</div>

						<div class="steps">
							<div class="step">
								<div class="row">
									<?php
										P::renderInput(
											'username',
											'Uporabniško ime',
											'fas fa-user',
											'Vnesite veljavno uporabniško ime',
											'fw',
											'text',
											'required'
										);
									?>
								</div>
								<div class="row">
									<?php
										P::renderInput(
											'email',
											'E-poštni naslov',
											'fas fa-envelope',
											'Vnesite veljaven e-poštni naslov',
											'fw',
											'email',
											'required'
										);
									?>
								</div>
								<div class="row">
									<?php
										P::renderInput(
											'password',
											'Prijavno geslo',
											'fas fa-lock',
											'Vnesite veljavno geslo',
											'fw',
											'password',
											'required'
										);
									?>
								</div>

								<div class="row wrap">
									<div class="fw"><?php P::renderCheckbox('tos', 'Strinjam se s <a href="#" target="_blank" class="lnk">pogoji in pravili uporabe Oglasi.si</a>', '1', true); ?></div>
								</div>

								<a class="btn oval blue fw next">Potrdi in nadaljuj</a>
							</div>

							<div class="step">
								<div class="row">
									<?php
										P::renderInput(
											'vat',
											'Davčna številka',
											'fas fa-pencil',
											'Vnesite veljavno davčno številko',
											'',
											'text',
											'required="required" pattern="^((AT)?U[0-9]{8}|(BE)?0[0-9]{9}|(BG)?[0-9]{9,10}|(CY)?[0-9]{8}L|(CZ)?[0-9]{8,10}|(DE)?[0-9]{9}|(DK)?[0-9]{8}|(EE)?[0-9]{9}|(EL|GR)?[0-9]{9}|(ES)?[0-9A-Z][0-9]{7}[0-9A-Z]|(FI)?[0-9]{8}|(FR)?[0-9A-Z]{2}[0-9]{9}|(GB)?([0-9]{9}([0-9]{3})?|[A-Z]{2}[0-9]{3})|(HU)?[0-9]{8}|(IE)?[0-9]S[0-9]{5}L|(IT)?[0-9]{11}|(LT)?([0-9]{9}|[0-9]{12})|(LU)?[0-9]{8}|(LV)?[0-9]{11}|(MT)?[0-9]{8}|(NL)?[0-9]{9}B[0-9]{2}|(PL)?[0-9]{10}|(PT)?[0-9]{9}|(RO)?[0-9]{2,10}|(SE)?[0-9]{12}|(SI)?[0-9]{8}|(SK)?[0-9]{10})$"'
										);
									?>
								</div>
								<div class="row">
									<?php
										P::renderInput(
											'company_name',
											'Naziv podjetja',
											'fas fa-briefcase',
											'Vnesite veljaven naziv podjetja',
											'',
											'text',
											'required="required"'
										);
									?>
								</div>
								<div class="row">
									<?php
										P::renderInput(
											'company_addr',
											'Naslov sedeža podjetja',
											'fas fa-map-marker-alt',
											'Vnesite veljaven naslov',
											'',
											'text',
											'required="required"'
										);
									?>
								</div>
								<div class="row">
									<?php
										P::renderInput(
											'company_addr_post',
											'Poštna številka',
											'fas fa-map-marker-alt',
											'Vnesite veljavno poštno številko',
											'',
											'text',
											'required="required" pattern="^[0-9]{4}$"'
										);
									?>
								</div>
								<div class="row">
									<?php
										P::renderInput(
											'phone',
											'Telefonska številka',
											'fas fa-phone-alt',
											'Vnesite veljaveno telefonsko številko',
											'fw',
											'phone',
											'required="required" onkeyup="$(this).val($(this).val().replace(\' \', \'\').replace(\'-\', \'\'));" pattern="\d{8,10}"'
										);
									?>
								</div>

								<a class="btn oval blue fw next last">Zaključi registracijo</a>
							</div>
							<div class="step success">
								<i class="far fa-check flx center"></i> <strong>Registracija uspešna!</strong>
								<p>Potrditveno sporočilo je bilo poslano na vaš e-poštni naslov.</p>
							</div>
						</div>

					</form>
				</div>

			</div>
		</div>

		<script src="/assets/js/pages/register.js"></script>

		<?php P::renderFooter(); ?>
	</body>
</html>
