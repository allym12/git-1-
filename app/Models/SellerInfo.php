<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerInfo extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['remaining_uploads'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deductUpload(): void
    {
        if ($this->remaining_uploads > 0) {
            $this->remaining_uploads--;
            $this->save();
        }
    }


}
