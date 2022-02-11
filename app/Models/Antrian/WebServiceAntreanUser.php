<?php

namespace App\Models\Antrian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebServiceAntreanUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'password', 'expires_at'
    ];
}
