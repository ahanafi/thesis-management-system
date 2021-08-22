@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Skripsi</h2>
        @if(is_null($thesis))
            <div class="alert alert-warning d-flex align-items-center justify-content-between border-3x border-warning"
                 role="alert">
                <div class="flex-fill mr-3">
                    <p class="mb-0">
                        <i class="fa fa-fw fa-info-circle"></i>
                        Data skripsi tidak ditemukan. Silahkan lakukan pengajuan proposal Skripsi melalui menu <b>Proposal Skripsi</b> di samping.
                    </p>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-8">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-book-open text-muted mr-1"></i>
                            <span>Data Skripsi</span>
                        </h3>
                    </div>
                    <div class="block-content block-content-full">

                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter">
                            <tr>
                                <td width="180">Judul Skripsi</td>
                                <td width="10">:</td>
                                <td>{{ $thesis->research_title ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td width="180">Bidang Ilmu</td>
                                <td>:</td>
                                <td>{{ $thesis->scienceField->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td width="180">Disetujui pada</td>
                                <td>:</td>
                                <td>{{ $thesis->created_at ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td width="180">Pembimbing 1</td>
                                <td>:</td>
                                <td>
                                    {{ $thesis && $thesis->firstSupervisor ? $thesis->firstSupervisor->getNameWithDegree() : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Pembimbing 2</td>
                                <td>:</td>
                                <td>
                                    {{ $thesis && $thesis->secondSupervisor ? $thesis->secondSupervisor->getNameWithDegree() : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Dokumen Laporan</td>
                                <td>:</td>
                                <td>
                                    @if($thesis && $thesis->document !== null && Storage::exists($thesis->document))
                                        <a target="_blank" rel="noreferrer"
                                           href="{{ route('student.thesis.download', 'report') }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-file-download"></i>
                                            <span>Unduh Laporan</span>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Program Aplikasi</td>
                                <td>:</td>
                                <td>
                                    @if($thesis && $thesis->application !== null)
                                        @if(Storage::exists($thesis->application))
                                            <a target="_blank" rel="noreferrer"
                                               href="{{ route('student.thesis.download', 'app') }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-download"></i>
                                                <span>Unduh Program</span>
                                            </a>
                                        @else
                                            <a target="_blank" rel="noreferrer"
                                               href="{{ $thesis->application }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-download"></i>
                                                <span>Unduh Program</span>
                                            </a>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Jurnal Penelitian</td>
                                <td>:</td>
                                <td>
                                    @if($thesis && $thesis->journal !== null && Storage::exists($thesis->journal))
                                        <a target="_blank" rel="noreferrer"
                                           href="{{ route('student.thesis.download', 'journal') }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-file-download"></i>
                                            <span>Unduh Jurnal</span>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>

                        @if($thesis !== null)
                            <h2 class="content-heading d-flex">
                                Aksi :
                                <div class="ml-3">
                                    <button type="button" onclick="uploadThesisDocument()"
                                            class="btn btn-primary btn-sm">
                                        <i class="fa fa-file-alt"></i>
                                        <span>Unggah Laporan</span>
                                    </button>
                                    <button onclick="uploadApp()" type="button" class="btn btn-primary btn-sm">
                                        <i class="fa fa-tools"></i>
                                        <span>Unggah Program</span>
                                    </button>
                                    <button onclick="uploadJournal()" type="button" class="btn btn-primary btn-sm">
                                        <i class="fa fa-file-pdf"></i>
                                        <span>Unggah Jurnal</span>
                                    </button>
                                </div>
                            </h2>

                            <!-- Start form upload document -->
                            <div class="overflow-hidden">
                                <div id="upload-document"
                                     class="block block-rounded bg-body-dark animated fadeIn {{ $errors->has('document') ? 'd-block' : 'd-none' }}">
                                    <div class="block-header bg-white-25">
                                        <h3 class="block-title">
                                            <i class="fa fa-file-alt"></i> Unggah Laporan
                                        </h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                                    data-action="close">
                                                <i class="si si-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-full">
                                        <form id="form-upload-document"
                                              action="{{ route('student.thesis.update', $thesis->id) }}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row gutters-tiny mb-0 items-push">
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control"
                                                           name="document" placeholder="Laporan" required>
                                                    <input type="hidden" name="type" value="report">

                                                    @error('document')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fa fa-save mr-1"></i>
                                                        <span>Simpan</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End form upload document -->

                            <!-- Start form upload app -->
                            <div class="overflow-hidden">
                                <div id="upload-app"
                                     class="block block-rounded bg-body-dark animated fadeIn {{ $errors->has('app') || $errors->has('url') ? 'd-block' : 'd-none' }}">
                                    <div class="block-header bg-white-25">
                                        <h3 class="block-title">
                                            <i class="fa fa-tools"></i> Unggah Program
                                        </h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                                    data-action="close">
                                                <i class="si si-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-full">
                                        <form id="form-upload-app"
                                              action="{{ route('student.thesis.update', $thesis->id) }}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row gutters-tiny mb-0 items-push">
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" name="url"
                                                           placeholder="Url program"
                                                           autocomplete="off">

                                                    @error('url')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="file" class="form-control" name="app"
                                                           placeholder="Program">

                                                    @error('app')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="hidden" name="type" value="app">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fa fa-save mr-1"></i>
                                                        <span>Simpan</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End form upload app -->

                            <!-- Start form upload journal -->
                            <div class="overflow-hidden">
                                <div id="upload-journal"
                                     class="block block-rounded bg-body-dark animated fadeIn {{ $errors->has('journal') ? 'd-block' : 'd-none' }}">
                                    <div class="block-header bg-white-25">
                                        <h3 class="block-title">
                                            <i class="fa fa-file-pdf"></i> Unggah Jurnal
                                        </h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                                    data-action="close">
                                                <i class="si si-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-full">
                                        <form id="form-upload-journal"
                                              action="{{ route('student.thesis.update', $thesis->id) }}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row gutters-tiny mb-0 items-push">
                                                <div class="col-md-8">
                                                    <input type="file" class="form-control"
                                                           name="journal" placeholder="Jurnal" required>
                                                    <input type="hidden" name="type" value="journal">

                                                    @error('journal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fa fa-save mr-1"></i>
                                                        <span>Simpan</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End form upload journal -->

                            <div
                                class="alert alert-warning d-flex align-items-center justify-content-between border-3x border-warning"
                                role="alert">
                                <div class="flex-fill mr-3">
                                    <p class="mb-0">
                                        <b>Format yang didukung adalah: <i>pdf, doc, docx, zip, rar.</i></b> <br>
                                        Apabila Anda telah mengunggah laporan/program/jurnal sebelumnya, maka dokumen
                                        lama
                                        tersebut akan <b><u>dihapus dan diganti dengan dokumen terbaru</u></b> yang Anda
                                        unggah.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-sm-4">
                <x-student-info
                    name="{{ $user->studentProfile->getName() }}"
                    nim="{{ $user->studentProfile->nim }}"
                    study-program-name="{{ $user->studentProfile->study_program->name }}"
                    semester="{{ $user->studentProfile->semester }}"
                    avatar="{{ $user->studentProfile->user->avatar }}"
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
