@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>jQuery(function () {
            Dashmix.helpers(['select2']);
        });</script>
    <script>
        const submitForm = () => {
            event.preventDefault();
            document.getElementById("form-competency").submit();
        }
    </script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo17@2x.jpg') }}');">
        <div class="bg-black-75">
            <div class="content content-full">
                <div class="py-5 text-center">
                    <a class="img-link" href="{{ url()->current() }}">
                        <img class="img-avatar img-avatar96 img-avatar-thumb"
                             src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                    </a>
                    <h1 class="font-w700 my-2 text-white">{{ $lecturer->getShortName() }}</h1>
                    <h2 class="h4 font-w700 text-white-75">
                        {{ $lecturer->nidn }}
                    </h2>
                    <a class="btn btn-hero-dark" href="/">
                        <i class="fa fa-fw fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-full content-boxed">
        <div class="block block-rounded">
            <div class="block-content">
                <form action="be_pages_projects_edit.php" method="POST" enctype="multipart/form-data"
                      onsubmit="return false;">
                    <!-- User Profile -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-user-circle text-muted mr-1"></i> Profil Dosen
                    </h2>
                    <div class="row push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Your account’s vital info. Your username will be publicly visible.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-7">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td class="font-weight-bold">NIDN</td>
                                    <td>:</td>
                                    <td>{{ $lecturer->nidn }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Nama Lengkap</td>
                                    <td>:</td>
                                    <td>{{ $lecturer->getFullName() }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Gelar</td>
                                    <td>:</td>
                                    <td>{{ $lecturer->degree }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Jabatan Fungsional</td>
                                    <td>:</td>
                                    <td>{{ ($lecturer->functional) ? getLecturship($lecturer->functional) : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold"><i>Homebase</i></td>
                                    <td>:</td>
                                    <td>{{ $lecturer->study_program->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Telpon</td>
                                    <td>:</td>
                                    <td>{{ ($lecturer->phone) ? $lecturer->phone : '-'  }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td>:</td>
                                    <td><a href="mailto:{{ $lecturer->email }}">{{ $lecturer->email }}</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- END User Profile -->

                    <!-- Connections -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-lightbulb text-muted mr-1"></i> Kompetensi
                    </h2>
                    <div class="row push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Kompetensi atau Bidang Ilmu yang Anda kuasai.
                            </p>
                            <button type="button" data-toggle="modal" data-target="#modal-competency"
                                    class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                <span>Tambah Data</span>
                            </button>
                        </div>
                        <div class="col-lg-9 col-xl-7">
                            <div class="form-group row items-push mb-0">
                                @forelse ($lecturer->competencies as $competency)
                                    <div class="col-md-6 col-xl-6">
                                        <div class="custom-control custom-block custom-control-primary">
                                            <input type="checkbox" class="custom-control-input" checked
                                                   id="dm-project-new-people-{{ $competency->id }}"
                                                   name="dm-project-new-people-{{ $competency->id }}">
                                            <label class="custom-control-label"
                                                   for="dm-project-new-people-{{ $competency->id }}">
                                                <span class="d-flex align-items-center">
                                                    <i class="fa fa-fw fa-book fa-2x"></i>
                                                    <span class="ml-2">
                                                        <span class="font-w700">{{ $competency->name }}</span>
                                                        <span
                                                            class="d-block font-size-sm text-muted">{{ $competency->code }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                            <span class="custom-block-indicator">
                                                <i class="fa fa-check"></i>
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-12">
                                        <x-alert type="info" icon="fa-info"
                                                 message="Tidak ada data kompetensi."
                                        ></x-alert>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <!-- END Connections -->

                    <!-- Submit -->
                    <div class="row push">
                        <div class="col-lg-8 col-xl-5 offset-lg-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-alt-primary">
                                    <i class="fa fa-check-circle mr-1"></i> Update Profile
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Submit -->
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('modal')
    <!-- Slide Up Block Modal -->
    <div class="modal fade" id="modal-competency" tabindex="-1" role="dialog"
         aria-labelledby="modal-competency"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Tambah Kompetensi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content text-center align-middle">
                        <form action="{{ route('lecturer.competency.store') }}" id="form-competency" method="POST">
                            @csrf
                            <label for="example-select2-multiple">Pilih Kompetensi</label>
                            <select class="js-select2 form-control" id="example-select2-multiple" name="competencies[]"
                                    style="width: 100%;" data-placeholder="Choose many.." multiple>
                                @foreach($scienceFields as $field)
                                    <option
                                        {{ ($field->isSelected) ? 'selected' : '' }} value="{{ $field->id }}">{{ $field->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="lecturer_id" value="{{ $lecturer->id }}">
                        </form>
                    </div>
                    <div class="block-content block-content-full text-right bg-light">
                        <button type="button" onclick="submitForm()" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            Simpan
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Slide Up Block Modal -->
@endsection
