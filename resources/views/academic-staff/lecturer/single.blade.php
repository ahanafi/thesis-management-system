@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ secure_asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ secure_asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ secure_asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ secure_asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ secure_asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ secure_asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ secure_asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ secure_asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ secure_asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-image" style="background-image: url('{{ secure_asset('media/photos/photo17@2x.jpg') }}');">
        <div class="bg-black-75">
            <div class="content content-full">
                <div class="py-5 text-center">
                    <a class="img-link" href="{{ url()->current() }}">
                        <img class="img-avatar img-avatar96 img-avatar-thumb"
                             src="{{ secure_asset('media/avatars/avatar10.jpg') }}" alt="">
                    </a>
                    <h1 class="font-w700 my-2 text-white">{{ $lecturer->getShortName() }}</h1>
                    <h2 class="h4 font-w700 text-white-75">
                        {{ $lecturer->nidn }}
                    </h2>
                    <a class="btn btn-hero-dark" href="{{ route('lecturers.index') }}">
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
                <form action="" method="POST" enctype="multipart/form-data"
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
                                You can connect your account to third party networks to get extra features.
                            </p>
                        </div>
                        <div class="col-lg-9 col-xl-7">
                            <div class="form-group row items-push mb-0">
                                @forelse ($lecturer->competencies as $competency)
                                    <div class="col-md-6 col-xl-4">
                                        <div class="custom-control custom-block custom-control-primary">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="dm-project-new-people-{{ $competency->id }}"
                                                   name="dm-project-new-people-{{ $competency->id }}">
                                            <label class="custom-control-label" for="dm-project-new-people-{{ $competency->id }}">
                                        <span class="d-flex align-items-center">
                                            <img class="img-avatar img-avatar48"
                                                 src="{{ secure_asset('media/avatars/avatar8.jpg') }}"
                                                 alt="">
                                            <span class="ml-2">
                                                <span class="font-w700">{{ $competency->name }}</span>
                                                <span class="d-block font-size-sm text-muted">{{ $competency->code }}</span>
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
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
