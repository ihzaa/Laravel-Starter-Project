<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoAntrian extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "no_antrian";

    public function jadwal_dokter()
    {
        return $this->belongsTo('App\Models\Referensi\JadwalDokter');
    }
}