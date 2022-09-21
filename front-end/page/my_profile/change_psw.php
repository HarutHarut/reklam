<?php

	use Page\PageComponents as P;

	if(!isset($profilePage)) die;
	P::initPage('Sprememba gesla', 'Lorem ipsum');
	$profilePageSeg = 'edit_bio';
?>

<div class="page-heading flx">
	<h1>Sprememba <span>gesla</span></h1>
</div>

<div class="profile-edit-tile">
	<form class="content frm-inputs">


		<div class="seg">
			<h3>Potrditev gesla</h3>
			<div class="row">
				<?php
					P::renderInput(
						'existing',
						'Obstoječe geslo',
						'fas fa-lock',
						'Vnesite veljavno uporabniško geslo',
						'fw',
						'text',
						'required'
					);
				?>
			</div>
		</div>


		<div class="seg">
			<h3 class="">Novo geslo</h3>
			<div class="row">
				<?php
					P::renderInput(
						'new_1',
						'Novo geslo',
						'fas fa-lock',
						'Vnesite veljavno uporabniško geslo',
						'fw',
						'text',
						'required'
					);
				?>
			</div>
			<div class="row">
				<?php
					P::renderInput(
						'new_2',
						'Potrditev novega gesla',
						'fas fa-lock',
						'Vnesite geslo, ki se ujema z zgornjim',
						'fw',
						'text',
						'required'
					);
				?>
			</div>
		</div>

		<button class="btn blue oval fw save">Potrdi spremembo gesla</button>

	</form>
</div>
