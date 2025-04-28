<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DroneMerk; // Pastikan model Drone diimport dengan benar
use App\Models\Drone;

class DroneController extends Controller
{
    
    public function index()
    {
        $drones = Drone::with('merk')->get(); // load drone beserta merk nya
        return view('home', compact('drones'));
    }

    public function show($id)
    {
        // Mengambil merk drone berdasarkan id untuk ditampilkan ke halaman details
        $merk = DroneMerk::findOrFail($id);

        // Mengambil merk drone dengan merk_id yang sama dengan ID merk yang dipilih
        $drones = Drone::where('merk_id', $id)->get();

        // return value ke view data drone dengan data drone dan merknya
        return view('details', compact('merk', 'drones'));     
    }

}
