<div class="container-fluid">
    <ul class="navbar-nav">
        <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
        <li class="nav-item d-none d-md-block"> <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a> </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" href="#">Contact</a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-start">
                <a href="https://wa.me/6285650803289" target="_blak" class="dropdown-item">Vincent (XI-7)</a>
                <div class="dropdown-divider"></div>
                <a href="https://wa.me/6282232585495" target="_blak" class="dropdown-item">Fauziyah (X-4)</a>
                <div class="dropdown-divider"></div>
                <a href="https://wa.me/6282338358269" target="_blak" class="dropdown-item">Afriza (X-5)</a>
            </div>
        </li>
        @role('Admin')
            <li class="nav-item d-none d-md-block"> <a href="{{ route('resetDatabase') }}" class="nav-link">Reset Database</a> </li>
            <li class="nav-item d-none d-md-block"> <a href="{{ route('dashboard') }}" class="nav-link">Clear Cache</a> </li>
        @endrole
    </ul>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
            </a>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img src="{{ asset('storage/assets/img/user.png') }}" class="user-image rounded-circle shadow" alt="User Image">
                <span class="d-none d-md-inline">{{ ucwords(Auth::user()->name) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end rounded-bottom-3">
                <li class="user-header bg-primary-subtle text-white" data-bs-theme="dark"> <img src="{{ asset('storage/assets/img/user.png') }}" class="rounded-circle shadow"
                        alt="User Image">
                    <p>
                        {{ ucwords(Auth::user()->name) }}
                        <small>{{ Auth::user()->email }}</small>
                    </p>
                </li>
                <li class="user-footer">
                    <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('auth.signOut') }}" class="btn btn-default btn-flat float-end">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
