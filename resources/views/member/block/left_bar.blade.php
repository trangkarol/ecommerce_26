@foreach ($menus as $menu)
    <div class="s-main">
        <div class="s_hdr">
            <h2>{{ $menu->name }}</h2>
        </div>
        <div class="text1-nav">
            <ul>
                <li class="{{ !$menu->subCategory->emty() ? dropdow : '' }}">
                    <a href="products.html">{{ $menu->name }}</a></li>
                </li>
                @foreach ($menu->subCategory as $subCategory)
                    <li><a href="products.html">{{ $subCategory->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endforeach
