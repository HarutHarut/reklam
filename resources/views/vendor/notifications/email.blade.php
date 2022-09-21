@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
{{-- # @lang('Hello!') --}}
{{"Pozdravljeni, "}}
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{-- {{ $line }} --}}
{{"prosimo da s klikom na spodnji gumb potrdite svoj e-poštni naslov."}}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{-- {{ $line }} --}}
{{"Če se niste registrirali oz. spreminjali gesla, smatrajte to sporočilo kot brezpredmetno."}}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{-- {{ $salutation }} --}}
@else
@lang('Lep pozdrav'),<br>
{{-- {{ config('app.name') }} --}}
{{"Ekipa Oglasi.si"}}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    " Če imate težave z potrjevanjem emaila, skopirajte spodnjo povezavo\n".
    'v vaš brskalnik:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
