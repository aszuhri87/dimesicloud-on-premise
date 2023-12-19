@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-server-2 ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0" id="running-node-count">0</h4>
                        </div>
                        <p class="mb-1">Running Nodes</p>
                        <p class="mb-0">
                            <small class="text-muted">from</small>
                            <span class="fw-medium me-1 total-node-count">0</span>

                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-server-2 ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0" id="stopped-node-count">0</h4>
                        </div>
                        <p class="mb-1">Stopped Nodes</p>
                        <p class="mb-0">
                            <small class="text-muted">from</small>
                            <span class="fw-medium me-1 total-node-count">0</span>

                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-success"><i class="ti ti-device-imac ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0" id="running-vm-count">0</h4>
                        </div>
                        <p class="mb-1">Running Virtual Machines</p>
                        <p class="mb-0">
                            <small class="text-muted">from</small>
                            <span class="fw-medium me-1 total-vm-count">0</span>

                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-device-imac ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0" id="stopped-vm-count">0</h4>
                        </div>
                        <p class="mb-1">Stopped Virtual Machines</p>
                        <p class="mb-0">
                            <small class="text-muted">from</small>
                            <span class="fw-medium me-1 total-vm-count">0</span>

                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">CPU Usage</h5>
                    </div>
                    <div class="card-body">
                        <div id="cpuUsageChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">RAM Usage</h5>
                    </div>
                    <div class="card-body">
                        <div id="ramUsageChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Disk Usage</h5>
                    </div>
                    <div class="card-body">
                        <div id="diskUsageChart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="card h-100">
                    <h5 class="card-header">Top VM CPU Usage</h5>
                    <div class="card-body">
                        <p class="card-text">
                            VM used more than 80% resource.
                        </p>
                        <div class="card-datatable table-responsive">
                            <table id="top-vm-cpu-table" class="table border-top">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Node</th>
                                        <th>CPU USAGE</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="card h-100">
                    <h5 class="card-header">TOP VM Memory Usage</h5>
                    <div class="card-body">
                        <p class="card-text">
                            VM used more than 80% resource.
                        </p>
                        <div class="card-datatable table-responsive">
                            <table id="top-vm-memory-table" class="table border-top">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Node</th>
                                        <th>MEMORY USAGE</th>
                                        <th>MEMORY SIZE</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card p-4" style="border-radius: 5px;">
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Top Disk Wearout</h5>
                        <small class="text-muted mb-4">Disk wearout more than 80%.</small>
                    </div>
                    <div class="card-datatable mt-2">
                        <table id="top-disk-wearout-table" class="table table-sm border" style="font-size: 10pt; border-collapse: separate !important; border-radius: 10px; max-width: 500px important!; width: 500px important!">
                            <thead>
                                <tr>
                                    <th style="font-size: 8pt;">NODE</th>
                                    <th style="font-size: 8pt;">DEVICE</th>
                                    <th style="font-size: 8pt;">USAGE</th>
                                    <th style="font-size: 8pt;">MODEL</th>
                                    <th style="font-size: 8pt;">SERIAL</th>
                                    <th style="font-size: 8pt;">SIZE</th>
                                    <th style="font-size: 8pt;">WEAROUT</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@include('dashboard.script')
@endpush
