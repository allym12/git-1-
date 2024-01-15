<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class House extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    //default column value

    protected $casts = [
        'other_photos' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function provinces()
    {
        return $this->belongsTo(Province::class, 'province') ?? null;
    }


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }



    public function districts()
    {
        return $this->belongsTo(District::class, 'district');
    }

    public function sectors()
    {
        return $this->belongsTo(Sector::class, 'sector');
    }

    public function cells()
    {
        return $this->belongsTo(Cell::class, 'cell');
    }

    public function getProvinceNameAttribute()
    {
        return $this->provinces->province_name ?? null;
    }

    public function getDistrictNameAttribute()
    {
        return $this->districts->district_name ?? null;
    }

    //auto generate unique slug

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $slug = Str::slug($model->title);
            $model->slug = static::makeUniqueSlug($slug);


            if (auth()->user() && auth()->user()->isAdmin()) {
                $model->status = 1; // Set status to 1 for admin users

            } else {
                $model->user_id = auth()->user()->id;
                auth()->user()->deductBalance(); // Deduct balance from user account
                $model->status = 0; // Set status to 0 for normal users
            }

        });
    }

    protected static function makeUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        // Check if the slug already exists in the database
        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }


    //default where clause
    protected static function booted()
    {

            static::addGlobalScope('house', function (Builder $builder) {
                if (auth()->check()){
                    auth()->user()->isAdmin() ? $builder->where('status', 1)->orWhere('status', 0) : $builder->where('status', 1);
                }else{
                    $builder->where('status', 1);
                }
            });

        if (auth()->user()){
            if (auth()->user()->isSeller()) {
                static::addGlobalScope('created_by_user_id', function (Builder $builder) {
                    $builder->where('user_id', auth()->id());
                });
            }
        }

    }

}
