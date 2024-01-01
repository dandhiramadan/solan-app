<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Stock /</span> List Stock</h4>

    @livewire('components.flash-message')

    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">Data Stock</h5>
        </div>

        <div class="card-header">
            <div class="row d-flex justify-content-between">
                <div class="col">
                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                        wire:model.live.debounce.300ms='paginate'>
                        <option label="Show"></option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-lg-10">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search..." aria-label="Search..."
                            aria-describedby="basic-addon-search31" wire:model.live.debounce.300ms="search" />
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Pemesan</th>
                        <th>Panjang</th>
                        <th>Lebar</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($products as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->customer_name }}</td>
                            <td>{{ $data->panjang }}</td>
                            <td>{{ $data->lebar }}</td>
                            @php
                                $totalQuantity = 0;
                            @endphp

                            @foreach ($data->accessories as $accessory)
                                @php
                                    $totalQuantity += $accessory->pivot->quantity;
                                @endphp
                            @endforeach

                            <td>{{ $totalQuantity }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item"data-bs-toggle="modal"
                                            data-bs-target="#modalScrollable"
                                            @click="$dispatch('show-modal-details', { 'title': 'Details Stock', 'action': 'details-stock', 'id': {{ $data->id }}})"><i
                                                class="ti ti-eye me-1"></i> View Details</button>
                                        <button class="dropdown-item"data-bs-toggle="modal"
                                            data-bs-target="#modalScrollable"
                                            @click="$dispatch('show-modal-adjustment', { 'title': 'Adjustment Stock', 'action': 'adjustment', 'id': {{ $data->id }}})"><i
                                                class="ti ti-pencil me-1"></i> Adjustment</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 mt-3">
                <div class="d-flex justify-content-center align-items-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>

    </div>

    @livewire('stock.components.stock.modal-stock')
</div>
