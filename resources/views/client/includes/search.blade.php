@push('scripts')
    <script>

        $('.search .region-select input[name="regions[]"]').click(function () {
            if ($(this).next().find('i').css('opacity') != 0) {
                $(this).next().find('i').css('opacity', 0)
            } else {
                $(this).next().find('i').css('opacity', 1)
            }
            //console.log($(this).val(), $(this).attr('checked'))
        })
    </script>
@endpush
<div class="search flx">
    <form method="get"
          action="{{ route('search') }}"
          style="width: 100%; display: flex"
    >
        {{--        <input type="text" name="searchQuery" required placeholder="Išči med {{ $allProductsCount }} oglasi..">--}}

        <?php
        $allProductsCount = \App\Models\MaliOglasi::query()
            ->where(['status' => true])
            ->count();
        $parentRegions = \App\Models\Regije::where('parent_id', 0)
            ->where('country_id', 1)
            ->get();

        ?>
        <input
            type="text"
            id="searchQuery"
            name="searchQuery"
            required
            placeholder="Išči med {{ $allProductsCount }} oglasi.."
            @if(isset($searchQuery))
            value="{{ $searchQuery }}"
            @endif
        >

        <div class="region">
{{--            @if(isset($regions) && count($regions))--}}
                <label class="flx center">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Celotna Slovenija</span>
                    <i class="fal fa-chevron-down"></i>
                </label>
            <div class="region-select">
                    <ul>
                        @foreach($parentRegions as $region)
                            <li>
                                @include('client.components.checkbox', [
                                    'attributes' => [
                                        'name' => 'regions[]',
                                        'text' => $region->regija,
                                        'value' => $region->id,
                                        'isChecked' => true
                                    ]
                                ])
                            </li>
                        @endforeach
                    </ul>
                </div>
        </div>
        <button type="button" class="searchClick">
            <i class="far fa-search fa-flip-horizontal"></i>
        </button>
    </form>
</div>
<script>
    $('.searchClick').click(function () {
        let search = $('#searchQuery').val();
        let val = '';
        let regions = [];
        $('.region-select input:checked').each(function () {
            val = '"' + $(this).val() + '"';
            regions.push(val);
        });
        console.log(regions)
        console.log(JSON.stringify(regions));
        let url = 'search?page=1&searchQuery=' + search.replace(' ', '+') + '&regions=[' + regions + ']';
        window.location.href = url;
    });

</script>
