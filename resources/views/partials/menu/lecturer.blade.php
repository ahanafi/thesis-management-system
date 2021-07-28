<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturer.index') ? ' active' : '' }}" href="{{ route('lecturer.index') }}">
                    <i class="nav-main-link-icon fa fa-home"></i>
                    <span class="nav-main-link-name">DASHBOARD</span>
                </a>
            </li>
            <li class="nav-main-heading">PEMBIMBINGAN SKRIPSI</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturer.mentoring.student.*') ? ' active' : '' }}"
                   href="{{ route('lecturer.mentoring.student.index') }}">
                    <i class="nav-main-link-icon fa fa-building"></i>
                    <span class="nav-main-link-name">DATA MAHASISWA</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturer.mentoring.guidance.*') ? ' active' : '' }}"
                   href="{{ route('lecturer.mentoring.guidance.index') }}">
                    <i class="nav-main-link-icon fa fa-reply-all"></i>
                    <span class="nav-main-link-name">DATA BIMBINGAN</span>
                </a>
            </li>

            <!-- DATA MASTER -->
            <li class="nav-main-heading">DATA PENGUJIAN SKRIPSI</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturer.exam.seminar.*') ? ' active' : '' }}"
                   href="{{ route('lecturer.exam.seminar.index') }}">
                    <i class="nav-main-link-icon fa fa-list-alt"></i>
                    <span class="nav-main-link-name">SEMINAR SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturer.exam.final-test.*') ? ' active' : '' }}"
                   href="{{ route('lecturer.exam.final-test.index') }}">
                    <i class="nav-main-link-icon fa fa-users"></i>
                    <span class="nav-main-link-name">SIDANG SKRIPSI</span>
                </a>
            </li>
            <!-- END DATA MASTER -->

            <!-- DATA SKRIPSI -->
            <li class="nav-main-heading">KELOLA PENGAJUAN UJIAN</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturer.submission.seminar.*') ? ' active' : '' }}"
                   href="{{ route('lecturer.submission.seminar.index') }}">
                    <i class="nav-main-link-icon fa fa-file-alt"></i>
                    <span class="nav-main-link-name">SEMINAR SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturer.submission.colloquium.*') || request()->routeIs('lecturer.exam.colloquium.*') ? ' active' : '' }}"
                   href="{{ route('lecturer.submission.colloquium.index') }}">
                    <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                    <span class="nav-main-link-name">KOLOKIUM SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturer.submission.final-test.*') ? ' active' : '' }}"
                   href="{{ route('lecturer.submission.final-test.index') }}">
                    <i class="nav-main-link-icon fa fa-layer-group"></i>
                    <span class="nav-main-link-name">SIDANG SKRIPSI</span>
                </a>
            </li>
            <!-- END DATA SKRIPSI -->

            <!-- PENGATURAN -->
            <li class="nav-main-heading">PENGATURAN</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturer.profile') ? ' active' : '' }}"
                   href="{{ route('lecturer.profile') }}">
                    <i class="nav-main-link-icon fa fa-user-alt"></i>
                    <span class="nav-main-link-name">PROFIL SAYA</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('user/*') ? ' active' : '' }}"
                   href="#">
                    <i class="nav-main-link-icon fa fa-users-cog"></i>
                    <span class="nav-main-link-name">UBAH PASSWORD</span>
                </a>
            </li>
            <!-- END PENGATURAN -->
        </ul>
    </div>
    <!-- END Side Navigation -->
</div>
