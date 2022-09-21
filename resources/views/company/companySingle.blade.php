@extends('layouts.app')
@push('styles')
    {{--    <link href="/assets/css/pages/category.css" rel="stylesheet">--}}
    <link href="/assets/css/pages/eshop.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"
          rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
    {{--    <script src="/assets/js/pages/eshop.js"></script>--}}
    {{--    <script src="/assets/js/pages/core.js"></script>--}}
@endpush

@section('content')

    <div class="cw">

        <div id="eshop-bio">
            <div class="cover"></div>
            <div class="bio tile flx">
                <div class="left">
                    @if($company->logo !== '')
                        <div class="logo"><img src="{{ $company->logo }}"/></div>
                    @else
                        <div class="img">{{ $company->customer->username }}</div>
                    @endif
                    <div class="info">
                        <ul>
                            @if(isset($company->tocen_naziv) && $company->tocen_naziv !== '')
                                <li class="location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $company->tocen_naziv }}<br>
                                    {{ $company->customer->naslov }}<br>
                                    {{ $company->customer->regija->regija }}
                                </li>
                            @endif
                            @if(isset($company->customer->telefon) && $company->customer->telefon !== '')
                                <li>
                                    <i class="fas fa-phone fa-flip-horizontal"></i>
                                    <a href="tel:+{{$company->customer->country_code}}{{ $company->customer->telefon }}">+{{$company->customer->country_code}}{{ $company->customer->telefon }}</a>
                                </li>
                            @endif

                            @if(isset($company->customer->email_address) && $company->customer->email_address!='')
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <a href="mailto:{{ $company->customer->email_address }}">{{ $company->customer->email_address }}</a>
                                </li>
                            @endif
                            @if(isset($company->spletna_stran) && $company->spletna_stran !== '')
                                <li>
                                    <i class="fas fa-external-link"></i>
                                    <a target="_blank"
                                       href="{{ $company->spletna_stran }}">{{ $company->spletna_stran}}</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="head flx">
                        <div class="title">
                            <h1>Uporabniško ime / naziv firme</h1>
                            <p>{{ $company->tocen_naziv }}</p>
                        </div>
                        <div class="social">
                            @if($company->customer->facebook)
                                <a target="_blank" href="{{ $company->customer->facebook }}"><i
                                        class="fab fa-facebook"></i></a>
                            @endif
                            @if($company->customer->instagram)
                                <a target="_blank" href="{{ $company->customer->instagram }}"><i
                                        class="fab fa-instagram"></i></a>
                            @endif

                            @if($company->customer->linkedin)
                                <a target="_blank" href="{{ $company->customer->linkedin }}"><i
                                        class="fab fa-linkedin-in"></i></a>
                            @endif
                        </div>
                    </div>

                    <div class="description">
                        <p>
                            <strong>{{ $company->trgovina_opis }}</strong>
                        </p>
                        <br>
                        @if($company->delovni_cas)
                            <p>Delovni čas: {{ $company->delovni_cas }}</p>
                        @endif
                        @if($company->nacin_prevzema)
                            <p>Način prevzema in dostave: {{ $company->nacin_prevzema }}</p>
                        @endif
                    </div>

                    <div class="date-registered">
                        Uporabnik od {{ \Carbon\Carbon::parse($company->customer->account_created)->format('d.m.Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flx shop-divide">
            <div class="left banners small">
                <div class="banner"></div>
            </div>

            <div class="right">

                <div class="sort-by flx">
                    <p>Število rezultatov: {{ $resultCount }}</p>
                    {{--                    <select class="select" name="sort" data-placeholder="Razvrsti oglase">--}}
                    {{--                        <option></option>--}}
                    {{--                        <option value="1">Po ceni</option>--}}
                    {{--                        <option value="2">Zadnji oglasi</option>--}}
                    {{--                    </select>--}}
                </div>

                {!! $results->withQueryString()->links() !!}

                <div class="post-results">
                    @foreach($results as $result)
                        <?php
                        $cat = \App\Services\FilterServices::categoryAlphaParent($result->kategorijeTip1);
                        ?>
                        <div
                            @if (\Carbon\Carbon::parse($result->date_sort)->timestamp > \Carbon\Carbon::parse($result->datum_vnosa)->timestamp)
                            style="background-color: {{ $cat->color_filters }};
                                position: relative;"
                            @endif
                            class="result flx">
                            <div class="img">
                                @if (count($result->listingImagesPresent))
                                    <img
                                        style="width: 210px; height: 150px; object-fit: cover;"
                                        src="{{ $result->listingImagesPresent[0]->url }}"
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
                                            <a href="{{ route('category.listing', ['slug' => $result->kategorijeTip1->slug, 'listingSlug' => $result->slug]) }}">{{ $result->naslov }}</a>
                                        </h3>
                                        <ul class="props">
                                            <li><i class="fas fa-info-circle  "></i> Rabljeno</li>
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i> {{ $result->regije->regija ?? '' }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="meta flx">
                                        @if($result->kategorijeTip1 !== null ? ($cat->slug !== 'zasebni-stiki' ? true : false) : true)
                                            <strong class="price">{{ $result->cena }} €</strong>
                                        @endif
                                    </div>
                                </div>
                                <div class="lower flx">
                                    <p>Objavljeno {{ \Carbon\Carbon::parse($result->datum_vnosa) }}</p>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <a
                                            onclick="favorite({{ $result->id }}, this)"
                                            class="save
                                {{ in_array($result->id, auth()->user()->favorite->pluck('id')->toArray())  ? 'active' : '' }}
                                                "
                                        >
                                            <i class="fa fa-bookmark"></i>
                                        </a>
                                    @else
                                        <a
                                            onclick="favorite({{ $result->id }}, this)"
                                            class="save
                                {{ get_cookie() ? (in_array($result->id, get_cookie()) ? 'active' : '') : '' }}
                                                "
                                        >
                                            <i class="fa fa-bookmark"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {!! $results->withQueryString()->links() !!}

            </div>

        </div>

    </div>

@endsection
