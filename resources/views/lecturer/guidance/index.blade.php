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
                <h3 class="block-title">Daftar Data Bimbingan Skripsi</h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Materi</th>
                        <th class="text-center">Tanggal Kirim</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Nama Mahasiswa</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($guidance as $guidance)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $guidance->title }}</td>
                            <td>{{ $guidance->created_at->format('d-m-Y H:i:s') }}</td>
                            <td class="text-center">{!! \App\Constants\GuidanceStatus::showLabel($guidance->status) !!}</td>
                            <td>
                                <a href="{{ route('lecturer.mentoring.student.show', $guidance->student->id) }}">{{ $guidance->student->getName() }}</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('lecturer.mentoring.guidance.show', $guidance->id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                    <span>Detail</span>
                                </a>
                                <a target="_blank" rel="noreferrer" href="{{ route('lecturer.mentoring.guidance.export-card', $guidance->student->id) }}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-fw fa-print"></i>
                                    <span>Cetak Kartu</span>
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
