@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/post.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lightgallery-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lg-thumbnail.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lg-zoom.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="/assets/js/pages/post.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initModalMap&v=weekly"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/lightgallery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/plugins/zoom/lg-zoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/plugins/thumbnail/lg-thumbnail.min.js"></script>
@endpush
@section('content')
    <div class="cw">

        <div class="intro-banner flx">
            <div class="banner"></div>
        </div>

        <div id="post" class="flx">

            <div class="content">

                <div class="tile">
                    <div class="head">
                        <div class="upper flx">
                            <strong class="tag">
                                {{ array_search($product->tip_oglasa, config('constants.product_type')) }}
                            </strong>
                            <strong class="price">{{ $product->cena }} €</strong>
                        </div>
                        <div class="title">
                            <h1>{{ $product->naslov }}</h1>
                        </div>
                    </div>

                    <div class="gallery">
                        <div class="gallery-main">
                            <img src=""/>
                            <div class="gallery-main-controls np">
                                <div class="arr left"><i class="fal fa-chevron-left"></i></div>
                                <div class="arr right"><i class="fal fa-chevron-right"></i></div>
                                <div class="fullscreen"><i class="fal fa-expand-alt"></i></div>
                                <div class="count"><span>1</span>&nbsp;od <?php //echo $productImagesCount; ?></div>
                            </div>
                        </div>
                        <?php /*if($enableGallery) { */?><!--
                        <div class="gallery-thumbnails">
                            <?php /*foreach($productImages as $i => $img) { */?>
                            <div class="gallery-thumbnail<?php /*echo $i === 0 ? ' active' : ''; */?>">
                                <img data-main="<?php /*echo $img; */?>" src="<?php /*echo $img; */?>"/>
                            </div>
                            <?php /*} */?>
                        </div>
                        --><?php /*} */?>
                    </div>

                    {{--<div id="lightgallery">
                        <?php foreach($productImages as $i => $img) { ?>
                        <a href="<?php echo $img; ?>">
                            <img src="<?php echo $img; ?>"/>
                        </a>
                        <?php } ?>
                    </div>--}}

                    <div class="controls flx np">
                        <a><i class="fal fa-bookmark"></i> Shrani oglas</a>
                        <a id="post-share-btn"><i class="fal fa-share-alt"></i> Deli oglas</a>
                        <a><i class="fal fa-print"></i> Natisni oglas</a>
                        <a data-modal="modal-report"><i class="fal fa-exclamation-triangle"></i> Prijavi zlorabo</a>

                        <div class="overlay share">
                            <div class="flx">
                                <a><i class="fab fa-facebook"></i> Facebook</a>
                                <a><i class="fas fa-envelope"></i> Posreduj prijatelju</a>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="tile">
                    <h2>Podatki in karakteristike</h2>
                    <table class="specs-tbl">
                        <tr>
                            <td>Stanje</td>
                            <td>Rabljeno</td>
                        </tr>
                        <tr>
                            <td>Originalna embalaža</td>
                            <td>Da</td>
                        </tr>
                        <tr>
                            <td>Račun</td>
                            <td>Da</td>
                        </tr>
                        <tr>
                            <td>Proizvajalec</td>
                            <td>LG</td>
                        </tr>
                        <tr>
                            <td>Dimenzije</td>
                            <td>100 x 100 x 100 cm</td>
                        </tr>
                        <tr>
                            <td>Ločljivost zaslona</td>
                            <td>100 x 100</td>
                        </tr>
                    </table>
                </div>

                <div class="tile">
                    <h2>Podrobnejši opis</h2>
                    <p>{!! $product->opis !!}</p>
                </div>

                <div class="tile">
                    <h2>Lokacija</h2>
                    <div class="location flx">
                        <p>Sveti Trije Kraljii v Slovenskih Goricah, LJ - Osrednjeslovenska</p>
                        <a href="#" data-modal="modal-map">
                            <i class="fas fa-map-marker-alt"></i> Prikaži lokacijo na zemljevidu
                        </a>
                    </div>
                </div>

                <div class="banner-container">
                    <div class="banner"></div>
                </div>


                @if(count($similarProducts))
                    <div class="tile np">
                        <h2>Sorodni oglasi</h2>
                        <div class="suggested-posts flx">
                            @foreach($similarProducts as $similarProduct)
                                <div class="sug-post">
                                    <img src="">
                                    <a href="/product/{{ $similarProduct->slug }}">{{ $similarProduct->naslov }}</a>
                                    <strong>{{ $similarProduct->cena }} €</strong>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="sidebar">

                @if($product->customer)
                    <div class="tile seller">

                        <!--

                            <div class="bio">
                                <div class="avatar">
                                    <span style="background-color:#EFA00B;">JN</span>
                                </div>
                                <a href="#">Janez Novak</a>
                                <p>ID uporabnika: 6757 </p>
                            </div>

                            <div class="info phone">
                                <i class="fa fa-phone fa-flip-horizontal"></i>
                                <a href="#" class="af">+ 386 41 556 858</a>
                            </div>

                            <div class="info location">
                                <i class="fa fa-map-marker-alt"></i>
                                <a href="#" class="af">Sveti Trije Kraljii v Slovenskih Goricah</a>
                            </div>

                            <div class="info contact">
                                <i class="fa fa-envelope"></i>
                                <a class="btn oval white brd">Kontaktiraj oglaševalca</a>
                            </div>

                            <div class="all-posts">
                                <a href="#">Vsi oglasi oglaševalca</a>
                            </div>

                            -->

                        <div class="bio">
                            <div class="avatar">
                                <img src="https://i.imgur.com/TrKgxgE.png">
                            </div>
                            <a href="#">{{ $product->customer->company_name }}</a>
                            <p>ID uporabnika: {{ $product->customer->id }} </p>
                        </div>

                        <div class="info phone">
                            <i class="fa fa-phone fa-flip-horizontal"></i>
                            <a href="#" class="af">{{ $product->customer->telefon }}</a>
                        </div>

                        <div class="info location multiline">
                            <i class="fa fa-map-marker-alt"></i>
                            <a href="#" class="af"><span>{{ $product->customer->company_addr }}</span>
                            </a>
                        </div>

                        <div class="info website">
                            <i class="fa fa-external-link-alt"></i>
                            <a href="#" class="af">www.atriva.com</a>
                        </div>

                        <div class="info contact">
                            <i class="fa fa-envelope"></i>
                            <a class="btn oval white brd" data-modal="modal-message">Kontaktiraj trgovca</a>
                        </div>

                        <div class="all-posts">
                            <a href="#">Vsi oglasi trgovca</a>
                        </div>

                    </div>
                @endif

                <div class="banner"></div>

                <div class="tile post-info">
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Objavljeno: <strong>{{ \Carbon\Carbon::parse($product->datum_vnosa)->format('d.m.Y H:i') }}</strong></li>
                        <li><i class="fas fa-clock"></i> Oglas poteče: <strong>{{ \Carbon\Carbon::parse($product->datum_poteka)->format('d.m.Y') }}</strong></li>
                        <li><i class="fas fa-eye"></i> Število ogledov: <strong>{{ $product->views_count }}</strong></li>
                    </ul>
                </div>

                <div class="banner small"></div>

            </div>

        </div>

    </div>

    <div id="modal-message" class="modal">
        <div class="content">
            <div class="message-content">
                <h2>Pošljite sporočilo oglaševalcu</h2>
                <div class="email-head">
                    <p>Prejemnik sporočila: <strong>Janez Novak</strong></p>
                    <p>
                        Zadeva: oglas na Oglasi.si -
                        <strong>LCD Monitor Samsung Syncmaster 19”” WIDE, AOC E2470SWH64616469499</strong>
                    </p>
                </div>
                <form class="email-form frm-inputs">
                    <div class="row">
                        @include('client.components.input', [
                            'attributes' => [
                                'name' => 'name',
                                'placeholder' => 'Vpišite vaše ime',
                                'icon' => null,
                                'errorMessage' => 'Vnesite veljavno ime',
                                'classes' => 'fw',
                                'type' => 'text',
                                'attrs' => 'required="required"'
                            ]
                        ])
                    </div>
                    <div class="row">
                        @include('client.components.input', [
                            'attributes' => [
                                'name' => 'email',
                                'placeholder' => 'Vpišite vaš e-poštni naslov',
                                'icon' => null,
                                'errorMessage' => 'Vnesite veljaven e-poštni naslov',
                                'classes' => 'fw',
                                'type' => 'email',
                                'attrs' => 'required="required"',
                                'belowText' => 'E-pošta'
                            ]
                        ])
                    </div>
                    <div class="row">
                        @include('client.components.input', [
                            'attributes' => [
                                'name' => 'msg',
                                'placeholder' => 'Napišite, kaj želite vprašati trgovca',
                                'icon' => null,
                                'errorMessage' => 'Vnesite veljavno sporočilo',
                                'classes' => 'fw',
                                'type' => 'textarea',
                                'attrs' => 'required="required"',
                                'belowText' => 'Sporočilo'
                            ]
                        ])
                    </div>
                    <div class="row">
                        <div class="g-recaptcha" data-sitekey="6LcTQIEeAAAAAGvsprOZVyMEp6FT_mSjeU6MWIkc" data-callback="captchaFormCb"></div>
                        <input type="hidden" name="captcha" required="required"/>
                        <?php /*P::renderCaptcha(); */?>
                    </div>
                    <div class="row">
                        <div class="row-last-btns">
                            <a class="btn oval white brd modal-close">Prekliči</a>
                            <a class="btn blue oval">Pošlji sporočilo</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="modal-report" class="modal">
        <div class="content">
            <div class="message-content">
                <div class="head"><h2>Prijavi zlorabo</h2></div>
                <form class="email-form frm-inputs">
                    <div class="row">
                        @include('client.components.input', [
                            'attributes' => [
                                'name' => 'msg',
                                'placeholder' => 'Napišite razloga zlorabe oglasa',
                                'icon' => null,
                                'errorMessage' => 'Vnesite veljaven razlog',
                                'classes' => 'fw',
                                'type' => 'textarea',
                                'attrs' => 'required="required"',
                                'belowText' => 'Sporočilo'
                            ]
                        ])
                    </div>
                    <div class="row">
                        <div class="g-recaptcha" data-sitekey="6LcTQIEeAAAAAGvsprOZVyMEp6FT_mSjeU6MWIkc" data-callback="captchaFormCb"></div>
                        <input type="hidden" name="captcha" required="required"/>
                        <?php /*P::renderCaptcha(); */?>
                    </div>
                    <div class="row">
                        <div class="row-last-btns">
                            <a class="btn oval white brd modal-close">Prekliči</a>
                            <a class="btn blue oval">Prijavi zlorabo</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-map" class="modal modal-map">
        <div class="content">
            <div id="map" data-lat="46.5576439" data-lng="15.6455854"></div>
        </div>
    </div>
@endsection
