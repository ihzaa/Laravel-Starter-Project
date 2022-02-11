<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "db_pegawai";

    public function jadwal_dokter()
    {
        return $this->hasMany('App\Models\Referensi\JadwalDokter', 'id_pegawai');
    }
}