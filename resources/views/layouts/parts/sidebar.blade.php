<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="index.html">
            <div class="mini-logo">
                <img class="smini-visible tracking-wider" src="{{ asset('oneUI/images/index.png') }}" alt="">
            </div>
            <div class="d-flex">
                {{-- <img class="smini-hide tracking-wider" src="{{ asset('oneUI/images/index.png') }}" alt=""
                    style="width: 60px"> --}}
                <div class="title-brand">
                    {{-- <p>Rumah Sakit <br><span style="font-size: 10px;line-height: 0">Universitas Muhammadiyah
                            Malang</span></p> --}}
                </div>
            </div>
        </a>
        <!-- END Logo -->
        <!-- Extra -->
        <div>

            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-dual ml-1" data-toggle="layout" data-action="sidebar_close"
                href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <hr>
        <!-- Side Navigation -->
        <div class="content-side">
            <!-- main item -->
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link {{ strpos(Route::current()->getName(), 'admin.dashboard.') !== false ? 'active' : '' }}"
                        href="{{ route('admin.dashboard.index') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>

                @include('layouts.parts.sidebar_components.pengaturan_user')
            </ul>
            <!-- end main item -->

        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
