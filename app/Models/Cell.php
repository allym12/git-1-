<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cell extends Model
{
    use HasFactory,SoftDeletes;


    protected $guarded = [];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
