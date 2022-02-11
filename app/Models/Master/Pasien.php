<?php

namespace App\Models\Master;

use App\Models\ModelWithoutTimestamps;
use Illuminate\Database\Eloquent\Model;

class Pasien extends ModelWithoutTimestamps
{
    protected $guarded = [];
    protected $table = "db_pasien";

    public static function getLatestPatientByNoRM()
    {
        return Pasien::orderBy('kode_rm', 'DESC')->first();
    }

    public static function getLatestKodeRmRMForInsert()
    {
        return self::getLatestPatientByNoRM()->kode_rm + 1;
    }
}
