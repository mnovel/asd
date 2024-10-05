@props(['link', 'name', 'alias'])

@php
    $routeName = Request::route()->getName();
    $active = str_contains($routeName, $alias);
    $classes = $active ? 'active' : '';
@endphp

<li class="nav-item">
    <a href="{{ $link }}" class="nav-link {{ $classes }}">
        <i class="nav-icon bi bi-circle"></i>
        <p>{{ $name }}</p>
    </a>
</li>
