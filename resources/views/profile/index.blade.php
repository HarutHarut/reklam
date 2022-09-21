@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/myprofile.css" rel="stylesheet">
    <link href="/assets/css/pages/register.css" rel="stylesheet">
    <link href="/assets/css/pages/newpost.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="/assets/js/pages/myprofile.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@section('content')
    <div class="cw">
        <div id="profile-container">
{{--@dd($user->avatar)--}}
            <div id="profile-nav">
                <div id="profile-head">
{{--                    @dd($user->customer)--}}
                    @if(isset($user->customer) && $user->customer !== null)
                        <div class="logo">
                            <img
                                src="{{ count($user->customer->customersTrgovinas)
                                        && isset($user->customer->customersTrgovinas[0]->logo)
                                        ? $user->customer->customersTrgovinas[0]->logo
                                        : ''
                                         }}"
                            />
                        </div>

{{--                    @if($user && $user->avatar !== '' || $user->profile_photo_path && $user->profile_photo_path !== '')--}}
{{--                        <div class="logo"><img--}}
{{--                                src="{{ $user->avatar ? $user->avatar : ($user->profile_photo_path ? $user->profile_photo_path : '') }}"/>--}}
{{--                        </div>--}}
                    @else
                        <div class="img">{{ $user->name }}</div>
                    @endif

                    <div class="name">
                        {{ $user->name }}
                    </div>
                    <div class="id">
                        ID uporabnika: {{ $user->id }}
                    </div>
                </div>

                <div id="profile-nav-list">

                    <div class="seg">
                        <a class="title{{ $profilePageSeg === 'posts' ? ' active' : '' }}"
                           href="{{ route('profile.index', ['profilePageSeg' => 'posts']) }}">
                            <i class="fas fa-list"></i> Moji oglasi
                        </a>
                        <div class="list">

                            <label class="ch myLists">
                                <input type="radio"
                                       name="listingStatus"
                                       value="active"
                                       checked
{{--                                       {{ isset($listingStatus) && $listingStatus == 'active' ? 'checked' : '' }}--}}
                                >
                                <span class="box">
                                    <i class="far fa-check"></i>
                                </span>
                                <span class="text">
                                    Aktivni oglasi
                                </span>
                            </label>

                            <label class="ch myLists">
                                <input type="radio"
                                       name="listingStatus"
                                       value="inactive"
                                       {{ isset($listingStatus) && $listingStatus == 'inactive' ? 'checked' : '' }}
                                >
                                <span class="box">
                                    <i class="far fa-check"></i>
                                </span>
                                <span class="text">
                                    Deaktivirani oglasi
                                </span>
                            </label>

                            <label class="ch myLists">
                                <input type="radio"
                                       name="listingStatus"
                                       value="expired"
                                       {{ isset($listingStatus) && $listingStatus == 'expired' ? 'checked' : '' }}
                                >
                                <span class="box">
                                    <i class="far fa-check"></i>
                                </span>
                                <span class="text">
                                    Potekli oglasi
                                </span>
                            </label>

                        </div>
                    </div>

                    <div class="seg">
                        <a class="
                        title{{ $profilePageSeg === 'saved' ? ' active' : '' }}"
                           href="{{ route('profile.index', ['profilePageSeg' => 'saved']) }}"

                        >
                            <i class="fas fa-bookmark"></i> Shranjeni oglasi <span
                                class="tag">{{ $favoritesCount }}</span>
                        </a>
                    </div>


                    <div class="seg">
                        <div class="title">
                            <i class="fas fa-chart-line"></i> Statistika
                        </div>
                    </div>

                    <div class="seg">
                        <a class="edit_bio title{{ $profilePageSeg === 'edit_bio' ? ' active' : '' }}">
                            <i class="fas fa-user"></i> Urejanje profila
                        </a>
                        <div class="list">
                            <a style="cursor: pointer;"
                               onclick="editPassword({{ $user->id }})"
                            >
                                Sprememba gesla
                            </a>

                            <a style="cursor: pointer;"
                               onclick="editProfile({{ $user->id }})"
                            >
                                Upravljanje računa</a>
                        </div>
                    </div>

                    <div class="seg">
                        <div class="title">
                            <i class="fas fa-wallet"></i> Plačila
                        </div>
                    </div>
                    <div class="seg color">
                        <a class="prolong title{{ $profilePageSeg === 'subscribtion' ? ' active' : '' }}"
                        >
                            <i class="far fa-gem"></i> {{ $customer && $customer->activePackage ? $customer->activePackage->paidItem->title : 'No active package' }}
                        </a>
                        <div class="list">
{{--                            @if($customer && $customer->activePackage)--}}
                                <a style="cursor: pointer;"
                                   onclick="upgrade()"
                                >
                                    Nadgradi paket
                                </a>
{{--                            @endif--}}
                                @if($customer && $customer->activePackage)
                                    <a style="cursor: pointer;"
                                       onclick="prolong()"
                                    >
                                        Podaljšaj
                                    </a>
                            @endif
                        </div>

                        @if($customer && $customer->activePackage)
                            <div class="more">
                                <i class="fas fa-clock"></i> Paket
                                poteče {{ \Carbon\Carbon::parse($customer->activePackage->package_duration)->format('d.m.Y') }}
                            </div>
                        @endif
                    </div>

                    <div class="seg gap">
                        <a class="title" href="/pogosta-vprasanja/">
                            <i class="fas fa-question-circle"></i> Pogosta vprašanja
                        </a>
                    </div>

                    <div class="seg last">
                        <div
                            class="title"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="far fa-sign-out"></i>
                            Odjava
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>

                </div>

            </div>

            <div id="profile-content">
                <div id="result">
                    @if($firstLogin && !$reset)
                        @include('profile.includes.edit', ['user' => $user, 'message' => $message])
                    @elseif($reset)
                        @include('profile.includes.change_password', ['reset' => $reset])
                    @elseif($page == 'packages')

                         @include('profile.includes.upgrade', ['user' => $user])
                    @else
                        @include('profile.includes.pagination', ['result' => $result, 'deleteble' => true])
                    @endif

                </div>

            </div>

        </div>
    </div>

    <div id="delete-form-many" class="modal">
        <div class="content">
            <div class="head">
                <h2>Ali ste prepričani, da želite izbrisati oglas?</h2>
            </div>
            <div class="login-oglasi">
                <form id="delete-many-form" action="{{ route('delete.manyListing', ['result' => $result->toArray()['data']]) }}" method="POST">
                    @csrf
                    <div class="row" style="justify-content: center; text-align: center;">
                        <a class="btn oval white brd modal-close">No</a>
                        <button type="submit" class="btn blue oval" style="margin-left: 10px;">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="delete-form" class="modal">

        <div class="content">
            <div class="head">
                <h2>Ali ste prepričani, da želite izbrisati oglas?</h2>
            </div>
            <div class="login-oglasi">
                <form id="delete-form-listing" action="" method="POST">
                    @csrf
                    <div class="row" style="justify-content: center; text-align: center;">
                        <a class="btn oval white brd modal-close">Ne</a>
                        <button type="submit" class="btn blue oval" style="margin-left: 10px;">Da</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="update-form" class="modal">
        <div class="content">
            <div class="head">
                <h2>Ali ste prepričani, da želite re-aktivirati oz. deaktivirati oglas?</h2>
            </div>
            <div class="login-oglasi">
                <form id="update-form-listing" action="" method="POST">
                    @csrf
                    <div class="row" style="justify-content: center; text-align: center;">
                        <a class="btn oval white brd modal-close">Ne</a>
                        <button type="submit" class="btn blue oval" style="margin-left: 10px;">Da</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
