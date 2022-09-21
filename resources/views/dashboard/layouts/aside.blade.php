<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ env('APP_URL') }}" class="brand-link">
{{--        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light">Oglasi.si</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{Request::segment(2) == '' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Statistika
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{Request::segment(2) == 'users' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Uporabniki
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('listings.index') }}" class="nav-link {{Request::segment(2) == 'listings' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Oglasi
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('filters.index') }}" class="nav-link {{Request::segment(2) == 'filters' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-filter"></i>
                        <p>
                           Filtri
                        </p>
                    </a>
                </li>

                <li class="nav-item {{Request::segment(2) == 'parentCategories' || Request::segment(2) == 'childCategories' ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{Request::segment(2) == 'parentCategories' || Request::segment(2) == 'childCategories' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Kategorije
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('parentCategories.index') }}" class="nav-link {{Request::segment(2) == 'parentCategories' ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nadrejene kategorije - parent categories </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('childCategories.index') }}" class="nav-link {{Request::segment(2) == 'childCategories' ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Podrejene kategorije - children categories</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('payments.index') }}" class="nav-link {{Request::segment(2) == 'payments' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Plačila
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('violations.index') }}" class="nav-link {{Request::segment(2) == 'violations' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Zlorabe
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('phone-numbers.index') }}" class="nav-link {{Request::segment(2) == 'phone-numbers' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-phone"></i>
                        <p>
                            Phone Numbers
                        </p>
                    </a>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <!-- /.sidebar-custom -->
</aside>
