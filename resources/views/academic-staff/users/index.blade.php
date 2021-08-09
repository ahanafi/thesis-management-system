@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <script>
        jQuery(function () {

            const usersData = jQuery("#users").DataTable({
                ajax: {
                    url: "{{ route('api.users.data') }}",
                    data: function (d) {
                        d.level = jQuery("#filter-level").val();
                    }
                },
                serverSide: true,
                processing: true,
                iDisplayLength: 5,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                columns: [
                    {
                        data: 'avatar',
                        name: "Avatar",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'full_name',
                    },
                    {
                        data: 'username',
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'level',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ]
            });

            let filterByUserLevel = `<label class="ml-4" for="filter-level">Filter :</label><select id='filter-level' class='ml-2 form-control'><option value='all'>-- Semua Pengguna --</option>`;
            @foreach(userLevel() as $key => $value)
                filterByUserLevel += `<option value='{{ $key }}'>{{ $value }}</option>`;
            @endforeach
                filterByUserLevel += `</select>`;

            jQuery("#users_length").append(filterByUserLevel);

            jQuery("#filter-level").change(function (){
                usersData.draw()
            });
        });
    </script>
@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Data Pengguna</h2>
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-user-lock text-muted mr-1"></i>
                    Daftar Akun Pengguna Sistem
                </h3>
                <div class="block-options">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i>
                        <span>Tambah Data</span>
                    </a>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter" id="users">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">
                            <i class="fa fa-user"></i>
                        </th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th class="d-none d-sm-table-cell">Email</th>
                        <th class="d-none d-sm-table-cell">Hak Akses</th>
                        <th class="d-none d-sm-table-cell text-center">Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
