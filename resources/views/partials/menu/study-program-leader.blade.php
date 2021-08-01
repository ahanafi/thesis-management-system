<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('leader.index') ? ' active' : '' }}"
                   href="{{ route('leader.index') }}">
                    <i class="nav-main-link-icon fa fa-home"></i>
                    <span class="nav-main-link-name">DASHBOARD</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('leader.thesis-submission.*') ? ' active' : '' }}"
                   href="{{ route('leader.thesis-submission.index') }}">
                    <i class="nav-main-link-icon fa fa-file-alt"></i>
                    <span class="nav-main-link-name">PENGAJUAN SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('leader.thesis.*') ? ' active' : '' }}"
                   href="{{ route('leader.thesis.index') }}">
                    <i class="nav-main-link-icon fa fa-book"></i>
                    <span class="nav-main-link-name">DATA SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('leader.data-set.*') ? ' active' : '' }}"
                   href="{{ route('leader.data-set.index') }}">
                    <i class="nav-main-link-icon fa fa-database"></i>
                    <span class="nav-main-link-name">DATA SET</span>
                </a>
            </li>

            <!-- PENENTUAN -->
            <li class="nav-main-heading">PENENTUAN DOSEN</li>
            <li class="nav-main-item {{ request()->routeIs('leader.determination.*') ? 'open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                   aria-expanded="{{ request()->routeIs('leader.determination.*') ? 'true' : 'false' }}" href="#">
                    <i class="nav-main-link-icon fa fa-cog"></i>
                    <span class="nav-main-link-name">PENENTUAN DOSEN</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->routeIs('leader.determination.supervisor.*') ? ' active' : '' }}"
                           href="{{ route('leader.determination.supervisor.index') }}">
                            <i class="nav-main-link-icon fa fa-users"></i>
                            <span class="nav-main-link-name">DOSEN PEMBIMBING</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->routeIs('leader.determination.seminar-examiner.*') ? ' active' : '' }}"
                           href="{{ route('leader.determination.seminar-examiner.index') }}">
                            <i class="nav-main-link-icon fa fa-user-friends"></i>
                            <span class="nav-main-link-name">PENGUJI SEMINAR</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->routeIs('leader.determination.trial-examiner.*') ? ' active' : '' }}"
                           href="{{ route('leader.determination.trial-examiner.index') }}">
                            <i class="nav-main-link-icon fa fa-users-cog"></i>
                            <span class="nav-main-link-name">PENGUJI SIDANG</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- END PENENTUAN -->

            <!-- PEMBIMBINGAN -->
            <li class="nav-main-heading">PEMBIMBINGAN SKRIPSI</li>
            <li class="nav-main-item {{ request()->routeIs('lecturer.mentoring.*') ? 'open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                   aria-expanded="{{ request()->routeIs('lecturer.mentoring.*') ? 'true' : 'false' }}" href="#">
                    <i class="nav-main-link-icon fa fa-comments"></i>
                    <span class="nav-main-link-name">PEMBIMBINGAN</span>
                </a>
                <ul class="nav-main-submenu">
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
                </ul>
            </li>
            <!-- END PEMBIMBINGAN -->

            <!-- PENGAJUAN UJIAN -->
            <li class="nav-main-item {{ request()->routeIs('lecturer.submission.*') ? 'open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                   aria-expanded="{{ request()->routeIs('lecturer.submission.*') ? 'true' : 'false' }}" href="#">
                    <i class="nav-main-link-icon fa fa-file-signature"></i>
                    <span class="nav-main-link-name">PENGAJUAN UJIAN</span>
                </a>
                <ul class="nav-main-submenu">
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
                </ul>
            </li>
            <!-- END PENGAJUAN UJIAN -->

            <!-- PENILAIAN UJIAN -->
            <li class="nav-main-item {{ request()->routeIs('lecturer.exam.*') ? 'open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                   aria-expanded="{{ request()->routeIs('lecturer.exam.*') ? 'true' : 'false' }}" href="#">
                    <i class="nav-main-link-icon fa fa-file-signature"></i>
                    <span class="nav-main-link-name">PENILAIAN UJIAN</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->routeIs('lecturer.exam.seminar.*') ? ' active' : '' }}"
                           href="{{ route('lecturer.exam.seminar.index') }}">
                            <i class="nav-main-link-icon fa fa-file-alt"></i>
                            <span class="nav-main-link-name">SEMINAR SKRIPSI</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->routeIs('lecturer.exam.final-test.*') ? ' active' : '' }}"
                           href="{{ route('lecturer.exam.final-test.index') }}">
                            <i class="nav-main-link-icon fa fa-layer-group"></i>
                            <span class="nav-main-link-name">SIDANG SKRIPSI</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- END PENGAJUAN UJIAN -->

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
