@extends('layouts.app')

@push('style')
    <style>
        .no-ws {
            margin: 0;
            white-space: nowrap;
        }
        .btn-delete-all{
            width: 42px;
            border-radius: 6px;
            margin-inline-end: 2px;
        }

        .btn-create-object{
            margin-inline-end: 30px;
        }

        /* .button-gr{
            padding-right: 10px;
        } */
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="flex-grow-1 container-p-y container-fluid">
            <div class="card" style="background: transparent; border-radius: 5px; box-shadow: none;">
                <a href="{{ url('object-storage') }}"
                class="d-flex align-items-left btn-running mb-1">
                <span class="tf-icons ti ti-sm ti-chevron-left"></span>
                    <p class="no-ws">
                        Back
                    </p>
                </a>
                <div class="card-datatable">
                    <table id="init-table" class="table table-sm border" style="font-size: 10pt; border-collapse: separate !important; border-radius: 10px; max-width: 500px important!; width: 500px important!;">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th style="font-size: 8pt;">Object Storage</th>
                                <th style="font-size: 8pt;">Size</th>
                                <th style="font-size: 8pt;">Last Update</th>
                                <th style="font-size: 8pt;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="content-backdrop fade"></div>
        </div>
    </div>

    @include('object_storage_detail.modal')
@endsection

@push('script')
    @include('object_storage_detail.script')
    @include('object_storage_detail.script-table')
@endpush
