<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side content-side-full">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('student.index') ? ' active' : '' }}"
                   href="{{ route('student.index') }}">
                    <i class="nav-main-link-icon fa fa-home"></i>
                    <span class="nav-main-link-name">DASHBOARD</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('student/thesis-requirement') ? ' active' : '' }}"
                   href="{{ route('student.thesis-requirement.index') }}">
                    <i class="nav-main-link-icon fa fa-file"></i>
                    <span class="nav-main-link-name">PERSYARATAN SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('student/thesis-submission') ? ' active' : '' }}"
                   href="{{ route('student.thesis-submission.index') }}">
                    <i class="nav-main-link-icon fa fa-file-alt"></i>
                    <span class="nav-main-link-name">PROPOSAL SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('student.thesis.*') ? ' active' : '' }}"
                   href="{{ route('student.thesis.index') }}">
                    <i class="nav-main-link-icon fa fa-book"></i>
                    <span class="nav-main-link-name">DATA SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('student.guidance.*') ? ' active' : '' }}"
                   href="{{ route('student.guidance.index') }}">
                    <i class="nav-main-link-icon fa fa-reply-all"></i>
                    <span class="nav-main-link-name">BIMBINGAN SKRIPSI</span>
                </a>
            </li>

            <!-- PENGUJIAN SKRIPSI -->
            <li class="nav-main-heading">PENGUJIAN SKRIPSI</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('student.assessment.seminar.*') && lastUriSegment() !== 'score' ? ' active' : '' }}"
                   href="{{ route('student.assessment.seminar.index') }}">
                    <i class="nav-main-link-icon fa fa-building"></i>
                    <span class="nav-main-link-name">SEMINAR SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('student.assessment.colloquium.*') && lastUriSegment() !== 'score' ? ' active' : '' }}"
                   href="{{ route('student.assessment.colloquium.index') }}">
                    <i class="nav-main-link-icon fa fa-tools"></i>
                    <span class="nav-main-link-name">KOLOKIUM SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('student.assessment.final-test.*') && lastUriSegment() !== 'score' ? ' active' : '' }}"
                   href="{{ route('student.assessment.final-test.index') }}">
                    <i class="nav-main-link-icon fa fa-people-carry"></i>
                    <span class="nav-main-link-name">SIDANG SKRIPSI</span>
                </a>
            </li>
            <!-- END PENGUJIAN SKRIPSI -->

            <!-- PENILAIAN -->
            <li class="nav-main-heading">PENILAIAN</li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('student.assessment.seminar.score') ? ' active' : '' }}"
                   href="{{ route('student.assessment.seminar.score') }}">
                    <i class="nav-main-link-icon fa fa-building"></i>
                    <span class="nav-main-link-name">SEMINAR SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('student.assessment.colloquium.score') ? ' active' : '' }}"
                   href="{{ route('student.assessment.colloquium.score') }}">
                    <i class="nav-main-link-icon fa fa-tools"></i>
                    <span class="nav-main-link-name">KOLOKIUM SKRIPSI</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->routeIs('student.assessment.final-test.score') ? ' active' : '' }}"
                   href="{{ route('student.assessment.final-test.score') }}">
                    <i class="nav-main-link-icon fa fa-people-carry"></i>
                    <span class="nav-main-link-name">SIDANG SKRIPSI</span>
                </a>
            </li>
            <!-- END PENILAIAN -->

            <li class="nav-main-heading"></li>
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
