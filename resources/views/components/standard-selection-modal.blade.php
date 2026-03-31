<div class="modal fade" id="standardSelectionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Standard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($standards->isEmpty())
                    <div class="alert alert-info">No standards available</div>
                @else
                    <div class="list-group">
                        @foreach($standards as $standard)
                            <button type="button" class="list-group-item list-group-item-action standard-item"
                                    data-standard-id="{{ $standard->id }}">
                                {{ $standard->name }}
                                @if($standard->description)
                                    <small class="text-muted d-block">{{ $standard->description }}</small>
                                @endif
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
