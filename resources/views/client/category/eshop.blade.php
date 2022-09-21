@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/category.css" rel="stylesheet">
    <link href="/assets/css/pages/eshop.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"
          rel="stylesheet">
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
    <script src="/assets/js/pages/core.js"></script>
@endpush
@section('content')
    <div class="cw">
        @if(count($customersTrgovinas))
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
                                <li class="location">
                                    <i class="fas fa-map-marker-alt"></i> Naziv firme<br>
                                    {{ $customer->naslov }}<br>
                                    {{ $customer->regija->regija }}
                                </li>
                                <li>
                                    <i class="fas fa-phone fa-flip-horizontal"></i>
                                    <a href="tel:{{ $customer->telefon }}">{{ $customer->telefon }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:{{ $customer->email_address }}">{{ $customer->email_address }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-external-link"></i>
                                    <a target="_blank" href="{{ $customersTrgovinas[0]->spletna_stran }}">{{ $customersTrgovinas[0]->spletna_stran}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="right">
                        <div class="head flx">
                            <div class="title">
                                <h1>Uporabniško ime / naziv firme</h1>
                                <p>{{ $customersTrgovinas[0]->tocen_naziv }}</p>
                            </div>
                            <div class="social">
                                @if($customer->facebook)
                                    <a target="_blank" href="{{ $customer->facebook }}"><i class="fab fa-facebook"></i></a>
                                @endif
                                @if($customer->instagram)
                                    <a target="_blank" href="{{ $customer->instagram }}"><i class="fab fa-instagram"></i></a>
                                @endif

                                @if($customer->linkedin)
                                    <a target="_blank" href="{{ $customer->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                            </div>
                        </div>

                        <div class="description">
                            <p>
                                <strong>{{ $customersTrgovinas[0]->trgovina_opis }}</strong>
                            </p>
                            <br>
                            @if($customersTrgovinas[0]->delovni_cas)
                                <p>Delovni čas: {{ $customersTrgovinas[0]->delovni_cas }}</p>
                            @endif
                            @if($customersTrgovinas[0]->nacin_prevzema)
                                <p>Način prevzema in dostave: {{ $customersTrgovinas[0]->nacin_prevzema }}</p>
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

        <!--    --><?php
        //    P::renderBreadcrumbs([
        //        ['Domača stran', '/'],
        //        ['Poslovni uporabniki', '#'],
        //    ]);
        //    ?>


        {{--    <div class="breadcrumbs">--}}
        {{--        <ul>--}}
        {{--            <li><a href="">terwtwe</a><i class="far fa-chevron-right"> </i></li>--}}
        {{--        </ul>--}}
        {{--    </div>--}}

        @if($customersTrgovinas)
            <div class="sublinks-box tile">
                <h1>Poslovni uporabniki</h1>
                <ul class="flx">
                    @foreach($customersTrgovinas as $item)
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

        <div class="flx shop-divide">
            <div class="left banners">
                <div class="banner"></div>
                <div class="banner"></div>
            </div>

            <div class="right">

                <div class="sort-by flx">
                    <div class="search">
                        <input type="text" name="searchQuery" placeholder="Išči.."/><i id="searchQueryButton"
                                                                                       class="far fa-search fa-flip-horizontal"></i>
                        <input type="hidden" name="customer_id" value="{{ $result[0]->user_id }}">
                    </div>
                    <p>Število rezultatov: <span class="result-count">{{ $resultCount }}</span></p>
                    <select id="sortCompanyFilter" class="select" name="sort" data-placeholder="Razvrsti trgovine">
                        <option></option>
                        <option value="cena">Po ceni</option>
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






