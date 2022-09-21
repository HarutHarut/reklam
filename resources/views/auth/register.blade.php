@extends('layouts.guest')
@push('styles')
    <link href="/assets/css/pages/register.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="/assets/js/pages/register.js"></script>
@endpush
@section('content')


    <div class="cw">
        {{ Breadcrumbs::render('register') }}

        <div class="page-heading flx">
            <h1>Postanite uporabnik <span>Oglasi.si</span></h1>
            <p>
                <i class="fas fa-info-circle"></i> Že imate račun?
                <a class="lnk" data-modal="modal-login">Prijava</a>
            </p>
        </div>

        <div id="reg-container" class="tile" data-type="1">

            <div id="reg-type" class="flx center">
                <div class="indicator"></div>
                <div class="type active first">
                    <i class="fas fa-user"></i> <strong>Posameznik</strong>
                </div>
                <div class="type last">
                    <i class="fas fa-user-tie"></i> <strong>Podjetje</strong>
                </div>
            </div>

            <div id="reg-user">

                <p>
                    <span
                        class="for-type-1 tc fw">Registracija in oglaševanje je za <strong>posameznike brezplačna</strong>.</span>
                    <span class="for-type-2 fw">
                        Registracija in oglaševanje do <strong>5 objavljenih oglasov</strong> je za pravne osebe <strong>brezplačno</strong>.
                        <br><br>
                        <a href="/oglasevanje-in-ceniki/">Več o prednostih oglaševanja na Oglasi.si ter cenik paketov.</a>
                    </span>
                </p>

                <div class="tc ext-logins">
                    <a href="{{ route('social.oauth', 'facebook') }}" class="btn oval fb">
                        <i class="fab fa-facebook"></i> Registracija s Facebook
                    </a>
                    <a href="{{ route('social.oauth', 'google') }}" class="btn oval google">
                        <img src="/assets/res/ico/google.svg"> Registracija z Google
                    </a>
                </div>

                <div class="sep"><strong>Ali se registrirajte</strong></div>

                <div id="errors-list"></div>

                <div id="message_text" class="alert_message">

                </div>

                <form method="POST" action="{{ route('register') }}" class="frm-inputs" data-step="0">
                    @csrf

                    <input type="hidden" value="0" name="user_type"/>

                    <div class="progress flx">
                        <div class="step active">
                            <strong>Podatki uporabniškega računa</strong> <i class="fa fa-check"></i>
                        </div>
                        <div class="step">
                            <strong>Kontaktni podatki</strong> <i class="fa fa-check"></i>
                        </div>
                    </div>

                    <div class="steps">
                        <div class="step">
                            <div class="row">
                                @include('client.components.input', [
                                    'attributes' => [
                                        'name' => 'name',
                                        'placeholder' => 'Uporabniško ime',
                                        'icon' => 'fas fa-user',
                                        'errorMessage' => 'Vnesite veljavno uporabniško ime',
                                        'classes' => 'fw',
                                        'type' => 'text',
                                        'attrs' => 'required="required"'
                                    ]
                                ])
                                <p class="error_name" style="color: #f00"></p>
                            </div>
                            <div class="row">
                                @include('client.components.input', [
                                    'attributes' => [
                                        'name' => 'email',
                                        'placeholder' => 'E-poštni naslov',
                                        'icon' => 'fas fa-envelope',
                                        'errorMessage' => 'Vnesite veljaven e-poštni naslov',
                                        'classes' => 'fw',
                                        'type' => 'email',
                                        'attrs' => 'required="required"'
                                    ]
                                ])
                                <p class="error_email" style="color: #f00"></p>
                            </div>
                            <div class="row">
                                @include('client.components.input', [
                                    'attributes' => [
                                        'name' => 'password',
                                        'placeholder' => 'Prijavno geslo',
                                        'icon' => 'fas fa-lock',
                                        'errorMessage' => 'Vnesite veljavno geslo',
                                        'classes' => 'fw',
                                        'type' => 'password',
                                        'attrs' => 'required="required"'
                                    ]
                                ])
                                <p class="error_password" style="color: #f00"></p>
                            </div>

                            <div class="row wrap">
                                <div class="fw">
                                    @include('client.components.checkbox', ['attributes' => ['name' => 'tos', 'text' => 'Strinjam se s <a href="#" target="_blank" class="lnk">pogoji in pravili uporabe Oglasi.si</a>', 'value' => '1', 'isRequired' => true]])
                                </div>
                                <p class="error_tos" style="color: #f00"></p>
                            </div>

                            {{--<a class="btn oval blue fw next">Potrdi in nadaljuj</a>--}}
                            <button type="submit" class="btn oval blue fw next">Potrdi in nadaljuj</button>
                        </div>

                        <div class="step" id="company_inputs">
                            <div class="row company_tax_number_change">
                                @include('client.components.input', [
                                    'attributes' => [
                                        'name' => 'company_tax_number',
                                        'placeholder' => 'Davčna številka',
                                        'icon' => 'fas fa-pencil',
                                        'errorMessage' => 'Vnesite veljavno davčno številko',
                                        'classes' => '',
                                        'type' => 'text',
                                        'attrs' => ''//'required="required" pattern="^((AT)?U[0-9]{8}|(BE)?0[0-9]{9}|(BG)?[0-9]{9,10}|(CY)?[0-9]{8}L|(CZ)?[0-9]{8,10}|(DE)?[0-9]{9}|(DK)?[0-9]{8}|(EE)?[0-9]{9}|(EL|GR)?[0-9]{9}|(ES)?[0-9A-Z][0-9]{7}[0-9A-Z]|(FI)?[0-9]{8}|(FR)?[0-9A-Z]{2}[0-9]{9}|(GB)?([0-9]{9}([0-9]{3})?|[A-Z]{2}[0-9]{3})|(HU)?[0-9]{8}|(IE)?[0-9]S[0-9]{5}L|(IT)?[0-9]{11}|(LT)?([0-9]{9}|[0-9]{12})|(LU)?[0-9]{8}|(LV)?[0-9]{11}|(MT)?[0-9]{8}|(NL)?[0-9]{9}B[0-9]{2}|(PL)?[0-9]{10}|(PT)?[0-9]{9}|(RO)?[0-9]{2,10}|(SE)?[0-9]{12}|(SI)?[0-9]{8}|(SK)?[0-9]{10})$"'
                                    ]
                                ])
                                <p class="error_company_tax_number" style="color: #f00"></p>
                            </div>

                            <div class="row">
                                @include('client.components.input', [
                                    'attributes' => [
                                        'name' => 'company_name',
                                        'placeholder' => 'Naziv podjetja',
                                        'icon' => 'fas fa-briefcase',
                                        'errorMessage' => 'Vnesite veljaven naziv podjetja',
                                        'classes' => '',
                                        'type' => 'text',
                                        'attrs' => 'required="required"'
                                    ]
                                ])
                                <p class="error_company_name" style="color: #f00"></p>
                            </div>
                            <div class="row">
                                @include('client.components.input', [
                                    'attributes' => [
                                        'name' => 'company_addr',
                                        'placeholder' => 'Naslov sedeža podjetja',
                                        'icon' => 'fas fa-map-marker-alt',
                                        'errorMessage' => 'Vnesite veljaven naslov',
                                        'classes' => '',
                                        'type' => 'text',
                                        'attrs' => 'required="required"'
                                    ]
                                ])
                                <p class="error_company_addr" style="color: #f00"></p>
                            </div>
                            <div class="row select_region">

                                <?php
                                $allRegions = \App\Models\Regije::where('parent_id', '>', 0)
                                    ->pluck('regija', 'id');
                                ?>

                                <select class="select" name="region" data-placeholder="Izberite vašo regijo"
                                        data-icon="map-marker-alt">
                                    <option value="">Regija</option>
                                    @foreach($allRegions as $key => $region)
                                        <option value="{{ $key }}">{{ $region }}</option>
                                    @endforeach
                                </select>
                                <p class="error_region" style="color: #f00"></p>
                            </div>
                            <div class="row">
                                @include('client.components.input', [
                                    'attributes' => [
                                        'name' => 'phone',
                                        'placeholder' => 'Telefonska številka',
                                        'icon' => 'fas fa-phone-alt',
                                        'errorMessage' => 'Vnesite veljaveno telefonsko številko',
                                        'classes' => 'fw',
                                        'type' => 'phone',
                                        'attrs' => ''//'required="required" onkeyup="$(this).val($(this).val().replace(\' \', \'\').replace(\'-\', \'\'));" pattern="\d{8,10}"'
                                    ]
                                ])
                                <p class="error_phone" style="color: #f00"></p>
                            </div>

                            <a class="btn oval blue fw next last">Zaključi registracijo</a>
                        </div>
                        <div class="step success">
                            <i class="far fa-check flx center"></i> <strong>Registracija uspešna!</strong>
                            <p>Potrditveno sporočilo je bilo poslano na vaš e-poštni naslov.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
