<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - GBIS Mojoagung')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary-blue: #004AAD;
            --primary-red: #C62828;
            --white: #FFFFFF;
            --gray-light: #F5F5F5;
            --gray-dark: #333333;
            --sidebar-width: 250px;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--gray-light);
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            background: var(--gray-dark);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 2rem 1.5rem;
            background: var(--primary-blue);
        }
        
        .sidebar-header h2 {
            font-size: 1.3rem;
            margin-bottom: 0.25rem;
        }
        
        .sidebar-header p {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
        }
        
        .sidebar-menu li {
            margin-bottom: 0.25rem;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.5rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--primary-blue);
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2rem;
        }
        
        .topbar {
            background: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .topbar-left h1 {
            font-size: 1.5rem;
            color: var(--primary-blue);
        }
        
        .topbar-right {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: var(--primary-blue);
            color: white;
        }
        
        .btn-primary:hover {
            background: #003a8c;
        }
        
        .btn-danger {
            background: var(--primary-red);
            color: white;
        }
        
        .btn-danger:hover {
            background: #a02020;
        }
        
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            cursor: pointer;
        }
        
        @media (max-width: 968px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
                z-index: 1000;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-menu-toggle {
                display: block;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2>GBIS Mojoagung</h2>
                <p>Admin Panel</p>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        📊 Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        📅 Services
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                        🎉 Events
                    </a>
                </li>
                <li style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
                    <a href="{{ route('home') }}">
                        🏠 View Website
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="padding: 0 1.5rem;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: white; cursor: pointer; padding: 0.875rem 0; width: 100%; text-align: left; display: flex; align-items: center; gap: 0.75rem;">
                            🚪 Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <button class="mobile-menu-toggle" onclick="toggleSidebar()">
                ☰
            </button>
            
            @yield('content')
        </main>
    </div>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-menu-toggle');
            
            if (window.innerWidth <= 968) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>