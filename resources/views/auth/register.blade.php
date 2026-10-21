@extends('layouts.app', ['title' => 'Register Petugas | LaporBanjir'])

@section('content')
<section class="auth-layout">
    <div class="auth-intro">
        <p class="eyebrow">Akun petugas</p>
        <h1>Daftarkan akun petugas.</h1>
        <p>Buat akun untuk mengakses daftar laporan warga dan informasi profil petugas.</p>
    </div>

    <form class="panel auth-panel" action="{{ route('register.store') }}" method="POST">
        @csrf
        <h2>Register petugas</h2>
        <p class="muted">Lengkapi informasi berikut untuk membuat akun.</p>

        <div class="field">
            <label for="name">Nama lengkap</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">
            <span class="field-hint">Gunakan minimal 8 karakter.</span>
            @error('password')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="password_confirmation">Konfirmasi password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
        </div>
        <button class="button button-primary button-wide" type="submit">Buat akun</button>
        <p class="form-footnote">Sudah memiliki akun? <a href="{{ route('login') }}">Login</a></p>
    </form>
</section>
@endsection
