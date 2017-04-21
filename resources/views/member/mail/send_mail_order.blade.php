<h3>{{ trans('common.mail.lbl-header') }} <strong>{{ Auth::user()->name }}</strong></h3>
<div>
    <h5>{{ trans('common.mail.lbl-content') }}</h5>

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
    <h6>{{ trans('common.mail.lbl-content') }} <strong>{{ $order->total_price_format }}</strong></h6>
</div>
