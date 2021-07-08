@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Proposal Skripsi</h1>
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
        @if(is_null($submissionThesisRequirement) || ($submissionThesisRequirement->details_count < $thesisRequirementCount) || $submissionThesisRequirement->status === App\Status::REJECT)
            <div class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
                 role="alert">
                <div class="flex-fill mr-3">
                    <h3 class="alert-heading font-size-h4 my-2">
                        <i class="fa fa-fw fa-exclamation-circle"></i> Informasi
                    </h3>
                    <p class="mb-0">
                        Maaf! Anda belum bisa melakukan pengajuan proposal Skripsi. <br>
                        Harap lengkapi seluruh dokumen
                        <a href="{{ route('student.thesis-requirement.index') }}"
                           class="alert-link font-italic">
                            <u>persyaratan pengajuan skripsi</u>
                        </a>
                        terlebih dahulu!.
                    </p>
                </div>
            </div>
        @endif
        <div class="row row-deck">
            <div class="col-sm-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-list-alt text-muted mr-1"></i>
                            Daftar Pengajuan Proposal Skripsi
                        </h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('student.thesis-submission.create') }}"
                                           text="Buat Pengajuan"
                                           icon="plus" type="primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;">#</th>
                                <th>Judul Penelitian</th>
                                <th class="d-none d-sm-table-cell">Bidang Ilmu</th>
                                <th class="text-center" style="width: 200px;">Tanggal Pengajuan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($thesisSubmissions as $submission)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $submission->research_title }}</td>
                                    <td>{{ $submission->scienceField->name }}</td>
                                    <td>{{ $submission->created_at }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#"
                                               onclick="showDocument(
                                                   '{{ Storage::url($submission->document) }}',
                                                   '{{ File::extension(Storage::url($submission->document)) }}'
                                                   )"
                                               data-toggle="modal" data-target="#modal-detail-document"
                                               class="btn btn-sm btn-primary">
                                                <i class="fa fa-search"></i>
                                            </a>
                                            @if($submission->status === \App\Status::DRAFT || $submission->status === \App\Status::REJECT)
                                                <a href="#"
                                                   onclick="confirmDelete('student/thesis-requirement', '{{ $submission->id }}')"
                                                   class="btn btn-sm btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center font-italic font-weight-bold">Tidak Ada
                                        data.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-book-open text-muted mr-1"></i>
                            Panduan
                        </h3>
                    </div>
                    <div class="block-content">
                        <ol class="list-simple-mini">
                            <li>Pastikan Anda telah mengunggah persyaratan untuk mengajukan skripsi.</li>
                            <li>Silahkan buat dokumen proposal penelitian Anda.</li>
                            <li>Isikan semua form input yang tersedia disamping.</li>
                            <li>Semua form input <b>wajib</b> diisi.</li>
                            <li>Format dokumen yang didukung adalah <b>Doc, Docx dan Pdf</b>.</li>
                            <li>Setelah Anda menekan tombol <b>Upload</b>, dokumen proposal Anda akan diteruskan
                                kepada masing-masing Program Studi.
                            </li>
                            <li>Tunggu informasi selanjutnya via email setelah Prodi memberikan tanggapan proposal
                                penelitian yang Anda ajukan.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
