@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <h6>Status</h6>
            <div class="row">
                <!-- Cards with few info -->
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Cluster Status</small>
                                <h5 id="health" class="text-success"></h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Managers</small>
                                <h5 id="managers_active" class="mb-0 me-2"></h5>
                                <h5 id="managers_standby" class="mb-0 me-2"></h5>

                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Hosts</small>
                                <h5 class="mb-0 me-2">1.24gb</h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Monitors</small>
                                <h5 id="monitors" class="mb-0 me-2"></h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>OSDs</small>
                                <h5 id="osds" class="mb-0 me-2"></h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                   <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <!-- Cards with few info -->
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Managers</small>
                                <h5 id="managers_active" class="mb-0 me-2"></h5>
                                <h5 id="managers_standby" class="mb-0 me-2"></h5>

                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Object Gateways</small>
                                <h5 class="mb-0 me-2">-</h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Metadata Servers</small>
                                <h5 class="mb-0 me-2">-</h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>iSCSI Gateways</small>
                                <h5 class="mb-0 me-2">-</h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                   <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <h6>Capacity</h6>
            <div class="row">
                <!-- Donut Chart -->
                <div class="col-md-4 col-12 mb-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Raw Capacity</h5>
                                <small class="text-muted">Spending on various categories</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="rawChart"></div>
                        </div>
                    </div>
                </div>
                <!-- Donut Chart -->
                <div class="col-md-4 col-12 mb-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Objects</h5>
                                <small class="text-muted">Spending on various categories</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="objectChart"></div>
                        </div>
                    </div>
                </div>
                <!-- Donut Chart -->
                <div class="col-md-4 col-12 mb-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">PG Status</h5>
                                <small class="text-muted">Spending on various categories</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="pgChart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Cards with few info -->
                <div class="col-lg-6 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Pools</small>
                                <h5 id="pools" class="mb-0 me-2"></h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>PGs per OSD</small>
                                <h5 id="pg_per_osd" class="mb-0 me-2">-</h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <h6>Performance</h6>
            <div class="row">
                <!-- Donut Chart -->
                <div class="col-md-4 col-12 mb-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Client Read/Write</h5>
                                <small class="text-muted">Spending on various categories</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="clientRwChart"></div>
                        </div>
                    </div>
                </div>
                <!-- Donut Chart -->
                <div class="col-md-4 col-12 mb-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="card-title mb-0">Client Throughput</h5>
                                <small class="text-muted">Spending on various categories</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="clientThroughputChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 mb-4">
                    <div class="card h-25">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Object Gateways</small>
                                <h5 class="mb-0 me-2">-</h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6 mb-4">
                    <div class="card h-25">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <small>Object Gateways</small>
                                <h5 class="mb-0 me-2">-</h5>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-cpu ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@push('script')
    @include('ceph.script')
@endpush
