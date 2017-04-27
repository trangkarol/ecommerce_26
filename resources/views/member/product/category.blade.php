<div class="s-main">
    <div class="s_hdr">
        <h2>{{ trans('member.lbl-categories') }}</h2>
    </div>
    <div class="text1-nav">
        <div class="panel-group" id="accordion">
            @foreach ($menus as $menu)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->iteration }}">{{ $menu->name }}</a>
                        </h4>
                    </div>
                    @if (!$menu->subCategory->isEmpty())
                        <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table">
                                    @foreach ($menu->subCategory as $subCategory)
                                        <tr>
                                            <td>
                                               <a href="{{ action('Member\ProductController@getProductCategory', $subCategory->id) }}">{{ $subCategory->name }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
