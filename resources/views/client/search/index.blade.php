@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/category.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"
          rel="stylesheet">
    <link href="/assets/css/pages/eshop.css" rel="stylesheet">
    <style>
        html .irs--round .irs-bar, html .irs--round .irs-handle, .pagination a.active,
        html .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable, .catColor {
            background-color: {{ $category->color_filters ?? $category->kategorije->children[0]->parent->color_filters ?? '#0075c4' }}     !important;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
    <script src="/assets/js/pages/category.js"></script>
@endpush
@section('content')
    <div class="cw">

        @if($customer && count($customer->customersTrgovinas) && !$filtersShow)
            <div id="eshop-bio">
                <div class="cover"></div>
                <div class="bio tile flx">
                    <div class="left">
                        @if($customer->customersTrgovinas[0]->logo !== '')
                            <div class="logo"><img src="{{ $customer->customersTrgovinas[0]->logo }}"/></div>
                        @else
                            <div class="img">{{ $customer->username }}</div>
                        @endif
                        <div class="info">
                            <ul>
                                @if(isset($customer->customersTrgovinas[0]->tocen_naziv) && $customer->customersTrgovinas[0]->tocen_naziv !== '')
                                    <li class="location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $customer->customersTrgovinas[0]->tocen_naziv }}<br>
                                        {{ $customer->naslov }}<br>
                                        {{ $customer->regija->regija }}
                                    </li>
                                @endif
                                @if(isset($customer->telefon) && $customer->telefon !== '')
                                    <li>
                                        <i class="fas fa-phone fa-flip-horizontal"></i>
                                        <a href="tel:+{{$customer->country_code}}{{ $customer->telefon }}">+{{$customer->country_code}}{{ $customer->telefon }}</a>
                                    </li>
                                @endif

                                @if(isset($customer->email_address) && $customer->email_address!='')
                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <a href="mailto:{{ $customer->email_address }}">{{ $customer->email_address }}</a>
                                    </li>
                                @endif
                                @if(isset($customer->customersTrgovinas[0]->spletna_stran) && $customer->customersTrgovinas[0]->spletna_stran !== '')
                                    <li>
                                        <i class="fas fa-external-link"></i>
                                        <a target="_blank" href="{{ $customer->customersTrgovinas[0]->spletna_stran }}">{{ $customer->customersTrgovinas[0]->spletna_stran}}</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <div class="right">
                        <div class="head flx">
                            <div class="title">
                                <h1>Uporabniško ime / naziv firme</h1>
                                <p>{{ $customer->customersTrgovinas[0]->tocen_naziv }}</p>
                            </div>
                            <div class="social">
                                @if($customer->facebook)
                                    <a target="_blank" href="{{ $customer->facebook }}"><i class="fab fa-facebook"></i></a>
                                @endif
                                @if($customer->instagram)
                                    <a target="_blank" href="{{ $customer->instagram }}"><i
                                            class="fab fa-instagram"></i></a>
                                @endif

                                @if($customer->linkedin)
                                    <a target="_blank" href="{{ $customer->linkedin }}"><i
                                            class="fab fa-linkedin-in"></i></a>
                                @endif
                            </div>
                        </div>

                        <div class="description">
                            <p>
                                <strong>{{ $customer->customersTrgovinas[0]->trgovina_opis }}</strong>
                            </p>
                            <br>
                            @if($customer->customersTrgovinas[0]->delovni_cas)
                                <p>Delovni čas: {{ $customer->customersTrgovinas[0]->delovni_cas }}</p>
                            @endif
                            @if($customer->customersTrgovinas[0]->nacin_prevzema)
                                <p>Način prevzema in dostave: {{ $customer->customersTrgovinas[0]->nacin_prevzema }}</p>
                            @endif
                        </div>

                        <div class="date-registered">
                            Uporabnik od {{ \Carbon\Carbon::parse($customer->account_created)->format('d.m.Y') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="intro-banner flx">
            <div class="banner"></div>
        </div>
        @if($customer && count($customer->customersTrgovinas) && !$filtersShow)
            <div class="sublinks-box tile">
                <h1>Poslovni uporabniki</h1>
                <ul class="flx">
                    @foreach($customer->customersTrgovinas as $item)
                        @if($item)
                            <li>
                                <a href="#">
                                    <strong>{{ $item->customersCategory->cc_name }}</strong>
                                    <span class="catColor">{{ $item->customersCategory->cc_num_shops }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif


        @if($filtersShow)
            {{ Breadcrumbs::render('search') }}
            @if(isset($searchResultCategories))
                <div class="sublinks-box tile np" id="searchResultCategories">
                    @include('client.search._searchResultCategories', ['searchResultCategories' => $searchResultCategories])
                </div>
            @endif
        @endif
        <div class="flx shop-divide">
            <div class="left post-filters np">
                @if($filtersShow)
                    <h2><i class="fal fa-sliders-h"></i> Dodatni kriteriji</h2>
                    @if(count($regions))
                        <div class="filter open">
                            <h3 class="flx">Regija <i class="far fa-chevron-down"></i></h3>
                            <div class="filter-scroll">
                                <ul class="filter-checklist regions-filter">
                                    @foreach($regions as $region)
                                        <li>
                                            <label>
                                                <input type="checkbox" value="{{ $region->id }}"
                                                       name="regions"{{ in_array($region->id,  $checkedRegions) ? ' checked' : '' }}>
                                                <span
                                                    data-color="{{ isset($category) && \App\Services\FilterServices::categoryAlphaParent($category)->color_filters ? \App\Services\FilterServices::categoryAlphaParent($category)->color_filters : '#0075c4' }}"
                                                    class="text">{{ $region->regija }}<i
                                                        class="far fa-times"></i></span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endif

                @if(count($productTypes) && $filtersShow)
                    <div class="filter open">
                        <h3 class="flx">Vrsta ponudbe <i class="far fa-chevron-down"></i></h3>
                        <div class="filter-scroll">
                            <ul class="filter-checklist productType-filter">
                                @foreach($productTypes as $key => $value)
                                    <li>
                                        <label>
                                            <input type="radio" value="{{ $value }}" name="productType"
                                                   @if($_GET !== [] && isset($_GET['productType']) && in_array($value, json_decode($_GET['productType'])))
                                                       checked
                                                   @endif
                                            >
                                            <span
                                                data-color="{{ isset($category) && \App\Services\FilterServices::categoryAlphaParent($category)->color_filters ? \App\Services\FilterServices::categoryAlphaParent($category)->color_filters : '#0075c4' }}"
                                                class="text">{{ $key }}<i class="far fa-times"></i></span>

                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if($filtersShow)
                    <div class="filter open">
                        <h3 class="flx">Cena <i class="far fa-chevron-down"></i></h3>
                        <div class="filter-scroll">
                            <div class="filter-range">

                                <input
                                    type="hidden"
                                    class="rangeslider"
                                    name="price"
                                    value=""
                                    data-type="double"
                                    data-min="0"
                                    data-max="{{ $_GET && isset($_GET['priceRange']) && $_GET['priceRange'] !== '' ? explode(';', $_GET['priceRange'])[1] : $maxPrice }}"
                                    data-from="0"
                                    data-to="{{ $_GET && isset($_GET['priceRange']) && $_GET['priceRange'] !== '' ? explode(';', $_GET['priceRange'])[1] : $maxPrice }}"/>

                                <div class="range-input flx">
                                    <input style="padding: 2px" type="text" class="range-input-from" value="{{ $_GET && isset($_GET['priceRange']) ? explode(';', $_GET['priceRange'])[0] : 0 }}"/> -
                                    <input style="padding: 2px" type="text" class="range-input-to"
                                           value="{{ $_GET && isset($_GET['priceRange']) && $_GET['priceRange'] !== '' ? explode(';', $_GET['priceRange'])[1] : $maxPrice }}"/> €
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                <div id="filter-controls" class="filter tc" style="display: {{ !$filtersShow ? 'none' : 'block' }}">
                    <button
                        data-color="{{ $category->color_filters ?? $category->kategorije->children[0]->parent->color_filters ?? '#0075c4' }}"
                        class="btn oval update bgt">Posodobi filter
                    </button>
                </div>

                <div class="banner"></div>
                <div class="sponsored-shop">
                    <div class="shop">
                        <img src="https://i.imgur.com/rEtylvK.png">
                        <p>Pintera d.o.o.</p>
                    </div>
                    <a href="#">Oglasi trgovca</a>
                </div>
                <div class="sponsored-shop">
                    <div class="shop">
                        <img src="https://i.imgur.com/Gmn2C0t.png">
                        <p>Hemp light sp.</p>
                    </div>
                    <a href="#">Oglasi trgovca</a>
                </div>
            </div>
            <div class="right">
                <div class="sort-by flx sort-filter">
                    @if($customer && !$filtersShow)
                        <div class="search">
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <input type="hidden" name="dontShowFilter" value="1">
                        </div>
                    @endif
                    <p>Število rezultatov: <span id="result-count" class="result-count">{{ $resultCount }}</span></p>
                    <select class="select" name="sort" data-placeholder="Razvrsti oglase">
                        <option></option>
                        <option class="po-ceni" value="cena">Po ceni</option>
                        <option value="datum_vnosa">Zadnji oglasi</option>
                    </select>
                </div>
                <div id="result">
                    @include('client.includes.pagination', ['result' => $result])
                </div>
            </div>
        </div>
    </div>
@endsection
