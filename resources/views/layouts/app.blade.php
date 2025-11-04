<!DOCTYPE html>
<html lang="{{ session('locale', 'id') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GBIS Mojoagung')</title>
    
    <!-- Google Fonts -->
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
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--gray-dark);
            line-height: 1.6;
        }
        
        /* Navbar Styles */
        .navbar {
            background: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }
        
        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-blue);
            text-decoration: none;
        }
        
        .navbar-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }
        
        .navbar-menu a {
            color: var(--gray-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .navbar-menu a:hover, .navbar-menu a.active {
            color: var(--primary-blue);
        }
        
        .lang-switcher {
            display: flex;
            gap: 0.5rem;
        }
        
        .lang-btn {
            padding: 0.4rem 0.8rem;
            border: 2px solid var(--primary-blue);
            background: transparent;
            color: var(--primary-blue);
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .lang-btn.active, .lang-btn:hover {
            background: var(--primary-blue);
            color: var(--white);
        }
        
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }
        
        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: var(--primary-blue);
            border-radius: 2px;
        }
        
        /* Footer Styles */
        .footer {
            background: var(--gray-dark);
            color: var(--white);
            padding: 3rem 2rem 1rem;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h3 {
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }
        
        .footer-section p, .footer-section a {
            color: var(--gray-light);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .footer-section a:hover {
            color: var(--white);
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }
        
        .social-links a:hover {
            background: var(--primary-red);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        /* Main Content */
        .main-content {
            min-height: calc(100vh - 400px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--white);
                padding: 1rem;
                box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            }
            
            .navbar-menu.active {
                display: flex;
            }
            
            .mobile-menu-toggle {
                display: flex;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    @include('components.navbar')
    
    <main class="main-content">
        @yield('content')
    </main>
    
    @include('components.footer')
    
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.querySelector('.mobile-menu-toggle');
            const menu = document.querySelector('.navbar-menu');
            
            if (toggle) {
                toggle.addEventListener('click', function() {
                    menu.classList.toggle('active');
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>