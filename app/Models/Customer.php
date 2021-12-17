<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    protected $fillable = ['*'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
//            $model->user_id = auth()->user()->getAuthIdentifier();
            $model->user_id = 1;
        });

        static::addGlobalScope('userID', function (Builder $builder) {
//            $builder->where('user_id', '=', auth()->user()->getAuthIdentifier());
            $builder->where('user_id', '=', 1);
        });
    }
}
