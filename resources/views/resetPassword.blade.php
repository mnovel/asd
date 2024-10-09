<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ GlobalHelper::setting('name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="{{ GlobalHelper::setting('name') }}">
    <meta name="author" content="{{ GlobalHelper::setting('author') }}">
    <meta name="description" content="{{ GlobalHelper::setting('description') }}">
    <meta name="keywords" content="{{ GlobalHelper::setting('keywords') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI="
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css" integrity="sha256-gm2jB4Crdw1zuiybGdH7svr9LMyenyQV+rCwJHTNS5w="
        crossorigin="anonymous">
</head>

<body class="lockscreen bg-body-secondary">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo"> <a href="#">{{ config('app.name', 'Laravel') }}<br>SMA Negeri 1 Pasuruan</a> </div>
        <div class="lockscreen-name">{{ Auth::user()->name ?? '' }}</div>
        <div class="lockscreen-item">
            <div class="lockscreen-image"> <img src="{{ asset('storage/template/dist/assets/img/user.png') }}" alt="User Image"> </div>
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
        <div class="help-block text-center">
            Enter your email to reset your password
        </div>
        <div class="text-center"> <a href="{{ route('login') }}" class="text-decoration-none">Or Sign in to start your session</a> </div>
        <div class="lockscreen-footer text-center">
            Copyright © {{ Carbon::now()->format('Y') }} &nbsp;
            <b><a href="https://www.instagram.com/sewagati_smasa/" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">MPK SEWAGATI SMA
                    Negeri 1 Pasuruan</a></b> <br>
            All rights reserved
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/js/adminlte.min.js" integrity="sha256-x5Mj2wYeSa9WVOK+EK8Z5rmXHFZ+MOY8r4eW8AKzpXU=" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/c1c9003162.js" crossorigin="anonymous"></script>

    @include('sweetalert::alert')

    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
</body>

</html>
