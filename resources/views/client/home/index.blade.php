@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/homepage.css" rel="stylesheet">
@endpush
@section('content')

    <div id="hp-slider">
        <div class="cw">
            <div class="content flx">
                <div class="banner"></div>
            </div>
        </div>
    </div>

    @if(count($popularCategories))
        <div id="hp-favorite-categories">
            <div class="cw">
                <h2 class="heading"><strong>Priljubljene</strong> kategorije</h2>
                <div class="categories flx">
                    @foreach($popularCategories as $category)
                    {{-- color class from DB, uncomment when db is ready --}}
                        {{-- <div class="{{$category->color}}"> --}}
                            <div class="category blue">
                            <div class="ico flx center">
                                <i class="{{ $category->icon }}"></i>

                                <div class="hover">
                                    Išči med<strong>{{ $category->mali_oglases_tip1_count }}</strong>oglasi
                                </div>
                            </div>
                            <a href="/category/{{ $category->slug }}">{{ $category->tip }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div id="hp-paid-banners">
        <div class="cw flx">
            <div class="banner"></div>
            <div class="banner"></div>
            <div class="banner"></div>
        </div>
    </div>

    <div id="hp-vp">
        <div class="cw flx">
            <div class="value flx">
                <div class="ico"><i class="far fa-hourglass-half"></i></div>
                <strong>Z vami že</strong>
                <p>Več kot {{ $companyFoundationDate }} let</p>
            </div>
            <div class="value flx">
                <div class="ico"><i class="fas fa-user-tie"></i></div>
                <strong>Pri nas oglašuje</strong>
                <p>
                    {{ $customersCount }}
                    trgovcev
                </p>
            </div>
            <div class="value flx">
                <div class="ico"><i class="far fa-search fa-flip-horizontal"></i></div>
                <strong>Skupaj</strong>
                <p>
                    {{ $allProductsCount }} oglasov
                </p>
            </div>
        </div>
    </div>

    @if(count($recommendedStores))
        <div id="hp-recommended-stores">
            <div class="cw">
                <h2 class="heading"><strong>Izpostavljeni oglasi</strong> trgovcev</h2>
                <div class="content flx">
                    <div class="stores">
                        @foreach($recommendedStores as $recommendedStore)
                            @if(count($recommendedStore->maliOglases))
                                <div class="store">
                                    <div class="head flx">
                                        <div class="bio">
                                            @if(count($recommendedStore->customersTrgovinas) && $recommendedStore->customersTrgovinas[0]->logo !== '')
                                                <div class="logo flx"><img src="{{ $recommendedStore->customersTrgovinas[0]->logo }}"/></div>
                                            @else
                                                <div class="logo flx">{{ $recommendedStore->username }}</div>
                                            @endif

                                            <strong>{{ count($recommendedStore->customersTrgovinas) ? $recommendedStore->customersTrgovinas[0]->tocen_naziv : '' }}</strong>

                                        </div>
                                        <a href="{{ route('search', ['customer_id' => $recommendedStore->id]) }}"
                                           class="btn oval blue light arr more">
                                            Poglej več<i class="fal fa-chevron-right"></i>
                                        </a>
                                        </a>
                                    </div>
                                    <div class="posts flx">
                                        @foreach($recommendedStore->maliOglasesWithLimit as $maliOglasi)
                                            <div class="post">
                                                <div class="img">
                                                    <img src="
                                                    {{ count($maliOglasi->listingImagesThumb) ?
                                                        $maliOglasi->listingImagesThumb[0]->url :
                                                        'https://media.istockphoto.com/vectors/default-image-icon-vector-missing-picture-page-for-website-design-or-vector-id1357365823?k=20&m=1357365823&s=612x612&w=0&h=ZH0MQpeUoSHM3G2AWzc8KkGYRg4uP_kuu0Za8GFxdFc='
                                                     }}">
                                                </div>
                                                <a href="{{ route('category.listing',['slug' => $maliOglasi->kategorijeTipId->slug , 'listingSlug' => $maliOglasi->slug]) }}"
                                                   class="af">{{ $maliOglasi->naslov }}</a>
                                                <strong>{{ $maliOglasi->cena }} €</strong>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="banner"></div>
                </div>
            </div>
        </div>
    @endif

    @if(count($latestProducts))
        <div id="hp-last-posts">
            <div class="cw">
                <h2 class="heading"><strong>Zadnji oglasi</strong> fizičnih oseb</h2>
                <div class="posts flx">
                    @foreach ($latestProducts as $latestProduct)
                        <div class="post">
                            @if (count($latestProduct->listingImagesPresent))
                                <img
                                    style="width: 90px; height: 90px; object-fit: cover;"
                                    src="{{ $latestProduct->listingImagesPresent[0]->url }}"
                                >
                            @else
                                <img
                                    style="width: 90px; height: 90px; object-fit: cover;"
                                    src="https://media.istockphoto.com/vectors/default-image-icon-vector-missing-picture-page-for-website-design-or-vector-id1357365823?k=20&m=1357365823&s=612x612&w=0&h=ZH0MQpeUoSHM3G2AWzc8KkGYRg4uP_kuu0Za8GFxdFc=">
                            @endif
                            <a href="{{ route('category.listing',['slug' => \App\Services\FilterServices::categoryAlphaParent($latestProduct->kategorijeTip1)->slug , 'listingSlug' => $latestProduct->slug]) }}">
                                {{ $latestProduct->naslov }}
                            </a>
                            <div class="price">{{ $latestProduct->cena }} €</div>
                        </div>
                    @endforeach
                    <div class="post more">
                        <a href="{{ route('search') }}" class="btn oval blue light arr">Več oglasov <i class="fal fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @auth
        <div class="new-post-cta">
            <div class="cw">
                <p>Želite oddati nov oglas? Tudi <strong>brez prijave</strong>!</p>
                <a class="btn blue oval" href="{{ route('nov-oglas') }}">Oddaj oglas <i class="far fa-plus"></i></a>
            </div>
        </div>
    @endauth
@endsection
