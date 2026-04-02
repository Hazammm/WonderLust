<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Wanderlust Guides</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --admin-bg: #f4f7fe;
            --admin-sidebar: #0B1426;
            --admin-surface: #ffffff;
            --admin-text: #2b3674;
            --admin-text-light: #a3aed1;
            --admin-primary: #FF6B6B;
            --admin-secondary: #2EC4B6;
            --admin-border: #e2e8f0;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: var(--admin-bg); color: var(--admin-text); display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar { width: 280px; background-color: var(--admin-sidebar); color: white; padding: 30px 20px; display: flex; flex-direction: column; position: fixed; height: 100vh; z-index: 100; transition: transform 0.3s; }
        .sidebar-brand { font-size: 24px; font-weight: 700; display: flex; align-items: center; gap: 10px; margin-bottom: 50px; color: white; text-decoration: none; padding: 0 10px; }
        .sidebar-brand i { color: var(--admin-secondary); }
        .sidebar-nav { list-style: none; display: flex; flex-direction: column; gap: 10px; flex: 1; }
        .sidebar-nav-item a { display: flex; align-items: center; gap: 15px; padding: 15px 20px; color: var(--admin-text-light); text-decoration: none; border-radius: 10px; font-weight: 500; transition: all 0.2s; }
        .sidebar-nav-item a i { width: 20px; font-size: 18px; }
        .sidebar-nav-item a:hover, .sidebar-nav-item a.active { background-color: rgba(255,255,255,0.1); color: white; }
        .sidebar-nav-item a.active { background-color: rgba(46, 196, 182, 0.2); color: var(--admin-secondary); border-left: 4px solid var(--admin-secondary); padding-left: 16px; }
        
        /* Main Content */
        .main-content { flex: 1; margin-left: 280px; padding: 30px; min-width: 0; }
        
        /* Topbar */
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; background: white; padding: 15px 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); }
        .topbar-title { font-size: 20px; font-weight: 600; }
        .topbar-user { display: flex; align-items: center; gap: 20px; }
        
        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 600; border: none; border-radius: 8px; cursor: pointer; text-decoration: none; transition: all 0.2s; }
        .btn-primary { background-color: var(--admin-secondary); color: white; }
        .btn-primary:hover { background-color: #25a89c; }
        .btn-danger { background-color: #ef4444; color: white; }
        .btn-danger:hover { background-color: #dc2626; }
        .btn-outline { background-color: transparent; border: 1px solid var(--admin-border); color: var(--admin-text); }
        .btn-outline:hover { background-color: var(--admin-bg); }
        
        /* Cards & Tables */
        .card { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); margin-bottom: 30px; }
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 15px; color: var(--admin-text-light); font-weight: 600; font-size: 14px; border-bottom: 1px solid var(--admin-border); }
        td { padding: 15px; border-bottom: 1px solid var(--admin-border); vertical-align: middle; font-size: 14px; }
        tr:last-child td { border-bottom: none; }
        
        /* Forms */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; }
        .form-control { width: 100%; padding: 12px; border: 1px solid var(--admin-border); border-radius: 8px; font-family: 'Inter', sans-serif; font-size: 14px; outline: none; transition: border-color 0.2s; }
        .form-control:focus { border-color: var(--admin-secondary); }
        textarea.form-control { min-height: 120px; resize: vertical; }
        
        /* Badges */
        .badge { display: inline-block; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef9c3; color: #854d0e; }
        .badge-secondary { background: #f1f5f9; color: #475569; }
        
        /* Alerts */
        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-danger { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <i class="fa-solid fa-mountain-sun"></i> Wanderlust Admin
        </a>
        
        <ul class="sidebar-nav">
            <li class="sidebar-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i> Dashboard
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="{{ route('admin.destinations.index') }}" class="{{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-map-location-dot"></i> Destinations
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-tags"></i> Categories
                </a>
            </li>
        </ul>
        
        <div style="margin-top: auto; padding: 0 10px;">
            <a href="{{ route('home') }}" target="_blank" style="display: flex; align-items: center; gap: 10px; color: var(--admin-text-light); text-decoration: none; font-size: 14px; margin-bottom: 20px;">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> View Website
            </a>
            
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; width: 100%; display: flex; align-items: center; gap: 15px; padding: 15px; border-radius: 10px; cursor: pointer; font-family: 'Inter', sans-serif; font-size: 15px; font-weight: 500; transition: background 0.2s;">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="topbar">
            <h1 class="topbar-title">@yield('header')</h1>
            <div class="topbar-user">
                <span style="font-weight: 500; font-size: 14px;">{{ auth()->user()->name ?? 'Admin' }}</span>
                <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--admin-secondary); color: white; display: flex; justify-content: center; align-items: center; font-weight: bold;">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
