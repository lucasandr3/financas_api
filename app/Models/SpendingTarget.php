<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SpendingTarget extends Model
{
    protected $table = "spending_target";
    protected $fillable = ['*'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->user_id = auth()->user()->getAuthIdentifier();
        });

        static::addGlobalScope('userID', function (Builder $builder) {
            $builder->where('user_id', '=', auth()->user()->getAuthIdentifier());
        });
    }
}
