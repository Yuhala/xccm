@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    @lang("login.login")
@endsection

@section('content')
<body class="hold-transition login-page">
    <div id="app" v-cloak>
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/home').addlang() }}"><b>{{config('app.name')}}</b></a>
            </div><!-- /.login-logo -->

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {{ __("login.error") }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body">
        <p class="login-box-msg"> {{ __('login.message') }} </p>
        <form action="{{ url('/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="{{ __("login.name") }}" name="{{ config('auth.providers.users.field','email') }}"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            {{-- <login-input-field
                    name=""
                    domain="{{ config('auth.defaults.domain','') }}"
                    placeholder="{{__('login.name')}}"
                    ></login-input-field> --}}
            {{--<div class="form-group has-feedback">--}}
                {{--<input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email"/>--}}
                {{--<span class="glyphicon glyphicon-envelope form-control-feedback"></span>--}}
            {{--</div>--}}
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="{{ __("login.passwd") }}" name="password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input style="display:none;" type="checkbox" name="remember"> {{ __("login.remember") }}
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('login.signin') }}</button>
                </div><!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/password/reset').addlang()}}">{{ __('login.forgotpassword') }}</a><br>
        <a href="{{ url('/register').addlang() }}" class="text-center">{{ __('login.registermember') }}</a>

    </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
