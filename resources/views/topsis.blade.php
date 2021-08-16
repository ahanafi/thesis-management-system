<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>TMS - Thesis Management System</title>

    <meta name="description" content="TMS - Thesis Management Information System at CIC University">
    <meta name="author" content="Ahmad Hanafi">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Fonts and Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ mix('css/dashmix.css') }}">
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
</head>
<body>
<!-- Page Container -->
<div id="page-container" class="page-header-dark main-content-boxed side-trans-enabled">

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">
                <!-- Logo -->
                <a class="font-w600 text-dual tracking-wide" href="{{ route('/') }}">
                    Thesis <span class="opacity-75">Management</span>
                    <span class="font-w400">System</span>
                </a>
                <!-- END Logo -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div>
                <!-- Open Search Section -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a href="{{ route('login') }}" class="btn bg-white text-primary btn-dual ml-2" data-toggle="layout"
                   data-action="header_search_on">
                    <span>Login Now</span>
                    <i class="fa fa-fw fa-arrow-right"></i>
                </a>
                <!-- END Open Search Section -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <!-- Users and Purchases -->
            <div class="row row-deck">
                <div class="col-xl-12" id="student-accounts">

                    <!-- Nilai Asli -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                Nilai Asli
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-sm table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr class="font-weight-bold">
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">NIM</th>
                                    <th rowspan="2">Nama Mahasiswa</th>
                                    <th rowspan="2">Prodi</th>
                                    <th colspan="6">Kriteria</th>
                                </tr>
                                <tr>
                                    <th>C1</th>
                                    <th>C2</th>
                                    <th>C3</th>
                                    <th>C4</th>
                                    <th>C5</th>
                                    <th>C6</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($nilaiSidang as $nilai)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nilai->nim }}</td>
                                        <td>{{ $nilai->nama }}</td>
                                        <td>{{ $nilai->prodi }}</td>
                                        <td>{{ $nilai->c1 }}</td>
                                        <td>{{ $nilai->c2 }}</td>
                                        <td>{{ $nilai->c3 }}</td>
                                        <td>{{ $nilai->c4 }}</td>
                                        <td>{{ $nilai->c5 }}</td>
                                        <td>{{ $nilai->c6 }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Nilai Asli -->

                </div>

                <div class="col-12">
                    <!-- Nilai Asli -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                POW + SQRT
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-sm table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr class="font-weight-bold">
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">NIM</th>
                                    <th rowspan="2">Nama Mahasiswa</th>
                                    <th rowspan="2">Prodi</th>
                                    <th colspan="6">Kriteria</th>
                                </tr>
                                <tr>
                                    <th>C1</th>
                                    <th>C2</th>
                                    <th>C3</th>
                                    <th>C4</th>
                                    <th>C5</th>
                                    <th>C6</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalC1 = 0;
                                    $totalC2 = 0;
                                    $totalC3 = 0;
                                    $totalC4 = 0;
                                    $totalC5 = 0;
                                    $totalC6 = 0;
                                @endphp
                                @foreach($nilaiSidang as $nilai)
                                    @php
                                        $totalC1 += pow($nilai->c1, 2);
                                        $totalC2 += pow($nilai->c2, 2);
                                        $totalC3 += pow($nilai->c3, 2);
                                        $totalC4 += pow($nilai->c4, 2);
                                        $totalC5 += pow($nilai->c5, 2);
                                        $totalC6 += pow($nilai->c6, 2);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nilai->nim }}</td>
                                        <td>{{ $nilai->nama }}</td>
                                        <td>{{ $nilai->prodi }}</td>
                                        <td>{{ pow($nilai->c1, 2) }}</td>
                                        <td>{{ pow($nilai->c2, 2) }}</td>
                                        <td>{{ pow($nilai->c3, 2) }}</td>
                                        <td>{{ pow($nilai->c4, 2) }}</td>
                                        <td>{{ pow($nilai->c5, 2) }}</td>
                                        <td>{{ pow($nilai->c6, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">SUM</td>
                                    <td class="text-center">{{ $totalC1 }}</td>
                                    <td class="text-center">{{ $totalC2 }}</td>
                                    <td class="text-center">{{ $totalC3 }}</td>
                                    <td class="text-center">{{ $totalC4 }}</td>
                                    <td class="text-center">{{ $totalC5 }}</td>
                                    <td class="text-center">{{ $totalC6 }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">SQRT</td>
                                    <td class="text-center">{{ $sqrt1 = number_format(sqrt($totalC1), 5) }}</td>
                                    <td class="text-center">{{ $sqrt2 = number_format(sqrt($totalC2), 5) }}</td>
                                    <td class="text-center">{{ $sqrt3 = number_format(sqrt($totalC3), 5) }}</td>
                                    <td class="text-center">{{ $sqrt4 = number_format(sqrt($totalC4), 5) }}</td>
                                    <td class="text-center">{{ $sqrt5 = number_format(sqrt($totalC5), 5) }}</td>
                                    <td class="text-center">{{ $sqrt6 = number_format(sqrt($totalC6), 5) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Nilai Asli -->
                </div>

                <div class="col-12">
                    <!-- Nilai Asli -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                MENCARI MATRIX NILAI TERNORMALISASI
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-sm table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr class="font-weight-bold">
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">NIM</th>
                                    <th rowspan="2">Nama Mahasiswa</th>
                                    <th rowspan="2">Prodi</th>
                                    <th colspan="6">Kriteria</th>
                                </tr>
                                <tr>
                                    <th>C1</th>
                                    <th>C2</th>
                                    <th>C3</th>
                                    <th>C4</th>
                                    <th>C5</th>
                                    <th>C6</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($nilaiSidang as $nilai)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nilai->nim }}</td>
                                        <td>{{ $nilai->nama }}</td>
                                        <td>{{ $nilai->prodi }}</td>
                                        <td>{{ number_format($nilai->c1/$sqrt1, 4) }}</td>
                                        <td>{{ number_format($nilai->c2/$sqrt2, 4) }}</td>
                                        <td>{{ number_format($nilai->c3/$sqrt3, 4) }}</td>
                                        <td>{{ number_format($nilai->c4/$sqrt4, 4) }}</td>
                                        <td>{{ number_format($nilai->c5/$sqrt5, 4) }}</td>
                                        <td>{{ number_format($nilai->c6/$sqrt6, 4) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Nilai Asli -->
                </div>

                <div class="col-12">
                    <!-- Nilai Asli -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                MENCARI MATRIX NILAI TERNORMALISASI Y * BOBOT
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-sm table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr class="font-weight-bold">
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">NIM</th>
                                    <th rowspan="2">Nama Mahasiswa</th>
                                    <th rowspan="2">Prodi</th>
                                    <th colspan="6">Kriteria</th>
                                </tr>
                                <tr>
                                    <th>C1</th>
                                    <th>C2</th>
                                    <th>C3</th>
                                    <th>C4</th>
                                    <th>C5</th>
                                    <th>C6</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $arrMatrixC1 = [];
                                    $arrMatrixC2 = [];
                                    $arrMatrixC3 = [];
                                    $arrMatrixC4 = [];
                                    $arrMatrixC5 = [];
                                    $arrMatrixC6 = [];
                                @endphp
                                @foreach($nilaiSidang as $nilai)
                                    @php
                                        $matrixBobot1 = number_format($nilai->c1/$sqrt1 * 20, 4);
                                        array_push($arrMatrixC1, $matrixBobot1);

                                        $matrixBobot2 = number_format($nilai->c2/$sqrt2 * 10, 4);
                                        array_push($arrMatrixC2, $matrixBobot2);

                                        $matrixBobot3 = number_format($nilai->c3/$sqrt3 * 20, 4);
                                        array_push($arrMatrixC3, $matrixBobot3);

                                        $matrixBobot4 = number_format($nilai->c4/$sqrt4 * 20, 4);
                                        array_push($arrMatrixC4, $matrixBobot4);

                                        $matrixBobot5 = number_format($nilai->c5/$sqrt5 * 10, 4);
                                        array_push($arrMatrixC5, $matrixBobot5);

                                        $matrixBobot6 = number_format($nilai->c6/$sqrt6 * 20, 4);
                                        array_push($arrMatrixC6, $matrixBobot6);
                                    @endphp

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nilai->nim }}</td>
                                        <td>{{ $nilai->nama }}</td>
                                        <td>{{ $nilai->prodi }}</td>
                                        <td>{{ $matrixBobot1 }}</td>
                                        <td>{{ $matrixBobot2 }}</td>
                                        <td>{{ $matrixBobot3 }}</td>
                                        <td>{{ $matrixBobot4 }}</td>
                                        <td>{{ $matrixBobot5 }}</td>
                                        <td>{{ $matrixBobot6 }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Nilai Asli -->
                </div>

                <div class="col-12">
                    <!-- Nilai Asli -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                SOLUSI IDEAL POSITIF
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-sm table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr>
                                    <th>MAX</th>
                                    <th>C1</th>
                                    <th>C2</th>
                                    <th>C3</th>
                                    <th>C4</th>
                                    <th>C5</th>
                                    <th>C6</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td width="50%">MAX</td>
                                    <td>{{ $maxMatrixC1 = max($arrMatrixC1) }}</td>
                                    <td>{{ $maxMatrixC2 = max($arrMatrixC2) }}</td>
                                    <td>{{ $maxMatrixC3 = max($arrMatrixC3) }}</td>
                                    <td>{{ $maxMatrixC4 = max($arrMatrixC4) }}</td>
                                    <td>{{ $maxMatrixC5 = max($arrMatrixC5) }}</td>
                                    <td>{{ $maxMatrixC6 = max($arrMatrixC6) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Nilai Asli -->
                </div>

                <div class="col-12">
                    <!-- Nilai Asli -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                SOLUSI IDEAL NEGATIF
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-sm table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr>
                                    <th>MIN</th>
                                    <th>C1</th>
                                    <th>C2</th>
                                    <th>C3</th>
                                    <th>C4</th>
                                    <th>C5</th>
                                    <th>C6</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td width="50%">MIN</td>
                                    <td>{{ $minMatrix1 = min($arrMatrixC1) }}</td>
                                    <td>{{ $minMatrix2 = min($arrMatrixC2) }}</td>
                                    <td>{{ $minMatrix3 = min($arrMatrixC3) }}</td>
                                    <td>{{ $minMatrix4 = min($arrMatrixC4) }}</td>
                                    <td>{{ $minMatrix5 = min($arrMatrixC5) }}</td>
                                    <td>{{ $minMatrix6 = min($arrMatrixC6) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Nilai Asli -->
                </div>

                <div class="col-12">
                    <!-- Nilai Asli -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header bg-gray-light block-header-default">
                            <h3 class="block-title">
                                <i class="fa fa-fw fa-user-friends"></i>
                                MENCARI MATRIX NILAI TERNORMALISASI Y * BOBOT
                            </h3>
                        </div>
                        <div class="block-content block-content-full">
                            <table
                                class="table table-striped table-sm table-bordered table-vcenter font-size-sm js-dataTable-full">
                                <thead>
                                <tr class="font-weight-bold">
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">NIM</th>
                                    <th rowspan="2">Nama Mahasiswa</th>
                                    <th rowspan="2">Prodi</th>
                                    <th colspan="6">Kriteria</th>
                                </tr>
                                <tr>
                                    <th>C1</th>
                                    <th>C2</th>
                                    <th>C3</th>
                                    <th>C4</th>
                                    <th>C5</th>
                                    <th>C6</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($nilaiSidang as $nilai)
                                    @php
                                        $matrixBobot1 = number_format($nilai->c1/$sqrt1 * 20, 4);
                                        $matrixBobot2 = number_format($nilai->c2/$sqrt2 * 10, 4);
                                        $matrixBobot3 = number_format($nilai->c3/$sqrt3 * 20, 4);
                                        $matrixBobot4 = number_format($nilai->c4/$sqrt4 * 20, 4);
                                        $matrixBobot5 = number_format($nilai->c5/$sqrt5 * 10, 4);
                                        $matrixBobot6 = number_format($nilai->c6/$sqrt6 * 20, 4);
                                    @endphp

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nilai->nim }}</td>
                                        <td>{{ $nilai->nama }}</td>
                                        <td>{{ $nilai->prodi }}</td>
                                        <td>{{ $matrixBobot1 }}</td>
                                        <td>{{ $matrixBobot2 }}</td>
                                        <td>{{ $matrixBobot3 }}</td>
                                        <td>{{ $matrixBobot4 }}</td>
                                        <td>{{ $matrixBobot5 }}</td>
                                        <td>{{ $matrixBobot6 }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Nilai Asli -->
                </div>
            </div>
            <!-- END Users and Purchases -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
@include('partials.footer')
<!-- END Footer -->
</div>
<!-- END Page Container -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page JS Code -->

</body>
</html>
