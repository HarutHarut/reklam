@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@push('styles')
    <link href="/assets/css/pages/post.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lightgallery-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lg-thumbnail.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/css/lg-zoom.css">
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
        <?php
        $cat = \App\Services\FilterServices::categoryAlphaParent($product->kategorijeTip0 ?? $product->kategorijeTip1);
        ?>
        <div class="intro-banner flx">
            <div class="banner"></div>
        </div>
        <div id="post" class="flx">

            <div class="content">

                <div class="tile">
                    <div class="head">
                        <div class="upper flx">
                            @if($tipOglasa)
                                <strong class="tag"
                                >
                                    {{ $tipOglasa }}
                                </strong>
                            @endif
                            @if(\App\Services\FilterServices::categoryAlphaParent($product->kategorijeTip1)->slug !== 'zasebni-stiki')
                                <strong class="price">
                                    {{ $product->cena }} €
                                </strong>
                            @endif
                        </div>
                        <div class="title">
                            <h1>{{ $product->naslov }}</h1>
                        </div>
                    </div>

                    @if(count($product->listingImages))

                        <div class="gallery"
                             data-blur="{{ $cat->slug == 'zasebni-stiki' && (!\Illuminate\Support\Facades\Auth::check() || \App\Services\PaidService::checkPremiumPackage() == 0) ? 'blur' : '' }}">
                            <div class="gallery-main">
                                <img
                                    @if($cat->slug == 'zasebni-stiki' && (!\Illuminate\Support\Facades\Auth::check() || \App\Services\PaidService::checkPremiumPackage() == 0))
                                    class="blur"
                                    @endif
                                    title="{{ $product->listingImagesFull[0]['title'] }}"
                                    alt="{{ $product->listingImagesFull[0]['title'] }}"
                                    src="{{ $product->listingImagesFull[0]['url'] }}"/>
                                <div class="gallery-main-controls np">
                                    <div class="arr left"><i class="fal fa-chevron-left"></i></div>
                                    <div class="arr right"><i class="fal fa-chevron-right"></i></div>
                                    <div class="fullscreen"><i class="fal fa-expand-alt"></i></div>
                                    <div class="count"><span>1</span>&nbsp;od {{ count($product->listingImagesFull) }}
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-thumbnails">
                                @foreach($product->listingImagesThumb as $item)
                                    <div class="gallery-thumbnail{{ $loop->first ? ' active' : '' }}">
                                        <img
                                            @if($cat->slug == 'zasebni-stiki' && (!\Illuminate\Support\Facades\Auth::check() || \App\Services\PaidService::checkPremiumPackage() == 0))
                                                class="blur"
                                            @endif
                                            title="{{ $item->parentImage ? $item->parentImage->title : "image" }}"
                                            data-title="{{ $item->parentImage ? $item->parentImage->title : "image" }}"
                                            alt="{{ $item->parentImage ? $item->parentImage->title : "image" }}"
                                            data-alt="{{ $item->parentImage ? $item->parentImage->title : "image" }}"
                                            data-main="{{ $item->parentImage ? $item->parentImage->url : $item->url }}"
                                            src="{{ $item->url }}"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div id="lightgallery">
                        @foreach($product->listingImagesThumb as $item)
                            <a href="{{ $item->parentImage ? $item->parentImage->url : $item->url }}">
                                <img
                                    @if($cat->slug == 'zasebni-stiki' && (!\Illuminate\Support\Facades\Auth::check() || \App\Services\PaidService::checkPremiumPackage() == 0))
                                        class="blur"
                                    @endif
                                    title="{{ $item->parentImage ? $item->parentImage->title : "image" }}"
                                    alt="{{ $item->parentImage ? $item->parentImage->title : "image" }}"
                                    src="{{ $item->url }}"/>
                            </a>
                        @endforeach
                    </div>

                    <div class="controls flx np">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <a
                                onclick="favorite({{ $product->id }}, this)"
                                class="{{ in_array($product->id, auth()->user()->favorite->pluck('id')->toArray())  ? 'active' : '' }}"
                            >
                                <i class="fal fa-bookmark"></i>
                                Shrani oglas
                            </a>
                        @else
                            <a
                                onclick="favorite({{ $product->id }}, this)"
                                class="{{ get_cookie() ? (in_array($product->id, get_cookie()) ? 'active' : '') : '' }}"
                            >
                                <i class="fal fa-bookmark"></i>
                                Shrani oglas
                            </a>
                        @endif
                        <a id="post-share-btn"><i class="fal fa-share-alt"></i> Deli oglas</a>
                        <a onclick="window.print()"><i class="fal fa-print"></i> Natisni oglas</a>
                        <a data-modal="modal-report"><i class="fal fa-exclamation-triangle"></i> Prijavi zlorabo</a>

                        <div class="overlay share">
                            <div class="flx">
                                <a target="_blank"
                                   href="https://www.facebook.com/sharer/sharer.php?u={{ $_SERVER['APP_URL'] . $_SERVER['REQUEST_URI'] }}"><i
                                        class="fab fa-facebook"></i> Facebook</a>
                                <a href="mailto:?body={{ $_SERVER['APP_URL'] . $_SERVER['REQUEST_URI'] }}"><i
                                        class="fas fa-envelope"></i> Posreduj prijatelju</a>
                            </div>
                        </div>

                    </div>
                </div>


                @if (count($customFilters))
                    <div class="tile">
                        <h2>Podatki in karakteristike</h2>
                        <table class="specs-tbl">
                            @foreach ($customFilters as $key => $item)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $item }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif


                <div class="tile">
                    <h2>Podrobnejši opis</h2>
                    <p>
                        {{ $product->opis }}
                    </p>
                </div>

                @if(isset($product->regije))
                    <div class="tile">
                        <h2>Lokacija</h2>
                        <div class="location flx">
                            <p>
                                {{ $product->regije->regija ?? '' }}
                            </p>
                            <a
                                href=""
                                data-modal="modal-map">
                                <i class="fas fa-map-marker-alt"></i> Prikaži lokacijo na zemljevidu
                            </a>
                        </div>
                    </div>
                @endif
                <div class="banner-container">
                    <div class="banner"></div>
                </div>

                @if(count($recommendations))
                    <div class="tile np">
                        <h2>Sorodni oglasi</h2>
                        <div class="suggested-posts flx">
                            @foreach($recommendations as $recommendation)
                                <?php
                                $recommendationCat = \App\Services\FilterServices::categoryAlphaParent($recommendation->kategorijeTip0 ?? $recommendation->kategorijeTip1);
                                ?>
                                <div class="sug-post">
                                    <img
                                        @if($recommendationCat->slug == 'zasebni-stiki' && (!\Illuminate\Support\Facades\Auth::check() || \App\Services\PaidService::checkPremiumPackage() == 0))
                                        class="blur"
                                        @endif
                                        title="{{ count($recommendation->listingImagesThumb) ?
                                                        $recommendation->listingImagesThumb[0]->title :
                                                        'image'
                                                      }}"
                                        alt="{{ count($recommendation->listingImagesThumb) ?
                                                        $recommendation->listingImagesThumb[0]->title :
                                                        'image'
                                                      }}"
                                        src="{{ count($recommendation->listingImagesThumb) ?
                                                        $recommendation->listingImagesThumb[0]->url :
                                                        'https://media.istockphoto.com/vectors/default-image-icon-vector-missing-picture-page-for-website-design-or-vector-id1357365823?k=20&m=1357365823&s=612x612&w=0&h=ZH0MQpeUoSHM3G2AWzc8KkGYRg4uP_kuu0Za8GFxdFc='
                                                      }}">
                                    <a href="{{ route('category.listing', ['slug' => $categorySlug, 'listingSlug' => $recommendation->slug]) }}">{{ $recommendation->naslov }}</a>
                                    <strong>{{ $recommendation->cena }} €</strong>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="sidebar">
                @if($product->customer && $product->customer->id == config('constants.non_logged_user'))
                    <div class="tile seller">
                        @if($product->customer->id == config('constants.non_logged_user'))
                            <div class="info">uporabnik brez prijave</div>
                        @endif
                        @if(count($product->maliOglasiKontakts))
                            <div class="info phone">
                                <i class="fa fa-phone fa-flip-horizontal"></i>
                                <a href="{{ 'tel:+' . $product->maliOglasiKontakts[0]->country_code . $product->maliOglasiKontakts[0]->telefon }}"
                                   class="af">+ {{ $product->maliOglasiKontakts[0]->country_code . $product->maliOglasiKontakts[0]->telefon }}</a>
                            </div>
                        @endif
                        @if($product->customer->naslov || $product->customer->regija)
                            <div class="info location multiline">
                                <i class="fa fa-map-marker-alt"></i>
                                <a href="#"
                                   class="af"
                                   data-modal="modal-map2">
                                    {{ $product->customer->naslov ?? '' }} {{ $product->customer->regija->regija ?? '' }}
                                    {{ $product->customer->regija ? $product->customer->regija->country->countries_name : '' }}
                                    {{ $product->customer->regija->parent->regija ?? '' }}

                                </a>
                            </div>
                        @endif

                        <div class="banner"></div>

                        <div class="tile post-info">
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Objavljeno:
                                    <strong>{{ \Carbon\Carbon::parse($product->datum_vnosa)->format('d.m.Y') . ' ob ' . \Carbon\Carbon::parse($product->datum_vnosa)->format('h:i') }}</strong>
                                </li>
                                <li><i class="fas fa-clock"></i> Oglas poteče:
                                    <strong>{{ \Carbon\Carbon::parse($product->datum_poteka)->format('d.m.Y') }}</strong>
                                </li>
                                <li><i class="fas fa-eye"></i> Število ogledov:
                                    <strong>{{ $product->views_count }}</strong>
                                </li>
                            </ul>
                        </div>

                        <div class="banner small"></div>

                        @else
                            <div class="tile seller">
                                <div class="bio">
                                    @if(isset($product->customersTrgovinas->logo) && $product->customersTrgovinas->logo !== null && $product->customersTrgovinas->logo !== '')
                                        <div class="avatar">
                                            <img alt="logo" title="logo" src="{{ $product->customersTrgovinas->logo }}">
                                        </div>
                                    @endif
                                    @if(isset($product->customersTrgovinas->tocen_naziv))
                                        @if(isset($product->customersTrgovinas->spletna_stran) && $product->customersTrgovinas->spletna_stran !== '')
                                            <a href="{{ $product->customersTrgovinas->spletna_stran }}">
                                                {{ $product->customersTrgovinas->tocen_naziv }}
                                            </a>
                                        @else
                                            <p>{{ $product->customersTrgovinas->tocen_naziv }}</p>
                                        @endif
                                    @endif
                                    @if(empty($product->customersTrgovinas))
                                        <p>{{ $product->customer->user->name ?? '' }}</p>
                                    @endif

                                    @if($product->customer)
                                        <p>ID uporabnika: {{ $product->customer->id }} </p>
                                    @endif
                                </div>

                                @if(isset($product->customer->telefon) && $product->customer->telefon !== 0)
                                    <div class="info phone">
                                        <i class="fa fa-phone fa-flip-horizontal"></i>
                                        <a href="{{ 'tel:+' . $product->customer->country_code.$product->customer->telefon }}"
                                           class="af">+ {{$product->customer->country_code}}{{ $product->customer->telefon }}</a>
                                    </div>
                                @endif
                                @if(isset($product->customer->naslov) && $product->customer->naslov !== '' || isset($product->customer->regija) && $product->customer->regija !== 0)
                                    <div class="info location multiline">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <a href="#"
                                           class="af"
                                           data-modal="modal-map2">
                                            {{ $product->customer->naslov ?? '' }} {{ $product->customer->regija->regija ?? '' }}
                                            {{ $product->customer->regija->country->countries_name ?? '' }}
                                            {{ $product->customer->regija->parent->regija ?? '' }}

                                        </a>
                                    </div>
                                @endif
                                @if(isset($product->customersTrgovinas->spletna_stran )&& $product->customersTrgovinas->spletna_stran !== '')
                                    <div class="info website">
                                        <i class="fa fa-external-link-alt"></i>
                                        <a target="blank"
                                           style="overflow-wrap: anywhere"
                                           href="{{ $product->customersTrgovinas->spletna_stran }}"
                                           class="af">{{ $product->customersTrgovinas->spletna_stran }}</a>
                                    </div>
                                @endif
                                <div class="info contact">
                                    <i class="fa fa-envelope"></i>
                                    <a class="btn oval white brd" data-modal="modal-message">Kontaktiraj trgovca</a>
                                </div>
                                @if(isset($product->customersTrgovinas->slug))
                                    <div class="all-posts">
                                        <a href="{{ asset('company/customers/' . $product->customersTrgovinas->slug) }}">Vsi
                                            oglasi
                                            trgovca</a>
                                    </div>
                                @endif
                            </div>

                            <div class="banner"></div>

                            <div class="tile post-info">
                                <ul>
                                    <li><i class="fas fa-check-circle"></i> Objavljeno:
                                        <strong>{{ \Carbon\Carbon::parse($product->datum_vnosa)->format('d.m.Y') . ' ob ' . \Carbon\Carbon::parse($product->datum_vnosa)->format('h:i') }}</strong>
                                    </li>
                                    <li><i class="fas fa-clock"></i> Oglas poteče:
                                        <strong>{{ \Carbon\Carbon::parse($product->datum_poteka)->format('d.m.Y') }}</strong>
                                    </li>
                                    <li><i class="fas fa-eye"></i> Število ogledov:
                                        <strong>{{ $product->views_count }}</strong>
                                    </li>
                                </ul>
                            </div>

                            <div class="banner small"></div>
                        @endif
                    </div>
            </div>

            <div id="modal-message" class="modal">
                <div class="content">
                    <div class="message-content">
                        <h2>Pošljite sporočilo oglaševalcu</h2>
                        <div class="email-head">
                            <p>Prejemnik sporočila: <strong>{{ $product->customer->username ?? '' }}</strong></p>
                            <p>
                                Zadeva: oglas na Oglasi.si -
                                <strong>{{ $product->naslov }}</strong>
                            </p>
                        </div>
                        <form class="email-form frm-inputs" method="POST">
                            <div class="row">
                                <div class="input input-type-text fw"><strong>Ime</strong>
                                    <div class="input-inner">
                                        <input class="contact-message" name="name" placeholder="Vpišite vaše ime"
                                               required>
                                        <input type="hidden" class="contact-message" name="product_id"
                                               value="{{ $product->id }}">
                                        <div class="input-decor">
                                            <i class="decor"></i>
                                            <i class="error-ico fas fa-exclamation-circle"></i>
                                            <p style="display: none;" class="error-name">Vnesite veljavno ime</p>
                                            <span class="after-text">Ime</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input input-type-text fw"><strong>E-pošta</strong>
                                    <div class="input-inner">
                                        <input class="contact-message" name="email"
                                               placeholder="Vpišite vaš e-poštni naslov" required>
                                        <div class="input-decor">
                                            <i class="decor"></i>
                                            <i class="error-ico fas fa-exclamation-circle"></i>
                                            <p style="display: none;" class="error-email">Vnesite veljaven e-poštni
                                                naslov</p>
                                            <span class="after-text">E-pošta</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input input-type-text fw"><strong>Sporočilo</strong>
                                    <div class="input-inner">
                                    <textarea class="contact-message" name="msg"
                                              placeholder="Napišite, kaj želite vprašati trgovca"
                                              required></textarea>
                                        <div class="input-decor">
                                            <i class="decor"></i>
                                            <i class="error-ico fas fa-exclamation-circle"></i>
                                            <p style="display: none;" class="error-msg">Vnesite veljavno sporočilo</p>
                                            <span class="after-text">Sporočilo</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="row-last-btns">
                                    <a class="btn oval white brd modal-close">Prekliči</a>
                                    <a class="btn blue oval" id="message_form">Pošlji sporočilo</a>
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
                                <div class="input input-type-text fw"><strong>Sporočilo</strong>
                                    <div class="input-inner">
                                    <textarea class="report-message" name="msg"
                                              placeholder="Napišite razloga zlorabe oglasa"
                                              required
                                    ></textarea>
                                        <input type="hidden" class="report-message" name="product_id"
                                               value="{{ $product->id }}">
                                        <div class="input-decor">
                                            <i class="decor"></i>
                                            <i class="error-ico fas fa-exclamation-circle"></i>
                                            <p class="error_msg"></p>
                                            <span class="after-text">Sporočilo</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                //                                    P::renderCaptcha();
                                ?>
                            </div>
                            <div class="row">
                                <div class="row-last-btns">
                                    <a class="btn oval white brd modal-close">Prekliči</a>
                                    <a class="btn blue oval" id="report_form">Prijavi zlorabo</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="modal-map" class="modal modal-map">
                <div class="content">

                    <?php
                    $address_listing = $product->regije->regija ?? '';
                    ?>
                    <iframe width="600" height="500" id="gmap_canvas"
                            src="{{ 'https://maps.google.com/maps?q=' . str_replace(' ', '+', $address_listing) . '&t=&z=15&ie=UTF8&iwloc=&output=embed' }}"
                    ></iframe>
                </div>
            </div>
            <div id="modal-map2" class="modal modal-map">
                <div class="content">

                    <?php
                    $address_company = $product->customer->naslov ?? '';
                    $address_company .= $product->customer->regija->regija ?? '';
                    ?>
                    <iframe width="600" height="500" id="gmap_canvas"
                            src="{{ 'https://maps.google.com/maps?q=' . str_replace(' ', '+', $address_company) . '&t=&z=15&ie=UTF8&iwloc=&output=embed' }}"
                    ></iframe>
                </div>
            </div>

        </div>
@endsection
