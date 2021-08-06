@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content content-full">
        <h2 class="content-heading">
            Data Pengguna
        </h2>
        <div class="block block-rounded">
            <div class="block-content">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- User Profile -->
                    <h2 class="content-heading pt-0">
                        <i class="fa fa-fw fa-user-circle text-muted mr-1"></i> Form Pengguna
                    </h2>
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="text-muted">
                                Form ini hanya digunakan untuk menambah pengguna dengan hak akses <b>BAAK</b>. <br>
                            <hr>
                                Akun Dosen dan Mahasiswa akan otomatis terbuat ketika Anda menambahkan Data Dosen atau Mahasiswa.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <x-input type="text" field="username" placeholder="Masukkan username..." label="username" is-required="true"></x-input>

                            <x-input type="text" field="full_name" placeholder="Masukkan nama lengkap..." label="Nama Lengkap" is-required="true"></x-input>

                            <x-input type="email" field="email" placeholder="Alamat email" label="Email" is-required="true"></x-input>

                            <x-input type="text" field="level" readonly label="Level" value="ACADEMIC_STAFF" is-read-only="true"></x-input>

                            <div class="form-group">
                                <label>Foto (Opsional)</label>
                                <div class="push">
                                    <img class="img-avatar" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                                </div>
                                <div class="custom-file">
                                    <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                    <input type="file" class="custom-file-input js-custom-file-input-enabled"
                                           data-toggle="custom-file-input" id="dm-profile-edit-avatar"
                                           name="avatar" accept="image/*">
                                    <label class="custom-file-label" for="dm-profile-edit-avatar">Pilih gambar</label>
                                </div>
                            </div>

                            <x-input type="password" field="password" label="Password" is-required="true" placeholder="Password minimal 6 karakter"></x-input>

                            <x-input type="password" field="password_confirmation" label="Konfirmasi Password" is-required="true" placeholder="Masukkan ulang Password"></x-input>
                        </div>
                    </div>
                    <!-- END User Profile -->

                    <!-- Submit -->
                    <div class="row push">
                        <div class="col-lg-8 col-xl-5 offset-lg-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save mr-1"></i>
                                    <span>Simpan</span>
                                </button>
                                <x-button-link extend-class="float-right" type="secondary" link="{{ route('users.index') }}" icon="chevron-left" text="Kembali"></x-button-link>
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
