<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="modal fade" wire:ignore.self id="modalScrollable" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @livewire('components.flash-message')

                    <div class="row mb-3">
                        <div class="col-md-12 mb-2">
                            <x-forms.text wire:model.defer="description" :placeholder="'Nama Accessories'"></x-forms.text>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-2">
                            <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                            <div class="input-group">
                                <textarea class="form-control @error('catatan') is-invalid @enderror" rows="3" placeholder="Catatan"
                                    wire:model="catatan"></textarea>
                            </div>
                        </div>

                        @error('catatan')
                            <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    @if ($action === 'create' || $action === 'edit')
                        <button type="button" class="btn btn-primary"
                            @if ($action === 'create') wire:click='save' @else wire:click='edit' @endif>Save
                            changes</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
