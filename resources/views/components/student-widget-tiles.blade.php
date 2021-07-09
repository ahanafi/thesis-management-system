<div class="col-6 col-md-4 col-xl-2">
    <a class="block @if(!$isDone && $text !== 'Persyaratan Skripsi') disabled @endif text-center {{ $background }}"
       @if($isDone || $text === 'Persyaratan Skripsi' )
       href="{{ $link !== '' ? $link : 'javascript:void(0)' }}"
       @else
       href="#"
       disabled="disabled"
        @endif
    >
        <div
            class="
                block-content
                animated
                fadeIn
                block-content-full
                aspect-ratio-16-9
                d-flex
                justify-content-center
                align-items-center
                {{ $isDone ? 'ribbon ribbon-success ribbon-left' : '' }}
                ">
            <div>
                @if($isDone)
                    <div class="ribbon-box">
                        <i class="fa fa-check mr-1"></i>
                    </div>
                @endif
                <i class="far fa-2x {{ $icon }} {{ $textColor }}"></i>
                <div class="font-w600 mt-3 text-white">{{ $text }}</div>
            </div>
        </div>
    </a>
</div>
