<div>
    {{-- Stop trying to control. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Products /</span> Management Product</h4>

    @livewire('components.flash-message')

    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">Data Product</h5>
            <div class="card-header-elements ms-auto">
                <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalScrollable"
                    @click="$dispatch('show-modal-create', { 'title': 'Add Product', 'action' : 'create' })">
                    <span class="tf-icon ti ti-plus ti-xs me-1"></span>Add Product
                </button>
            </div>
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
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item"data-bs-toggle="modal"
                                            data-bs-target="#modalScrollable"
                                            @click="$dispatch('show-modal-details', { 'title': 'Details Product', 'action' : 'details', 'id': {{ $data->id }}})"><i
                                                class="ti ti-eye me-1"></i> View</button>
                                        <button class="dropdown-item"data-bs-toggle="modal"
                                            data-bs-target="#modalScrollable"
                                            @click="$dispatch('show-modal-edit', { 'title': 'Edit Product', 'action' : 'edit', 'id': {{ $data->id }}})"><i
                                                class="ti ti-pencil me-1"></i> Edit</button>
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

    @livewire('stock.components.product.modal-product')
</div>
