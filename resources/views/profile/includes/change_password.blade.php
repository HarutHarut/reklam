<style>
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
</style>

<div class="page-heading flx">
    <h1>Sprememba <span>gesla</span></h1>
</div>

<div class="profile-edit-tile">
    <div id="message_text" class="alert_message">

    </div>
    <form id="updatePassword" class="content frm-inputs">
        @if(empty($reset))
            <div class="seg">
                <h3>Potrditev gesla</h3>
                <div class="row">
                    <div class="input input-type-text">
                        <div class="input-inner">
                            <input type="password"
                                   name="old_password"
                                   placeholder="Obstoječe geslo"
                                   required
                            >
                            <div class="input-decor">
                                <i class="decor fas fa-lock"></i>
                                <i class="error-ico fas fa-exclamation-circle"></i>
                                <p class="error_old_password"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(isset($reset) && $reset !== null)
            <input type="hidden" name="reset" value="{{ $reset }}">
        @endif

        <div class="seg">
            <h3 class="">Novo geslo</h3>
            <div class="row">

                <div class="input input-type-text">
                    <div class="input-inner">
                        <input type="password"
                               name="password"
                               placeholder="Novo geslo"
                               required
                        >
                        <div class="input-decor">
                            <i class="decor fas fa-lock"></i>
                            <i class="error-ico fas fa-exclamation-circle"></i>
                            <p class="error_password"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input input-type-text">
                    <div class="input-inner">
                        <input type="password"
                               name="password_confirmation"
                               placeholder="Potrditev novega gesla"
                               required
                        >
                        <div class="input-decor">
                            <i class="decor fas fa-lock"></i>
                            <i class="error-ico fas fa-exclamation-circle"></i>
                            <p class="error_password_confirmation"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn blue oval fw save save-password">Potrdi spremembo gesla</button>

    </form>
</div>

<script>
    $('.save-password').on('click', function () {
        let values = {};
        //
        $('#updatePassword input').each(function () {
            if ($(this).attr('name')) {
                values[$(this).attr('name')] = $(this).val();
            }
        })

        $.ajax({
            url: "/profile/update-password",
            method: 'POST',
            data: values,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#message_text').removeClass('danger');
                $('#message_text').addClass('success');
                $('#message_text').empty().html(response.message);
            },
            error: (data) => {
                if (data.responseJSON.message && !data.responseJSON.errors) {
                    $('#message_text').removeClass('success');
                    $('#message_text').addClass('danger');
                    $('#message_text').empty().html(data.responseJSON.message);
                }
                $('.seg .input-decor p').empty();
                $.each(data.responseJSON.errors, (index, value) => {
                    $('.error_' + index).text(value).css({color: 'red', display: 'block'});
                });
            },
        });


    })
</script>
