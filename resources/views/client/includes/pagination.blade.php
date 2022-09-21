{!! $result->withQueryString()->links() !!}

@include('flash::message')

@foreach ($result as $item)


    <div class="post-results">
        @if ($loop->index % config('constants.banner_per_items') == 0)
            <div class="result-banner flx">
                <div class="banner"></div>
            </div>
        @endif

        <?php
        $cat = \App\Services\FilterServices::categoryAlphaParent($item->kategorijeTip0 ?? $item->kategorijeTip1);
        ?>

        <div
            @if (\Carbon\Carbon::parse($item->date_sort)->timestamp > \Carbon\Carbon::parse($item->datum_vnosa)->timestamp)
            style="background-color: {{ $cat->color_filters }};
                position: relative;"
            @endif
            class="result flx">
            @if (\Carbon\Carbon::parse($item->date_sort)->timestamp > \Carbon\Carbon::parse($item->datum_vnosa)->timestamp)
                <div
                    style="
                 position: absolute;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 100%;
                background-color: #fff;
                opacity: 0.3;
                z-index: 1;
                ">

                </div>
            @endif

            <div class="img">
                @if (count($item->listingImagesPresent))
                    <img
                        @if($cat->slug == 'zasebni-stiki' && (!\Illuminate\Support\Facades\Auth::check() || \App\Services\PaidService::checkPremiumPackage() == 0))
                            class="blur"
                        @endif
                        style="width: 210px; height: 150px; object-fit: cover;"
                        src="{{ $item->listingImagesPresent[0]->url }}"
                    >
                @else
                    <img
                        @if($cat->slug == 'zasebni-stiki' && (!\Illuminate\Support\Facades\Auth::check() || \App\Services\PaidService::checkPremiumPackage() == 0))
                        class="blur"
                        @endif
                        style="width: 210px; height: 150px; object-fit: cover;"
                        src="https://media.istockphoto.com/vectors/default-image-icon-vector-missing-picture-page-for-website-design-or-vector-id1357365823?k=20&m=1357365823&s=612x612&w=0&h=ZH0MQpeUoSHM3G2AWzc8KkGYRg4uP_kuu0Za8GFxdFc=">
                @endif

            </div>


            <div class="bio">
                <div class="upper flx">
                    <div class="general">
                        <h3>
                            <a href="{{ route('category.listing', ['slug' => $item->kategorijeTip0 ? $item->kategorijeTip0->slug : $item->kategorijeTip1->slug, 'listingSlug' => $item->slug]) }}">{{ $item->naslov }}</a>
                        </h3>
                        <ul class="props">
                            <li><i class="fas fa-info-circle  "></i> Rabljeno</li>
                            <li><i class="fas fa-map-marker-alt"></i> {{ $item->regije->regija ?? '' }}</li>
                        </ul>
                    </div>
                    <div class="meta flx" style="justify-content: space-between; text-align: right;">
                        @if($item->kategorijeTip1 !== null ? ($cat->slug !== 'zasebni-stiki' ? true : false) : true)
                            <strong class="price">{{ $item->cena }} €</strong>
                        @endif
                    </div>
                </div>
                <div class="lower flx">
                    <p>Objavljeno {{ \Carbon\Carbon::parse($item->datum_vnosa)->format('d.m.Y') }}</p>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <a
                            onclick="favorite({{ $item->id }}, this)"
                            class="save
                                {{ in_array($item->id, auth()->user()->favorite->pluck('id')->toArray())  ? 'active' : '' }}
                                "
                        >
                            <i class="fa fa-bookmark"></i>
                        </a>
                    @else
                        <a
                            onclick="favorite({{ $item->id }}, this)"
                            class="save
                                {{ get_cookie() ? (in_array($item->id, get_cookie()) ? 'active' : '') : '' }}
                                "
                        >
                            <i class="fa fa-bookmark"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endforeach

{!! $result->withQueryString()->links() !!}
