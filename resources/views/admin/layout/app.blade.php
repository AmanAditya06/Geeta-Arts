<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Geeta Art & Craft</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #0ea5e9;
            --sidebar-width: 260px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f1f5f9;
            display: flex;
            min-height: 100vh;
        }
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        .admin-sidebar .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-size: 1.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .admin-sidebar .sidebar-brand a {
            color: #fff;
            text-decoration: none;
        }
        .admin-sidebar .sidebar-nav { padding: 10px 0; }
        .admin-sidebar .sidebar-nav .nav-section {
            padding: 10px 20px 5px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.4);
        }
        .admin-sidebar .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        .admin-sidebar .sidebar-nav a:hover { background: var(--sidebar-hover); color: #fff; }
        .admin-sidebar .sidebar-nav a.active { background: rgba(14,165,233,0.15); color: var(--sidebar-active); border-right: 3px solid var(--sidebar-active); }
        .admin-sidebar .sidebar-nav a i { width: 20px; text-align: center; }
        .admin-main {
            margin-left: var(--sidebar-width);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .admin-header {
            background: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .admin-header .toggle-sidebar {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        .admin-header .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .admin-header .header-right a {
            color: #64748b;
            text-decoration: none;
        }
        .admin-content { padding: 30px; flex: 1; }
        .admin-footer {
            background: #fff;
            padding: 15px 30px;
            text-align: center;
            color: #94a3b8;
            font-size: 0.85rem;
            border-top: 1px solid #e2e8f0;
        }
        .page-title { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-bottom: 25px; }
        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #fff;
        }
        .stat-card .stat-info h3 { font-size: 1.8rem; font-weight: 700; margin: 0; }
        .stat-card .stat-info p { margin: 0; color: #64748b; font-size: 0.85rem; }
        .table-container { background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .table-container .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px; }
        .table-container .table-header h5 { margin: 0; font-weight: 600; }
        .form-card { background: #fff; border-radius: 10px; padding: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); max-width: 800px; }
        .form-card .form-label { font-weight: 600; color: #374151; }
        .form-card .form-control, .form-card .form-select { border-radius: 6px; }
        .btn-admin { padding: 8px 20px; border-radius: 6px; font-weight: 500; }
        .badge-status { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .flash-message { padding: 12px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: 500; }
        .flash-message.success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .flash-message.error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .img-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0; }
        .empty-state { text-align: center; padding: 40px; color: #94a3b8; }
        .empty-state i { font-size: 3rem; margin-bottom: 15px; }
        @media (max-width: 768px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .admin-header .toggle-sidebar { display: block; }
        }
    </style>
</head>
<body>
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">⚜️ Geeta Admin</a>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>

            <div class="nav-section">Shop</div>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="fas fa-box"></i> Products
            </a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> Categories
            </a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag"></i> Orders
            </a>

            <div class="nav-section">Content</div>
            <a href="{{ route('admin.banners.index') }}" class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Hero Banners
            </a>
            <a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <i class="fas fa-sliders-h"></i> Home Sliders
            </a>
            <a href="{{ route('admin.carousels.index') }}" class="{{ request()->routeIs('admin.carousels.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Carousel Images
            </a>
            <a href="{{ route('admin.page-contents.index') }}" class="{{ request()->routeIs('admin.page-contents.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Page Content
            </a>

            <div class="nav-section">People</div>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Users
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Contact Messages
            </a>
        </nav>
    </aside>

    <div class="admin-main">
        <header class="admin-header">
            <div>
                <button class="toggle-sidebar" onclick="document.getElementById('adminSidebar').classList.toggle('open')">
                    <i class="fas fa-bars"></i>
                </button>
                <span>@yield('page_heading', 'Dashboard')</span>
            </div>
            <div class="header-right">
                <a href="{{ url('/') }}" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            </div>
        </header>

        <div class="admin-content">
            @if(session('success'))
                <div class="flash-message success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash-message error">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>

        <footer class="admin-footer">
            &copy; {{ date('Y') }} Geeta Art & Craft Admin Panel. All rights reserved.
        </footer>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.querySelector('.toggle-sidebar');
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
