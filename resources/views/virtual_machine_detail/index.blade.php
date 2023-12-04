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

        .no-ws {
            margin: 0;
            white-space: nowrap;
        }

        .w-90 {
            width: 90%;
        }

        .date-semi-radial {
            position: absolute;
            bottom: 17%;
            left: 50%;
            translate: -50%;
            white-space: nowrap;
        }

        ,
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
                        <div class="d-block d-sm-none mt-5"></div>
                        <div class="col-md-10 col-lg-10 col-sm-6">
                            <div class="t-profile">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="flex-grow-1 w-100">
                                        <p class="fw-bolder no-ws" id="vm-name"></p>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle btn-primary hide-arrow p-0"
                                            style="width:38px; height:38px;" data-bs-toggle="dropdown">
                                            <span class="tf-icons ti-xs ti ti-power text-center"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="{{ url('/power') }}/{{ Request::segment(2) }}/{{ Request::segment(3) }}/start"
                                                    class="dropdown-item d-flex align-items-center btn-start">
                                                    <p class="no-ws">
                                                        <span class="tf-icons ti-xs ti ti-player-play"></span> Start
                                                    </p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/power') }}/{{ Request::segment(2) }}/{{ Request::segment(3) }}/shutdown"
                                                    class="dropdown-item d-flex align-items-center btn-shutdown">
                                                    <p class="no-ws">
                                                        <span class="tf-icons ti-xs ti ti-power"></span> Shutdown
                                                    </p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/power') }}/{{ Request::segment(2) }}/{{ Request::segment(3) }}/reboot"
                                                    class="dropdown-item d-flex align-items-center btn-restart">
                                                    <p class="no-ws">
                                                        <span class="tf-icons ti-xs ti ti-refresh-dot"></span> Reboot
                                                    </p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/power') }}/{{ Request::segment(2) }}/{{ Request::segment(3) }}/force-shutdown"
                                                    class="dropdown-item d-flex align-items-center btn-shutdown">
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
                                        <p id="cpu-info">-</p>
                                        <p class="no-ws">Image:</p>
                                        <p id="image-info" class="no-ws">-</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mt-2">
                                        <p class="no-ws">Memory Usage:</p>
                                        <p id="mem-info">-</p>
                                        <p class="no-ws">Kernel:</p>
                                        <p id="kernel-info" class="no-ws">-</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mt-2">
                                        <p class="no-ws">Disk Size:</p>
                                        <p id="disk-info">-</p>
                                        <p class="no-ws">IPs:</p>
                                        <p id="ip-info" class="no-ws">-</p>
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
                        <div class="row mb-4">
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>CPU Usage</h5>
                                        <p class="date-semi-radial w-100 text-center"> {{ date('d/m/Y | H:i') }}</p>
                                        <div class="w-100">
                                            <div class="chart no-ws" id="cpuRadial"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Memory Usage</h5>
                                        <p class="date-semi-radial w-100 text-center"> {{ date('d/m/Y | H:i') }}</p>
                                        <div class="text-center w-100">
                                            <div class="chart" id="memoryRadial"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Disk Size</h5>
                                        <p class="date-semi-radial w-100 text-center"> {{ date('d/m/Y | H:i') }}</p>
                                        <div class="text-center w-100">
                                            <div class="chart" id="diskRadial"></div>
                                        </div>
                                    </div>
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
                                    </div>false
                                    <div class="dropdown">
                                        <button type="button" class="btn p-2 btn-label-secondary mt-4"
                                            data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="text-date">Hour, AVERAGE</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Hour,
                                                    AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Hour,
                                                    MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Day,
                                                    AVERAGE
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Day, MAX
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Week,
                                                    AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Week,
                                                    MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Month,
                                                    AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Month,
                                                    MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Year,
                                                    AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Year,
                                                    MAX</a>
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
                                        <button type="button" class="btn p-2 btn-label-secondary mt-4"
                                            data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti "></i>
                                            <span class="text-date2">Hour, AVERAGE</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Hour,
                                                    AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Hour,
                                                    MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Day,
                                                    AVERAGE
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Day, MAX
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Week,
                                                    AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Week,
                                                    MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Month,
                                                    AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Month,
                                                    MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Year,
                                                    AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Year,
                                                    MAX</a>
                                            </li>
                                        </ul>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="diskGraph"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                    </div>
                </div>
            </div>


            <!-- /Line Area Chart -->
            <div class="content-backdrop fade"></div>
        </div>
    @endsection

    @push('script')
        @include('virtual_machine_detail.script')
    @endpush
