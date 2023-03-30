<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('admin/assets/plugins/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Manager</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3 pb-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.category.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Thể loại Truyện</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.comic.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Truyện</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.chapter.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-file"></i>
                        <p>Chapter</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.news.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-newspaper"></i>
                        <p>News</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
