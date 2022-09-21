@extends('layouts.app')
@push('styles')
    <link href="/assets/css/pages/category.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"
          rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
    <script src="/assets/js/pages/category.js"></script>
@endpush
@section('content')
    <div class="cw">
        <div class="flx shop-divide">
        <div class="right">

            <div id="result">
                @include('client.includes.pagination', ['result' => $result])
            </div>
        </div>
        </div>
    </div>
@endsection
