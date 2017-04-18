<h5>{{ trans('member.lbl-hello') }}<strong>{{ $name }}</strong></h5>
<div class="row">
    <h5>{{ trans('member.lbl-msg-pass') }} <strong style="color: red;">{{ $password }}</strong></h5>
    <p>{{ trans('member.lbl-msg-please') }}</p> <a href="{{ action('Member\HomeController@index') }}">{{ trans('member.lbl-connect') }}</a>
</div>
