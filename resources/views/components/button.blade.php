@if ($isLink)
    <a href="{{ $link }}" class="btn btn-{{ $type }}">
        {{ $text }}
    </a>
@else
    <button class="btn btn-{{ $type }}" type="{{ $btnType }}" name="{{ $name }}">
        {{ $text }}
    </button>
@endif
