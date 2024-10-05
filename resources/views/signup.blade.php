<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Register Page">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI="
        crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css" integrity="sha256-gm2jB4Crdw1zuiybGdH7svr9LMyenyQV+rCwJHTNS5w="
        crossorigin="anonymous"><!--begin::Required Plugin(AdminLTE)-->

</head> <!--end::Head--> <!--begin::Body-->

<body class="register-page bg-body-secondary">
    <div class="register-box">
        <div class="register-logo"> <a href="../index2.html"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.register-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>
                <form action="{{ route('auth.signUp') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('nama')is-invalid  @enderror" placeholder="Nama Lengkap" name="nama" id="nama"
                            value="{{ old('nama') }}">
                        <div class="input-group-text">
                            <span class="bi bi-person-bounding-box"></span>
                        </div>
                        @error('nama')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <select name="kelas" id="kelas" class="form-select @error('kelas')is-invalid  @enderror">
                            @foreach ($class as $classItem)
                                <option value="{{ $classItem->name }}" {{ old('kelas') == $classItem->name ? 'selected' : '' }}>{{ $classItem->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-text">
                            <span class="bi bi-building-fill"></span>
                        </div>
                        @error('kelas')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('username')is-invalid  @enderror" placeholder="Username" name="username" id="username"
                            value="{{ old('username') }}">
                        <div class="input-group-text">
                            <span class="bi bi-person-fill"></span>
                        </div>
                        @error('username')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password')is-invalid  @enderror" placeholder="Password" name="password" id="password">
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div> <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2 col-6 mx-auto"> <button type="submit" class="btn btn-primary">Sign In</button> </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
                <p class="mt-3 mb-0 text-center">
                    <a href="{{ route('login') }}">
                        I already have a membership
                    </a>
                </p>
            </div> <!-- /.register-card-body -->
        </div>
    </div> <!-- /.register-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w="
        crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous">
    </script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous">
    </script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/js/adminlte.min.js" integrity="sha256-x5Mj2wYeSa9WVOK+EK8Z5rmXHFZ+MOY8r4eW8AKzpXU=" crossorigin="anonymous">
    </script><!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

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
    </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->
</body><!--end::Body-->

</html>
