<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\UserStampObserver;
use App\Traits\CanGetTableNameStatically;
use App\Traits\UserStamp;

class BaseModel extends Model
{
    use HasFactory, SoftDeletes, CanGetTableNameStatically, UserStamp;

    public function createdByUser()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
    public function updatedByUser()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
    public function deletedByUser()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }
}
