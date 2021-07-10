@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    {{--<div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Dashboard</h1>
            </div>
        </div>
    </div>--}}
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-full">
        <!-- Thesis Progress -->
        <h2 class="content-heading">
            <i>Progress</i> Skripsi Kamu
        </h2>
        <div class="row row-deck gutters-tiny mb-4" id="student-widget-tiles">
            <x-student-widget-tiles
                background="bg-primary"
                is-done="{{ $isThesisRequirementDone }}"
                link="{{ route('student.thesis-requirement.index') }}"
                text-color="text-primary-lighter"
                icon="fa-file"
                text="Persyaratan Skripsi"
            >
            </x-student-widget-tiles>

            <x-student-widget-tiles
                background="bg-xsmooth"
                is-done="{{ $isThesisSubmissionDone }}"
                link="{{ route('student.thesis-submission.index') }}"
                text-color="text-xsmooth-lighter"
                icon="fa-file-alt"
                text="Proposal Skripsi"
            >
            </x-student-widget-tiles>

            <x-student-widget-tiles
                background="bg-xmodern"
                is-done="{{ $isThereSupervisor }}"
                link="{{ route('student.thesis.index') }}"
                text-color="text-xmodern-lighter"
                icon="fas fa-user-friends"
                text="Dosen Pembimbing"
            >
            </x-student-widget-tiles>

            <x-student-widget-tiles
                background="bg-danger"
                is-done="{{ $isSeminarDone }}"
                link=""
                text-color="text-danger-light"
                icon="fas fa-chalkboard-teacher"
                text="Seminar Skripsi"
            >
            </x-student-widget-tiles>

            <x-student-widget-tiles
                background="bg-gd-fruit"
                is-done="{{ $isColloquiumDone }}"
                link=""
                text-color="text-white-75"
                icon="fas fa-diagnoses"
                text="Kolokium Skripsi"
            >
            </x-student-widget-tiles>

            <x-student-widget-tiles
                background="bg-gd-sublime"
                is-done="{{ $isTrialDone }}"
                link=""
                text-color="text-white-75"
                icon="fas fa-book-reader"
                text="Sidang Skripsi"
            >
            </x-student-widget-tiles>
        </div>
        <!-- END Thesis Progress -->
        <div class="block block-themed bg-image" style="background-image: url({{ asset('/media/photos/photo21.jpg') }});">
            <div class="block-header bg-primary-dark-op">
                <h3 class="block-title">Menu Utama</h3>
            </div>
            <div class="block-content text-center bg-primary-dark-op text-white-75 align-middle py-7">
                <p class="font-weight-bold font-italic font-size-h3">
                    Selamat datang di Menu Utama Sistem Informasi <br>
                    Manajemen Skripsi Universitas Catur Insan Cendekia
                </p>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
