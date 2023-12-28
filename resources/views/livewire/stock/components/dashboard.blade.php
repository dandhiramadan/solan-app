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
                    @livewire('stock.components.pending-approved-task')
                </div>
                <div class="col-lg-3 col-md-12">
                    @livewire('stock.components.process-task')
                </div>
                <div class="col-lg-3 col-md-12">
                    @livewire('stock.components.waiting-stk-task')
                </div>
                <div class="col-lg-3 col-md-12">
                    @livewire('stock.components.reject-task')
                </div>
            </div>
        </div>
        @livewire('components.offcanvas')
    </div>
</div>

