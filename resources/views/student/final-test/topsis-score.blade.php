@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Penilaian Hasil Seminar Skripsi</h2>
        @if(!isset($score))
            <div
                class="alert alert-warning d-flex align-items-center justify-content-between border-3x border-warning"
                role="alert">
                <div class="flex-fill mr-3">
                    <p class="mb-0 font-weight-bold">
                        Komponen Nilai Seminar Skripsi belum lengkap. Nilai tidak dapat ditampilkan.
                    </p>
                </div>
            </div>
        @else
            <div class="row">

                <div class="col-xl-4">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                                Nilai Sidang Skripsi :
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option"
                                        data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row justify-content-center py-2">
                                <h1 class="font-size-h1 text-uppercase font-weight-bold">
                                    {{ ($score->trial) }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- END Page Content -->
@endsection
