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
                                <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-truck ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">42</h4>
                        </div>
                        <p class="mb-1">Running Nodes</p>
                        <p class="mb-0">
                            <small class="text-muted">from</small>
                            <span class="fw-medium me-1">90</span>

                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-truck ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">42</h4>
                        </div>
                        <p class="mb-1">Stopped Nodes</p>
                        <p class="mb-0">
                            <small class="text-muted">from</small>
                            <span class="fw-medium me-1">90</span>

                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-success"><i class="ti ti-truck ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">42</h4>
                        </div>
                        <p class="mb-1">Running Virtual Machines</p>
                        <p class="mb-0">
                            <small class="text-muted">from</small>
                            <span class="fw-medium me-1">90</span>

                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-truck ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">42</h4>
                        </div>
                        <p class="mb-1">Stopped Virtual Machines</p>
                        <p class="mb-0">
                            <small class="text-muted">from</small>
                            <span class="fw-medium me-1">90</span>

                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">82.5k</h5>
                        <small class="text-muted">Expenses</small>
                    </div>
                    <div class="card-body">
                        <div id="expensesChart"></div>
                        <div class="mt-md-2 text-center mt-lg-3 mt-3">
                            <small class="text-muted mt-3">$21k Expenses more than last month</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">82.5k</h5>
                        <small class="text-muted">Expenses</small>
                    </div>
                    <div class="card-body">
                        <div id="expensesChart"></div>
                        <div class="mt-md-2 text-center mt-lg-3 mt-3">
                            <small class="text-muted mt-3">$21k Expenses more than last month</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">82.5k</h5>
                        <small class="text-muted">Expenses</small>
                    </div>
                    <div class="card-body">
                        <div id="expensesChart"></div>
                        <div class="mt-md-2 text-center mt-lg-3 mt-3">
                            <small class="text-muted mt-3">$21k Expenses more than last month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="mb-0">Support Tracker</h5>
                            <small class="text-muted">Last 7 Days</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="supportTrackerMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                    <h1 class="mb-0">164</h1>
                                    <p class="mb-0">Total Tickets</p>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                        <div class="badge rounded bg-label-primary p-1"><i class="ti ti-ticket ti-sm"></i></div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">New Tickets</h6>
                                            <small class="text-muted">142</small>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                        <div class="badge rounded bg-label-info p-1">
                                            <i class="ti ti-circle-check ti-sm"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Open Tickets</h6>
                                            <small class="text-muted">28</small>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-3 align-items-center pb-1">
                                        <div class="badge rounded bg-label-warning p-1"><i class="ti ti-clock ti-sm"></i></div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">Response Time</h6>
                                            <small class="text-muted">1 Day</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                                <div id="supportTracker"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table class="datatables-projects table border-top">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Leader</th>
                                    <th>Team</th>
                                    <th class="w-px-200">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>


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
@include('dashboard.script')
@include('dashboard.script-table')
<script src="../../assets/js/dashboards-analytics.js"></script>
@endpush
