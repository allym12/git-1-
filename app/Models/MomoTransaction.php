<?php

namespace App\Models;

use App\Helpers\EntityHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class MomoTransaction extends Model
{
    use SoftDeletes;

    public $table = 'momo_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'created_by',
        'deleted_by'
    ];

    protected $hidden = [
        'created_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function rules(): array
    {
        return [
        ];
    }
}
