@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Penilaian Sidang Skripsi</h2>

        <div class="row">
            <div class="col-xl-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                            Data Nilai Sidang Skripsi
                        </h3>
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
                                @forelse($scores as $score)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $score->components->name }}</td>
                                        <td class="text-center">{{ $score->score }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center font-weight-bold font-italic" colspan="3">
                                            Tidak Ada Nilai.
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
