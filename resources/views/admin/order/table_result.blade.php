<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{ trans('common.lbl-stt') }}</th>
            <th>{{ trans('order.lbl-date') }}</th>
            <th>{{ trans('order.lbl-total-number') }}</th>
            <th>{{ trans('order.lbl-total-price') }}</th>
            <th>{{ trans('order.lbl-customer') }}</th>
            <th>{{ trans('order.lbl-status') }}</th>
            <th>{{ trans('order.lbl-detail') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($orders))
            @foreach ($orders as $order)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $order->date_format }}</a></td>
                    <td>{{ $order->number }}</a></td>
                    <td>{{ $order->total_price_format }}</td>
                    <th>{{ $order->user->name }}</th>
                    <th>{{ $order->name_status }}</th>
                    <td>
                        @if (!$order->orderDeatils->isEmpty())
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ trans('common.lbl-stt') }}</th>
                                        <th>{{ trans('product.lbl-name') }}</th>
                                        <th>{{ trans('order.lbl-total-number') }}</th>
                                        <th>{{ trans('order.lbl-total-price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderDeatils as $orderDetail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $orderDetail->product->name }}</td>
                                            <td>{{ $orderDetail->number }}</td>
                                            <td>{{ $orderDetail->total_price_format }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </td>
                    <td>
                        @if ($order->status == config('setting.order_status.unpaid'))
                            <div class="col-md-6">
                                {{ Form::open(['action' => ['Admin\OrderController@changeStatus', $order->id, config('setting.order_status.paid')], 'method' => 'GET', 'class' => 'form-status-paid']) }}
                                    {!! Form::button(trans('common.button.paid'), ['class' => 'btn btn-success btn-status-paid', 'type' => 'button']) !!}
                                {{ Form::close() }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::open(['action' => ['Admin\OrderController@changeStatus', $order->id, config('setting.order_status.cancel')], 'method' => 'GET', 'class' => 'form-status-cancel']) }}
                                    {!! Form::button(trans('common.button.cancel'), ['class' => 'btn btn-danger btn-status-cancel', 'type' => 'button']) !!}
                                {{ Form::close() }}
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if (isset($orders))
    {{ $orders->links() }}
@endif
