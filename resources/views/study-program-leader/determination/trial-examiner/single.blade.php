@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script type="text/javascript">
        const submitForm = (lecturerId) => {
            if (lecturerId !== null) {
                @if(strtolower($status_change) === 'first')
                document.getElementById('first_examiner').value = lecturerId;
                @elseif(strtolower($status_change) === 'second')
                document.getElementById('second_examiner').value = lecturerId;
                @endif
                document.getElementById('submit-examiner').submit();
            }
        }
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Penentuan Dosen Penguji Skripsi
        </h2>
        <x-student-thesis-info
            name="{{ $submission->thesis->student->getName() }}"
            nim="{{ $submission->thesis->student->nim }}"
            study-program-name="{{ $submission->thesis->student->study_program->getComplexName() }}"
            semester="{{ $submission->thesis->student->semester }}"
            avatar="{{ $submission->thesis->student->user->avatar }}"
            research-title="{{ $submission->thesis->research_title }}"
            science-field-name="{{ $submission->thesis->scienceField->name }}"
            first-supervisor="{{ optional($submission->thesis->firstSupervisor)->getNameWithDegree() ?? '-' }}"
            second-supervisor="{{ optional($submission->thesis->secondSupervisor)->getNameWithDegree() ?? '-' }}"
        ></x-student-thesis-info>

        <div class="row">
            <div class="col-xl-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                            Form Penentuan Dosen Penguji
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-sm table-bordered table-striped">
                            @if(strtolower($status_change) === 'first')
                                <tr>
                                    <td style="width: 120px;">Penguji 1</td>
                                    <td style="width: 20px;">:</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Penguji 2</td>
                                    <td>:</td>
                                    <td>{{ $fix_examiner->getNameWithDegree() }}</td>
                                </tr>
                            @elseif (strtolower($status_change) === 'second')
                                <tr>
                                    <td style="width: 120px;">Penguji 1</td>
                                    <td style="width: 20px;">:</td>
                                    <td>{{ $fix_examiner->getNameWithDegree() }}</td>
                                </tr>
                                <tr>
                                    <td>Penguji 2</td>
                                    <td>:</td>
                                    <td>-</td>
                                </tr>
                            @endif
                        </table>
                        <hr>

                        <form action="{{ route('leader.determination.supervisor.save', $submission->thesis->id) }}"
                              method="POST">
                            @csrf
                            @method('POST')
                            <table class="table table-bordered table-striped table-vcenter table-sm">
                                <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Lengkap</th>
                                    <th class="d-none d-sm-table-cell font-italic">Homebase</th>
                                    <th class="d-none d-sm-table-cell">Jab. Fungsional</th>
                                    <th class="d-none d-sm-table-cell">Kompetensi</th>
                                    <th class="d-none d-sm-table-cell">Kuota</th>
                                    <th class="d-none d-sm-table-cell text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $number = 1; @endphp
                                @foreach ($candidates as $lecturer)
                                    <tr>
                                        <td class="text-center">{{ $number++ }}</td>
                                        <td>{{ $lecturer->getShortName() }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $lecturer->study_program->getName()  }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $lecturer->getLecturship() }}</td>
                                        <td class="font-size-sm">
                                            @forelse($lecturer->competencies as $competency)
                                                - {{ $competency->name  }} <br>
                                            @empty
                                            @endforelse
                                        </td>
                                        <td class="text-center">{{ $lecturer->quota }}</td>
                                        <td class="text-center">
                                            <button type="button" onclick="submitForm('{{ $lecturer->nidn }}')"
                                                    class="btn btn-sm btn-primary">
                                                <i class="si si-cursor"></i>
                                                <span>Pilih</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
    <form action="{{ route('leader.determination.trial-examiner.save', $submission->id) }}" method="POST"
          id="submit-examiner">
        @csrf
        @method('POST')
        <input type="hidden" name="status" required id="status-change" value="done">
        @if(strtolower($status_change) === 'first')
            <input type="hidden" id="first_examiner" name="first_examiner" required>
            <input type="hidden" name="second_examiner" value="{{ $fix_examiner->nidn }}" required>
        @elseif(strtolower($status_change) === 'second')
            <input type="hidden" name="first_examiner" value="{{ $fix_examiner->nidn }}" required>
            <input type="hidden" id="second_examiner" name="second_examiner" required>
        @endif
    </form>
@endsection
