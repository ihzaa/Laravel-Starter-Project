<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "db_jadwal_dokter";

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Referensi\Pegawai');
    }

    public function jadwal_dokter()
    {
        return $this->hasMany('App\Models\Referensi\NoAntrian');
    }
}