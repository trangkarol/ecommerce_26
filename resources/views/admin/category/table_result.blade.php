<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{ trans('common.lbl-stt') }}</th>
            <th>{{ trans('category.lbl-name') }}</th>
            <th>{{ trans('category.lbl-list-subcategory') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($categories))
            @foreach ($categories as $category)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</a></td>
                    <td>
                        @if (!$category->subCategory->isEmpty())
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ trans('common.lbl-stt') }}</th>
                                        <th>{{ trans('category.lbl-name') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category->subCategory as $subCategory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $subCategory->name }}</td>
                                            <td>
                                                <div class="col-md-3">
                                                    <a href ="{{ action('Admin\CategoryController@edit', $subCategory->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('category.tooltip.update') }}"><i class="fa fa-pencil-square-o"></i></a>
                                                </div>
                                                <div class="col-md-3">
                                                    {{ Form::open(['action' => ['Admin\CategoryController@destroy', $subCategory->id], 'class' => 'form-delete-category']) }}
                                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['class' => 'btn btn-primary btn-delete', 'type' => 'button', 'data-toggle' => 'tooltip', 'title' => trans('category.tooltip.delete')]) !!}
                                                    {{ Form::close() }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </td>
                    <td>
                        <div class="col-md-3">
                            <a href ="{{ action('Admin\CategoryController@edit', $category->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('category.tooltip.update') }}"><i class="fa fa-pencil-square-o"></i></a>
                        </div>
                        <div class="col-md-3">
                            {{ Form::open(['action' => ['Admin\CategoryController@destroy', $category->id], 'class' => 'form-delete-category']) }}
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['class' => 'btn btn-primary btn-delete', 'type' => 'button', 'data-toggle' => 'tooltip', 'title' => trans('category.tooltip.delete')]) !!}
                            {{ Form::close() }}
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
