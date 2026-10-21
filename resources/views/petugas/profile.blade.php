@extends('layouts.app', ['title' => 'Profil | LaporBanjir'])

@section('content')
<section class="hero">
    <p class="eyebrow">Akun</p>
    <h1>Profil</h1>
    <p>Informasi akun yang sedang digunakan untuk mengelola laporan.</p>
</section>

<section class="panel profile-panel">
    <div class="profile-avatar" aria-hidden="true">{{ str($petugas->name)->substr(0, 1)->upper() }}</div>
    <dl class="profile-details">
        <div><dt>Nama</dt><dd>{{ $petugas->name }}</dd></div>
        <div><dt>Email</dt><dd>{{ $petugas->email }}</dd></div>
        <div><dt>Akun dibuat</dt><dd>{{ $petugas->created_at->diffForHumans() }}</dd></div>
    </dl>
</section>
@endsection
