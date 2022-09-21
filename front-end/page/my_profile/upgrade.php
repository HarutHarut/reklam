<?php

	use Page\PageComponents as P;

	if(!isset($profilePage)) die;
	P::initPage('Nadgradi paket', 'Lorem ipsum');
	$profilePageSeg = 'subscribtion';
?>

<div class="page-heading flx">
	<h1>Nadgradnja <span>paketa</span></h1>
</div>

<div class="profile-edit-tile">
	<form class="content frm-inputs fw">
		<div class="box-container flx">

			<div class="box flx more<?php echo !P::isUserLoggedIn() ? ' disabled' : ''; ?>">
				<div class="head">
					<i class="far fa-gem"></i>
					<div class="title">Paket MAXI</div>
					<div class="price">od 19,90 €</div>
				</div>
				<ul class="l1">
					<li>
						<i class="fas fa-check-circle"></i> <strong>50 oglasov</strong> oglasov
					</li>
					<li>
						<i class="fas fa-check-circle"></i> <strong class="inf">∞</strong> trajanje oglasov
					</li>
				</ul>
				<div class="more-wrap">
					<ul class="l2">
						<li>
							<i class="fas fa-check-circle"></i> Pregled statistike
						</li>
					</ul>
					<a class="btn oval blue">Izberi</a>
					<div class="more">
						<strong>Izberite trajanje paketa:</strong>
						<div class="more-opt"><strong>19,90 €</strong> / 1 mesec</div>
						<div class="more-opt"><strong>39,90 €</strong> / 3 mesec</div>
						<div class="more-opt"><strong>99,90 €</strong> / 12 mesec</div>
					</div>
				</div>
			</div>

			<div class="box flx more">
				<div class="head">
					<i class="far fa-gem"></i>
					<div class="title">Paket PROFI</div>
					<div class="price">od 39,90 €</div>
				</div>
				<ul class="l1">
					<li>
						<i class="fas fa-check-circle"></i> <strong class="inf">∞</strong> oglasov
					</li>
					<li>
						<i class="fas fa-check-circle"></i> <strong class="inf">∞</strong> trajanje oglasov
					</li>
				</ul>
				<div class="more-wrap">
					<ul class="l2">
						<li>
							<i class="fas fa-check-circle"></i> Pregled statistike
						</li>
						<li>
							<i class="fas fa-check-circle"></i> Vključen XML izvoz
						</li>
					</ul>
					<a class="btn oval white brd">Izberi</a>
					<div class="more">
						<strong>Izberite trajanje paketa:</strong>
						<div class="more-opt"><strong>19,90 €</strong> / 1 mesec</div>
						<div class="more-opt"><strong>39,90 €</strong> / 3 mesec</div>
						<div class="more-opt"><strong>99,90 €</strong> / 12 mesec</div>
					</div>
				</div>
			</div>

		</div>
	</form>
</div>
