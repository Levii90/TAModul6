@extends('layouts.app', ['title' => 'Laporan Terkirim | LaporBanjir'])

@section('content')
<section class="confirmation panel">
    <span class="confirmation-icon" aria-hidden="true">✓</span>
    <p class="eyebrow">Laporan diterima</p>
    <h1>Terima kasih telah melapor.</h1>
    <p class="muted">Informasi Anda sudah tersimpan dan dapat ditindaklanjuti oleh petugas BPBD.</p>
    <a class="button button-primary" href="{{ route('laporan.create') }}">Kirim laporan lain</a>
</section>
@endsection
