@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Data Dosen</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Examples</li>
                        <li class="breadcrumb-item active" aria-current="page">Plugin</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
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
                                        <span class="badge @if($lecturer->functional === \App\Constants\Functional::LECTURER) badge-success
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
                    <br>
                    <table class="table table-bordered table-striped table-vcenter table-sm">
                        <tr>
                            <th>Node</th>
                            <th>Atribut</th>
                            <th>Sub Atribut</th>
                            <th>Jumlah Kasus</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Entropy</th>
                        </tr>
                        <tr>
                            <th class="text-center"></th>
                            <th colspan="2">TOTAL</th>
                            <th class="text-center">{{ $countFilteredLecturers }}</th>
                            <th class="text-center">{{ $totalFirstSupervisor }}</th>
                            <th class="text-center">{{ $totalSecondSupervisor }}</th>
                            <th class="text-center">{{ $entropyTotal }}</th>
                        </tr>
                        @foreach($homebases as $homebase)
                            <tr>
                                <td></td>
                                <td>HOMEBASE</td>
                                <td>{{ $homebase['name'] }}</td>
                                <td class="text-center">{{ $homebase['total'] }}</td>
                                <td class="text-center">{{ $homebase['first_supervisor'] }}</td>
                                <td class="text-center">{{ $homebase['second_supervisor'] }}</td>
                                <td class="text-center">{{ $homebase['entropy'] }}</td>
                            </tr>
                        @endforeach
                        @foreach($functionalJobs as $functional)
                            <tr>
                                <td></td>
                                <td>JABATAN FUNGSIONAL</td>
                                <td>{{ $functional['name'] }}</td>
                                <td class="text-center">{{ $functional['total'] }}</td>
                                <td class="text-center">{{ $functional['first_supervisor'] }}</td>
                                <td class="text-center">{{ $functional['second_supervisor'] }}</td>
                                <td class="text-center">{{ $functional['entropy'] }}</td>
                            </tr>
                        @endforeach
                        @foreach($firstSupervisorScores as $firstSupervisor)
                            <tr>
                                <td></td>
                                <td>SKOR PENGUJI 1</td>
                                <td>{{ $firstSupervisor['name'] }}</td>
                                <td class="text-center">{{ $firstSupervisor['total'] }}</td>
                                <td class="text-center">{{ $firstSupervisor['first_supervisor'] }}</td>
                                <td class="text-center">{{ $firstSupervisor['second_supervisor'] }}</td>
                                <td class="text-center">{{ $firstSupervisor['entropy'] }}</td>
                            </tr>
                        @endforeach
                        @foreach($secondSupervisorScores as $secondSupervisor)
                            <tr>
                                <td></td>
                                <td>SKOR PENGUJI 2</td>
                                <td>{{ $secondSupervisor['name'] }}</td>
                                <td class="text-center">{{ $secondSupervisor['total'] }}</td>
                                <td class="text-center">{{ $secondSupervisor['first_supervisor'] }}</td>
                                <td class="text-center">{{ $secondSupervisor['second_supervisor'] }}</td>
                                <td class="text-center">{{ $secondSupervisor['entropy'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- End Step 3 -->
                <!-- Step 4 -->
                <div class="tab-pane" id="btabs-step-4" role="tabpanel">
                    <h4 class="font-w400">Step 4</h4>
                    <p>...</p>
                </div>
                <!-- End Step 4 -->
                <!-- Step 5 -->
                <div class="tab-pane" id="btabs-step-5" role="tabpanel">
                    <h4 class="font-w400">Step 5</h4>
                    <p>...</p>
                </div>
                <!-- End Step 5 -->
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
