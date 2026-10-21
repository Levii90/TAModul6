@extends('layouts.app', ['title' => 'Kirim Laporan | LaporBanjir'])

@section('content')
<section class="hero">
    <p class="eyebrow">Pelaporan warga</p>
    <h1>Laporkan kondisi banjir.</h1>
    <p>Form ini dapat digunakan warga tanpa login. Informasi laporan akan diteruskan kepada petugas BPBD Kabupaten Bandung.</p>
</section>

<form class="panel report-form" action="{{ route('laporan.store') }}" method="POST">
    @csrf
    <div class="form-grid">
        <div class="field">
            <label for="nama_pelapor">Nama pelapor</label>
            <input id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}" required maxlength="255" autocomplete="name">
            @error('nama_pelapor')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="lokasi">Kecamatan / lokasi</label>
            <select id="lokasi" name="lokasi" required>
                <option value="">Pilih kecamatan</option>
                @foreach (['Dayeuhkolot', 'Baleendah', 'Bojongsoang', 'Rancaekek', 'Majalaya'] as $kecamatan)
                    <option value="{{ $kecamatan }}" @selected(old('lokasi') === $kecamatan)>{{ $kecamatan }}</option>
                @endforeach
            </select>
            @error('lokasi')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="tinggi_genangan">Tinggi genangan (cm)</label>
            <input id="tinggi_genangan" name="tinggi_genangan" type="number" min="1" max="1000" value="{{ old('tinggi_genangan') }}" required>
            @error('tinggi_genangan')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="tanggal_kejadian">Tanggal kejadian</label>
            <input id="tanggal_kejadian" name="tanggal_kejadian" type="date" max="{{ now()->toDateString() }}" value="{{ old('tanggal_kejadian', now()->toDateString()) }}" required>
            @error('tanggal_kejadian')<span class="field-error">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="form-actions">
        <button class="button button-primary" type="submit">Kirim laporan</button>
        <span class="field-hint">Tidak perlu login untuk mengirim laporan.</span>
    </div>
</form>
@endsection
