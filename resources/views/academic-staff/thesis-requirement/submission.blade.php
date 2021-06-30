@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Persyaratan Skripsi</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Examples</li>
                        <li class="breadcrumb-item active" aria-current="page">Plugin</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row row-deck">
            <div class="col-sm-7">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Persyaratan Skripsi</h3>
                        <div class="block-options">
                            @if($submission->status === App\Status::WAITING || $submission->status === App\Status::APPLY)
                                <form action="{{ route('thesis-requirement.submit-response', $submission->id) }}"
                                      method="POST" id="submit-response">
                                    @csrf
                                    <button type="button" onclick="submitResponse('REJECT')"
                                            class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i>
                                        <span>Tolak</span>
                                    </button>
                                    <button type="button" onclick="submitResponse('APPROVE')"
                                            class="btn btn-sm btn-success">
                                        <i class="fa fa-check"></i>
                                        <span>Terima</span>
                                    </button>
                                    <x-button-link link="{{ route('thesis-requirements.index') }}" text="Kembali"
                                                   icon="chevron-left" type="outline-primary btn-sm"></x-button-link>
                                </form>
                            @else
                                <x-button-link link="{{ route('thesis-requirements.index') }}" text="Kembali"
                                               icon="chevron-left" type="outline-primary btn-sm"></x-button-link>
                            @endif
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        @if($submission->status === App\Status::APPROVE)
                            <x-alert type="success" icon="fa-check-circle" style="margin-top: 0;"
                                     message="Pengajuan persyaratan skripsi ini sudah <b>DISETUJUI</b> pada tanggal {{ $submission->response_date }}"
                            ></x-alert>
                        @elseif($submission->status === App\Status::REJECT)
                            <x-alert type="danger" icon="fa-times-circle" style="margin-top: 0;"
                                     message="Pengajuan persyaratan skripsi ini <b>DITOLAK</b> pada tanggal {{ $submission->response_date }}"
                            ></x-alert>
                        @endif

                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;">#</th>
                                <th>Nama Dokumen</th>
                                <th class="text-center" style="width: 200px;">Tanggal Upload</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($submission->details as $detail)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ optional($detail->thesis_requirement)->document_name }}</td>
                                    <td>{{ $detail->created_at }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#"
                                               onclick="showDocument(
                                                   '{{ Storage::url($detail->document) }}',
                                                   '{{ File::extension(Storage::url($detail->document)) }}'
                                                   )"
                                               data-toggle="modal" data-target="#modal-detail-document"
                                               class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-sm-5">
                <x-student-info
                    name="{{ $submission->student->getName() }}"
                    nim="{{ $submission->student->nim }}"
                    study-program-name="{{ $submission->student->getName() }}"
                    semester="{{ $submission->student->semester }}"
                    avatar="{{ $submission->student->user->avatar }}"
                ></x-student-info>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('modal')
    <!-- Slide Up Block Modal -->
    <div class="modal fade" id="modal-detail-document" tabindex="-1" role="dialog"
         aria-labelledby="modal-detail-document"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Detail Dokumen</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content text-center align-middle" id="view"></div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Slide Up Block Modal -->
@endsection
