@extends('layouts.app')

@push('style')
<style>
    .power-btn-action{
        background-color: #0073C029;
        border-radius: 4px;
        width: 26px;
        height: 26px;
    }
</style>

@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card" style="background: transparent; border-radius: 5px; box-shadow: none;">
                <div class="card-datatable">
                    <table id="init-table" class="table table-sm border"
                        style="font-size: 10pt; border-collapse: separate !important; border-radius: 10px; max-width: 500px important!; width: 500px important!">
                        <thead>
                            <tr>
                                <th style="font-size: 8pt;">NAME</th>
                                <th style="font-size: 8pt;">IP</th>
                                {{-- <th style="font-size: 8pt;">VMID</th> --}}
                                <th style="font-size: 8pt;">NODE</th>
                                <th style="font-size: 8pt;">DISK SIZE</th>
                                <th style="font-size: 8pt;">MEMORY USAGE</th>
                                <th style="font-size: 8pt;">MEMORY SIZE</th>
                                <th style="font-size: 8pt;">CPU USAGE</th>
                                <th style="font-size: 8pt;">CPU</th>
                                {{-- <th style="font-size: 8pt;">UPTIME</th> --}}
                                <th style="font-size: 8pt;">STATUS</th>
                                <th style="font-size: 8pt;">ACTION</th>
                            </tr>
                        </thead>
                        {{-- <tbody>

                          </tbody> --}}
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
