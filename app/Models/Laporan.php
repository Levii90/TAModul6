<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'nama_pelapor',
        'lokasi',
        'tinggi_genangan',
        'tanggal_kejadian',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kejadian' => 'date',
            'tinggi_genangan' => 'integer',
        ];
    }

    public function status(): string
    {
        return match (true) {
            $this->tinggi_genangan >= 100 => 'Awas',
            $this->tinggi_genangan >= 50 => 'Siaga',
            default => 'Waspada',
        };
    }
}
