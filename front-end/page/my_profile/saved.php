<?php

	use Page\PageComponents as P;

	if(!isset($profilePage)) die;
	P::initPage('Shranjeni oglasi', 'Lorem ipsum');
	$profilePageSeg = 'saved';

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
			</div>';

		echo '</div>';
	}

?>

<div class="page-heading flx">
	<h1>Shranjeni <span>oglasi</span></h1>
</div>

<div class="sort-by flx">
	<div class="select-all">
		<?php P::renderCheckbox('my-posts', 'Izberi vse', 'all', false, false, true); ?>
		<button class="delete">Odstrani</button>
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
