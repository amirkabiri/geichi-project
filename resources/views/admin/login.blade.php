@extends('admin.layouts.index')

@section('title', 'Login')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">{{ env('APP_NAME') }}</div>
                <div class="card card-primary">
                    <div class="card-header"><h4>Login</h4></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.login.handle') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input
                                    id="username"
                                    type="text"
                                    class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                    name="username"
                                    autocomplete="off"
                                    tabindex="1"
                                    value="{{ old('username') }}"
                                    autofocus/>
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                    <div class="float-right">
{{--                                        <a href="auth-forgot-password.html" class="text-small">--}}
{{--                                            Forgot Password?--}}
{{--                                        </a>--}}
                                    </div>
                                </div>
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    name="password"
                                    tabindex="2"/>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        {{ old('remember') ? 'checked' : '' }}
                                        name="remember"
                                        class="custom-control-input"
                                        tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
{{--                <div class="mt-5 text-muted text-center">--}}
{{--                    Don't have an account? <a href="auth-register.html">Create One</a>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
