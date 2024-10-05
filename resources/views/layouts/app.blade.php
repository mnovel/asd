<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Fixed Sidebar">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.styles')
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse  bg-body-tertiary">
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
            <div class="float-end d-none d-sm-inline">Anything you want</div> <strong>
                Copyright &copy; 2014-2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.

        </footer>
    </div>
    @include('layouts.partials.scripts')
</body>

</html>
