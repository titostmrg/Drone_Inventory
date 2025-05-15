<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DroneMerk extends Model
{
    protected $fillable = ['nama_merk', 'gambar'];
    
    public function drones()
    {
        return $this->hasMany(Drone::class, 'merk_id');
    }

}


