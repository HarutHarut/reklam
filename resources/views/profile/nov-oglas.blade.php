@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/newpost.css" rel="stylesheet">
@endpush
@push('scripts')
    <script id="categories-json">
        window.postCategories = <?php
        echo json_encode($categories);
        ?>;
    </script>
    <script src="/assets/js/pages/newpost.js"></script>
    {{--    <script src="/assets/js/imgpnl.js"></script>--}}

@endpush
@section('content')

    <?php

    //	use Page\PageComponents as P;
    //
    //	include $_SERVER["DOCUMENT_ROOT"] . '/page/include.php';
    //	P::initPage('Ustvari oglas', 'Lorem ipsum');
    //	P::addCss('/assets/css/pages/newpost.css');
    //
    //	$categories = [
    //		[
    //			'id' => 1,
    //			'name' => 'Avtomobilizem',
    //			'ico' => 'fas fa-car',
    //			'color' => 'blue',
    //			'categories' => [],
    //			'parent' => null
    //		],
    //		[
    //			'id' => 2,
    //			'name' => 'Tehnika',
    //			'ico' => 'fas fa-tv',
    //			'color' => 'blue',
    //			'categories' => [],
    //			'parent' => null
    //		],
    //		[
    //			'id' => 3,
    //			'name' => 'Vse za dom',
    //			'ico' => 'fas fa-home',
    //			'color' => 'orange',
    //			'categories' => [],
    //			'parent' => null
    //		],
    //		[
    //			'id' => 4,
    //			'name' => 'Materiali, oprema',
    //			'ico' => 'fas fa-home',
    //			'color' => 'orange',
    //			'categories' => [
    //				['id' => 401, 'name' => 'Pohištvo', 'parent' => 4],
    //				['id' => 402, 'name' => 'Gospodinjski aparati', 'parent' => 4],
    //				['id' => 403, 'name' => 'Svetila in žarnice', 'paid' => true, 'parent' => 4, 'categories' => [
    //					['id' => 4031, 'name' => 'Stropna svetila', 'parent' => 403, 'categories' => [
    //						['id' => 40311, 'name' => 'test', 'parent' => 4031],
    //						['id' => 40312, 'name' => 'test2', 'parent' => 4031],
    //					]],
    //					['id' => 4032, 'name' => 'Stenska svetila', 'parent' => 403],
    //					['id' => 4033, 'name' => 'Nočne svetilke', 'parent' => 403],
    //					['id' => 4034, 'name' => 'Samostoječa svetila', 'parent' => 403]
    //				]],
    //				['id' => 404, 'name' => 'Oblačila, obutev in moda', 'parent' => 4],
    //				['id' => 405, 'name' => 'Otroška oprema in igrače', 'parent' => 4],
    //				['id' => 406, 'name' => 'Vse za šolo', 'parent' => 4],
    //				['id' => 407, 'name' => 'Vse za šolo', 'parent' => 4],
    //				['id' => 408, 'name' => 'Vse za šolo', 'parent' => 4],
    //				['id' => 409, 'name' => 'Vse za šolo', 'paid' => true, 'parent' => 4],
    //				['id' => 410, 'name' => 'Vse za šolo', 'parent' => 4]
    //			],
    //			'parent' => null
    //		],
    //		[
    //			'id' => 5,
    //			'name' => 'Kmetijstvo',
    //			'ico' => 'fas fa-home',
    //			'color' => 'green',
    //			'categories' => [],
    //			'parent' => null
    //		],
    //		[
    //			'id' => 6,
    //			'name' => 'Stroji, orodja',
    //			'ico' => 'fas fa-home',
    //			'color' => 'green',
    //			'categories' => [],
    //			'parent' => null
    //		],
    //		[
    //			'id' => 7,
    //			'name' => 'Šport, navtika',
    //			'ico' => 'fas fa-home',
    //			'color' => 'blue',
    //			'categories' => [],
    //			'parent' => null
    //		],
    //		[
    //			'id' => 8,
    //			'name' => 'Storitve, delo',
    //			'ico' => 'fas fa-home',
    //			'color' => 'blue',
    //			'categories' => [],
    //			'parent' => null
    //		],
    //		[
    //			'id' => 9,
    //			'name' => 'Zasebni stiki',
    //			'ico' => 'fas fa-heart',
    //			'color' => 'red',
    //			'categories' => [
    //				['id' => 901, 'name' => 'SMS test', 'parent' => 9, 'sms' => true],
    //				['id' => 902, 'name' => 'SMS test + plačljivo', 'parent' => 9, 'sms' => true, 'paid' => true],
    //			],
    //			'parent' => null
    //		]
    //	];

    function renderSteps(int $step)
    {
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


    function renderMainCategory(string $ico, string $text, string $color)
    {
        echo '
			<div style="color:' . $color . '" class="cat">
				<i class="' . $ico . ' ico"></i>
				<p>' . $text . '</p>
				<i class="far fa-chevron-right"></i>
			</div>';
    }

    //Number of posts that the user has made so far
    //    $postCount = 0;

    //Whether the user posting is above its post limit
    //	$aboveLimit = $postCount >= 5 && P::isCompanyLoggedIn();
    //	$aboveLimit = false; //TODO: Temporary

    //	$userLoggedIn = P::isUserLoggedIn();
    ?>


    <div id="new-post" class="cw">
        <div class="page-heading flx">
            <h1>Oddaja <span>oglasa</span></h1>
        </div>

        <div id="create-post-container">
            <form id="create-post-frm" class="frm-inputs">
{{--@dd($aboveLimit)--}}
                @if($aboveLimit)
                    <input type="hidden" name="post" value="{{ guid() }}"/>
{{--@dd(\Illuminate\Support\Facades\Auth::check())--}}
                    <div id="cp-page-1"
                         class="create-post-page flx {{ !\Illuminate\Support\Facades\Auth::check() ? 'active' : '' }}">

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
                                    <i class="fas fa-check-circle"></i> Opcija mesečnega zakupa oglasov<br>(velja le za
                                    plačljive kategorije)
                                </li>
                            </ul>
                        </div>

                        <div id="cp-add-guest" class="flx">
                            <i class="fas fa-user-times type-ico"></i>
                            <h2>Oddaj oglas brez prijave</h2>
                            <ul>
                                <li><i class="far fa-check-circle"></i> Oddaja oglasa brez uporabniškega računa</li>
                                <li>
                                    <i class="far fa-times-circle"></i> Izpolnjevanje osebnih podatkov ob vsaki oddaji
                                    oglasa
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

                    <div id="cp-page-2"
                         data-step="1"
                         class="create-post-page step
                         active
{{--                            {{ \Illuminate\Support\Facades\Auth::check() ? 'active' : '' }}--}}
                             "
                    >

                        <h2 class="heading">Izbira kategorije</h2>
                        {{ renderSteps(1) }}

                        <div id="category-selector-container" class="cat-has-children create-post-page-content">

                            <p class="description">
                                <i class="fas fa-info-circle"></i> Izberite kategorijo in podkategorijo, v kateri se bo
                                prikazoval vaš oglas ter potrdite svoj izbor.
                            </p>

                            <div id="category-selector" class="flx">

                                <div class="main">
                                    @foreach($categories as $cat)
                                        {{ $cat['sh'] = false }}
                                        <div style="color:{{ $cat['color_filters'] }}"
                                             class="cat"
                                             data-catName="{{ $cat['slug'] }}"
                                        >
                                            <i class="{{ $cat['icon'] }} ico"></i>
                                            <p>{{ $cat['tip'] }}</p>
                                            <i class="far fa-chevron-right"></i>
                                        </div>
                                    @endforeach
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
                                <a class="btn oval blue checkOrCreate">Potrdi in nadaljuj</a>
                            </div>
                        </div>
                    </div>

                    <div id="cp-page-3" data-step="1" class="create-post-page step">
                        <h2 class="heading">Izbira paketa</h2>

                        {{ renderSteps(1) }}


                        <div class="create-post-page-content">
                            <p class="description">
                                <i class="fas fa-info-circle"></i>

                                @if(\Illuminate\Support\Facades\Auth::check())

                                    Izberite opcijo oglaševanja, ki ustreza vašim zahtevam.
                                @else
                                    Izberite opcijo oglaševanja, ki ustreza vašim zahtevam. Izbira paketa "Mesečni
                                    zakup" je
                                    na voljo le prijavljenim uporabnikom.
                                    <a data-modal="modal-login">Prijavite se tukaj</a>.
                                @endif

                            </p>

                            <div id="paid-post-select" class="flx box-container @auth 'logged-out' @endauth">

                                <div class="box flx more @auth 'disabled' @endauth">
                                    @if(!\Illuminate\Support\Facades\Auth::user())
                                        <div class="tooltip">Paket je na voljo le prijavljenim uporabnikom</div>
                                    @endif
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
                                <i class="fas fa-info-circle"></i> Načini plačila: VALÚ, plačilne kartice (Visa,
                                MasterCard, Maestro), SMS, Paypal, UPN.
                                <a>Več o načinih plačila</a>
                            </div>

                        </div>
                    </div>

                    <div id="cp-page-4" data-step="2" class="create-post-page step">
                        <h2 class="heading">Vnos podatkov oglasa</h2>
                        {{ renderSteps(2) }}

                        <div id="post-info-container">

                            <div id="post-breadcrumbs">Kategorija</div>
                            <div id="message_text" class="alert_message">
                                {{--            {{ isset($message) ? $message : '' }}--}}
                            </div>
                            <div id="post-info">
                                <h3>Podatki oglasa</h3>
                                <p class="description">
                                    <i class="fas fa-info-circle"></i> Prosimo, izpolnite vsa polja, da bodo kupci imeli
                                    boljšo predstavo o predmetu, ki ga prodajate.html +=
                                </p>

                                <div class="content">
                                    <div class="post-type flx">
                                        <div style="display: none" class="post-type-1 cat-public">
                                            @foreach(config('constants.product_type') as  $item => $key)
                                                <label class="ch radio">
                                                    <input required type="radio" name="tip_oglasa" value="{{ $key }}"
                                                        {{--                                                           @if($loop->first) checked @endif--}}
                                                    >
                                                    <span class="box"><i class="fas fa-circle"></i>
                                                    </span><span class="text">{{ $item }}</span>
                                                </label>
                                            @endforeach
                                            <p style="padding-top: 15px; display: none;"
                                               class="error-msg error_tip_oglasa">Vnesite veljavno tip oglasa</p>
                                        </div>

                                        <div style="display: none" class="post-type-1 cat-private">
                                            @foreach(config('constants.private_product_type') as $item => $key)
                                                <label class="ch radio">
                                                    <input required type="radio" name="tip_oglasa"
                                                           value="{{ $key }}"
                                                        {{--                                                           @if($loop->first) checked @endif--}}
                                                    >
                                                    <span class="box"><i class="fas fa-circle"></i>
                                                    </span><span class="text">{{ $item }}</span>
                                                </label>
                                            @endforeach
                                            <p style="padding-top: 15px; display: none;"
                                               class="error-msg error_tip_oglasa">Vnesite veljavno tip oglasa</p>
                                        </div>
                                        <input type="hidden" name="category_id" id="categoryId">
                                        <input type="hidden" name="parent_category_id" id="parentCategoryId">
                                        <input type="hidden" name="status" id="status">

                                    </div>

                                    <div id="post-title" class="flx">
                                        <div class="input input-type-text fw">
                                            <div class="input-inner">
                                                <input type="text" name="naslov" placeholder="Naslov oglasa" required>
                                                <div class="input-decor">
                                                    <i class="decor fas fa-pencil"></i>
                                                    <i class="error-ico fas fa-exclamation-circle"></i>
                                                    <p class="below-msg below_naslov">Naslov lahko vsebuje največ 50
                                                        znakov.</p>
                                                    <p class="error-msg error_naslov">Neveljaven naslov oglasa (1 - 50
                                                        znakov)</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input input-type-text fw">
                                            <div class="input-inner">
                                                <input type="number" name="cena" placeholder="Cena" required>
                                                <div class="input-decor">
                                                    <i class="decor fas fa-pencil"></i>
                                                    <i class="error-ico fas fa-exclamation-circle"></i>
                                                    <p class="error-msg error_cena">Neveljavna cena</p>
                                                    <span class="after-text">€</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="post-description">
                                        <div class="input input-type-textarea fw">
                                            <div class="input-inner">
                                                <textarea name="opis" placeholder="Podrobnejši opis"
                                                          required></textarea>
                                                <div class="input-decor">
                                                    <i class="decor fas fa-pencil"></i>
                                                    <i class="error-ico fas fa-exclamation-circle"></i>
                                                    <p class="below-msg below_opis">Podrobnejši opis zagotovi hitrejšo
                                                        in
                                                        uspešnejšo prodajo. V opis ne navajajte cene in telefonske
                                                        številke.</p>
                                                    <p class="error-msg error_opis">Neveljaven opis oglasa (1 - 1000
                                                        znakov)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                style="display: none"
                                id="post-additional" class="seg-brd">
                                <h3>Dodatni podatki in karakteristike o predmetu</h3>
                                <p class="description">
                                    <i class="fas fa-info-circle"></i> Izboljšajte svoje oglaševanje z dodatnimi
                                    podatki
                                    o predmetu, ki ga prodajate.
                                </p>

                                <div class="dd-row flx" id="customFilter">

                                </div>
                            </div>

                            <div id="post-location" class="seg-brd">
                                <h3>Lokacija prodaje</h3>

                                <div class="dd-row flx">
                                    <div class="dd">
                                        <select class="select check-region" name="parent_regija_id"
                                                data-placeholder="Izberite regijo *"
                                                data-icon="map-marker-alt" required>
                                            <option value=""></option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->regija }}</option>
                                            @endforeach
                                        </select>
                                        <p style="padding-top: 15px; display: none;"
                                           class="error-msg error_parent_regija_id">Vnesite veljavno parent regija
                                            id</p>
                                    </div>

                                    <div class="dd">
                                        <select class="select child-region" name="regija_id"
                                                data-placeholder="Izberite mestno občino *" data-icon="map-marker-alt"
                                                required>
                                        </select>
                                        <p style="padding-top: 15px; display: none;" class="error-msg error_regija_id">
                                            Vnesite veljavno regija id</p>
                                    </div>
                                </div>
                            </div>

                            <div id="post-contact" class="seg-brd">
                                <h3>Kontaktni podatki</h3>
                                <p class="description">
                                    <i class="fas fa-info-circle"></i> Navedite kontaktne podatke preko katerih boste
                                    dosegljivi kupcem.
                                </p>

                                <div class="dd-row flx">
                                    <div id="phone-confirm" class="dd sms">
                                        <div class="input input-type-phone fw">
                                            <div class="input-inner">

                                                @auth
                                                    <div class="phone-prefix-select">
                                                        <select class="select" name="phone_prefix" required disabled>
                                                            <option
                                                                value="386" {{ \Illuminate\Support\Facades\Auth::user()->customer && \Illuminate\Support\Facades\Auth::user()->customer->country_code == '386' ? 'selected' : '' }}>
                                                                +386
                                                            </option>
                                                            <option
                                                                value="385" {{ \Illuminate\Support\Facades\Auth::user()->customer && \Illuminate\Support\Facades\Auth::user()->customer->country_code == '385' ? 'selected' : '' }}>
                                                                +385
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <input type="phone" name="phone" placeholder="Telefonska številka"
                                                           value="{{ \Illuminate\Support\Facades\Auth::user()->customer->telefon }}"
                                                           disabled
                                                           required
                                                    >
                                                @else
                                                    <div class="phone-prefix-select">
                                                        <select class="select" name="phone_prefix" required>
                                                            <option value="386" selected>+386</option>
                                                            <option value="385">+385</option>
                                                        </select>
                                                    </div>
                                                    <input type="phone" name="phone" placeholder="Telefonska številka"
                                                           required>

                                                @endauth
                                                <div class="input-decor">
                                                    <i class="decor fas fa-phone-alt"></i>
                                                    <i class="error-ico fas fa-exclamation-circle"></i>
                                                    <p class="below-msg">Po vnosu telefonske številke, kliknite gumb
                                                        ‘Pošlji SMS kodo’, nakar vam bo na SMS poslana 4 mestna
                                                        koda.</p>
                                                    <p class="error-msg error_phone">Vnesite veljaveno telefonsko
                                                        številko</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="send-sms btn blue" data-sms="modal-confirm-sms">
                                            <i class="fas fa-envelope"></i> Pošlji SMS kodo
                                        </div>
                                    </div>
                                    <div class="dd">
                                        <div class="input input-type-text fw">
                                            <div class="input-inner">

                                                @auth
                                                    <input type="email" name="contact_email"
                                                           placeholder="E-poštni naslov"
                                                           disabled
                                                           required
                                                           value="{{ \Illuminate\Support\Facades\Auth::user()->email }}"
                                                    >
                                                @else
                                                    <input type="email" name="contact_email"
                                                           placeholder="E-poštni naslov"
                                                           required
                                                    >
                                                @endauth

                                                <div class="input-decor">
                                                    <i class="decor fas fa-envelope"></i>
                                                    <i class="error-ico fas fa-exclamation-circle"></i>
                                                    <p class="error-msg error_contact_email">Vnesite veljaven e-poštni
                                                        naslov</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!\Illuminate\Support\Facades\Auth::user())
                                    <label class="ch">
                                        <input type="checkbox" name="notify_expiration" value="1" checked>
                                        <span class="box"><i class="far fa-check"></i>
                                    </span>
                                        <span class="text">Želim obvestilo o poteku oglasa</span>
                                    </label>
                                @endif
                            </div>

                            <div id="post-images" class="seg-brd">
                                <h3>Nalaganje fotografij</h3>
                                <p class="description">
                                    <i class="fas fa-info-circle"></i> Oglasu lahko dodate do 10 fotografij v formatu
                                    .jpg, .png.
                                </p>

                                <div id="post-images-panel"></div>

                                <p style="padding-top: 15px; display: none;" class="error-msg error_imgs">Vnesite
                                    veljavno images</p>

                            </div>

                            @if(!\Illuminate\Support\Facades\Auth::check())
                                <div id="post-register" class="seg-brd">
                                    <h3>Hitra registracija</h3>
                                    <p class="description">
                                        <i class="fas fa-info-circle"></i> Po želji lahko z oddajo oglasa opravite tudi
                                        hitro registracijo.<br>Postopek vzame 30 sekund, prihranili pa boste čas pri
                                        vnosu
                                        naslednjih oglasov ter imeli možnost urejanja.
                                    </p>
                                    <label class="ch">
                                        <input type="checkbox" name="quick_reg" value="1" checked>
                                        <span class="box"><i class="far fa-check"></i>
                                    </span>
                                        <span class="text">Želim se hitro registrirati</span>
                                    </label>
                                    <div id="quick-register">
                                        <div class="dd">
                                            <div class="input input-type-text fw">
                                                <div class="input-inner">
                                                    <input type="text" name="name" placeholder="Uporabniško ime"
                                                           required>
                                                    <div class="input-decor">
                                                        <i class="decor fas fa-user"></i>
                                                        <i class="error-ico fas fa-exclamation-circle"></i>
                                                        <p class="error-msg error_name">Neveljavno uporabniško ime</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="input input-type-email fw">
                                                <div class="input-inner">
                                                    <input type="email" name="email" placeholder="E-poštni naslov"
                                                           required>
                                                    <div class="input-decor">
                                                        <i class="decor fas fa-envelope"></i>
                                                        <i class="error-ico fas fa-exclamation-circle"></i>
                                                        <p class="error-msg error_email">Vnesite veljaven e-poštni
                                                            naslov</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dd">
                                            <div class="input input-type-password fw">
                                                <div class="input-inner">
                                                    <input type="password" name="password" placeholder="Prijavno geslo"
                                                           required>
                                                    <div class="input-decor">
                                                        <i class="decor fas fa-lock"></i>
                                                        <i class="error-ico fas fa-exclamation-circle"></i>
                                                        <p class="error-msg error_password">Vnesite veljavno geslo</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div id="post-confirm" class="seg-brd">
                                @if(!\Illuminate\Support\Facades\Auth::check())
                                    <div class="fw">
                                        <label class="ch">
                                            <input type="radio" name="tos" value="1" required>
                                            <span class="box">
                                                <i class="far fa-check"></i>
                                            </span>
                                            <span class="text">
                                                Strinjam se s
                                                <a href="#" target="_blank" class="lnk">
                                                    pogoji in pravili uporabe Oglasi.si
                                                </a>
                                            </span>
                                        </label>

                                    </div>
                                @endif
                                <a class="btn oval blue fw next">Potrdi in nadaljuj</a>
                            </div>
                        </div>

                    </div>

                    <div id="cp-page-5" data-step="4" class="create-post-page step">

                        <h2 class="heading">Objava oglasa</h2>
                        {{ renderSteps(4) }}
                        <div id="post-info-container">
                            <div id="post-published">
                                <i class="fas fa-check-circle"></i>
                                <div>
                                    <span>Brezplačni oglas je objavljen</span>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <a href="/profil/">
                                            Nadaljuj na moje oglase <i class="far fa-arrow-right"></i>
                                        </a>
                                    @else
                                        <a href="/profil/">
                                            Poglej oglas <i class="far fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div id="post-boost-container" class="seg-brd">
                                <h3>Možnost izpostavitve oglasa</h3>
                                <p class="description">
                                    <i class="fas fa-info-circle"></i> V kolikor želite izboljšati odziv na vaš oglas,
                                    izberite možnost izpostavitve oglasa ter način plačila.
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
                                                <?php
                                                //                                        P::renderCheckbox('use_boost', '', '1', false, false);
                                                ?>
                                                <div class="left">
                                                    <strong>Izpostavi oglas</strong>
                                                    <p>Veljavnost izpostavitve 7 dni</p>
                                                </div>
                                                <div id="cena" class="right">
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

                                                <div id="card" class="preview-post flx">

                                                </div>
                                            </div>

                                            <div class="payment">
                                                <div class="title">Izberite način plačila:</div>

                                                <div class="payment-method active">
                                                    <div class="head">
                                                        <label class="ch radio">
                                                            <input type="radio" name="payment_type" value="cards"
                                                                   checked>
                                                            <span class="box">
                                                                <i class="fas fa-circle"></i>
                                                            </span><span class="text">
                                                            </span>
                                                        </label>
                                                        <img src="/assets/res/ico/cards.png">
                                                        <strong>Plačilne kartice</strong>
                                                        <i class="far fa-chevron-down"></i>
                                                    </div>
                                                    <div class="more">
                                                        <p>
                                                            <i class="fas fa-check-circle"></i> Oglas bo izpostavljen
                                                            takoj.
                                                        </p>
                                                        <p>
                                                            Plačilo je možno z debetnimi ali kreditnimi karticami
                                                            <strong>Visa, MasterCard, Maestro</strong>. Po potrditvi
                                                            izbire boste preusmerjeni na vmesnik za varno plačevanje..
                                                        </p>
                                                    </div>
                                                </div>


                                                <div class="payment-method">
                                                    <div class="head">
                                                        <label class="ch radio">
                                                            <input type="radio" name="payment_type" value="pp">
                                                            <span class="box">
                                                                <i class="fas fa-circle"></i>
                                                            </span><span class="text">
                                                            </span>
                                                        </label>
                                                        <img src="/assets/res/ico/paypal.png">
                                                        <strong>PayPal</strong> <i class="far fa-chevron-down"></i>
                                                    </div>
                                                </div>

                                                <div class="payment-method">
                                                    <div class="head">
                                                        <label class="ch radio">
                                                            <input type="radio" name="payment_type" value="valu">
                                                            <span class="box">
                                                                <i class="fas fa-circle"></i>
                                                            </span><span class="text">
                                                            </span>
                                                        </label>
                                                        <img src="/assets/res/ico/valu.png"> <strong>VALÚ</strong>
                                                        <i class="far fa-chevron-down"></i>
                                                    </div>
                                                </div>

                                                <div class="payment-method">
                                                    <div class="head">
                                                        <label class="ch radio">
                                                            <input type="radio" name="payment_type" value="sms">
                                                            <span class="box">
                                                                <i class="fas fa-circle"></i>
                                                            </span><span class="text">
                                                            </span>
                                                        </label>
                                                        <img src="/assets/res/ico/sms.png">
                                                        <strong>SMS plačilo na 1919</strong>
                                                        <i class="far fa-chevron-down"></i>
                                                    </div>
                                                </div>


                                                <div class="payment-method">
                                                    <div class="head">
                                                        <label class="ch radio">
                                                            <input type="radio" name="payment_type" value="trr">
                                                            <span class="box">
                                                                <i class="fas fa-circle"></i>
                                                            </span><span class="text">
                                                            </span>
                                                        </label>
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

                @else

                    <div id="cp-page-limit" class="create-post-page active">
                        <h2 class="heading">Izbira paketa</h2>
                        {{ renderSteps(1) }}

                        <div class="create-post-page-content">
                            <p class="description">
                                <i class="fas fa-info-circle"></i> Brezplačno oglaševanje za pravne osebe velja do 5
                                objavljenih oglasov. Izberite paket, ki ustreza vašim zahtevam. Več o
                                <a href="#">ponudbi za pravne osebe</a>
                                .
                            </p>

                            <div id="paid-post-select" class="flx box-container">

                                <div
                                    class="box flx more {{ !\Illuminate\Support\Facades\Auth::check() ? 'disabled' : '' }}">
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
                                <i class="fas fa-info-circle"></i> Načini plačila: VALÚ, plačilne kartice (Visa,
                                MasterCard, Maestro), SMS, Paypal, UPN.
                                <a>Več o načinih plačila</a>
                            </div>

                        </div>
                    </div>

                @endif
            </form>
        </div>

    </div>

    <div id="modal-confirm-sms" class="modal">
        <div class="content">
            <strong class="tc">Na vašo telefonsko številko smo poslali SMS s potrditveno kodo. Vnesite jo sem:</strong>
            <div class="confirm-num">
                <input type="text" value="" placeholder="#" maxlength="1"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'');" autofocus/>
                <input type="text" value="" placeholder="#" maxlength="1"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
                <input type="text" value="" placeholder="#" maxlength="1"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
                <input type="text" value="" placeholder="#" maxlength="1"
                       oninput="this.value=this.value.replace(/[^0-9]/g,'');"/>
            </div>
            <div class="tc">
                <button class="btn oval blue disabled">Preveri kodo</button>
            </div>
        </div>
    </div>

@endsection
