@extends('layouts.app', ['title' => 'Daftar Laporan | LaporBanjir'])

@section('content')
<section class="hero hero-row">
    <div>
        <p class="eyebrow">Pantauan Kabupaten Bandung</p>
        <h1>Daftar laporan banjir.</h1>
        <p>Halaman ini hanya dapat diakses oleh petugas yang sudah login.</p>
    </div>
    <a class="button button-primary" href="{{ route('laporan.create') }}">+ Buat laporan</a>
</section>

@if ($laporans->isEmpty())
    <div class="panel empty-state">
        <h2>Belum ada laporan</h2>
        <p>Laporan warga akan muncul di halaman ini setelah dikirim.</p>
    </div>
@else
    <div class="report-grid">
        @foreach ($laporans as $laporan)
            @php($status = $laporan->status())
            <article class="report-card">
                <div class="report-card-heading">
                    <div>
                        <h2>{{ $laporan->nama_pelapor }}</h2>
                        <p class="muted">{{ $laporan->lokasi }} · {{ $laporan->tanggal_kejadian->format('d M Y') }}</p>
                    </div>
                    <span class="status-badge status-{{ strtolower($status) }}">{{ $status }}</span>
                </div>
                <p class="water-level">{{ $laporan->tinggi_genangan }} <span>cm</span></p>
                <p class="muted">Tinggi genangan</p>
            </article>
        @endforeach
    </div>
    <div class="pagination">{{ $laporans->links() }}</div>
@endif
@endsection
