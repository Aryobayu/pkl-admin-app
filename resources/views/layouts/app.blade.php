<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'PAK Wi Online')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style type="text/tailwindcss">
      :root {
        --primary-color: #0056b3;
        --secondary-color: #f8f9fa;
        --background-color: #f8f9fa;
        --text-primary: #343a40;
        --text-secondary: #6c757d;
        --accent-color: #0056b3;
      }
      body {
        font-family: "Poppins", sans-serif;
        background-color: var(--background-color);
        color: var(--text-primary);
      }

      /* Header Styles */
      .header {
        @apply sticky top-0 bg-white shadow-md py-4 px-6 md:px-10 flex justify-between items-center z-10;
      }
      .header_button {
        @apply inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-[var(--primary-color)] border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500;
      }
      .header_link {
        @apply text-sm font-medium text-[var(--text-secondary)] hover:text-[var(--primary-color)] transition-colors;
      }

      /* Konten Utama */
      .headline {
        @apply text-4xl font-bold text-[var(--text-primary)] mt-8 mb-4 text-center;
      }

      /* Search Bar Styles */
      .search_bar {
        @apply w-full p-4 pl-12 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:border-transparent;
      }

      /* Filter Button Styles */
      .filter_button {
        @apply px-4 py-2 text-sm font-medium rounded-full bg-white border border-gray-300 text-[var(--text-secondary)] hover:bg-gray-100 transition-colors;
      }
      .filter_button_active {
        @apply px-4 py-2 text-sm font-medium rounded-full bg-[var(--accent-color)] text-white border border-transparent;
      }

      /* Profil Card Styles */
      .profile_grid {
        @apply grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8;
      }
      .profile_card {
        @apply bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl;
      }
      .profile_photo {
      @apply w-32 h-32 rounded-full mb-4 border-4 border-white shadow-lg;
      }
      .profile_name {
        @apply text-xl font-bold text-[var(--text-primary)] mb-1;
      }
      .profile_metadata {
        @apply text-sm text-[var(--text-secondary)] mb-3;
      }
      
      /* Style Baru untuk User Dropdown */
      .user-menu-button { @apply inline-flex items-center gap-2 text-sm font-semibold text-gray-700; }
      .dropdown-menu { 
        @apply absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transition ease-out duration-100;
        transform: scale(0.95);
        opacity: 0;
        display: none;
      }
      .dropdown-menu.show {
        transform: scale(1);
        opacity: 1;
        display: block;
      }
      .dropdown-item { @apply block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100; }
      
      /* Modal Styles */
      .modal-overlay {
        @apply fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center p-4 z-50;
        display: none; opacity: 0; transition: opacity 0.3s ease-in-out;
      }
      .modal-overlay.show {
        display: flex; opacity: 1;
      }
      .modal-content {
        @apply bg-white rounded-lg shadow-2xl w-full max-w-4xl flex flex-col;
        @apply transform transition-transform duration-300;
        transform: translateY(20px);
        max-height: 90vh;
      }
      .modal-overlay.show.modal-content {
          transform: translateY(0);
      }
      .modal-header {
          @apply p-4 border-b flex justify-between items-center;
      }
      .modal-body {
          @apply p-6 overflow-y-auto; /* INI KUNCI UNTUK FITUR SCROLL */
      }
      .modal-close-button {
        @apply text-gray-400 hover:text-gray-700;
      }

      /* Tabel Info dan Kompetensi */
      .info-table td { @apply py-3 px-4; }
      .info-table tr:not(:last-child) td { @apply border-b border-gray-200; }
      .info-table td:first-child { @apply font-semibold text-gray-600 w-1/4; }
      .kompetensi-table { @apply w-full text-sm text-left text-gray-500; }
      .kompetensi-table th { @apply px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider; }
      .kompetensi-table td { @apply px-6 py-4; }
      .kompetensi-table tbody tr:nth-child(odd) { @apply bg-white; }
      .kompetensi-table tbody tr:nth-child(even) { @apply bg-gray-50; }

      /* Modal Photo Container */
      .modal_photo_container {
        @apply w-full bg-gray-200 rounded-lg shadow-inner;
        aspect-ratio: 1 / 1;
        background-size: cover;
        background-position: center top;
        background-repeat: no-repeat;
      }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        
        <!-- HEADER BARU DENGAN NAVIGASI LENGKAP DAN DROPDOWN -->
        <header class="header">
            <!-- Kiri: Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <h1 class="text-xl font-bold text-[var(--text-primary)] hidden sm:block">PAK Wi Online</h1>
            </a>

            <!-- Tengah: Menu Navigasi Utama -->
            <nav class="flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('info.ajar') }}" class="text-gray-600 hover:text-blue-600">INFO AJAR</a>
                <a href="{{ route('Profil.Widyaiswara') }}" class="text-gray-600 hover:text-blue-600">PROFIL WIDYAISWARA</a>
                <a href="{{ route('statistik') }}" class="text-gray-600 hover:text-blue-600">STATISTIK</a>
                <a href="{{ route('formulir.create') }}" class="text-gray-600 hover:text-blue-600">FORMULIR</a>
            </nav>
            
            <!-- Kanan: Tombol Login/Register atau Dropdown User -->
            <div class="relative">
                @guest
                    {{-- Jika tamu, tampilkan Login & Register --}}
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700">Login</a>
                        <a href="{{ route('register') }}" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Register</a>
                    </div>
                @endguest

                @auth
                    {{-- Jika sudah login, tampilkan dropdown menu --}}
                    <div class="user-menu">
                        <button class="user-menu-button" id="userMenuButton">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                        </button>
                        
                        <div class="dropdown-menu" id="dropdownMenu">
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Ke Dashboard</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="dropdown-item">Ke Dashboard</a>
                            @endif
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </header>

        <!-- KONTEN UTAMA -->
        <main class="flex-grow w-full">
            @yield('content')
        </main>

    </div>

    <!-- JAVASCRIPT UNTUK DROPDOWN -->
    @auth
    <script>
        // Script ini hanya akan dimuat jika pengguna sudah login
        document.addEventListener('DOMContentLoaded', function () {
            const userMenuButton = document.getElementById('userMenuButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            userMenuButton.addEventListener('click', function (event) {
                // Mencegah event 'click' menyebar ke window
                event.stopPropagation(); 
                // Toggle class 'show' untuk menampilkan atau menyembunyikan dropdown
                dropdownMenu.classList.toggle('show');
            });

            // Menutup dropdown jika pengguna mengklik di luar area dropdown
            window.addEventListener('click', function (event) {
                if (!dropdownMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                    if (dropdownMenu.classList.contains('show')) {
                        dropdownMenu.classList.remove('show');
                    }
                }
            });
        });
    </script>
    @endauth

    @yield('footer-scripts')
    
</body>
</html>
