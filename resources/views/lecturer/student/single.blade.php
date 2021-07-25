@extends('layouts.backend')

@section('content')

    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Skripsi &amp; Profil Mahasiswa</h2>
        <div class="row row-deck">
            <div class="col-sm-8">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-book-open"></i>
                            Data Skripsi
                        </h3>
                        <div class="block-options">
                            <x-button-link link="{{ route('lecturer.mentoring.student.index') }}" text="Kembali"
                                           icon="chevron-left" type="outline-primary btn-sm"></x-button-link>
                        </div>
                    </div>
                    <div class="block-content block-content-full">

                        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter">
                            <tr>
                                <td width="180">Judul Skripsi</td>
                                <td>:</td>
                                <td>{{ $student->thesis->research_title }}</td>
                            </tr>
                            <tr>
                                <td width="180">Bidang Ilmu</td>
                                <td>:</td>
                                <td>{{ $student->thesis->scienceField->name }}</td>
                            </tr>
                            <tr>
                                <td width="180">Disetujui pada</td>
                                <td>:</td>
                                <td>{{ $student->thesis->created_at }}</td>
                            </tr>
                            <tr>
                                <td width="180">Pembimbing 1</td>
                                <td>:</td>
                                <td>
                                    {{ $student->thesis->firstSupervisor ? $student->thesis->firstSupervisor->getNameWithDegree() : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td width="180">Pembimbing 2</td>
                                <td>:</td>
                                <td>
                                    {{ $student->thesis->secondSupervisor ? $student->thesis->secondSupervisor->getNameWithDegree() : '-' }}
                                </td>
                            </tr>
                        </table>
                        <br>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-sm-4">
                <x-student-info
                    name="{{ $student->getName() }}"
                    nim="{{ $student->nim }}"
                    study-program-name="{{ $student->getName() }}"
                    semester="{{ $student->semester }}"
                    avatar="{{ $student->user->avatar }}"
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
