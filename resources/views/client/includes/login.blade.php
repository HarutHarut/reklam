<div id="modal-login" class="modal">
    <div class="content">
        <div class="head">
            <h2>Prijava v Oglasi.si</h2>
        </div>
        <div class="tc ext-logins">
            <a href="{{ route('social.oauth', 'facebook') }}" class="btn oval fb">
                <i class="fab fa-facebook"></i> Facebook prijava
            </a>
            <a href="{{ route('social.oauth', 'google') }}" class="btn oval google">
                <img src="/assets/res/ico/google.svg"> Google prijava
            </a>
        </div>
        <div class="login-oglasi">
            <div class="sep"><strong>Ali se prijavite</strong></div>
            <form class="login_inputs frm-inputs"
{{--                  method="POST"--}}
{{--                  action="{{ route('login') }}"--}}
            >
{{--                @csrf--}}

                <div class="row">
                    <div class="input input-type-email fw">
                        <div class="input-inner">
                            <input type="email" name="email" placeholder="Vpišite vaš e-poštni naslov" required>
                            <div class="input-decor">
                                <i class="decor fas fa-user"></i>
                                <i class="error-ico fas fa-exclamation-circle"></i>
                                <p style="display: none; padding-top: 8px;" class="error_email">Vnesite veljaven e-poštni naslov</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row last">
                    <div class="input input-type-email fw">
                        <div class="input-inner">
                            <input type="password" name="password" placeholder="Vpišite vaše geslo" required>
                            <div class="input-decor">
                                <i class="decor fas fa-lock"></i>
                                <i class="error-ico fas fa-exclamation-circle"></i>
                                <p style="display: none; padding-top: 8px;" class="error_password">Vnesite veljavno gesl</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Route::has('forgot.password'))
                    <div class="forgotten-password">
                        <a href="{{ route('forgot.password') }}">Ste pozabili geslo?</a>
                    </div>
                @endif

                <button type="button" class="btn oval blue fw login_form">Prijava</button>
            </form>

            <div class="new-user">
                <p>
                    Še nimate profila?
                    <a href="/register" class="lnk">Registracija</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    $('.login_form').click(function (e) {
        e.preventDefault();
        let data = $('.login_inputs').serialize();
        $.ajax({
            url: "login",
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                window.location.reload()
            },
            error: (data) => {
                console.log('error', data)
                $('.input-decor p').empty();
                $.each(data.responseJSON.errors, (index, value) => {
                    $('.error_' + index).text(value).css({ color: 'red', display : 'block' });
                });
            },
        });
    })
</script>
