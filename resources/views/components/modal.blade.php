<div class="modal fade" id="{{$id}}">
    <div class="modal-dialog {{$class ?? ''}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$title ?? ''}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                {{ $footer ?? '' }}
            </div>
        </div>
    </div>
</div>