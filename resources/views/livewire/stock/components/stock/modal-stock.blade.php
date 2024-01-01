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
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <x-forms.text wire:model.defer="name" :placeholder="'Nama Product'" readonly></x-forms.text>
                        </div>
                        <div class="col-md-6 mb-2">
                            <x-forms.text wire:model.defer="customerSelected" :placeholder="'Pemesan'" readonly></x-forms.text>
                        </div>

                        <div class="col-md-6 mb-2">
                            <x-forms.number wire:model.defer="panjang" :placeholder="'Panjang Barang'" readonly></x-forms.number>
                        </div>
                        <div class="col-md-6 mb-2">
                            <x-forms.number wire:model.defer="lebar" :placeholder="'Lebar Barang'" readonly></x-forms.number>
                        </div>
                        <div class="col-md-12">
                            <x-forms.textarea wire:model.defer="catatan" :placeholder="'Catatan'" readonly></x-forms.textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h6 class="card-title mb-3">List Stock</h6>
                            <div class="card mb-4">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kondisi</th>
                                                <th>Quantity</th>
                                                <th>Recipient</th>
                                                <th>Sender</th>
                                                <th>Rack</th>
                                                <th>Row</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @php
                                                $totalQuantity = 0;
                                            @endphp

                                            @forelse ($dataStock as $data)
                                                <tr>
                                                    <td>{{ $data['description'] }}</td>
                                                    <td>{{ $data['quantity'] }}</td>
                                                    <td>{{ $data['receiver'] }}</td>
                                                    <td>{{ $data['giver'] }}</td>
                                                    <td>{{ $data['rack'] }}</td>
                                                    <td>{{ $data['row'] }}</td>
                                                </tr>

                                                @php
                                                    $totalQuantity += $data['quantity'];
                                                @endphp

                                            @empty
                                                <tr>
                                                    <td colspan="6">-</td>
                                                </tr>
                                            @endforelse
                                            <tr>
                                                <td colspan="5">Total Quantity</td>
                                                <td colspan="1">{{ $totalQuantity }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
