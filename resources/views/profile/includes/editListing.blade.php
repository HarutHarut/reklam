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
    <h1>Oddaja <span>oglasa</span></h1>
</div>

<div id="edit-post">
    <div id="message_text" class="alert_message {{ isset($message) ?  'success' : '' }}">
        {{ isset($message) ? $message : '' }}
    </div>
    <div id="create-post-container">
        <form id="edit-post-frm" class="frm-inputs">

            <input type="hidden" name="post" value="{{ guid() }}"/>
            <input type="hidden" name="listing_id" value="{{ $listing->id }}"/>

            <div id="cp-page-4" class="step">
                <div id="post-info-container">

                    <div id="post-info" style="padding-top: 30px">
                        <h3>Podatki oglasa</h3>
                        <p class="description">
                            <i class="fas fa-info-circle"></i> Prosimo, izpolnite vsa polja, da bodo kupci imeli
                            boljšo predstavo o predmetu, ki ga prodajate.html +=
                        </p>

                        <div class="content">
                            <div class="post-type flx">
                                <div class="post-type-1">
                                    @foreach($productTypes as  $item => $key)
                                        <label class="ch radio">
                                            <input required type="radio" name="tip_oglasa" value="{{ $key }}"
                                                   @if($listing->tip_oglasa == $key) checked @endif
                                            >
                                            <span class="box"><i class="fas fa-circle"></i>
                                                    </span><span class="text">{{ $item }}</span>
                                        </label>
                                    @endforeach
                                    <p style="padding-top: 15px; display: none;" class="error-msg error_tip_oglasa">
                                        Vnesite veljavno tip oglasa</p>
                                </div>
                                {{--                                    <input type="hidden" name="category_id" id="categoryId">--}}

                            </div>

                            <div id="post-title" class="flx">
                                <div class="input input-type-text fw">
                                    <div class="input-inner">
                                        <input type="text" name="naslov" placeholder="Naslov oglasa" required
                                               value="{{ $listing->naslov ? $listing->naslov : '' }}">
                                        <div class="input-decor">
                                            <i class="decor fas fa-pencil"></i>
                                            <i class="error-ico fas fa-exclamation-circle"></i>
                                            <p class="below-msg below_naslov">Naslov lahko vsebuje največ 50 znakov.</p>
                                            <p class="error-msg error_naslov">Neveljaven naslov oglasa (1 - 50
                                                znakov)</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="input input-type-text fw">
                                    <div class="input-inner">
                                        <input type="number" name="cena" placeholder="Cena" required
                                               value="{{ $listing->cena ? $listing->cena : '' }}">
                                        <div class="input-decor">
                                            <i class="decor fas fa-pencil"></i>
                                            <i class="error-ico fas fa-exclamation-circle"></i>
                                            <p class="error-msg error_cena">Neveljavna cena</p>
                                            <span class="after-text">€</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="post-description">
                                <div class="input input-type-textarea fw">
                                    <div class="input-inner">
                                                <textarea name="opis" placeholder="Podrobnejši opis"
                                                          required>{{ $listing->opis ? $listing->opis : '' }}</textarea>
                                        <div class="input-decor">
                                            <i class="decor fas fa-pencil"></i>
                                            <i class="error-ico fas fa-exclamation-circle"></i>
                                            <p class="below-msg below_opis">Podrobnejši opis zagotovi hitrejšo in
                                                uspešnejšo prodajo. V opis ne navajajte cene in telefonske
                                                številke.</p>
                                            <p class="error-msg error_opis">Neveljaven opis oglasa (1 - 1000 znakov)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(count($customFilters))
                        <div
                            {{--                        style="display: none"--}}
                            id="post-additional" class="seg-brd">
                            <h3>Dodatni podatki in karakteristike o predmetu</h3>
                            <p class="description">
                                <i class="fas fa-info-circle"></i> Izboljšajte svoje oglaševanje z dodatnimi
                                podatki
                                o predmetu, ki ga prodajate.
                            </p>

                            <div class="dd-row flx" id="customFilter">
                                @foreach($customFilters as $customFilter)
                                    <div class="dd">
                                        <p>{{ $customFilter->naziv }}</p>
                                        @if($customFilter->tip == 1)
                                            @foreach($customFilter->filtersOptions as $filtersOption)
                                                <div class="post-type-1 custom-filter" style="padding-top: 10px;">
                                                    <label class="ch radio">
                                                        <input type="radio"
                                                               name="custom-{{ $customFilter->id }}"
                                                               value="{{ $filtersOption->id }}"
                                                            {{ $customFilter->is_mandatory }}
                                                            {{ count($listingCustomFilters) && $listingCustomFilters[$customFilter->id] == $filtersOption->id ? 'checked' : '' }}
                                                        >
                                                        <span class="box"><i class="fas fa-circle"></i>
                                                                </span>
                                                        <span class="text">{{ $filtersOption->option }}</span>
                                                    </label>
                                                </div>
                                            @endforeach

                                        @else
                                            <div class="input input-type-text fw custom-filter"
                                                 style="padding-top: 10px;">
                                                <div class="input-inner">
                                                    <input type="text"
                                                           name="custom-{{ $customFilter->id }}" {{ $customFilter->is_mandatory }}
                                                           value="{{ count($listingCustomFilters) && $listingCustomFilters[$customFilter->id] ? $listingCustomFilters[$customFilter->id] : '' }}"
                                                    >
                                                    <div class="input-decor">
                                                        <i class="decor fas fa-pencil"></i>
                                                        <i class="error-ico fas fa-exclamation-circle"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif
                                        <p style="padding-top: 15px; display: none"
                                           class="error-msg error_custom-{{ $customFilter->id }}">Vnesite
                                            veljavno</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                    <div id="post-location" class="seg-brd">
                        <h3>Lokacija prodaje</h3>

                        <div class="dd-row flx">
                            <div class="dd">

                                <select class="select check-region" name="parent_regija_id"
                                        data-placeholder="Izberite regijo *"
                                        data-icon="map-marker-alt" required>
                                    <option value=""></option>

                                    @foreach($regions as $region)
                                        <option
                                            @if($region->id == $parentRegionId)
                                                selected="selected"
                                            @endif
                                            value="{{ $region->id }}">{{ $region->regija }}</option>
                                    @endforeach
                                </select>
                                <p style="padding-top: 15px; display: none;" class="error-msg error_parent_regija_id">
                                    Vnesite veljavno parent regija id</p>
                            </div>

                            <div class="dd">
                                <select class="select child-region" name="regija_id"
                                        data-placeholder="Izberite mestno občino *" data-icon="map-marker-alt"
                                        required>
                                    <option value=""></option>

                                    @foreach($childRegions as $childRegion)
                                        <option
                                            @if($childRegion->id == $listing->regija_id)
                                            selected="selected"
                                            @endif
                                            value="{{ $childRegion->id }}">{{ $childRegion->regija }}</option>
                                    @endforeach
                                </select>
                                <p style="padding-top: 15px; display: none;" class="error-msg error_regija_id">Vnesite
                                    veljavno regija id</p>
                            </div>
                        </div>
                    </div>

                    <div id="post-contact" class="seg-brd">
                        <h3>Kontaktni podatki</h3>
                        <p class="description">
                            <i class="fas fa-info-circle"></i> Navedite kontaktne podatke preko katerih boste
                            dosegljivi kupcem.
                        </p>

                        <div class="dd-row flx">
                            <div id="phone-confirm" class="dd sms">
                                <div class="input input-type-phone fw">
                                    <div class="input-inner">

                                        <div class="phone-prefix-select">
                                            <select class="select" name="phone_prefix" required disabled>
                                                <option
                                                    value="386" {{ $user->customer && $user->customer->country_code == '386' ? 'selected' : '' }}>
                                                    +386
                                                </option>
                                                <option
                                                    value="385" {{ $user->customer && $user->customer->country_code == '385' ? 'selected' : '' }}>
                                                    +385
                                                </option>
                                            </select>
                                        </div>
                                        <input type="phone" name="phone" placeholder="Telefonska številka"
                                               value="{{ $user->customer->telefon }}"
                                               disabled
                                               required
                                        >
                                        <div class="input-decor">
                                            <i class="decor fas fa-phone-alt"></i>
                                            <i class="error-ico fas fa-exclamation-circle"></i>
                                            <p class="below-msg">Po vnosu telefonske številke, kliknite gumb
                                                ‘Pošlji SMS kodo’, nakar vam bo na SMS poslana 4 mestna
                                                koda.</p>
                                            <p class="error-msg error_phone">Vnesite veljaveno telefonsko številko</p>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="send-sms btn blue" data-sms="modal-confirm-sms">--}}
{{--                                    <i class="fas fa-envelope"></i> Pošlji SMS kodo--}}
{{--                                </div>--}}
                            </div>
                            <div class="dd">
                                <div class="input input-type-text fw">
                                    <div class="input-inner">

                                        <input type="email" name="contact_email"
                                               placeholder="E-poštni naslov"
                                               disabled
                                               required
                                               value="{{ $user->email }}"
                                        >

                                        <div class="input-decor">
                                            <i class="decor fas fa-envelope"></i>
                                            <i class="error-ico fas fa-exclamation-circle"></i>
                                            <p class="error-msg error_contact_email">Vnesite veljaven e-poštni
                                                naslov</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="ch">
                            <input type="checkbox" name="notify_expiration" value="1" checked>
                            <span class="box"><i class="far fa-check"></i>
                                    </span>
                            <span class="text">Želim obvestilo o poteku oglasa</span>
                        </label>
                    </div>

                    <div id="post-images" class="seg-brd">
                        <h3>Nalaganje fotografij</h3>
                        <p class="description">
                            <i class="fas fa-info-circle"></i> Oglasu lahko dodate do 10 fotografij v formatu
                            .jpg, .png.
                        </p>

                        <div id="post-images-panel"></div>
                        <div style="display: none" id="existing-image">
                            <?php
                            $images = $listing->listingImagesThumb;
                            ?>
                            @foreach($images as $keyu => $img)
                                <div class="img-thmb editable" data-index="{{$key}}" data-id="{{$img->id}}">
                                    <img src="{{$img->url}}">
                                    <div class="rem-btn">
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p style="padding-top: 15px; display: none;" class="error-msg error_imgs">Vnesite veljavno
                            images</p>

                    </div>

                    <div id="post-confirm-update" class="seg-brd">
                        <a class="btn oval blue fw update-listing">Potrdi in nadaljuj</a>
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>

<script>
    $('.select').each(function () {
        $(this).select2({
            placeholder: ($(this).attr('data-placeholder') || '-'),
            minimumResultsForSearch: 8
        });

        $(this).data('select2').$container.find('.select2-selection__arrow').html('<i class="far fa-chevron-down"></i>');

        var ico = $(this).attr('data-icon');
        if (ico) {
            $(this).data('select2').$container.find('.select2-selection').addClass('has-ico').prepend('<i class="fas fa-' + ico + '"></i>');
        }
    });

</script>
<script src="/assets/js/pages/newpost.js"></script>
