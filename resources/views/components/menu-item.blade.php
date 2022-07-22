<li class="nav-item">
    <a href="{{ $link }}" class="nav-item-link">
        <span>
            <i class="{{ $class }}"></i>
            {{ $name }}
        </span>
        @if($counter>=0)
        <Span class="badge badge-pill bg-light shadow-sm text-black-50">{{ $counter }}</Span>
        @endif
    </a>
</li>