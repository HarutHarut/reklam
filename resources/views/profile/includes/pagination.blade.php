@push('styles')
    <link href="/assets/css/core.css" rel="stylesheet" title="asfhdg">
    <link href="/assets/css/pages/myprofile.css" rel="stylesheet">
@endpush

{!! $result->withQueryString()->links() !!}

@include('flash::message')
@if(isset($deleteble) && count($result) && $profilePageSeg !== 'saved')
    <!--    <a
        onclick="openDeleteManyModal()"
        style="float: right; color: #fff; cursor: pointer; z-index: 5; position: relative; background-color: #ff0000; padding: 6px 12px; border-radius: 4px; margin-top: 65px;"
        {{--        data-modal="delete-form-many"--}}
        >
            <i class="fa fa-times" style="font-size: 11px; margin-right: 2px;"></i> <span
                style="font-size: 12px; font-weight: 600;">Delete all</span>
        </a>-->

    <div class="page-heading flx">
        <h1>Moji <span>oglasi</span></h1>
    </div>

    <div class="profile-stats flx">
        <div class="stat">
            <strong>{{ count($statistics) && isset($statistics['activeOglasiCount']) ? $statistics['activeOglasiCount'] : 0 }}    </strong>
            <p>Aktivni oglasi</p>
        </div>
        <div class="stat">
            <strong>{{ count($statistics) && isset($statistics['allViews']) ? $statistics['allViews'] : 0 }}</strong>
            <p>Ogledov mojih oglasov</p>
        </div>
        <div class="stat large flx">
            <div class="tag">Bonus</div>
            <div class="circle-progress">
                <div
                    data-value="{{ count($statistics)  && isset($statistics['days']) ? $statistics['days']/100 : 0 }}"></div>
                {{--            <div data-value="{{ 25/100 }}"></div>--}}
                <p>čez<strong>{{ count($statistics)  && isset($statistics['days']) ? $statistics['days'] : 0 }}</strong>dni
                </p>
            </div>
            <div class="content">
                <strong>Pridobi brezplačno 7 dnevno izpostavitev oglasa</strong>
                <p>
                    z zbiranjem dnevov in oglasov!
                    <a>Izvej več</a>
                </p>
            </div>
        </div>
    </div>
    <div class="sort-by flx">
        <div class="select-all">
            <button class="deactivate">Deaktiviraj</button>
            <button onclick="openDeleteModal()" class="delete">Izbriši</button>
        </div>
        <p>Število rezultatov: {{ $result->total() }}</p>

        <form id="my_listings_form" action="{{ route('profile.index') }}" method="POST">
            @csrf
            @method('GET')
            <select id="my-listings" class="select" name="sort" data-placeholder="Razvrsti oglase">
                <option></option>
                <option value="cena" {{ isset($checkedSort) && $checkedSort == 'cena' ? 'selected' : '' }}>Po ceni
                </option>
                <option
                    value="datum_vnosa" {{ isset($checkedSort) && $checkedSort == 'datum_vnosa' ? 'selected' : '' }}>
                    Zadnji oglasi
                </option>
            </select>
            <input type="hidden" id="statusFilter" name="statusFilter">
            {{--        <button type="submit">sub</button>--}}
        </form>
    </div>
@endif
@if(count($result))
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
{{--            @if (\Carbon\Carbon::parse($item->date_sort)->timestamp > \Carbon\Carbon::parse($item->datum_vnosa)->timestamp)--}}
{{--            style="background-color: {{ $cat->color_filters }};--}}
{{--                position: relative;"--}}
{{--            @endif--}}
            class="result">


            <div class="flx">
                @if(isset($deleteble) && count($result) && $profilePageSeg !== 'saved')
                    <div class="left-items">
                        <input type="checkbox" name="deleteItems[]">
                    </div>
                @endif
                <div style="width: 100%;">
                    <div class="flx">
                        <div class="img">
                            @if (count($item->listingImagesPresent))
                                <img
                                    style="width: 140px; height: 100px; object-fit: cover;"
                                    src="{{ $item->listingImagesPresent[0]->url }}"
                                >
                            @else
                                <img
                                    style="width: 140px; height: 100px; object-fit: cover;"
                                    src="https://media.istockphoto.com/vectors/default-image-icon-vector-missing-picture-page-for-website-design-or-vector-id1357365823?k=20&m=1357365823&s=612x612&w=0&h=ZH0MQpeUoSHM3G2AWzc8KkGYRg4uP_kuu0Za8GFxdFc=">
                            @endif

                        </div>
                        <div class="result-box-right">
                            <div class="bio">
                                <div class="upper flx">
                                    <div class="general">
                                        <h3>
                                            {{-- <a href="/category/{{ $category->slug }}/{{ $item->slug }}">{{ $item->naslov }}</a> --}}
                                            <a href="{{ route('category.listing', ['slug' => $item->kategorijeTip0 ? $item->kategorijeTip0->slug : $item->kategorijeTip1->slug, 'listingSlug' => $item->slug]) }}">{{ $item->naslov }}</a>
                                        </h3>
                                        @if(isset($deleteble) && count($result) && $profilePageSeg !== 'saved')
                                            @if($item->status == 3)
                                                <p class="active-text inactive"
                                                   data-id="{{ $item->id }}">
                                                    <i class="fa fa-circle"></i>
                                                    Oglas is blocked from admin
                                                </p>
                                            @else
                                                <p class="active-text {{ $item->status == 1 ? 'active' : 'inactive' }}"
                                                   data-id="{{ $item->id }}"><i
                                                        class="fa fa-circle"></i>

                                                    @if($item->status == 1)
                                                        Oglas je aktiven
                                                    @else
                                                        Oglas je potekel
                                                    @endif
                                                </p>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="meta flx" style="justify-content: space-between; text-align: right;">
                                        <strong class="price">{{ $item->cena }} €</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="lower flx">
                                <div class="tile post-info">
                                    <ul>
                                        <li><i class="fas fa-check-circle"></i> Objavljeno:
                                            {{ \Carbon\Carbon::parse($item->datum_vnosa)->format('d.m.Y') . ' ob ' . \Carbon\Carbon::parse($item->datum_vnosa)->format('h:i') }}
                                        </li>
                                        <li><i class="fas fa-clock"></i> Oglas poteče:
                                            {{ \Carbon\Carbon::parse($item->datum_poteka)->format('d.m.Y') }}
                                        </li>
                                        <li><i class="fas fa-eye"></i> Število ogledov:
                                            {{ $item->views_count }}
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="results-actions">
                        @if(isset($deleteble) && count($result) && $profilePageSeg !== 'saved')
                            <span onclick="editListing({{ $item->id }})">Uredi <i class="fa fa-pen"></i></span>
                            <span onclick="openDeleteModal({{ $item->id }})">Izbrisi <i class="fa fa-trash"></i></span>
                            @if($item->status == 1)
                                <span onclick="openChangeStatusModal({{ $item->id }})">Deaktiviraj <i
                                        class="fa fa-ban"></i></span>
                            @else
                                <span onclick="openChangeStatusModal({{ $item->id }})">Aktiviraj <i
                                        class="fa fa-check"></i></span>
                            @endif
                            <span onclick="prologon30({{ $item->id }})">Podaljsaj +30 dni <i class="fa fa-calendar-plus"></i></span>
                        @endif
                        <span class="post-share-btn">Deli <i class="fa fa-share-alt"></i></span>
                        @if(isset($deleteble) && count($result) && $profilePageSeg !== 'saved')
                            <span class="orange" onclick="upgrade()">Izpostavi <i class="fa fa-star"></i></span>
                            <span class="orange" onclick="prologon7({{ $item->id }})">Skok na vrh <i class="fa fa-sort-amount-up"></i></span>
                        @endif
                    </div>

                    <div class="overlay share">
                        <div class="flx">
                            <a target="_blank"
                               href="https://www.facebook.com/sharer/sharer.php?u={{ $_SERVER['APP_URL'] . '/' . $item->slug }}"><i
                                    class="fab fa-facebook"></i> Facebook</a>
                            <a href="mailto:?body={{ $_SERVER['APP_URL'] . '/' . $item->slug }}"><i
                                    class="fas fa-envelope"></i> Posreduj prijatelju</a>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>


@endforeach

@else
    <h2>No result</h2>
@endif

{!! $result->withQueryString()->links() !!}

<script>
    $('.post-share-btn').click(function () {
        $(this).parents('.results-actions').next().slideToggle();
    })
</script>

<script src="{{ asset('/assets/js/core.js') }}"></script>
<script src="{{ asset('/assets/js/pages/myprofile.js') }}"></script>
