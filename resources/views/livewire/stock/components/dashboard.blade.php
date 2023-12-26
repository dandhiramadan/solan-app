<div>
    {{-- Be like water. --}}
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    @livewire('components.filter')
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    @livewire('stock.components.pending-approved-task')
                </div>
                <div class="col-lg-6 col-md-12">
                    @livewire('stock.components.process-task')
                </div>
            </div>
            {{-- <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="dropdown btn-pinned">
                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical text-muted"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="javascript:void(0);">Logout</a></li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mx-auto my-3">
                                    <img src="/assets/img/avatars/3.png" alt="Avatar Image"
                                        class="rounded-circle w-px-100" />
                                </div>
                                <h4 class="mb-1 card-title">Mark Gilbert</h4>
                                <span class="pb-1">UI Designer</span>
                            </div>
                        </div>

                        <div class="divider">
                            <div class="divider-text">Statistics</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-secondary me-3 p-2">
                                        <i class="ti ti-file ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">189</h5>
                                        <small>Total SPK</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-success me-3 p-2">
                                        <i class="ti ti-file ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">8.549k</h5>
                                        <small>Completed</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-info me-3 p-2">
                                        <i class="ti ti-file ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">8.549k</h5>
                                        <small>In progress</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                        <i class="ti ti-file ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">8.549k</h5>
                                        <small>Out of Schedule</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider">
                            <div class="divider-text">Activity</div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="demo-inline-spacing">
                                    <div class="list-group">
                                        <a href="javascript:void(0);"
                                            class="list-group-item list-group-item-action d-flex justify-content-between">
                                            <div class="li-wrapper d-flex justify-content-start align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-success">M</span>
                                                </div>
                                                <div class="list-content">
                                                    <h6 class="mb-1">List group item heading</h6>
                                                    <small class="text-muted">Donec id elit non mi porta.</small>
                                                </div>
                                            </div>
                                            <small>3 days ago</small>
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="list-group-item list-group-item-action d-flex justify-content-between">
                                            <div class="li-wrapper d-flex justify-content-start align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-danger">B</span>
                                                </div>
                                                <div class="list-content">
                                                    <h6 class="mb-1">List group item heading</h6>
                                                    <small class="text-muted">Donec id elit non mi porta.</small>
                                                </div>
                                            </div>
                                            <small>1 day ago</small>
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="list-group-item list-group-item-action d-flex justify-content-between">
                                            <div class="li-wrapper d-flex justify-content-start align-items-center">
                                                <div class="avatar avatar-sm me-3">
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-primary">V</span>
                                                </div>
                                                <div class="list-content">
                                                    <h6 class="mb-1">List group item heading</h6>
                                                    <small class="text-muted">Donec id elit non mi porta.</small>
                                                </div>
                                            </div>
                                            <small>5 days ago</small>
                                        </a>
                                    </div>

                                    <center>
                                        <button type="button" class="btn btn-outline-primary">Show All</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
