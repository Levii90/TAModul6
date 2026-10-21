<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function create(): View
    {
        return view('laporan.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_pelapor' => ['required', 'string', 'max:255'],
            'lokasi' => ['required', 'string', 'max:255'],
            'tinggi_genangan' => ['required', 'integer', 'min:1', 'max:1000'],
            'tanggal_kejadian' => ['required', 'date', 'before_or_equal:today'],
        ], [
            'nama_pelapor.required' => 'Nama pelapor wajib diisi.',
            'lokasi.required' => 'Lokasi kejadian wajib dipilih.',
            'tinggi_genangan.required' => 'Tinggi genangan wajib diisi.',
            'tinggi_genangan.integer' => 'Tinggi genangan harus berupa angka.',
            'tanggal_kejadian.before_or_equal' => 'Tanggal kejadian tidak boleh melebihi hari ini.',
        ]);

        Laporan::create($validated);

        return redirect()->route('laporan.confirmation');
    }

    public function confirmation(): View
    {
        return view('laporan.konfirmasi');
    }

    public function index(): View
    {
        $laporans = Laporan::query()
            ->latest('tanggal_kejadian')
            ->latest('id')
            ->paginate(12);

        return view('laporan.index', compact('laporans'));
    }
}
