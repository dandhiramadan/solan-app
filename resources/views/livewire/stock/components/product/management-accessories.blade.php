<div>
    {{-- The Master doesn't talk, he acts. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Products /</span> Management Accessories</h4>

    @if (session()->has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <span class="alert-icon text-success me-2">
                <i class="ti ti-check ti-xs"></i>
            </span>
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <span class="alert-icon text-danger me-2">
                <i class="ti ti-ban ti-xs"></i>
            </span>
            {{ session('error') }}
        </div>
    @endif
    <!-- Basic Layout -->
    <div class="card mb-4">
        <h5 class="card-header">Form Add Accessories</h5>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="name" :placeholder="'Nama Accessories'"></x-forms.text>
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1" wire:click='save'>Submit</button>
            </div>
        </div>

    </div>
</div>
