<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokterGanti extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "db_jadwal_dokter_ganti";
}