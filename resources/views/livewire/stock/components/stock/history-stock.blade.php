<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Stock /</span> History Stock</h4>
    <div class="card">
        <div class="card-header header-elements">
            <h5 class="card-title mb-0">Data History Stock</h5>
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
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($logStocks as $data)
                        <tr>
                            <td>{{ $data->description }}</td>
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
                    {{ $logStocks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
