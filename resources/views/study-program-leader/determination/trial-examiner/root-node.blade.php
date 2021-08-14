@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Penentuan Dosen Penguji Sidang Skripsi
        </h2>
        <x-student-thesis-info
            name="{{ $submission->thesis->student->getName() }}"
            nim="{{ $submission->thesis->student->nim }}"
            study-program-name="{{ $submission->thesis->student->study_program->getComplexName() }}"
            semester="{{ $submission->thesis->student->semester }}"
            avatar="{{ $submission->thesis->student->user->avatar }}"
            research-title="{{ $submission->thesis->research_title }}"
            science-field-name="{{ $submission->thesis->scienceField->name }}"
            first-supervisor="{{ $submission->thesis->firstSupervisor->getNameWithDegree() }}"
            second-supervisor="{{ $submission->thesis->secondSupervisor->getNameWithDegree() }}"
        ></x-student-thesis-info>
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
                    <a class="nav-link" href="#first-examiner">Penguji 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#second-examiner">Penguji 2</a>
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
                                Step 1 : Menampilkan seluruh data Dosen dan jumlah riwayat Dosen sebagai Penguji 1
                                dan Penguji 2.
                            </h5>
                            <p class="mb-0">
                                <b>Keterangan:</b> <br>
                                <b>JRP1</b> : Jumlah Riwayat sebagai Dosen Penguji 1 <br>
                                <b>JRP2</b> : Jumlah Riwayat sebagai Dosen Penguji 2
                            </p>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-vcenter table-sm">
                        <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Lengkap</th>
                            <th class="d-none d-sm-table-cell font-italic">Homebase</th>
                            <th class="d-none d-sm-table-cell">Jab. Fungsional</th>
                            <th class="d-none d-sm-table-cell">Kompetensi</th>
                            <th class="d-none d-sm-table-cell">JRP 1</th>
                            <th class="d-none d-sm-table-cell">JRP 2</th>
                            <th class="d-none d-sm-table-cell">Kuota</th>
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
                                <td class="d-none d-sm-table-cell">{{ $lecturer->functional }}</td>
                                <td class="font-size-sm">
                                    @forelse($lecturer->competencies as $competency)
                                        - {{ $competency->name  }} <br>
                                    @empty
                                    @endforelse
                                </td>
                                <td class="text-center">{{ $lecturer->asFirstExaminerCount }}</td>
                                <td class="text-center">{{ $lecturer->asSecondExaminerCount }}</td>
                                <td class="text-center">{{ $lecturer->quota }}</td>
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
                                Step 2 : Filter hanya Dosen yang pernah menjadi Penguji 1 dan Penguji 2 saja yang
                                terdapat pada data set.
                            </h5>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-vcenter table-sm">
                        <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Lengkap</th>
                            <th class="d-none d-sm-table-cell font-italic">Homebase</th>
                            <th class="d-none d-sm-table-cell">Jab. Fung.</th>
                            <th class="d-none d-sm-table-cell">Kompetensi</th>
                            <th class="d-none d-sm-table-cell">JRP 1</th>
                            <th class="d-none d-sm-table-cell">JRP 2</th>
                            <th class="d-none d-sm-table-cell">Kuota</th>
                            <th class="d-none d-sm-table-cell text-center">Jenis Penguji</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($filteredLecturers as $lecturer)
                            <tr>
                                <td class="text-center">{{ $number++ }}</td>
                                <td>{{ $lecturer->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $lecturer->homebase  }}</td>
                                <td class="d-none d-sm-table-cell">{{ $lecturer->functional }}</td>
                                <td class="font-size-sm">
                                    @forelse($lecturer->competencies as $competency)
                                        - {{ optional($competency)->name  }} <br>
                                    @empty
                                    @endforelse
                                </td>
                                <td>{{ $lecturer->asFirstExaminerCount }}</td>
                                <td>{{ $lecturer->asSecondExaminerCount }}</td>
                                <td class="text-center">{{ $lecturer->quota }}</td>
                                <td class="text-center">
                                    Penguji {{ $lecturer->examinerType }}
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
                                Step 3 : Pengelompokkan Jumlah Riwayat Dosen sebagai Penguji 1 dan 2.
                            </h5>
                            <p class="mb-0">
                                <b>Keterangan:</b> <br>
                                <b>SRP1</b> : Score Riwayat sebagai Dosen Penguji 1 <br>
                                <b>SRP2</b> : Score Riwayat sebagai Dosen Penguji 2
                            </p>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-vcenter table-sm">
                        <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Lengkap</th>
                            <th class="d-none d-sm-table-cell font-italic">Homebase</th>
                            <th class="d-none d-sm-table-cell">Jab. Fung.</th>
                            <th class="d-none d-sm-table-cell">Kompetensi</th>
                            <th class="d-none d-sm-table-cell">SRP 1</th>
                            <th class="d-none d-sm-table-cell">SRP 2</th>
                            <th class="d-none d-sm-table-cell">Kuota</th>
                            <th class="d-none d-sm-table-cell text-center">Jenis Penguji</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $number = 1; @endphp
                        @foreach ($filteredLecturers as $lecturer)
                            @if($lecturer->haveTestedInRelatedStudyProgram)
                                <tr>
                                    <td class="text-center">{{ $number++ }}</td>
                                    <td>{{ $lecturer->name }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $lecturer->homebase  }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $lecturer->functional }}</td>
                                    <td class="font-size-sm">
                                        @forelse($lecturer->competencies as $competency)
                                            - {{ $competency->name  }} <br>
                                        @empty
                                        @endforelse
                                    </td>
                                    <td class="font-size-sm">{{ $lecturer->firstExaminerLabel }}</td>
                                    <td class="font-size-sm">{{ $lecturer->secondExaminerLabel }}</td>
                                    <td class="text-center">{{ $lecturer->quota }}</td>
                                    <td class="text-center">
                                        Penguji {{ $lecturer->examinerType }}
                                    </td>
                                </tr>
                            @endif
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
                                Step 5 : Konversi data ke dalam tabel perhitungan Algoritma C4.5 dan Perhitungan nilai
                                Entropy dan Gain setiap atribut.
                            </h5>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-vcenter table-sm">
                        <thead>
                        <tr class="bg-primary text-white">
                            <th>Atribut</th>
                            <th>Sub Atribut</th>
                            <th>Jumlah Kasus</th>
                            <th>Penguji 1</th>
                            <th>Penguji 2</th>
                            <th>Entropy</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th colspan="2" class="text-center">TOTAL =></th>
                            <th class="text-center">{{ $countFilteredLecturers }}</th>
                            <th class="text-center">{{ $totalFirstExaminer }}</th>
                            <th class="text-center">{{ $totalSecondExaminer }}</th>
                            <th class="text-center">{{ $entropyTotal }}</th>
                        </tr>
                        @foreach($results as $result)
                            <tr>
                                <td class="bg-{{ $result['background'] }} border-{{ $result['background'] }} text-white align-middle text-center"
                                    rowspan="{{ count($result['items']) }}">
                                    {{ $result['name'] }} <br>
                                    GAIN => <b class="text-black">{{ $result['gain'] }}</b>
                                </td>
                                @foreach($result['items'] as $item)
                                    <td class="text-center">{{ $item['name'] }}</td>
                                    <td class="text-center">{{ $item['total'] }}</td>
                                    <td class="text-center">{{ $item['first_examiner'] }}</td>
                                    <td class="text-center">{{ $item['second_examiner'] }}</td>
                                    <td class="text-center">{{ $item['entropy'] }}</td>
                            </tr>
                        @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Step 4 -->

                <!-- Penguji 1 -->
                <div class="tab-pane" id="first-examiner" role="tabpanel">Penguji 1 adalah ...</div>
                <!-- End Penguji 1 -->

                <!-- Penguji 2 -->
                <div class="tab-pane" id="second-examiner" role="tabpanel">Penguji 2 adalah ...</div>
                <!-- End Penguji 2 -->
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
