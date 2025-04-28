<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DroneMerk;
use App\Models\Drone;
use Carbon\Carbon;

class DroneMerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merks = [
            'DJI',
            'Parrot',
            'Autel',
            'Yuneec',
            'Skydio'
        ];

        foreach ($merks as $merk) {
            DroneMerk::create([
                'nama_merk' => $merk,
            ]);
        }
    }
}
