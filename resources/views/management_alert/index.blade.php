@extends('layouts.app')

@section('content')
    <div class="flex-grow-1 container-p-y container-fluid">
        <div>
            <div class="nav-align-top mb-4">
                <div class="d-flex justify-content-between">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                aria-selected="true">
                                <i class="tf-icons ti ti-mail ti-xs me-1"></i> Email
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link btn-tele" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                aria-selected="false">
                                <i class="tf-icons ti ti-brand-telegram ti-xs me-1"></i> Telegram
                            </button>
                        </li>
                    </ul>
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                            + Create New
                        </button>
                    </div>
                </div>
                <div class="tab-content"
                    style="background: transparent; border-radius: 5px; box-shadow: none; padding:0; margin:0;">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <div class="card" style="background: transparent; border-radius: 5px; box-shadow: none;">
                            <div class="card-datatable">
                                <table id="email-table" class="table table-sm border"
                                    style="font-size: 10pt; border-collapse: separate !important; border-radius: 10px; max-width: 500px important!; width: 500px important!">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 8pt; width: 90%;">Email</th>
                                            <th style="font-size: 8pt;">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade list-tele" id="navs-pills-top-profile" role="tabpanel">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('management_alert.modal')

@push('script')
    @include('management_alert.script')
    @include('management_alert.script-table')
@endpush
