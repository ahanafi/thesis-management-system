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
                <div class="tab-pane" id="btabs-step-1" role="tabpanel">
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
                        @php
                            $functionalJobsList = [];
                        @endphp
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
                                        <span class="badge @if($lecturer->functional === \App\Functional::LECTURER) badge-success
                                                        @elseif($lecturer->functional === \App\Functional::EXPERT_ASSISTANT) badge-warning
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
                        @php
                            $number = 1;
                            $totalCases = 0;
                            $totalFirstSupervisor = 0;
                            $totalSecondSupervisor = 0;
                        @endphp
                        @foreach ($lecturers as $lecturer)
                            @php
                                $totalCases++;
                                  if($lecturer->asFirstSupervisorCount > 0) {
                                      $totalFirstSupervisor++;
                                  } else if($lecturer->asSecondSupervisorCount > 0) {
                                      $totalSecondSupervisor++;
                                  }
                            @endphp
                            @if($lecturer->asFirstSupervisorCount > 0 || $lecturer->asSecondSupervisorCount > 0)
                                @php
                                    $homebaseList[] = $lecturer->study_program->getName();
                                    $functionalJobsList[] = ($lecturer->functional !== null) ? getLecturship($lecturer->functional) : 'NON-JAB';
                                    $filteredLecturers[] = [
                                        'name' => $lecturer->getShortName(),
                                        'homebase' => $lecturer->study_program->getName(),
                                        'first_supervisor_count' => $lecturer->asFirstSupervisorCount,
                                        'second_supervisor_count' => $lecturer->asSecondSupervisorCount,
                                        'functional' => ($lecturer->functional !== null) ? getLecturship($lecturer->functional) : 'NON-JAB',
                                        'supervisor_type' => $lecturer->supervisorType
                                    ];
                                @endphp
                                <tr>
                                    <td class="text-center">
                                        {{ $number++ }}
                                    </td>
                                    <td>{{ $lecturer->getShortName() }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $lecturer->study_program->getName()  }}</td>
                                    <td>{{ $lecturer->asFirstSupervisorCount }}</td>
                                    <td>{{ $lecturer->asSecondSupervisorCount }}</td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        @if($lecturer->functional)
                                            <span class="badge @if($lecturer->functional === \App\Functional::LECTURER) badge-success
                                                            @elseif($lecturer->functional === \App\Functional::EXPERT_ASSISTANT) badge-warning
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
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Step 2 -->
                <!-- Step 3 -->
                <div class="tab-pane active" id="btabs-step-3" role="tabpanel">
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
                        @php
                            $number = 1;
                            $homebaseList = array_values(array_unique($homebaseList));
                            $functionalJobsList = array_values(array_unique($functionalJobsList));
                        @endphp

                        @foreach ($lecturers as $lecturer)
                            @if($lecturer->asFirstSupervisorCount > 0 || $lecturer->asSecondSupervisorCount > 0)
                                <tr>
                                    <td class="text-center">
                                        {{ $number++ }}
                                    </td>
                                    <td>{{ $lecturer->getShortName() }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $lecturer->study_program->getName()  }}</td>
                                    <td>
                                        @if($lecturer->asFirstSupervisorCount >= 14)
                                            SANGAT TINGGI
                                        @elseif($lecturer->asFirstSupervisorCount >= 8 && $lecturer->asFirstSupervisorCount <= 13)
                                            TINGGI
                                        @elseif($lecturer->asFirstSupervisorCount >= 4 && $lecturer->asFirstSupervisorCount <= 7)
                                            CUKUP
                                        @else
                                            KURANG
                                        @endif
                                    </td>
                                    <td>
                                        @if($lecturer->asSecondSupervisorCount >= 12)
                                            SANGAT TINGGI
                                        @elseif($lecturer->asSecondSupervisorCount >= 8 && $lecturer->asSecondSupervisorCount <= 11)
                                            TINGGI
                                        @elseif($lecturer->asSecondSupervisorCount >= 4 && $lecturer->asSecondSupervisorCount <= 7)
                                            CUKUP
                                        @else
                                            KURANG
                                        @endif
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        @if($lecturer->functional)
                                            <span class="badge @if($lecturer->functional === \App\Functional::LECTURER) badge-success
                                                            @elseif($lecturer->functional === \App\Functional::EXPERT_ASSISTANT) badge-warning
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
                            @endif
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
                            <th>Gain</th>
                        </tr>
                        <tr>
                            <th class="text-center"></th>
                            <th colspan="2">TOTAL</th>
                            <th class="text-center">{{ $totalCases }}</th>
                            <th class="text-center">{{ $totalFirstSupervisor }}</th>
                            <th class="text-center">{{ $totalSecondSupervisor }}</th>
                            <th class="text-center">
                                @php
                                    $entropyTotal = \App\Services\C45Service::calculateEntropy($totalCases, $totalFirstSupervisor, $totalSecondSupervisor);
                                    echo $entropyTotal;
                                    $attributtes = [];
                                @endphp
                            </th>
                            <th class="text-center">-</th>
                        </tr>
                        @foreach($homebaseList as $homebase)
                            @php
                                $totalCriteria = countFromArray($filteredLecturers, ['homebase' => $homebase]);
                                $totalFirstCriteria = countFromArray($filteredLecturers, [
                                    'homebase' => $homebase,
                                    'supervisor_type' => 1
                                ]);
                                $totalSecondCriteria = countFromArray($filteredLecturers, [
                                    'homebase' => $homebase,
                                    'supervisor_type' => 2
                                ]);
                                $entropy = \App\Services\C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
                                $attributtes[] = [
                                    'total_criteria' => $totalCriteria,
                                    'entropy_criteria' => $entropy,
                                ];
                            @endphp
                            <tr>
                                <td class="text-center"></td>
                                <td>HOMEBASE</td>
                                <td class="text-center">{{ $homebase }}</td>
                                <td class="text-center">{{ $totalCriteria }}</td>
                                <td class="text-center">
                                    {{ $totalFirstCriteria }}
                                </td>
                                <td class="text-center">
                                    {{ $totalSecondCriteria }}
                                </td>
                                <td class="text-center">
                                    {{ $entropy }}
                                </td>
                                <td class="text-center"></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td colspan="5">GAIN HOMEBASE</td>
                            <td>
                                {{ \App\Services\C45Service::calculateGain($entropyTotal, $totalCases, $attributtes) }}
                            </td>
                        </tr>
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
