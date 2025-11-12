@props(['active' => ''])

<a {{ $attributes }}
class="nav-link {{ $active ? 'active' : '' }}">
{{ $slot }}</a>