@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Sales last year -->
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body pb-0">
                            <div class="card-icon">
                                <span class="badge bg-label-primary rounded-pill p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">92.6k</h5>
                            <small>Subscribers Gained</small>
                        </div>
                        <div id="sas"></div>
                    </div>
                </div>

                <!-- Quarterly Sales -->
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body pb-0">
                            <div class="card-icon">
                                <span class="badge bg-label-danger rounded-pill p-2">
                                    <i class="ti ti-shopping-cart ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">36.5%</h5>
                            <small>Quarterly Sales</small>
                        </div>
                        <div id="quarterlySales"></div>
                    </div>
                </div>

                <!-- Order Received -->
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body pb-0">
                            <div class="card-icon">
                                <span class="badge bg-label-warning rounded-pill p-2">
                                    <i class="ti ti-package ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">97.5k</h5>
                            <small>Order Received</small>
                        </div>
                        <div id="orderReceived"></div>
                    </div>
                </div>

                <!-- Revenue Generated -->
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body pb-0">
                            <div class="card-icon">
                                <span class="badge bg-label-success rounded-pill p-2">
                                    <i class="ti ti-credit-card ti-sm"></i>
                                </span>
                            </div>
                            <h5 class="card-title mb-0 mt-2">97.5k</h5>
                            <small>Revenue Generated</small>
                        </div>
                        <div id="revenueGenerated"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Expenses -->
                <div class="col-xl-2 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">82.5k</h5>
                            <small class="text-muted">Expenses 1</small>
                        </div>
                        <div class="card-body">
                            <div id="expensesChart"></div>
                            <div class="mt-3 text-center">
                                <small class="text-muted mt-3">$21k Expenses more than last month</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expenses -->
                <div class="col-xl-2 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">82.5k</h5>
                            <small class="text-muted">Expenses 2</small>
                        </div>
                        <div class="card-body">
                            <div id="expensesChart2"></div>
                            <div class="mt-3 text-center">
                                <small class="text-muted mt-3">$21k Expenses more than last month</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Expenses -->
                <div class="col-xl-2 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">82.5k</h5>
                            <small class="text-muted">Expenses 3</small>
                        </div>
                        <div class="card-body">
                            <div id="expensesChart3"></div>
                            <div class="mt-3 text-center">
                                <small class="text-muted mt-3">$21k Expenses more than last month</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders last week -->
                <div class="col-xl-2 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-3">
                            <h5 class="card-title mb-0">Order</h5>
                            <small class="text-muted">Last week</small>
                        </div>
                        <div class="card-body">
                            <div id="ordersLastWeek"></div>
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <h4 class="mb-0">124k</h4>
                                <small class="text-success">+12.6%</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales last year -->
                <div class="col-xl-2 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">Sales</h5>
                            <small class="text-muted">Last Year</small>
                        </div>
                        <div id="salesLastYear"></div>
                        <div class="card-body pt-0">
                            <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                <h4 class="mb-0">175k</h4>
                                <small class="text-danger">-16.2%</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profit last month -->
                <div class="col-xl-2 col-md-4 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">Profit</h5>
                            <small class="text-muted">Last Month</small>
                        </div>
                        <div class="card-body">
                            <div id="profitLastMonth"></div>
                            <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                <h4 class="mb-0">624k</h4>
                                <small class="text-success">+8.24%</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    @include('object_storage.script')
    {{-- @include('dashboard.script-table') --}}
@endpush
