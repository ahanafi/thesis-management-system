@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Penentuan Dosen Pembimbing Skripsi
        </h2>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Detail Skripsi</h3>
            </div>
            <div class="block-content row">
                <div class="col-md-2 col-xl-2">
                    <img
                        class="img-fluid rounded mb-sm-3"
                        src="{{
                                Storage::exists($thesis->student->user->avatar)
                                ? Storage::url($thesis->student->user->avatar)
                                : asset('media/avatars/avatar7.jpg')
                            }}"
                        alt="User picture">
                </div>
                <div class="col-md-10 col-xl-10">
                    <table class="table table-bordered table-sm table-striped">
                        <tr>
                            <td style="width: 15%">NIM</td>
                            <td>{{ $thesis->student->nim }}</td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>{{ $thesis->student->getName() }}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>
                                {{ $thesis->student->study_program->getName() }} - {{ $thesis->student->semester }}
                            </td>
                        </tr>
                        <tr>
                            <td>Judul Skripsi</td>
                            <td>{{ $thesis->research_title }}</td>
                        </tr>
                        <tr>
                            <td>Bidang Ilmu</td>
                            <td>{{ $thesis->scienceField->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="block block-rounded">
            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-step-1">Step 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-step-2">Step 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-step-3">Step 3</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-step-4">Step 4</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-step-5">Step 5</a>
                </li>
            </ul>
            <div class="block-content tab-content">
                <!-- Step 1 -->
                <div class="tab-pane active" id="btabs-step-1" role="tabpanel">
                    <div
                        class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
                        role="alert">
                        <div class="flex-fill mr-3">
                            <h5 class="alert-heading font-size-h5 my-2">
                                Step 1 : Menampilkan seluruh data Dosen dan jumlah riwayat Dosen sebagai Pembimbing 1
                                dan Pembimbing 2.
                            </h5>
                            <p class="mb-0">
                                <b>Keterangan:</b> <br>
                                <b>JRP</b> : Jumlah Riwayat sebagai Dosen Pembimbing 1 <br>
                                <b>JRP</b> : Jumlah Riwayat sebagai Dosen Pembimbing 2
                            </p>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-vcenter table-sm">
                        <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Lengkap</th>
                            <th class="d-none d-sm-table-cell font-italic">Homebase</th>
                            <th class="d-none d-sm-table-cell">JRP 1</th>
                            <th class="d-none d-sm-table-cell">JRP 2</th>
                            <th class="d-none d-sm-table-cell">Jab. Fungsional</th>
                            <th class="d-none d-sm-table-cell text-center">Dominan Jenis Pembimbing</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lecturers as $lecturer)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $lecturer->getShortName() }}</td>
                                <td class="d-none d-sm-table-cell">{{ $lecturer->study_program->getName()  }}</td>
                                <td class="text-center">{{ $lecturer->asFirstSupervisorCount }}</td>
                                <td class="text-center">{{ $lecturer->asSecondSupervisorCount }}</td>
                                <td class="d-none d-sm-table-cell text-center">
                                    @if($lecturer->functional)
                                        <span
                                            class="badge @if($lecturer->functional === \App\Constants\Functional::LECTURER) badge-success
                                                        @elseif($lecturer->functional === \App\Constants\Functional::EXPERT_ASSISTANT) badge-warning
                                                        @endif">
                                        {{ getLecturship($lecturer->functional) }}
                                    </span>
                                    @else
                                        <span class="badge badge-danger">NON-JAB</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    Pembimbing {{ $lecturer->supervisorType }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Step 1 -->
                <!-- Step 2 -->
                <div class="tab-pane" id="btabs-step-2" role="tabpanel">
                    <div
                        class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
                        role="alert">
                        <div class="flex-fill mr-3">
                            <h5 class="alert-heading font-size-h5 my-2">
                                Step 2 : Filter hanya Dosen yang pernah menjadi Pembimbing 1 dan Pembimbing 2 saja.
                            </h5>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-vcenter table-sm">
                        <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Lengkap</th>
                            <th class="d-none d-sm-table-cell font-italic">Homebase</th>
                            <th class="d-none d-sm-table-cell">JRP 1</th>
                            <th class="d-none d-sm-table-cell">JRP 2</th>
                            <th class="d-none d-sm-table-cell">Jab. Fungsional</th>
                            <th class="d-none d-sm-table-cell text-center">Jenis Pembimbing</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($filteredLecturers as $lecturer)
                            <tr>
                                <td class="text-center">{{ $number++ }}</td>
                                <td>{{ $lecturer->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $lecturer->homebase  }}</td>
                                <td>{{ $lecturer->asFirstSupervisorCount }}</td>
                                <td>{{ $lecturer->asSecondSupervisorCount }}</td>
                                <td class="d-none d-sm-table-cell text-center">{{ $lecturer->functional }}</td>
                                <td class="text-center">
                                    Pembimbing {{ $lecturer->supervisorType }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Step 2 -->
                <!-- Step 3 -->
                <div class="tab-pane" id="btabs-step-3" role="tabpanel">
                    <div
                        class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
                        role="alert">
                        <div class="flex-fill mr-3">
                            <h5 class="alert-heading font-size-h5 my-2">
                                Step 3 : Pengelomompokkan Jumlah Riwayat Dosen sebagai Pembimbing 1 dan 2.
                            </h5>
                            <p class="mb-0">
                                <b>Keterangan:</b> <br>
                                <b>SRP</b> : Score Riwayat sebagai Dosen Pembimbing 1 <br>
                                <b>SRP</b> : Score Riwayat sebagai Dosen Pembimbing 2
                            </p>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-vcenter table-sm">
                        <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Lengkap</th>
                            <th class="d-none d-sm-table-cell font-italic">Homebase</th>
                            <th class="d-none d-sm-table-cell">SRP 1</th>
                            <th class="d-none d-sm-table-cell">SRP 2</th>
                            <th class="d-none d-sm-table-cell">Jab. Fungsional</th>
                            <th class="d-none d-sm-table-cell text-center">Jenis Pembimbing</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $number = 1; @endphp
                        @foreach ($filteredLecturers as $lecturer)
                            <tr>
                                <td class="text-center">{{ $number++ }}</td>
                                <td>{{ $lecturer->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $lecturer->homebase  }}</td>
                                <td>{{ $lecturer->firstSupervisorLabel }}</td>
                                <td>{{ $lecturer->secondSupervisorLabel }}</td>
                                <td class="d-none d-sm-table-cell text-center">{{ $lecturer->functional }}</td>
                                <td class="text-center">
                                    Pembimbing {{ $lecturer->supervisorType }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Step 3 -->
                <!-- Step 4 -->
                <div class="tab-pane" id="btabs-step-4" role="tabpanel">
                    <div
                        class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
                        role="alert">
                        <div class="flex-fill mr-3">
                            <h5 class="alert-heading font-size-h5 my-2">
                                Step 4 : Konversi data ke dalam tabel perhitungan Algoritma C4.5 dan Perhitungan nilai Entropy dan Gain setiap atribut.
                            </h5>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-vcenter table-sm">
                        <thead>
                        <tr class="bg-primary text-white">
                            <th>Atribut</th>
                            <th>Sub Atribut</th>
                            <th>Jumlah Kasus</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Entropy</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th colspan="2" class="text-center">TOTAL =></th>
                            <th class="text-center">{{ $countFilteredLecturers }}</th>
                            <th class="text-center">{{ $totalFirstSupervisor }}</th>
                            <th class="text-center">{{ $totalSecondSupervisor }}</th>
                            <th class="text-center">{{ $entropyTotal }}</th>
                        </tr>
                        @foreach($results as $result)
                            <tr>
                                <td class="bg-{{ $result['background'] }} border-{{ $result['background'] }} text-white align-middle text-center"
                                    rowspan="{{ count($result['items']) }}">
                                    {{ $result['name'] }} <br>
                                    <b class="text-black">{{ $result['gain'] }}</b>
                                </td>
                                @foreach($result['items'] as $item)
                                    <td class="text-center">{{ $item['name'] }}</td>
                                    <td class="text-center">{{ $item['total'] }}</td>
                                    <td class="text-center">{{ $item['first_supervisor'] }}</td>
                                    <td class="text-center">{{ $item['second_supervisor'] }}</td>
                                    <td class="text-center">{{ $item['entropy'] }}</td>
                            </tr>
                        @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Step 4 -->
                <!-- Step 5 -->
                <div class="tab-pane" id="btabs-step-5" role="tabpanel">
                    <div
                        class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
                        role="alert">
                        <div class="flex-fill mr-3">
                            <h5 class="alert-heading font-size-h5 my-2">
                                Step 5 : Menghitung nilai Gain untuk setiap atribut.
                            </h5>
                        </div>
                    </div>
                </div>
                <!-- End Step 5 -->
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
