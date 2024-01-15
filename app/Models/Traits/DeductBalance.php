<?php

use Illuminate\Support\Str;

trait DeductBalance
{
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
}
