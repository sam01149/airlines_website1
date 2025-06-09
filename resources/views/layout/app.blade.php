<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Abadi Airlines')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS khusus untuk logo di navbar */
        nav .logo-container {
            display: flex;
            align-items: center;
            gap: 10px; /* Jarak antara logo dan teks */
        }

        nav .logo-container img {
            height: 40px; /* Ukuran tinggi logo */
            width: auto;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="{{ asset('images/AbadiAirlinesLogo.png') }}" alt="Abadi Airlines Logo">
            <div class="logo">Abadi Airlines</div>
        </div>
        <div class="menu-toggle" aria-label="Toggle menu" role="button" tabindex="0">&#9776;</div>
        <ul>
            @guest
            <li style="margin-top:12px"><a href="/">Home</a></li>
            @endguest
            <li style="margin-top:12px"><a href="/contact">Contact</a></li> {{-- Ubah ini --}}
            <li style="margin-top:12px"><a href="/faq">FAQ</a></li> {{-- Ubah ini --}}
            <li style="margin-top:12px"><a href="{{ route('about') }}">About</a></li>
            <li style="margin-top:12px"><a href="{{ route('services') }}">Services</a></li>
            @auth
                <li class="user-profile-nav">
                    <div class="user-profile" id="profileDropdownToggle">
                        {{-- Menggunakan foto profil jika ada, default jika tidak --}}
                        <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('images/default_profile.png') }}" alt="Profile" class="profile-icon-img">
                        <span class="profile-name">{{ Auth::user()->name }}</span>
                        <i class="fas fa-caret-down" style="margin-left: 5px; color: #ffd54f;"></i>
                    </div>
                    <div class="dropdown-menu" id="profileDropdownMenu">
                        <ul>
                            <li><a href="/profile-detail"><i class="fas fa-id-card"></i> Detail Profil</a></li>
                            <li><a href="/my-tickets"><i class="fas fa-ticket-alt"></i> Tiket Saya</a></li>
                            <li><a href="/sesi/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
            @else
                <li  style="margin-top:12px"><a href="/sesi/signup">Daftar</a></li>
                <li  style="margin-top:12px"><a href="/sesi">Login</a></li>
            @endauth
        </ul>
    </nav>

    @yield('content')

    <footer>
        &copy; 2025 Abadi Airlines. All rights reserved.
    </footer>

    <script>
        // Toggle mobile menu
        const menuToggle = document.querySelector('.menu-toggle');
        const navMenu = document.querySelector('nav ul');

        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        menuToggle.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                navMenu.classList.toggle('active');
            }
        });

        // Toggle profile dropdown
        const profileDropdownToggle = document.getElementById('profileDropdownToggle');
        const profileDropdownMenu = document.getElementById('profileDropdownMenu');

        if (profileDropdownToggle) {
            profileDropdownToggle.addEventListener('click', (event) => {
                event.stopPropagation(); // Mencegah event click menyebar ke document
                profileDropdownMenu.classList.toggle('show');
            });

            // Close dropdown if clicked outside
            document.addEventListener('click', (event) => {
                if (!profileDropdownToggle.contains(event.target) && !profileDropdownMenu.contains(event.target)) {
                    profileDropdownMenu.classList.remove('show');
                }
            });
        }

        // Add scrolled class to navbar
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Fungsi untuk toggle password visibility
        function togglePassword(id) {
            const passwordField = document.getElementById(id);
            const eyeIcon = passwordField.nextElementSibling ? passwordField.nextElementSibling.querySelector('i') : null;

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                if (eyeIcon) {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                }
            } else {
                passwordField.type = 'password';
                if (eyeIcon) {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            }
        }
    </script>
</body>
</html>