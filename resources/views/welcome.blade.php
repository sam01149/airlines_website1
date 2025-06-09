<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Abadi Airlines</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
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
            <li><a href="/">Home</a></li>
            <li><a href="/contact">Contact</a></li> {{-- Ubah ini --}}
            <li><a href="/faq">FAQ</a></li> {{-- Ubah ini --}}
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="/sesi/signup">Daftar</a></li>
            <li><a href="/sesi">Login</a></li>
        </ul>
    </nav>

    <header class="landing" id="home">
        <h1>Welcome to Abadi Airlines</h1>
        <p>Your journey begins with comfort, safety, and excellence in the skies.</p>
        <button> <a style="color:white; text-decoration: none;" href="/sesi/signup">Book Your Flight</a></button>
    </header>

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

        // Add scrolled class to navbar
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>