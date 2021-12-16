<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RevenueInstallments extends Model
{
    protected $table = "revenue_installments";
    protected $fillable = ['*'];
    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
//            $model->user_id = auth()->user()->getAuthIdentifier();
            $model->user_id = 2;
        });

        static::addGlobalScope('userID', function (Builder $builder) {
//            $builder->where('user_id', '=', auth()->user()->getAuthIdentifier());
            $builder->where('user_id', '=', 2);
        });
    }
}
