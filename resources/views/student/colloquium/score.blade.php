@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Penilaian Hasil Kolokium Skripsi</h2>
        @if(!isset($submission->scores) || count($submission->scores) !== ($countAssessmentComponent * 2))
            <div
                class="alert alert-warning d-flex align-items-center justify-content-between border-3x border-warning"
                role="alert">
                <div class="flex-fill mr-3">
                    <p class="mb-0 font-weight-bold">
                        Komponen Nilai Kolokium Skripsi belum lengkap. Nilai tidak dapat ditampilkan.
                    </p>
                </div>
            </div>
        @else
            <div class="row">

                <div class="col-xl-4">
                    <!-- Dynamic Table with Export Buttons -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                                Kolokium Skripsi :
                                <span class="badge badge-primary text-uppercase font-size-h6">Pembimbing 1</span>
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option"
                                        data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="table-responsive table-responsive-sm">
                                <table class="table table-bordered table-striped table-vcenter table-sm">
                                    <thead>
                                    <tr>
                                        <th width="50" class="text-center">#</th>
                                        <th>Komponen Nilai</th>
                                        <th class="text-center">Nilai</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($totalScoreFirstSupervisor = 0)
                                    @forelse($submission->scores as $score)
                                        @if($score->nidn === $submission->thesis->first_supervisor)
                                            <tr>
                                                <td class="text-center">{{ $index++ }}</td>
                                                <td class="font-weight-bold">{{ $score->components->name }}</td>
                                                <td class="text-center">{{ $score->score }}</td>
                                            </tr>
                                            @php($totalScoreFirstSupervisor += $score->score)
                                        @endif
                                    @empty
                                        <tr>
                                            <td class="text-center font-weight-bold font-italic" colspan="3">
                                                Tidak Ada Nilai.
                                            </td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td class="text-center font-weight-bold font-italic" colspan="2">TOTAL</td>
                                        <td class="text-center font-weight-bold font-italic">{{ $totalScoreFirstSupervisor }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table with Export Buttons -->
                </div>
                <div class="col-xl-4">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                                Kolokium Skripsi :
                                <span class="badge badge-success text-uppercase font-size-h6">Pembimbing 2</span>
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option"
                                        data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="table-responsive table-responsive-sm">
                                <table class="table table-bordered table-striped table-vcenter table-sm">
                                    <thead>
                                    <tr>
                                        <th width="50" class="text-center">#</th>
                                        <th>Komponen Nilai</th>
                                        <th class="text-center">Nilai</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($totalScoreSecondSupervisor = 0)
                                    @php($index = 1)
                                    @forelse($submission->scores as $score)
                                        @if($score->nidn === $submission->thesis->second_supervisor)
                                            <tr>
                                                <td class="text-center">{{ $index++ }}</td>
                                                <td class="font-weight-bold">{{ $score->components->name }}</td>
                                                <td class="text-center">{{ $score->score }}</td>
                                            </tr>
                                            @php($totalScoreSecondSupervisor += $score->score)
                                        @endif
                                    @empty
                                        <tr>
                                            <td class="text-center font-weight-bold font-italic" colspan="3">
                                                Tidak Ada Nilai.
                                            </td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td class="text-center font-weight-bold font-italic" colspan="2">TOTAL</td>
                                        <td class="text-center font-weight-bold font-italic">{{ $totalScoreSecondSupervisor }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                                Nilai Akhir Kolokium Skripsi :
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option"
                                        data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row justify-content-center py-2">
                                <h1 class="font-size-h1 text-uppercase font-weight-bold">
                                    {{ ($totalScoreFirstSupervisor + $totalScoreSecondSupervisor) / 2 }}
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
