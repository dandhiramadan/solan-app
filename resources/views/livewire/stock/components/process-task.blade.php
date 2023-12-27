<div>
    {{-- Stop trying to control. --}}
    <div class="row">
        <div class="col-lg-12 mb-3 col-md-12">
            <div class="card shadow-none bg-transparent border border-info mb-3">
                <div class="card-body">
                    <div class="card-title header-elements">
                        <h5 class="m-0 me-2">Process</h5>
                        <div class="card-title-elements ms-auto">
                            <span class="badge bg-info rounded-pill">{{ $processCount }}</span>
                        </div>
                    </div>
                    <div class="accordion mt-3">
                        @forelse ($process as $data)
                            <div class="accordion-item card">
                                <li class="d-flex align-items-center accordion-button collapsed"
                                    data-bs-toggle="collapse" data-bs-target="#process-{{ $data->id }}"
                                    aria-expanded="false" role="button">
                                    <div class="badge bg-label-info me-3 rounded p-2">
                                        <i class="ti ti-package ti-sm"></i>
                                    </div>
                                    <div
                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $data->instruction->spk_number }}</h6>
                                            <span class="badge rounded-pill bg-label-info">{{ $data->status }}</span>
                                            <span class="badge rounded-pill bg-label-info">{{ $data->pekerjaan }}</span>
                                        </div>
                                    </div>
                                </li>
                                <div id="process-{{ $data->id }}" class="accordion-collapse collapse">
                                    <ul class="p-2 m-1">
                                        <li class="d-flex justify-content-center align-items-center mb-3">
                                            <a href="form-request-stock/{{ $data->id }}" class="btn btn-outline-primary">
                                                <span class="ti-xs ti ti-clock-play me-1"></span>Mulai Kerjakan
                                            </a>
                                        </li>
                                        <div class="border-bottom border-bottom-dashed"></div>
                                        <li class="d-flex align-items-center mb-3 mt-3">
                                            <div class="badge bg-label-info me-3 rounded p-2">
                                                <i class="ti ti-user ti-sm"></i>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->instruction->customer_name }}</h6>
                                                    <small class="text-muted d-block">Customer</small>
                                                </div>
                                            </div>
                                        </li>
                                        <div class="border-bottom border-bottom-dashed"></div>
                                        <li class="d-flex align-items-center mb-3 mt-3">
                                            <div class="badge bg-label-info me-3 rounded p-2">
                                                <i class="ti ti-tag ti-sm"></i>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->instruction->order_name }}</h6>
                                                    <small class="text-muted d-block">Order</small>
                                                </div>
                                            </div>
                                        </li>
                                        <div class="border-bottom border-bottom-dashed"></div>
                                        <li class="d-flex align-items-center mb-3 mt-3">
                                            <div class="badge bg-label-info me-3 rounded p-2">
                                                <i class="ti ti-file-star ti-sm"></i>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->instruction->purchase_order }}</h6>
                                                    <small class="text-muted d-block">Purchase Order</small>
                                                </div>
                                            </div>
                                        </li>
                                        <div class="border-bottom border-bottom-dashed"></div>
                                        <li class="d-flex align-items-center mb-3 mt-3">
                                            <div class="badge bg-label-info me-3 rounded p-2">
                                                <i class="ti ti-calendar ti-sm"></i>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->instruction->order_date }}</h6>
                                                    <small class="text-muted d-block">Tanggal PO Masuk</small>
                                                </div>
                                            </div>
                                        </li>
                                        <div class="border-bottom border-bottom-dashed"></div>
                                        <li class="d-flex align-items-center mb-3 mt-3">
                                            <div class="badge bg-label-info me-3 rounded p-2">
                                                <i class="ti ti-truck-delivery ti-sm"></i>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->instruction->delivery_date }}</h6>
                                                    <small class="text-muted d-block">Tanggal Permintaan Kirim</small>
                                                </div>
                                            </div>
                                        </li>
                                        <div class="border-bottom border-bottom-dashed"></div>
                                        <li class="d-flex align-items-center mb-3 mt-3">
                                            <div class="badge bg-label-info me-3 rounded p-2">
                                                <i class="ti ti-square-asterisk ti-sm"></i>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->instruction->code_style }}</h6>
                                                    <small class="text-muted d-block">Code Style</small>
                                                </div>
                                            </div>
                                        </li>
                                        <div class="border-bottom border-bottom-dashed"></div>
                                        <li class="d-flex align-items-center mb-3 mt-3">
                                            <div class="badge bg-label-info me-3 rounded p-2">
                                                <i class="ti ti-user-star ti-sm"></i>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->instruction->followup }}</h6>
                                                    <small class="text-muted d-block">Follow Up</small>
                                                </div>
                                            </div>
                                        </li>
                                        <div class="border-bottom border-bottom-dashed"></div>
                                        <li class="d-flex align-items-center mb-3 mt-3">
                                            <div class="badge bg-label-info me-3 rounded p-2">
                                                <i class="ti ti-ruler-measure ti-sm"></i>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->instruction->panjang_barang }} cm x {{ $data->instruction->lebar_barang }} cm</h6>
                                                    <small class="text-muted d-block">Ukuran Barang</small>
                                                </div>
                                            </div>
                                        </li>
                                        <div class="border-bottom border-bottom-dashed"></div>
                                        <li class="d-flex align-items-center mb-3 mt-3">
                                            <div class="badge bg-label-info me-3 rounded p-2">
                                                <i class="ti ti-packages ti-sm"></i>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $data->instruction->quantity }}</h6>
                                                    <small class="text-muted d-block">Quantity</small>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @empty
                        <div class="d-flex justify-content-center align-items-center">
                            Tidak ada SPK
                        </div>
                        @endforelse
                    </div>
                    {{ $process->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
