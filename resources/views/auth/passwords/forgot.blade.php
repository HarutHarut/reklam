@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/register.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="/assets/js/pages/register.js"></script>
@endpush
@section('content')
    <div class="cw">
        <div class="page-heading flx">
            <h1>Reset Password</h1>
        </div>
        <div id="reg-container" class="tile" data-type="1">
            <div id="message_text" class="alert_message {{ isset($message) ?  'success' : '' }}">
                {{ isset($message) ? $message : '' }}
            </div>
            <div id="reg-user">
                <form method="POST" action="{{ route('forgot.update') }}" class="frm-inputs" data-step="0">
                    @csrf

                    {{--                    <input type="hidden" name="token" value="{{ $token }}">--}}
                    <div class="step">

                        <div class="row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">E-poštni</label>

                            @include('client.components.input', [
                                        'attributes' => [
                                            'name' => 'email',
                                            'placeholder' => 'E-poštni',
                                            'icon' => null,
                                            'errorMessage' => null,
                                            'classes' => 'fw',
                                            'type' => 'email',
                                            'attrs' => 'required="required"'
                                        ]
                                    ])


                                <p class="error_email" style="color: #f00"></p>
                        </div>
                    </div>
                    <button type="submit" class="btn oval blue fw">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection
