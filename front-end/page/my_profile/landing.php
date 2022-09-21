<?php

	use Page\PageComponents as P;

	if(!isset($profilePage)) die;
	P::initPage('Moji oglasi', 'Lorem ipsum');
	$profilePageSeg = 'posts';

	function renderMyPost(bool $isActive) {
		echo '<div class="result flx status-' . ($isActive ? 'active' : 'inactive') . '">';

		P::renderCheckbox('select', '', 'id', false, false, true);
		echo '
			<div class="img"><img src="https://cdn.mos.cms.futurecdn.net/A4GDK27VMnz6LtFDy9yzk.jpg"></div>
			<div class="bio">
				<div class="head flx">
					<strong class="name">Prenosni računalnik HP G450 malo rabljen</strong>
					<strong class="price">560 €</strong>
				</div>
				<div class="status">
					' . ($isActive ? 'Oglas je aktiven' : 'Oglas je potekel') . '
				</div>
			</div>
			<div class="data">
				<p><i class="fas fa-check-circle"></i> Objavljeno: 10.2.2021 ob 21:53</p>
				<p><i class="fas fa-clock"></i> Oglas poteče: 10.3.2021</p>
				<p><i class="fas fa-eye"></i> Število ogledov: 70</p>
			</div>';

		echo '
			<div class="options">
				<button>Uredi <i class="fas fa-pen"></i></button>
				<button>Izbriši <i class="fas fa-trash"></i></button>
				<button>Podaljšaj 30 dni <i class="fas fa-calendar-plus"></i></button>
				<button>Deli <i class="fas fa-share-alt"></i></button>
				<button class="paid">Izpostavi <i class="fas fa-star"></i></button>
				<button class="paid">Skok na vrh <i class="fas fa-sort-size-up"></i></button>
			</div>';

		echo '</div>';
	}

?>

<div class="page-heading flx">
	<h1>Moji <span>oglasi</span></h1>
</div>

<div class="profile-stats flx">
	<div class="stat">
		<strong>4</strong>
		<p>Aktivni oglasi</p>
	</div>
	<div class="stat">
		<strong>100</strong>
		<p>Ogledov mojih oglasov</p>
	</div>
	<div class="stat large flx">
		<div class="tag">Bonus</div>
		<div class="circle-progress">
			<div data-value="0.5"></div>
			<p>čez<strong>33</strong>dni</p>
		</div>
		<div class="content">
			<strong>Pridobi brezplačno 7 dnevno izpostavitev oglasa</strong>
			<p>
				z zbiranjem dnevov in oglasov!
				<a>Izvedi več</a>
			</p>
		</div>
	</div>
</div>

<div class="sort-by flx">
	<div class="select-all">
		<?php P::renderCheckbox('my-posts', 'Izberi vse', 'all', false, false, true); ?>
		<button class="deactivate">Deaktiviraj</button>
		<button class="delete">Izbriši</button>
	</div>
	<p>Število rezultatov: 2</p>
	<select class="select" name="sort" data-placeholder="Razvrsti oglase">
		<option></option>
		<option value="1">Po ceni</option>
		<option value="2">Zadnji oglasi</option>
	</select>
</div>


<div id="my-posts" class="post-results">
	<?php for($i = 0; $i < 6; $i++) renderMyPost($i < 4); ?>
</div>

<div class="create-post sub-tile tile">
	<p>Želite oddati nov oglas?</p>
	<a class="btn oval blue" href="/nov-oglas/">Oddaj oglas <i class="far fa-plus"></i></a>
</div>

<div class="pagination flx">
	<a href="#" class="text"><i class="far fa-chevron-left"></i> Prejšnja stran</a>
	<a href="#">1</a>
	<a href="#">2</a>
	<a href="#" class="active">3</a>
	<a href="#">4</a>
	<a href="#" class="text">Naslednja stran <i class="far fa-chevron-right"></i></a>
</div>
