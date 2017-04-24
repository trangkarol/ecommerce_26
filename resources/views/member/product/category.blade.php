<div class="s-main">
    <div class="s_hdr">
        <h2>{{ trans('member.lbl-categories') }}</h2>
    </div>
    <div class="text1-nav">
        <ul>
            @foreach ($menus as $menu)
                <li class="@if (Request::url() == action('Member\ProductController@getProductCategory', $menu->id)) active @endif "><a href="{{ action('Member\ProductController@getProductCategory', $menu->id) }}">{{ $menu->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
