<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory,SoftDeletes;


    protected $table = 'districts';
    protected $guarded = [];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function sectors()
    {
        return $this->hasMany(Sector::class);
    }
}
