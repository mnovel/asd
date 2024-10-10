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

<body class="lockscreen bg-dark-blue">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <img src="{{ asset('storage/assets/img/logo.png') }}" alt="" class="img-fluid" width="40%"><br>
            <a href="{{ route('login') }}" class="text-white"><b>{{ GlobalHelper::setting('app_name') }}</b><br>{{ GlobalHelper::setting('instansi') }}</a>
        </div>
        <div class="lockscreen-name text-white">{{ Auth::user()->name ?? '' }}</div>
        <div class="lockscreen-item">
            <div class="lockscreen-image"> <img src="{{ asset('storage/assets/img/user.png') }}" alt="User Image"> </div>
            <form class="lockscreen-credentials" action="{{ route('auth.resetPassword') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="email" class="form-control shadow-none  @error('email')is-invalid  @enderror" value="{{ old('email') }}" placeholder="email" id="email"
                        name="email">
                    <div class="input-group-text border-0 bg-transparent px-1">
                        <button type="submit" class="btn shadow-none"> <i class="fa-solid fa-right-to-bracket text-body-secondary"></i> </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="help-block text-center text-white">
            Enter your email to reset your password
        </div>
        <div class="text-center"> <a href="{{ route('login') }}" class="text-decoration-none link-brown">Or Sign in to start your session</a> </div>
        <div class="lockscreen-footer text-center text-white">
            Copyright © {{ Carbon::now()->format('Y') }} &nbsp;
            <b><a href="https://www.instagram.com/sewagati_smasa/" class="link-brown link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">MPK SEWAGATI SMA
                    Negeri 1 Pasuruan</a></b> <br>
            All rights reserved
        </div>
    </div>
    @include('layouts.partials.scripts')
</body>

</html>
