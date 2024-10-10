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

<body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            @include('layouts.partials.header')
        </nav>
        <aside class="app-sidebar bg-primary-subtle" data-bs-theme="dark">
            @include('layouts.partials.sidebar')
        </aside>
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        {{ $header }}
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row g-4 justify-content-center">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline"></div> <strong>
                Copyright &copy; {{ date('Y') }}&nbsp;
                <a href="https://www.instagram.com/sewagati_smasa/" class="text-decoration-none link-brown">{{ GlobalHelper::setting('author') }}</a>.
            </strong>
            All rights reserved.
        </footer>
    </div>
    @include('layouts.partials.scripts')
</body>

</html>
