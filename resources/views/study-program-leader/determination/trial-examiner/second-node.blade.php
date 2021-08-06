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
                    <a class="nav-link active" href="#btabs-step-5">Step 5</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-step-6">Step 6</a>
                </li>
                <li class="nav-item c">
                    <a
                        class="nav-link"
                        href="#"
                        onclick="window.location.href='{{ route('leader.determination.trial-examiner.second-node', $submission->id) }}'"
                    >Cari Akar Selanjutnya</a>
                </li>
                <li class="nav-item ml-auto bg-primary">
                    <a class="nav-link text-white" href="#">
                        Mencari Akar Pohon Keputusan
                    </a>
                </li>
            </ul>
            <div class="block-content tab-content">
                <!-- Step 5 -->
                <div class="tab-pane active" id="btabs-step-5" role="tabpanel">
                    <div
                        class="alert alert-info d-flex align-items-center justify-content-between border-3x border-info"
                        role="alert">
                        <div class="flex-fill mr-3">
                            <h5 class="alert-heading font-size-h5 my-2">
                                Step 5 : Filter hanya Dosen yang pernah menjadi Penguji 1 dan Penguji 2 saja yang
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
                        @php($number = 1)
                        @foreach ($lecturers as $lecturer)
                            <tr>
                                <td class="text-center">{{ $number++ }}</td>
                                <td>{{ $lecturer->full_name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $lecturer->homebase  }}</td>
                                <td class="d-none d-sm-table-cell">{{ $lecturer->functional }}</td>
                                <td class="font-size-sm">-</td>
                                <td>{{ $lecturer->label_as_first_examiner }}</td>
                                <td>{{ $lecturer->label_as_second_examiner }}</td>
                                <td class="text-center">{{ $lecturer->quota }}</td>
                                <td class="text-center">
                                    Penguji {{ $lecturer->examiner_type }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Step 5 -->

                <!-- Step 4 -->

                <!-- End Step 4 -->
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
