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
    <script>
        const selectDocumentType = (el) => {
            if (el.value !== '' && el.value !== null) {
                const selectedOption = el.options[el.selectedIndex];
                const documentMimes = selectedOption.getAttribute('data-mimes');
                document.querySelector('input[name=document_mimes]').value = documentMimes;
            }
        }
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Persyaratan Skripsi</h2>
        <div class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
             role="alert">
            <div class="flex-fill mr-3">
                <h3 class="alert-heading font-size-h4 my-2">
                    <i class="fa fa-fw fa-exclamation-circle"></i> Informasi
                </h3>
                <p class="mb-0">
                    Silahkan unggah dokumen persyaratan untuk mengajukan Skripsi terlebih dahulu. <br>
                    <u>Anda dapat mengajukan Skripsi, setelah Anda mengunggah semua dokumen persyaratan Skripsi di bawah
                        ini.</u>
                </p>
            </div>
        </div>
        <div class="row row-deck">
            <div class="col-sm-7">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-upload text-muted mr-1"></i>
                            Unggah Persyaratan Skripsi
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center py-sm-3 py-md-4">
                            <form action="{{ route('student.thesis-requirement.upload') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="thesis_requirement_id">
                                        Jenis Dokumen <span class="text-danger">*</span>
                                    </label>
                                    <select onchange="selectDocumentType(this)" class="custom-select" name="thesis_requirement_id" required>
                                        <option value="">-- Pilih Jenis Dokumen --</option>
                                        @foreach($thesisRequirements as $requirement)
                                            <option
                                                {{ old('thesis_requirement_id') === $requirement->id ? 'selected' : '' }}
                                                value="{{ $requirement->id }}"
                                                data-mimes="{{ strtolower(str_replace(' ', '', documentTypes($requirement->document_type))) }}"
                                            >
                                                {{ $requirement->document_name }}
                                                ({{ documentTypes($requirement->document_type) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="document_mimes" required value="{{ old('document_mimes') }}">

                                    @error('thesis_requirement_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>
                                        File <span class="text-danger">*</span>
                                    </label>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled" onchange="getFileName(this)"
                                               data-toggle="custom-file-input" id="document"
                                               name="document" required>
                                        <label class="custom-file-label" for="document">Pilih file</label>
                                    </div>

                                    @error('document')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-save"></i>
                                        Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <i class="fa fa-fw fa-check-double text-muted mr-1"></i>
                        <h3 class="block-title">Status Unggahan Dokumen</h3>
                    </div>
                    <div class="block-content">
                        <ul class="fa-ul list-icons">
                            @foreach ($thesisRequirements as $requirement)
                                <li>
                                    @if($requirement->status === 1)
                                        <span class="fa-li text-success">
                                            <i class="fa fa-check-circle"></i>
                                        </span>
                                    @else
                                        <span class="fa-li text-danger">
                                            <i class="fa fa-times-circle"></i>
                                        </span>
                                    @endif
                                    <div class="font-w600">{{ $requirement->document_name }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if($submission !== null)
            @if($submission->status === \App\Constants\Status::APPLY)
                <div
                    class="alert alert-warning d-flex align-items-center justify-content-between border-3x border-warning"
                    role="alert">
                    <div class="flex-fill mr-3">
                        <h3 class="alert-heading font-size-h4 my-2">
                            <i class="fa fa-fw fa-exclamation-circle"></i> Informasi Pengajuan
                        </h3>
                        <p class="mb-0 font-weight-bold">
                            Pengajuan persyaratan Skripsi Anda sedang diproses oleh BAAK. Mohon tunggu informasi
                            selanjutnya. Terima kasih.
                        </p>
                    </div>
                </div>
            @elseif($submission->status === \App\Constants\Status::APPROVE)
                <div
                    class="alert alert-success d-flex align-items-center justify-content-between border-3x border-success"
                    role="alert">
                    <div class="flex-fill mr-3">
                        <h3 class="alert-heading font-size-h4 my-2">
                            <i class="fa fa-fw fa-exclamation-circle"></i> Informasi
                        </h3>
                        <p class="mb-0 font-weight-bold">
                            Selamat! dokumen persyaratan Skripsi yang Anda unggah telah diverifikasi oleh BAAK. Saat ini
                            Anda dapat mengajukan porposal Skripsi.
                        </p>
                    </div>
                </div>
        @endif
    @endif

    <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Daftar Dokumen Persyaratan Skripsi</h3>
                <div class="block-options">
                    <button onclick="applyThesisRequirement()"
                            type="button"
                            class="btn btn-sm btn-primary"
                            @if(!$submission || ($submission->status === \App\Constants\Status::APPLY || $submission->status === \App\Constants\Status::APPROVE) || $submission->details->count() < $thesisRequirements->count())
                            disabled
                        @endif
                    >
                        <i class="fa fa-paper-plane"></i>
                        <span>Kirim Pengajuan</span>
                    </button>
                    @if(isset($submission) && $submission->details->count() === $thesisRequirements->count())
                        <form action="{{ route('student.thesis-requirement.apply', $submission->id) }}" id="form-apply"
                              method="POST">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Nama Dokumen</th>
                            <th class="text-center" style="width: 200px;">Tanggal Upload</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($submission !== null)
                            @forelse($submission->details as $detail)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ optional($detail->thesis_requirement)->document_name }}</td>
                                    <td>{{ $detail->created_at }}</td>
                                    <td class="text-center" width="20%">
                                        <a href="#"
                                           onclick="showDocument(
                                               '{{ Storage::url($detail->document) }}',
                                               '{{ File::extension(Storage::url($detail->document)) }}'
                                               )"
                                           data-toggle="modal" data-target="#modal-detail-document"
                                           class="btn btn-sm btn-primary">
                                            <i class="fa fa-search"></i>
                                            <span>Detail</span>
                                        </a>
                                        @if($submission->status === \App\Constants\Status::DRAFT || $submission->status === \App\Constants\Status::REJECT)
                                            <a href="#"
                                               onclick="confirmDelete('student/thesis-requirement', '{{ $detail->id }}')"
                                               class="btn btn-sm btn-danger">
                                                <i class="fa fa-times"></i>
                                                <span>Hapus</span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center font-italic font-weight-bold">Tidak Ada data.
                                    </td>
                                </tr>
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection

@section('modal')
    <!-- Slide Up Block Modal -->
    <div class="modal fade" id="modal-detail-document" tabindex="-1" role="dialog"
         aria-labelledby="modal-detail-document"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-popout" role="document">
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
