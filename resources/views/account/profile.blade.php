@extends('layouts.backend')

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
                    <h1 class="font-w700 my-2 text-white">{{ $student->getName() }}</h1>
                    <h2 class="h4 font-w700 text-white-75">
                        {{ $student->nim }}
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
                <form
                    onsubmit="return false;">
                    <!-- User Profile -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-user-circle text-muted mr-1"></i>
                        Profil Pengguna
                    </h2>
                    <div class="row push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Your account’s vital info. Your username will be publicly visible.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-7">
                            <table class="table table-bordered table-striped">
                                @if($student)
                                    <tr>
                                        <td class="font-weight-bold">NIM</td>
                                        <td>:</td>
                                        <td>{{ $student->nim }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Nama Lengkap</td>
                                        <td>:</td>
                                        <td>{{ $student->getName() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tempat lahir</td>
                                        <td>:</td>
                                        <td>{{ $student->place_of_birth ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tanggal lahir</td>
                                        <td>:</td>
                                        <td>{{ $student->date_of_birth ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><i>Program Studi</i></td>
                                        <td>:</td>
                                        <td>{{ $student->study_program->getComplexName() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Telpon</td>
                                        <td>:</td>
                                        <td>{{ ($student->phone) ?: '-'  }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Email</td>
                                        <td>:</td>
                                        <td><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Alamat</td>
                                        <td>:</td>
                                        <td>{{ ($student->address) ?: '-'  }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    <!-- END User Profile -->

                    <!-- Submit -->
                    <div class="row push">
                        <div class="col-lg-8 col-xl-5 offset-lg-3">
                            <div class="form-group">
                                <a href="#" class="btn btn-alt-primary">
                                    <i class="fa fa-pencil-alt mr-1"></i>
                                    <span>Ubah Profil</span>
                                </a>

                                <a href="{{ route('account.change-password') }}" class="btn btn-alt-warning">
                                    <i class="fa fa-user-lock mr-1"></i>
                                    <span>Ubah Password</span>
                                </a>
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
