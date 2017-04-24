<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{ trans('common.lbl-stt') }}</th>
            <th>{{ trans('user.lbl-avatar') }}</th>
            <th>{{ trans('user.lbl-email') }}</th>
            <th>{{ trans('user.lbl-name') }}</th>
            <th>{{ trans('user.lbl-role') }}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($members))
            @foreach ($members as $member)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ action('Admin\UserController@show', $member->id) }}"><img src="{{ url('/Upload', $member->avatar) }}" width="70px" height="50px" /></a>
                    </td>
                    <td><a href="{{ action('Admin\UserController@show', $member->id) }}">{{ $member->email }}</a></td>
                    <td><a href="{{ action('Admin\UserController@show', $member->id) }}">{{ $member->name }}</a></td>
                    <td>{{ $member->name_role }}</td>
                    <td>
                        <div class="col-md-6">
                            <a href ="{{ action('Admin\UserController@edit', $member->id ) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit member"><i class="fa fa-pencil-square-o"></i></a>
                        </div>
                        <div class="col-md-6">
                            {{ Form::open(['action' => ['Admin\UserController@destroy', $member->id], 'method' => 'DELETE', 'class' => 'delete-form-user']) }}
                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['class' => 'btn btn-primary btn-delete', 'type' => 'button', 'data-toggle' => 'tooltip', 'title' => 'Delete member']) !!}
                            {{ Form::close() }}
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if (isset($members))
    {{ $members->links() }}
@endif
