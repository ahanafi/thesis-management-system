@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Persyaratan Skripsi
        </h2>
        <div class="row row-deck">
            <div class="col-sm-7">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-file-alt text-muted mr-1"></i>
                            Detail Persyaratan Skripsi
                        </h3>
                        <div class="block-options">
                            @if($submission->status === App\Constants\Status::WAITING || $submission->status === App\Constants\Status::APPLY)
                                <form action="{{ route('thesis-requirement.submit-response', $submission->id) }}"
                                      method="POST" id="submit-response">
                                    @csrf
                                    <button type="button" onclick="submitResponse('REJECT')"
                                            class="btn btn-sm btn-danger">
                                        <i class="fa fa-fw fa-trash"></i>
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
                        @if($submission->status === App\Constants\Status::APPROVE)
                            <x-alert type="success" icon="fa-check-circle" style="margin-top: 0;"
                                     message="Pengajuan persyaratan skripsi ini sudah <b>DISETUJUI</b> pada tanggal {{ $submission->response_date }}"
                            ></x-alert>
                        @elseif($submission->status === App\Constants\Status::REJECT)
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
                                <div class="btn-group btn-group-sm">
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
