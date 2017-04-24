<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('static.export-statistic')}}</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>{{ trans('common.lbl-stt') }}</th>
            <th>{{ trans('static.lbl-name-product') }}</th>
            <th>{{ trans('static.lbl-total-number') }}</th>
            <th>{{ trans('static.lbl-total-price') }}</th>
            <th>{{ trans('static.lbl-category') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($data))
            @foreach ($data as $product)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->numberProduct }}</td>
                    <td>{{ number_format($product->toatalPrice, 3, ',', ',') . ' ' . trans('common.lbl-vnd') }}</td>
                    <td>{{ $product->categoryName }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
    </table>
</body>
</html>
