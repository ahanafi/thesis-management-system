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
        <h2 class="content-heading">
            Data Bimbingan Skripsi
        </h2>
        <div class="block block-rounded">
            <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#first-supervisor">Pembimbing 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#second-supervisor">Pembimbing 2</a>
                </li>
                <li class="nav-item ml-auto">
                    <div class="btn-group btn-group-sm pr-2">
                        <button type="button" class="btn btn-primary" onclick="event.preventDefault();window.location='{{ route('student.guidance.create') }}'">
                            <i class="fa fa-fw fa-plus"></i>
                            <span>Bimbingan</span>
                        </button>
                    </div>
                </li>
            </ul>
            <div class="block-content tab-content">
                <div class="tab-pane active" id="first-supervisor" role="tabpanel">
                    <h4 class="font-w400">Data Bimbingan bersama Dosen Pembimbing 1</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Materi</th>
                                <th>Tanggal Kirim</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guidances['first_supervisor'] as $guidance)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $guidance->title }}</td>
                                    <td>{{ $guidance->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>{!! \App\Constants\GuidanceStatus::showLabel($guidance->status) !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('student.guidance.show', $guidance->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                            <span>Detail</span>
                                        </a>
                                        @if($guidance->status === \App\Constants\GuidanceStatus::SENT)
                                            <a href="{{ route('student.guidance.edit', $guidance->id) }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                                <span>Edit</span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="second-supervisor" role="tabpanel">
                    <h4 class="font-w400">Data Bimbingan bersama Dosen Pembimbing 2</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Materi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                             @foreach($guidances['second_supervisor'] as $guidance)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $guidance->title }}</td>
                                    <td>{{ $guidance->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>{!! \App\Constants\GuidanceStatus::showLabel($guidance->status) !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('student.guidance.show', $guidance->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                            <span>Detail</span>
                                        </a>
                                        @if($guidance->status === \App\Constants\GuidanceStatus::SENT)
                                            <a href="{{ route('student.guidance.edit', $guidance->id) }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                                <span>Edit</span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
