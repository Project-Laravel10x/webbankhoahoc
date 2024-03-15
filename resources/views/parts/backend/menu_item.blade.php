<!-- Divider -->


{{--<div class="sidebar-heading">--}}
{{--    Addons--}}
{{--</div>--}}

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{ $name }}"
       aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>{{ $title }}</span>
    </a>
    <div id="collapse{{ $name }}" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.'.$name.'.index') }}">Danh sách</a>
            <a class="collapse-item" href="{{ route('admin.'.$name.'.create') }}">Thêm mới</a>
        </div>
    </div>
</li>

<hr class="sidebar-divider d-none d-md-block">
