@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        jQuery(function(){
            Dashmix.helpers('select2');
        });
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">
            Penentuan Dosen Penguji Seminar Skripsi
        </h2>
        <x-student-thesis-info
            name="{{ $submission->student->getName() }}"
            nim="{{ $submission->student->nim }}"
            study-program-name="{{ $submission->student->study_program->getComplexName() }}"
            semester="{{ $submission->student->semester }}"
            avatar="{{ $submission->student->user->avatar }}"
            research-title="{{ $submission->thesis->research_title }}"
            science-field-name="{{ $submission->thesis->scienceField->name }}"
            first-supervisor="{{ $submission->thesis->firstSupervisor->getNameWithDegree() ?? '-' }}"
            second-supervisor="{{ $submission->thesis->secondSupervisor->getNameWithDegree() ?? '-' }}"
        ></x-student-thesis-info>

        <div class="row">
            <div class="col-xl-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                            Form Penentuan Dosen Penguji Seminar Skripsi
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('leader.determination.seminar-examiner.save', $submission->id) }}"
                              method="POST">
                            @csrf
                            @method('POST')
                            <div class="row push">
                                <div class="col-lg-10 col-xl-10">

                                    <div class="form-group row">
                                        <label for="date" class="col-sm-4 col-form-label text-right">
                                            Dosen Penguji 1
                                        </label>

                                        <div class="col-sm-7">
                                            <select name="first_examiner" id="first-examiner" class="js-select2 form-control" required data-placeholder="-- Pilih Dosen Penguji --">
                                                <option value="" disabled selected>-- Pilih Dosen Penguji --</option>
                                                @forelse($firstExaminerCandidates as $candidate)
                                                    <option {{ old('first_examiner') === $candidate->nidn ? 'selected' : '' }} value="{{ $candidate->nidn }}">{{ $candidate->getNameWithDegree() }}</option>
                                                @empty
                                                @endif
                                            </select>

                                            @error('first_examiner')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date" class="col-sm-4 col-form-label text-right">
                                            Dosen Penguji 2
                                        </label>

                                        <div class="col-sm-7">
                                            <select name="second_examiner" id="second-examiner" class="js-select2 form-control" required data-placeholder="-- Pilih Dosen Penguji --">
                                                <option value="" disabled selected>-- Pilih Dosen Penguji --</option>
                                                @forelse($lecturers as $lecturer)
                                                    <option {{ old('second_examiner') === $lecturer->nidn ? 'selected' : '' }} value="{{ $lecturer->nidn }}">{{ $lecturer->getNameWithDegree() }}</option>
                                                @empty
                                                @endif
                                            </select>

                                            @error('second_examiner')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-7 offset-sm-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save mr-1"></i>
                                                <span>Simpan</span>
                                            </button>
                                            <a href="{{ route('leader.determination.supervisor.index') }}" class="btn btn-secondary float-right">
                                                <span>Kembali</span>
                                                <i class="fa fa-fw fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- END User Profile -->
                        </form>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
