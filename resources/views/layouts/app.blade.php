<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'LaporBanjir | BPBD Kabupaten Bandung' }}</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="page-shell">
    <header class="site-header">
        <a class="brand" href="{{ route('laporan.create') }}">
            <span class="brand-mark" aria-hidden="true">LB</span>
            <span>Lapor<span class="brand-accent">Banjir</span><small>BPBD Kabupaten Bandung</small></span>
        </a>
        <nav class="navigation" aria-label="Navigasi utama">
            <a href="{{ route('laporan.create') }}">Buat Laporan</a>
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a class="nav-register" href="{{ route('register') }}">Register</a>
            @endguest
            @auth
                <a href="{{ route('laporan.index') }}">Daftar Laporan</a>
                <a href="{{ route('petugas.profile') }}">Profil</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="nav-button" type="submit">Logout</button>
                </form>
            @endauth
        </nav>
    </header>

    <main>
        @if (session('status'))
            <div class="notice notice-success" role="status">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="site-footer">Layanan pelaporan banjir · Kabupaten Bandung</footer>
</div>
</body>
</html>
