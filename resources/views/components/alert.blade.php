@if($heading)
    <div
        class="alert alert-{{ $type }} @if($dismissable) alert-dismissable @endif d-flex align-items-center justify-content-between"
        role="alert">
        @if($dismissable)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        @endif
        <div class="flex-fill mr-3">
            <h3 class="alert-heading font-size-h4 my-2">
                @if($icon) <i class="fa fa-fw fa-{{ $icon }}"></i> @endif
                {{ $heading }}
            </h3>
            <p class="mb-0">
                {!! $message !!}
            </p>
        </div>
    </div>
@else
    <div class="alert alert-{{ $type }} mt-2 d-flex align-items-center @if($dismissable) alert-dismissable @endif" role="alert"
         style="padding:0.25rem 0.5rem;">
        @if($dismissable)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        @endif
        @if($icon)
            <div class="flex-00-auto">
                <i class="fa fa-fw {{ $icon }}"></i>
            </div>
        @endif
        <div class="flex-fill ml-1">
            <p class="mb-0" style="font-size: 0.85rem;">
                {!! $message !!}
            </p>
        </div>
    </div>
@endif
