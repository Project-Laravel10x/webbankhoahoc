<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard')  }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @include('parts.backend.menu_item',['title' => 'Chuyên mục','name' => 'categories'])

    @include('parts.backend.menu_item',['title' => 'Khóa học','name' => 'courses'])

    @include('parts.backend.menu_item',['title' => 'Danh mục tin tức','name' => 'news_categories'])

    @include('parts.backend.menu_item',['title' => 'Tin tức','name' => 'news'])

    @include('parts.backend.menu_item',['title' => 'Giảng viên','name' => 'teachers'])

    @include('parts.backend.menu_item',['title' => 'Học viên','name' => 'students'])

    @include('parts.backend.menu_item',['title' => 'Người quản lí hệ thống','name' => 'users'])

    @can('groups.permission')
    @include('parts.backend.menu_item',['title' => 'Phân quyền module','name' => 'groups'])
    @endcan
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
