@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
   <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Mahasiswa</h2>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Daftar Mahasiswa Bimbingan Skripsi</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">
                            <i class="fa fa-user"></i>
                        </th>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th class="d-none d-sm-table-cell">Judul Skripsi</th>
                        <th class="d-none d-sm-table-cell">Dosen Pembimbing</th>
                        <th class="d-none d-sm-table-cell text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($theses as $thesis)
                        <tr>
                            <td class="text-center">
                                <img
                                    class="img-avatar img-avatar48"
                                    src="{{
                                        Storage::exists($thesis->student->user->avatar)
                                        ? Storage::url($thesis->student->user->avatar)
                                        : asset('media/avatars/avatar7.jpg')
                                    }}"
                                    alt="User picture">
                            </td>
                            <td class="font-w600">{{ $thesis->nim }}</td>
                            <td>{{ $thesis->student->getName() }}</td>
                            <td class="d-none d-sm-table-cell" style="width: 40%;">{{ $thesis->research_title }}</td>
                            <td class="d-none d-sm-table-cell">
                                - {{ $thesis->first_supervisor !== null ? $thesis->firstSupervisor->getNameWithDegree() : '-' }} <br>
                                - {{ $thesis->second_supervisor !== null ? $thesis->secondSupervisor->getNameWithDegree() : '-' }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('leader.thesis.show', $thesis->id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                    <span>Detail</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
