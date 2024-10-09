@props(['href', 'logo', 'title' => 'Menu'])

<div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{ $href }}" class="brand-link"> <!--begin::Brand Image--> <img src="{{ $logo }}" alt="AdminLTE Logo"
            class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">{{ GlobalHelper::setting('app_name') }}</span>
        <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
<div class="sidebar-wrapper">
    <nav class="mt-2"> <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            {{ $slot ?? '' }}
        </ul> <!--end::Sidebar Menu-->
    </nav>
</div> <!--end::Sidebar Wrapper-->
