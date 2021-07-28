<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">
            <i class="fa fa-fw fa-user text-muted mr-1"></i>
            Data Skripsi Mahasiswa
        </h3>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
            <button type="button" class="btn-block-option" data-toggle="block-option"
                    data-action="content_toggle"><i class="si si-arrow-up"></i></button>
        </div>
    </div>
    <div class="block-content row row-deck">
        <div class="col-md-2 col-xl-3">
            <img
                class="img-fluid rounded mb-sm-3"
                src="{{
                        Storage::exists($avatar)
                        ? Storage::url($avatar)
                        : asset('media/avatars/avatar7.jpg')
                    }}"
                alt="User picture">
        </div>
        <div class="col-md-10 col-xl-9">
            <table class="table table-bordered table-sm table-striped">
                <tr>
                    <td style="width: 15%">NIM</td>
                    <td>{{ $nim }}</td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>{{ $name }}</td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td>
                        {{ $studyProgramName }}
                    </td>
                </tr>
                <tr>
                    <td>Judul Skripsi</td>
                    <td>{{ $researchTitle }}</td>
                </tr>
                <tr>
                    <td>Bidang Ilmu</td>
                    <td>{{ $scienceFieldName }}</td>
                </tr>
                <tr>
                    <td>Pembimbing 1</td>
                    <td id="std-first-supervisor">
                        {{ $firstSupervisor }}
                    </td>
                </tr>
                <tr>
                    <td>Pembimbing 2</td>
                    <td id="std-second-supervisor">
                        {{ $secondSupervisor }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
