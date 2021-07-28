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
        <h2 class="content-heading">Pengajuan Sidang Skripsi</h2>
        <div class="row row-deck">
            <div class="col-sm-7">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-paper-plane text-muted mr-1"></i>
                            Form Pengajuan Sidang Skripsi
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center px-lg-7 px-sm-0 py-sm-3 py-md-4">
                            <form action="{{ route('student.assessment.final-test.apply') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="document">Kartu Bimbingan Dosen Pembimbing 1 (PDF)</label>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                               data-toggle="custom-file-input" name="guidance_card_first_supervisor" required
                                               id="guidance_card_first_supervisor" accept="application/pdf">
                                        <label class="custom-file-label" for="guidance_card_first_supervisor">Pilih file</label>

                                        @error('guidance_card_first_supervisor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="document">Kartu Bimbingan Dosen Pembimbing 2 (PDF)</label>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                               data-toggle="custom-file-input" name="guidance_card_second_supervisor" required
                                               id="guidance_card_second_supervisor" accept="application/pdf">
                                        <label class="custom-file-label" for="guidance_card_second_supervisor">Pilih file</label>

                                        @error('guidance_card_second_supervisor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="document">Laporan Skripsi (BAB I s.d. Selesai)</label>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                               data-toggle="custom-file-input" name="report" required>
                                        <label class="custom-file-label" for="report">Pilih file</label>

                                        @error('report')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date">Tanggal Pengajuan</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" readonly>
                                </div>

                                <div class="form-group d-flex justify-content-between">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-save"></i>
                                        <span>Kirim Pengajuan</span>
                                    </button>
                                    <a href="{{ route('student.assessment.final-test.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-chevron-left"></i>
                                        <span>Kembali</span>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <i class="fa fa-fw fa-info-circle text-muted mr-1"></i>
                        <h3 class="block-title">Panduan</h3>
                    </div>
                    <div class="block-content">
                        <ol>
                            <li>Silahkan unduh kartu bimbingan di halaman <a
                                    href="{{ route('student.guidance.index') }}"><b>Bimbingan Skripsi</b></a>.
                            </li>
                            <li>Pastikan Anda telah <b>menyelesaikan Laporan Skripsi Anda dari BAB I s.d. Selesai</b>
                            </li>
                            <li>Unggah Kartu Bimbingan dengan ekstensi <b>.pdf</b> pada form di samping.</li>
                            <li>Unggah Laporan Skripsi Anda dengan salah satu ekstensi berikut:
                                <b>pdf,doc/docx,zip/rar.</b></li>
                            <li>Pengajuan Sidang Anda akan ditinjau oleh Pembimbing terkait, mohon agar sabar menunggu
                                Pembimbing selesai meninjau pengajuan Sidang Skripsi Anda.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
