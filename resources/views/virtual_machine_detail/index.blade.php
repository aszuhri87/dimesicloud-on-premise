@extends('layouts.app')
@push('style')
    <style>
        .vm-detail-profile {
            width: 130px;
            height: 130px;
            flex-shrink: 0;
            border-radius: 6px;
            background-color: #0073C0;
            justify-content: center;
            /* margin: 7px 24px 8px 15px; */
            margin: auto;
            /* margin-bottom: 24px; */
        }

        .c-body-h {
            margin-top: 24px;
            /* padding: 24px; */
        }

        .t-profile {
            padding-left: 6px;
            width: 100%;
        }

        /* .t-val{
                padding-bottom: 12px;
            } */
        .no-ws {
            margin: 0;
            white-space: nowrap;
        }

        .w-90 {
            width: 90%;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h6 class="mb-4"><span class="text-muted fw-light">Virtual Machine /</span> Virtual Machine Details</h6>

            {{-- profile --}}
            <div class="card mb-4">
                <div class="card-header bg-primary" style="height: 100px">
                </div>
                <div class="card-body c-body-h">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-6 vm-detail-profile">

                        </div>
                        <div class="col-md-10 col-lg-10 col-sm-6 mt-sm-5 mt-lg-0">
                            <div class="t-profile">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="flex-grow-1 w-100">
                                        <p class="fw-bolder no-ws">VARX SEC</p>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle btn-primary hide-arrow p-0"
                                            style="width:38px; height:38px;" data-bs-toggle="dropdown">
                                            <span class="tf-icons ti-xs ti ti-power text-center"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">
                                                    <p class="no-ws">
                                                        <span class="tf-icons ti-xs ti ti-player-play"></span> Start
                                                    </p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">
                                                    <p class="no-ws">
                                                        <span class="tf-icons ti-xs ti ti-power"></span> Shutdown
                                                    </p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">
                                                    <p class="no-ws">
                                                        <span class="tf-icons ti-xs ti ti-refresh-dot"></span> Reboot
                                                    </p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">
                                                    <p class="no-ws">
                                                        <span class="tf-icons ti-xs ti ti-recharging"></span> Force Shutdown
                                                    </p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 mt-2">
                                        <p class="no-ws">CPU Usage:</p>
                                        <p>50</p>
                                        <p class="no-ws">Image:</p>
                                        <p class="no-ws">50</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mt-2">
                                        <p class="no-ws">Memory Usage:</p>
                                        <p>50</p>
                                        <p class="no-ws">Kernel:</p>
                                        <p class="no-ws">50</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mt-2">
                                        <p class="no-ws">Disk Size:</p>
                                        <p>50</p>
                                        <p class="no-ws">IPs:</p>
                                        <p class="no-ws">50</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="nav-align-top mb-3">
                <ul class="nav nav-pills mb-2 " role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                            aria-selected="true">
                            <i class="tf-icons ti ti-chart-histogram ti-xs me-1"></i> Graph
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                            aria-selected="false">
                            <i class="tf-icons ti ti-terminal-2 ti-xs me-1"></i> Console
                        </button>
                    </li>
                </ul>
                <div class="mt-3">
                    <div class="fade show active" id="navs-pills-justified-home" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>CPU Usage</h5>
                                        <div class="chart no-ws" id="cpuRadial"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Memory Usage</h5>
                                        <div class="chart" id="memoryRadial"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Disk Size</h5>
                                        <div class="chart" id="diskRadial"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                    </div>
                </div>
            </div>

            <!-- Line Area Chart -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h5 class="card-title mb-0">Network Traffic</h5>
                            <small class="text-muted">Commercial networks</small>
                        </div>
                        <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle p-2 btn-label-secondary mt-4"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-date"> Today </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Today</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Yesterday</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Last 7 Days</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Last 30 Days</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Current Month</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Last Month</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="networkGraph"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h5 class="card-title mb-0">Disk IO</h5>
                            <small class="text-muted">Commercial networks</small>
                        </div>
                        <div class="dropdown">
                            <button type="button" class="btn dropdown-toggle p-2 btn-label-secondary mt-4"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti "></i>
                                <span class="text-date"> Today </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Today</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Yesterday</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Last 7 Days</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Last 30 Days</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Current Month</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item d-flex align-items-center filter-date">Last Month</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="diskGraph"></div>
                    </div>
                </div>
            </div>
            <!-- /Line Area Chart -->



            <div class="content-backdrop fade"></div>
        </div>
    @endsection

    @push('script')
        @include('virtual_machine_detail.script')
        {{-- @include('virtual_machine_detail.script-table') --}}
        @include('virtual_machine_detail.script-chart')
        @include('virtual_machine_detail.script-area')
    @endpush
