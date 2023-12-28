@extends('layouts.app')

@push('style')

<style>
    /* td.sshk {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 50px
    }, */
    .td-text{
        width: 600px;
    }
    .truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 600px;
    },
</style>
@endpush

@section('content')
    <div class="flex-grow-1 container-p-y container-fluid">
        <div>
            <div class="nav-align-top mb-4">
                <div class="tab-content"
                    style="background: transparent; border-radius: 5px; box-shadow: none; padding:0; margin:0;">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <div class="card" style="background: transparent; border-radius: 5px; box-shadow: none;">
                            <div class="card-datatable">
                                <table id="init-table" class="table table-sm border"
                                style="font-size: 10pt; border-collapse: separate !important; border-radius: 10px; max-width: 500px important!; width: 500px important!">
                                <thead>
                                        <tr>
                                            <th style="font-size: 8pt; width: 90%;">Name</th>
                                            <th style="font-size: 8pt;">SSH Key</th>
                                            {{-- <th></th> --}}
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('management_access.modal')
@endsection

@push('script')
    @include('management_access.script')
    @include('management_access.script-table')
@endpush
