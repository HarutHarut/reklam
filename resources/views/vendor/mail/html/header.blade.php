<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
<img src="http://www.oglasi.si/images/oglasi_logo.png" alt="Laravel Logo">
{{-- <img src="{{asset("img/logo_oglasi.png")}}" alt="oglasi.si logo"> --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
