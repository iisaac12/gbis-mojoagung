<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GBIS Mojoagung')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/Logo_GBIS.png?v=1') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Logo_GBIS.png?v=1') }}">
    
    <!-- Google Fonts -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            height: 70px;
            display: flex;
            align-items: center;
            animation: fadeDown 0.8s ease-out forwards;
            transition: transform 0.3s ease-in-out;
        }

        .navbar.navbar--hidden {
            transform: translateY(-100%);
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes ElegantFade {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .navbar-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }
        
        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primary-blue);
            text-decoration: none;
            z-index: 1001;
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
            transition: all 0.3s;
            position: relative;
        }
        
        .navbar-menu a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-blue);
            transition: width 0.3s ease;
        }

        .navbar-menu a:hover::after, .navbar-menu a.active::after {
            width: 100%;
        }

        .navbar-menu a:hover, .navbar-menu a.active {
            color: var(--primary-blue);
        }
        

        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            z-index: 1001;
            padding: 10px;
            margin-right: -10px;
        }
        
        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: var(--primary-blue);
            border-radius: 2px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu-toggle.active span:nth-child(1) {
            transform: translateY(9px) rotate(45deg);
        }

        .mobile-menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle.active span:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg);
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
            padding-top: 70px; /* Offset for fixed navbar */
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                height: 60px;
            }

            .navbar-container {
                padding: 0 1.5rem;
            }

            .navbar-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                height: 100vh;
                background: var(--white);
                flex-direction: column;
                justify-content: center;
                gap: 2.5rem;
                transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: -10px 0 30px rgba(0,0,0,0.1);
                padding: 2rem;
            }
            
            .navbar-menu.active {
                right: 0;
            }

            .navbar-menu a {
                font-size: 1.25rem;
            }
            
            .mobile-menu-toggle {
                display: flex;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
            }

            .footer {
                padding: 2rem 1.5rem 1rem;
            }
        }

        .navbar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            backdrop-filter: blur(3px);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .navbar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Global Scroll Reveal Styles */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.215, 0.61, 0.355, 1);
            will-change: transform, opacity;
        }

        .reveal.reveal-active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hero Slider */
        .hero-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.2s ease-in-out;
            z-index: 0;
        }

        .hero-slide.active {
            opacity: 1;
            z-index: 1;
        }

        .hero-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 2rem;
            transform: translateY(-50%);
            z-index: 10;
            pointer-events: none;
        }

        .hero-nav-btn {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            backdrop-filter: blur(12px);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            pointer-events: auto;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .hero-nav-btn:hover {
            background: white;
            color: var(--primary-blue);
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 74, 173, 0.75) 0%, rgba(198, 40, 40, 0.35) 100%);
            z-index: 2;
        }

        /* Scintillating (Glowing) Text Effect */
        .scintillate-text {
            animation: scintillate 4s ease-in-out infinite;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3), 0 0 20px rgba(255, 255, 255, 0.2);
        }

        @keyframes scintillate {
            0%, 100% {
                text-shadow: 0 0 10px rgba(255, 255, 255, 0.3), 0 0 20px rgba(255, 255, 255, 0.2);
                filter: brightness(1);
            }
            50% {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.6), 0 0 35px rgba(255, 255, 255, 0.4), 0 0 50px rgba(255, 215, 0, 0.3);
                filter: brightness(1.2);
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
            const overlay = document.getElementById('navbar-overlay');
            
            if (toggle) {
                toggle.addEventListener('click', function() {
                    toggle.classList.toggle('active');
                    menu.classList.toggle('active');
                    if (overlay) overlay.classList.toggle('active');
                    
                    if (menu.classList.contains('active')) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = '';
                    }
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    if (toggle) toggle.classList.remove('active');
                    if (menu) menu.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                });
            }

            // Smart Navbar: Hide on scroll down, show on scroll up
            let lastScrollY = window.scrollY;
            const navbar = document.querySelector('.navbar');

            window.addEventListener('scroll', () => {
                if (window.scrollY > lastScrollY && window.scrollY > 100) {
                    navbar.classList.add('navbar--hidden');
                } else {
                    navbar.classList.remove('navbar--hidden');
                }
                lastScrollY = window.scrollY;
            });

            // Global Intersection Observer for Scroll Reveal (Enter & Exit)
            const revealCallback = (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-active');
                    } else {
                        entry.target.classList.remove('reveal-active');
                    }
                });
            };

            const revealObserver = new IntersectionObserver(revealCallback, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            const observeReveals = () => {
                document.querySelectorAll('.reveal').forEach(el => {
                    revealObserver.observe(el);
                });
            };

            observeReveals();


            // Hero Slider Logic
            const initSlider = () => {
                const slides = document.querySelectorAll('.hero-slide');
                const prevBtn = document.querySelector('.hero-nav-btn.prev');
                const nextBtn = document.querySelector('.hero-nav-btn.next');
                let currentSlide = 0;

                if (slides.length > 1) {
                    const showSlide = (n) => {
                        slides[currentSlide].classList.remove('active');
                        currentSlide = (n + slides.length) % slides.length;
                        slides[currentSlide].classList.add('active');
                    };

                    if (prevBtn) {
                        prevBtn.style.display = 'flex';
                        prevBtn.addEventListener('click', (e) => {
                            e.preventDefault();
                            showSlide(currentSlide - 1);
                        });
                    }
                    if (nextBtn) {
                        nextBtn.style.display = 'flex';
                        nextBtn.addEventListener('click', (e) => {
                            e.preventDefault();
                            showSlide(currentSlide + 1);
                        });
                    }

                    // Auto-play
                    setInterval(() => showSlide(currentSlide + 1), 7000);
                } else if (slides.length === 1) {
                    if (prevBtn) prevBtn.style.display = 'none';
                    if (nextBtn) nextBtn.style.display = 'none';
                }
            };

            initSlider();
        });
    </script>
    
    @stack('scripts')
</body>
</html>