<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
