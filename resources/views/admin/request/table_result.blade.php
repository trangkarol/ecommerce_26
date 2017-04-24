<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{ trans('common.lbl-stt') }}</th>
            <th>{{ trans('product.lbl-images') }}</th>
            <th>{{ trans('product.lbl-name') }}</th>
            <th>{{ trans('product.lbl-price') }}</th>
            <th>{{ trans('product.lbl-description') }}</th>
            <th>{{ trans('product.lbl-customer') }}</th>
            <th>{{ trans('product.lbl-accept') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($requestProducts))
            @foreach ($requestProducts as $product)
                <tr class= "row-accept">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ action('Admin\RequestController@show', $product->id) }}"><img src="{{ $product->path_images }}" width="70px" height="50px" /></a>
                    </td>
                    <td><a href="{{ action('Admin\RequestController@show', $product->id) }}">{{ $product->product_name }}</a></td>
                    <td>{{ $product->price_format }}</td>
                    <td class="div-description">{{ $product->description }}</td>
                    <td>{{ $product->user->name }}</td>
                    <td>{{ $product->is_accept ? trans('product.lbl-accept') : '' }}</td>
                    <td>
                        @if (!$product->is_accept)
                            <div class="col-md-6">
                                {!! Form::open(['action' => 'Admin\RequestController@store', 'class' => 'form-save']) !!}
                                    {{ Form::hidden('suggestId', $product->id) }}
                                    {!! Form::button(trans('common.button.accept'), ['class' => 'btn btn-success btn-save', 'type' => 'button']) !!}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-6">
                                {!! Form::open(['action' => ['Admin\RequestController@update', $product->id], 'method' => 'PUT', 'class' => 'form-cancel']) !!}
                                    {!! Form::button(trans('common.button.cancel'), ['class' => 'btn btn-danger btn-cancel', 'type' => 'button']) !!}
                                {{ Form::close() }}
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if (isset($requestProducts))
    {{ $requestProducts->links() }}
@endif
