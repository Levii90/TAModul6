@extends('layouts.app', ['title' => 'Login Petugas | LaporBanjir'])

@section('content')
<section class="auth-layout">
    <div class="auth-intro">
        <p class="eyebrow">Portal petugas</p>
        <h1>Masuk untuk mengelola laporan.</h1>
        <p>Login menggunakan akun petugas BPBD untuk melihat data laporan warga dan profil Anda.</p>
    </div>

    <form class="panel auth-panel" action="{{ route('login.store') }}" method="POST">
        @csrf
        <h2>Login petugas</h2>
        <p class="muted">Masukkan email dan password akun Anda.</p>

        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">
            @error('password')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <label class="checkbox-field">
            <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
            <span>Ingat saya</span>
        </label>
        <button class="button button-primary button-wide" type="submit">Login</button>
        <p class="form-footnote">Belum memiliki akun petugas? <a href="{{ route('register') }}">Register</a></p>
    </form>
</section>
@endsection
