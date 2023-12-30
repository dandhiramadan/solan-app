<div>
    {{-- Be like water. --}}
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    @livewire('components.filter', ['title' => 'Permintaan Stock'])
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    @livewire('components.list-task', ['title' => 'Pending Approved', 'prefix' => 'pending-approved', 'orderStatus' => 'Running', 'text' => 'Cari/Ambil Stock', 'state' => 'Pending Approved', 'color' => 'primary', 'targetRoute' => 'formRequestStock.Stock'])
                </div>
                <div class="col-lg-3 col-md-12">
                    @livewire('components.list-task', ['title' => 'Process', 'prefix' => 'process', 'orderStatus' => 'Running', 'text' => 'Cari/Ambil Stock', 'state' => 'Process', 'color' => 'info', 'targetRoute' => 'formRequestStock.Stock'])
                </div>
                <div class="col-lg-3 col-md-12">
                    @livewire('components.list-task', ['title' => 'Waiting STK', 'prefix' => 'waiting-stk', 'orderStatus' => 'Waiting STK', 'text' => 'Cari/Ambil Stock', 'state' => 'Pending Approved', 'color' => 'secondary', 'targetRoute' => 'formRequestStock.Stock'])
                </div>
                <div class="col-lg-3 col-md-12">
                    @livewire('components.list-task', ['title' => 'Reject', 'prefix' => 'reject', 'orderStatus' => 'Running', 'text' => 'Cari/Ambil Stock', 'state' => 'Reject', 'color' => 'danger', 'targetRoute' => 'formRequestStock.Stock'])
                </div>
            </div>
        </div>
    </div>
    @livewire('components.offcanvas')
</div>
