<ol class="breadcrumb float-sm-right">
    @foreach ($breadcrumbs as $name => $link)
        <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
            @if ($link != '')
                <a href="{{ $link }}">{{ $name }}</a>
            @else
                {{ $name }}
            @endif
        </li>
    @endforeach
</ol>
