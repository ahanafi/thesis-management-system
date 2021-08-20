@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content content-full content-boxed">
        <div class="block block-rounded">
            <div class="block-content">
                <form action="{{ route('account.update-password') }}" method="POST">
                @csrf
                <!-- Change Password -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-user-lock text-muted mr-1"></i> Ubah Password
                    </h2>
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="text-muted">
                                Mengubah sandi masuk adalah cara mudah untuk menjaga keamanan akun Anda.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="form-group">
                                <label for="current_password">Password Saat ini</label>

                                <div class="input-group">
                                    <input type="password" class="form-control" id="current_password"
                                           name="current_password" autocomplete="off" required
                                    >
                                    <div class="input-group-append">
                                        <button id="btn-change-type" onclick="changeType(this)" type="button" class="btn btn-secondary" data-showtext="false">
                                            <i class="fa fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>

                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="new_password">Password baru</label>
                                    <input type="password" class="form-control" id="new_password"
                                           name="new_password" required autocomplete="off">

                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="new_password_confirmation">Konfirmasi Password baru</label>
                                    <input type="password" class="form-control"
                                           id="new_password_confirmation" required autocomplete="off"
                                           name="new_password_confirmation">

                                    @error('new_password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Change Password -->

                    <!-- Submit -->
                    <div class="row push">
                        <div class="col-lg-8 col-xl-5 offset-lg-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-alt-primary">
                                    <i class="fa fa-fw fa-save mr-1"></i>
                                    <span>Simpan</span>
                                </button>
                                <a href="{{ route('account.profile') }}" class="btn btn-secondary float-right">
                                    <span>Kembali</span>
                                    <i class="fa fa-arrow-right"></i>
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
