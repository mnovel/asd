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

<body class="register-page bg-dark-blue">
    <div class="register-box">
        <div class="register-logo">
            <img src="{{ asset('storage/assets/img/logo.png') }}" alt="" class="img-fluid" width="40%"><br>
            <a href="{{ route('login') }}" class="text-white"><b>{{ GlobalHelper::setting('app_name') }}</b><br>{{ GlobalHelper::setting('instansi') }}</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>
                <form action="{{ route('auth.signUp') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('name')is-invalid  @enderror" placeholder="Full Name" name="name" id="name"
                            value="{{ old('name') }}">
                        <div class="input-group-text">
                            <span class="fa-solid fa-user"></span>
                        </div>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control @error('nis')is-invalid  @enderror" placeholder="NIS" name="nis" id="nis" value="{{ old('nis') }}">
                        <div class="input-group-text">
                            <span class="fa-solid fa-id-card"></span>
                        </div>
                        @error('nis')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <select name="class" id="class" class="form-select @error('class')is-invalid  @enderror">
                            @foreach ($class as $classItem)
                                <option value="{{ $classItem->id }}" {{ old('class') == $classItem->id ? 'selected' : '' }}>{{ $classItem->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-text">
                            <span class="fa-solid fa-landmark"></span>
                        </div>
                        @error('class')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
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
                                <button type="submit" class="btn btn-beige">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </form>
                <p class="mt-3 mb-0 text-center"><a href="{{ route('login') }}" class="text-decoration-none link-brown">I already have a membership</a></p>
            </div>
        </div>
    </div>
    @include('layouts.partials.scripts')
</body>

</html>
