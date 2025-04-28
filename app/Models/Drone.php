<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;      

class Drone extends Model
{
    protected $fillable = [
        'nama_drone', 'gambar', 'tanggal_pengadaan', 'harga', 'keterangan'
    ];

    // Hitung umur saat create/update dan simpan ke dalam tabel
    protected static function booted()
    {
        static::saving(function ($drone) {
            if ($drone->tanggal_pengadaan) {
                $tanggal = Carbon::parse($drone->tanggal_pengadaan);
                $selisih = $tanggal->diff(Carbon::now());

                $drone->umur_tahun = $selisih->y;
                $drone->umur_bulan = $selisih->m;
            }
        });
    }

    // Kalau tetap ingin accessor (optional)
    public function getUmurTahunAttribute()
    {
        return $this->umur_tahun; // Ambil dari database langsung
    }

    public function getUmurBulanAttribute()
    {
        return $this->umur_bulan; // Ambil dari database langsung
    }
}
