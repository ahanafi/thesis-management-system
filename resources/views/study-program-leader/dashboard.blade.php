@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Simple -->
        <div class="row row-deck">
            <x-leader-widget-tiles
                background="bg-gd-xdream"
                link=""
                icon="fa-users"
                text-color="text-white"
                data-count="{{ $lecturerCount }}"
                data-name="Dosen Homebase {{ $lecturer->study_program->getName() }}"
            >
            </x-leader-widget-tiles>

            <x-leader-widget-tiles
                background="bg-gd-default"
                link=""
                icon="fa-file-alt"
                text-color="text-white"
                data-count="{{ $thesisSubmissionCount }}"
                data-name="Proposal Skripsi"
            >
            </x-leader-widget-tiles>


            <x-leader-widget-tiles
                background="bg-gd-sublime"
                link=""
                icon="fa-users"
                text-color="text-white"
                data-count="{{ $studentCount }}"
                data-name="Mahasiswa Prodi {{ $lecturer->study_program->getName() }}"
            >
            </x-leader-widget-tiles>

            <x-leader-widget-tiles
                background="bg-gd-sun-op"
                link=""
                icon="fa-book-open"
                text-color="text-white"
                data-count="{{ $thesisCount }}"
                data-name="Data Skripsi"
            >
            </x-leader-widget-tiles>
        </div>
        <!-- END Simple -->
        <div class="block block-themed bg-image" style="background-image: url({{ asset('/media/photos/photo21.jpg') }});">
            <div class="block-header bg-primary-dark-op">
                <h3 class="block-title">Menu Utama</h3>
            </div>
            <div class="block-content text-center bg-primary-dark-op text-white-75 align-middle py-7" style="height: 50vh">
                <p class="font-weight-bold font-italic font-size-h3">
                    Selamat datang di Menu Utama Sistem Informasi <br>
                    Manajemen Skripsi Universitas Catur Insan Cendekia
                </p>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
