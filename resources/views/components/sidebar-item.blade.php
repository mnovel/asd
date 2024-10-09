@props(['icon', 'link', 'name', 'alias'])

@php

    $routeName = explode('.', Request::route()->getName());
    $active = !strcmp(str_replace('-', ' ', $routeName[0]), $alias);
    $open = $active && !$slot->isEmpty() ? 'menu-open' : '';
    $classes = $active ? 'active' : '';

@endphp

<li class="nav-item {{ $open }}">
    <a href="{{ $slot->isEmpty() ? $link : '#' }}" class="nav-link {{ $classes }}">
        <i class="nav-icon {{ $icon }}"></i>
        <p>
            {{ $name }}
            @if (!$slot->isEmpty())
                <i class="nav-arrow bi bi-chevron-right"></i>
            @endif
        </p>
    </a>
    @if (!$slot->isEmpty())
        <ul class="nav nav-treeview">
            {{ $slot }}
        </ul>
    @endif
</li>
