<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function cells()
    {
        return $this->hasMany(Cell::class);
    }
}
