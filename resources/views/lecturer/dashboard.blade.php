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
        <div class="row">
            <x-lecturer-widget-tiles
                title="Mahasiswa Bimbingan"
                count="{{ $guidedStudentCount }}"
                icon="fa-users"
                background="{{ asset('media/photos/photo5.jpg') }}"
                >
            </x-lecturer-widget-tiles>

            <x-lecturer-widget-tiles
                title="Pengujian Mahasiswa"
                count="{{ $studentToBeTestCount }}"
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
        <div class="block block-themed bg-image"
             style="background-image: url({{ asset('/media/photos/photo21.jpg') }});">
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
