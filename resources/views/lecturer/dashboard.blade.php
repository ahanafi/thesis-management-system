@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content content-full">
        <div class="row">
            <x-lecturer-widget-tiles
                title="Mahasiswa Bimbingan"
                count="{{ count($guidedStudents) }}"
                icon="fa-users"
                background="{{ asset('media/photos/photo5.jpg') }}"
            >
            </x-lecturer-widget-tiles>

            <x-lecturer-widget-tiles
                title="Pengujian Mahasiswa"
                count="{{ count($studentToBeTests) }}"
                icon="fa-user-friends"
                background="{{ asset('media/photos/photo10.jpg') }}"
            >
            </x-lecturer-widget-tiles>

            <x-lecturer-widget-tiles
                title="Bimbingan Skripsi"
                count="{{ $unResponseGuidanceCount }}"
                icon="fa-book-open"
                background="{{ asset('media/photos/photo17.jpg') }}"
            >
            </x-lecturer-widget-tiles>
        </div>
        <!-- END Weather -->
        <h2 class="content-heading">
            Data Mahasiswa Bimbingan &amp; Pengujian Mahasiswa
        </h2>
        <div class="row row-deck">
            <div class="col-sm-6">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-users text-muted mr-1"></i>
                            Daftar Mahasiswa Bimbingan Skripsi
                        </h3>
                        <div class="block-options">
                            <a href="{{ route('lecturer.mentoring.student.index') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-fw fa-search"></i>
                                <span>Detail</span>
                            </a>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Program Studi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($guidedStudents as $thesis)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $thesis->nim }}</td>
                                        <td>{{ $thesis->student->getName() }}</td>
                                        <td class="text-center">{{ $thesis->student->study_program->getNameWithLevel() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center font-italic" colspan="4">
                                            Tidak ada data.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
            <div class="col-sm-6">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-users text-muted mr-1"></i>
                            Daftar Pengujian Skripsi Mahasiswa
                        </h3>
                        <div class="block-options">
                            <a href="{{ route('lecturer.exam.seminar.index') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-fw fa-search"></i>
                                <span>Detail</span>
                            </a>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Program Studi</th>
                                    <th>Jenis Ujian</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($studentToBeTests as $submission)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $submission->nim }}</td>
                                        <td>{{ $submission->thesis->student->getName() }}</td>
                                        <td class="text-center">{{ $submission->thesis->student->study_program->getNameWithLevel() }}</td>
                                        <td class="text-center">{{ getTypeOfAssessment($submission->assessment_type) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center font-italic" colspan="5">
                                            Tidak ada data.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
