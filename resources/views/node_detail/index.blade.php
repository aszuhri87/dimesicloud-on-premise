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
            /* margin-top: 5%; */
            bottom: -5px;
            left: 50%;
            translate: -50% 5px;
            white-space: nowrap;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="flex-grow-1 container-p-y container-fluid">
            <h6 class="mb-4"><span class="text-muted fw-light">Virtual Machine /</span> Virtual Machine Details</h6>

            {{-- profile --}}
            <div class="card mb-4">
                <div class="card-header bg-primary" style="height: 100px">
                </div>
                <div class="card-body c-body-h">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-6 vm-detail-profile">
                            <div class="os_logo">
                                <img src="{{ asset('assets/os_logo/unknown.svg')}}" id="img-src" alt="" style="margin-top: 25%; margin-left: 11%">
                            </div>
                        </div>
                        <div class="d-block d-sm-none mt-5"></div>
                        <div class="col-md-10 col-lg-10 col-sm-6">
                            <div class="t-profile">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="flex-grow-1 w-100">
                                        <p class="fw-bolder no-ws" id="vm-name"></p>
                                    </div>
                                    <div class="dropdown d-flex justify-content-end">
                                        <div class="pe-2 no-ws">
                                            <a href="{{env('CONSOLE_URL')}}/?console=shell&xtermjs=1&vmid=0&vmname=&node={{ Request::segment(2) }}&cmd=" title="Console" class="btn btn-primary console p-0" style="width:38px; height:38px;">
                                                <i class="tf-icons ti ti-terminal-2 ti-xs mx-auto"></i>
                                            </a>
                                        </div>
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
                                        <p id="kernel-info">-</p>
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

            <div class="nav-align-top mb-4 mt-4">
                <div class="tab-content"
                    style="background-color: transparent !important; border-color: transparent !important; box-shadow: none !important; margin:0 !important; padding:0 !important;">
                    <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                        <div class="row mb-4">
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div style="position: relative; height: 260px;">
                                            <h5>CPU Usage</h5>
                                            <div class="date-semi-radial">
                                                <p class="w-100 text-center"> {{ date('d/m/Y | H:i') }}</p>
                                                <h4 class="data-label-cpu"></h4>
                                            </div>
                                            <div class="w-100">
                                                <div class="chart no-ws" id="cpuRadial"  data-bs-toggle="tooltip" data-bs-placement="top"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div style="position: relative; height: 260px">
                                            <h5>Memory Usage</h5>
                                            <div class="date-semi-radial">
                                                <p class="w-100 text-center"> {{ date('d/m/Y | H:i') }}</p>
                                                <h4 class="data-label-mem"></h4>
                                            </div>
                                            <div class="text-center w-100">
                                                <div class="chart" id="memoryRadial"  data-bs-toggle="tooltip" data-bs-placement="top"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div style="position: relative; height: 260px">
                                            <h5>Disk Size</h5>
                                            <div class="date-semi-radial text-center">
                                                <p class="w-100 text-center"> {{ date('d/m/Y | H:i') }}</p>
                                                <h4 class="data-label-disk"></h4>
                                            </div>
                                            <div class="text-center w-100">
                                                <div class="chart" id="diskRadial"  data-bs-toggle="tooltip" data-bs-placement="top"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Line Area Chart -->
                        <div class="mb-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title mb-0">Network Traffic</h5>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-2 btn-label-secondary mt-4"
                                            data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="text-date">Hour, AVERAGE</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Hour, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Hour, MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Day, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Day, MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Week, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Week, MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Month, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Month, MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Year, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date">Year, MAX</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="networkGraph"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title mb-0">CPU Usage</h5>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-2 btn-label-secondary mt-4"
                                            data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti "></i>
                                            <span class="text-date-2">Hour, AVERAGE</span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Hour, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Hour, MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Day, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Day, MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Week, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Week, MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Month, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Month, MAX</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Year, AVERAGE</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center filter-date-2">Year, MAX</a>
                                            </li>
                                        </ul>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="cpuGraph"></div>
                                </div>
                            </div>
                        </div>

                        <div class="card p-4" style="border-radius: 5px;">
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Disk Wearout</h5>
                            </div>
                            <div class="card-datatable mt-2">
                                <table id="init-table" class="table table-sm border"
                                    style="font-size: 10pt; border-collapse: separate !important; border-radius: 10px; max-width: 500px important!; width: 500px important!">
                                    <thead>
                                        <tr>
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
                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                    </div>
                </div>
            </div>
            <!-- /Line Area Chart -->
            <div class="content-backdrop fade"></div>
        </div>
    @endsection

    @push('script')
        @include('node_detail.script')
        @include('node_detail.script-table')
    @endpush
