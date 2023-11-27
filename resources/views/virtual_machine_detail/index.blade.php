@extends('layouts.app')
@push('style')
    <style>
        .vm-detail-profile{
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
        .c-body-h{
            margin-top: 24px;
            /* padding: 24px; */
        }
        .t-profile{
            padding-left: 6px;
            width: 100%;
        }
        /* .t-val{
            padding-bottom: 12px;
        } */
        .no-ws{
            margin: 0;
            white-space: nowrap;
        }
        .w-90{
            width: 90%;
        }

    </style>
@endpush

@section('content')
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h6 class="py-1 mb-2"><span class="text-muted fw-light">Virtual Machine /</span> Virtual Machine Details</h6>

                {{-- profile --}}
                <div class="card" style="">
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
                                        <div>
			  		                        <span class="badge bg-label-primary">Running</span>
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

                {{-- button card --}}
                <div class="card mt-4 mb-4">
                    <div class="card-widget-separator-wrapper">
                      <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                          <div class="d-grid col-sm-6 col-lg-3 mx-auto">
                            <div
                              class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                              <div class="w-90">
                                <p class="no-ws fw-bolder">
                                    Start
                                </p>
                                <p>
                                    Start Virtual Machine
                                </p>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-primary">
                                        <span class="tf-icons ti-xs ti ti-player-play me-1"></span>Start VM
                                    </button>
                                </div>
                              </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4" />
                          </div>
                          <div class="d-grid col-sm-6 col-lg-3 mx-auto">
                            <div
                              class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                              <div class="w-90">
                                <p class="no-ws fw-bolder">Shutdown</p>
                                <p>Shutdown Virtual Machine</p>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-primary me-2">
                                        <span class="tf-icons ti-xs ti ti-power me-1"></span>Shutdown
                                    </button>
                                </div>
                              </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none" />
                          </div>
                          <div class="d-grid col-sm-6 col-lg-3 mx-auto">
                            <div
                              class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                              <div class="w-90">
                                <p class="no-ws fw-bolder">Reboot</p>
                                <p>Reboot Virtual Machine</p>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-primary me-2">
                                        <span class="tf-icons ti-xs ti ti-refresh-dot me-1"></span>Reboot
                                    </button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="d-grid col-sm-6 col-lg-3 mx-auto">
                            <div class="d-flex justify-content-between align-items-start">
                              <div class="w-100">
                                <p class="no-ws fw-bolder">Force Shutdown</p>
                                <p style="white-space: nowrap">Force Shutdown Virtual Machine</p>
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-primary me-2">
                                        <span class="tf-icons ti-xs ti ti-recharging me-1"></span>Force Shutdown
                                    </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <hr>

                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 " role="tablist">
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link active"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-home"
                          aria-controls="navs-pills-justified-home"
                          aria-selected="true">
                          <i class="tf-icons ti ti-home ti-xs me-1"></i> Graph
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-profile"
                          aria-controls="navs-pills-justified-profile"
                          aria-selected="false">
                          <i class="tf-icons ti ti-user ti-xs me-1"></i> Console
                        </button>
                      </li>
                    </ul>
                    <div class="" style="width: 100%;">
                      <div class="fade show active" id="navs-pills-justified-home" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>CPU Usage</h5>
                                        <div class="chart" id="cpuRadial"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="chart" id="memoryRadial"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="chart" id="diskRadial"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                        <p>
                          Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                          cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                          cheesecake fruitcake.
                        </p>
                        <p class="mb-0">
                          Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                          cotton candy liquorice caramels.
                        </p>
                      </div>
                    </div>
                  </div>


            <div class="content-backdrop fade"></div>
          </div>
@endsection

@push('script')
    @include('virtual_machine_detail.script')
    @include('virtual_machine_detail.script-table')
    @include('virtual_machine_detail.script-chart')

@endpush
