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
            Penentuan Dosen Pembimbing Skripsi
        </h2>
        <x-student-thesis-info
            name="{{ $thesis->student->getName() }}"
            nim="{{ $thesis->student->nim }}"
            study-program-name="{{ $thesis->student->study_program->getComplexName() }}"
            semester="{{ $thesis->student->semester }}"
            avatar="{{ $thesis->student->user->avatar }}"
            research-title="{{ $thesis->research_title }}"
            science-field-name="{{ $thesis->scienceField->name }}"
            first-supervisor="{{ optional($thesis->firstSupervisor)->getNameWithDegree() ?? '-' }}"
            second-supervisor="{{ optional($thesis->secondSupervisor)->getNameWithDegree() ?? '-' }}"
        ></x-student-thesis-info>

        <div class="row">
            <div class="col-xl-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-pencil-alt text-muted mr-1"></i>
                            Form Penentuan Dosen Pembimbing
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('leader.determination.supervisor.save', $thesis->id) }}"
                              method="POST">
                            @csrf
                            @method('POST')
                            <div class="row push">
                                <div class="col-lg-10 col-xl-10">

                                    <div class="form-group row">
                                        <label for="date" class="col-sm-4 col-form-label text-right">
                                            Dosen Pembimbing 1
                                        </label>

                                        <div class="col-sm-7">
                                            <select name="first_supervisor" id="first-supervisor" class="js-select2 form-control" required data-placeholder="-- Pilih Dosen Pembimbing --">
                                                <option value="" disabled selected>-- Pilih Dosen Pembimbing --</option>
                                                @forelse($firstSupervisorCandidates as $candidate)
                                                    <option {{ old('first_supervisor') === $candidate->nidn ? 'selected' : '' }} value="{{ $candidate->nidn }}">{{ $candidate->getNameWithDegree() }}</option>
                                                @empty
                                                @endif
                                            </select>

                                            @error('first_supervisor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date" class="col-sm-4 col-form-label text-right">
                                            Dosen Pembimbing 2
                                        </label>

                                        <div class="col-sm-7">
                                            <select name="second_supervisor" id="second-supervisor" class="js-select2 form-control" required data-placeholder="-- Pilih Dosen Pembimbing --">
                                                <option value="" disabled selected>-- Pilih Dosen Pembimbing --</option>
                                                @forelse($lecturers as $lecturer)
                                                    <option {{ old('second_supervisor') === $lecturer->nidn ? 'selected' : '' }} value="{{ $lecturer->nidn }}">{{ $lecturer->getNameWithDegree() }}</option>
                                                @empty
                                                @endif
                                            </select>

                                            @error('second_supervisor')
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
