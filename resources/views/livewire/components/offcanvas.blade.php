<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div wire:ignore.self class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScroll" aria-labelledby="offcanvasScrollLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasScrollLabel" class="offcanvas-title">Details SPK {{ $spk_number }}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-auto mx-0 flex-grow-0">
            <div class="row">
                <div class="col-md-12">
                    @forelse ($catatan as $data)
                        @if($data['kategori'] == 'catatan')
                        <div class="alert alert-dark alert-dismissible d-flex align-items-baseline" role="alert">
                            <span class="alert-icon alert-icon-lg text-dark me-2">
                                <i class="ti ti-note ti-sm"></i>
                            </span>
                            <div class="d-flex flex-column ps-1">
                                <h6 class="alert-heading mb-2">Catatan <i class="ti ti-arrow-narrow-right ti-sm"></i> {{ $data['tujuan'] }} !!!</h6>
                                <p class="mb-2">
                                    {{ $data['catatan'] }}
                                </p>
                                <small class="text-light fw-medium">{{ $data['user']['name'] }}</small>
                                <small class="text-light fw-medium">{{ $data['created_at'] }}</small>
                            </div>
                        </div>
                        @endif
                    @empty

                    @endforelse

                </div>
            </div>

            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                            aria-selected="true">
                            Details
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                            aria-selected="false">
                            Work Step
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
                            aria-selected="false">
                            Activity
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        @forelse ($document as $data)
                            @if ($data['type_file'] == 'contoh')
                                <div class="card mb-3">
                                    <img class="card-img-top"
                                        src="{{ asset(Storage::url($data['file_path'] . '/' . $data['file_name'])) }}"
                                        alt="File Contoh" />
                                    <div class="card-body">
                                        <p class="card-text">
                                            <a href="{{ asset(Storage::url($data['file_path'] . '/' . $data['file_name'])) }}"
                                                download>{{ $data['file_name'] }}</a>
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @empty
                            File Not Found
                        @endforelse
                        <div class="mb-3">
                            <label for="SPK Number" class="form-label">SPK Number</label>
                            <input class="form-control" type="text" wire:model="spk_number" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Jenis SPK" class="form-label">Jenis SPK</label>
                            <input class="form-control" type="text" wire:model="spk_type" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Pajak" class="form-label">Pajak</label>
                            <input class="form-control" type="text" wire:model="taxes_type" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Purchase Order" class="form-label">Purchase Order</label>
                            <input class="form-control" type="text" wire:model="purchase_order" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Pemesan" class="form-label">Pemesan</label>
                            <input class="form-control" type="text" wire:model="customer_name" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Order" class="form-label">Order</label>
                            <input class="form-control" type="text" wire:model="order_name" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Tanggal PO Masuk" class="form-label">Tanggal PO Masuk</label>
                            <input class="form-control" type="text" wire:model="order_date" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Tanggal Permintaan Kirim" class="form-label">Tanggal Permintaan Kirim</label>
                            <input class="form-control" type="text" wire:model="delivery_date" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Code/Style" class="form-label">Code/Style</label>
                            <input class="form-control" type="text" wire:model="code_style" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Followup" class="form-label">Followup</label>
                            <input class="form-control" type="text" wire:model="followup" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Total Quantity" class="form-label">Total Quantity</label>
                            <input class="form-control" type="text" wire:model="quantity" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Stock" class="form-label">Stock</label>
                            <input class="form-control" type="text" wire:model="quantity_stock" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Panjang Barang" class="form-label">Panjang Barang</label>
                            <input class="form-control" type="text" wire:model="panjang_barang" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Lebar Barang" class="form-label">Lebar Barang</label>
                            <input class="form-control" type="text" wire:model="lebar_barang" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Lebar Barang" class="form-label">Lebar Barang</label>
                            <input class="form-control" type="text" wire:model="lebar_barang" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Parent" class="form-label">Parent</label>
                            <input class="form-control" type="text" wire:model="parent" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="SPK Layout" class="form-label">SPK Layout</label>
                            <input class="form-control" type="text" wire:model="spk_layout" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="SPK Sample" class="form-label">SPK Sample</label>
                            <input class="form-control" type="text" wire:model="spk_sample" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="SPK Stock" class="form-label">SPK Stock</label>
                            <input class="form-control" type="text" wire:model="spk_stock" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Tipe FSC" class="form-label">Tipe FSC</label>
                            <input class="form-control" type="text" wire:model="fsc_type" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="SPK Number FSC" class="form-label">SPK Number FSC</label>
                            <input class="form-control" type="text" wire:model="spk_number_fsc" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="Price" class="form-label">Price</label>
                            <input class="form-control" type="text" wire:model="price" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="PPN" class="form-label">PPN</label>
                            <input class="form-control" type="text" wire:model="ppn" readonly />
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <p>
                            Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                            cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice
                            cream
                            cheesecake fruitcake.
                        </p>
                        <p class="mb-0">
                            Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                            cotton candy liquorice caramels.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <p>
                            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                            cupcake gummi bears cake chocolate.
                        </p>
                        <p class="mb-0">
                            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake.
                            Sweet
                            roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding
                            jelly
                            jelly-o tart brownie jelly.
                        </p>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-label-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                Close
            </button>
        </div>
    </div>
</div>
