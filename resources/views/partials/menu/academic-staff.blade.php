<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('academic-staff.index') ? ' active' : '' }}"
                   href="{{ route('academic-staff.index') }}">
                    <i class="nav-main-link-icon fa fa-home"></i>
                    <span class="nav-main-link-name">DASHBOARD</span>
                </a>
            </li>
            <!-- DATA MASTER -->
            <li class="nav-main-heading">DATA MASTER</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('faculties.*') ? ' active' : '' }}"
                   href="{{ route('faculties.index') }}">
                    <i class="nav-main-link-icon fa fa-building"></i>
                    <span class="nav-main-link-name">FAKULTAS</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('study-programs.*') ? ' active' : '' }}"
                   href="{{ route('study-programs.index') }}">
                    <i class="nav-main-link-icon fa fa-list-alt"></i>
                    <span class="nav-main-link-name">PROGRAM STUDI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('lecturers.*') ? ' active' : '' }}"
                   href="{{ route('lecturers.index') }}">
                    <i class="nav-main-link-icon fa fa-users"></i>
                    <span class="nav-main-link-name">DOSEN</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('students.*') ? ' active' : '' }}"
                   href="{{ route('students.index') }}">
                    <i class="nav-main-link-icon fa fa-users"></i>
                    <span class="nav-main-link-name">MAHASISWA</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('science-fields.*') ? ' active' : '' }}"
                   href="{{ route('science-fields.index') }}">
                    <i class="nav-main-link-icon fa fa-lightbulb"></i>
                    <span class="nav-main-link-name">BIDANG ILMU</span>
                </a>
            </li>
            <!-- END DATA MASTER -->

            <!-- DATA SKRIPSI -->
            <li class="nav-main-heading">DATA SKRIPSI</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('thesis-requirements.*') ? ' active' : '' }}"
                   href="{{ route('thesis-requirements.index') }}">
                    <i class="nav-main-link-icon fa fa-file-alt"></i>
                    <span class="nav-main-link-name">PERSYARATAN SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('assessment-schedules.*') ? ' active' : '' }}"
                   href="{{ route('assessment-schedules.index') }}">
                    <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                    <span class="nav-main-link-name">JADWAL UJIAN SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('assessment-components.*') ? ' active' : '' }}"
                   href="{{ route('assessment-components.index') }}">
                    <i class="nav-main-link-icon fa fa-layer-group"></i>
                    <span class="nav-main-link-name">KOMPONEN NILAI</span>
                </a>
            </li>
            <!--li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('assessment-components.*') ? ' active' : '' }}"
                   href="{{ route('assessment-components.index') }}">
                    <i class="nav-main-link-icon fa fa-fw fa-edit"></i>
                    <span class="nav-main-link-name">DATA NILAI</span>
                </a>
            </li-->
            <!-- END DATA SKRIPSI -->

            <!-- PENGATURAN -->
            <li class="nav-main-heading">PENGATURAN</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('users/*') ? ' active' : '' }}"
                   href="{{ route('users.index') }}">
                    <i class="nav-main-link-icon fa fa-users-cog"></i>
                    <span class="nav-main-link-name">DATA PENGGUNA</span>
                </a>
            </li>
            <!-- END PENGATURAN -->

            <li class="nav-main-item">
                <a class="nav-main-link" href="#" onclick="confirmLogout()">
                    <i class="nav-main-link-icon fa fa-sign-out-alt"></i>
                    <span class="nav-main-link-name">LOGOUT</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</div>
