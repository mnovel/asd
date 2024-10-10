<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ GlobalHelper::setting('app_name') . ' | ' . GlobalHelper::setting('instansi') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="{{ GlobalHelper::setting('app_name') . ' | ' . GlobalHelper::setting('instansi') }}">
    <meta name="author" content="{{ GlobalHelper::setting('author') }}">
    <meta name="description" content="{{ GlobalHelper::setting('description') }}">
    <meta name="keywords" content="{{ GlobalHelper::setting('keywords') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.styles')
</head>

<body class="login-page bg-dark-blue">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('storage/assets/img/logo.png') }}" alt="" class="img-fluid" width="40%"><br>
            <a href="{{ route('login') }}" class="text-white"><b>{{ GlobalHelper::setting('app_name') }}</b><br>{{ GlobalHelper::setting('instansi') }}</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('auth.signIn') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email')is-invalid  @enderror" placeholder="Email" name="email" id="email"
                            value="{{ old('email') }}">
                        <div class="input-group-text">
                            <span class="fa-solid fa-envelope"></span>
                        </div>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password')is-invalid  @enderror" placeholder="Password" name="password" id="password">
                        <div class="input-group-text">
                            <span class="fa-solid fa-lock"></span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-beige">Sign In</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="mb-1 mt-3 text-center"> <a href="{{ route('resetPassword') }}" class="text-decoration-none link-brown">I forgot my password</a></p>
                <p class="mb-0 text-center"> <a href="{{ route('register') }}" class="text-decoration-none link-brown">Register a new membership</a></p>
            </div>
        </div>
    </div>
    @include('layouts.partials.scripts')
</body>

</html>
