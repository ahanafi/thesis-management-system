@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Page JS Helpers (Slick Slider Plugin) -->
    <script>jQuery(function () {
            Dashmix.helpers('summernote');
        });</script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Detail Bimbingan Skripsi
        </h2>
        <div class="row">
            <div class="col-sm-8">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Data Bimbingan Skripsi</h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('lecturer.mentoring.guidance.show', $response->guidance->id) }}" text="Kembali"
                                           icon="chevron-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter">
                            <tr>
                                <td width="180">Judul Bimbingan</td>
                                <td>:</td>
                                <td>{{ $response->guidance->title }}</td>
                            </tr>
                            <tr>
                                <td width="180" class="align-top">Keterangan</td>
                                <td class="align-top">:</td>
                                <td>{!! $response->guidance->note !!}</td>
                            </tr>
                            <tr>
                                <td width="180">Tanggal Kirim</td>
                                <td>:</td>
                                <td>{{ $response->guidance->created_at->format('d-m-Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td width="180">Dokumen</td>
                                <td>:</td>
                                <td>
                                    <a href="#"
                                       onclick="showDocument(
                                           '{{ Storage::url($response->guidance->document) }}',
                                           '{{ File::extension(Storage::url($response->guidance->document)) }}'
                                           )"
                                       data-toggle="modal" data-target="#modal-detail-document"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-search"></i>
                                        <span>Lihat Detail</span>
                                    </a>
                                    <a href="{{ route('lecturer.mentoring.guidance.download', $response->guidance->id) }}"
                                       class="btn btn-sm btn-secondary"
                                       target="_blank" rel="noreferrer">
                                        <i class="fa fa-file-download"></i>
                                        <span>Unduh Dokumen</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Ditujukan kepada</td>
                                <td>:</td>
                                <td>
                                    @if($response->guidance->nidn === $response->guidance->thesis->first_supervisor)
                                        {{ $response->guidance->thesis->firstSupervisor->getNameWithDegree() }}
                                    @else
                                        {{ $response->guidance->thesis->secondSupervisor->getNameWithDegree() }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Status Bimbingan</td>
                                <td>:</td>
                                <td>{!! \App\Constants\GuidanceStatus::showLabel($response->guidance->status) !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-sm-4">
                <x-student-info
                    name="{{ $response->guidance->student->getName() }}"
                    nim="{{ $response->guidance->student->nim }}"
                    study-program-name="{{ $response->guidance->student->getName() }}"
                    semester="{{ $response->guidance->student->semester }}"
                    avatar="{{ $response->guidance->student->user->avatar }}"
                ></x-student-info>
            </div>
            <div class="col-sm-12" id="form-supervisor-response">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Form Tanggapan Pembimbing</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('lecturer.mentoring.guidance.response.update', $response->id) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row push">
                                <div class="col-lg-10 col-xl-10">
                                    <div class="form-group row">
                                        <label for="note" class="col-sm-3 col-form-label text-right">Tanggapan</label>

                                        <div class="col-sm-9">
                                            <textarea name="response" placeholder="Keterangan" required rows="3"
                                                      class="js-summernote">{{ $response->response }}</textarea>

                                            @error('note')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date" class="col-sm-3 col-form-label text-right">
                                            Tanggal
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control " name="date" readonly
                                                   value="{{ $response->created_at->format('Y-m-d') }}" required="required">

                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="avatar" class="col-sm-3 text-right">
                                            Dokumen Laporan
                                        </label>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                                <input type="file" onchange="getFileName(this)"
                                                       class="custom-file-input js-custom-file-input-enabled"
                                                       data-toggle="custom-file-input" id="document"
                                                       name="document">
                                                <label class="custom-file-label" for="document">Pilih dokumen</label>
                                            </div>

                                            @error('document')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save mr-1"></i>
                                                <span>Simpan</span>
                                            </button>
                                            <x-button-link extend-class="float-right" type="secondary"
                                                           link="{{ route('lecturer.mentoring.guidance.show', $response->guidance->id) }}"
                                                           icon="chevron-left"
                                                           text="Kembali"></x-button-link>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- END User Profile -->
                        </form>
                    </div>
                </div>
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
