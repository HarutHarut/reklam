<h1 class="bgt">Rezultati iskanja</h1>
<ul class="flx">
    @foreach($searchResultCategories as $category => $items)
        <li>
            <a href="/category/{{ json_decode($category)->slug }}">
                <strong>{{ json_decode($category)->tip }}</strong>
                <span class="bgt catColor">{{ count($items) }}</span>
            </a>
        </li>
    @endforeach
</ul>
