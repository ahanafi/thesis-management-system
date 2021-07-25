<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">
            <i class="fa fa-fw fa-user text-muted mr-1"></i>
            Data Mahasiswa
        </h3>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter">
            <tr>
                <td colspan="3" class="text-center">
                    <img
                        class="img-avatar128 img-avatar img-avatar-rounded"
                        src="{{
                                Storage::exists($avatar)
                                ? Storage::url($avatar)
                                : asset('media/avatars/avatar7.jpg')
                            }}"
                        alt="User picture">
                </td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td>{{ $nim }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>{{ $studyProgramName }}</td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>:</td>
                <td>{{ $semester }}</td>
            </tr>
        </table>
    </div>
</div>
