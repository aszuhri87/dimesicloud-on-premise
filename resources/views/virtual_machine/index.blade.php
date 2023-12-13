@extends('layouts.app')

@push('style')
<style>
    .power-btn-action{
        background-color: #0073C029;
        border-radius: 4px;
        width: 26px;
        height: 26px;
    }

    a[disabled] {
        opacity: .4;
        cursor: default !important;
        pointer-events: none;
    }
</style>

@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="flex-grow-1 container-p-y container-fluid">
            <div class="card" style="background: transparent; border-radius: 5px; box-shadow: none;">
                <div class="card-datatable">
                    <table id="init-table" class="table table-sm border"
                        style="font-size: 10pt; border-collapse: separate !important; border-radius: 10px; max-width: 500px important!; width: 500px important!">
                        <thead>
                            <tr>
                                <th style="font-size: 8pt;">NAME</th>
                                <th style="font-size: 8pt;">IP</th>
                                <th style="font-size: 8pt;">NODE</th>
                                <th style="font-size: 8pt;">CPU</th>
                                <th style="font-size: 8pt;">CPU USAGE</th>
                                <th style="font-size: 8pt;">MEMORY USAGE</th>
                                <th style="font-size: 8pt;">MEMORY SIZE</th>
                                <th style="font-size: 8pt;">DISK SIZE</th>
                                <th style="font-size: 8pt;">STATUS</th>
                                <th style="font-size: 8pt; width: 50px;">ACTION</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="content-backdrop fade"></div>
        </div>
    @endsection

    @push('script')
        @include('virtual_machine.script')
        @include('virtual_machine.script-table')
    @endpush
