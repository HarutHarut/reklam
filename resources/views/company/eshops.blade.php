@extends('layouts.app')
@push('styles')
    {{--    <link href="/assets/css/pages/category.css" rel="stylesheet">--}}
    <link href="/assets/css/pages/eshops.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"
          rel="stylesheet">
{{--    <style>--}}
{{--        html .irs--round .irs-bar, html .irs--round .irs-handle, .pagination a.active,--}}
{{--        html .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable, .catColor {--}}
{{--            background-color: {{ $category->color_filters ?? $category->kategorije->children[0]->parent->color_filters ?? '#0075c4' }}           !important;--}}
{{--        }--}}
{{--    </style>--}}
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
    <script src="/assets/js/pages/eshops.js"></script>
    <script src="/assets/js/pages/core.js"></script>
@endpush
@section('content')

    <div class="cw">

        <div class="intro-banner flx">
            <div class="banner"></div>
        </div>

        @if(isset($category) && $category !== '')
            {{ Breadcrumbs::render('company.index', $category) }}
        @endif
        <div class="sublinks-box tile">
            <h1>Poslovni uporabniki</h1>
            <ul class="flx">
                @foreach($customerCategories as $customerCategorie)
                    <li>
                        <a href="{{ asset('company/category/' . $customerCategorie->slug) }}">
                            <strong>{{ $customerCategorie->cc_name }}</strong>
                            <span>{{ count($customerCategorie->customersTrgovinas) }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flx shop-divide">
            <div class="left banners">
                <div class="banner"></div>
                <div class="banner"></div>
            </div>

            <div class="right">
                <input type="hidden" name="category_id" value="{{ $customerCategorie->id }}">
                <form id="searchForm" action="{{ asset('company/category/' . $customerCategorie->slug) }}" method="GET">
                    <div class="sort-by flx">

                        <div class="search">
                            <input type="text" name="searchCompany"
                                   placeholder="Išči med {{ $customersTrgovinasCount }} trgovinami.."/><i
                                class="far fa-search fa-flip-horizontal"></i>
                        </div>
                        <p>Število rezultatov: {{ $resultCount }}</p>
                        {{--                        <select class="select" name="sort" data-placeholder="Razvrsti trgovine">--}}
                        {{--                            <option></option>--}}
                        {{--                            <option value="price">Po ceni</option>--}}
                        {{--                            <option value="date">Zadnji oglasi</option>--}}
                        {{--                        </select>--}}

                    </div>
                </form>

                {!! $results->withQueryString()->links() !!}

                <div class="post-results">
                    @foreach($results as $result)
                        <div class="result flx">
                            <div class="img">
                                @if (isset($result->logo) && $result->logo !== null && $result->logo !== '')
                                    <img
                                        style="width: 210px; height: 150px; object-fit: cover;"
                                        src="{{ $result->logo }}"
                                    >
                                @else
                                    <img
                                        style="width: 210px; height: 150px; object-fit: cover;"
                                        src="https://media.istockphoto.com/vectors/default-image-icon-vector-missing-picture-page-for-website-design-or-vector-id1357365823?k=20&m=1357365823&s=612x612&w=0&h=ZH0MQpeUoSHM3G2AWzc8KkGYRg4uP_kuu0Za8GFxdFc=">
                                @endif
                            </div>
                            <div class="bio">
                                <div class="upper flx">
                                    <div class="general">
                                        <h3>
                                            <a href="{{ asset('company/customers/' . $result->slug) }}">{{ $result->tocen_naziv }}</a>
                                        </h3>
                                        <ul class="props">
                                            <?php
                                            $address_company = $result->customer->naslov ?? ' ';
                                            $address_company .= $result->customer->regija->regija ?? ' ';
                                            ?>
                                            @if(isset($result->trgovina_opis) && $result->trgovina_opis !== '' )
                                                <li><i class="fas fa-info-circle"></i>
                                                    {{ $result->trgovina_opis }}
                                                </li>
                                            @endif
                                            @if(isset($address_company) && $address_company !== '')
                                                <li><i class="fas fa-map-marker-alt"></i>
                                                    {{ $address_company }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="meta flx">
                                        <strong class="post-count">Število
                                            oglasov: {{ count($result->customer->maliOglases) }}</strong>
                                        <!--<a href="{#{ #asset('company/customers/' . $result->slug) }}" class="btn oval">Spletna trgovina <i
                                                class="fas fa-shopping-cart"></i></a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                {!! $results->withQueryString()->links() !!}

            </div>

        </div>

    </div>

    <script src="/assets/js/pages/category.js"></script>


@endsection
