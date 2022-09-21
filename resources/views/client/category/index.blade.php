@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/category.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"
          rel="stylesheet">
    <style>
        html .irs--round .irs-bar, html .irs--round .irs-handle, .pagination a.active,
        html .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable, .catColor {
            background-color: {{ $categoryParent->color_filters }}           !important;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
    <script src="/assets/js/pages/category.js"></script>
@endpush
@section('content')
    <div class="cw">
        <div class="intro-banner flx">
            <div class="banner"></div>
        </div>
        {{ Breadcrumbs::render('category.index', $category) }}
        @if(isset($category))
            <input type="hidden" name="categoryPage" value="{{ $category->slug }}">
            @if(count($category->children))
                <div class="sublinks-box tile np">
                    <h1 style="background-color: {{ $categoryParent->color_filters }} !important;"
                        class="bgt">{{ $category->tip }}</h1>
                    <ul class="flx">
                        @foreach($category->children as $cat)
                            <li>
                                <a href="/category/{{ $cat->slug }}">
                                    <strong>{{ $cat->tip }}</strong>
                                    <span
                                        style="background-color: {{ $category->children[0]->parent->color_filters ?? $category->kategorije->children[0]->parent->color_filters ?? $category->kategorije->parent->color_filters }} !important;"
                                        class="bgt">
                                        {{ $cat->maliOglasesTip1->count() }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
        <div class="flx shop-divide">
            <div class="left post-filters np">
                <h2><i class="fal fa-sliders-h"></i> Dodatni kriteriji</h2>
                @if(count($regions))
                    <div class="filter open">
                        <h3 class="flx">Regija <i class="far fa-chevron-down"></i></h3>
                        <div class="filter-scroll">
                            <ul class="filter-checklist regions-filter">
                                @foreach($regions as $region)
                                    <li>
                                        <label>
                                            {{--                                            @dd(isset($_GET))--}}
                                            <input type="checkbox" value="{{ $region->id }}" name="regions"
                                                   @if($_GET !== [] && in_array($region->id, json_decode($_GET['regions'])))
                                                   checked
                                                @endif
                                            >
                                            <span
                                                data-color="{{ $categoryColor ?? '#0075c4' }}"
                                                class="text">{{ $region->regija }}<i class="far fa-times"></i></span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if(count($productTypes))
                    <div class="filter open">
                        <h3 class="flx">Vrsta ponudbe <i class="far fa-chevron-down"></i></h3>
                        <div class="filter-scroll">
                            <ul class="filter-checklist productType-filter">
                                @foreach($productTypes as $key => $value)
                                    <li>
                                        <label>
                                            <input type="radio" value="{{ $value }}" name="productType"
                                                   @if($_GET !== [] && in_array($value, json_decode($_GET['productType'])))
                                                       checked
                                                   @endif
                                            >
                                            <span
                                                data-color="{{ $categoryColor ?? '#0075c4' }}"
                                                class="text">{{ $key }}<i class="far fa-times"></i>
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if($categoryParent->slug !== 'zasebni-stiki')
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
                                    data-max="{{ $_GET ? explode(';', $_GET['priceRange'])[1] : $maxPrice }}"
                                    data-from="0"
                                    data-to="{{ $_GET ? explode(';', $_GET['priceRange'])[1] : $maxPrice }}"/>

                                <div class="range-input flx">

                                    <input style="padding: 2px" type="text" class="range-input-from"
                                           value="{{ $_GET ? explode(';', $_GET['priceRange'])[0] : 0 }}"/> -
                                    <input style="padding: 2px" type="text" class="range-input-to"
                                           value="{{ $_GET ? explode(';', $_GET['priceRange'])[1] : $maxPrice }}"/>
                                    €
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                @if(count($categoryFilters))
                    @foreach($categoryFilters as $filter)
                        @if($filter->tip == 2)
                            <?php
                            $optionIds = [];
                            foreach ($_GET !== [] ? json_decode($_GET['custom_filters']) : [] as $filterId => $options) {

                                $filterCustom = \App\Models\Filter::find(substr($filterId, strpos($filterId, "-") + 1));

                                if ($filterCustom->tip == 2){
                                    list($minFilter, $maxFilter) = explode(";", $options);

                                }
                            }
                            ?>

                            <div class="filter open">
                                <h3 class="flx">{{ $filter->naziv }} <i class="far fa-chevron-down"></i></h3>
                                <div class="filter-scroll">

                                    <div class="filter-range custom-filter">

                                        <input
                                            type="hidden"
                                            class="rangeslider"
                                            name="custom-{{$filter->id}}"
                                            value=""
                                            data-type="double"
                                            data-min="0"
                                            data-max="100"
                                            data-from="{{ $_GET ? (int) $minFilter : 0 }}"
                                            data-to="{{ $_GET ? (int) $maxFilter : 100 }}"/>

                                        <div class="range-input flx">

                                            <input style="padding: 2px" type="text" class="range-input-from"
                                                   value="{{ $_GET ? (int) $minFilter : 0 }}"/> -
                                            <input style="padding: 2px" type="text" class="range-input-to"
                                                   value="{{ $_GET ? (int) $maxFilter : 100 }}"/>
                                            €
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @else
                            <?php
                            $optionIds = [];

                            foreach ($_GET !== [] ? json_decode($_GET['custom_filters']) : [] as $filterId => $options) {
                                $filterCustom = \App\Models\Filter::find(substr($filterId, strpos($filterId, "-") + 1));
                                if ($filterCustom->tip !== 2){

                                    foreach ($options as $option) {
                                            $optionIds[] = $option;
                                    }

                                }
                            }
                            ?>
                            <div class="filter open">
                                <h3 class="flx">{{ $filter->naziv }} <i class="far fa-chevron-down"></i></h3>
                                <div class="filter-scroll">
                                    <ul class="filter-checklist custom-filter custom{{$filter->id}}-filter">
                                        @foreach($filter->filtersOptions as $option)
                                            <li>
                                                <label>
                                                    <input
                                                        type="{{ config("constants.filter_type.$filter->tip") }}"
                                                        value="{{ $option->id }}"
                                                        name="custom-{{$filter->id}}"
                                                        @if(in_array($option->id, $optionIds))
                                                        checked
                                                        @endif
                                                    >
                                                    <span
                                                        data-color="{{ $category->color_filters ?? $category->kategorije->children[0]->parent->color_filters ?? '#0075c4' }}"
                                                        class="text">{{ $option->option }}<i
                                                            class="far fa-times"></i></span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

                <div id="filter-controls" class="filter tc">
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
                    <p>Število rezultatov: <span id="result-count" class="result-count">{{ $resultCount }}</span></p>
                    <select class="select" name="sort" data-placeholder="Razvrsti oglase">
                        <option></option>
                        @if($category->parent ? $category->parent->slug !== 'zasebni-stiki' : $category->slug !== 'zasebni-stiki')
                            <option value="cena">Po ceni</option>
                        @endif
                        <option value="datum_vnosa">Zadnji oglasi</option>
                    </select>
                </div>
                <div id="result">
                    {{--                {!! $result->withQueryString()->links() !!}--}}

                    @include('client.includes.pagination', ['result' => $result])
                    {{--                {!! $result->withQueryString()->links() !!}--}}
                </div>

            </div>
        </div>
    </div>
@endsection
