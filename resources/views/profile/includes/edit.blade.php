<style>
    .input-type-phone input {
        padding-left: 125px;
    }
    .alert_message {
        padding: 10px 15px;
        font-size: 12px;
        width: 95%;
        margin: 20px auto;
        margin-top: -30px;
        border-radius: 4px;
    }
    .alert_message.success {
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
    }
    .alert_message.danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    .select2 {
        width: 100% !important;
    }
</style>

<div class="page-heading flx">
    <h1>Urejanje <span>profila</span></h1>
</div>

<div class="profile-edit-tile">

    <div id="message_text" class="alert_message {{ isset($message) ?  'success' : '' }}">
        {{ isset($message) ? $message : '' }}
    </div>

    <form id="updateProfileForm" class="content frm-inputs update-profile" enctype="multipart/form-data">
        @if($user->customer && count($user->customer->customersTrgovinas))
            <div class="profile-edit-tile-sub">

                <div class="seg">
                    <h3>Logotip podjetja</h3>
                    <div class="profile-logo flx">
                        <div class="img">
                            <label>
                                <img width="165" height="100"  alt=""
                                    src="{{ count($user->customer->customersTrgovinas)
                                            && isset($user->customer->customersTrgovinas[0]->logo)
                                            ? $user->customer->customersTrgovinas[0]->logo
                                            : ''
                                             }}"
                                />
                                <input name="profile_logo" type="file"/>
                                <a><i class="fas fa-pen"></i></a>
                            </label>
                        </div>
                        <p>Priporočen format datoteke .png in velikost...</p>
                    </div>
                </div>

                <div class="seg">
                    <h3>Naslovna slika profila</h3>
                    <div class="profile-cover">
                        <p>
                            <i class="fas fa-info-circle"></i> Primerno za oglaševalni material ali predstavitev vašega
                            podjetja. Prikazano uporabnikom, ki obiščejo stran z vašimi oglasi.
                        </p>
                        <div class="flx">
                            <label>
                                <input name="profile_cover" type="file"/>
                                <span class="btn blue oval">Izberi datoteko <i class="fas fa-camera"></i></span>
                            </label>
                            <p>
                                Priporočen format datoteke .jpg, .png in velikost.....
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
            <input type="hidden"
                   name="user_id"
                   value="{{ $user->id }}"
            >
        <div class="seg">
            <h3>Podatki uporabniškega računa</h3>
            <div class="row">
                <div class="input input-type-text ">
                    <div class="input-inner">
                        <input type="text"
                               name="name"
                               placeholder="Uporabniško ime"
                               @if($user)
                                    value="{{ $user->name }}"
                               @endif
{{--                               required--}}
                        >
                        <div class="input-decor">
                            <i class="decor fas fa-user"></i>
                            <i class="error-ico fas fa-exclamation-circle"></i>
                            <p class="error_name"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input input-type-text ">
                    <div class="input-inner">
                        <input type="email"
                               name="email"
                               placeholder="E-poštni naslov"
                               @if($user)
                                    value="{{ $user->email }}"
                               @endif
{{--                               required--}}
                        >
                        <div class="input-decor">
                            <i class="decor fas fa-envelope"></i>
                            <i class="error-ico fas fa-exclamation-circle"></i>
                            <p class="error_email"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="seg">
            <h3 class="gap">Kontaktni podatki</h3>
            <div class="row">
                <div class="input input-type-text">
                    <div class="input-inner">
                        <input type="text"
                               name="username"
                               placeholder="Ime"
                               @if($user->customer)
                                    value="{{ $user->customer->username }}"
                               @endif
{{--                               required--}}
                        >
                        <div class="input-decor">
                            <i class="decor fas fa-user"></i>
                            <i class="error-ico fas fa-exclamation-circle"></i>
                            <p class="error_username"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input input-type-phone">
                    <div class="input-inner">
                        <div class="phone-prefix-select">
                            <select class="select" name="phone_prefix" required>
                                <option value="386" {{ $user->customer && $user->customer->country_code == '386' ? 'selected' : '' }}>+386</option>
                                <option value="385" {{ $user->customer && $user->customer->country_code == '385' ? 'selected' : '' }}>+385</option>
                            </select>
                        </div>
                        <input type="phone"
                               name="phone"
                               placeholder="Telefonska številka"
                               @if($user->customer)
                                   value="{{ $user->customer->telefon }}"
                               @endif
{{--                               required--}}
                        >
                        <div class="input-decor">
                            <i class="decor fas fa-phone-alt"></i>
                            <i class="error-ico fas fa-exclamation-circle"></i>
                            <p class="error_phone"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <select class="select" name="region" data-placeholder="Izberite vašo regijo" data-icon="map-marker-alt">
                    <option value="">Regija</option>
                    @foreach($regions as $region)
                        <option
                            @if($user->customer && $user->customer->regija_id == $region->id)
                            selected="selected"
                            @endif
                            value="{{ $region->id }}">{{ $region->regija }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="button" class="btn blue oval fw save-profile">Shrani vse spremembe</button>

        <a id="profile-delete"><i class="fas fa-info-circle"></i>Izbriši račun in vse oglase</a>
    </form>
</div>
<script>
    $('.select').each(function() {
        $(this).select2({
            placeholder: ($(this).attr('data-placeholder') || '-'),
            minimumResultsForSearch: 8
        });

        $(this).data('select2').$container.find('.select2-selection__arrow').html('<i class="far fa-chevron-down"></i>');

        var ico = $(this).attr('data-icon');
        if(ico) {
            $(this).data('select2').$container.find('.select2-selection').addClass('has-ico').prepend('<i class="fas fa-' + ico + '"></i>');
        }
    });


    $('.save-profile').on('click', function () {
        let formData = new FormData();
        let userId = $('#updateProfileForm input[name="user_id"]').val();
        $('#updateProfileForm input, #updateProfileForm select').each(function () {
            if($(this).attr('name') !== undefined && $(this).val() !== 'undefined'){
                formData.append($(this).attr('name'), $(this).val());

                if($(this).attr('name') === 'profile_logo'){
                    formData.append("profile_logo", $('input[name="profile_logo"]')[0].files[0]);
                }
                if($(this).attr('name') === 'profile_cover'){
                    formData.append("profile_cover", $('input[name="profile_cover"]')[0].files[0]);
                }

            }
        })

        $.ajax({
            url:"/profile/update",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response) {
                $('#message_text').removeClass('danger');
                $('#message_text').addClass('success');
                $('#message_text').empty().html(response.message);
            },
            error: (data) => {
                $('.seg .input-decor p').empty();
                $.each(data.responseJSON.errors, (index, value) => {
                    $('.error_' + index).text(value).css({ color: 'red', display : 'block' });
                });
            },
        });

    })
</script>
