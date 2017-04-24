<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{ trans('common.lbl-stt') }}</th>
            <th>{{ trans('order.lbl-date') }}</th>
            <th>{{ trans('order.lbl-total-number') }}</th>
            <th>{{ trans('order.lbl-total-price') }}</th>
            <th>{{ trans('order.lbl-detail') }}</th>

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
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if (isset($orders))
    {{ $orders->links() }}
@endif
