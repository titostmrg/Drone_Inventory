<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DroneMerk; // Pastikan model Drone diimport dengan benar
use App\Models\Drone;

class DroneController extends Controller
{
    
    public function index(Request $request) 
    {
        if (!$request->session()->has('is_logged_in')) {
            return redirect('/login');
        }

        // Ambil semua merk, hitung jumlah drone per merk
        $merks = DroneMerk::withCount('drones')->get();

        // Hitung semua drone
        $totalDrone = \App\Models\Drone::count();

        // Menghitung jumlah drone
        $droneBagus = Drone::where('keterangan', 1)->count(); // 1 = bagus
        $droneRusak = Drone::where('keterangan', 0)->count(); // 0 = rusak
        $totalDrone = $droneBagus + $droneRusak;

        return response()
            ->view('home', compact('merks', 'totalDrone', 'droneBagus', 'droneRusak'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

   

    public function show(Request $request, $id)
    {
        if (!$request->session()->has('is_logged_in')) {
            return redirect('/login');
        }

        // Mengambil merk drone berdasarkan id untuk ditampilkan ke halaman details
        $merk = DroneMerk::findOrFail($id);

        // Mengambil merk drone dengan merk_id yang sama dengan ID merk yang dipilih
        $drones = Drone::where('merk_id', $id)->get();

        // return value ke view data drone dengan data drone dan merknya
        return response()
            ->view('details', compact('merk', 'drones'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }       
}
