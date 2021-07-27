@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script>
        jQuery(function(){
            Dashmix.helpers('flatpickr');
        });
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Jadwal Pengujian Skripsi
        </h2>
        <div class="row">
            <div class="col-xl-8">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-calendar-alt text-muted mr-1"></i>
                            Data Jadwal Ujian Skripsi
                        </h3>
                        <div class="block-options">
                            <a href="{{ route('assessment-schedules.create') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-fw fa-plus"></i>
                                <span>Tambah Data</span>
                            </a>
                        </div>
                    </div>
                    <div class="block-content block-content-full">

                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;">#</th>
                                <th>Nama Mahasiswa</th>
                                <th class="text-center">Program Studi</th>
                                <th class="text-center">Jenis Ujian</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-xl-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                        <i class="fa fa-fw fa-calendar text-muted mr-1"></i>
                            Kalender
                        </h3>

                    </div>
                    <div class="block-content block-content-full">
                        <input type="text" class="js-flatpickr form-control bg-white d-none invisible" id="example-flatpickr-inline" name="example-flatpickr-inline" placeholder="Inline Datepicker" data-inline="true">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
