<?php

	use Page\PageComponents as P;

	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
	P::initPage('Ustvari oglas', 'Lorem ipsum');
	P::addCss('/assets/css/pages/newpost.css');

	$categories = [
		[
			'id' => 1,
			'name' => 'Avtomobilizem',
			'ico' => 'fas fa-car',
			'color' => 'blue',
			'categories' => [],
			'parent' => null
		],
		[
			'id' => 2,
			'name' => 'Tehnika',
			'ico' => 'fas fa-tv',
			'color' => 'blue',
			'categories' => [],
			'parent' => null
		],
		[
			'id' => 3,
			'name' => 'Vse za dom',
			'ico' => 'fas fa-home',
			'color' => 'orange',
			'categories' => [],
			'parent' => null
		],
		[
			'id' => 4,
			'name' => 'Materiali, oprema',
			'ico' => 'fas fa-home',
			'color' => 'orange',
			'categories' => [
				['id' => 401, 'name' => 'Pohištvo', 'parent' => 4],
				['id' => 402, 'name' => 'Gospodinjski aparati', 'parent' => 4],
				['id' => 403, 'name' => 'Svetila in žarnice', 'paid' => true, 'parent' => 4, 'categories' => [
					['id' => 4031, 'name' => 'Stropna svetila', 'parent' => 403, 'categories' => [
						['id' => 40311, 'name' => 'test', 'parent' => 4031],
						['id' => 40312, 'name' => 'test2', 'parent' => 4031],
					]],
					['id' => 4032, 'name' => 'Stenska svetila', 'parent' => 403],
					['id' => 4033, 'name' => 'Nočne svetilke', 'parent' => 403],
					['id' => 4034, 'name' => 'Samostoječa svetila', 'parent' => 403]
				]],
				['id' => 404, 'name' => 'Oblačila, obutev in moda', 'parent' => 4],
				['id' => 405, 'name' => 'Otroška oprema in igrače', 'parent' => 4],
				['id' => 406, 'name' => 'Vse za šolo', 'parent' => 4],
				['id' => 407, 'name' => 'Vse za šolo', 'parent' => 4],
				['id' => 408, 'name' => 'Vse za šolo', 'parent' => 4],
				['id' => 409, 'name' => 'Vse za šolo', 'paid' => true, 'parent' => 4],
				['id' => 410, 'name' => 'Vse za šolo', 'parent' => 4]
			],
			'parent' => null
		],
		[
			'id' => 5,
			'name' => 'Kmetijstvo',
			'ico' => 'fas fa-home',
			'color' => 'green',
			'categories' => [],
			'parent' => null
		],
		[
			'id' => 6,
			'name' => 'Stroji, orodja',
			'ico' => 'fas fa-home',
			'color' => 'green',
			'categories' => [],
			'parent' => null
		],
		[
			'id' => 7,
			'name' => 'Šport, navtika',
			'ico' => 'fas fa-home',
			'color' => 'blue',
			'categories' => [],
			'parent' => null
		],
		[
			'id' => 8,
			'name' => 'Storitve, delo',
			'ico' => 'fas fa-home',
			'color' => 'blue',
			'categories' => [],
			'parent' => null
		],
		[
			'id' => 9,
			'name' => 'Zasebni stiki',
			'ico' => 'fas fa-heart',
			'color' => 'red',
			'categories' => [
				['id' => 901, 'name' => 'SMS test', 'parent' => 9, 'sms' => true],
				['id' => 902, 'name' => 'SMS test + plačljivo', 'parent' => 9, 'sms' => true, 'paid' => true],
			],
			'parent' => null
		]
	];

	function renderSteps(int $step) {
		echo '
			<div class="steps-line-container">
				<div class="steps-line flx">
					<div class="step' . ($step >= 1 ? ' active' : '') . '">
						<strong>Izbira kategorije</strong>
						<i class="fas fa-check-circle"></i>
					</div>
					<div class="step' . ($step >= 2 ? ' active' : '') . '">
						<strong>Vnos podatkov oglasa</strong>
						<i class="fas fa-check-circle"></i>
					</div>
					<div class="step' . ($step >= 3 ? ' active' : '') . '">
						<strong>Objava oglasa</strong>
						<i class="fas fa-check-circle"></i>
					</div>
				</div>
			</div>';
	}


	function renderMainCategory(string $ico, string $text, string $color) {
		echo '
			<div class="cat col-' . $color . '">
				<i class="' . $ico . ' ico"></i>
				<p>' . $text . '</p>
				<i class="far fa-chevron-right"></i>
			</div>';
	}

	//Number of posts that the user has made so far
	$postCount = 0;

	//Whether the user posting is above its post limit
	$aboveLimit = $postCount >= 5 && P::isCompanyLoggedIn();
	$aboveLimit = false; //TODO: Temporary

	$userLoggedIn = P::isUserLoggedIn();
?>


<!DOCTYPE html>
<html lang="sl">
	<?php P::renderHead(); ?>
	<body>
		<?php P::renderHeader(); ?>

		<div id="new-post" class="cw">
			<div class="page-heading flx">
				<h1>Oddaja <span>oglasa</span></h1>
			</div>

			<div id="create-post-container">
				<form id="create-post-frm" class="frm-inputs">

					<?php if(!$aboveLimit) { ?>
						<input type="hidden" name="post" value="<?php echo guid(); ?>"/>

						<div id="cp-page-1" class="create-post-page flx<?php echo !$userLoggedIn ? ' active' : ''; ?>">

							<div id="cp-add-registered" class="flx">
								<i class="fas fa-user-check type-ico"></i>
								<h2 data-modal="modal-login">Oddaj oglas s prijavo</h2>
								<ul>
									<li><i class="fas fa-check-circle"></i> Hitrejši način</li>
									<li><i class="fas fa-check-circle"></i> Možnost urejanja oglasa po oddaji</li>
									<li><i class="fas fa-check-circle"></i> Možnost podaljšanja ali deaktivacije oglasa
									</li>
									<li><i class="fas fa-check-circle"></i> Možnost izbrisa oglasa</li>
									<li>
										<i class="fas fa-check-circle"></i> Opcija mesečnega zakupa oglasov<br>(velja le za plačljive kategorije)
									</li>
								</ul>
							</div>

							<div id="cp-add-guest" class="flx">
								<i class="fas fa-user-times type-ico"></i>
								<h2>Oddaj oglas brez prijave</h2>
								<ul>
									<li><i class="far fa-check-circle"></i> Oddaja oglasa brez uporabniškega računa</li>
									<li>
										<i class="far fa-times-circle"></i> Izpolnjevanje osebnih podatkov ob vsaki oddaji oglasa
									</li>
									<li><i class="far fa-times-circle"></i> Brez možnosti urejanja oglasa po oddaji</li>
									<li><i class="far fa-times-circle"></i> Samodejni izbris oglasa po 30 dneh</li>
								</ul>
								<p>
									<i class="fas fa-info-circle"></i> Želite ustvariti račun na Oglasi.si?
									<a href="">Registracija</a>
								</p>
							</div>

						</div>

						<div id="cp-page-2" class="create-post-page<?php echo $userLoggedIn ? ' active' : ''; ?>">

							<h2 class="heading">Izbira kategorije</h2>
							<?php renderSteps(1); ?>

							<div id="category-selector-container" class="cat-has-children create-post-page-content">

								<p class="description">
									<i class="fas fa-info-circle"></i> Izberite kategorijo in podkategorijo, v kateri se bo prikazoval vaš oglas ter potrdite svoj izbor.
								</p>

								<div id="category-selector" class="flx">

									<div class="main">
										<?php
											foreach($categories as &$cat) {
												$cat['sh'] = false;
												renderMainCategory($cat['ico'], $cat['name'], $cat['color']);
												foreach($cat['categories'] ?? [] as &$sc) $sc['sh'] = false;
											}
										?>
									</div>

									<div class="sub empty">
										<div class="head flx" style="display:none">
											<i class="far fa-chevron-left"></i><span></span>
										</div>
										<div class="list"></div>
										<p class="empty">Izberite kategorijo, v kateri želite prikazati vaš oglas.</p>
									</div>

								</div>

								<p id="category-paid-text" class="description">
									<i class="fas fa-info-circle"></i> Izbrana kategorija je plačljiva
								</p>

								<div class="confirm flx" style="display: none">
									<div class="selected">
										Izbrali ste: <strong></strong>
									</div>
									<a class="btn oval blue">Potrdi in nadaljuj</a>
								</div>
							</div>
						</div>


						<div id="cp-page-3" class="create-post-page">
							<h2 class="heading">Izbira paketa</h2>
							<?php renderSteps(1); ?>

							<div class="create-post-page-content">
								<p class="description">
									<i class="fas fa-info-circle"></i>
									<?php if(P::isUserLoggedIn()) { ?>
										Izberite opcijo oglaševanja, ki ustreza vašim zahtevam.
									<?php } else { ?>
										Izberite opcijo oglaševanja, ki ustreza vašim zahtevam. Izbira paketa "Mesečni zakup" je na voljo le prijavljenim uporabnikom.
										<a data-modal="modal-login">Prijavite se tukaj</a>.
									<?php } ?>

								</p>

								<div id="paid-post-select" class="flx box-container<?php echo !P::isUserLoggedIn() ? ' logged-out' : ''; ?>">

									<div class="box flx more<?php echo !P::isUserLoggedIn() ? ' disabled' : ''; ?>">
										<?php if(!P::isUserLoggedIn()) { ?>
											<div class="tooltip">Paket je na voljo le prijavljenim uporabnikom</div>
										<?php } ?>
										<div class="head">
											<i class="far fa-gem"></i>
											<div class="title">Mesečni zakup</div>
											<div class="price">11,99 €</div>
										</div>
										<ul class="l1">
											<li>
												<i class="fas fa-check-circle"></i> Objava
												<strong>10 oglasov</strong> iz plačljivih kategorij
											</li>
											<li>
												<i class="fas fa-check-circle"></i> Paket velja 30 dni
											</li>
										</ul>
										<div class="more-wrap">
											<ul class="l2">
												<li>
													<i class="fas fa-check-circle"></i> Pregled statistike
												</li>
												<li>
													<i class="fas fa-check-circle"></i> Urejanje
												</li>
												<li>
													<i class="fas fa-check-circle"></i> Podaljšanje
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

									<div class="box flx">
										<div class="head">
											<i class="far fa-gem"></i>
											<div class="title">Oglas</div>
											<div class="price">4,99 €</div>
										</div>
										<ul class="l1">
											<li>
												<i class="fas fa-check-circle"></i> Objava 1 oglasa iz plačljive kategorije
											</li>
											<li>
												<i class="fas fa-check-circle"></i> Oglaševanje velja 30 dni
											</li>
										</ul>
										<ul class="l2">
											<li>
												<i class="far fa-times-circle"></i> Pregled statistike
											</li>
											<li>
												<i class="far fa-times-circle"></i> Urejanje
											</li>
											<li>
												<i class="far fa-times-circle"></i> Podaljšanje
											</li>
										</ul>
										<a class="btn oval white brd">Izberi</a>
									</div>

								</div>

								<div class="grey-tile">
									<i class="fas fa-info-circle"></i> Načini plačila: VALÚ, plačilne kartice (Visa, MasterCard, Maestro), SMS, Paypal, UPN.
									<a>Več o načinih plačila</a>
								</div>

							</div>
						</div>


						<div id="cp-page-4" class="create-post-page">
							<h2 class="heading">Vnos podatkov oglasa</h2>
							<?php renderSteps(2); ?>

							<div id="post-info-container">

								<div id="post-breadcrumbs">Kategorija</div>

								<div id="post-info">
									<h3>Podatki oglasa</h3>
									<p class="description">
										<i class="fas fa-info-circle"></i> Prosimo, izpolnite vsa polja, da bodo kupci imeli boljšo predstavo o predmetu, ki ga prodajate.
									</p>

									<div class="content">
										<div class="post-type flx">
											<div class="post-type-1">
												<?php
													P::renderRadiobox('type', 'Prodam', '1', false, true);
													P::renderRadiobox('type', 'Kupim', '2', false, false);
													P::renderRadiobox('type', 'Podarim', '3', false, false);
												?>
											</div>
											<div class="post-type-2">
												<?php
													P::renderRadiobox('state', 'Rabljeno', '1', false, true);
													P::renderRadiobox('state', 'Novo', '2', false, false);
													P::renderRadiobox('state', 'Poškodovano / pokvarjeno', '3', false, false);
												?>
											</div>
										</div>

										<div id="post-title" class="flx">
											<?php
												P::renderInput(
													'title',
													'Naslov oglasa',
													'fas fa-pencil',
													'Neveljaven naslov oglasa (1 - 50 znakov)',
													'fw',
													'text',
													'required',
													null,
													'',
													'Naslov lahko vsebuje največ 50 znakov.'

												);
											?>
											<?php
												P::renderInput(
													'price',
													'Cena',
													'fas fa-pencil',
													'Neveljavna cena',
													'fw',
													'text',
													'required onkeyup="$(this).val($(this).val().replace(\',\', \'.\'));" pattern="\d+(\.\d{1,3})?"',
													null,
													'€'
												);
											?>
										</div>

										<div id="post-description">
											<?php
												P::renderInput(
													'desc',
													'Podrobnejši opis',
													'fas fa-pencil',
													'Neveljaven opis oglasa (1 - 1000 znakov)',
													'fw',
													'textarea',
													'required',
													null,
													'',
													'Podrobnejši opis zagotovi hitrejšo in uspešnejšo prodajo. V opis ne navajajte cene in telefonske številke.'
												);
											?>
										</div>
									</div>
								</div>

								<div id="post-additional" class="seg-brd">
									<h3>Dodatni podatki in karakteristike o predmetu</h3>
									<p class="description">
										<i class="fas fa-info-circle"></i> Izboljšajte svoje oglaševanje z dodatnimi podatki o predmetu, ki ga prodajate.
									</p>

									<div class="dd-row flx">
										<div class="dd">
											<select class="select" name="prop0" data-placeholder="Izberite proizvajalca" data-icon="fas fa-pencil">
												<option value=""></option>
												<option value="1">Samsung</option>
											</select>
										</div>

										<div class="dd">
											<select class="select" name="prop0" data-placeholder="Ločljivost zaslona" data-icon="fas fa-pencil">
												<option value=""></option>
												<option value="1">Full HD</option>
												<option value="2">4K</option>
											</select>
										</div>
									</div>


									<div class="dd-row flx">
										<div class="dd">
											<?php P::renderCheckbox('invoice', 'Račun', '1', false, false); ?>
										</div>

										<div class="dd">
											<?php P::renderCheckbox('garan', 'Veljavna garancija', '1', false, false); ?>
										</div>

										<div class="dd">
											<?php P::renderCheckbox('org', 'Originalna embalaža', '1', false, false); ?>
										</div>
									</div>


								</div>

								<div id="post-location" class="seg-brd">
									<h3>Lokacija prodaje</h3>

									<div class="dd-row flx">
										<div class="dd">
											<select class="select" name="region_1" data-placeholder="Izberite regijo *" data-icon="map-marker-alt" required>
												<option value=""></option>
												<option value="1">Regija 1</option>
												<option value="2">Regija 2</option>
											</select>
										</div>

										<div class="dd">
											<select class="select" name="region_2" data-placeholder="Izberite mestno občino *" data-icon="map-marker-alt" required>
												<option value=""></option>
												<option value="1">Občina 1</option>
												<option value="2">Občina 2</option>
											</select>
										</div>
									</div>
								</div>

								<div id="post-contact" class="seg-brd">
									<h3>Kontaktni podatki</h3>
									<p class="description">
										<i class="fas fa-info-circle"></i> Navedite kontaktne podatke preko katerih boste dosegljivi kupcem.
									</p>

									<div class="dd-row flx">
										<div id="phone-confirm" class="dd sms">
											<?php
												P::renderInput(
													'phone',
													'Telefonska številka',
													'fas fa-phone-alt',
													'Vnesite veljaveno telefonsko številko',
													'fw',
													'phone',
													'required="required" onkeyup="$(this).val($(this).val().replace(\' \', \'\').replace(\'-\', \'\'));" pattern="\d{8,10}"',
													null,
													null,
													'Po vnosu telefonske številke, kliknite gumb ‘Pošlji SMS kodo’, nakar vam bo na SMS poslana 4 mestna koda.'
												);
											?>
											<div class="send-sms btn blue" data-sms="modal-confirm-sms">
												<i class="fas fa-envelope"></i> Pošlji SMS kodo
											</div>
										</div>
										<div class="dd">
											<?php
												P::renderInput(
													'contact_email',
													'E-poštni naslov',
													'fas fa-envelope',
													'Vnesite veljaven e-poštni naslov',
													'fw',
													'email'
												);
											?>
										</div>
									</div>

									<?php P::renderCheckbox('notify_expiration', 'Želim obvestilo o poteku oglasa', '1', false, true); ?>

								</div>

								<div id="post-images" class="seg-brd">
									<h3>Nalaganje fotografij</h3>
									<p class="description">
										<i class="fas fa-info-circle"></i> Oglasu lahko dodate do 10 fotografij v formatu .jpg, .png.
									</p>

									<div id="post-images-panel"></div>

								</div>

								<?php if(!P::isUserLoggedIn()) { ?>
									<div id="post-register" class="seg-brd">
										<h3>Hitra registracija</h3>
										<p class="description">
											<i class="fas fa-info-circle"></i> Po želji lahko z oddajo oglasa opravite tudi hitro registracijo.<br>Postopek vzame 30 sekund, prihranili pa boste čas pri vnosu naslednjih oglasov ter imeli možnost urejanja.
										</p>

										<?php P::renderCheckbox('quick_reg', 'Želim se hitro registrirati', '1', false, true); ?>
										<div id="quick-register">
											<div class="dd">
												<?php
													P::renderInput(
														'qr_usrname',
														'Uporabniško ime',
														'fas fa-user',
														'Neveljavno uporabniško ime',
														'fw',
														'text',
														'required'
													);
												?>
											</div>
											<div class="dd">
												<?php
													P::renderInput(
														'qr_email',
														'E-poštni naslov',
														'fas fa-envelope',
														'Vnesite veljaven e-poštni naslov',
														'fw',
														'email',
														'required'
													);
												?>
											</div>
											<div class="dd">
												<?php
													P::renderInput(
														'qr_psw',
														'Prijavno geslo',
														'fas fa-lock',
														'Vnesite veljavno geslo',
														'fw',
														'password',
														'required'
													);
												?>
											</div>
										</div>
									</div>
								<?php } ?>

								<div id="post-confirm" class="seg-brd">
									<?php if(!P::isUserLoggedIn()) { ?>
										<div class="fw"><?php P::renderCheckbox('tos', 'Strinjam se s <a href="#" target="_blank" class="lnk">pogoji in pravili uporabe Oglasi.si</a>', '1', true); ?></div>
									<?php } ?>
									<a class="btn oval blue fw next">Potrdi in nadaljuj</a>
								</div>

							</div>


						</div>

						<div id="cp-page-5" class="create-post-page">

							<h2 class="heading">Objava oglasa</h2>
							<?php renderSteps(4); ?>
							<div id="post-info-container">
								<div id="post-published">
									<i class="fas fa-check-circle"></i>
									<div>
										<span>Brezplačni oglas je objavljen</span>
										<?php if($userLoggedIn) { ?>
											<a href="/profil/">
												Nadaljuj na moje oglase <i class="far fa-arrow-right"></i>
											</a>
										<?php } else { ?>
											<a href="/profil/">
												Poglej oglas <i class="far fa-arrow-right"></i>
											</a>
										<?php } ?>
									</div>
								</div>

								<div id="post-boost-container" class="seg-brd">
									<h3>Možnost izpostavitve oglasa</h3>
									<p class="description">
										<i class="fas fa-info-circle"></i> V kolikor želite izboljšati odziv na vaš oglas, izberite možnost izpostavitve oglasa ter način plačila.
									</p>

									<div id="post-boost" class="flx">

										<div class="preview">

											<div id="post-boost-paid" class="entry required">
												<div class="head flx">
													<div class="left">
														<strong>Plačljiv oglas</strong>
														<p>Veljavnost 30 dni</p>
													</div>
													<div class="right">
														4,95 €
													</div>
												</div>
											</div>

											<div id="post-boost-optional" class="entry optional">
												<div class="head flx">
													<?php P::renderCheckbox('use_boost', '', '1', false, false); ?>
													<div class="left">
														<strong>Izpostavi oglas</strong>
														<p>Veljavnost izpostavitve 7 dni</p>
													</div>
													<div class="right">
														3,00 €
													</div>
												</div>

												<div class="more">
													<ul>
														<li>
															<i class="fas fa-check-circle"></i> Pozicija na vrhu seznama
														</li>
														<li>
															<i class="fas fa-check-circle"></i> Obarvan oglas
														</li>
													</ul>

													<div class="preview-post flx">
														<div class="img">
															<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="/>
														</div>
														<div class="bio">
															<strong>Prenosni računalnik HP G450 malo rabljen</strong>
															<ul>
																<li><i class="fas fa-info-circle"></i> Rabljeno</li>
																<li>
																	<i class="fas fa-map-marker-alt"></i> Sveti Trije Kralji v Slovenskih Goricah
																</li>
																<li>*še neka “special” lastnost</li>
															</ul>
														</div>
														<div class="price">650 €</div>
														<i class="far fa-bookmark"></i>
													</div>
												</div>

												<div class="payment">
													<div class="title">Izberite način plačila:</div>

													<div class="payment-method active">
														<div class="head">
															<?php P::renderRadiobox('payment_type', '', 'card', false, true); ?>
															<img src="/assets/res/ico/cards.png">
															<strong>Plačilne kartice</strong>
															<i class="far fa-chevron-down"></i>
														</div>
														<div class="more">
															<p>
																<i class="fas fa-check-circle"></i> Oglas bo izpostavljen takoj.
															</p>
															<p>
																Plačilo je možno z debetnimi ali kreditnimi karticami
																<strong>Visa, MasterCard, Maestro</strong>. Po potrditvi izbire boste preusmerjeni na vmesnik za varno plačevanje..
															</p>
														</div>
													</div>


													<div class="payment-method">
														<div class="head">
															<?php P::renderRadiobox('payment_type', '', 'pp', false, false); ?>
															<img src="/assets/res/ico/paypal.png">
															<strong>PayPal</strong> <i class="far fa-chevron-down"></i>
														</div>
													</div>

													<div class="payment-method">
														<div class="head">
															<?php P::renderRadiobox('payment_type', '', 'valu', false, false); ?>
															<img src="/assets/res/ico/valu.png"> <strong>VALÚ</strong>
															<i class="far fa-chevron-down"></i>
														</div>
													</div>

													<div class="payment-method">
														<div class="head">
															<?php P::renderRadiobox('payment_type', '', 'sms', false, false); ?>
															<img src="/assets/res/ico/sms.png">
															<strong>SMS plačilo na 1919</strong>
															<i class="far fa-chevron-down"></i>
														</div>
													</div>


													<div class="payment-method">
														<div class="head">
															<?php P::renderRadiobox('payment_type', '', 'trr', false, false); ?>
															<img src="/assets/res/ico/trr.png">
															<strong>UPN plačilni nalog</strong>
															<i class="far fa-chevron-down"></i>
														</div>
													</div>

												</div>

											</div>

										</div>

										<div class="sum">
											<strong>Povzetek izbire</strong>
											<div class="selected-items"></div>
											<div class="bottom">
												<table>
													<tr>
														<td>Način plačila:</td>
														<td class="sum-pm">Plačilne kartice</td>
													</tr>
													<tr>
														<td>Znesek za plačilo:</td>
														<td class="sum-amt">3,00 €</td>
													</tr>
												</table>
												<div class="btn oval blue fw">Potrdi in izpostavi oglas</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					<?php } else { ?>

						<div id="cp-page-limit" class="create-post-page active">
							<h2 class="heading">Izbira paketa</h2>
							<?php renderSteps(1); ?>

							<div class="create-post-page-content">
								<p class="description">
									<i class="fas fa-info-circle"></i> Brezplačno oglaševanje za pravne osebe velja do 5 objavljenih oglasov. Izberite paket, ki ustreza vašim zahtevam. Več o
									<a href="#">ponudbi za pravne osebe</a>
									.
								</p>

								<div id="paid-post-select" class="flx box-container">

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
												<i class="fas fa-check-circle"></i>
												<strong class="inf">∞</strong> trajanje oglasov
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
												<i class="fas fa-check-circle"></i>
												<strong class="inf">∞</strong> oglasov
											</li>
											<li>
												<i class="fas fa-check-circle"></i>
												<strong class="inf">∞</strong> trajanje oglasov
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

								<div class="grey-tile">
									<i class="fas fa-info-circle"></i> Načini plačila: VALÚ, plačilne kartice (Visa, MasterCard, Maestro), SMS, Paypal, UPN.
									<a>Več o načinih plačila</a>
								</div>

							</div>
						</div>

					<?php } ?>
				</form>
			</div>

		</div>

		<script id="categories-json">
			window.postCategories = <?php echo json_encode($categories); ?>;
		</script>
		<script src="/assets/js/pages/newpost.js"></script>

		<div id="modal-confirm-sms" class="modal">
			<div class="content">
				<strong class="tc">Na vašo telefonsko številko smo poslali SMS s potrditveno kodo. Vnesite jo sem:</strong>
				<div class="confirm-num">
					<input type="text" value="" placeholder="#" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" autofocus/>
					<input type="text" value="" placeholder="#" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
					<input type="text" value="" placeholder="#" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
					<input type="text" value="" placeholder="#" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
				</div>
				<div class="tc">
					<button class="btn oval blue disabled">Preveri kodo</button>
				</div>
			</div>
		</div>


		<?php P::renderFooter(); ?>
	</body>
</html>
