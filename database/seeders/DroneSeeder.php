<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DroneMerk;
use App\Models\Drone;
use Carbon\Carbon;

class DroneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $merkDJI = DroneMerk::where('nama_merk', 'DJI')->first();
        $merkParrot = DroneMerk::where('nama_merk', 'Parrot')->first();
        $merkAutel = DroneMerk::where('nama_merk', 'Autel')->first();

        Drone::create([
            'nama_drone' => 'Parrot Bebop',
            'gambar' => 'anafi.jpg',
            'tanggal_pengadaan' => Carbon::now()->subYears(1)->subMonths(4),
            'harga' => 10000000,
            'keterangan' => false,
            'merk_id' => $merkParrot->id
        ]);

        Drone::create([
            'nama_drone' => 'DJI Phantom 4',
            'gambar' => 'phantom4.jpg',
            'tanggal_pengadaan' => Carbon::now()->subYears(2)->subMonths(3),
            'harga' => 15000000,
            'keterangan' => true,
            'merk_id' => $merkDJI->id
        ]);

        Drone::create([
            'nama_drone' => 'Autel Pro',
            'gambar' => 'autel.jpg',
            'tanggal_pengadaan' => Carbon::now()->subYears(1)->subMonths(5),
            'harga' => 10000000,
            'keterangan' => true,
            'merk_id' => $merkAutel->id
        ]);

        Drone::create([
            'nama_drone' => 'Autel II Pro',
            'gambar' => 'autel.jpg',
            'tanggal_pengadaan' => Carbon::now()->subYears(1)->subMonths(1),
            'harga' => 21000000,
            'keterangan' => true,
            'merk_id' => $merkAutel->id
        ]);

        Drone::create([
            'nama_drone' => 'Autel Robotic',
            'gambar' => 'autel.jpg',
            'tanggal_pengadaan' => Carbon::now()->subYears(1)->subMonths(5),
            'harga' => 30000000,
            'keterangan' => true,
            'merk_id' => $merkAutel->id
        ]);

        Drone::create([
            'nama_drone' => 'DJI Neo Fly',
            'gambar' => 'bg-login.jpg',
            'tanggal_pengadaan' => Carbon::now()->subYears(4)->subMonths(3),
            'harga' => 25000000,
            'keterangan' => true,
            'merk_id' => $merkDJI->id
        ]);

        Drone::create([
            'nama_drone' => 'Parrot Anafi',
            'gambar' => 'anafi.jpg',
            'tanggal_pengadaan' => Carbon::now()->subYears(1)->subMonths(5),
            'harga' => 10000000,
            'keterangan' => false,
            'merk_id' => $merkParrot->id
        ]);

        Drone::create([
            'nama_drone' => 'Autel',
            'gambar' => 'autel.jpg',
            'tanggal_pengadaan' => Carbon::now()->subYears(1)->subMonths(5),
            'harga' => 20000000,
            'keterangan' => true,
            'merk_id' => $merkAutel->id
        ]);
    }
}
