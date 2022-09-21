@unless ($breadcrumbs->isEmpty())
    <div class="breadcrumbs">
        <ul>
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!is_null($breadcrumb->url) && !$loop->last)
                    <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a><i class="far fa-chevron-right"></i></li>
                @else
                    <li>{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endunless
