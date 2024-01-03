@extends('layouts.app')

@push('style')
    <style>
        .no-ws {
            margin: 0;
            white-space: nowrap;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="flex-grow-1 container-p-y container-fluid">
            <div class="card" style="background: transparent; border-radius: 5px; box-shadow: none;">
                <div class="card-datatable">
                    <table id="init-table" class="table table-sm border" style="font-size: 10pt; border-collapse: separate !important; border-radius: 10px; max-width: 500px important!; width: 500px important!;">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th style="font-size: 8pt;">Object Storage</th>
                                {{-- <th style="font-size: 8pt;">Size</th>--}}
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

    @include('object_storage.modal')
@endsection

@push('script')
    @include('object_storage.script')
    @include('object_storage.script-table')
@endpush
