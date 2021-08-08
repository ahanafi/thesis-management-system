@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Proposal Skripsi</h2>
        @if(is_null($submissionThesisRequirement) || ($submissionThesisRequirement->details_count < $thesisRequirementCount) || $submissionThesisRequirement->status === \App\Constants\Status::REJECT)
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
                                <th class="text-center">Status</th>
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
                                        {!! \App\Constants\Status::getLabel($submission->status) !!}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('student.thesis-submission.show', $submission->id) }}"
                                           class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                        </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center font-italic font-weight-bold">Tidak Ada
                                        data.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
