<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">{{ env('APP_NAME') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::route()->getName() == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}"><i
                    class="fa fa-columns"></i> <span>Dashboard</span></a>
        </li>
        <li class="{{ Route::currentRouteName() == 'pasien.index' ? 'active' : '' }}">
            <a href="{{ route('pasien.index') }}" class="nav-link">
                <i class="fa fa-users"></i> <span>Pasien</span>
            </a>
        </li>

{{--        <li class="{{ Route::currentRouteName() == 'kehamilan.index' ? 'active' : '' }}">--}}
{{--            <a href="{{ route('kehamilan.index') }}" class="nav-link">--}}
{{--                <i class="fa fa-file-medical"></i> <span>Kehamilan</span>--}}
{{--            </a>--}}
{{--        </li>--}}



        <li class="menu-header">Ujicoba</li>
        <li class="{{ Route::currentRouteName() == 'ujicoba.form-proses' ? 'active' : '' }}">
            <a href="{{ route('ujicoba.form-proses') }}" class="nav-link">
                <i class="fa fa-columns"></i> <span>Pengujian KNN</span>
            </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'kunjungan.index' ? 'active' : '' }}">
            <a href="{{ route('kunjungan.index') }}" class="nav-link">
                <i class="fa fa-sign-in-alt"></i> <span>Data Rujukan KNN</span>
            </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'knn.index' ? 'active' : '' }}">
            <a href="{{ route('knn.index') }}" class="nav-link">
                <i class="fa fa-table"></i> <span>Data Master</span>
            </a>
        </li>
        <li class="menu-header">Laporan</li>
        <li class="{{ Route::currentRouteName() == 'knn.index' ? 'active' : '' }}">
            <a href="{{ route('knn.index') }}" class="nav-link">
                <i class="fa fa-table"></i> <span>Laporan Kohort</span>
            </a>
        </li>

        @can('admin')
            <li class="menu-header">Users</li>
            <li class="{{ Request::route()->getName() == 'admin.users' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.users') }}"><i
                        class="fa fa-users"></i> <span>Users</span></a></li>
        @endcan
    </ul>
</aside>
