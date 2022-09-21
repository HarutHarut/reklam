<?php

	use Page\PageComponents as P;

	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
	P::$showCategoriesBrowser = false;
	P::addCss('/assets/css/pages/myprofile.css');

	//User is not logged in, redirect to index
	if(!P::isUserLoggedIn()) {
		header('location:/');
		die;
	}

	$profilePageSeg = null;
	$profilePage = $_GET['profile_page'] ?? '';
	if(!file_exists(ROOT . 'page/my_profile/' . $profilePage . '.php')) {
		header('location:/profil/');
		die;
	}

	ob_start();
	include ROOT . 'page/my_profile/' . $profilePage . '.php';
	$pageContents = ob_get_clean();

	$nameFirst = P::$loggedInUserData['name_first'];
	$nameLast = P::$loggedInUserData['name_last'] ?? '';
	$nameShort = $nameFirst[0] . ($nameLast[0] ?? '');

?>


<!DOCTYPE html>
<html lang="sl">
	<?php P::renderHead(); ?>
	<body>
		<?php P::renderHeader(); ?>

		<div class="cw">
			<div id="profile-container">

				<div id="profile-nav">

					<div id="profile-head">

						<?php if(P::isCompanyLoggedIn()) { ?>
							<div class="logo"><img src="https://i.imgur.com/csfOSA5.png"/></div>
						<?php } else { ?>
							<div class="img"><?php echo $nameShort; ?></div>
						<?php } ?>

						<div class="name"><?php echo $nameFirst . ' ' . $nameLast; ?></div>
						<div class="id">ID uporabnika: <?php echo P::$loggedInUserData['id']; ?></div>
					</div>

					<div id="profile-nav-list">

						<div class="seg">
							<a class="title <?php echo $profilePageSeg === 'posts' ? ' active' : ''; ?>" href="/profil/">
								<i class="fas fa-list"></i> Moji oglasi
							</a>
							<div class="list">
								<?php P::renderCheckbox('status[]', 'Aktivni oglasi', 'active', false, true); ?>
								<?php P::renderCheckbox('status[]', 'Deaktivirani oglasi', 'inactive', false, true); ?>
								<?php P::renderCheckbox('status[]', 'Potekli oglasi', 'expired', false, true); ?>
							</div>
						</div>

						<div class="seg">
							<a class="title<?php echo $profilePageSeg === 'saved' ? ' active' : ''; ?>" href="/profil/shranjeno/">
								<i class="fas fa-bookmark"></i> Shranjeni oglasi <span class="tag">10</span>
							</a>
						</div>


						<div class="seg">
							<div class="title">
								<i class="fas fa-chart-line"></i> Statistika
							</div>
						</div>

						<div class="seg">
							<a class="title<?php echo $profilePageSeg === 'edit_bio' ? ' active' : ''; ?>">
								<i class="fas fa-user"></i> Urejanje profila
							</a>
							<div class="list">
								<a href="/profil/sprememba-gesla/">Sprememba gesla</a>
								<a href="/profil/urejanje/">Upravljanje računa</a>
							</div>
						</div>

						<div class="seg">
							<div class="title">
								<i class="fas fa-wallet"></i> Plačila
							</div>
						</div>

						<div class="seg color">
							<a class="title<?php echo $profilePageSeg === 'subscribtion' ? ' active' : ''; ?>" href="/profil/nadgradi/">
								<i class="far fa-gem"></i> Paket Maxi
							</a>
							<div class="list">
								<a href="/profil/nadgradi/">Nadgradi paket</a>
								<a href="#">Podaljšaj</a>
							</div>
							<div class="more">
								<i class="fas fa-clock"></i> Paket poteče 23.5.2022
							</div>
						</div>

						<div class="seg gap">
							<a class="title" href="/pogosta-vprasanja/">
								<i class="fas fa-question-circle"></i> Pogosta vprašanja
							</a>
						</div>

						<div class="seg last">
							<div class="title">
								<i class="far fa-sign-out"></i> Odjava
							</div>
						</div>

					</div>

				</div>

				<div id="profile-content">
					<?php echo $pageContents; ?>
				</div>

			</div>
		</div>

		<script src="/assets/js/pages/myprofile.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		<?php P::renderFooter(); ?>

	</body>
</html>
