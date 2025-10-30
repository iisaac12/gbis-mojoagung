<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('home') }}" class="navbar-logo">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 5L5 15V30H15V22H25V30H35V15L20 5Z" fill="#004AAD"/>
                <path d="M20 2L2 14V38H38V14L20 2Z" stroke="#C62828" stroke-width="2"/>
            </svg>
            <span>GBIS Mojoagung</span>
        </a>
        
        <div class="mobile-menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'Home' : 'Beranda' }}
            </a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'About' : 'Tentang' }}
            </a></li>
            <li><a href="{{ route('schedules') }}" class="{{ request()->routeIs('schedules') ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'Schedules' : 'Jadwal' }}
            </a></li>
            <li><a href="{{ route('events') }}" class="{{ request()->routeIs('events') ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'Events' : 'Acara' }}
            </a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                {{ session('locale') == 'en' ? 'Contact' : 'Kontak' }}
            </a></li>
            
            @auth
                @if(auth()->user()->role == 'admin')
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit;">
                            {{ session('locale') == 'en' ? 'Logout' : 'Keluar' }}
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
            @endauth
            
            <li class="lang-switcher">
                <a href="{{ route('language.switch', 'id') }}">
                    <button class="lang-btn {{ session('locale', 'id') == 'id' ? 'active' : '' }}">🇮🇩</button>
                </a>
                <a href="{{ route('language.switch', 'en') }}">
                    <button class="lang-btn {{ session('locale') == 'en' ? 'active' : '' }}">🇬🇧</button>
                </a>
            </li>
        </ul>
    </div>
</nav>