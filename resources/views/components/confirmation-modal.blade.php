<div id="{{ $name }}" class="modal micromodal-slide" aria-hidden="true">
    <div class="modal-backdrop" tabindex="-1" data-micromodal-close>
        <div class="modal-dialog" role="dialog" aria-modal="true" aria-labelledby="{{ $name }}-title">
            <div id="{{ $name }}-content" class="modal-content">
                <header class="modal-header">
                    <h5 id="{{ $name }}-title" class="modal-title">
                        {{ $title }}
                    </h5>
                </header>

                <div class="modal-body">
                    <p class="text-left">{{ $description }}</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link ml-2" data-micromodal-close>{{ __('Close') }}</button>
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.querySelector('{{ $formSelector }}').submit()">{{ __('Cancel Request') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
