<div id="header-container">
    <div id="header-main">
        <div class="cw flx" style="z-index: 7">
            <div class="logo">
                <a href="/"><img src="/assets/res/logo.svg"></a>
            </div>
            @include('client.includes.search')
            <a href="{{ route('nov-oglas') }}" class="btn blue oval">Oddaj oglas <i
                    class="fal fa-plus"></i></a>
        </div>
    </div>
    <div id="header-sub">
        <div class="cw flx">
            <div
                class="cat-modal-el categories-toggle {{ Route::currentRouteName() === 'home' ? ' force-open open' : '' }}">
                @if(isset($categories))
                    <div class="cat-toggle-btn">Kategorije <i class="far fa-chevron-down"></i></div>
                @endif
                <div class="categories">
                    @if(isset($categories) && count($categories))
                        <ul>
                            @foreach($categories as $category)
                                <li class="blue {{ $category->color_dropdown }}">
                                    <a href="/category/{{ $category->slug }}">
                                        <i class="{{ $category->icon }}"></i>
                                        {{ $category->tip }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="options">
                @guest
                    <?php
                    $favorites = request()->cookie('favorites') ?? '';
                    $favoritesArr = explode(',', $favorites);
                    $favoritesCount = \App\Models\MaliOglasi::whereIn('id', $favoritesArr)->count();
                    ?>
                    <a data-modal="modal-login"><i class="far fa-user"></i>Prijava</a>
                    <a href="{{ route('favorite.auth') }}">
                        <i class="far fa-bookmark"></i>Shraneni oglasi
                        @if($favoritesCount !== 0)
                            <span class="tag favoritesCount">{{ $favoritesCount }}</span>
                        @endif
                    </a>
                @endguest
                @auth
                    <?php
                    $favoritesCount = count(\Illuminate\Support\Facades\Auth::user()->favorite);
                    ?>
                    <a href="{{ route('profile.index') }}">
                        <i class="far fa-user"></i>Pozdravljeni {{ auth()->user()->name }}
                    </a>
                    <a href="{{ route('profile.index', ['profilePageSeg' => 'saved']) }}">
                        <i class="far fa-bookmark"></i>Shraneni oglasi
                        @if($favoritesCount !== 0)
                            <span class="tag favoritesCount">{{ $favoritesCount }}</span>
                        @endif
                    </a>
                    <a href="#"
                       class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="far fa-sign-out"></i>
                        Odjava
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>

<div id="header-categories-browse" class="cat-modal-el">
    @if(isset($categories) && count($categories))
        @foreach($categories as $category)
            <div class="category">
                <div class="bio flx">
                    <i class="{{ $category->icon . ' ' . $category->color_dropdown }}"></i>
                    <h2>{{ $category->tip }}</h2>
                    <a
                        {{--                        style="background-color_dropdown: {{ $category->color_dropdown ?? '#1c6bed' }} !important;"--}}
                        href="/category/{{ $category->slug }}"
                        {{--                        style="background-color: {{ $category->color ?? '#1c6bed' }} !important;"--}}
                        class="btn oval blue">{{ $category->mali_oglases_tip0_count }} oglasov</a>
                </div>
                @if(count($category->children))
                    <div class="subcategories flx">
                        <ul class="flx">
                            @foreach($category->children as $childrenCategory)
                                @if(count($childrenCategory->maliOglasesTip1))
                                    <li>
                                        <a href="/category/{{ $childrenCategory->slug }}">
                                            {{ $childrenCategory->tip }}
                                            <span>{{ count($childrenCategory->maliOglasesTip1) }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>
@guest
    @include('client.includes.login')
@endguest
