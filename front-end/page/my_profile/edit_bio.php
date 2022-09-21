<?php

	use Page\PageComponents as P;

	if(!isset($profilePage)) die;
	P::initPage('Urejanje profila', 'Lorem ipsum');
	$profilePageSeg = 'edit_bio';
?>

<div class="page-heading flx">
	<h1>Urejanje <span>profila</span></h1>
</div>

<div class="profile-edit-tile">
	<form class="content frm-inputs">

		<?php if(P::isCompanyLoggedIn()) { ?>
			<div class="profile-edit-tile-sub">

				<div class="seg">
					<h3>Logotip podjetja</h3>
					<div class="profile-logo flx">
						<div class="img">
							<label><input type="file"/>
								<a><i class="fas fa-pen"></i></a>
							</label>
						</div>
						<p>Priporočen format datoteke .png in velikost...</p>
					</div>
				</div>

				<div class="seg">
					<h3>Naslovna slika profila</h3>
					<div class="profile-cover">
						<p>
							<i class="fas fa-info-circle"></i> Primerno za oglaševalni material ali predstavitev vašega podjetja. Prikazano uporabnikom, ki obiščejo stran z vašimi oglasi.
						</p>
						<div class="flx">
							<label> <input type="file"/>
								<span class="btn blue oval">Izberi datoteko <i class="fas fa-camera"></i></span>
							</label>
							<p>
								Priporočen format datoteke .jpg, .png in velikost.....
							</p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="seg">
			<h3>Podatki uporabniškega računa</h3>
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
		</div>


		<div class="seg">
			<h3 class="gap">Kontaktni podatki</h3>
			<div class="row">
				<?php
					P::renderInput(
						'name',
						'Ime',
						'fas fa-user',
						'Vnesite veljavno ime',
						'',
						'text',
						'required'
					);
				?>
				<?php
					P::renderInput(
						'surname',
						'Priimek',
						'fas fa-user',
						'Vnesite veljaven priimek',
						'',
						'text',
						'required'
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
						'required'
					);
				?>
			</div>
			<div class="row">
				<?php
					P::renderInput(
						'contact_email',
						'Kontaktni e-poštni naslov',
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
						'city',
						'Vpišite mesto',
						'fas fa-envelope',
						'Vnesite veljavno mesto',
						'fw',
						'text',
						'required'
					);
				?>
			</div>

			<div class="row indent"><?php P::renderCheckbox('show_city', 'Prikaži mesto v oglasih in na strani profila'); ?></div>

			<div class="row">
				<select class="select" name="region" data-placeholder="Izberite vašo regijo" data-icon="envelope">
					<option value="1">Podravska</option>
					<option value="2">Savinjska</option>
				</select>
			</div>
		</div>

		<button class="btn blue oval fw save">Shrani vse spremembe</button>

		<a id="profile-delete"><i class="fas fa-info-circle"></i>Izbriši račun in vse oglase</a>
	</form>
</div>
